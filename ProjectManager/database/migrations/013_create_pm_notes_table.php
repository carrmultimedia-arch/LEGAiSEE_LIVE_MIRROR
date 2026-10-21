<?php

declare(strict_types=1);

use App\Database\Connection;

$pdo = Connection::get();

$sql = "
CREATE TABLE IF NOT EXISTS pm_notes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    project_id INT NOT NULL,

    user_id INT NOT NULL,

    body TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_pm_notes_project_id (project_id),

    CONSTRAINT fk_pm_notes_project
        FOREIGN KEY (project_id)
        REFERENCES pm_projects(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_pm_notes_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$pdo->exec($sql);