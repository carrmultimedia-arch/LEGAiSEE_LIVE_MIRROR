<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use App\Models\Project;
use App\Models\User;

$projectRepository = new ProjectRepository();
$userRepository = new UserRepository();

/*
 * There is no login system yet, so there is no "current user" to
 * own a project. Rather than requiring a manual database row, the
 * app creates one default owner automatically the first time this
 * page ever runs, and reuses it from then on. Once real login
 * exists, swap this for the logged-in user's id.
 */
function get_or_create_default_owner(UserRepository $userRepository): int
{
    $existing = $userRepository->all();

    if (!empty($existing)) {
        return $existing[0]->getId();
    }

    $user = new User([
        'name' => 'John Carr',
        'email' => 'admin@legaisee.local',
        'active' => true,
    ]);

    return $userRepository->create($user);
}

$defaultOwnerId = get_or_create_default_owner($userRepository);

$error = null;
$success = null;

// Handle "add project" form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_project') {

    $name = trim((string)($_POST['name'] ?? ''));
    $description = trim((string)($_POST['description'] ?? ''));
    $color = trim((string)($_POST['color'] ?? '#CDAD69'));
    $startDate = trim((string)($_POST['start_date'] ?? ''));
    $dueDate = trim((string)($_POST['due_date'] ?? ''));

    if ($name === '') {
        $error = 'Project name is required.';
    } else {

        $uuidBytes = random_bytes(16);
        $uuidBytes[6] = chr(ord($uuidBytes[6]) & 0x0f | 0x40);
        $uuidBytes[8] = chr(ord($uuidBytes[8]) & 0x3f | 0x80);
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($uuidBytes), 4));

        $project = new Project([
            'uuid' => $uuid,
            'name' => $name,
            'description' => $description,
            'status' => 'active',
            'color' => $color,
            'owner_id' => $defaultOwnerId,
            'start_date' => $startDate !== '' ? $startDate : null,
            'due_date' => $dueDate !== '' ? $dueDate : null,
        ]);

        try {
            $projectRepository->create($project);
            $success = 'Project created.';
        } catch (\Throwable $e) {
            $error = 'Could not create project: ' . $e->getMessage();
        }
    }
}

$projects = $projectRepository->all();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LEGAiSEE — Projects</title>
<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: 'Segoe UI', system-ui, sans-serif;
        background: #0a0a0c;
        color: #CDAD69;
        padding: 40px 24px;
    }
    h1 {
        color: #F4E185;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .subtitle {
        color: #89612B;
        margin-bottom: 32px;
    }
    .layout {
        display: flex;
        gap: 32px;
        align-items: flex-start;
        flex-wrap: wrap;
    }
    .panel {
        background: linear-gradient(180deg, rgba(24,24,26,0.85), rgba(10,10,12,0.75));
        border: 1px solid rgba(230, 194, 86, 0.2);
        border-radius: 10px;
        padding: 24px;
    }
    .form-panel {
        width: 320px;
        flex-shrink: 0;
    }
    .list-panel {
        flex: 1;
        min-width: 320px;
    }
    label {
        display: block;
        font-size: 13px;
        color: #CDAD69;
        margin: 14px 0 6px;
    }
    input[type=text], textarea, input[type=color] {
        width: 100%;
        background: rgba(0,0,0,0.4);
        border: 1px solid rgba(230, 194, 86, 0.3);
        border-radius: 6px;
        color: #F4E185;
        padding: 8px 10px;
        font-size: 14px;
        font-family: inherit;
    }
    textarea { resize: vertical; min-height: 70px; }
    button {
        margin-top: 18px;
        width: 100%;
        padding: 10px;
        border-radius: 20px;
        border: 1px solid rgba(230, 194, 86, 0.4);
        background: rgba(230, 194, 86, 0.12);
        color: #F4E185;
        font-weight: 600;
        cursor: pointer;
    }
    button:hover {
        background: rgba(230, 194, 86, 0.2);
    }
    .msg {
        padding: 10px 12px;
        border-radius: 6px;
        margin-bottom: 16px;
        font-size: 14px;
    }
    .msg.error {
        background: rgba(200, 60, 60, 0.15);
        border: 1px solid rgba(200, 60, 60, 0.4);
        color: #e8a0a0;
    }
    .msg.success {
        background: rgba(120, 200, 120, 0.12);
        border: 1px solid rgba(120, 200, 120, 0.35);
        color: #b6e6b6;
    }
    .project-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border-radius: 8px;
        border: 1px solid rgba(230, 194, 86, 0.15);
        margin-bottom: 12px;
    }
    .project-color {
        width: 12px;
        height: 40px;
        border-radius: 4px;
        flex-shrink: 0;
    }
    .project-name {
        color: #F4E185;
        font-weight: 600;
        font-size: 16px;
    }
    .project-desc {
        color: #CDAD69;
        font-size: 13px;
        margin-top: 2px;
    }
    .project-status {
        margin-left: auto;
        font-size: 12px;
        padding: 3px 10px;
        border-radius: 12px;
        background: rgba(230, 194, 86, 0.1);
        border: 1px solid rgba(230, 194, 86, 0.3);
        color: #F4E185;
        text-transform: capitalize;
    }
    .empty {
        color: #666;
        font-style: italic;
    }
</style>
</head>
<body>

<h1>Projects</h1>
<div class="subtitle">LEGAiSEE Project Manager</div>

<div class="layout">

    <div class="panel form-panel">
        <strong style="color:#F4E185;">New Project</strong>

        <?php if ($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="msg success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="action" value="create_project">

            <label>Name</label>
            <input type="text" name="name" required>

            <label>Description</label>
            <textarea name="description"></textarea>

            <label>Color tag</label>
            <input type="color" name="color" value="#CDAD69">

            <label>Start Date</label>
            <input type="text" name="start_date" placeholder="YYYY-MM-DD" onfocus="(this.type='date')">

            <label>Due Date</label>
            <input type="text" name="due_date" placeholder="YYYY-MM-DD" onfocus="(this.type='date')">

            <button type="submit">Create Project</button>
        </form>
    </div>

    <div class="panel list-panel">
        <strong style="color:#F4E185;">All Projects (<?= count($projects) ?>)</strong>
        <div style="margin-top:16px;">

        <?php if (empty($projects)): ?>
            <div class="empty">No projects yet — create one to get started.</div>
        <?php endif; ?>

        <?php foreach ($projects as $project): ?>
            <a href="project_board.php?project_id=<?= $project->getId() ?>" class="project-card" style="text-decoration:none;">
                <div class="project-color" style="background: <?= htmlspecialchars($project->getColor()) ?>;"></div>
                <div>
                    <div class="project-name"><?= htmlspecialchars($project->getName()) ?></div>
                    <?php if ($project->getDescription()): ?>
                        <div class="project-desc"><?= htmlspecialchars($project->getDescription()) ?></div>
                    <?php endif; ?>
                    <?php if ($project->getStartDate() || $project->getDueDate()): ?>
                        <div class="project-desc" style="color:#89612B;">
                            <?= htmlspecialchars($project->getStartDate() ?: '?') ?> &rarr; <?= htmlspecialchars($project->getDueDate() ?: '?') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="project-status"><?= htmlspecialchars($project->getStatus()) ?></div>
            </a>
        <?php endforeach; ?>

        </div>
    </div>

</div>

</body>
</html>