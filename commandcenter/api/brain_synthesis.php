<?php

/**
 * brain_synthesis.php — v2 synthesis logic (real, not simulated)
 *
 * WO-19: wrapped the existing v2 logic in a function so
 * brain_orchestrator.php can call it directly, in-process — no
 * behavior change from what's already live, just reusable now.
 * Still works as its own standalone JSON endpoint too, if hit
 * directly (e.g. for manual testing).
 */

function synthesize_brain_responses(array $data, $node_id = null): array {

    $synthesis = [
        "node_id" => $node_id,
        "core_insight" => "",
        "confidence" => 0,
        "models_used" => [],
        "models_unavailable" => [],
        "model_summary" => []
    ];

    $usable = [];

    foreach ($data as $model => $result) {
        $status = $result['status'] ?? 'error';

        if ($status === 'ok' && !empty($result['text'])) {
            $usable[$model] = $result['text'];
            $synthesis["models_used"][] = $model;
            $synthesis["model_summary"][$model] = $result['text'];
        } else {
            $synthesis["models_unavailable"][] = [
                "model" => $model,
                "status" => $status,
                "error" => $result['error'] ?? null
            ];
        }
    }

    if (count($usable) === 0) {
        $synthesis["core_insight"] = "No model produced usable output.";
        $synthesis["confidence"] = 0;
    } elseif (count($usable) === 1) {
        $model = array_key_first($usable);
        $synthesis["core_insight"] = $usable[$model];
        $synthesis["confidence"] = 70; // single-source: real output, no cross-model agreement to verify it against
    } else {
        // Placeholder for when 2+ real models are configured — real
        // agreement scoring (not rand()) goes here once there's a
        // second provider to actually compare against.
        $synthesis["core_insight"] = implode("\n\n---\n\n", $usable);
        $synthesis["confidence"] = 75;
    }

    return $synthesis;
}

// Only run as a standalone HTTP endpoint if this file was requested
// directly (not when another file requires it in-process).
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    header('Content-Type: application/json');
    session_start();

    $input = json_decode(file_get_contents("php://input"), true);
    $data = $input['data'] ?? [];
    $node_id = $_SESSION['brain_node_id'] ?? null;

    if (!$data) {
        echo json_encode(["error" => "no model data"]);
        exit;
    }

    echo json_encode(synthesize_brain_responses($data, $node_id));
}