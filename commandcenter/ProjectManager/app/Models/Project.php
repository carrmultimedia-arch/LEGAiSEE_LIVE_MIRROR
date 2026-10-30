<?php

declare(strict_types=1);

namespace App\Models;

class Project
{
    private ?int $id = null;

    private string $uuid = '';

    private string $name = '';

    private string $description = '';

    private string $status = 'active';

    private string $color = '#2563eb';

    private int $ownerId = 0;

    private ?string $startDate = null;

    private ?string $dueDate = null;

    private string $createdAt = '';

    private string $updatedAt = '';

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public function fill(array $data): void
    {
        $this->id = isset($data['id']) ? (int)$data['id'] : $this->id;
        $this->uuid = trim((string)($data['uuid'] ?? $this->uuid));
        $this->name = trim((string)($data['name'] ?? $this->name));
        $this->description = trim((string)($data['description'] ?? $this->description));
        $this->status = trim((string)($data['status'] ?? $this->status));
        $this->color = trim((string)($data['color'] ?? $this->color));
        $this->ownerId = isset($data['owner_id']) ? (int)$data['owner_id'] : $this->ownerId;
        $this->startDate = array_key_exists('start_date', $data) ? $data['start_date'] : $this->startDate;
        $this->dueDate = array_key_exists('due_date', $data) ? $data['due_date'] : $this->dueDate;
        $this->createdAt = (string)($data['created_at'] ?? $this->createdAt);
        $this->updatedAt = (string)($data['updated_at'] ?? $this->updatedAt);
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getUuid(): string { return $this->uuid; }
    public function setUuid(string $uuid): self { $this->uuid = $uuid; return $this; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = trim($name); return $this; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = trim($description); return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = trim($status); return $this; }

    public function getColor(): string { return $this->color; }
    public function setColor(string $color): self { $this->color = trim($color); return $this; }

    public function getOwnerId(): int { return $this->ownerId; }
    public function setOwnerId(int $ownerId): self { $this->ownerId = $ownerId; return $this; }

    public function getStartDate(): ?string { return $this->startDate; }
    public function setStartDate(?string $startDate): self { $this->startDate = $startDate; return $this; }

    public function getDueDate(): ?string { return $this->dueDate; }
    public function setDueDate(?string $dueDate): self { $this->dueDate = $dueDate; return $this; }

    public function getCreatedAt(): string { return $this->createdAt; }
    public function getUpdatedAt(): string { return $this->updatedAt; }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'color' => $this->color,
            'owner_id' => $this->ownerId,
            'start_date' => $this->startDate,
            'due_date' => $this->dueDate,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}