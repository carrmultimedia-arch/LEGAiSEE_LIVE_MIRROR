<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use App\Models\Comment;

class CommentRepository
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function all(): array
    {
        $rows = $this->database->query(
            "
            SELECT *
            FROM pm_comments
            ORDER BY created_at ASC, id ASC
            "
        );

        $comments = [];

        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }

        return $comments;
    }

    public function find(int $id): ?Comment
    {
        $rows = $this->database->query(
            "
            SELECT *
            FROM pm_comments
            WHERE id = :id
            LIMIT 1
            ",
            [
                'id' => $id
            ]
        );

        if (empty($rows)) {
            return null;
        }

        return new Comment($rows[0]);
    }

    public function findByTask(int $taskId): array
    {
        $rows = $this->database->query(
            "
            SELECT *
            FROM pm_comments
            WHERE task_id = :task_id
            ORDER BY created_at ASC, id ASC
            ",
            [
                'task_id' => $taskId
            ]
        );

        $comments = [];

        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }

        return $comments;
    }

    public function create(Comment $comment): int
    {
        $this->database->execute(
            "
            INSERT INTO pm_comments
            (
                task_id,
                user_id,
                body,
                created_at,
                updated_at
            )
            VALUES
            (
                :task_id,
                :user_id,
                :body,
                CURRENT_TIMESTAMP,
                CURRENT_TIMESTAMP
            )
            ",
            [
                'task_id' => $comment->getTaskId(),
                'user_id' => $comment->getUserId(),
                'body' => $comment->getBody()
            ]
        );

        return (int)$this->database->lastInsertId();
    }

    public function update(Comment $comment): bool
    {
        return $this->database->execute(
            "
            UPDATE pm_comments
            SET
                body = :body,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id
            ",
            [
                'id' => $comment->getId(),
                'body' => $comment->getBody()
            ]
        );
    }

    public function delete(int $id): bool
    {
        return $this->database->execute(
            "
            DELETE FROM pm_comments
            WHERE id = :id
            ",
            [
                'id' => $id
            ]
        );
    }

    public function count(): int
    {
        $rows = $this->database->query(
            "
            SELECT COUNT(*) AS total
            FROM pm_comments
            "
        );

        return (int)$rows[0]['total'];
    }
}