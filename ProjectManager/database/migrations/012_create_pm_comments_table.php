<?php

declare(strict_types=1);

use App\Database\Connection;

$pdo = Connection::get();

$sql = "
CREATE TABLE IF NOT EXISTS pm_comments (

    id INT AUTO_INCREMENT PRIMARY KEY,

    task_id INT NOT NULL,

    user_id INT NOT NULL,

    body TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_pm_comments_task_id (task_id),

    CONSTRAINT fk_pm_comments_task
        FOREIGN KEY (task_id)
        REFERENCES pm_tasks(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_pm_comments_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$pdo->exec($sql);