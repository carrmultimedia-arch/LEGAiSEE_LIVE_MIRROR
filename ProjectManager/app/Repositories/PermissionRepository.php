<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use App\Models\Permission;

class PermissionRepository
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function all(): array
    {
        $rows = $this->database->query("
            SELECT *
            FROM permissions
            ORDER BY name ASC
        ");

        $permissions = [];

        foreach ($rows as $row) {
            $permissions[] = new Permission($row);
        }

        return $permissions;
    }

    public function find(int $id): ?Permission
    {
        $rows = $this->database->query("
            SELECT *
            FROM permissions
            WHERE id = :id
            LIMIT 1
        ", [
            'id' => $id
        ]);

        if (!$rows) {
            return null;
        }

        return new Permission($rows[0]);
    }

    public function findByName(string $name): ?Permission
    {
        $rows = $this->database->query("
            SELECT *
            FROM permissions
            WHERE name = :name
            LIMIT 1
        ", [
            'name' => $name
        ]);

        if (!$rows) {
            return null;
        }

        return new Permission($rows[0]);
    }

    public function create(Permission $permission): int
    {
        $this->database->execute("
            INSERT INTO permissions
            (
                name,
                description,
                created_at,
                updated_at
            )
            VALUES
            (
                :name,
                :description,
                NOW(),
                NOW()
            )
        ", [
            'name'        => $permission->getName(),
            'description' => $permission->getDescription()
        ]);

        return (int)$this->database->lastInsertId();
    }

    public function update(Permission $permission): bool
    {
        return $this->database->execute("
            UPDATE permissions
            SET
                name = :name,
                description = :description,
                updated_at = NOW()
            WHERE id = :id
        ", [
            'id'          => $permission->getId(),
            'name'        => $permission->getName(),
            'description' => $permission->getDescription()
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->database->execute("
            DELETE FROM permissions
            WHERE id = :id
        ", [
            'id' => $id
        ]);
    }

    public function count(): int
    {
        $rows = $this->database->query("
            SELECT COUNT(*) AS total
            FROM permissions
        ");

        return (int)$rows[0]['total'];
    }
}