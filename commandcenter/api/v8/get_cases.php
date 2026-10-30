<?php

require_once __DIR__ . '/../../kernel/db.php';
require_once __DIR__ . '/../../response.php';

header('Content-Type: application/json');

$node_id = $_GET['node_id'] ?? null;

if (empty($node_id)) {
    json_error("node_id is required.", 400);
    exit;
}

try {
    $pdo = kernel_db();
    $stmt = $pdo->prepare("
        SELECT id, node_id, business_name, status, phase, processing_status, created_at
        FROM cases
        WHERE node_id = ?
        ORDER BY created_at DESC
    ");
    $stmt->execute([$node_id]);
    json_response($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    json_error("Database error: " . $e->getMessage(), 500);
}