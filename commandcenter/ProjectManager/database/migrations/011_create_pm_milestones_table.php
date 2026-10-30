<?php

declare(strict_types=1);

use App\Database\Connection;

$pdo = Connection::get();

$sql = "
CREATE TABLE IF NOT EXISTS pm_milestones (

    id INT AUTO_INCREMENT PRIMARY KEY,

    project_id INT NOT NULL,

    name VARCHAR(255) NOT NULL,

    description TEXT NULL,

    status VARCHAR(50) NOT NULL DEFAULT 'pending',

    due_date DATE NULL,

    completed_at TIMESTAMP NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_pm_milestones_project_id (project_id),

    INDEX idx_pm_milestones_status (status),

    CONSTRAINT fk_pm_milestones_project
        FOREIGN KEY (project_id)
        REFERENCES pm_projects(id)
        ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$pdo->exec($sql);