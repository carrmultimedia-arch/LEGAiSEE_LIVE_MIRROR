# LEGAiSEE Command Center — Full Connection, Subsystem & Data-Layer Audit

**Date:** 2026-10-29
**Scope:** every file under `commandcenter/` (2,255 files excluding `.git`)
**Method:** static analysis — `include`/`require` resolution (568 edges), function-definition vs call-site cross-reference (209 edges), storage-layer fingerprinting, and reachability closure from `shell.php` / `api/*.php` / `cli/*.php`. Machine output: `_governance/audit_graph.json`, `_governance/audit_files.csv`. Per-file table: **`_governance/AUDIT-APPENDIX-FILE-STATUS.md`**.

---

## 0. What was measured, and what this audit cannot see

| Measure | Value |
|---|---|
| Files in tree (no `.git`) | 2,255 |
| PHP files total | 1,237 |
| — third-party (`ProjectManager/vendor`, `lib/vendor`, `lib/dompdf`) | 861 |
| — archive/backup (`z_Deleted`, `_backup`, `archive`, `.bak-*`) | 29 |
| — **first-party, non-archive — the 347 appendix rows** | **347** |
| — first-party total | 376 |
| Non-PHP (docs, JSON stores, images, dumps) | 1,018 |
| Include/require edges resolved | 568 |
| Function call edges (unambiguous) | 209 |
| Files reachable from `shell.php` | 26 static = 17 first-party + 9 dompdf vendor; +35 modules via registry dispatch |
| Files reachable from referenced endpoints/CLI | 39 |
| First-party files with **no path from any live entry point** | 277 of 347 |
| MySQL tables in the pre-migration dump | 51 |
| SQLite files / SQLite code paths | 2 files / **1 code path** |

**Limits, stated up front.** Static analysis cannot follow three things, and all three matter here:

1. **Registry dispatch.** `shell.php` does `require __DIR__.'/modules/'.$registry[$name]` — a computed path. No static tool can resolve it, so all 35 registered modules are counted as reachable by registry contract, not by proven edge.
2. **String-built calls** (`$fn()`, `call_user_func`) and AJAX URLs assembled in JavaScript.
3. **Runtime truth.** Everything below is what the code says. It is not a live-server test. Row counts, table contents and actual page behaviour are unverified — the dump is the only evidence of live data.

---

## 1. Connection map — what connects to what

### 1.1 The live spine

```
shell.php  (19,456 b — the only routable page)
 ├── kernel/kernel_boot.php ──► kernel/db.php ──► config.php ──► config.local.php
 │                              (kernel_db(): MySQL PDO, static singleton)
 ├── kernel/module_registry.php   ← 35 name => file pairs
 ├── modules/utils/bootstrap.php  ← defines load_json_dir()  ← the legacy JSON doorway
 ├── modules/utils/uic_v1.php    ← renders UIC component arrays
 └── ui/ui_bootstrap.php         ← CSS/asset injection
        │
        └── $file = modules/<registry[$module]>   ← 35 surfaces, one per URL
                 │
                 ├── kernel_db()  → MySQL  (16 modules)
                 ├── load_json_dir() → data/cases, data/clients  (10 modules)
                 └── require engine/*.php  (only excavation_module does this)
```

Three modules have **early intercepts** in `shell.php` before any HTML is emitted — `report` (PDF generation), `vault` (download), `brain` (run). These are the only places where a module is `require`d directly rather than through the registry, which is why they appear in the static closure and the other 32 do not.

### 1.2 What is connected, concretely

| Connection | Mechanism | Files |
|---|---|---|
| Page → kernel | `require_once __DIR__.'/kernel/kernel_boot.php'` | `shell.php`, 29 endpoint scripts |
| Any file → DB | `kernel_db()` (MySQL PDO) — **68 inbound edges**, the single most connected symbol in the tree | `kernel/db.php` |
| Page → feature | `kernel/module_registry.php` lookup | 35 modules |
| Feature → engine | `require`, **only 5 call sites exist** | `modules/excavation_module.php` → `entity_extraction_engine.php`; `api/v8/{recommendations,cluster_insights,dashboard,build_graph}.php` → 4 engines; `cli/worker.php` → 6 engines |
| Browser → endpoint | `fetch`/XHR from module JS, **3 endpoints only** | `api/search_load.php` ← `modules/search_module.php`; `api/files_action.php` ← `modules/files_module.php`; `api/brain_orchestrator.php` ← `modules/brain_module.php` (which then calls `api/model_router.php` + `api/brain_synthesis.php`) |
| Search → content | filesystem scan + DB | `modules/search_module.php`, `api/search_load.php` → `data/{cases,clients,prospects,network}` + MySQL |
| Reports → PDF | dompdf | `modules/report_module.php` ← `lib/dompdf/autoload.inc.php` |
| Payment → Stripe | Composer SDK | `modules/payment_module.php` ← `lib/vendor/autoload.php` |
| CLI → engines | `require` | `cli/worker.php` → `cluster_engine.php`**✗missing**, `reasoning_engine.php`, `recommendation_engine.php`, `pipeline_adapters.php`, `system_insight_engine.php`, `predictive_intelligence_engine.php` |

### 1.3 What is *not* connected

| Dead surface | Files | Evidence |
|---|---|---|
| `api.php` → `api/v8/*` | 1 + 35 | `api.php` has zero inbound references. All 35 `api/v8` files are unreachable; the 4 that `require` engines pull those engines into no user path. |
| `api/` top-level agent endpoints | 28 of 33 | Zero references anywhere. Only `search_load`, `files_action`, `brain_orchestrator`, `brain_synthesis`, `model_router` are named by live code. `api/file.php` is named only by a **PHPMailer vendor test**. |
| `engine/` governance families | 37 files, 14 fully isolated | No internal includes at all for 14 of them; 22 of 37 never reached by any entry point. |
| `cli/chain_generator.php`, `cli/chain_evolver.php` | 2 | No caller, no cron entry. |
| `ProjectManager/` | 88 | Separate app with its own `config.php`, `bootstrap.php`, router and 13 migrations. Nothing in `shell.php` or `api/` references it. |
| `components/`, `views/`, `pages/` | 13 | Zero consumers except `lib/semantic_diff_engine.php` touching `pages/`. |
| `ExcavationCommand/` | 3 | Duplicated verbatim inside `z_Deleted by claude/commandcenter/`. |
| Root scripts | 39 of 49 | `test_*.php`, `peek.php`, `temp_dashboard.php`, `view_ingest.php`, `create_*.php`, `diagnostics2.php` — web-reachable but nothing links to them. |
| `kernel/engine_bindings.php` | 1 | Declares which engines each module should use. **Nothing reads it.** The intent exists; the wiring does not. |

**The headline:** of 376 first-party PHP files, **58 do work in the live system** — 14 in the `shell.php` closure, 33 registry modules, 10 reachable endpoints, 1 worker-chain engine. A further 10 are broken or built-but-unwired. The remaining **277 have no path from any live entry point**, and 29 are archive copies.

---

## 2. Subsystems

Formed from the connection graph, the registry, and the engine call families. Each is a real functional group, not a directory listing.

### S1 — Runtime spine & data access
**Files:** `shell.php`, `kernel/kernel_boot.php`, `kernel/db.php`, `kernel/kernel_paths.php`, `kernel/module_registry.php`, `kernel/bootstrap.php`, `kernel/kernel.php`, `config.php`, `config.local.php`, `db.php`, `ui/ui_bootstrap.php` (11)
**What it does:** authenticates the request, starts the session, opens one MySQL PDO handle, announces the 35 module names, and renders whatever fragment the module returns.
**Business value:** this is uptime. Every other subsystem fails if `kernel_db()` fails. It is also the security boundary — and currently has none (no auth guard is included; `kernel/guard.php` exists and is never loaded).
**Status:** LIVE. `kernel/kernel.php` is a deprecated stub. `kernel/guard.php` is dead-but-wanted.

### S2 — Module surfaces (the product screens)
**Files:** 35 registered modules + 3 unregistered (`governance_module.php` 17 KB, `build_dossier.php`, `001_create_tree_nodes.php`) (38)
**What it does:** one screen each — cockpit, clients, cases, graph, insight, ingest, search, report, vault, payment, pm, dig review, and 23 more.
**Business value:** this *is* the product the client sees. Each screen maps to a deliverable an analyst bills for.
**Status:** 35 ROUTED, 3 invisible (unregistered files — code exists, no URL).

### S3 — Search & retrieval
**Files:** `modules/search_module.php` (17 KB), `api/search_load.php` (6.6 KB), `normalized/` (36 docs), `modules/utils/bootstrap.php` (5)
**What it does:** scans `data/cases`, `data/clients`, `data/prospects`, `data/network` as raw text and JSON, plus MySQL rows; returns snippets into a two-pane compare view; streams full document text into either pane.
**Business value:** the "find the one email that matters" capability. In litigation/excavation work this is the highest-frequency action in the day.
**Status:** LIVE but **dual-store** — every search reads the filesystem directly. `normalized/` holds 36 extracted documents that no MySQL table indexes.

### S4 — File browser & report vault
**Files:** `modules/files_module.php` (19 KB), `api/files_action.php` (15 KB), `modules/vault_module.php`, `api/file.php`, `api/tree.php`, `api/file_tree.php` (6)
**What it does:** a Windows/macOS-style browser over the app's own filesystem (create/rename/move/delete/download), plus retrieval of generated PDFs from `data/clients/**`.
**Business value:** gets finished work product to the client without FTP. Directly billable delivery.
**Status:** LIVE. `api/file.php` and `api/tree.php` are dead siblings; `vault_module.php` has a path-traversal check that depends on `realpath()` and should be re-tested.

### S5 — Ingest & review queue
**Files:** `modules/ingest_module.php` (15.8 KB), `modules/ingest_view_module.php`, `modules/dig_review_module.php` (26 KB — largest module), `ingest.php`, `ingest2.php`, `create_session.php`, `session.php` (7)
**What it does:** takes raw AI-chat exports, normalizes them into `normalized/` + `memory_ingest`/`memory_chunks`, and gives a human a review queue to accept/reject extracted findings before they become case facts.
**Business value:** this is the intake valve for the whole business. Without it, nothing enters the system; with a weak one, bad data poisons every downstream report.
**Status:** LIVE. `ingest.php` and `ingest2.php` are **byte-identical** — one must go.

### S6 — Excavation & entity extraction
**Files:** `modules/excavation_module.php` (9.8 KB), `engine/entity_extraction_engine.php` (14.4 KB), `modules/entity_resolution_module.php`, `prospect.php` (30 KB), `engine/hierarchy_of_truth_engine.php` (6.8 KB) (5)
**What it does:** walks artifact folders (`data/clients/<id>/cases/<case>/files/*`), extracts entities and relationships from text, writes to MySQL. `prospect.php` is a standalone prospect-dossier page on the same engine.
**Business value:** the actual intellectual work — turning a pile of documents into named people, companies, and links. This is the billable unit ("shallow dig" at $500 up to "Exhibit G" at $250,000).
**Status:** LIVE, and the **only** module that pulls an engine in directly. `hierarchy_of_truth_engine.php` is unused.

### S7 — Knowledge graph
**Files:** `modules/graph_module.php`, `cluster_module.php`, `semantic_cluster_module.php`, `root_cause_graph_module.php`, `engine/graph_engine.php`, `kernel/graph_engine.php`, `engine/semantic_cluster_engine.php`, `engine/graph_mutation_engine.php`, `views/graph_view.php`, `api/v8/build_graph.php` (10)
**What it does:** entities → nodes, relationships → edges, then clustering and root-cause walking over the result.
**Business value:** the visual artifact clients pay for — "here is who is connected to whom, and here is the choke point". The `graph_module` is one of only 5 MySQL-native modules.
**Status:** partially LIVE. **Three different graph engines** exist (`kernel/`, `engine/`, plus `views/graph_view.php` with its own traversal). Two are dead.

### S8 — Insight, recommendation & the "brain"
**Files:** `modules/insight_module.php` (14 KB), `modules/brain_module.php`, `modules/recommendation_module.php`, `modules/predictive_module.php`, `modules/decision_module.php`, `modules/cross_case_engine.php`, `engine/{system_insight,system_recommendation,cross_case,recommendation,predictive_intelligence,reasoning,decision_engine_v2,portfolio,memory_evolution}_engine.php`, `engine/plain_english_helper.php`, `api/brain_orchestrator.php`, `api/brain_synthesis.php`, `api/model_router.php` (21+)
**What it does:** two different things wearing one name. (a) The **live** path: `brain_module.php` → `api/brain_orchestrator.php` → `api/model_router.php` → weighted synthesis. (b) The **dead** path: eight engine files that compute insight/recommendation from JSON and are never called.
**Business value:** the differentiator. Anyone can show a graph; "here is what it means and what to do next, in English, for this business" is the product. `plain_english_helper.php` (12.9 KB, 11 module types) is the piece that converts numbers into that sentence — and it is **not wired to anything**.
**Status:** LIVE thin (brain API), DEAD thick (engines). This is the largest value sitting behind a missing `require`.

### S9 — Executive reporting, PM & payments
**Files:** `modules/report_module.php`, `cockpit_module.php`, `executive_dashboard_module.php`, `time_intelligence_module.php`, `anomaly_engine_module.php`, `pm_module.php` (47 KB), `payment_module.php` (12 KB), `ProjectManager/**` (88) (95)
**What it does:** generates PDF reports via dompdf, aggregates the executive dashboard, manages projects/tasks/milestones, and runs Stripe Checkout across eight price tiers ($500 → $250,000) with email notification.
**Business value:** **revenue and delivery**. `payment_module.php` is the only place money enters. `pm_module.php` at 47 KB is the largest single feature in the tree.
**Status:** payment and PM modules are LIVE and MySQL-native. `ProjectManager/` is a complete parallel PM app that nothing calls — the strongest "finish me" candidate in the audit.

### S10 — Autonomous agent families (five abandoned attempts)
**Files:** `api/` top-level agent endpoints (28), `api/v8/*` (35), `api.php`, `engine/` goal→decision→execution→feedback chain (~17), `cli/chain_*` (2), `pages/`, `components/` (≈83)
**What it does:** on paper, goal generation → arbitration → policy → execution routing → feedback → learning. In practice: five separate architectures, none reachable, each with its own flat-file convention under `data/{goals,chains,events,agents,mesh,portfolio}`.
**Business value:** *if finished*, unattended analysis — the system proposing its own next moves. Today: zero. It is sunk cost, and 85 files of it obscure the 42 that work.
**Status:** DEAD. One sub-chain (`decision_engine_v2` → `system_insight_engine` → `cross_case_engine`) is internally consistent and worth extracting before deletion.

### S11 — Legacy stores & prototypes
**Files:** `data/` (103 JSON), `clients/` (19 JSON), `ExcavationCommand/`, `pages/`, `views/`, `components/`, `Color_Creator.php` (73 KB), `legaisee_prospects.php` (72 KB), `legaisee.db`, `test_*.php` (11) (≈150)
**What it does:** the pre-MySQL world — one JSON file per case/client/prospect/network, plus two standalone mega-scripts and a second `index.php`-era prototype.
**Business value:** the JSON files are the **actual client records** accumulated before the MySQL migration. They are not garbage; they are the data the business currently depends on and that the migration must carry.
**Status:** SOURCE-OF-TRUTH RISK. See §3.

### S12 — ProjectManager (standalone app)
**Files:** 88 (`app/` MVC, 13 migrations, `api/`, `governance/`, `tests/`)
**What it does:** disciplined MVC project management — users, roles, permissions, projects, tasks, milestones, comments, labels, attachments, activity log.
**Business value:** if the firm runs engagements through this instead of spreadsheets, it is operational backbone.
**Status:** backend finished and clean; UI chapters are 0-byte placeholders; nothing links to it; its `TaskRepository` has a known `pm_tasks`/`projects` table-name mismatch.

---

## 3. Data layer — MySQL vs JSON vs SQLite

### 3.1 The truth about SQLite

**There is no SQLite system in use.** One code path mentions it:

- `kernel/system_health.php:52` — `SELECT name FROM sqlite_master WHERE type='table'` executed against the **MySQL** PDO. On MySQL this throws; the surrounding `try` swallows it, so the diagnostics report has always been half-empty. This is the only SQLite query in the 347 non-archive files.

Artifacts left behind: `legaisee.db` (57,344 b, last written 2026-10-21 — pre-migration leftover), `kernel/legaisee.db` (**0 bytes**), and `database/migrations/010_create_tree_nodes_table.php` (+ its `bk` duplicate) which emits SQLite syntax (`AUTOINCREMENT`, `INTEGER PRIMARY KEY`) against a MySQL-only config.

**Conclusion:** nothing needs "SQLite→MySQL migration" except deleting the stale files and rewriting one `SELECT`. The real migration is **JSON → MySQL**, which is exactly what `WORKORDER-JSON-SQLite-to-MySQL.md` is for.

### 3.2 Storage tiers across the 347 non-archive first-party files

| Tier | Files | Meaning |
|---|---:|---|
| `MYSQL` | 74 | calls `kernel_db()`, prepares/queries MySQL |
| `MYSQL+JSON` | 9 | reads MySQL **and** falls back to scanning JSON dirs — the seam |
| `JSON` | 34 | reads `data/`, `clients/`, `normalized/` directly |
| `SQLITE` | 1 | `kernel/system_health.php` |
| `NONE` | 229 | UI, config, pure compute, dead code |

MySQL is authoritative: 51 tables in the dump, 70 `INSERT` statements (so it holds real rows), InnoDB/utf8mb4 (one MyISAM table).

### 3.3 The JSON residue — merge or rewrite

| File | Reads | Verdict | Why |
|---|---|---|---|
| `modules/cases_module.php` | `data/cases`, `data/clients` | **MERGE** | `cases`, `clients` tables exist; same fields; mechanical |
| `modules/relations_module.php` | `data/cases`, `data/clients` | **MERGE** | `relationships` + `entity_aliases` exist |
| `modules/dashboard_module.php` | `data/cases`, `data/clients` | **MERGE** | pure counts |
| `modules/alert_module.php` | `data/cases` | **MERGE** | count + sort |
| `modules/recommendation_module.php` | `data/cases` | **MERGE** | pattern→action lookup, no schema change needed |
| `modules/time_intelligence_module.php` | `data/cases` | **MERGE** | date bucketing over `cases.created_at` |
| `modules/root_cause_graph_module.php` | `data/cases` | **MERGE** | walks `relationships` |
| `modules/predictive_module.php` | `data/cases` | **MERGE** | trend over counts |
| `modules/decision_module.php` | `data/cases` | **MERGE** | rule pass over case rows |
| `modules/executive_dashboard_module.php` | `data/cases`, `data/clients` | **MERGE** | aggregate of the above |
| `modules/search_module.php` | 4 JSON dirs + MySQL | **REWRITE** | replace `scandir`+`stripos` with a `FULLTEXT` index over `documents`/`memory_chunks` |
| `api/search_load.php` | 4 JSON dirs + MySQL | **REWRITE** | same — it is the content half of search |
| `modules/cross_case_engine.php` | `data/cases`, `data/clients` | **REWRITE** | header says "operates ONLY on /data JSON schema"; needs real joins across `cases`+`entities` |
| `engine/cross_case_engine.php` | `data/` | **REWRITE** | same logic, second copy |
| `engine/portfolio_engine.php` | `data/portfolio` | **REWRITE** | no `portfolio` table exists — schema must be added |
| `engine/predictive_intelligence_engine.php`, `engine/memory_evolution_engine.php` | JSON | **REWRITE or DELETE** | dead; rewrite only if adopted |
| `cli/worker.php` | JSON + 6 engines | **REWRITE** | queue must come from `processing_queue`/`tasks`, not files |
| `modules/brain_module.php` | JSON + brain API | **REWRITE** | prompt context should be SQL, not file scan |
| `modules/excavation_module.php` | `data/clients/**/files/*` | **PARTIAL** | keep filesystem walk for raw artifacts; write results to `artifacts`/`files` (already does for entities) |
| `modules/vault_module.php` | `data/clients/**` PDFs | **KEEP** | binary deliverables legitimately live on disk; only the path guard needs hardening |
| `api/files_action.php`, `modules/files_module.php` | app filesystem | **KEEP** | a file browser is supposed to touch the filesystem |
| `modules/governance_module.php` | `data/*` | **DELETE or REWRITE** | 17 KB, unregistered, no URL |

**Net:** 10 modules merge mechanically (SQL already exists), 7 need real rewrites, 3 legitimately stay on disk. That is a far smaller job than "migrate everything", and it matches the 9-phase work order already written.

### 3.4 Files that must be rewritten regardless of data layer

| File | Defect |
|---|---|
| `cli/worker.php` | `require engine/cluster_engine.php` — **file does not exist** (the 0-byte decoy now lives in `z_Deleted/Engine/`). Worker dies on load. Point at root `cluster_engine.php`. |
| `kernel/system_health.php` | SQLite query against MySQL; also its `required` table list (`page`, `page_content`, `clusters`, `page_relations`) is from the abandoned prototype. |
| `engine/pipeline_adapters.php` | Requires `recommendation_engine.php` twice; requires the missing cluster engine. |
| `database/migrations/010_*` (×2) | SQLite DDL against MySQL; two byte-identical copies. |
| `modules/ingest_view_module.php` | Queries `memory_ingest` while the dump's table is `memory_ingests`/`memory_ingest` — needs confirmation against the live schema. |
| `ProjectManager/app/Repositories/TaskRepository.php` | `pm_tasks` vs `projects` mismatch (per prior audit). |
| `api/brain_orchestrator.php` → `api/model_router.php` | Router is a stub returning canned responses; the orchestration shape is right, the model calls are not real. |

---

## 4. Status of every file

Complete per-file table: **`_governance/AUDIT-APPENDIX-FILE-STATUS.md`** (347 rows, one per non-archive first-party file, with storage tier, status, first caller, and required action). Machine-readable: `_governance/audit_files.csv`.

Summary by status:

| Status | Count | Meaning | Action |
|---|---:|---|---|
| `LIVE-CORE` | 14 | in the `shell.php` closure | keep |
| `ROUTED` | 33 | loaded through the registry (2 more are overridden below) | keep; migrate 10 off JSON |
| `LIVE-ENDPOINT` | 10 | reached from a referenced `api`/`cli` script | keep |
| `LIVE-VIA-WORKER` | 1 | `cluster_engine.php` (root) | fix worker first |
| `BROKEN` | 3 | worker, system_health, pipeline_adapters | rewrite |
| `DEAD-CONFIG` | 1 | `kernel/engine_bindings.php` — nothing reads it | wire or delete |
| `DEAD-BUT-WANTED` | 2 | `plain_english_helper.php`, `guard.php` | integrate |
| `UNREGISTERED` 2 / `MOCK` 1 / `SHELL-ONLY` 1 | 4 | built but invisible, fake, or half-finished | register / replace / finish |
| `DEAD` 170 / `REFERENCED-DEAD` 64 / `ORPHAN-WEB` 42 / `ORPHAN-INCLUDED` 1 | **277** | no path from any live entry point | delete after diff |
| `EMPTY` | 2 | 0-byte first-party (`modules/archive/build_dossier.php`, `modules/project_manager/project_manager.php`) | delete |
| `ARCHIVE` | 29 PHP (55 files incl. non-PHP) | `.bak-*`, `z_Deleted`, `_backup` | delete after confirmation |
| `THIRD-PARTY` | 861 | vendor | never edit |

**Delete-safe now (verified duplicates, no unique content):** `ingest2.php` (byte-identical to `ingest.php`), `components/card.php` (identical to `ui/components/card.php`), `response.php` (identical to `api/v8/_response.php`), `database/migrations/010_create_tree_nodes_tablebk.php`, `ui/components/ingest_exec snap.php` (identical to `ingestforshell.php`), `modules/archive/build_dossier.php` and `modules/project_manager/project_manager.php` (0 bytes), `kernel/legaisee.db` (0 bytes), `legaisee.db` (stale), all 55 `.bak-*`/`.phpbak`/`z_Deleted` files.

---

## 5. What this audit says to do, in order

1. **Fix the three broken loaders** (`cli/worker.php`, `kernel/system_health.php`, `engine/pipeline_adapters.php`). They are 3 files, each a one- or two-line change, and they unblock all diagnostics.
2. **Wire the four built-but-invisible assets** in one pass: `plain_english_helper.php` into graph + recommendation output; `guard.php` into `kernel_boot.php`; `engine_bindings.php` into `load_module.php`; `governance_module.php` into the registry (or delete it).
3. **Run the 10 mechanical JSON→MySQL module merges** (the work order's P1–P4). All target tables already exist in the 51-table dump.
4. **Delete the 55 archive files + 277 unreachable files** after `git diff` confirmation. This alone cuts the tree from 376 first-party files to roughly 70 that matter — and removes the duplicate-name hazards (`graph_engine`, `recommendation_engine`, `bootstrap`, `config`) that have repeatedly caused fixes to be applied to the wrong copy.
5. **Then, and only then, decide on the autonomous-agent families.** Extract the one working sub-chain, delete the other 84 files.
6. **Rotate the credentials** in `config.local.php` and `sftp.json` — tracked, plaintext, and both were flagged in the August audits. This audit confirms they are still in the tree, still tracked, still loaded by live code.

---

*Audit performed by static analysis on 2026-10-29. No source file was modified. Scripts: `_governance/tools/audit_scan.py`, `_governance/tools/report_gen.py`.*
