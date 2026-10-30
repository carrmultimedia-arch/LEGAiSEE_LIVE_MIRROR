<?php

/**
 * brain_orchestrator.php
 *
 * WO-19 changes:
 * - Now loads config.php, so CLAUDE_API_KEY (from config.local.php)
 *   is actually defined when call_claude() runs. Without this,
 *   model_router.php's real curl code always fell through to
 *   "not_configured" no matter what key was set.
 * - Now calls brain_synthesis.php's synthesize_brain_responses()
 *   after getting the raw model output, instead of returning raw
 *   output only.
 * - Core logic pulled into run_brain_on_file() so brain_module.php's
 *   "Run Brain" button can call it directly, in-process, without a
 *   second HTTP round-trip. This file still works exactly as before
 *   if hit directly as its own endpoint.
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/model_router.php';
require_once __DIR__ . '/brain_synthesis.php';

function run_brain_on_file(string $file, $node_id = null): array {

    $path = __DIR__ . "/../normalized/" . basename($file);

    if (!file_exists($path)) {
        return ["error" => "file not found"];
    }

    $content = file_get_contents($path);

    /* STEP 1: INITIAL PROMPT BUILD */
    $prompt = "
Analyze this document for intelligence extraction:

$content

Return structured insights: themes, risks, intent, anomalies.
";

    /* STEP 2: MULTI-MODEL EXECUTION */
    $responses = route_models($prompt);

    /* STEP 3: SYNTHESIZE REAL MODEL OUTPUT (honest confidence, no rand()) */
    $synthesis = synthesize_brain_responses($responses, $node_id);

    /* STEP 4: RETURN BOTH RAW AND SYNTHESIZED OUTPUT */
    return [
        "file" => $file,
        "node_id" => $node_id,
        "raw" => $responses,
        "synthesis" => $synthesis
    ];
}

// Only run as a standalone HTTP endpoint if this file was requested
// directly (not when brain_module.php requires it in-process).
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    header('Content-Type: application/json');
    session_start();

    $input = json_decode(file_get_contents("php://input"), true);
    $file = $input['file'] ?? '';
    $node_id = $_SESSION['brain_node_id'] ?? null;

    echo json_encode(run_brain_on_file($file, $node_id));
}