<?php
// test_extraction_fix.php
// Makes 2 FAKE entities, 1 alias and 1 relationship, checks they saved, then deletes ONLY those fake rows.
// Open as: /commandcenter/test_extraction_fix.php?key=truth-7f3a91c2e8   (delete this file afterwards)

if (!hash_equals('truth-7f3a91c2e8', (string)($_GET['key'] ?? ''))) { http_response_code(404); exit; }

require_once __DIR__ . '/kernel/kernel_boot.php';
require_once __DIR__ . '/engine/entity_extraction_engine.php';

header('Content-Type: text/plain; charset=utf-8');
$db  = kernel_db();
$tag = 'ZZTEST' . date('His');
$nameA = "$tag Alpha Builders LLC";
$nameB = "$tag Beta Homes LLC";
$ok = true;

try {
    $a = lee_upsert_entity($db, $nameA, 'organization', 0.8);
    $b = lee_upsert_entity($db, $nameB, 'organization', 0.8);
    echo "1. Save two entities:        " . (($a && $b) ? "OK" : "FAILED") . "\n";
    if (!$a || !$b) { throw new RuntimeException('entity ids missing'); }

    lee_insert_alias($db, $a, "$tag source", 'test', 0.6);
    $q = $db->prepare("SELECT COUNT(*) FROM entity_aliases WHERE entity_id = ? AND alias = ?");
    $q->execute([$a, "$tag source"]);
    $n = (int)$q->fetchColumn();
    echo "2. Save an alias:            " . ($n === 1 ? "OK" : "FAILED") . "\n";
    $ok = $ok && ($n === 1);

    lee_upsert_relationship($db, $a, $nameA, $b, $nameB, 'partners_with', 0.6, 'ZZTEST sentence');
    $q = $db->prepare("SELECT from_entity, from_entity_id, to_entity_id, context FROM relationships WHERE from_entity_id = ? AND to_entity_id = ?");
    $q->execute([$a, $b]);
    $row = $q->fetch(PDO::FETCH_ASSOC);
    echo "3. Save a relationship:      " . ($row ? "OK" : "FAILED") . "\n";
    echo "4. ID columns filled in:     " . (($row && (int)$row['from_entity_id'] === (int)$a && (int)$row['to_entity_id'] === (int)$b) ? "OK" : "FAILED") . "\n";
    echo "5. Context text saved:       " . (($row && $row['context'] === 'ZZTEST sentence') ? "OK" : "FAILED") . "\n";
    $ok = $ok && $row && (int)$row['from_entity_id'] === (int)$a && (int)$row['to_entity_id'] === (int)$b;
} catch (Throwable $e) {
    $ok = false;
    echo "STOPPED WITH AN ERROR: " . $e->getMessage() . "\n";
} finally {
    // Clean up ONLY the fake rows made by this page (all start with the unique tag).
    try {
        $like = $tag . '%';
        $d1 = $db->prepare("DELETE FROM relationships WHERE from_entity LIKE ?");
        $d1->execute([$like]);
        $d2 = $db->prepare("DELETE FROM entity_aliases WHERE alias LIKE ?");
        $d2->execute([$like]);
        $d3 = $db->prepare("DELETE FROM entities WHERE canonical_name LIKE ?");
        $d3->execute([$like]);
        echo "Clean-up: removed the fake test rows.\n";
    } catch (Throwable $e) {
        echo "Clean-up problem (look for rows starting with $tag): " . $e->getMessage() . "\n";
    }
}

echo "\n" . ($ok ? "RESULT: ALL GOOD - the entity saving works." : "RESULT: SOMETHING FAILED - copy this whole page and send it back.") . "\n";
