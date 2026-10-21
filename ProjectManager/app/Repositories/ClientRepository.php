<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\Database;
use App\Models\Client;


class ClientRepository
{
    private Database $database;

    private const ATTR_KEYS = ['company', 'email', 'phone', 'notes', 'owner_id'];


    public function __construct()
    {
        $this->database = new Database();
    }


    private function attachAttributes(array $row): array
    {
        $attrs = $this->database->query(
            "SELECT attribute_key, attribute_value FROM node_details WHERE node_id = :node_id",
            ['node_id' => $row['node_id']]
        );
        foreach ($attrs as $a) {
            $row[$a['attribute_key']] = $a['attribute_value'];
        }
        $row['id'] = $row['node_id']; // Client model expects 'id'
        return $row;
    }


    private function saveAttributes(int $nodeId, Client $client): void
    {
        $values = [
            'company' => $client->getCompany(),
            'email' => $client->getEmail(),
            'phone' => $client->getPhone(),
            'notes' => $client->getNotes(),
            'owner_id' => $client->getOwnerId(),
        ];

        foreach ($values as $key => $value) {
            $this->database->execute(
                "
                INSERT INTO node_details (node_id, attribute_key, attribute_value)
                VALUES (:node_id, :attribute_key, :attribute_value)
                ON DUPLICATE KEY UPDATE attribute_value = :attribute_value2, updated_at = CURRENT_TIMESTAMP
                ",
                [
                    'node_id' => $nodeId,
                    'attribute_key' => $key,
                    'attribute_value' => $value,
                    'attribute_value2' => $value,
                ]
            );
        }
    }


    public function all(): array
    {
        $rows = $this->database->query(
            "
            SELECT node_id, name, status, created_at, updated_at
            FROM tree_nodes
            WHERE node_type = 'client'
            ORDER BY name ASC
            "
        );

        $clients = [];

        foreach ($rows as $row) {
            $clients[] = new Client($this->attachAttributes($row));
        }

        return $clients;
    }


    public function find(int $id): ?Client
    {
        $rows = $this->database->query(
            "
            SELECT node_id, name, status, created_at, updated_at
            FROM tree_nodes
            WHERE node_id = :id AND node_type = 'client'
            LIMIT 1
            ",
            [
                'id' => $id
            ]
        );

        if (empty($rows)) {
            return null;
        }

        return new Client($this->attachAttributes($rows[0]));
    }


    public function create(Client $client): int
    {
        $this->database->execute(
            "
            INSERT INTO tree_nodes
            (
                name,
                node_type,
                status,
                created_at,
                updated_at
            )
            VALUES
            (
                :name,
                'client',
                'active',
                CURRENT_TIMESTAMP,
                CURRENT_TIMESTAMP
            )
            ",
            [
                'name' => $client->getName(),
            ]
        );

        $nodeId = (int)$this->database->lastInsertId();
        $this->saveAttributes($nodeId, $client);

        return $nodeId;
    }


    public function update(Client $client): bool
    {
        $result = $this->database->execute(
            "
            UPDATE tree_nodes
            SET
                name = :name,
                updated_at = CURRENT_TIMESTAMP
            WHERE node_id = :id
            ",
            [
                'id' => $client->getId(),
                'name' => $client->getName(),
            ]
        );

        $this->saveAttributes($client->getId(), $client);

        return $result;
    }


    public function delete(int $id): bool
    {
        $this->database->execute(
            "DELETE FROM node_details WHERE node_id = :id",
            ['id' => $id]
        );

        return $this->database->execute(
            "
            DELETE FROM tree_nodes
            WHERE node_id = :id AND node_type = 'client'
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
            FROM tree_nodes
            WHERE node_type = 'client'
            "
        );

        return (int)$rows[0]['total'];
    }
}