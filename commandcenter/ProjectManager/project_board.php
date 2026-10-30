<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Models\Task;

$projectRepository = new ProjectRepository();
$taskRepository = new TaskRepository();

$projectId = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;
$project = $projectId ? $projectRepository->find($projectId) : null;
$view = $_GET['view'] ?? 'kanban';

$error = null;

if (!$project) {
    http_response_code(404);
    echo "Project not found. <a href='projects_dashboard.php' style='color:#F4E185;'>Back to Projects</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_task') {

    $title = trim((string)($_POST['title'] ?? ''));

    if ($title === '') {
        $error = 'Task title is required.';
    } else {
        $task = new Task([
            'project_id' => $projectId,
            'title' => $title,
            'detail' => trim((string)($_POST['detail'] ?? '')),
            'status' => 'Backlog',
            'priority' => 2,
            'due_date' => trim((string)($_POST['due_date'] ?? '')) ?: null,
        ]);

        try {
            $taskRepository->create($task);
        } catch (\Throwable $e) {
            $error = 'Could not create task: ' . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'move_task') {

    $taskId = (int)($_POST['task_id'] ?? 0);
    $newStatus = trim((string)($_POST['new_status'] ?? ''));

    $task = $taskRepository->find($taskId);

    if ($task && $newStatus !== '') {
        $task->setStatus($newStatus);
        $taskRepository->update($task);
    }

    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

$allTasks = $taskRepository->findByProject($projectId);

$columns = ['Backlog', 'In Progress', 'Blocked', 'Done'];
$grouped = array_fill_keys($columns, []);
foreach ($allTasks as $task) {
    $status = $task->getStatus();
    if (!isset($grouped[$status])) { $grouped[$status] = []; }
    $grouped[$status][] = $task;
}

$calMonth = isset($_GET['month']) ? (string)$_GET['month'] : date('Y-m');
$calTimestamp = strtotime($calMonth . '-01');
$daysInMonth = (int)date('t', $calTimestamp);
$firstWeekday = (int)date('w', $calTimestamp);

$tasksByDate = [];
foreach ($allTasks as $task) {
    $due = $task->getDueDate();
    if ($due) {
        $day = substr($due, 0, 10);
        $tasksByDate[$day][] = $task;
    }
}

$prevMonth = date('Y-m', strtotime($calMonth . '-01 -1 month'));
$nextMonth = date('Y-m', strtotime($calMonth . '-01 +1 month'));

function view_link(int $projectId, string $view, string $month): string {
    return "project_board.php?project_id={$projectId}&view={$view}" . ($view === 'calendar' ? "&month={$month}" : "");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LEGAiSEE — <?= htmlspecialchars($project->getName()) ?></title>
<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: 'Segoe UI', system-ui, sans-serif;
        background: #0a0a0c;
        color: #CDAD69;
        padding: 32px 24px;
    }
    a { color: #89612B; text-decoration: none; font-size: 13px; }
    a:hover { color: #F4E185; }
    h1 { color: #F4E185; font-weight: 600; margin: 10px 0 4px; }
    .subtitle { color: #89612B; margin-bottom: 20px; }
    .tabs {
        display: flex;
        gap: 6px;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(230, 194, 86, 0.2);
    }
    .tab {
        padding: 8px 18px;
        color: #89612B;
        border-radius: 8px 8px 0 0;
        font-size: 13px;
        font-weight: 600;
    }
    .tab.active {
        color: #F4E185;
        background: rgba(230, 194, 86, 0.1);
        border: 1px solid rgba(230, 194, 86, 0.25);
        border-bottom: none;
    }
    .toolbar { display: flex; gap: 12px; align-items: center; margin-bottom: 24px; }
    .toolbar input[type=text] {
        flex: 1;
        background: rgba(0,0,0,0.4);
        border: 1px solid rgba(230, 194, 86, 0.3);
        border-radius: 6px;
        color: #F4E185;
        padding: 10px 12px;
        font-size: 14px;
    }
    .toolbar input[type=date] {
        background: rgba(0,0,0,0.4);
        border: 1px solid rgba(230, 194, 86, 0.3);
        border-radius: 6px;
        color: #F4E185;
        padding: 10px 12px;
        font-size: 14px;
    }
    .toolbar button {
        padding: 10px 18px;
        border-radius: 20px;
        border: 1px solid rgba(230, 194, 86, 0.4);
        background: rgba(230, 194, 86, 0.12);
        color: #F4E185;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }
    .toolbar button:hover { background: rgba(230, 194, 86, 0.2); }
    .msg {
        padding: 10px 12px; border-radius: 6px; margin-bottom: 16px;
        background: rgba(200, 60, 60, 0.15); border: 1px solid rgba(200, 60, 60, 0.4);
        color: #e8a0a0; font-size: 14px;
    }

    .board { display: flex; gap: 18px; overflow-x: auto; align-items: flex-start; }
    .column {
        background: linear-gradient(180deg, rgba(24,24,26,0.85), rgba(10,10,12,0.75));
        border: 1px solid rgba(230, 194, 86, 0.2);
        border-radius: 10px; width: 260px; flex-shrink: 0; min-height: 120px;
    }
    .column-header {
        padding: 12px 14px; font-weight: 600; color: #F4E185;
        border-bottom: 1px solid rgba(230, 194, 86, 0.15);
        display: flex; justify-content: space-between;
    }
    .column-count { color: #89612B; font-weight: 400; }
    .column-body { padding: 10px; min-height: 60px; }
    .task-card {
        background: rgba(0,0,0,0.35);
        border: 1px solid rgba(230, 194, 86, 0.15);
        border-radius: 8px; padding: 10px 12px; margin-bottom: 10px; cursor: grab;
    }
    .task-card:active { cursor: grabbing; }
    .task-title { color: #F4E185; font-size: 14px; font-weight: 500; }
    .task-detail { color: #999; font-size: 12px; margin-top: 4px; }
    .task-due { color: #89612B; font-size: 11px; margin-top: 4px; }
    .column-body.drag-over { background: rgba(230, 194, 86, 0.06); border-radius: 8px; }
    .empty-col { color: #555; font-size: 12px; font-style: italic; padding: 8px 4px; }

    table { width: 100%; border-collapse: collapse; }
    th {
        text-align: left; color: #89612B; font-size: 12px; text-transform: uppercase;
        padding: 10px 12px; border-bottom: 1px solid rgba(230, 194, 86, 0.2);
    }
    td {
        padding: 12px; border-bottom: 1px solid rgba(230, 194, 86, 0.08);
        color: #CDAD69; font-size: 14px;
    }
    td.list-title { color: #F4E185; font-weight: 500; }
    .status-pill {
        font-size: 11px; padding: 3px 10px; border-radius: 12px;
        background: rgba(230, 194, 86, 0.1); border: 1px solid rgba(230, 194, 86, 0.3);
        color: #F4E185;
    }

    .cal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
    .cal-header a { font-size: 20px; padding: 4px 12px; }
    .cal-month-label { color: #F4E185; font-weight: 600; font-size: 16px; }
    .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
    .cal-daylabel { color: #89612B; font-size: 11px; text-align: center; padding-bottom: 4px; }
    .cal-cell {
        min-height: 90px;
        background: linear-gradient(180deg, rgba(24,24,26,0.6), rgba(10,10,12,0.5));
        border: 1px solid rgba(230, 194, 86, 0.12);
        border-radius: 6px;
        padding: 6px;
    }
    .cal-cell.empty { background: transparent; border: none; }
    .cal-daynum { color: #89612B; font-size: 11px; margin-bottom: 4px; }
    .cal-task {
        background: rgba(230, 194, 86, 0.12);
        color: #F4E185;
        font-size: 11px;
        padding: 3px 6px;
        border-radius: 4px;
        margin-bottom: 3px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
</head>
<body>

<a href="projects_dashboard.php">&larr; All Projects</a>
<h1><?= htmlspecialchars($project->getName()) ?></h1>
<div class="subtitle"><?= htmlspecialchars($project->getDescription() ?: 'No description') ?></div>

<div class="tabs">
    <a class="tab <?= $view === 'kanban' ? 'active' : '' ?>" href="<?= view_link($projectId, 'kanban', $calMonth) ?>">Kanban</a>
    <a class="tab <?= $view === 'list' ? 'active' : '' ?>" href="<?= view_link($projectId, 'list', $calMonth) ?>">List</a>
    <a class="tab <?= $view === 'calendar' ? 'active' : '' ?>" href="<?= view_link($projectId, 'calendar', $calMonth) ?>">Calendar</a>
</div>

<?php if ($error): ?>
    <div class="msg"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="toolbar">
    <form method="POST" style="display:flex; gap:12px; flex:1;">
        <input type="hidden" name="action" value="create_task">
        <input type="text" name="title" placeholder="New task title..." required>
        <input type="date" name="due_date">
        <button type="submit">Add Task</button>
    </form>
</div>

<?php if ($view === 'kanban'): ?>

    <div class="board">
        <?php foreach ($columns as $status): ?>
            <div class="column">
                <div class="column-header">
                    <span><?= htmlspecialchars($status) ?></span>
                    <span class="column-count"><?= count($grouped[$status]) ?></span>
                </div>
                <div class="column-body" data-status="<?= htmlspecialchars($status) ?>">
                    <?php if (empty($grouped[$status])): ?>
                        <div class="empty-col">No tasks</div>
                    <?php endif; ?>
                    <?php foreach ($grouped[$status] as $task): ?>
                        <div class="task-card" draggable="true" data-task-id="<?= $task->getId() ?>">
                            <div class="task-title"><?= htmlspecialchars($task->getTitle()) ?></div>
                            <?php if ($task->getDetail()): ?>
                                <div class="task-detail"><?= htmlspecialchars($task->getDetail()) ?></div>
                            <?php endif; ?>
                            <?php if ($task->getDueDate()): ?>
                                <div class="task-due">Due <?= htmlspecialchars(substr($task->getDueDate(), 0, 10)) ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
    document.querySelectorAll('.task-card').forEach(function (card) {
        card.addEventListener('dragstart', function (e) {
            e.dataTransfer.setData('text/plain', card.dataset.taskId);
        });
    });
    document.querySelectorAll('.column-body').forEach(function (col) {
        col.addEventListener('dragover', function (e) { e.preventDefault(); col.classList.add('drag-over'); });
        col.addEventListener('dragleave', function () { col.classList.remove('drag-over'); });
        col.addEventListener('drop', function (e) {
            e.preventDefault();
            col.classList.remove('drag-over');
            var taskId = e.dataTransfer.getData('text/plain');
            var newStatus = col.dataset.status;
            fetch(window.location.pathname + window.location.search, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=move_task&task_id=' + encodeURIComponent(taskId) + '&new_status=' + encodeURIComponent(newStatus)
            }).then(function () { window.location.reload(); });
        });
    });
    </script>

<?php elseif ($view === 'list'): ?>

    <table>
        <tr>
            <th>Task</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Due Date</th>
        </tr>
        <?php if (empty($allTasks)): ?>
            <tr><td colspan="4" style="color:#555; font-style:italic;">No tasks yet.</td></tr>
        <?php endif; ?>
        <?php foreach ($allTasks as $task): ?>
            <tr>
                <td class="list-title"><?= htmlspecialchars($task->getTitle()) ?></td>
                <td><span class="status-pill"><?= htmlspecialchars($task->getStatus()) ?></span></td>
                <td><?= htmlspecialchars((string)$task->getPriority()) ?></td>
                <td><?= htmlspecialchars($task->getDueDate() ? substr($task->getDueDate(), 0, 10) : '—') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php elseif ($view === 'calendar'): ?>

    <div class="cal-header">
        <a href="<?= view_link($projectId, 'calendar', $prevMonth) ?>">&larr;</a>
        <span class="cal-month-label"><?= date('F Y', $calTimestamp) ?></span>
        <a href="<?= view_link($projectId, 'calendar', $nextMonth) ?>">&rarr;</a>
    </div>

    <div class="cal-grid">
        <?php foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d): ?>
            <div class="cal-daylabel"><?= $d ?></div>
        <?php endforeach; ?>

        <?php for ($i = 0; $i < $firstWeekday; $i++): ?>
            <div class="cal-cell empty"></div>
        <?php endfor; ?>

        <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
            <?php $dateKey = date('Y-m-d', strtotime("{$calMonth}-" . str_pad((string)$day, 2, '0', STR_PAD_LEFT))); ?>
            <div class="cal-cell">
                <div class="cal-daynum"><?= $day ?></div>
                <?php foreach ($tasksByDate[$dateKey] ?? [] as $task): ?>
                    <div class="cal-task"><?= htmlspecialchars($task->getTitle()) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endfor; ?>
    </div>

<?php endif; ?>

</body>
</html>