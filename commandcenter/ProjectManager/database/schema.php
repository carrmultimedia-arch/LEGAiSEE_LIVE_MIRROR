<?php

declare(strict_types=1);

return [

    'tables' => [

        'users' => [
            'id',
            'name',
            'email',
            'password_hash',
            'active',
            'created_at',
            'updated_at'
        ],

        'roles' => [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at'
        ],

        'permissions' => [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at'
        ],

        'role_permissions' => [
            'id',
            'role_id',
            'permission_id'
        ],

        'user_roles' => [
            'id',
            'user_id',
            'role_id'
        ],

        // NOTE: prefixed pm_ on every ProjectManager-owned table.
        // This database is shared with the main LEGAiSEE Command Center app,
        // which already has its own unrelated 'projects' and 'tasks' tables
        // (a domain/business registry, not project-management data) —
        // the prefix keeps ProjectManager's schema from ever colliding with it.

        'pm_projects' => [
            'id',
            'uuid',
            'name',
            'description',
            'status',
            'color',
            'owner_id',
            'start_date',
            'due_date',
            'created_at',
            'updated_at'
        ],

        'pm_tasks' => [
            'id',
            'project_id',
            'title',
            'detail',
            'status',
            'priority',
            'due_date',
            'blocked_reason',
            'source_ingest_id',
            'created_at',
            'updated_at'
        ],

        'pm_milestones' => [
            'id',
            'project_id',
            'name',
            'description',
            'status',
            'due_date',
            'completed_at',
            'created_at'
        ],

        'pm_comments' => [
            'id',
            'task_id',
            'user_id',
            'body',
            'created_at',
            'updated_at'
        ],

        'pm_notes' => [
            'id',
            'project_id',
            'user_id',
            'body',
            'created_at',
            'updated_at'
        ],

        'attachments' => [
            'id',
            'entity_type',
            'entity_id',
            'filename',
            'storage_path',
            'mime_type',
            'file_size',
            'uploaded_by',
            'created_at'
        ],

        'activity_log' => [
            'id',
            'user_id',
            'action',
            'entity_type',
            'entity_id',
            'details',
            'created_at'
        ],

        'audit_logs' => [
            'id',
            'user_id',
            'action',
            'details',
            'created_at'
        ]

    ]

];