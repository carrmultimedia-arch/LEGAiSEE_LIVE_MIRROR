<?php
// test_graph_fix.php
// READ-ONLY. Asks GraphModule for one entity's neighbourhood and prints what came back.
// It writes nothing: no INSERT, no UPDATE, no DELETE, no temporary tables.
// Open as: /commandcenter/test_graph_fix.php?key=truth-7f3a91c2e8   (delete this file afterwards)

if (!hash_equals('truth-7f3a91c2e8', (string)($_GET['key'] ?? ''))) { http_response_code(404); exit; }

require_once __DIR__ . '/kernel/kernel_boot.php';
require_once __DIR__ . '/modules/graph_module.php';

header('Content-Type: text/plain; charset=utf-8');

try {
    $db = kernel_db();

    // 1. Pick one entity that really has an outgoing relationship whose ID columns are filled.
    $q = $db->query("
        SELECT e.id, e.canonical_name
        FROM entities e
        JOIN relationships r ON r.from_entity_id = e.id
        WHERE r.to_entity_id IS NOT NULL
        ORDER BY e.id
        LIMIT 1
    ");
    $row = $q ? $q->fetch(PDO::FETCH_ASSOC) : false;

    if (!$row) {
        echo "No entity has a relationship with a filled to_entity_id.\n";
        echo "Run the relationship backfill first, otherwise there is nothing to traverse.\n";
        exit;
    }

    $name = (string)$row['canonical_name'];
    $id   = (int)$row['id'];

    echo "Test entity:                     {$name} (id {$id})\n";

    // 2. How many neighbours SHOULD there be: a plain read of the table, used as the yardstick.
    $c = $db->prepare("SELECT COUNT(*) FROM relationships WHERE from_entity_id = ? AND to_entity_id IS NOT NULL");
    $c->execute([$id]);
    echo "Rows leaving this entity (table): " . (int)$c->fetchColumn() . "\n\n";

    // 3. Ask the module itself, through its only public entry point.
    $res = GraphModule::query($db, ['start_entity' => $name, 'hops' => 2, 'limit' => 5]);

    if (($res['status'] ?? '') !== 'ok') {
        echo "GraphModule refused: " . ($res['status'] ?? '?') . " / " . ($res['message'] ?? 'no message') . "\n";
        exit;
    }

    $paths  = is_array($res['results'] ?? null) ? $res['results'] : [];
    $direct = 0;
    foreach ($paths as $p) {
        if ((int)($p['depth'] ?? 0) === 1) { $direct++; }
    }

    echo "Result paths returned:           " . count($paths) . "   (capped by limit=5)\n";
    echo "Neighbours found (depth-1 paths): {$direct}\n\n";

    echo "Top 3 result paths:\n";
    $n = 0;
    foreach ($paths as $p) {
        $n++;
        if ($n > 3) { break; }
        $hops = is_array($p['path'] ?? null) ? implode(' -> ', $p['path']) : '?';
        echo "  {$n}. {$hops}   (score {$p['score']}, depth {$p['depth']})\n";
    }
    if ($n === 0) { echo "  (none)\n"; }

    echo "\nRESULT: " . (count($paths) > 0
        ? "GraphModule found neighbours - it is reading the ID columns."
        : "GraphModule found nothing - the readers still are not seeing the ID columns.")
        . "\n";
} catch (Throwable $e) {
    echo "STOPPED WITH AN ERROR: " . $e->getMessage() . "\n";
}
