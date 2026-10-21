<?php
require_once __DIR__ . "/bootstrap.php";

header('Content-Type: application/json');

/* NODES */
$nodesStmt = $pdo->query("
    SELECT id, title
    FROM page
    ORDER BY created DESC
    LIMIT 200
");

$nodes = [];

foreach ($nodesStmt as $row) {
    $nodes[] = [
        "id" => (int)$row['id'],
        "label" => $row['title']
    ];
}

/* LINKS */
$linksStmt = $pdo->query("
    SELECT source_id, target_id, weight
    FROM page_relations
    LIMIT 500
");

$links = [];

foreach ($linksStmt as $row) {
    $links[] = [
        "source" => (int)$row['source_id'],
        "target" => (int)$row['target_id'],
        "value"  => (float)$row['weight']
    ];
}

echo json_encode([
    "nodes" => $nodes,
    "links" => $links
]);