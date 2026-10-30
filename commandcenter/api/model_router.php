<?php

/**
 * model_router.php — real AI-model calls.
 *
 * Each function is real, working code — not a fake placeholder.
 * Each one checks for its own API key constant first (set in
 * config.local.php, never hardcoded here) and returns a clear
 * "not_configured" result if that key isn't set yet. The moment
 * a real key is added to config.local.php, that provider starts
 * working with no other changes needed here.
 *
 * Currently configured: Claude only (CLAUDE_API_KEY).
 * Scaffolded, ready to activate: OpenAI (OPENAI_API_KEY), Gemini (GEMINI_API_KEY).
 */

function call_claude($prompt) {

    if (!defined('CLAUDE_API_KEY') || CLAUDE_API_KEY === '') {
        return [
            "status" => "not_configured",
            "text" => null
        ];
    }

    $payload = json_encode([
        "model" => "claude-sonnet-4-6",
        "max_tokens" => 1024,
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ]
    ]);

    $ch = curl_init("https://api.anthropic.com/v1/messages");

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "x-api-key: " . CLAUDE_API_KEY,
            "anthropic-version: 2023-06-01"
        ],
        CURLOPT_TIMEOUT => 60
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return [
            "status" => "error",
            "text" => null,
            "error" => "connection failed: " . $curlError
        ];
    }

    $decoded = json_decode($response, true);

    if ($httpCode !== 200) {
        return [
            "status" => "error",
            "text" => null,
            "error" => $decoded['error']['message'] ?? "HTTP $httpCode",
            "http_code" => $httpCode
        ];
    }

    $text = $decoded['content'][0]['text'] ?? null;

    return [
        "status" => $text !== null ? "ok" : "error",
        "text" => $text,
        "error" => $text !== null ? null : "unexpected response shape"
    ];
}

function call_openai($prompt) {

    if (!defined('OPENAI_API_KEY') || OPENAI_API_KEY === '') {
        return [
            "status" => "not_configured",
            "text" => null
        ];
    }

    $payload = json_encode([
        "model" => "gpt-5",
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ]
    ]);

    $ch = curl_init("https://api.openai.com/v1/chat/completions");

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "Authorization: Bearer " . OPENAI_API_KEY
        ],
        CURLOPT_TIMEOUT => 60
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return [
            "status" => "error",
            "text" => null,
            "error" => "connection failed: " . $curlError
        ];
    }

    $decoded = json_decode($response, true);

    if ($httpCode !== 200) {
        return [
            "status" => "error",
            "text" => null,
            "error" => $decoded['error']['message'] ?? "HTTP $httpCode",
            "http_code" => $httpCode
        ];
    }

    $text = $decoded['choices'][0]['message']['content'] ?? null;

    return [
        "status" => $text !== null ? "ok" : "error",
        "text" => $text,
        "error" => $text !== null ? null : "unexpected response shape"
    ];
}

function call_gemini($prompt) {

    if (!defined('GEMINI_API_KEY') || GEMINI_API_KEY === '') {
        return [
            "status" => "not_configured",
            "text" => null
        ];
    }

    $payload = json_encode([
        "contents" => [
            ["parts" => [["text" => $prompt]]]
        ]
    ]);

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-pro:generateContent?key=" . GEMINI_API_KEY;

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json"
        ],
        CURLOPT_TIMEOUT => 60
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return [
            "status" => "error",
            "text" => null,
            "error" => "connection failed: " . $curlError
        ];
    }

    $decoded = json_decode($response, true);

    if ($httpCode !== 200) {
        return [
            "status" => "error",
            "text" => null,
            "error" => $decoded['error']['message'] ?? "HTTP $httpCode",
            "http_code" => $httpCode
        ];
    }

    $text = $decoded['candidates'][0]['content']['parts'][0]['text'] ?? null;

    return [
        "status" => $text !== null ? "ok" : "error",
        "text" => $text,
        "error" => $text !== null ? null : "unexpected response shape"
    ];
}

function route_models($prompt) {

    return [
        "claude" => call_claude($prompt),
        "openai" => call_openai($prompt),
        "gemini" => call_gemini($prompt)
    ];
}