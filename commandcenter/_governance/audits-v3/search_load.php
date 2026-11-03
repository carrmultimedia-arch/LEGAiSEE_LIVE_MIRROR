<?php
/**
 * api/search_load.php
 * LEGAiSEE — Search content loader
 *
 * This is a standalone JSON endpoint — it does NOT go through shell.php.
 * The search module JS calls this directly to load file/record content
 * into Pane A or Pane B without a page reload.
 *
 * Upload to: commandcenter/api/search_load.php
 * Called by: search_module.php JavaScript (XMLHttpRequest)
 * Returns:   JSON — { "label": "...", "text": "..." }
 */

require_once __DIR__ . '/../kernel/kernel_boot.php';

header('Content-Type: application/json');

$ref = trim($_GET['ref'] ?? '');

if (!$ref) {
    echo json_encode(['label' => '', 'text' => '']);
    exit;
}

$db = kernel_db();

$parts = explode(':', $ref, 3);

if (count($parts) < 3) {
    echo json_encode(['label' => $ref, 'text' => '(invalid reference — expected source:type:key)']);
    exit;
}

[$source, $type, $key] = $parts;

// ── JSON file sources ─────────────────────────────────────────────────────────

if ($source === 'json') {

    $dirs = [
        'cases'     => defined('CASES_ROOT')   ? CASES_ROOT   : DATA_ROOT . 'cases/',
        'clients'   => defined('CLIENTS_ROOT') ? CLIENTS_ROOT : DATA_ROOT . 'clients/',
        'prospects' => DATA_ROOT . 'prospects/',
        'network'   => DATA_ROOT . 'network/',
    ];

    if (!isset($dirs[$type])) {
        echo json_encode(['label' => $key, 'text' => "(unknown JSON source type: {$type})"]);
        exit;
    }

    $dir      = $dirs[$type];
    $real_dir = realpath($dir);
    $path     = realpath($dir . $key);

    if (!$path || !$real_dir || strpos($path, $real_dir) !== 0 || !file_exists($path)) {
        echo json_encode(['label' => $key, 'text' => '(file not found)']);
        exit;
    }

    $raw   = file_get_contents($path);
    $data  = json_decode($raw, true);

    if ($data) {
        $text  = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $label = $data['name']
              ?? $data['title']
              ?? $data['business_name']
              ?? $data['prospect_name']
              ?? $key;
    } else {
        $text  = $raw;
        $label = $key;
    }

    echo json_encode(['label' => "{$type} / {$label}", 'text' => $text]);
    exit;
}

// ── MySQL sources ─────────────────────────────────────────────────────────────

if ($source === 'mysql') {

    $id = intval($key);

    if ($id <= 0) {
        echo json_encode(['label' => $key, 'text' => '(invalid record ID)']);
        exit;
    }

    try {
        switch ($type) {

            case 'documents':
                $row = $db->query("SELECT title, source_type AS source, content FROM documents WHERE id = {$id}")->fetch(PDO::FETCH_ASSOC);
                if (!$row) { echo json_encode(['label' => "Document #{$id}", 'text' => '(record not found)']); exit; }
                $label = $row['title'] ?: "Document #{$id}";
                $text  = implode("\n\n", array_filter([$row['title'], $row['source'], $row['content']]));
                break;

            case 'files':
                $row = $db->query("SELECT title, file_type, content, created_at FROM files WHERE id = {$id}")->fetch(PDO::FETCH_ASSOC);
                if (!$row) { echo json_encode(['label' => "File #{$id}", 'text' => '(record not found)']); exit; }
                $label = $row['title'] ?: "File #{$id}";
                $text  = "Title:   {$row['title']}\nType:    {$row['file_type']}\nAdded:   {$row['created_at']}\n\n---\n\n{$row['content']}";
                break;

            case 'entities':
                $row = $db->query("SELECT canonical_name, entity_type, confidence FROM entities WHERE id = {$id}")->fetch(PDO::FETCH_ASSOC);
                if (!$row) { echo json_encode(['label' => "Entity #{$id}", 'text' => '(record not found)']); exit; }
                $label = $row['canonical_name'];
                $text  = "Name:        {$row['canonical_name']}\nType:        {$row['entity_type']}\nConfidence:  " . round(((float)$row['confidence']) * 100) . '%';
                break;

            case 'relationships':
                $row = $db->query("
                    SELECT r.relation_type, r.strength, r.context,
                           COALESCE(e1.canonical_name, r.from_entity) AS entity_a,
                           COALESCE(e2.canonical_name, r.to_entity)   AS entity_b
                    FROM relationships r
                    LEFT JOIN entities e1 ON e1.id = r.from_entity_id
                    LEFT JOIN entities e2 ON e2.id = r.to_entity_id
                    WHERE r.id = {$id}
                ")->fetch(PDO::FETCH_ASSOC);
                if (!$row) { echo json_encode(['label' => "Relationship #{$id}", 'text' => '(record not found)']); exit; }
                $label = "{$row['entity_a']} → {$row['relation_type']} → {$row['entity_b']}";
                $text  = "Entity A:     {$row['entity_a']}\nRelationship: {$row['relation_type']}\nEntity B:     {$row['entity_b']}\nStrength:     " . round(((float)$row['strength']) * 100) . "%\n\nContext:\n{$row['context']}";
                break;

            case 'memory_ingest':
                $row = $db->query("SELECT session_title AS session_label, source_ai AS platform, project_tag, word_count, created_at, raw_transcript AS raw_text FROM memory_ingest WHERE id = {$id}")->fetch(PDO::FETCH_ASSOC);
                if (!$row) { echo json_encode(['label' => "Session #{$id}", 'text' => '(record not found)']); exit; }
                $label = $row['session_label'] ?: "Session #{$id}";
                $meta  = "Session:  {$row['session_label']}\nPlatform: {$row['platform']}\nProject:  {$row['project_tag']}\nWords:    {$row['word_count']}\nDate:     {$row['created_at']}\n\n---\n\n";
                $text  = $meta . $row['raw_text'];
                break;

            default:
                echo json_encode(['label' => $key, 'text' => "(unknown MySQL type: {$type})"]);
                exit;
        }

        echo json_encode(['label' => $label, 'text' => $text]);

    } catch (Exception $e) {
        error_log('search_load: ' . $e->getMessage());
        echo json_encode(['label' => $key, 'text' => '(could not load this record — details are in the server error log)']);
    }

    exit;
}

// ── Unknown source ────────────────────────────────────────────────────────────

echo json_encode(['label' => $ref, 'text' => '(unrecognised source: ' . $source . ')']);
exit;