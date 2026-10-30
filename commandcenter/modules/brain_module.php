<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| BRAIN MODULE
|--------------------------------------------------------------------------
| SYSTEM INTELLIGENCE INSPECTION LAYER
|--------------------------------------------------------------------------
| WO-19: added a "Run Brain" action. POSTing back to this same
| module (?module=brain, same pattern dig_review_module.php and
| vault_module.php already use) with brain_action=run and a file
| name runs the real orchestrator pipeline in-process and returns
| JSON. Everything below the POST handler is the original
| read-only inspection logic, unchanged.
|--------------------------------------------------------------------------
*/

// ── Handle "Run Brain" action (AJAX-friendly POST) ──────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['brain_action'] ?? '') === 'run') {
    header('Content-Type: application/json');

    require_once __DIR__ . '/../api/brain_orchestrator.php';

    $file = $_POST['file'] ?? '';
    $result = run_brain_on_file($file, $_SESSION['brain_node_id'] ?? null);

    echo json_encode($result);
    exit;
}

$modules = require __DIR__ . '/../kernel/module_registry.php';

$dataRoot = __DIR__ . '/../data';
$normalizedRoot = __DIR__ . '/../normalized';

function dir_summary(string $path): array
{
    if (!is_dir($path)) {
        return [
            'exists' => false,
            'path' => $path,
            'count' => 0
        ];
    }

    $items = array_values(array_filter(scandir($path), function ($f) {
        return $f !== '.' && $f !== '..';
    }));

    return [
        'exists' => true,
        'path' => $path,
        'count' => count($items)
    ];
}

$brain = [

    'system' => [
        'status' => 'ACTIVE',
        'mode' => 'INSPECTION_ONLY',
        'shell' => 'CONNECTED'
    ],

    'modules' => [
        'registered_count' => count($modules),
        'active_modules' => array_keys($modules)
    ],

    'data_layer' => [
        'files' => dir_summary($dataRoot . '/files'),
        'clients' => dir_summary($dataRoot . '/clients'),
        'cases' => dir_summary($dataRoot . '/cases'),
        'memory' => dir_summary($dataRoot . '/memory'),
    ],

    'engines' => [
        'cross_case_engine' => file_exists(__DIR__ . '/../system/cross_case_engine.php'),
        'insight_engine' => file_exists(__DIR__ . '/../system/system_insight_engine.php'),
        'decision_engine' => file_exists(__DIR__ . '/../system/decision_engine_v2.php'),
        'recommendation_engine' => file_exists(__DIR__ . '/../system/system_recommendation_engine.php'),
        'policy_engine' => file_exists(__DIR__ . '/../system/policy_enforcement_engine.php'),
    ],

    'health' => [
        'data_layer_ready' =>
            is_dir($dataRoot . '/files') &&
            is_dir($dataRoot . '/clients') &&
            is_dir($dataRoot . '/cases') &&
            is_dir($dataRoot . '/memory')
    ]
];

// Files available to run the brain against
$normalizedFiles = [];
if (is_dir($normalizedRoot)) {
    $normalizedFiles = array_values(array_filter(scandir($normalizedRoot), function ($f) use ($normalizedRoot) {
        return $f !== '.' && $f !== '..' && is_file($normalizedRoot . '/' . $f);
    }));
}

?>

<div class="inspector">

```
<div class="inspector-card">
    <div class="inspector-title">System Status</div>
    <div class="inspector-meta"><?= htmlspecialchars($brain['system']['status']) ?></div>
    <pre class="inspector-content"><?= htmlspecialchars(json_encode($brain['system'], JSON_PRETTY_PRINT)) ?></pre>
</div>

<div class="inspector-card">
    <div class="inspector-title">Module Registry</div>
    <div class="inspector-meta"><?= count($modules) ?> modules</div>
    <pre class="inspector-content"><?= htmlspecialchars(json_encode($brain['modules'], JSON_PRETTY_PRINT)) ?></pre>
</div>

<div class="inspector-card">
    <div class="inspector-title">Data Layer</div>
    <div class="inspector-meta"><?= $brain['health']['data_layer_ready'] ? 'READY' : 'INCOMPLETE' ?></div>
    <pre class="inspector-content"><?= htmlspecialchars(json_encode($brain['data_layer'], JSON_PRETTY_PRINT)) ?></pre>
</div>

<div class="inspector-card">
    <div class="inspector-title">Engines</div>
    <div class="inspector-meta">system scan</div>
    <pre class="inspector-content"><?= htmlspecialchars(json_encode($brain['engines'], JSON_PRETTY_PRINT)) ?></pre>
</div>

<div class="inspector-card" id="brainRunCard">
    <div class="inspector-title">Run Brain Analysis</div>
    <div class="inspector-meta">Live model call — uses real API usage/tokens</div>

    <?php if (empty($normalizedFiles)): ?>
        <p style="opacity:.7">No files found in /normalized — ingest something first.</p>
    <?php else: ?>
        <select id="brainFileSelect" style="width:100%;margin:8px 0;padding:6px;">
            <?php foreach ($normalizedFiles as $f): ?>
                <option value="<?= htmlspecialchars($f) ?>"><?= htmlspecialchars($f) ?></option>
            <?php endforeach; ?>
        </select>
        <button id="brainRunBtn" type="button">Run Brain</button>
    <?php endif; ?>

    <pre id="brainRunOutput" class="inspector-content" style="display:none;"></pre>
</div>
```

</div>

<script>
(function(){
    var btn = document.getElementById('brainRunBtn');
    if (!btn) return;

    btn.addEventListener('click', function(){
        var file = document.getElementById('brainFileSelect').value;
        var out = document.getElementById('brainRunOutput');

        btn.disabled = true;
        btn.textContent = 'Running...';
        out.style.display = 'block';
        out.textContent = 'Calling the brain pipeline...';

                fetch('?module=brain', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'brain_action=run&file=' + encodeURIComponent(file)
        })
        .then(function(r){ return r.text(); })
        .then(function(raw){
            try {
                out.textContent = JSON.stringify(JSON.parse(raw), null, 2);
            } catch (e) {
                out.textContent = '--- RAW RESPONSE (not valid JSON) ---\n\n' + raw;
            }
        })
        .catch(function(err){
            out.textContent = 'Request failed: ' + err;
        })
        .finally(function(){
            btn.disabled = false;
            btn.textContent = 'Run Brain';
        });

    });
})();
</script>