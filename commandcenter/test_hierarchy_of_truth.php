<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| TEST — Hierarchy of Truth Engine
|--------------------------------------------------------------------------
| Visit this file directly once in a browser. It creates one temporary
| test finding (under whatever real node_id happens to exist already),
| attaches a few sources at different tiers, scores it three different
| ways, prints all three results, then deletes everything it created.
| Nothing fake is left behind in the real tables either way.
|--------------------------------------------------------------------------
*/

header('Content-Type: text/plain');
require_once __DIR__ . '/engine/hierarchy_of_truth_engine.php';

$pdo = kernel_db();

try {
    $nodeId = $pdo->query("SELECT node_id FROM tree_nodes ORDER BY node_id LIMIT 1")->fetchColumn();

    if (!$nodeId) {
        echo "No rows in tree_nodes at all — can't run this test without at least one node to attach to.\n";
        exit;
    }

    echo "Using existing node_id: $nodeId (not modifying this node itself, just borrowing its id)\n\n";

    // ── Test 1: one Tier 1 source alone → should be VERIFIED ──────────────
    $findingId1 = create_test_finding($pdo, (int)$nodeId, "Test claim — single Tier 1 source");
    add_test_source($pdo, $findingId1, 1, null, 'https://example.com/signed-filing');
    $r1 = hot_score_finding($findingId1);
    print_result("Test 1 (1 Tier-1 source)", $r1);

    // ── Test 2: two Tier 3 sources → should be PROBABLE ────────────────────
    $findingId2 = create_test_finding($pdo, (int)$nodeId, "Test claim — two Tier 3 sources");
    add_test_source($pdo, $findingId2, 3, null, 'https://example.com/source-a');
    add_test_source($pdo, $findingId2, 3, null, 'https://example.com/source-b');
    $r2 = hot_score_finding($findingId2);
    print_result("Test 2 (2 Tier-3 sources)", $r2);

    // ── Test 3: no sources at all → should be UNVERIFIED ───────────────────
    $findingId3 = create_test_finding($pdo, (int)$nodeId, "Test claim — no sources");
    $r3 = hot_score_finding($findingId3);
    print_result("Test 3 (no sources)", $r3);

    // ── Clean up everything this test created ──────────────────────────────
    cleanup_test_finding($pdo, $findingId1);
    cleanup_test_finding($pdo, $findingId2);
    cleanup_test_finding($pdo, $findingId3);

    echo "All 3 test findings and their sources deleted — nothing left behind.\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

function create_test_finding(PDO $pdo, int $nodeId, string $claimText): int
{
    $stmt = $pdo->prepare("
        INSERT INTO findings (node_id, claim_text, channel, evidence_class, status)
        VALUES (:node_id, :claim_text, 'test', 'test', 'test')
    ");
    $stmt->execute([':node_id' => $nodeId, ':claim_text' => $claimText]);
    return (int)$pdo->lastInsertId();
}

function add_test_source(PDO $pdo, int $findingId, int $tier, ?int $documentId, ?string $sourceUrl): void
{
    $stmt = $pdo->prepare("
        INSERT INTO finding_sources (finding_id, document_id, source_url, tier, notes)
        VALUES (:finding_id, :document_id, :source_url, :tier, 'test source')
    ");
    $stmt->execute([
        ':finding_id' => $findingId,
        ':document_id' => $documentId,
        ':source_url' => $sourceUrl,
        ':tier' => $tier,
    ]);
}

function cleanup_test_finding(PDO $pdo, int $findingId): void
{
    // finding_sources rows cascade-delete automatically (ON DELETE CASCADE),
    // deleting the finding is enough.
    $stmt = $pdo->prepare("DELETE FROM findings WHERE id = :id");
    $stmt->execute([':id' => $findingId]);
}

function print_result(string $label, array $result): void
{
    echo "$label:\n";
    echo json_encode($result, JSON_PRETTY_PRINT) . "\n\n";
}