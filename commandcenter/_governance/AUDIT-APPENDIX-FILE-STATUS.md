# Appendix — Per-File Status, commandcenter/

Generated 2026-10-29 by `_governance/tools/audit_scan.py` + `_governance/tools/report_gen.py`.
Static analysis of include/require, function definitions vs call sites, data-layer markers,
and reachability from `shell.php`, `api/*.php` and `cli/*.php`. Every first-party, non-archive
PHP file in the tree appears exactly once.

**Rows:** 347 files · **Storage tiers:** NONE 229, MYSQL 74, JSON 34, MYSQL+JSON 9, SQLITE 1 · **Status:** DEAD 170, REFERENCED-DEAD 64, ORPHAN-WEB 42, ROUTED 33, LIVE-CORE 14, LIVE-ENDPOINT 10, BROKEN 3, DEAD-BUT-WANTED 2, EMPTY 2, UNREGISTERED 2, ORPHAN-INCLUDED 1, LIVE-VIA-WORKER 1, DEAD-CONFIG 1, SHELL-ONLY 1, MOCK 1

Legend — `ROUTED` = loaded by shell.php through `kernel/module_registry.php`; `LIVE-CORE` = in the
`shell.php` include closure; `LIVE-ENDPOINT` = reached from a referenced `api/` or `cli/` script;
`REFERENCED-DEAD` = named by another file that is itself unreachable; `ORPHAN-WEB` = PHP that answers
a URL request but nothing links to it; `DEAD` = no caller, no include, no reference.

| File | Bytes | Lines | Storage | Status | First caller / evidence | Action |
|---|---:|---:|---|---|---|---|
| `Color_Creator.php` | 73,837 | 2241 | NONE | DEAD | `—` | DELETE (verify first) |
| `ExcavationCommand/dashboard.php` | 3,368 | 153 | NONE | REFERENCED-DEAD | `ProjectManager/project_board.php` | DELETE (verify first) |
| `ExcavationCommand/planner.php` | 866 | 39 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `ExcavationCommand/system_index.php` | 1,790 | 67 | JSON | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/auth/login.php` | 908 | 49 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `ProjectManager/api/auth/logout.php` | 803 | 44 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/api/auth/status.php` | 802 | 44 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/api/clients/index.php` | 2,060 | 104 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/comments/index.php` | 2,314 | 114 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/labels/index.php` | 2,078 | 106 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/milestones/index.php` | 2,072 | 104 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/permissions/index.php` | 297 | 15 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/permissions/roles.php` | 291 | 15 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/api/projects/index.php` | 2,048 | 105 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/projects/members.php` | 2,552 | 120 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `ProjectManager/api/tasks/index.php` | 2,308 | 114 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/users/index.php` | 1,793 | 92 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/api/users/show.php` | 781 | 44 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/AuthController.php` | 2,448 | 110 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/ClientController.php` | 2,097 | 101 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/CommentController.php` | 2,509 | 127 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/LabelController.php` | 2,062 | 101 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/MilestoneController.php` | 2,202 | 101 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/ProjectController.php` | 2,678 | 121 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/ProjectMemberController.php` | 2,900 | 133 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/TaskController.php` | 2,398 | 127 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Controllers/UserController.php` | 2,045 | 110 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Core/Application.php` | 1,407 | 76 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Core/Container.php` | 888 | 42 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Core/Database.php` | 862 | 44 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Core/Dispatcher.php` | 1,360 | 83 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Core/ExceptionHandler.php` | 1,008 | 55 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Core/Request.php` | 1,682 | 95 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `ProjectManager/app/Core/Response.php` | 1,384 | 85 | NONE | ORPHAN-INCLUDED | `ExcavationCommand/system_index.php` | DELETE (verify first) |
| `ProjectManager/app/Core/Router.php` | 1,621 | 97 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/ActivityLog.php` | 719 | 36 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Attachment.php` | 4,203 | 216 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Client.php` | 3,471 | 188 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Comment.php` | 2,276 | 125 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Label.php` | 2,473 | 133 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Milestone.php` | 2,698 | 134 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Permission.php` | 1,932 | 104 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Project.php` | 3,760 | 97 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/ProjectMember.php` | 2,334 | 126 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Role.php` | 1,926 | 104 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/Task.php` | 4,653 | 204 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Models/User.php` | 3,111 | 174 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Policies/DocumentPolicy.php` | 533 | 33 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Policies/PermissionPolicy.php` | 359 | 23 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Policies/ProjectPolicy.php` | 613 | 38 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Policies/RolePolicy.php` | 505 | 33 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Policies/TaskPolicy.php` | 594 | 38 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Policies/UserPolicy.php` | 505 | 33 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/app/Repositories/ActivityLogRepository.php` | 1,141 | 52 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/AttachmentRepository.php` | 691 | 35 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/ClientRepository.php` | 4,817 | 195 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/CommentRepository.php` | 3,297 | 154 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/LabelRepository.php` | 3,750 | 163 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/MilestoneRepository.php` | 4,663 | 182 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/PermissionRepository.php` | 2,948 | 132 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/ProjectMemberRepository.php` | 3,874 | 187 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/ProjectRepository.php` | 4,342 | 188 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/RoleRepository.php` | 3,148 | 160 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/TaskRepository.php` | 4,260 | 164 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Repositories/UserRepository.php` | 3,636 | 175 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ProjectManager/app/Services/AuthorizationService.php` | 1,491 | 72 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/bootstrap.php` | 1,266 | 68 | NONE | REFERENCED-DEAD | `ProjectManager/api/auth/login.php` | DELETE (verify first) |
| `ProjectManager/config.php` | 940 | 28 | MYSQL | REFERENCED-DEAD | `ProjectManager/bootstrap.php` | DELETE (dead SQL writer) |
| `ProjectManager/database/connection.php` | 1,194 | 48 | MYSQL | REFERENCED-DEAD | `ProjectManager/database/migrations/001_create_users_table.php` | DELETE (dead SQL writer) |
| `ProjectManager/database/migration.php` | 1,501 | 75 | JSON | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/001_create_users_table.php` | 549 | 19 | NONE | REFERENCED-DEAD | `ProjectManager/database/migration.php` | DELETE (verify first) |
| `ProjectManager/database/migrations/002_create_roles_table.php` | 432 | 17 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/003_create_permissions_table.php` | 438 | 17 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/004_create_role_permissions_table.php` | 627 | 28 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/005_create_user_roles_table.php` | 573 | 28 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/006_create_attachments_table.php` | 703 | 29 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/007_create_activity_log_table.php` | 610 | 27 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/008_create_audit_tables.php` | 482 | 23 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/009_create_projects_table.php` | 932 | 47 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/010_create_pm_tasks_table.php` | 921 | 47 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/011_create_pm_milestones_table.php` | 774 | 40 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/012_create_pm_comments_table.php` | 795 | 40 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/migrations/013_create_pm_notes_table.php` | 801 | 40 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/database/schema.php` | 3,092 | 142 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/index.php` | 74 | 5 | NONE | REFERENCED-DEAD | `ExcavationCommand/dashboard.php` | DELETE (verify first) |
| `ProjectManager/permissions.php` | 3,130 | 127 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/project_board.php` | 14,266 | 370 | NONE | REFERENCED-DEAD | `ProjectManager/projects_dashboard.php` | DELETE (verify first) |
| `ProjectManager/projects_dashboard.php` | 8,725 | 288 | NONE | REFERENCED-DEAD | `ProjectManager/project_board.php` | DELETE (verify first) |
| `ProjectManager/router.php` | 284 | 20 | NONE | REFERENCED-DEAD | `ProjectManager/index.php` | DELETE (verify first) |
| `ProjectManager/tests/Auth/AuthenticationTest.php` | 412 | 23 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Core/BootstrapTest.php` | 684 | 35 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Core/ExceptionTest.php` | 717 | 42 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Core/RequestTest.php` | 1,443 | 76 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Core/ResponseTest.php` | 1,179 | 68 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Core/RouterTest.php` | 290 | 17 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Permissions/AuthorizationTest.php` | 341 | 18 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Permissions/PermissionTest.php` | 334 | 18 | NONE | DEAD | `—` | DELETE (verify first) |
| `ProjectManager/tests/Permissions/RoleTest.php` | 313 | 18 | NONE | DEAD | `—` | DELETE (verify first) |
| `api.php` | 3,237 | 124 | MYSQL | DEAD | `—` | DELETE (0 callers; makes api/v8 unreachable) |
| `api/agency_create.php` | 476 | 21 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/agency_dashboard.php` | 310 | 15 | JSON | DEAD | `—` | DELETE (verify first) |
| `api/agency_dispatch.php` | 707 | 29 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/agency_synthesis.php` | 793 | 31 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/agent_spawn.php` | 620 | 34 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/agent_tick.php` | 857 | 33 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/anomaly_detector.php` | 678 | 37 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_commit.php` | 751 | 32 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_dossier.php` | 845 | 35 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_memory_graph.php` | 694 | 33 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_orchestrator.php` | 2,247 | 69 | NONE | LIVE-CORE | `modules/brain_module.php` | OK |
| `api/brain_start.php` | 929 | 40 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_state.php` | 428 | 20 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_stream.php` | 1,342 | 54 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_stream_v4.php` | 701 | 29 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/brain_synthesis.php` | 2,614 | 76 | NONE | LIVE-CORE | `api/brain_orchestrator.php` | OK |
| `api/case_agent.php` | 254 | 13 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/case_create.php` | 725 | 33 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/case_memory.php` | 392 | 19 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/case_scheduler.php` | 647 | 34 | JSON | DEAD | `—` | DELETE (verify first) |
| `api/case_tick.php` | 1,119 | 45 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/dossier.php` | 657 | 26 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/file.php` | 506 | 24 | NONE | LIVE-ENDPOINT | `—` | OK |
| `api/file_tree.php` | 726 | 33 | JSON | DEAD | `—` | DELETE (verify first) |
| `api/files_action.php` | 14,970 | 318 | JSON | LIVE-ENDPOINT | `modules/files_module.php` | MIGRATE -> MySQL |
| `api/graph_synthesizer.php` | 757 | 38 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/intel_cache.php` | 210 | 11 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/model_router.php` | 5,772 | 212 | NONE | LIVE-CORE | `api/brain_orchestrator.php` | OK |
| `api/network_boot.php` | 542 | 25 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/network_tick.php` | 984 | 45 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/node_builder.php` | 715 | 30 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/search_load.php` | 6,662 | 155 | MYSQL+JSON | LIVE-ENDPOINT | `modules/search_module.php` | REMOVE JSON fallback |
| `api/tree.php` | 8,861 | 255 | MYSQL | ORPHAN-WEB | `—` | DELETE (dead SQL writer) |
| `api/v8/_response.php` | 1,219 | 48 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/agent.php` | 1,182 | 47 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/alerts.php` | 589 | 25 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/autonomous_engine.php` | 2,317 | 95 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/build_edges.php` | 823 | 34 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/build_graph.php` | 420 | 18 | NONE | REFERENCED-DEAD | `api.php` | DELETE (verify first) |
| `api/v8/cases.php` | 1,006 | 42 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/cluster_insights.php` | 741 | 26 | MYSQL | REFERENCED-DEAD | `api.php` | DELETE (dead SQL writer) |
| `api/v8/compare_networks.php` | 811 | 37 | JSON | DEAD | `—` | DELETE (verify first) |
| `api/v8/compressor.php` | 1,011 | 43 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/v8/create_network.php` | 473 | 22 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/dashboard.php` | 259 | 8 | NONE | REFERENCED-DEAD | `ProjectManager/project_board.php` | DELETE (verify first) |
| `api/v8/debug_tasks.php` | 267 | 13 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `api/v8/dossier.php` | 748 | 30 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/dossier_v2.php` | 1,064 | 42 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/event_emit.php` | 860 | 36 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/v8/feedback.php` | 704 | 26 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/v8/forecast.php` | 903 | 43 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/generate_tasks.php` | 785 | 37 | NONE | REFERENCED-DEAD | `api.php` | DELETE (verify first) |
| `api/v8/get_cases.php` | 693 | 27 | MYSQL | ORPHAN-WEB | `—` | DELETE (dead SQL writer) |
| `api/v8/get_clients.php` | 986 | 30 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `api/v8/graph_ranker.php` | 660 | 24 | MYSQL | ORPHAN-WEB | `—` | DELETE (dead SQL writer) |
| `api/v8/insights.php` | 1,272 | 48 | NONE | REFERENCED-DEAD | `api.php` | DELETE (verify first) |
| `api/v8/investigator.php` | 958 | 42 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/v8/learn.php` | 1,178 | 56 | NONE | REFERENCED-DEAD | `api/v8/feedback.php` | DELETE (verify first) |
| `api/v8/memory_store.php` | 609 | 28 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/v8/memory_weight.php` | 839 | 36 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/mesh.php` | 685 | 35 | JSON | DEAD | `—` | DELETE (verify first) |
| `api/v8/network_add_node.php` | 1,206 | 44 | MYSQL | REFERENCED-DEAD | `api.php` | DELETE (dead SQL writer) |
| `api/v8/patterns.php` | 775 | 34 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/predictor.php` | 1,070 | 51 | NONE | REFERENCED-DEAD | `lib/legaisee_model.php` | DELETE (verify first) |
| `api/v8/recommendations.php` | 462 | 18 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `api/v8/run_worker.php` | 977 | 42 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/summary.php` | 932 | 35 | NONE | DEAD | `—` | DELETE (verify first) |
| `api/v8/widget_registry.php` | 1,279 | 52 | NONE | DEAD | `—` | DELETE (verify first) |
| `bootstrap.php` | 77 | 3 | NONE | REFERENCED-DEAD | `engine/graph_data.php` | DELETE (verify first) |
| `cli/chain_evolver.php` | 2,688 | 119 | JSON | DEAD | `—` | DELETE (verify first) |
| `cli/chain_generator.php` | 2,943 | 125 | JSON | DEAD | `—` | DELETE (verify first) |
| `cli/worker.php` | 2,261 | 82 | JSON | BROKEN | `_backup/index_5-17-26-0804pm.php` | FIX require of engine/cluster_engine.php -> root cluster_engine.php |
| `cluster_engine.php` | 1,453 | 59 | NONE | LIVE-VIA-WORKER | `engine/pipeline_adapters.php` | KEEP (real clusterNodes()) |
| `components/card.php` | 623 | 29 | NONE | DEAD | `—` | DELETE (verify first) |
| `components/compare.php` | 593 | 24 | NONE | DEAD | `—` | DELETE (verify first) |
| `components/ui_card.php` | 628 | 28 | NONE | DEAD | `—` | DELETE (verify first) |
| `components/ui_folder_tree.php` | 444 | 22 | NONE | DEAD | `—` | DELETE (verify first) |
| `components/ui_tag.php` | 205 | 12 | NONE | DEAD | `—` | DELETE (verify first) |
| `config.local.php` | 339 | 13 | NONE | LIVE-CORE | `config.php` | OK |
| `config.php` | 270 | 11 | NONE | LIVE-CORE | `ProjectManager/bootstrap.php` | OK |
| `create_findings_tables.php` | 3,369 | 86 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `create_review_flags.php` | 758 | 22 | MYSQL | REFERENCED-DEAD | `create_findings_tables.php` | DELETE (dead SQL writer) |
| `create_session.php` | 1,635 | 73 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `create_test_data.php` | 439 | 23 | NONE | DEAD | `—` | DELETE (verify first) |
| `database/migrations/010_create_tree_nodes_table.php` | 1,187 | 31 | NONE | DEAD | `—` | DELETE (verify first) |
| `database/migrations/010_create_tree_nodes_tablebk.php` | 1,187 | 31 | NONE | DEAD | `—` | DELETE (verify first) |
| `db.php` | 82 | 4 | MYSQL | LIVE-CORE | `ExcavationCommand/dashboard.php` | OK |
| `db_verify.php` | 1,020 | 32 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `diagnostics2.php` | 812 | 18 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `embed_generate.php` | 1,846 | 59 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `engine/case_manager.php` | 562 | 25 | NONE | REFERENCED-DEAD | `create_test_data.php` | DELETE (verify first) |
| `engine/client_manager.php` | 833 | 42 | JSON | REFERENCED-DEAD | `create_test_data.php` | DELETE (verify first) |
| `engine/cross_case_engine.php` | 4,071 | 143 | JSON | LIVE-ENDPOINT | `engine/executive_dashboard_engine.php` | MIGRATE -> MySQL |
| `engine/cross_case_learning_compiler.php` | 5,007 | 187 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/dashboard_engine.php` | 862 | 30 | NONE | REFERENCED-DEAD | `api/v8/dashboard.php` | DELETE (verify first) |
| `engine/decision_engine_v2.php` | 4,549 | 156 | NONE | REFERENCED-DEAD | `kernel/engine_bindings.php` | DELETE (verify first) |
| `engine/decision_governor.php` | 1,492 | 65 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/entity_extraction_engine.php` | 14,401 | 353 | MYSQL | REFERENCED-DEAD | `modules/excavation_module.php` | DELETE (dead SQL writer) |
| `engine/execution_feedback_engine.php` | 4,534 | 169 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/execution_router.php` | 4,176 | 161 | NONE | REFERENCED-DEAD | `kernel/engine_bindings.php` | DELETE (verify first) |
| `engine/executive_dashboard_engine.php` | 1,306 | 47 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/goal_alignment.php` | 672 | 29 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/goal_arbitration_engine.php` | 3,097 | 133 | NONE | REFERENCED-DEAD | `engine/goal_engine.php` | DELETE (verify first) |
| `engine/goal_conflict_resolver.php` | 1,171 | 57 | NONE | REFERENCED-DEAD | `engine/goal_engine.php` | DELETE (verify first) |
| `engine/goal_engine.php` | 1,180 | 50 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `engine/goal_generator.php` | 2,489 | 94 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/governance_policy_engine.php` | 1,394 | 56 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/graph_data.php` | 1,828 | 76 | MYSQL | REFERENCED-DEAD | `test_graph.php` | DELETE (dead SQL writer) |
| `engine/graph_engine.php` | 539 | 22 | MYSQL | REFERENCED-DEAD | `api/v8/build_graph.php` | DELETE (dead SQL writer) |
| `engine/graph_mutation_engine.php` | 2,047 | 83 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/hierarchy_of_truth_engine.php` | 6,782 | 175 | MYSQL | REFERENCED-DEAD | `test_hierarchy_of_truth.php` | DELETE (dead SQL writer) |
| `engine/insight_mutator.php` | 433 | 20 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/long_horizon_planner.php` | 2,718 | 111 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/memory_evolution_engine.php` | 1,266 | 54 | NONE | REFERENCED-DEAD | `engine/executive_dashboard_engine.php` | DELETE (verify first) |
| `engine/pattern_stability.php` | 800 | 39 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/pipeline_adapters.php` | 1,311 | 62 | NONE | BROKEN | `cli/worker.php` | FIX double include + missing cluster engine |
| `engine/plain_english_helper.php` | 12,877 | 294 | NONE | DEAD-BUT-WANTED | `—` | INTEGRATE into graph + recommendation output |
| `engine/policy_enforcement_engine.php` | 5,600 | 194 | NONE | REFERENCED-DEAD | `kernel/engine_bindings.php` | DELETE (verify first) |
| `engine/portfolio_engine.php` | 1,306 | 64 | JSON | LIVE-ENDPOINT | `engine/executive_dashboard_engine.php` | MIGRATE -> MySQL |
| `engine/predictive_intelligence_engine.php` | 5,331 | 180 | NONE | LIVE-ENDPOINT | `cli/worker.php` | OK |
| `engine/reasoning_engine.php` | 1,551 | 49 | NONE | LIVE-ENDPOINT | `cli/worker.php` | OK |
| `engine/recommendation_engine.php` | 1,657 | 46 | NONE | LIVE-ENDPOINT | `api/v8/recommendations.php` | OK |
| `engine/semantic_cluster_engine.php` | 1,199 | 51 | NONE | LIVE-ENDPOINT | `api/v8/cluster_insights.php` | OK |
| `engine/system_behavior_spec.php` | 982 | 38 | NONE | DEAD | `—` | DELETE (verify first) |
| `engine/system_insight_engine.php` | 4,764 | 147 | NONE | LIVE-ENDPOINT | `cli/worker.php` | OK |
| `engine/system_recommendation_engine.php` | 5,915 | 183 | NONE | REFERENCED-DEAD | `kernel/engine_bindings.php` | DELETE (verify first) |
| `engine/temporal_memory_engine.php` | 2,105 | 86 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `export_report.php` | 2,446 | 116 | MYSQL | ORPHAN-WEB | `—` | DELETE (dead SQL writer) |
| `ingest.php` | 1,138 | 44 | NONE | REFERENCED-DEAD | `modules/ingest_module.php` | DELETE (verify first) |
| `ingest2.php` | 1,138 | 44 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `intelligence.php` | 3,765 | 146 | NONE | REFERENCED-DEAD | `z_Deleted by claude/Kernel/insight_generator.php` | DELETE (verify first) |
| `kernel/bootstrap.php` | 45 | 3 | NONE | REFERENCED-DEAD | `ProjectManager/api/auth/login.php` | DELETE (verify first) |
| `kernel/cluster_intelligence.php` | 2,403 | 97 | NONE | DEAD | `z_Deleted by claude/Kernel/insight_generator.php` | DELETE (superseded by engine/semantic_cluster_engine.php) |
| `kernel/db.php` | 655 | 20 | MYSQL | LIVE-CORE | `api.php` | OK |
| `kernel/engine_bindings.php` | 773 | 43 | NONE | DEAD-CONFIG | `—` | WIRE into load_module.php or delete |
| `kernel/folder_engine.php` | 1,042 | 47 | MYSQL | REFERENCED-DEAD | `ui/file_explorer.php` | DELETE (dead SQL writer) |
| `kernel/graph_auto_builder.php` | 2,154 | 88 | NONE | DEAD | `—` | DELETE (verify first) |
| `kernel/graph_engine.php` | 1,890 | 70 | MYSQL | REFERENCED-DEAD | `api/v8/build_graph.php` | DELETE (dead SQL writer) |
| `kernel/guard.php` | 431 | 24 | MYSQL | DEAD-BUT-WANTED | `—` | WIRE into kernel_boot.php |
| `kernel/ingestion_pipeline.php` | 2,261 | 80 | NONE | REFERENCED-DEAD | `modules/ingest_module.php` | DELETE (verify first) |
| `kernel/kernel.php` | 481 | 19 | NONE | REFERENCED-DEAD | `kernel/guard.php` | DELETE (verify first) |
| `kernel/kernel_boot.php` | 1,196 | 50 | MYSQL | LIVE-CORE | `api/files_action.php` | OK |
| `kernel/kernel_contract.php` | 218 | 5 | NONE | REFERENCED-DEAD | `test_modules.php` | DELETE (verify first) |
| `kernel/kernel_paths.php` | 498 | 15 | JSON | LIVE-CORE | `kernel/kernel_boot.php` | MIGRATE -> MySQL |
| `kernel/model/page_model.php` | 384 | 15 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `kernel/module_contract.php` | 375 | 14 | NONE | REFERENCED-DEAD | `test_modules.php` | DELETE (verify first) |
| `kernel/module_registry.php` | 2,059 | 42 | NONE | LIVE-CORE | `kernel/system_health.php` | OK |
| `kernel/nav_engine.php` | 704 | 35 | NONE | REFERENCED-DEAD | `modules/view_module.php` | DELETE (verify first) |
| `kernel/system_health.php` | 4,985 | 185 | SQLITE | BROKEN | `—` | FIX sqlite_master probe, then WIRE |
| `kernel/task_generator.php` | 1,039 | 39 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `legaisee_prospects.php` | 72,387 | 677 | NONE | DEAD | `—` | DELETE (verify first) |
| `lib/legaisee_model.php` | 6,220 | 313 | MYSQL | REFERENCED-DEAD | `views/compare_view.php` | DELETE (dead SQL writer) |
| `lib/semantic_diff_engine.php` | 6,929 | 246 | MYSQL | REFERENCED-DEAD | `api/v8/agent.php` | DELETE (dead SQL writer) |
| `load_module.php` | 1,502 | 65 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `load_sets.php` | 371 | 19 | JSON | DEAD | `—` | DELETE (verify first) |
| `modules/001_create_tree_nodes.php` | 1,133 | 39 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `modules/alert_module.php` | 1,268 | 52 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/anomaly_engine_module.php` | 2,629 | 78 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/archive/build_dossier.php` | 0 | 1 | NONE | EMPTY | `—` | DELETE (0 bytes) |
| `modules/brain_module.php` | 6,745 | 190 | JSON | ROUTED | `shell.php` | MIGRATE -> MySQL |
| `modules/build_dossier.php` | 3,119 | 266 | MYSQL | UNREGISTERED | `—` | REGISTER or delete |
| `modules/cases_module.php` | 1,780 | 45 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/client_view_module.php` | 16,004 | 316 | MYSQL+JSON | ROUTED | `kernel/module_registry.php` | REMOVE JSON fallback |
| `modules/clients_module.php` | 2,003 | 96 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/cluster_module.php` | 736 | 29 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/cockpit_module.php` | 8,358 | 205 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/compare_module.php` | 1,373 | 25 | NONE | SHELL-ONLY | `kernel/module_registry.php` | FINISH (renders inputs, no engine call) |
| `modules/cross_case_engine.php` | 4,801 | 177 | JSON | ROUTED | `engine/executive_dashboard_engine.php` | MIGRATE -> MySQL |
| `modules/dashboard_module.php` | 532 | 21 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/decision_module.php` | 4,984 | 216 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/dig_review_module.php` | 26,176 | 558 | MYSQL+JSON | ROUTED | `kernel/module_registry.php` | REMOVE JSON fallback |
| `modules/entity_resolution_module.php` | 5,233 | 154 | MYSQL+JSON | ROUTED | `kernel/module_registry.php` | REMOVE JSON fallback |
| `modules/excavation_module.php` | 9,756 | 310 | MYSQL+JSON | ROUTED | `test_excavation_module.php` | REMOVE JSON fallback |
| `modules/executive_dashboard_module.php` | 5,489 | 221 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/files_module.php` | 19,443 | 375 | NONE | ROUTED | `api/files_action.php` | OK |
| `modules/governance_module.php` | 17,204 | 375 | JSON | UNREGISTERED | `—` | REGISTER in module_registry.php or delete |
| `modules/graph_module.php` | 4,490 | 118 | MYSQL | ROUTED | `test_graph_fix.php` | OK |
| `modules/ingest_module.php` | 15,792 | 314 | MYSQL+JSON | ROUTED | `kernel/module_registry.php` | REMOVE JSON fallback |
| `modules/ingest_view_module.php` | 616 | 32 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/insight_module.php` | 14,141 | 279 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/intelligence_dashboard_module.php` | 3,700 | 117 | NONE | MOCK | `kernel/module_registry.php` | REPLACE mock layer with engine/system_insight_engine.php |
| `modules/payment_module.php` | 12,248 | 329 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/pm_module.php` | 47,296 | 923 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/predictive_link_module_v1.php` | 4,887 | 184 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `modules/predictive_module.php` | 4,291 | 174 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/project_manager/project_manager.php` | 0 | 1 | NONE | EMPTY | `—` | DELETE (0 bytes) |
| `modules/recommendation_module.php` | 1,996 | 49 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/relations_module.php` | 5,927 | 215 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/report_module.php` | 7,959 | 222 | MYSQL+JSON | ROUTED | `shell.php` | REMOVE JSON fallback |
| `modules/root_cause_graph_module.php` | 4,541 | 176 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/search_module.php` | 17,277 | 394 | MYSQL+JSON | ROUTED | `api/search_load.php` | REMOVE JSON fallback |
| `modules/semantic_cluster_module.php` | 6,062 | 226 | MYSQL+JSON | ROUTED | `kernel/module_registry.php` | REMOVE JSON fallback |
| `modules/time_intelligence_module.php` | 2,786 | 121 | JSON | ROUTED | `kernel/module_registry.php` | MIGRATE -> MySQL |
| `modules/utils/bootstrap.php` | 625 | 34 | JSON | LIVE-CORE | `modules/cases_module.php` | MIGRATE -> MySQL |
| `modules/utils/debug_helpers.php` | 297 | 16 | NONE | DEAD | `—` | DELETE (verify first) |
| `modules/utils/file_helpers.php` | 438 | 16 | NONE | DEAD | `—` | DELETE (verify first) |
| `modules/utils/json_helpers.php` | 2 | 1 | NONE | REFERENCED-DEAD | `modules/alert_module.php` | DELETE (verify first) |
| `modules/utils/uic_v1.php` | 8,996 | 199 | NONE | LIVE-CORE | `modules/intelligence_dashboard_module.php` | OK |
| `modules/utils/uic_v2.php` | 2,507 | 102 | NONE | DEAD | `—` | DELETE (verify first) |
| `modules/vault_module.php` | 6,366 | 147 | JSON | ROUTED | `shell.php` | MIGRATE -> MySQL |
| `modules/view_module.php` | 7,105 | 264 | MYSQL | ROUTED | `kernel/module_registry.php` | OK |
| `pages/goals.php` | 36 | 1 | NONE | DEAD | `—` | DELETE (verify first) |
| `pages/home.php` | 41 | 1 | NONE | DEAD | `—` | DELETE (verify first) |
| `pages/logs.php` | 35 | 1 | NONE | DEAD | `—` | DELETE (verify first) |
| `pages/network_view.php` | 1,185 | 54 | NONE | DEAD | `—` | DELETE (verify first) |
| `pages/networks.php` | 52 | 1 | NONE | DEAD | `—` | DELETE (verify first) |
| `pages/reasoning.php` | 47 | 1 | NONE | DEAD | `—` | DELETE (verify first) |
| `pages/search.php` | 2,263 | 103 | NONE | REFERENCED-DEAD | `z_Deleted by claude/commandcenter/saved_views.php` | DELETE (verify first) |
| `pages/shell_template.php` | 10,835 | 200 | NONE | DEAD | `—` | DELETE (verify first) |
| `pages/test/shell_module_test.php` | 13,622 | 293 | JSON | DEAD | `—` | DELETE (verify first) |
| `parser.php` | 2,676 | 113 | NONE | DEAD | `—` | DELETE (verify first) |
| `peek.php` | 126 | 3 | NONE | DEAD | `—` | DELETE (verify first) |
| `prospect.php` | 29,959 | 659 | MYSQL | REFERENCED-DEAD | `engine/entity_extraction_engine.php` | DELETE (dead SQL writer) |
| `response.php` | 1,219 | 48 | NONE | REFERENCED-DEAD | `api/v8/build_graph.php` | DELETE (verify first) |
| `save_set.php` | 1,000 | 39 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `semantic_engine.php` | 1,234 | 59 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `session.php` | 3,946 | 170 | JSON | REFERENCED-DEAD | `create_session.php` | DELETE (verify first) |
| `shell.php` | 19,456 | 386 | NONE | LIVE-CORE | `api/files_action.php` | OK |
| `temp_dashboard.php` | 6,683 | 284 | MYSQL | REFERENCED-DEAD | `view_ingest.php` | DELETE (dead SQL writer) |
| `test_db.php` | 122 | 9 | NONE | DEAD | `—` | DELETE (verify first) |
| `test_excavation_module.php` | 475 | 15 | NONE | DEAD | `—` | DELETE (verify first) |
| `test_extraction_fix.php` | 2,955 | 59 | MYSQL | ORPHAN-WEB | `—` | DELETE (dead SQL writer) |
| `test_graph.php` | 362 | 14 | NONE | DEAD | `—` | DELETE (verify first) |
| `test_graph_fix.php` | 3,018 | 78 | MYSQL | ORPHAN-WEB | `—` | DELETE (dead SQL writer) |
| `test_hierarchy_of_truth.php` | 4,128 | 96 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `test_kernel.php` | 332 | 13 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `test_modules.php` | 821 | 39 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `test_ui.php` | 6,010 | 303 | NONE | DEAD | `—` | DELETE (verify first) |
| `test_visual.php` | 3,861 | 178 | NONE | DEAD | `—` | DELETE (verify first) |
| `tools/build_cluster_summaries.php` | 3,600 | 124 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `tools/build_cluster_summaries_ai.php` | 2,862 | 116 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `tools/build_clusters.php` | 1,857 | 78 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `tools/build_relations.php` | 2,775 | 111 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `tools/detect_cluster_opportunities.php` | 3,777 | 136 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `tools/extract_cluster_insights.php` | 4,064 | 146 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `tools/name_clusters.php` | 2,588 | 109 | MYSQL | DEAD | `—` | DELETE (dead SQL writer) |
| `ui/compare_engine.php` | 1,497 | 55 | NONE | DEAD | `—` | DELETE (verify first) |
| `ui/components/card.php` | 623 | 29 | NONE | DEAD | `—` | DELETE (verify first) |
| `ui/components/ingest_exec snap.php` | 4,750 | 213 | NONE | DEAD | `—` | DELETE (verify first) |
| `ui/components/ingestforshell.php` | 4,750 | 213 | NONE | DEAD | `—` | DELETE (verify first) |
| `ui/file_explorer.php` | 833 | 32 | NONE | DEAD | `—` | DELETE (verify first) |
| `ui/layout.php` | 4,211 | 221 | NONE | REFERENCED-DEAD | `ui/ui_engine.php` | DELETE (verify first) |
| `ui/ui_bootstrap.php` | 142 | 8 | NONE | LIVE-CORE | `kernel/kernel_boot.php` | OK |
| `ui/ui_engine.php` | 1,091 | 43 | NONE | REFERENCED-DEAD | `modules/view_module.php` | DELETE (verify first) |
| `view_ingest.php` | 4,433 | 232 | MYSQL | REFERENCED-DEAD | `temp_dashboard.php` | DELETE (dead SQL writer) |
| `views/compare_view.php` | 3,346 | 140 | NONE | ORPHAN-WEB | `—` | DELETE (verify first) |
| `views/graph_view.php` | 9,223 | 313 | JSON | REFERENCED-DEAD | `modules/client_view_module.php` | DELETE (verify first) |
| `views/ingest_view.php` | 363 | 12 | NONE | DEAD | `—` | DELETE (verify first) |

## Grouped summary

| Directory | Files | Status mix |
|---|---:|---|
| `ProjectManager/` | 94 | DEAD 73, REFERENCED-DEAD 16, ORPHAN-WEB 4, ORPHAN-INCLUDED 1 |
| `api/` | 68 | ORPHAN-WEB 29, DEAD 25, REFERENCED-DEAD 8, LIVE-CORE 3, LIVE-ENDPOINT 3 |
| `modules/` | 46 | ROUTED 33, DEAD 4, EMPTY 2, UNREGISTERED 2, LIVE-CORE 2, SHELL-ONLY 1, MOCK 1, REFERENCED-DEAD 1 |
| `(root)/` | 41 | DEAD 20, REFERENCED-DEAD 9, ORPHAN-WEB 7, LIVE-CORE 4, LIVE-VIA-WORKER 1 |
| `engine/` | 37 | REFERENCED-DEAD 14, DEAD 14, LIVE-ENDPOINT 7, BROKEN 1, DEAD-BUT-WANTED 1 |
| `kernel/` | 19 | REFERENCED-DEAD 8, DEAD 4, LIVE-CORE 4, DEAD-CONFIG 1, DEAD-BUT-WANTED 1, BROKEN 1 |
| `pages/` | 9 | DEAD 8, REFERENCED-DEAD 1 |
| `ui/` | 8 | DEAD 5, REFERENCED-DEAD 2, LIVE-CORE 1 |
| `tools/` | 7 | DEAD 7 |
| `components/` | 5 | DEAD 5 |
| `ExcavationCommand/` | 3 | REFERENCED-DEAD 2, ORPHAN-WEB 1 |
| `cli/` | 3 | DEAD 2, BROKEN 1 |
| `views/` | 3 | ORPHAN-WEB 1, REFERENCED-DEAD 1, DEAD 1 |
| `database/` | 2 | DEAD 2 |
| `lib/` | 2 | REFERENCED-DEAD 2 |

## Non-PHP inventory

| Type | Count | Disposition |
|---|---:|---|
| `.md` | 457 | Documentation — keep, but 457 files includes stale audits; see AUDIT-DATA-CONSOLIDATED.md |
| `.json` | 153 | Mixed: `data/`+`clients/` are legacy stores to migrate; rest are config/fixtures |
| `.txt` | 82 | Inventory/tree dumps — archive |
| `.jpg` | 76 | Client artifacts/dossiers — keep (business records) |
| `(none)` | 67 | Review |
| `.phps` | 24 | PHP source backups — delete (may expose source) |
| `.map` | 21 | Review |
| `.png` | 15 | Screenshots/branding — keep |
| `.afm` | 14 | Review |
| `.bak-20261027` | 12 | Backup copies — delete after diff confirmation |
| `.ttf` | 12 | Review |
| `.ufm` | 12 | Review |
| `.yml` | 9 | Review |
| `.phpbak` | 6 | Review |
| `.pdf` | 6 | Review |
| `.log` | 5 | Review |
| `.xml` | 5 | Review |
| `.bak-20261028` | 4 | Backup copies — delete after diff confirmation |
| `.html` | 4 | Review |
| `.sh` | 4 | Review |
| `.dist` | 3 | Review |
| `.code-workspace` | 2 | Review |
| `.docx` | 2 | Source briefs — keep |
| `.db` | 2 | Stale SQLite files — delete after migration |
| `.lgpl` | 2 | Review |
| `.svg` | 2 | Review |
| `.css` | 2 | Review |
| `. troubleshooting` | 1 | Review |
| `.ms` | 1 | Review |
| `.csv` | 1 | Review |
| `.py` | 1 | Review |
| `.sql` | 1 | Pre-migration dump — keep until Phase 9, then archive |
| `.lock` | 1 | Review |
| `.phar` | 1 | Review |
| `.js` | 1 | Review |
| `.phpbak2` | 1 | Review |
| `.icc` | 1 | Review |
| `.license` | 1 | Review |
| `.yaml` | 1 | Review |
| `.afdesign` | 1 | Review |
| `.crt` | 1 | Review |
| `.neon` | 1 | Review |

Vendor trees excluded from the status table (third-party, do not audit or edit):
`ProjectManager/vendor/` (Composer), `lib/vendor/` (Stripe, PHPMailer), `lib/dompdf/` — 861 PHP files.

Archive / already-deleted trees excluded: `z_Deleted by claude/`, `_backup/`, `archive/`, `*.bak-*`, `*.phpbak` — 55 files.
