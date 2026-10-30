# WORK ORDER — Move all LEGAiSEE data access onto MySQL

**Ticket:** WO-001 · JSON/SQLite → MySQL consolidation
**Scope:** `commandcenter/` (excludes `ProjectManager/` and `vendor/`)
**Status:** Ready for execution · **Code changes made by this document:** none
**Evidence base:** tokenized scan of all 347 non-vendor, non-backup PHP files; 236 JSON/SQLite touch lines; 93 files with JSON file I/O; 3 SQLite artifacts; 12 live JSON data domains.

---

## 1. Objective

Every read and write of *application data* goes through `kernel_db()` (the existing MySQL PDO). No PHP file may open a `.json` file to obtain records, and no file may reference SQLite.

**Definition of done (all must be true):**

1. `grep -rn "load_json_dir\|sqlite" --include=*.php .` returns **zero** hits outside `kernel/store.php` history comments.
2. `grep -rln "file_get_contents.*\.json" --include=*.php .` returns only the one-time importer.
3. `data/` can be renamed to `data.archived/` and the application works with **no code edits** — this is the real acceptance test.
4. Row counts in MySQL match the pre-migration file inventory (§4).
5. Every module in `kernel/module_registry.php` renders without a PHP warning or a "0 records" regression.

**Not in scope** (deliberate, and the reason is stated in §11): binary artifacts (PDFs, uploads), `.txt` governance policy files, AI/LLM HTTP request bodies, and the `ProjectManager/` MVC stack, which has its own database and migrations.

---

## 2. Ground rules

- **Data goes in columns; blobs become rows + a disk path.** A PDF report stays a file at `data/clients/{id}/cases/{case}/reports/*.pdf`; only its metadata becomes `case_artifacts` / `dossiers` rows. Do **not** base64 PDFs into MySQL.
- **JSON columns are allowed** for genuinely schemaless payloads (`networks.nodes`, `brain_sessions.payload`). MySQL 5.7+ required. Structured fields that get filtered or counted (`status`, `client_id`, `type`) must be **real columns**, not keys inside JSON — otherwise `dashboard_module` counting cases turns into a full-table scan.
- **No new dependencies.** No ORM, no Doctrine, no migration framework. Plain PDO + prepared statements, matching `modules/payment_module.php` and `kernel/db.php` style.
- **No module contract changes.** Modules still `return` array / string per `kernel/module_contract.php`. Only the data source changes.
- **One release of dual-read.** During the migration window, reads come from MySQL; the importer is the only thing that reads JSON. Do not build a permanent two-source fallback — that is how this codebase got into its current state.
- **Every change is reversible** by the phase tag (`P1`…`P9`) in the commit subject.

---

## 3. What is actually broken today (why this is urgent, not cosmetic)

| Fact | Consequence |
|---|---|
| `cases` and `clients` MySQL tables exist and are referenced 7× and 3×, but **nothing in the codebase writes to either** | All case/client truth lives in 7.3 MB + 6.3 MB of JSON. The MySQL tables are empty scenery. |
| `load_json_dir()` in `modules/utils/bootstrap.php:3-34` does an unguarded `scandir` + `json_decode` per request | Every dashboard render reads the whole directory off disk; one malformed file silently returns `[]` (`is_array` check at line 27 drops it). |
| JSON writes use `file_put_contents` with no lock (`api/case_tick.php:43`, `api/network_tick.php:39`, `api/v8/build_edges.php:28`, `kernel/graph_auto_builder.php:82`, 20+ others) | Concurrent ticks interleave and truncate each other. This is data loss, today. |
| `kernel/system_health.php:50` runs `SELECT name FROM sqlite_master` on a **MySQL** PDO | The query always throws, is swallowed by the `try/catch`, and `database.status` reports `ERROR` on every single health check. |
| `data/` sits inside the web root | Every client profile and prospect record is fetchable by URL. |

---

## 4. Data inventory — what must land in a table

| JSON domain | Files | Size | Target table(s) | Notes |
|---|---|---|---|---|
| `data/cases/*.json` | 17 | 7.3 MB | `cases` (+ `case_patterns`) | Flat records: `id`, `client_id`, `status`, `analysis.patterns` |
| `data/cases/1/{meta,network}.json`, `tasks/`, `goals/`, `memory/` | 11 | ~2.8 MB | `cases`, `networks`, `case_tasks`, `case_goals`, `case_memory` | Prototype subtree; same shape as `data/clients/*/cases/*` |
| `data/clients/*.json` (flat) | 5 | 6.3 MB | `clients` | Mirrors the `profiles.json` shape |
| `data/clients/{id}/profile.json` | 5 dirs | — | `clients` | Canonical write path in `engine/client_manager.php:17` |
| `data/clients/{id}/cases/{case}/meta.json` | 6 | — | `cases` | Read by 8 modules via `glob` |
| `data/clients/{id}/cases/{case}/network.json` | 6 | — | `networks` + `network_nodes` + `network_edges` | Written by `engine/case_manager.php:11` |
| `insights.json` per case | 4 | — | `case_insights` | Written by `relations_module:154`, `entity_resolution_module:111` |
| `clusters.json` per case | 4 | — | `case_clusters` | Written by `semantic_cluster_module:211` |
| `data/network/*.json` | 9 | 2.3 MB | `networks` (+ nodes/edges) | 20 `api/v8/*` endpoints read one of these by hardcoded id |
| `data/prospects/*.json` | 27 | 6.6 MB | `prospects` | Written by `prospect.php:228` |
| `data/brains/*.json` | 3 | 768 KB | `brain_sessions` | 7 `api/brain_*` endpoints rewrite the whole file per turn |
| `data/goals/`, `data/portfolio/`, `data/events/`, `data/auto_log/`, `data/memory/`, `data/chains/` | 14 | 2.6 MB | `goals`, `portfolios`, `events`, `auto_log`, `case_memory`, `chains` | `chains` also read by both CLI chain tools |
| `sets/*.json`, `sessions/*.json` | ~6 | — | `saved_sets`, `session_meta` | `save_set.php`, `load_sets.php`, `create_session.php`, `session.php` |
| Empty dirs: `agents, agency, graph, mesh, predictions, files, goal_log, compressed` | 0 | 0 | — | **Delete**, do not migrate. Creating tables for them would be inventing features. |
| `legaisee.db` (56 KB), `kernel/legaisee.db` (0 B) | — | — | — | Dead. Zero code references. Delete. |

---

## 5. Target schema

New DDL file: `database/schema/001_store.sql` (new directory; `database/migrations/` currently holds one orphaned tree-nodes migration and is not executed by anything).

Every table: `InnoDB`, `utf8mb4_unicode_ci`, `id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY`, `created_at`/`updated_at` `DATETIME DEFAULT CURRENT_TIMESTAMP`.

**Preserve legacy keys.** JSON records key off string ids (`case_1777858282`, `client_1777858282`, `net_69eee12e374d30_99173905`). Store them as `*_key VARCHAR(64) UNIQUE` alongside the numeric PK so URLs, `search_load.php` refs (`json:cases:{key}`) and existing bookmarks keep working.

```sql
-- identity
clients(id, client_key UNIQUE, name, status, tier, email, phone,
        profile_json JSON, legacy_path VARCHAR(255), created_at, updated_at)
cases(id, case_key UNIQUE, client_id FK->clients.id, name, status,
      opened_at, closed_at, meta_json JSON, legacy_path, created_at, updated_at)
case_patterns(id, case_id FK, pattern VARCHAR(191), INDEX(case_id))
prospects(id, prospect_key UNIQUE, business_name, status, score,
          payload JSON, created_at, updated_at)

-- case detail (was glob+meta.json)
case_tasks(id, case_id FK, title, status, due_at, payload JSON, created_at, updated_at)
case_goals(id, case_id FK, title, status, payload JSON, created_at, updated_at)
case_memory(id, case_id FK, kind VARCHAR(50), content MEDIUMTEXT, created_at)
case_insights(id, case_id FK, insight_key VARCHAR(191), body MEDIUMTEXT,
              confidence DECIMAL(5,4), source_module VARCHAR(64),
              UNIQUE KEY(case_id, insight_key))
case_clusters(id, case_id FK, cluster_key VARCHAR(191), label VARCHAR(255),
              payload JSON, UNIQUE KEY(case_id, cluster_key))
case_artifacts(id, case_id FK, kind VARCHAR(50), path VARCHAR(512),
               filesize BIGINT, mime VARCHAR(100), meta_json JSON, created_at)
dossiers(id, dossier_key UNIQUE, case_id FK NULL, payload JSON,
         pdf_path VARCHAR(512), created_at)

-- graph (was data/network/*.json and case network.json)
networks(id, network_key UNIQUE, case_id FK NULL, name, node_count INT DEFAULT 0,
         edge_count INT DEFAULT 0, meta_json JSON, created_at, updated_at)
network_nodes(id, network_id FK, node_key VARCHAR(191), type VARCHAR(64),
              label VARCHAR(255), payload JSON, INDEX(network_id, type),
              UNIQUE KEY(network_id, node_key))
network_edges(id, network_id FK, edge_key VARCHAR(191), source_key VARCHAR(191),
              target_key VARCHAR(191), type VARCHAR(64), weight DECIMAL(8,4),
              payload JSON, INDEX(network_id), INDEX(source_key), INDEX(target_key))

-- ai-runtime state (was per-turn whole-file rewrites)
brain_sessions(id, brain_key UNIQUE, title, status, model,
               payload JSON, created_at, updated_at)
brain_memory(id, brain_id FK, graph_key VARCHAR(191), payload JSON, updated_at)
events(id, event_key VARCHAR(191), type VARCHAR(64), payload JSON, created_at,
       INDEX(type), INDEX(created_at))
auto_log(id, entry_key VARCHAR(191), level VARCHAR(32), message TEXT,
         payload JSON, created_at)

-- misc stores
goals(id, goal_key UNIQUE, scope VARCHAR(64), status, payload JSON, created_at, updated_at)
portfolios(id, portfolio_key UNIQUE, client_id FK NULL, payload JSON, updated_at)
chains(id, chain_key UNIQUE, name, template_json JSON, genome_json JSON,
       score DECIMAL(8,4), updated_at)
chain_logs(id, chain_id FK, run_at DATETIME, payload JSON)
saved_sets(id, set_key UNIQUE, name, payload JSON, created_at)
session_meta(id, session_id VARCHAR(128) UNIQUE, payload JSON, updated_at)

-- migration bookkeeping
json_import_log(id, source_path VARCHAR(512), sha256 CHAR(64),
                rows_written INT, imported_at, UNIQUE KEY(source_path, sha256))
```

**Additive alterations to existing tables** (do not drop anything):
`cases` — add `case_key`, `meta_json`, `legacy_path` if absent; `clients` — add `client_key`, `profile_json`. Capture current DDL first (see runbook step 4) because these two tables may already carry columns the modules query.

---

## 6. The data layer

New file: **`kernel/store.php`** (single include, loaded by `kernel_boot.php`). It exposes:

```
store()                        -> PDO via kernel_db(), with ERRMODE_EXCEPTION enforced
store_q($sql, $params)         -> prepared execute + fetchAll(ASSOC)
store_one($sql, $params)
store_insert($table, $row)     -> returns id
store_upsert($table, $row, $uniqueKey)
store_tx(callable $fn)         -> BEGIN/COMMIT/ROLLBACK wrapper; all multi-table writes use it
```

and one repository function per access pattern, so call sites stay one-liners:

```
store_clients_all()        store_client_by_key($key)
store_cases_all()          store_cases_by_client($clientId)
store_case_by_key($key)    store_case_network($caseId)
store_networks_all()       store_network_by_key($key)
store_prospects_all()      store_brain_by_key($key)
store_insights($caseId)    store_upsert_insight($caseId, $key, $body, $conf)
store_clusters($caseId)    store_upsert_cluster($caseId, $key, $label, $payload)
store_artifacts($caseId)   store_log_artifact($caseId, $path, $kind)
```

**Compatibility shims (the risk-reduction trick).** In `modules/utils/bootstrap.php`, keep the *names* the 10 modules already call, but change the implementation:

```php
function load_cases_dir()   { return store_cases_all(); }     // shape-identical to load_json_dir(DATA_ROOT.'cases')
function load_clients_dir() { return store_clients_all(); }
function load_json_dir($dir){ /* deprecated: maps known dirs to store_*(), throws for anything else */ }
```

Each of the 10 `load_json_dir()` modules then changes exactly one line, and the module body keeps working while its shape expectations are migrated table-by-table. `load_json_dir` itself must be reduced to a mapping table + `trigger_error(..., E_USER_DEPRECATED)` and **deleted in P9** — not left as an escape hatch.

---

## 7. One-time importer

**`tools/import_json_to_mysql.php`** (CLI, with `--dry-run`, `--domain=cases|clients|prospects|...`, `--verify`).

Rules:
- Idempotent: `INSERT ... ON DUPLICATE KEY UPDATE` keyed on `*_key`; `json_import_log` skips unchanged files by `sha256`.
- Reads from `DATA_ROOT` **only**; never writes to `data/`.
- Preserves `legacy_path` so a row can be traced back to the file it came from.
- Dry run prints a per-domain table: files found, rows to insert, rows to update, rows skipped (malformed), and any record missing a key.
- `--verify` re-reads the JSON and diffs row-for-row against MySQL, printing mismatches. This is the gate for P2 exit.
- Hard-fails (non-zero exit) on any `json_decode` error, rather than silently dropping the file the way `load_json_dir` does.

Estimated volume: ~100 files, ~1.9 MB of text after removing whitespace, roughly 120 clients/cases + 27 prospects + 9 networks with ~1,000 nodes.

---

## 8. Execution plan — phases and every file

Effort assumes one engineer familiar with the codebase. Waves are ordered so each one is independently shippable and testable.

### P1 · Schema + store layer · 6 h
1. `database/schema/001_store.sql` — DDL from §5.
2. `kernel/store.php` + include from `kernel/kernel_boot.php`.
3. `modules/utils/bootstrap.php` — shims (§6).
4. `kernel/system_health.php` — replace the `sqlite_master` probe with `SHOW TABLES` (already present at line 53); delete lines 50–56. Add a `store` check that asserts required tables exist.
5. Delete `legaisee.db`, `kernel/legaisee.db`; move `legaisee_sqlite_viewer.phpbak` to `_archive/`.

**Exit:** health page reports `database.status = OK`; no module behaviour has changed yet.

### P2 · Importer + backfill · 4 h
1. `tools/import_json_to_mysql.php` (§7).
2. Run `--dry-run`, review, run for real against **staging**, then `--verify`.
3. Record the row counts as the acceptance baseline (§10).

**Exit:** `--verify` zero mismatches. No application file touched yet.

### P3 · The 10 `load_json_dir` modules · 6 h
Mechanical: swap the two `load_json_dir()` calls for `load_cases_dir()` / `load_clients_dir()`.

| File | Lines | Change |
|---|---|---|
| `modules/dashboard_module.php` | 5–6 | → `load_cases_dir()` / `load_clients_dir()` |
| `modules/cases_module.php` | 6–7 | same; `$clientIndex` built from `client_key` |
| `modules/alert_module.php` | 5 | cases only |
| `modules/decision_module.php` | 11 | cases only |
| `modules/predictive_module.php` | 11 | cases only |
| `modules/recommendation_module.php` | 6 | cases only |
| `modules/time_intelligence_module.php` | 5 | cases only |
| `modules/relations_module.php` | 11–12 | both |
| `modules/executive_dashboard_module.php` | 11–12 | both |
| `modules/root_cause_graph_module.php` | 5 | cases only |

Also in this phase: `modules/cockpit_module.php` is the only dashboard already on MySQL — use its queries as the reference implementation and reconcile field names (`cases.client_id`, `cases.status`).

**Exit:** all 10 modules show the same counts as before migration.

### P4 · Case-detail readers (`glob .../meta.json`) · 8 h
These bypass the shim and glob the filesystem directly. Each needs a real repository call.

| File | Lines | Replace with |
|---|---|---|
| `modules/dig_review_module.php` | 124,129,134,153,172 | `store_cases_all()`; insights→`store_insights()`, clusters→`store_clusters()`, network→`store_case_network()` |
| `modules/ingest_module.php` | 73,152,153 | file target → `case_artifacts` row; meta loop → `store_cases_all()` |
| `modules/insight_module.php` | 68 | same artifact treatment as ingest |
| `modules/report_module.php` | 101–102 | `store_cases_all()`; PDF output path stays on disk |
| `modules/client_view_module.php` | 77 | `case_artifacts` (kind=`report`) instead of `glob('report_*.pdf')` |
| `modules/excavation_module.php` | 24,39,68,74 | `store_clients_all()`, `case_artifacts`, artifact `meta_json` |
| `modules/vault_module.php` | 37,44,49 | `store_clients_all()` + `case_artifacts` |
| `modules/search_module.php` | 28–31,36,42 | drop the `json` source branch entirely; keep `mysql:` refs. **`api/search_load.php` must change in lockstep** |
| `views/graph_view.php` | 10–11,121 | `store_cases_all()` + `store_case_network()` |
| `modules/semantic_cluster_module.php` | 183,211 | read `cases`, write `case_clusters` in a `store_tx` |
| `modules/entity_resolution_module.php` | 96,106,111 | read `cases`, upsert `case_insights` |
| `modules/relations_module.php` | 124,134,154 | upsert `case_insights` |
| `modules/root_cause_graph_module.php` | 112,149 | write `networks` + nodes/edges |
| `modules/cross_case_engine.php` | 34,42 | `store_cases_all()` |
| `modules/brain_module.php` | 47,98 | `brain_sessions` / `case_artifacts`. **Note:** the `normalized/` scan at 98 is a filesystem feature, not a datastore — verify intent before converting |
| `modules/utils/uic_v1.php` | 101 | `store_network_by_key()` |
| `modules/utils/file_helpers.php` | 13 | delete the JSON branch; keep file helpers |
| `modules/payment_module.php` | 234,240 | `store_client_by_key()` (lines 29/108/165 are HTTP input — leave alone) |
| `modules/governance_module.php` | 39,130 | **no change** — `.txt` policy files are documents, not records |

**Exit:** rename `data/` to `data.archived/` on staging; every module in P3+P4 still renders.

### P5 · Engines · 6 h
| File | Lines | Notes |
|---|---|---|
| `engine/case_manager.php` | 11,22 | `createCase()` → INSERT `cases` + `case_tasks` (was mkdir + 2 files) |
| `engine/client_manager.php` | 17,30,37 | `createClient()` → INSERT `clients`; `getClients()` → SELECT |
| `engine/cross_case_engine.php` | 26,44 | SELECT cases |
| `engine/portfolio_engine.php` | 17,25,32 | SELECT cases; `portfolios` table |
| `engine/recommendation_engine.php` | 23,39 | read insights, write recommendations to `case_insights` (source_module=`recommendation`) |
| `engine/reasoning_engine.php` | 10,48 | clusters in, insights out |
| `engine/dashboard_engine.php` | 11 | recommendations from DB |
| `engine/execution_router.php` | 28 | `case_tasks` |
| `engine/execution_feedback_engine.php` | 31,35,39 | `execution_feedback` → `events` |
| `engine/policy_enforcement_engine.php` | 32 | policies → `governance_policies` (new table) **or** leave on disk and document — decide before starting |
| `engine/system_recommendation_engine.php` | 32 | insights |
| `engine/cross_case_learning_compiler.php` | 30,34 | `brain_memory` |
| `cluster_engine.php` (root) | 10,15,30 | `cluster_engine.php` duplicates `engine/cluster_engine` — collapse to one before converting |
| `kernel/cluster_intelligence.php` | 26 | networks |
| `kernel/graph_auto_builder.php` | 52,82 | networks + nodes/edges, inside `store_tx` |
| `kernel/ingestion_pipeline.php` | 68,71,77 | networks |

**Exit:** re-run the CLI worker end-to-end against staging; graph row counts match the JSON node/edge counts.

### P6 · HTTP endpoints · 10 h
`api/v8/*` (20 files) all share one pattern: resolve a network id to a filename, `json_decode`, compute, sometimes write back. Convert them to `store_network_by_key($id)` and stop writing.

`api/v8/cases.php, alerts.php, agent.php, autonomous_engine.php, build_edges.php, compare_networks.php, compressor.php, create_network.php, dashboard.php, dossier.php, dossier_v2.php, forecast.php, insights.php, investigator.php, learn.php, memory_store.php, memory_weight.php, mesh.php, network_add_node.php, patterns.php, predictor.php, summary.php, event_emit.php, run_worker.php`

Legacy `api/*.php`: `agency_create.php:19`, `agency_dashboard.php:8-9`, `agency_dispatch.php:15,24`, `agency_synthesis.php:15`, `case_create.php:31`, `case_memory.php:13`, `case_scheduler.php:13-15`, `case_tick.php:13,43`, `graph_synthesizer.php:13`, `network_tick.php:13,39`, `node_builder.php:24,28`, `agent_spawn.php`, `agent_tick.php`, `anomaly_detector.php`, `brain_start.php:38`, `brain_commit.php:23,30`, `brain_stream.php:20,52`, `brain_stream_v4.php`, `brain_synthesis.php`, `brain_dossier.php:20`, `brain_memory_graph.php:21,31`, `brain_orchestrator.php`, `dossier.php:14`, `file_tree.php:8`, `files_action.php:113,121,221`, `tree.php:234`, `search_load.php:42-45,63`.

Two incidental bugs to fix while in here (do not report them as scope creep — they are in the touched lines):
- `api/v8/cases.php:4` hardcodes `net_69eee12e374d30_99173905`; it also `echo`s an undefined `$response` at the end, corrupting the JSON body.
- `api/v8/cases.php:8` has no `file_exists` guard, so a missing network emits a PHP warning into the JSON response.

Also: `api/network_boot.php`, `api/case_agent.php` reference `data/` but weren't in the write-path scan — audit them in this phase.

**Exit:** every endpoint returns valid JSON with `curl`; no `Warning`/`Notice` in any body.

### P7 · CLI + standalone scripts · 5 h
`cli/worker.php:18,26,39,40,60,61` · `cli/chain_generator.php:15,18,22,32,122,123` · `cli/chain_evolver.php:8,11,14,25` · `prospect.php:228` · `intelligence.php:142` · `parser.php:108` · `ingest.php:43` · `ingest2.php:43` · `session.php:24,28` · `save_set.php:37` · `load_sets.php:10,15` · `create_session.php` · `semantic_engine.php:15,16` · `test_graph.php:9` · `create_test_data.php` · `ExcavationCommand/system_index.php:15` · `ExcavationCommand/dashboard.php:11`.

**Triage rule:** scripts that are superseded by an `api/` or `modules/` equivalent (`intelligence.php`, `ingest.php`, `ingest2.php`, `temp_dashboard.php`, `view_ingest.php`, `create_test_data.php`, `test_*.php`) get **deleted**, not converted. Converting dead scripts to MySQL is how you get two implementations again.

### P8 · Write-path hardening · 4 h
1. Wrap every multi-row write in `store_tx()`.
2. Add `UNIQUE` guards already in the schema and switch writes to `store_upsert`.
3. Delete `file_put_contents` on `.json` everywhere (`api/case_tick.php:43`, `api/network_tick.php:39`, `api/v8/build_edges.php:28`, `api/v8/create_network.php:17`, `api/v8/event_emit.php:31`, `api/v8/memory_store.php:23`, `api/v8/learn.php:48`, `api/brain_*.php`, `api/node_builder.php:28`, `kernel/graph_auto_builder.php:82`, `kernel/ingestion_pipeline.php:77`, `engine/*`, `cli/*`). The only surviving `file_put_contents` calls are PDF/upload writers.
4. `.htaccess`: deny `data/`, `tools/`, `cli/`, `config.local.php`.

### P9 · Cleanup + guardrails · 3 h
1. Delete `load_json_dir` and the two shims once every caller is on repository functions.
2. Delete the 8 empty `data/` subdirectories; move the rest to `_archive/data/` outside the webroot.
3. Add a CI/lint step (`tools/lint_no_json_store.php`) that fails the build on `load_json_dir(`, `sqlite_master`, or `file_put_contents(.*\.json` outside `tools/import_json_to_mysql.php`.
4. Update `README.md` / `SYSTEM_LEGEND.md` with the store layer and the schema file path.

**Total: ~52 h (6–7 working days).**

---

## 9. Risks and rollback

| Risk | Mitigation | Rollback |
|---|---|---|
| Live JSON writes during cutover split the data | Short maintenance window; importer runs twice (before and after the window) and is idempotent | Re-run importer in reverse — not possible; keep `data/` untouched until P9 |
| `cases`/`clients` MySQL tables already have rows in a different shape | Dump real DDL + `SELECT COUNT(*)` before writing the DDL (runbook step 4); do not `DROP` | PR drops only the new tables |
| Shape drift: `load_json_dir` returns `[ {case}, ... ]`, SQL returns fewer keys | Shims return shape-identical arrays in P3; assertions compare `count()` and a sample record | Per-phase revert |
| Perf regression on dashboards | Indexes on `cases(client_id)`, `cases(status)`, `networks(case_id)`; measure `/shell.php?module=dashboard` before and after | — |
| Lost files if `data/` is deleted early | `data/` is never deleted, only renamed, and only in P9 | Rename back |

---

## 10. Acceptance checks

```bash
# 1. No legacy store access left
grep -rn "load_json_dir\|sqlite_master\|legaisee\.db" --include=*.php . | grep -v tools/import_json_to_mysql.php   # expect 0

# 2. Data directory is not required
mv data data.archived && curl -s localhost/commandcenter/shell.php?module=cases | grep -c "unknown"; mv data.archived data

# 3. Row counts match the pre-migration baseline
#    cases 17+6, clients 5+5, prospects 27, networks 15, brain_sessions 3, chains 3
mysql -e "SELECT 'cases',COUNT(*) FROM cases UNION ALL SELECT 'clients',COUNT(*) FROM clients
          UNION ALL SELECT 'prospects',COUNT(*) FROM prospects UNION ALL SELECT 'networks',COUNT(*) FROM networks"

# 4. Importer agreement
php tools/import_json_to_mysql.php --verify   # expect "0 mismatches"
```

Module smoke list (must render, non-zero content): `dashboard, cases, relations, executive, report, dig_review, client_view, excavation, vault, search, graph, insight, semantic_cluster, root_cause, entity_resolution, pm, cockpit, payment`.

---

## 11. Explicit exclusions and why

- **PDFs, uploads, extracted text files** — binaries. Keep on disk, index in `case_artifacts`. Storing them in MySQL would bloat the DB and break the existing `export_report.php` / dompdf flow for no gain.
- **`_governance/*.txt` policy files** — human-edited documents consumed as text by `governance_module.php`. Converting them to rows loses the "edit the file, reload" workflow; if policy enforcement later needs querying, add `governance_policies` then.
- **`ProjectManager/`** — separate MVC app with its own `config.php`, container, and 13 migrations. Its own `pm_*` tables are already MySQL; touching it here would double the blast radius. Flagged separately.
- **LLM request/response `json_decode` calls** (`api/model_router.php`, `embed_generate.php`, `tools/build_cluster_summaries_ai.php`, `lib/legaisee_model.php:295`, `modules/payment_module.php:29/108/165`, `api/v8/run_worker.php:29`) — these decode **HTTP bodies**, not stored records. No change. Treating them as violations is the most likely false positive in any naive grep.
- **`lib/semantic_diff_engine.php:67-150`** — already MySQL; it decodes JSON *columns* (`tags`, `related_ids`, `embedding`). Leave as is, or migrate those to native `JSON` columns in a later ticket.
