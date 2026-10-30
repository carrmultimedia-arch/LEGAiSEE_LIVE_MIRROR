# A11 — Master verdict

**Date:** 2026-10-29
**Outputs:** `A11-master-verdict.csv` (one row per file — 353 rows), `A11-summary.json`, this report, and `a11_master.py` (the merge that produced them).
**Inputs:** `AUDIT-APPENDIX-FILE-STATUS.md` (347-row file universe, v1 statuses), the defect ledgers of A1–A9 (135 recorded defects), `A10-result.json` (the independent dead proof), `OS Contents.txt` (the planned builds and V1/V2/V3 phasing).

---

## What this verdict is, and what it is not

The CSV is **generated, not hand-typed**: every row's file, subsystem, build, verdict, defect list and fix order comes from a rule applied to the ten block reports. The rules are stated at the top of `a11_master.py`, and the precedence is deliberate:

1. **Duplicate** (A10 §2, byte-identical) → `ARCHIVE`.
2. **Reference material** for the project-manager build (`ProjectManager/governance/`, `permissions.php`, `database/schema.php`, `connection.php`, the two working pages) → `KEEP`.
3. **Superseded generation** (`api/v8/`, `pages/`, `components/`, `tools/`, `ExcavationCommand/`, `ProjectManager/app|api|tests`) → `ARCHIVE` **only if** A10 proved it dead; otherwise `KEEP`/`FIX`.
4. **Unwired capability engine** (`engine/*` with no caller, `plain_english_helper`, `hierarchy_of_truth`) → `FINISH`.
5. **Any P0/P1 defect in a file that serves a build** → `FIX`.
6. Proven dead with no build claim → `ARCHIVE`. Complete but unloaded → `FINISH`. Otherwise → `KEEP`.

**The rule that shapes everything:** a file that serves a planned build is never archived, even if it is unwired today. That is why 28 engine files land in `FINISH` rather than `ARCHIVE`: the capability they implement is a V1/V2 build, and nothing live replaces them.

---

## Counts per verdict

| Verdict | Files | Share | Meaning |
|---|---:|---:|---|
| **KEEP** | 60 | 17% | Serves a build and works (or is the spec/config for it) |
| **FIX** | 39 | 11% | Serves a build and carries P0/P1 defects |
| **FINISH** | 29 | 8% | Serves a build, is complete, and nothing loads it |
| **ARCHIVE** | 225 | 64% | Proven dead or duplicate, and belongs to a generation a live file has replaced |
| **total** | **353** | 100% | 347 PHP + 6 non-PHP security/data rows |

**Only 99 files need building work** (KEEP + FIX + FINISH). The 225 archives are not a work item — they are a `_archive/` move with a manifest (A10 §5 already produced the proof for 209 of them).

---

## The build map

Twenty planned builds from `OS Contents.txt` and the North Star list. "Rows" = files mapped to that build; "exists" = what is actually there today.

| # | Build | Phase | Rows | KEEP | FIX | FINISH | ARCHIVE | What exists today | What works | What is missing |
|---|---|---|---:|---:|---:|---:|---:|---|---|---|
| B01 | **Core Kernel** | V1 | 47 | 6 | 5 | 1 | 35 | `shell.php`, `kernel/*` (12), `kernel_paths`, `module_registry` | Registry dispatch, DB singleton, path constants, session start | **No authentication at all** (A1-001); `display_errors` forced on (A9-011); `guard.php` never loaded |
| B02 | **Brain layer (LLM)** | V2 | 66 | 2 | 5 | 0 | 59 | `brain_module`, `api/brain_orchestrator`, `model_router`, `brain_synthesis` + 35 dead `api/v8` handlers | **Real Claude calls** (A5 §4), real synthesis, honest `not_configured` for OpenAI/Gemini | Auth on the paid endpoint (A5-003), prompt caps, a webhook-grade cost guard; v8 surface wholly superseded |
| B03 | **Analysis & extraction engines** | V1 | 62 | 23 | 6 | **28** | 5 | `engine/entity_extraction_engine` (live), 28 unwired engines, 12 modules | Extraction writes 2,433 entities / 2,721 relationships; anomaly scoring is legible | **Nothing calls the engines.** Six screens dump JSON, three print "N records" (A5-007/008); `plain_english_helper` unused (A5-009) |
| B04 | **UI system — Master OS shell** | V1 | 26 | 4 | 1 | 0 | 21 | `shell.php` chrome, `ui/global.css` (1,924 lines), `uic_v1.php`, 2 legacy page sets | One stylesheet, styled lobby, sidebar, search, pm markup | `fm-*`/`pm-*`/`ui-tabs` have **0 CSS definitions** (A9-009); `view_module` nests a second `<html>` (A9-010) |
| B05 | **Data layer (MySQL)** | V1 | 13 | 4 | 7 | 0 | 2 | `kernel/db.php`, `config(.local).php`, live schema (51 tables) | Single PDO, MySQL-only for new code | Secrets + 5.2 MB dump + SQLite file inside the webroot (A2-002/003); 6 modules still read JSON (A3) |
| B06 | **Tools & automation** | V2 | 10 | 1 | 0 | 0 | 9 | `cli/worker.php` (dead), `cli/chain_*`, `tools/*` | Nothing runs | No cron, no worker, no scheduler exists anywhere (A1) |
| B07 | **Project manager** | V2 | 95 | 10 | 1 | 0 | 84 | `modules/pm_module.php` (922 lines, works) + 84-file standalone scaffold | Full PM screen with boards, modal, session linking | Project creation **fails** (`domain_id` NOT NULL, A8-001); tasks parented to two tables (A8-011) |
| B08 | **Knowledge system** | V2 | **0** | — | — | — | — | Governance `.md` only, no PHP | — | **No implementation.** Compounding memory is a document set |
| B09 | **Client & case intake / shallow dig** | V1 | 13 | 3 | 3 | 0 | 7 | `ingest`, `excavation`, `insight`, `dig_review`, `prospect.php` | Paste + upload + extraction path exists end to end | Uploads unvalidated (A4-002), case-id path traversal (A4-001), extraction never called from ingest (A4-003) |
| B10 | **Full dig (40+ channels)** | V2 | **0** | — | — | — | — | — | — | **No implementation** |
| B11 | **Reports, vault & delivery** | V1 | 6 | 2 | 2 | 0 | 2 | `report_module`, `vault_module` | dompdf installed, PDF writes to disk | Report prints IDs not findings (A7-004); scoped to client not case (A7-003); `reports` table never written (A7-005); vault download 404s (A6-010) |
| B12 | **Billing & third-party support** | V1 | 1 | 0 | 1 | 0 | 0 | `payment_module` | Stripe SDK + PHPMailer vendored | **`STRIPE_SECRET_KEY` undefined** → every checkout 500s (A7-002); unsigned webhook (A7-001) |
| B13 | **Live client dashboard & good-morning** | V1 | 4 | 3 | 1 | 0 | 0 | `cockpit` (real), `dashboard`, `client_view`, `intelligence_dashboard` | Cockpit is genuinely live — real counts, real queue | `intelligence_dashboard` is **wholly fabricated** (A9-002); dashboard is two numbers; good-morning logic exists only in cockpit's greeting |
| B14 | **Authority Marketing System** | V2 | **0** | — | — | — | — | — | — | **No implementation** — the V1 delivery promise has no code |
| B15 | **Pipeline monitoring & system health** | V2 | 1 | 0 | 1 | 0 | 0 | `kernel/system_health.php` (185 lines) | Written | Probes `sqlite_master`, which MySQL does not have (v1: BROKEN) |
| B16 | **Artifact library, search & file access** | V1 | 9 | 2 | 6 | 0 | 1 | `files_action`, `search_load`, `search_module`, `files_module`, `api/tree`, `api/file` | File tree works; transcript full-text search works | FM root is the whole app (A6-001) → credential read + RCE (A6-002); 3 of 5 search sources dead on column names (A6-005..007) |
| B17 | **Yearly review dossier** | V2 | **0** | — | — | — | — | — | — | **No implementation** |
| B18 | **Autonomous digs & self-building** | V3 | **0** | — | — | — | — | — | — | **No implementation** |
| B19 | **Legaisee voice interface** | V3 | **0** | — | — | — | — | — | — | **No implementation** |
| B20 | **CAMERA Authority System** | V1 add-on | **0** | — | — | — | — | — | — | **No implementation** — correctly filed as a service deliverable |

### Reading the map

**Seven of twenty planned builds have zero PHP** — B08 knowledge system, B10 full dig, B14 Authority Marketing, B17 yearly dossier, B18 autonomous digs, B19 voice, B20 CAMERA. Four of those are V1/V2 commitments, and B14 is the thing the business actually sells. Nothing in 353 files implements them.

**The V1 set is nine builds, of which four are close** (kernel, UI shell, dashboard, artifact library) and four are blocked by a small number of specific defects (intake, reports, billing, PM). None is blocked by missing architecture.

**The single largest recoverable asset is B03:** 28 unwired engines plus 23 working modules. The capability is written and the screens call none of it.

---

## P0 register (15 defects, 14 files)

Order 1 = stop-the-bleeding (security, unauthenticated surfaces, money). Order 2 = P0 functional. The full per-file detail with line numbers is in the appendix below and in each block report.

## P1 register (65 defects)

Everything that produces wrong results or an unreadable screen. The three heaviest clusters are search (A3/A6 — 3 dead query sources), rendering (A5/A9 — 6 JSON dumps, 3 count-only, 2 unstyled screens), and reporting (A7 — IDs instead of findings).

---

## Notes on the archive rule

`ARCHIVE` was applied to 225 files. Every one falls into a category the brief permits:

- **Duplicates** — 12 files in 6 byte-identical groups (A10 §2).
- **Proven dead + superseded** — `api/v8/` (35 handlers whose dispatcher is dead, replaced by the live brain API), `ProjectManager/app|api|tests` (84 files whose function is delivered by `modules/pm_module.php` in 5 line edits, A8 §6), `pages/`, `components/`, `tools/`, `ExcavationCommand/`, `database/migrations/`.
- **Proven dead + no build claim** — legacy root scripts (`test_*`, `create_*`, `db_verify`, `diagnostics2`, `export_report`, `load_*`, `Color_Creator.php`).

**Deliberate exceptions where a dead file was *not* archived:**

| File | Would-be verdict | Actual | Reason |
|---|---|---|---|
| `engine/*` (28 files) | ARCHIVE (dead) | **FINISH** | Each implements a capability B03 still lacks; nothing live replaces them |
| `engine/plain_english_helper.php` | ARCHIVE (0 refs) | **FINISH** | The only file written to make these screens readable; A5-009 |
| `engine/hierarchy_of_truth_engine.php` | ARCHIVE | **FINISH** | Only existing truth-ranking logic; `findings` is empty without it |
| `views/graph_view.php` | ARCHIVE (0 refs) | **KEEP** | It is the missing target of `client_view_module.php:223` (A1-005), not unused code |
| `kernel/guard.php` | ARCHIVE (dead) | **FIX** | It is the kernel enforcer the auth gate needs (A1 §5) |
| `ProjectManager/shape` (11 files) | ARCHIVE | **KEEP** | The only written-down spec for roles, permissions and the PM data model |

**Three rows are marked `FIX` where the fix is removal, not repair:** `.sftp.json`, `legaisee.db` and `db-before-migration-2026-10-29.sql` are live security exposures that must leave the webroot. `FIX` in the CSV means "this row requires action before V1" — for these three the action is deletion from the served tree, which is why they are not in the archive list.

---

## Limits

- **Judgement, stated as judgement.** Subsystem and build assignment is rule-based on path and filename. Where a file could serve two builds (e.g. `modules/client_view_module.php` — dashboard *and* artifact access) it is assigned to one; the CSV records that choice, and it is arguable.
- **Verdict is per file, not per function.** A file marked FIX may contain 90% correct code; a file marked KEEP may contain a P2. The defect column is the authority.
- **Defect attribution is regex-based** over the ten block reports. Multi-file defect rows (`A1-001` spans `shell.php` and `kernel/kernel_boot.php`) are attributed to each named file, so a defect can appear on more than one row. 135 ledger rows produce 15 P0 and 65 P1 ids after de-duplication.
- **`ARCHIVE` ≠ delete.** Per `00-GROUND-RULES.md` §6 everything moves to `_archive/` with a manifest. Nothing in this block touched a source file.
- **The 20-build catalogue is my reading of `OS Contents.txt` + the North Star list**, not a document that already existed. B-numbers are stable so a schedule can reference them.
- **Schedule estimates are deliberately absent** — the brief asks for the map a schedule can be built from, not the schedule. Each build row states files, what works, and what is missing, which is the input a dated plan needs.
- No file was executed; nothing was moved. Only `_governance/audits-v2/` was written.

---

### Legend
**Verdicts** — `KEEP` (serves a build, works) · `FIX` (serves a build, has P0/P1) · `FINISH` (serves a build, unloaded) · `ARCHIVE` (dead or duplicate, build replaced). No deletions.
**Fix order** — `1` security/P0 · `2` functional P0 · `3` P1 · `4` P2 · `5` FINISH · `6` ARCHIVE.


---

## Appendix A — P0 register (generated)

| ID | File:line | Defect |
|---|---|---|
| A1-001 | ``shell.php:6-58`; `kernel/kernel_boot.php:12-13`` | No authentication or authorization anywhere in the live spine; the early intercepts (`:14`/`:20`/`:26`) run before any identity check; sessions are st… |
| A1-002 | ``.htaccess:1-8`` | mod_security is switched **off** (`SecFilterEngine Off`, `SecRuleEngine Off`) — the request filter that would catch injection attempts is disabled at … |
| A1-003 | ``.htaccess:11`` | `<FilesMatch "^(config\.php\|\.env\|\.gitignore)$">` denies only those three names; `config.local.php` (the file that actually holds the credentials, … |
| A1-004 | ``modules/*.php:1` (29 files); `modules/vault_module.php:19`` | 29 of 35 registry modules have no `KERNEL_ROOT`/direct-access guard and `modules/` is web-addressable. `report_module.php` loads its own kernel (`:10`… |
| A2-001 | ``.sftp.json:1`; `.vscode/sftp.json:1`` | SFTP host, username and password sit in the webroot and are served as static files; `.htaccess:11` denies only three filenames and nothing in dot-dire… |
| A2-002 | ``db-before-migration-2026-10-29.sql:1` (root of webroot)` | The full 5,232,685-byte client database dump is downloadable over HTTP |
| A2-003 | ``legaisee.db:1`` | 57,344-byte legacy SQLite database downloadable over HTTP; `kernel/legaisee.db` is a 0-byte twin |
| A2-004 | ``config.local.php:3-6,12`` | DB credentials and a live-pattern API key in a file the `.htaccess` deny list does not cover and `.gitignore` does not ignore |
| A2-005 | ``modules/vault_module.php:19,23`` | Report download streams `$_GET['report_path']` via `readfile()`; containment is a `strpos() === 0` **prefix** test that a `clients…`-prefixed sibling … |
| A2-006 | ``api/file.php:15,24`` | Returns the complete contents of any file in `normalized/` to an unauthenticated caller; `basename()` blocks traversal but there is no auth and no all… |
| A4-001 | ``modules/ingest_module.php:67,70-71,107`` | Unsanitised `case_id` interpolated into filesystem paths; `:107` has no `is_dir` gate, giving a `file_put_contents` write primitive to any path ending… |
| A4-002 | ``modules/ingest_module.php:64-66`` | Upload accepts any extension, MIME type and size, into a web-served directory, behind no auth |
| A4-011 | ``modules/dig_review_module.php:53-63`` | Confirming a flag updates `review_flags.status` only; nothing inserts into `findings`, so review never produces output |
| A4-012 | ``modules/dig_review_module.php:83-84`` | Queue INSERT selects `context` from `entities`, which has no such column → the action throws and `review_flags` can never be populated |
| A5-003 | ``api/brain_orchestrator.php:60-68`; `modules/brain_module.ph` | `run_brain_on_file()` is reachable unauthenticated by direct URL and by `?module=brain` POST, so anyone can spend paid Claude credits on any file in `… |

## Appendix B — P1 register (generated)

| ID | File:line | Defect |
|---|---|---|
| A1-005 | ``modules/client_view_module.php:223`` | `require __DIR__.'/../graph_view.php'` resolves to `commandcenter/graph_view.php`, which does not exist (the file is `views/graph_view.php`) → fatal "… |
| A1-006 | ``modules/utils/json_helpers.php:1`` | File is 2 bytes of `{}`, not PHP, yet `alert_module.php:3` and `excavation_module.php:3` `require_once` it — literal `{}` is emitted into the page bef… |
| A1-007 | ``modules/cases_module.php:6-7`, `predictive:11`, `decision:1` | `load_json_dir()` is called but `modules/utils/bootstrap.php` is never included by those modules; it only works because `shell.php:7` loaded it into t… |
| A1-008 | ``api/tree.php:124`` | `WITH RECURSIVE descendants AS (…)` — recursive CTEs need MySQL 8.0+; the dump is from `5.7.44-percona`, so the `move` action raises a syntax error |
| A1-009 | ``api.php:35`` | The only `api/v8` dispatcher has zero execution references, so all 35 v8 handlers are unreachable through the one path that can reach them |
| A2-007 | ``shell.php:3-4` (+9 more files)` | `error_reporting(E_ALL)` + `display_errors=1` print warnings, paths and SQL into the page; nothing in `.htaccess` countermands it |
| A2-008 | ``kernel/db.php:11-14`; `config.php:8`` | If `config.local.php` is absent, `DB_HOST`/`DB_NAME`/`DB_USER`/`DB_PASS` are undefined → PHP `Error`, which `catch (PDOException)` cannot catch → unca… |
| A2-009 | ``kernel/task_generator.php:3,19,29`` | Requires a file that does not exist; uses `mysqli` `bind_param()` on a PDO handle; reads undefined `$pdo`; inserts `action`/`priority` columns absent … |
| A2-010 | ``kernel/graph_engine.php:44-46`` | Queries `page_relations`, absent from the schema; no `try`, so the function is fatal whenever called |
| A2-011 | ``kernel/system_health.php:50,91,38,185`` | `sqlite_master` probe on MySQL aborts the DB block (status always ERROR); `array_column` on a name→file map reports all 35 modules as orphans; `COMMAN… |
| A2-012 | ``kernel/guard.php:3,17`` | The "enforcer" requires only the no-op `kernel.php`, so `kernel_db()` is undefined when the guard loads — the one file whose job is to guarantee the D… |
| A2-013 | ``.gitignore:1-21`` | Does not cover `config.local.php`, `.sftp.json`, `*.db`, `*.sql`, `data/`, `normalized/`, `_governance/`; covers only tooling and two temp caches |
| A3-001 | ``modules/search_module.php:79`` | File search queries `files.filename` / `files.filetype`; the table has `title`, `content`, `file_type`. Exception swallowed at `:90` → zero file resul… |
| A3-002 | ``modules/search_module.php:94`` | Entity search queries `entities.name` / `entities.type`; the table has `canonical_name`, `entity_type`. Swallowed → zero entity results |
| A3-003 | ``modules/search_module.php:108-113`` | Relationship search queries `r.type`, `r.confidence`, `e1.name`, joins on `r.entity_a_id`/`entity_b_id` — none exist. Swallowed → zero relationship re… |
| A3-004 | ``api/search_load.php:103,110,117-123`` | Same three wrong column sets on a live endpoint; caught by the `try` at `:92`, so the compare pane silently refuses to open files, entities and relati… |
| A3-006 | ``engine/entity_extraction_engine.php:262-263`` | `from_entity`/`to_entity` truncated to 64 chars by `substr()` into `varchar(64)`; display names drift from `entities.canonical_name` |
| A3-009 | ``data/cases/case_001.json:7`, `case_002.json:8`` | Invalid JSON; `load_json_dir` requires `is_array` and drops them silently, so those cases vanish from every JSON-reading screen |
| A4-003 | ``modules/ingest_module.php:108-109`` | Uploaded file's content is read into `$content` and discarded; the pipeline receives only `"File uploaded: <name>"` |
| A4-004 | ``modules/ingest_module.php:111`` | `catch (Exception $e) {}` wraps the documents INSERT and pipeline, then reports success |
| A4-005 | ``modules/ingest_module.php:164-165`` | Sessions tab selects `session_label`/`platform`; the table has `session_title`/`source_ai` → always empty |
| A4-006 | ``modules/ingest_module.php:36-45`` | Pasted transcript is stored and never extracted; `processed` stays 0 and only `pm_module.php:184` ever changes it |
| A4-007 | ``modules/excavation_module.php:3`` | Requiring the 2-byte `{}` stub makes `shell.php` return `{}` instead of the module's array — the Excavation screen renders `{}` |
| A4-008 | ``modules/excavation_module.php:39-97`` | Extraction runs as a side effect of every GET page load, re-reading every client file (7.3 MB of JSON plus artifacts) |
| A4-009 | ``modules/excavation_module.php:263-276`` | Persistence loop writes one `auto_case_<signal>_<time>.json` per artifact into the same directory/file, so each artifact overwrites the last; `@mkdir … |
| A4-010 | ``engine/entity_extraction_engine.php:42`` | Noise list blacklists `Brad, Moore, Builders, Perry, Drees, Journey, Hill, Country` — the primary client can never be extracted |
| A4-013 | ``modules/entity_resolution_module.php:66-90`` | `break 2` after the first candidate and no UPDATE anywhere: the scan suggests at most one merge and executes none |
| A4-014 | ``ingest.php:3,25-29` / `ingest2.php:3,25-29`` | Hard-coded `$network_id`; only `network_id/type/strength` are posted, so `title`/`content` never leave the request; `http://` + Host header |
| A5-004 | ``api/brain_synthesis.php:44,48,54`` | `confidence` is a hard-coded 0/70/75 presented as a score; no cross-model agreement test exists |
| A5-005 | ``modules/cluster_module.php:18,20`` | Reads `clusters.name` and `clusters.summary`; the table has `label`, `members`, `score` — heading degrades to "Cluster", summary to empty |
| A5-006 | ``modules/graph_module.php:114`` | Shell mode returns two counts; the actual traversal (`:8`) is unreachable from the UI |
| A5-008 | ``semantic_cluster:223-225`, `predictive_link_v1:181-183`` | Return bare arrays; `shell.php:78-80` collapses every nested array to "N records", discarding the computed result entirely |
| A5-009 | ``engine/plain_english_helper.php` (whole file)` | Zero references; interpreters exist for 8 of these 12 modules and none is called |
| A6-003 | ``api/files_action.php:214`` | Delete guard covers only `FM_ROOT` and `kernel/`; `config.php`, `db.php`, `data/`, `.git` are all removable |
| A6-004 | ``api/search_load.php:19-26`` | Unauthenticated, id-enumerable read of any client document and any full transcript (`0`–`n` over `mysql:memory_ingest:<id>`) |
| A6-005 | ``modules/search_module.php:79`` | `files` search uses `filename`/`filetype`; real columns are `title`/`file_type` → always throws |
| A6-006 | ``modules/search_module.php:94`` | `entities` search uses `name`/`type`; real columns `canonical_name`/`entity_type` → always throws |
| A6-007 | ``modules/search_module.php:111-113`; `api/search_load.php:12` | Relationship search joins on `entity_a_id`/`entity_b_id` and reads `r.type`/`e1.name`; all four are wrong |
| A6-008 | ``modules/search_module.php:75,90,105,125,142`` | Five empty `catch (Exception $e) {}` turn every SQL failure into "No results" |
| A6-009 | ``api/search_load.php:103,146`` | `files` branch selects four non-existent columns; the catch returns `DB error: <SQLSTATE + message>` to the browser |
| A6-010 | ``modules/vault_module.php:14,85`` | Link sends `report_id`, handler requires `report_path`; download is permanently 404 (or a silent page reload) over 6 real PDFs |
| A6-011 | ``modules/vault_module.php:121-131`` | Payment POST omits `node_id`; `payment_module.php:37` requires it → always "Missing required fields" |
| A7-003 | ``modules/report_module.php:32`` | Findings filtered by `rf.context = client_id` with no case predicate → cross-case leakage into a case report |
| A7-004 | ``modules/report_module.php:204`` | Report body prints `source_table` + `source_id`; `findings.claim_text` is never selected |
| A7-005 | ``modules/report_module.php:80-86`` | No `INSERT INTO reports`; the `reports` table has 0 rows and no writer |
| A7-006 | ``modules/report_module.php:43-64`` | `cases.name` doesn't exist (`business_name`); `clients.id` int vs `client_<n>` string → "Untitled Case" / "Unknown Client" |
| A7-007 | ``modules/report_module.php:80-86`` | `$client_id`/`$case_id` concatenated into a `mkdir` path unsanitised → `../` escapes `data/` |
| A7-008 | ``modules/report_module.php:89`` | `header()` after `shell.php` output → ignored; PDF prefixed with page HTML |
| A7-009 | ``modules/report_module.php:37,60`` | `die('…' . $e->getMessage())` prints SQL errors to the browser |
| A7-011 | ``modules/payment_module.php:196-210`` | `status` endpoint unauthenticated, returns the full payment row |
| A7-012 | ``modules/payment_module.php:79,80,143,144`` | `'http://'` hardcoded in Stripe return URLs, plus unvalidated `HTTP_HOST` |
| A7-013 | ``modules/payment_module.php:193`` | No event dedupe: every webhook delivery re-sends both emails |
| A7-014 | ``modules/payment_module.php:35` vs `:225-245`` | `client_email` from checkout is discarded; receipts go only to `profile.json`, and the operator copy dies on undefined `JOHN_EMAIL` |
| A8-002 | ``ProjectManager/config.php:4`` | `require '/home/carmulti/private/pm_db_credentials.php'` — absolute path outside the project; absent → the whole app fatals |
| A8-003 | ``ProjectManager/router.php:16-17`` | No routes registered; `index.php` runs an empty application |
| A8-004 | ``ProjectManager/projects_dashboard.php:16-35`` | No login system; auto-creates owner `John Carr / admin@legaisee.local` on first run |
| A8-005 | ``ProjectManager/project_board.php:69,268`` | Kanban renders only 4 statuses; `Architecting`, `Building`, `Review` tasks never appear |
| A8-011 | ``modules/pm_module.php:70,311,358`` | Project CRUD targets `projects` (domain registry) while `pm_tasks.project_id` is documented against `pm_projects` → task parentage is two tables at on… |
| A9-001 | ``shell.php:181-250`` | `'status' => 'working'` hardcoded on all 34 sidebar entries; only `isset($registry[])` is checked, so BROKEN modules render as healthy |
| A9-002 | ``modules/intelligence_dashboard_module.php:21-95`` | Entire screen is mock data — invented metrics, constant `confidence: 0.78`, and a message asserting the system is "operational" |
| A9-003 | ``modules/brain_module.php:78-85`` | Engine probe points at `system/` which does not exist; all five engines report `false` (they live in `engine/`, 37 files) |
| A9-007 | ``shell.php:67-78`` | `exec-panel` collapses every nested array to "N records", discarding computed output |
| A9-008 | ``shell.php:63-65` + six modules` | `render_inspector` prints `json_encode` output in `<pre>` — six intelligence screens are JSON dumps by design |
| A9-010 | ``modules/view_module.php:264` → `ui/ui_engine.php:25`` | Module returns a complete `ui_page()`, nesting a second `<html>` document inside the shell |
| A9-011 | ``shell.php:3-4`` | `display_errors=1` on an unauthenticated page; `catch (Throwable)` at `:80` prints exception messages into the UI |

## Appendix C — count per verdict

| Verdict | Files |
|---|---:|
| ARCHIVE | 225 |
| KEEP | 60 |
| FIX | 39 |
| FINISH | 29 |
| **total** | **353** |
