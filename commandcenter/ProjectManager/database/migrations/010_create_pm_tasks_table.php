<?php

declare(strict_types=1);

use App\Database\Connection;

$pdo = Connection::get();

$sql = "
CREATE TABLE IF NOT EXISTS pm_tasks (

    id INT AUTO_INCREMENT PRIMARY KEY,

    project_id INT NOT NULL,

    title VARCHAR(255) NOT NULL,

    detail TEXT NULL,

    status VARCHAR(50) NOT NULL DEFAULT 'Backlog',

    priority INT NOT NULL DEFAULT 2,

    due_date DATE NULL,

    blocked_reason VARCHAR(255) NULL,

    source_ingest_id INT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_pm_tasks_project_id (project_id),

    INDEX idx_pm_tasks_status (status),

    CONSTRAINT fk_pm_tasks_project
        FOREIGN KEY (project_id)
        REFERENCES pm_projects(id)
        ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$pdo->exec($sql);