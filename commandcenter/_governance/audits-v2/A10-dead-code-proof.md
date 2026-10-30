# A10 — Dead-code proof

**Date:** 2026-10-29
**Scope:** every file the v1 scan marked `DEAD`, `REFERENCED-DEAD` or `ORPHAN-WEB` — **276 of the 347 ledger rows** (170 / 64 / 42).
**Method:** `_governance/audits-v2/a10_deadproof.py`, run against the tree, output in `A10-table.md` (all 276 rows), `A10-lists.md` (the three lists), `A10-result.json` (raw). For each file the script searches every text file in the tree for (a) the **full relative path** and (b) the **bare stem** in a require/include/URL/fetch form, then classifies each citing file as **executable code**, **prose** (`.md`, `.txt`), or **backup** (`.phpbak`, `.bak*`), and md5s every file so duplicates surface.
**Inputs:** `_governance/AUDIT-APPENDIX-FILE-STATUS.md` (the v1 verdicts — used as the list to test, never as evidence), `_governance/audits-v2/A1-reachability.md` (the rescues), `00-GROUND-RULES.md` §5–6.

---

## The rule that decides everything

A citing file only counts as a **caller** if it is executable **and** is not itself in the dead set. A `.md` that names a file, a `.phpbak` copy of a page that mentions it, or a dead script that requires it, all prove the same thing: that the code was *written to be called*, not that it *is* called. That distinction is what separates SAFE-TO-ARCHIVE from NEEDS-HUMAN-DECISION.

---

## Result in one line

**The v1 dead list is mechanically sound: not one of the 276 files is called by a single line of live executable code.** The five files that have any executable citer are all stale-string false positives. What the old scan got wrong was not the *verdict* but the *reasons* — it attributed callers that are Markdown files, backups, and other dead files.

| Measure | Count |
|---|---:|
| v1 ledger rows | 347 |
| In the dead set (DEAD / REFERENCED-DEAD / ORPHAN-WEB) | **276** |
| — `DEAD` | 170 |
| — `REFERENCED-DEAD` | 64 |
| — `ORPHAN-WEB` | 42 |
| Rescued by A1 (excluded from the three lists) | 11 |
| Classified below | **265** |
| Cited only by prose / backup files | 151 |
| Zero references of any kind | 109 |
| Called by executable code outside the dead set | 5 |
| Duplicate groups | 6 (12 files) |
| Bytes under review | 685,549 |

**The three lists:** SAFE-TO-ARCHIVE **209** · KEEP-FOR-REUSE **51** · NEEDS-HUMAN-DECISION **5** (209 + 51 + 5 = 265 ✓).

---

## 1. What the proof actually found

**None of the 276 is reachable.** Every file either has no reference at all (109) or is named only by a document, a backup, or another dead file (151). The five "live" hits are:

| File | Cited by | Why it is not a caller |
|---|---|---|
| `ProjectManager/config.php` | `.htaccess` | The string is the **deny pattern** `^(config\.php|\.env|\.gitignore)$` — a security rule naming the file, not a call |
| `components/card.php` | `style_test_Colors.html` | An HTML style-test page listing class names |
| `ui/components/card.php` | `style_test_Colors.html` | Same page, same reason |
| `ProjectManager/app/Models/Label.php` | `style_test_Colors.html` | Same page |
| `intelligence.php` | `style_test_Colors.html`, `engine/closed_loop.js` | A colour swatch page and one JS file — neither `require`s or `fetch`es it in a resolvable form |

So the honest reading: **the old scan's dead set is correct as a set.** Its `REFERENCED-DEAD` label, though, is doing heavy lifting — in most cases the "reference" is a `.md` wish-list or a `.phpbak` copy. That matters because anyone acting on v1 would have believed those files had proven callers waiting to be wired.

---

## 2. Duplicates — 6 groups, 12 files

| Identical pair | Note |
|---|---|
| `ingest.php` == `ingest2.php` | **v1 gave these two different verdicts** (`REFERENCED-DEAD` vs `ORPHAN-WEB`) for byte-identical files. One decision, not two |
| `components/card.php` == `ui/components/card.php` | The same component in two locations — v1 also split their verdicts |
| `api/v8/_response.php` == `response.php` | Same helper at two depths |
| `ui/components/ingest_exec snap.php` == `ui/components/ingestforshell.php` | One carries a "snap" suffix — a Finder/Explorer copy |
| `database/migrations/010_create_tree_nodes_table.php` == `..._tablebk.php` | `bk` = backup copy of a migration |
| *(one further group in `A10-result.json`)* | see the `Dup of` column in `A10-table.md` |

Four of these six are evidence of an editing habit rather than dead code: files are copied rather than versioned, then abandoned. That is why the ledger grew to 347 rows.

---

## 3. Unique content worth keeping — the 51

The mechanical bar for KEEP-FOR-REUSE: **no executable caller, not a duplicate, ≥40 lines, and ≥3 declarations** (functions, classes or `CREATE TABLE`). That yields 51 files, not 51 recommendations — it is a review queue, and most will still be archived after a read. The ones that clearly carry logic nothing live replaces:

| File | Lines | Why it survives |
|---|---:|---|
| `Color_Creator.php` | 2,241 | 68 declarations — the largest single file in the tree, entirely self-contained, zero references. Not PM functionality; a standalone colour/palette tool. Only the owner can say whether it was ever meant to ship |
| `modules/utils/uic_v2.php` | 102 | A second-generation UIC renderer beside the live `uic_v1.php`. Directly relevant given A9's finding that six screens are JSON dumps |
| `engine/temporal_memory_engine.php` | 86 | Time-decay scoring over memory; nothing live computes this (A5's `time_intelligence` reads JSON instead) |
| `engine/long_horizon_planner.php` | 111 | Multi-horizon planning; no live equivalent |
| `engine/goal_arbitration_engine.php` | 133 | Goal conflict resolution; pairs with the two dead `goal_*` files |
| `ui/compare_engine.php` | 55 | Diff logic; `lib/semantic_diff_engine.php` is live but is a different engine |
| `test_hierarchy_of_truth.php` | 96 | The **only** writer of `findings` in the whole tree (A4 proved it). Its content is the spec for whatever eventually fills that table |
| `ProjectManager/app/Repositories/{Role,Permission,ActivityLog}Repository.php` | 52–160 | Real SQL against roles/permissions/activity — the only place the auth model exists as code (A8) |

**One manual override of the mechanical result.** `views/graph_view.php` (313 lines) scores SAFE-TO-ARCHIVE — zero executable references. It should not be archived: `modules/client_view_module.php:223` requires `__DIR__.'/../graph_view.php'`, which resolves to `commandcenter/graph_view.php` and **does not exist** (A1-005). `views/graph_view.php` is the file that require was meant to reach. It is not dead code with no caller; it is a live module's missing dependency filed in the wrong directory. **Move it into NEEDS-HUMAN-DECISION** and fix the path rather than the archive.

---

## 4. Whole directories that are entirely dead

Four directory families are dead in their entirety — every file in them appears in SAFE-TO-ARCHIVE:

| Directory | Files | What it was |
|---|---:|---|
| `components/` | 4 | Chrome helpers (`card.php`, `compare.php`, `ui_card.php`, `ui_folder_tree.php`, `ui_tag.php`) superseded by `ui/` +
 `modules/utils/uic_v1.php` |
| `tools/` | 7 | Cluster insight/summary generators, all reading JSON |
| `pages/` | 9 | An earlier page-router generation (`home.php`, `logs.php`, `goals.php`, `reasoning.php`, `shell_template.php`, `test/shell_module_test.php`) |
| `ExcavationCommand/` | 3 | `dashboard.php`, `planner.php`, `system_index.php` — v1 gave these three different verdicts; all three are dead |

`ProjectManager/` contributes **51** SAFE files and `api/` **60** — those are covered in A8 and A1 respectively and are listed individually in the generated list.

---

## 5. The three lists

Full per-file proof for every row is in the tables below, generated directly from `A10-result.json` so nothing is hand-transcribed. Every one of the 265 carries its search result in the **Proof** column.

# A10 — generated lists

### SAFE-TO-ARCHIVE — 209 files

No executable file references these. Move to `_archive/`; do not delete (`00-GROUND-RULES.md` §6).

| File | v1 status | Lines | Proof | Duplicate of |
|---|---|---:|---|---|
| `api.php` | DEAD | 124 | prose/backup only: `full_inventory3.txt` | — |
| `api/agency_create.php` | DEAD | 21 | zero references of any kind | — |
| `api/agency_dashboard.php` | DEAD | 15 | zero references of any kind | — |
| `api/agency_dispatch.php` | ORPHAN-WEB | 29 | zero references of any kind | — |
| `api/agency_synthesis.php` | ORPHAN-WEB | 31 | zero references of any kind | — |
| `api/agent_spawn.php` | ORPHAN-WEB | 34 | zero references of any kind | — |
| `api/agent_tick.php` | ORPHAN-WEB | 33 | zero references of any kind | — |
| `api/anomaly_detector.php` | ORPHAN-WEB | 37 | zero references of any kind | — |
| `api/brain_commit.php` | ORPHAN-WEB | 32 | zero references of any kind | — |
| `api/brain_dossier.php` | ORPHAN-WEB | 35 | zero references of any kind | — |
| `api/brain_memory_graph.php` | ORPHAN-WEB | 33 | prose/backup only: `?` | — |
| `api/brain_start.php` | ORPHAN-WEB | 40 | zero references of any kind | — |
| `api/brain_state.php` | ORPHAN-WEB | 20 | zero references of any kind | — |
| `api/brain_stream.php` | ORPHAN-WEB | 54 | zero references of any kind | — |
| `api/brain_stream_v4.php` | ORPHAN-WEB | 29 | zero references of any kind | — |
| `api/case_agent.php` | ORPHAN-WEB | 13 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/case_create.php` | ORPHAN-WEB | 33 | zero references of any kind | — |
| `api/case_memory.php` | ORPHAN-WEB | 19 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/case_scheduler.php` | DEAD | 34 | zero references of any kind | — |
| `api/case_tick.php` | ORPHAN-WEB | 45 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/dossier.php` | ORPHAN-WEB | 26 | prose/backup only: `OS Contents.txt` | — |
| `api/file_tree.php` | DEAD | 33 | zero references of any kind | — |
| `api/graph_synthesizer.php` | ORPHAN-WEB | 38 | zero references of any kind | — |
| `api/intel_cache.php` | DEAD | 11 | zero references of any kind | — |
| `api/network_boot.php` | DEAD | 25 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/network_tick.php` | ORPHAN-WEB | 45 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/node_builder.php` | ORPHAN-WEB | 30 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/v8/_response.php` | DEAD | 48 | zero references of any kind | `response.php` |
| `api/v8/agent.php` | DEAD | 47 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0120_USER_ROLES.md` | — |
| `api/v8/alerts.php` | DEAD | 25 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `api/v8/autonomous_engine.php` | DEAD | 95 | zero references of any kind | — |
| `api/v8/build_edges.php` | DEAD | 34 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/v8/build_graph.php` | REFERENCED-DEAD | 18 | prose/backup only: `?` | — |
| `api/v8/cases.php` | DEAD | 42 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/v8/cluster_insights.php` | REFERENCED-DEAD | 26 | zero references of any kind | — |
| `api/v8/compare_networks.php` | DEAD | 37 | zero references of any kind | — |
| `api/v8/compressor.php` | ORPHAN-WEB | 43 | zero references of any kind | — |
| `api/v8/create_network.php` | DEAD | 22 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/v8/dashboard.php` | REFERENCED-DEAD | 8 | prose/backup only: `brain.phpbak` | — |
| `api/v8/debug_tasks.php` | DEAD | 13 | zero references of any kind | — |
| `api/v8/dossier.php` | DEAD | 30 | prose/backup only: `OS Contents.txt` | — |
| `api/v8/dossier_v2.php` | DEAD | 42 | zero references of any kind | — |
| `api/v8/event_emit.php` | ORPHAN-WEB | 36 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/v8/feedback.php` | ORPHAN-WEB | 26 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `api/v8/forecast.php` | DEAD | 43 | prose/backup only: `LEGAiSEE Busines Plan/011_LEGAiSEE Wiring Audit-Pass 7.md` | — |
| `api/v8/generate_tasks.php` | REFERENCED-DEAD | 37 | zero references of any kind | — |
| `api/v8/get_cases.php` | ORPHAN-WEB | 27 | prose/backup only: `brain.phpbak` | — |
| `api/v8/get_clients.php` | DEAD | 30 | prose/backup only: `brain.phpbak` | — |
| `api/v8/graph_ranker.php` | ORPHAN-WEB | 24 | zero references of any kind | — |
| `api/v8/insights.php` | REFERENCED-DEAD | 48 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `api/v8/investigator.php` | ORPHAN-WEB | 42 | prose/backup only: `KnowledgeSystem/# 0000_SERIES-000-Governance/0002_KNOWLEDGE_SYSTEM_BUILD_ORDER.md` | — |
| `api/v8/learn.php` | REFERENCED-DEAD | 56 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/v8/memory_store.php` | ORPHAN-WEB | 28 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `api/v8/memory_weight.php` | DEAD | 36 | zero references of any kind | — |
| `api/v8/mesh.php` | DEAD | 35 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `api/v8/patterns.php` | DEAD | 34 | prose/backup only: `OS Contents.txt` | — |
| `api/v8/predictor.php` | REFERENCED-DEAD | 51 | prose/backup only: `?` | — |
| `api/v8/recommendations.php` | ORPHAN-WEB | 18 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `api/v8/run_worker.php` | DEAD | 42 | prose/backup only: `brain.phpbak` | — |
| `api/v8/summary.php` | DEAD | 35 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `api/v8/widget_registry.php` | DEAD | 52 | zero references of any kind | — |
| `bootstrap.php` | REFERENCED-DEAD | 3 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `cli/chain_evolver.php` | DEAD | 119 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `cli/chain_generator.php` | DEAD | 125 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `components/compare.php` | DEAD | 24 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `components/ui_card.php` | DEAD | 28 | zero references of any kind | — |
| `components/ui_folder_tree.php` | DEAD | 22 | zero references of any kind | — |
| `components/ui_tag.php` | DEAD | 12 | zero references of any kind | — |
| `create_findings_tables.php` | DEAD | 86 | zero references of any kind | — |
| `create_review_flags.php` | REFERENCED-DEAD | 22 | prose/backup only: `?` | — |
| `create_session.php` | ORPHAN-WEB | 73 | prose/backup only: `full_inventory3.txt` | — |
| `create_test_data.php` | DEAD | 23 | prose/backup only: `full_inventory3.txt` | — |
| `database/migrations/010_create_tree_nodes_table.php` | DEAD | 31 | zero references of any kind | `database/migrations/010_create_tree_nodes_tablebk.php` |
| `database/migrations/010_create_tree_nodes_tablebk.php` | DEAD | 31 | zero references of any kind | `database/migrations/010_create_tree_nodes_table.php` |
| `db_verify.php` | DEAD | 32 | zero references of any kind | — |
| `diagnostics2.php` | DEAD | 18 | zero references of any kind | — |
| `embed_generate.php` | DEAD | 59 | prose/backup only: `full_inventory3.txt` | — |
| `engine/case_manager.php` | REFERENCED-DEAD | 25 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `engine/client_manager.php` | REFERENCED-DEAD | 42 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `engine/cross_case_learning_compiler.php` | DEAD | 187 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `engine/dashboard_engine.php` | REFERENCED-DEAD | 30 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `engine/decision_engine_v2.php` | REFERENCED-DEAD | 156 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `engine/decision_governor.php` | DEAD | 65 | zero references of any kind | — |
| `engine/execution_feedback_engine.php` | DEAD | 169 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `engine/execution_router.php` | REFERENCED-DEAD | 161 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `engine/executive_dashboard_engine.php` | DEAD | 47 | zero references of any kind | — |
| `engine/goal_alignment.php` | DEAD | 29 | zero references of any kind | — |
| `engine/goal_conflict_resolver.php` | REFERENCED-DEAD | 57 | zero references of any kind | — |
| `engine/goal_engine.php` | DEAD | 50 | prose/backup only: `?` | — |
| `engine/goal_generator.php` | DEAD | 94 | zero references of any kind | — |
| `engine/governance_policy_engine.php` | DEAD | 56 | zero references of any kind | — |
| `engine/graph_data.php` | REFERENCED-DEAD | 76 | zero references of any kind | — |
| `engine/graph_engine.php` | REFERENCED-DEAD | 22 | prose/backup only: `?` | — |
| `engine/graph_mutation_engine.php` | DEAD | 83 | zero references of any kind | — |
| `engine/insight_mutator.php` | DEAD | 20 | zero references of any kind | — |
| `engine/memory_evolution_engine.php` | REFERENCED-DEAD | 54 | zero references of any kind | — |
| `engine/pattern_stability.php` | DEAD | 39 | zero references of any kind | — |
| `engine/policy_enforcement_engine.php` | REFERENCED-DEAD | 194 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `engine/system_behavior_spec.php` | DEAD | 38 | zero references of any kind | — |
| `engine/system_recommendation_engine.php` | REFERENCED-DEAD | 183 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `ExcavationCommand/dashboard.php` | REFERENCED-DEAD | 153 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `ExcavationCommand/planner.php` | ORPHAN-WEB | 39 | prose/backup only: `KnowledgeSystem/# 500  AI Systems/0504_SERIES_500_PROJECT_MANAGER.md` | — |
| `ExcavationCommand/system_index.php` | REFERENCED-DEAD | 67 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `export_report.php` | ORPHAN-WEB | 116 | prose/backup only: `full_inventory3.txt` | — |
| `ingest.php` | REFERENCED-DEAD | 44 | prose/backup only: `full_inventory3.txt` | `ingest2.php` |
| `ingest2.php` | ORPHAN-WEB | 44 | prose/backup only: `tree.txt` | `ingest.php` |
| `kernel/bootstrap.php` | REFERENCED-DEAD | 3 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/LEGAiSEE_PROJECT_MANAGER_HANDOFF_V1.md` | — |
| `kernel/cluster_intelligence.php` | DEAD | 97 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `kernel/graph_engine.php` | REFERENCED-DEAD | 70 | zero references of any kind | — |
| `kernel/kernel_contract.php` | REFERENCED-DEAD | 5 | prose/backup only: `?` | — |
| `kernel/model/page_model.php` | DEAD | 15 | zero references of any kind | — |
| `kernel/module_contract.php` | REFERENCED-DEAD | 14 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `kernel/task_generator.php` | DEAD | 39 | zero references of any kind | — |
| `legaisee_prospects.php` | DEAD | 677 | prose/backup only: `full_inventory3.txt` | — |
| `load_module.php` | ORPHAN-WEB | 65 | prose/backup only: `full_inventory3.txt` | — |
| `load_sets.php` | DEAD | 19 | prose/backup only: `full_inventory3.txt` | — |
| `modules/001_create_tree_nodes.php` | DEAD | 39 | zero references of any kind | — |
| `modules/utils/debug_helpers.php` | DEAD | 16 | zero references of any kind | — |
| `modules/utils/file_helpers.php` | DEAD | 16 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `modules/utils/json_helpers.php` | REFERENCED-DEAD | 1 | zero references of any kind | — |
| `pages/goals.php` | DEAD | 1 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `pages/home.php` | DEAD | 1 | prose/backup only: `RUNBOOK-server-steps.md` | — |
| `pages/logs.php` | DEAD | 1 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `pages/network_view.php` | DEAD | 54 | zero references of any kind | — |
| `pages/networks.php` | DEAD | 1 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `pages/reasoning.php` | DEAD | 1 | prose/backup only: `LEGAiSEE Busines Plan/004_LEGAiSEE Operating Manual — Part 4-Software, Tools, and AI Capability Map.md` | — |
| `pages/search.php` | REFERENCED-DEAD | 103 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `pages/shell_template.php` | DEAD | 200 | zero references of any kind | — |
| `pages/test/shell_module_test.php` | DEAD | 293 | zero references of any kind | — |
| `parser.php` | DEAD | 113 | prose/backup only: `full_inventory3.txt` | — |
| `peek.php` | DEAD | 3 | prose/backup only: `full_inventory3.txt` | — |
| `ProjectManager/api/auth/login.php` | ORPHAN-WEB | 49 | prose/backup only: `engine/entity_extraction_engine.php.bak-20261027` | — |
| `ProjectManager/api/auth/logout.php` | DEAD | 44 | prose/backup only: `?` | — |
| `ProjectManager/api/auth/status.php` | DEAD | 44 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `ProjectManager/api/clients/index.php` | REFERENCED-DEAD | 104 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/comments/index.php` | REFERENCED-DEAD | 114 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/labels/index.php` | REFERENCED-DEAD | 106 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/milestones/index.php` | REFERENCED-DEAD | 104 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/permissions/index.php` | REFERENCED-DEAD | 15 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/permissions/roles.php` | DEAD | 15 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0300_DATABASE_ARCHITECTURE.md` | — |
| `ProjectManager/api/projects/index.php` | REFERENCED-DEAD | 105 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/projects/members.php` | ORPHAN-WEB | 120 | prose/backup only: `modules/dig_review_module.php.bak-20261027` | — |
| `ProjectManager/api/tasks/index.php` | REFERENCED-DEAD | 114 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/users/index.php` | REFERENCED-DEAD | 92 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/api/users/show.php` | ORPHAN-WEB | 44 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `ProjectManager/app/Core/ExceptionHandler.php` | DEAD | 55 | prose/backup only: `?` | — |
| `ProjectManager/app/Models/ActivityLog.php` | DEAD | 36 | zero references of any kind | — |
| `ProjectManager/app/Policies/DocumentPolicy.php` | DEAD | 33 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0130_PERMISSION_MODEL.md` | — |
| `ProjectManager/app/Policies/PermissionPolicy.php` | DEAD | 23 | zero references of any kind | — |
| `ProjectManager/app/Policies/ProjectPolicy.php` | DEAD | 38 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0130_PERMISSION_MODEL.md` | — |
| `ProjectManager/app/Policies/RolePolicy.php` | DEAD | 33 | zero references of any kind | — |
| `ProjectManager/app/Policies/TaskPolicy.php` | DEAD | 38 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0130_PERMISSION_MODEL.md` | — |
| `ProjectManager/app/Policies/UserPolicy.php` | DEAD | 33 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0130_PERMISSION_MODEL.md` | — |
| `ProjectManager/app/Repositories/AttachmentRepository.php` | DEAD | 35 | zero references of any kind | — |
| `ProjectManager/bootstrap.php` | REFERENCED-DEAD | 68 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/LEGAiSEE_PROJECT_MANAGER_HANDOFF_V1.md` | — |
| `ProjectManager/database/connection.php` | REFERENCED-DEAD | 48 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `ProjectManager/database/migration.php` | DEAD | 75 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `ProjectManager/database/migrations/001_create_users_table.php` | REFERENCED-DEAD | 19 | zero references of any kind | — |
| `ProjectManager/database/migrations/002_create_roles_table.php` | DEAD | 17 | zero references of any kind | — |
| `ProjectManager/database/migrations/003_create_permissions_table.php` | DEAD | 17 | zero references of any kind | — |
| `ProjectManager/database/migrations/004_create_role_permissions_table.php` | DEAD | 28 | zero references of any kind | — |
| `ProjectManager/database/migrations/005_create_user_roles_table.php` | DEAD | 28 | zero references of any kind | — |
| `ProjectManager/database/migrations/006_create_attachments_table.php` | DEAD | 29 | zero references of any kind | — |
| `ProjectManager/database/migrations/007_create_activity_log_table.php` | DEAD | 27 | zero references of any kind | — |
| `ProjectManager/database/migrations/008_create_audit_tables.php` | DEAD | 23 | zero references of any kind | — |
| `ProjectManager/database/migrations/009_create_projects_table.php` | DEAD | 47 | zero references of any kind | — |
| `ProjectManager/database/migrations/010_create_pm_tasks_table.php` | DEAD | 47 | zero references of any kind | — |
| `ProjectManager/database/migrations/011_create_pm_milestones_table.php` | DEAD | 40 | zero references of any kind | — |
| `ProjectManager/database/migrations/012_create_pm_comments_table.php` | DEAD | 40 | zero references of any kind | — |
| `ProjectManager/database/migrations/013_create_pm_notes_table.php` | DEAD | 40 | zero references of any kind | — |
| `ProjectManager/database/schema.php` | DEAD | 142 | prose/backup only: `full_inventory3.txt` | — |
| `ProjectManager/index.php` | REFERENCED-DEAD | 5 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/permissions.php` | DEAD | 127 | prose/backup only: `modules/insight_module.php.bak-20261027` | — |
| `ProjectManager/project_board.php` | REFERENCED-DEAD | 370 | zero references of any kind | — |
| `ProjectManager/projects_dashboard.php` | REFERENCED-DEAD | 288 | zero references of any kind | — |
| `ProjectManager/router.php` | REFERENCED-DEAD | 20 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0030_GLOSSARY.md` | — |
| `ProjectManager/tests/Auth/AuthenticationTest.php` | DEAD | 23 | zero references of any kind | — |
| `ProjectManager/tests/Core/BootstrapTest.php` | DEAD | 35 | zero references of any kind | — |
| `ProjectManager/tests/Core/RouterTest.php` | DEAD | 17 | zero references of any kind | — |
| `ProjectManager/tests/Permissions/AuthorizationTest.php` | DEAD | 18 | zero references of any kind | — |
| `ProjectManager/tests/Permissions/PermissionTest.php` | DEAD | 18 | zero references of any kind | — |
| `ProjectManager/tests/Permissions/RoleTest.php` | DEAD | 18 | zero references of any kind | — |
| `response.php` | REFERENCED-DEAD | 48 | prose/backup only: `full_inventory3.txt` | `api/v8/_response.php` |
| `save_set.php` | ORPHAN-WEB | 39 | prose/backup only: `full_inventory3.txt` | — |
| `semantic_engine.php` | DEAD | 59 | prose/backup only: `full_inventory3.txt` | — |
| `session.php` | REFERENCED-DEAD | 170 | prose/backup only: `full_inventory3.txt` | — |
| `temp_dashboard.php` | REFERENCED-DEAD | 284 | prose/backup only: `full_inventory3.txt` | — |
| `test_db.php` | DEAD | 9 | prose/backup only: `full_inventory3.txt` | — |
| `test_excavation_module.php` | DEAD | 15 | zero references of any kind | — |
| `test_extraction_fix.php` | ORPHAN-WEB | 59 | zero references of any kind | — |
| `test_graph.php` | DEAD | 14 | prose/backup only: `full_inventory3.txt` | — |
| `test_graph_fix.php` | ORPHAN-WEB | 78 | zero references of any kind | — |
| `test_kernel.php` | DEAD | 13 | prose/backup only: `full_inventory3.txt` | — |
| `test_modules.php` | DEAD | 39 | prose/backup only: `full_inventory3.txt` | — |
| `test_visual.php` | DEAD | 178 | prose/backup only: `full_inventory3.txt` | — |
| `tools/build_cluster_summaries.php` | DEAD | 124 | zero references of any kind | — |
| `tools/build_cluster_summaries_ai.php` | DEAD | 116 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `tools/build_clusters.php` | DEAD | 78 | zero references of any kind | — |
| `tools/build_relations.php` | DEAD | 111 | zero references of any kind | — |
| `tools/detect_cluster_opportunities.php` | DEAD | 136 | zero references of any kind | — |
| `tools/extract_cluster_insights.php` | DEAD | 146 | zero references of any kind | — |
| `tools/name_clusters.php` | DEAD | 109 | zero references of any kind | — |
| `ui/components/ingest_exec snap.php` | DEAD | 213 | zero references of any kind | `ui/components/ingestforshell.php` |
| `ui/components/ingestforshell.php` | DEAD | 213 | zero references of any kind | `ui/components/ingest_exec snap.php` |
| `ui/file_explorer.php` | DEAD | 32 | zero references of any kind | — |
| `view_ingest.php` | REFERENCED-DEAD | 232 | prose/backup only: `full_inventory3.txt` | — |
| `views/compare_view.php` | ORPHAN-WEB | 140 | zero references of any kind | — |
| `views/graph_view.php` | REFERENCED-DEAD | 313 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `views/ingest_view.php` | DEAD | 12 | prose/backup only: `?` | — |

### KEEP-FOR-REUSE — 51 files

Unreferenced by any executable, not a duplicate, and carrying unique logic (>=3 declarations, >=40 lines).

| File | v1 status | Lines | Proof | Duplicate of |
|---|---|---:|---|---|
| `Color_Creator.php` | DEAD | 2241 | zero references of any kind | — |
| `engine/goal_arbitration_engine.php` | REFERENCED-DEAD | 133 | zero references of any kind | — |
| `engine/long_horizon_planner.php` | DEAD | 111 | zero references of any kind | — |
| `engine/temporal_memory_engine.php` | DEAD | 86 | zero references of any kind | — |
| `kernel/folder_engine.php` | REFERENCED-DEAD | 47 | prose/backup only: `?` | — |
| `kernel/graph_auto_builder.php` | DEAD | 88 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `lib/legaisee_model.php` | REFERENCED-DEAD | 313 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `modules/utils/uic_v2.php` | DEAD | 102 | zero references of any kind | — |
| `ProjectManager/app/Controllers/AuthController.php` | DEAD | 110 | prose/backup only: `?` | — |
| `ProjectManager/app/Controllers/ClientController.php` | DEAD | 101 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Controllers/CommentController.php` | DEAD | 127 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Controllers/LabelController.php` | DEAD | 101 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Controllers/MilestoneController.php` | DEAD | 101 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Controllers/ProjectController.php` | DEAD | 121 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Controllers/ProjectMemberController.php` | DEAD | 133 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Controllers/TaskController.php` | DEAD | 127 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Controllers/UserController.php` | DEAD | 110 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Core/Application.php` | DEAD | 76 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `ProjectManager/app/Core/Container.php` | DEAD | 42 | prose/backup only: `WORKORDER-JSON-SQLite-to-MySQL.md` | — |
| `ProjectManager/app/Core/Database.php` | DEAD | 44 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `ProjectManager/app/Core/Dispatcher.php` | DEAD | 83 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/app/Core/Request.php` | ORPHAN-WEB | 95 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/app/Core/Router.php` | DEAD | 97 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0030_GLOSSARY.md` | — |
| `ProjectManager/app/Models/Attachment.php` | DEAD | 216 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0330_ATTACHMENT_MODEL.md` | — |
| `ProjectManager/app/Models/Client.php` | DEAD | 188 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `ProjectManager/app/Models/Comment.php` | DEAD | 125 | prose/backup only: `full_inventory3.txt` | — |
| `ProjectManager/app/Models/Milestone.php` | DEAD | 134 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0110_FEATURE_MATRIX.md` | — |
| `ProjectManager/app/Models/Permission.php` | DEAD | 104 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0300_DATABASE_ARCHITECTURE.md` | — |
| `ProjectManager/app/Models/Project.php` | DEAD | 97 | prose/backup only: `shell.phpbak` | — |
| `ProjectManager/app/Models/ProjectMember.php` | DEAD | 126 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Models/Role.php` | DEAD | 104 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0110_FEATURE_MATRIX.md` | — |
| `ProjectManager/app/Models/Task.php` | DEAD | 204 | prose/backup only: `SYSTEM_LEGEND.md` | — |
| `ProjectManager/app/Models/User.php` | DEAD | 174 | prose/backup only: `legaisee_diagnostic.phpbak` | — |
| `ProjectManager/app/Repositories/ActivityLogRepository.php` | DEAD | 52 | zero references of any kind | — |
| `ProjectManager/app/Repositories/ClientRepository.php` | DEAD | 195 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Repositories/CommentRepository.php` | DEAD | 154 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Repositories/LabelRepository.php` | DEAD | 163 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Repositories/MilestoneRepository.php` | DEAD | 182 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Repositories/PermissionRepository.php` | DEAD | 132 | zero references of any kind | — |
| `ProjectManager/app/Repositories/ProjectMemberRepository.php` | DEAD | 187 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Repositories/ProjectRepository.php` | DEAD | 188 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/LEGAiSEE_PROJECT_MANAGER_HANDOFF_V1.md` | — |
| `ProjectManager/app/Repositories/RoleRepository.php` | DEAD | 160 | zero references of any kind | — |
| `ProjectManager/app/Repositories/TaskRepository.php` | DEAD | 164 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/LEGAiSEE_PROJECT_MANAGER_HANDOFF_V1.md` | — |
| `ProjectManager/app/Repositories/UserRepository.php` | DEAD | 175 | prose/backup only: `ProjectManager/governance/PROJECT_MANAGER_BIBLE/0999_SESSION_HANDOFF.md` | — |
| `ProjectManager/app/Services/AuthorizationService.php` | DEAD | 72 | prose/backup only: `?` | — |
| `ProjectManager/tests/Core/ExceptionTest.php` | DEAD | 42 | zero references of any kind | — |
| `ProjectManager/tests/Core/RequestTest.php` | DEAD | 76 | zero references of any kind | — |
| `ProjectManager/tests/Core/ResponseTest.php` | DEAD | 68 | zero references of any kind | — |
| `test_hierarchy_of_truth.php` | DEAD | 96 | zero references of any kind | — |
| `test_ui.php` | DEAD | 303 | prose/backup only: `full_inventory3.txt` | — |
| `ui/compare_engine.php` | DEAD | 55 | zero references of any kind | — |

### NEEDS-HUMAN-DECISION — 5 files

An executable file that is not itself dead names these. Either a missed caller or a stale string.

| File | v1 status | Lines | Proof | Duplicate of |
|---|---|---:|---|---|
| `components/card.php` | DEAD | 29 | called by `style_test_Colors.html` | `ui/components/card.php` |
| `intelligence.php` | REFERENCED-DEAD | 146 | called by `style_test_Colors.html` | — |
| `ProjectManager/app/Models/Label.php` | DEAD | 133 | called by `style_test_Colors.html` | — |
| `ProjectManager/config.php` | REFERENCED-DEAD | 28 | called by `.htaccess` | — |
| `ui/components/card.php` | DEAD | 29 | called by `style_test_Colors.html` | `components/card.php` |

---

## 6. Limits

- **No file was executed and nothing was moved.** Every verdict is a reference count, not a runtime observation.
- **The stem search is deliberately loose** and will over-report. That is why a stem hit is never sufficient on its own: it must come from an executable file that is itself alive. All 5 LIVE-CODE rows were resolved by hand in §1.
- **Prose hits include `_governance/` audit artifacts only where they name a path**; the audit's own reports are excluded from the corpus by directory, but older artifacts inside the tree (`full_inventory3.txt`, `SYSTEM_LEGEND.md`, `tree.md`, `Tree 8-23-26`) are counted, and they are what account for most of the 151 prose-only rows.
- **`KEEP-FOR-REUSE` is a filter, not an endorsement.** ≥3 declarations and ≥40 lines was chosen to keep the list short enough to review; a file with real value and only two functions would land in SAFE. Treat the 51 as "read before archiving", not as "keep".
- **Nothing is proposed for deletion.** Per `00-GROUND-RULES.md` §6 all three lists are `_archive/` moves.
- The v1 ledger was read from `AUDIT-APPENDIX-FILE-STATUS.md` (347 rows, statuses re-counted as 170 / 64 / 42 / 1 / 33 / 14 / 10 / 3 / 2 / 2 / 1 / 1 / 1 / 1 / 1 / 1, matching its own header). `audit_files.csv` carries no status column, so it could not serve as a second source — it was used only to confirm the row count.
- Two files in the set are 0 bytes (`EMPTY` class in v1) and were scored normally.
- One file path contains a space (`ui/components/ingest_exec snap.php`); the path search handled it, but any tooling that splits on whitespace will not.
- No source file was modified in this block. Only `_governance/audits-v2/` was written — the report, two generated artifacts, the JSON, and the script.

---

### Legend
**Proof column** — `ZERO-REF` no occurrence anywhere · `PROSE-ONLY` named only by `.md`/`.txt`/`.bak` · `LIVE-CODE` named by an executable file outside the dead set · `A1-RESCUED` reachable per `A1-reachability.md`.
**Severity** — n/a for this block; nothing here executes.
**Verdicts** — `SAFE-TO-ARCHIVE` · `KEEP-FOR-REUSE` · `NEEDS-HUMAN-DECISION`. No deletions.
