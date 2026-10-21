<?php
/**
 * LEGAiSEE — save-brief.php
 * Receives completed intake data from the browser,
 * saves full transcript + AI summary to /legaisee-briefs/,
 * emails the AI summary to john@legaisee.com.
 *
 * INSTALL: Upload to legaisee.com root (same level as anthropic-proxy.php)
 * CREATE FOLDER: Create /legaisee-briefs/ on server, chmod 755
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://www.legaisee.com');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST')    { http_response_code(405); exit; }

/* ── CONFIG ─────────────────────────────────────────── */
$ANTHROPIC_KEY  = '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 ';          // same key as anthropic-proxy.php
$TO_EMAIL       = 'john@legaisee.com';
$FROM_EMAIL     = 'intake@legaisee.com';
$BRIEFS_DIR     = __DIR__ . '/legaisee-briefs';  // folder on server
$SUMMARY_MODEL  = 'claude-sonnet-4-6';

/* ── RECEIVE PAYLOAD ────────────────────────────────── */
$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data || empty($data['brief']) || empty($data['conversation'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing brief or conversation']);
    exit;
}

$brief        = $data['brief'];        // the [BRIEF_COMPLETE] text
$conversation = $data['conversation']; // full Q&A transcript
$timestamp    = date('Y-m-d_H-i-s');
$institution  = preg_replace('/[^a-zA-Z0-9\-_]/', '_',
                  $data['institution'] ?? 'Unknown');

/* ── BUILD FULL TRANSCRIPT FILE ─────────────────────── */
$fullRecord = "LEGAISEE — FORENSIC INTAKE RECORD\n";
$fullRecord .= "Generated: " . date('F j, Y \a\t g:i A T') . "\n";
$fullRecord .= str_repeat("═", 60) . "\n\n";
$fullRecord .= "FULL CONVERSATION TRANSCRIPT\n";
$fullRecord .= str_repeat("─", 60) . "\n\n";
$fullRecord .= $conversation . "\n\n";
$fullRecord .= str_repeat("═", 60) . "\n\n";
$fullRecord .= "PHASE 0 PRE-BRIEF (AI GENERATED)\n";
$fullRecord .= str_repeat("─", 60) . "\n\n";
$fullRecord .= $brief . "\n";

/* ── GENERATE AI SUMMARY via Anthropic ──────────────── */
$summaryPrompt = "You are reviewing a completed LEGAiSEE forensic intake interview and its generated pre-brief. Produce a concise, actionable ANALYST SUMMARY for John Carr — the practitioner who will be making the decision whether to accept this client.

The summary should cover:

1. FIRST IMPRESSION (2-3 sentences): Your immediate read on this principal and enterprise based on how they answered. Are they forthcoming? Self-aware? Defensive? What is the quality of their institutional self-knowledge?

2. STRONGEST SIGNAL (2-3 sentences): The single most compelling piece of evidence in this record. What is the thing John should be most excited about — or most cautious about?

3. EXCAVATION VIABILITY (1-2 sentences): Is there actually a dig site here? Is the record deep enough to support a Phase 0 commission?

4. RECOMMENDED FIRST MOVE (2-3 sentences): If John decides to respond, what is the first question he should ask in the private conversation? What thread should he pull?

5. RED FLAGS / WATCH ITEMS (bullet list, 2-4 items max): Anything that gave you pause — vagueness, evasion, misalignment between what they said and what the record likely shows.

6. OVERALL ASSESSMENT: One sentence verdict. Accept / Conditional Accept / Decline.

Write in a direct, professional tone. This is for John's eyes only. Be honest, not diplomatic.

---

TRANSCRIPT:
" . $conversation . "

---

PRE-BRIEF:
" . $brief;

$summaryResponse = callClaude($summaryPrompt, $ANTHROPIC_KEY, $SUMMARY_MODEL);
$aiSummary = $summaryResponse ?? '[Summary generation failed — review transcript manually]';

/* ── APPEND SUMMARY TO FULL RECORD ──────────────────── */
$fullRecord .= "\n" . str_repeat("═", 60) . "\n\n";
$fullRecord .= "ANALYST SUMMARY (FOR JOHN CARR)\n";
$fullRecord .= str_repeat("─", 60) . "\n\n";
$fullRecord .= $aiSummary . "\n";

/* ── SAVE TO SERVER ──────────────────────────────────── */
$saved = false;
if (is_dir($BRIEFS_DIR) || mkdir($BRIEFS_DIR, 0755, true)) {
    $filename = $BRIEFS_DIR . '/' . $timestamp . '_' . $institution . '.txt';
    $saved = file_put_contents($filename, $fullRecord) !== false;
}

/* ── EMAIL SUMMARY TO JOHN ───────────────────────────── */
$subject = 'LEGAiSEE Intake — ' . ($data['institution'] ?? 'New Submission') . ' — ' . date('M j, Y');

$emailBody  = "A forensic intake has been completed.\n\n";
$emailBody .= "INSTITUTION: " . ($data['institution'] ?? 'Not provided') . "\n";
$emailBody .= "SUBMITTED:   " . date('F j, Y \a\t g:i A T') . "\n";
$emailBody .= "FILE SAVED:  " . ($saved ? basename($filename) : 'SAVE FAILED — check server') . "\n";
$emailBody .= str_repeat("─", 60) . "\n\n";
$emailBody .= "ANALYST SUMMARY\n";
$emailBody .= str_repeat("─", 60) . "\n\n";
$emailBody .= $aiSummary . "\n\n";
$emailBody .= str_repeat("─", 60) . "\n";
$emailBody .= "Full transcript and pre-brief saved to:\n";
$emailBody .= "/legaisee-briefs/" . ($saved ? basename($filename) : '[save failed]') . "\n";

$headers  = "From: LEGAiSEE Intake <{$FROM_EMAIL}>\r\n";
$headers .= "Reply-To: {$FROM_EMAIL}\r\n";
$headers .= "X-Mailer: LEGAiSEE-Intake/1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$emailed = mail($TO_EMAIL, $subject, $emailBody, $headers);

/* ── RESPOND TO BROWSER ──────────────────────────────── */
echo json_encode([
    'saved'   => $saved,
    'emailed' => $emailed,
    'file'    => $saved ? basename($filename) : null
]);

/* ── HELPER: CALL CLAUDE ─────────────────────────────── */
function callClaude($prompt, $key, $model) {
    $payload = json_encode([
        'model'      => $model,
        'max_tokens' => 1000,
        'messages'   => [['role' => 'user', 'content' => $prompt]]
    ]);

    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'x-api-key: ' . $key,
            'anthropic-version: 2023-06-01'
        ],
        CURLOPT_TIMEOUT        => 30
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) return null;
    $decoded = json_decode($response, true);
    return $decoded['content'][0]['text'] ?? null;
}