<?php

require_once __DIR__ . '/../../kernel/db.php';
require_once __DIR__ . '/../../response.php';

header('Content-Type: application/json');

try {
    $pdo = kernel_db();

    $stmt = $pdo->query("
        SELECT
            tn.node_id,
            tn.name,
            tn.status,
            tn.created_at,
            MAX(CASE WHEN nd.attribute_key = 'industry' THEN nd.attribute_value END) AS industry,
            MAX(CASE WHEN nd.attribute_key = 'city' THEN nd.attribute_value END) AS city,
            MAX(CASE WHEN nd.attribute_key = 'state' THEN nd.attribute_value END) AS state
        FROM tree_nodes tn
        LEFT JOIN node_details nd ON nd.node_id = tn.node_id
        WHERE tn.node_type = 'client'
        GROUP BY tn.node_id, tn.name, tn.status, tn.created_at
        ORDER BY tn.name ASC
    ");

    json_response($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    json_error("Database error: " . $e->getMessage(), 500);
}