<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| HIERARCHY OF TRUTH ENGINE
|--------------------------------------------------------------------------
| Computes a finding's real confidence label from its actual sources
| in finding_sources — replaces the rand(60,95) placeholder that used
| to stand in for this. This is Gap #1 of the REAL V1 CHECKPOINT.
|
| Canon reference (Master System Law Part I.4, 8.1):
|   Tier 1 — Verified Primary : signed filings, dated financial
|            records, original physical media
|   Tier 2 — Probable         : highly credible secondary sources
|            (internal reports, consistent trade-press coverage)
|   Tier 3 — Plausible        : reasonable inference from context
|   Tier 4 — Uncertain        : speculative or directly conflicting
|
|   Bedrock Pledge Pillar II (3-Source Rule): no significant claim
|   published without two independent sources, or one Tier 1 source.
|
| The 5 client-facing labels (VERIFIED/PROBABLE/PLAUSIBLE/UNCERTAIN/
| UNVERIFIED) are canon. The exact rule mapping tier+source-count to
| one of those 5 labels is NOT spelled out in the governing docs —
| this file's hot_label_from_sources() is that mapping, proposed by
| Claude and approved by John (9/6). If it ever needs adjusting, this
| is the one place to change it — nothing else should reimplement
| this logic.
|
| DELIBERATE DESIGN CHOICE: confidence is always computed fresh from
| finding_sources, never stored as a column on findings. Storing it
| would let it go stale the moment a source gets added/edited/removed
| — the exact kind of fake-looking-real number this system exists to
| avoid. Call hot_score_finding() whenever a finding's confidence is
| needed; don't cache it in the database.
|
| KNOWN v1 LIMITATIONS (documented on purpose, not hidden):
| - "Independent" sources are approximated as distinct
|   (document_id, source_url) pairs on the same finding. This does
|   NOT detect two sources that are actually the same underlying
|   origin (e.g. one article re-publishing another's wire story).
|   That judgment call is on whoever records the source's tier.
| - This does not auto-detect that two sources actually CONTRADICT
|   each other (vs. just both being weak). A source believed to
|   conflict with another should be recorded as Tier 4 by whoever
|   adds it — this engine trusts the tier it's given, it doesn't
|   re-derive it from source text.
|--------------------------------------------------------------------------
*/

require_once __DIR__ . '/../kernel/kernel_boot.php';

const HOT_LABELS = [
    'VERIFIED'   => 'VERIFIED',
    'PROBABLE'   => 'PROBABLE',
    'PLAUSIBLE'  => 'PLAUSIBLE',
    'UNCERTAIN'  => 'UNCERTAIN',
    'UNVERIFIED' => 'UNVERIFIED',
];

/**
 * Pure logic — no database access. Takes a list of sources for one
 * finding and returns the computed label + the reasoning behind it.
 *
 * @param array $sources Each item: ['tier' => int 1-4, 'document_id' => ?int, 'source_url' => ?string]
 * @return array{label:string, reason:string, source_count:int, best_tier:?int}
 */
function hot_label_from_sources(array $sources): array
{
    // De-duplicate to approximate "independent" sources — see
    // KNOWN v1 LIMITATIONS above for what this does and doesn't catch.
    $seen = [];
    $distinct = [];
    foreach ($sources as $s) {
        $tier = (int)($s['tier'] ?? 0);
        if ($tier < 1 || $tier > 4) {
            continue; // invalid/unrecorded tier — ignore rather than guess
        }
        $key = $s['document_id'] !== null
            ? 'doc:' . $s['document_id']
            : 'url:' . strtolower(trim((string)($s['source_url'] ?? '')));

        if ($key === 'doc:' || $key === 'url:') {
            continue; // no way to identify this source at all — skip it
        }

        if (!isset($seen[$key])) {
            $seen[$key] = true;
            $distinct[] = $tier;
        }
    }

    $n = count($distinct);

    if ($n === 0) {
        return [
            'label' => HOT_LABELS['UNVERIFIED'],
            'reason' => 'No sources recorded yet.',
            'source_count' => 0,
            'best_tier' => null,
        ];
    }

    $bestTier = min($distinct); // lower number = stronger tier

    if ($bestTier === 1) {
        return [
            'label' => HOT_LABELS['VERIFIED'],
            'reason' => 'A Tier 1 (Verified Primary) source is present — satisfies the 3-Source Rule on its own.',
            'source_count' => $n,
            'best_tier' => $bestTier,
        ];
    }

    if ($n >= 2 && $bestTier === 2) {
        return [
            'label' => HOT_LABELS['VERIFIED'],
            'reason' => "$n independent sources corroborate, best available is Tier 2 (Probable).",
            'source_count' => $n,
            'best_tier' => $bestTier,
        ];
    }

    if ($n >= 2 && $bestTier === 3) {
        return [
            'label' => HOT_LABELS['PROBABLE'],
            'reason' => "$n independent sources corroborate, but the best available is only Tier 3 (Plausible).",
            'source_count' => $n,
            'best_tier' => $bestTier,
        ];
    }

    if ($n === 1 && ($bestTier === 2 || $bestTier === 3)) {
        return [
            'label' => HOT_LABELS['PLAUSIBLE'],
            'reason' => 'Only a single source found — not yet triangulated against a second independent source.',
            'source_count' => $n,
            'best_tier' => $bestTier,
        ];
    }

    // Remaining cases: best available is Tier 4 (speculative/conflicting),
    // regardless of count — weak or contested evidence stays UNCERTAIN
    // rather than being upgraded just because there's more of it.
    return [
        'label' => HOT_LABELS['UNCERTAIN'],
        'reason' => 'Best available source is Tier 4 (speculative or directly conflicting).',
        'source_count' => $n,
        'best_tier' => $bestTier,
    ];
}

/**
 * Reads a finding's real sources from the database and scores it.
 *
 * @return array{finding_id:int, label:string, reason:string, source_count:int, best_tier:?int}|array{error:string}
 */
function hot_score_finding(int $findingId): array
{
    $pdo = kernel_db();

    $stmt = $pdo->prepare("
        SELECT tier, document_id, source_url
        FROM finding_sources
        WHERE finding_id = :finding_id
    ");
    $stmt->execute([':finding_id' => $findingId]);
    $sources = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $result = hot_label_from_sources($sources);
    $result['finding_id'] = $findingId;

    return $result;
}