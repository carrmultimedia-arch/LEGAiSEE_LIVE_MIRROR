<?php

declare(strict_types=1);

namespace App\Models;

class Milestone
{
    private ?int $id = null;

    private int $projectId;

    private string $name;

    private string $description;

    private string $status = 'pending';

    private ?string $dueDate = null;

    private ?string $completedAt = null;

    private string $createdAt = '';

    public function __construct(int $projectId, string $name, string $description = '')
    {
        $this->projectId = $projectId;
        $this->name = trim($name);
        $this->description = trim($description);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = trim($name);

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = trim($description);

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    public function setDueDate(?string $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getCompletedAt(): ?string
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?string $completedAt): self
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->projectId,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->dueDate,
            'completed_at' => $this->completedAt,
            'created_at' => $this->createdAt,
        ];
    }
}