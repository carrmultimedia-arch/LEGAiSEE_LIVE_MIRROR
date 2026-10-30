# A2 — Runtime spine and security (S1)

**Date:** 2026-10-29
**Scope:** `shell.php`, all 19 files in `kernel/` (+ `kernel/model/`), `kernel/legaisee.db`, `config.php`, `config.local.php`, `db.php`, `.htaccess`, `ui/ui_bootstrap.php` — 26 files. Two webroot artefacts outside that list (`legaisee.db`, the 5.2 MB `.sql` dump) are included because the same check exposes them.
**Method:** read every file in scope end to end; grep for credential identifiers (names only, values masked), error-display settings, file-serving sinks, and `php_value`/`php_flag`; `bash deadcheck.sh` for every kernel file whose status was not already settled by A1; table existence and column shape verified against `schema-source.sql`.
**Inputs:** `schema-source.sql` (server `5.7.44-percona`, 51 tables), `A1-reachability.md` (reachability only — never used as proof of safety), `AUDIT-APPENDIX-FILE-STATUS.md` (v1 ledger, re-adjudicated).

---

## The finding that outranks the rest

**Nothing in this product requires a login, and seven files in the webroot hand out data to anyone who asks.** Reachability does not protect a PHP file: every `.php` under the webroot answers its own URL. That means every "DEAD" and "UNWIRED" file from A1 is still an HTTP endpoint — a dead file is unmaintained, not unreachable.

| Exposure | Path | Auth | Proof |
|---|---|---|---|
| SFTP host + username + password | `.sftp.json` (656 b), `.vscode/sftp.json` (614 b) | none | static JSON files; `.htaccess:11` denies only `config.php`, `.env`, `.gitignore` |
| Full client database | `` `db-before-migration-2026-10-29.sql`.sql `` (5,232,685 b, 70 `INSERT` blocks) | none | static file in webroot |
| Legacy SQLite records | `legaisee.db` (57,344 b) | none | static file in webroot |
| Any generated report PDF | `modules/vault_module.php:23` `readfile($_GET['report_path'])` | none (`shell.php:20` runs before any check) | prefix test at `:19`, bypassable |
| Any file in `normalized/` | `api/file.php:15` → `:24` returns full content | none | `basename()` sanitised, but no auth and no extension allow-list |
| Every screen, both JS APIs, 3 brain APIs | `shell.php:32-58`, `api/*.php` | none | A1-001 |
| DB table list + SQL error text | `kernel/system_health.php:186` JSON output | none | unauthenticated diagnostics endpoint |

---

## 1. Database connection path

```
shell.php:6 ──► kernel/kernel_boot.php:5 ──► kernel/db.php:3 ──► config.php:8
                                                                     │
                                                        config.local.php:3-6
                                                          DB_HOST / DB_NAME
                                                          DB_USER / DB_PASS
                                                     (no config.local.php ⇒ constants never defined)
```

`kernel_db()` (`kernel/db.php:5-20`) builds one PDO per request, cached in a `static`:

| Line | Behaviour | Assessment |
|---|---|---|
| `:11` | `mysql:host=…;dbname=…;charset=utf8mb4` | Correct — charset is in the DSN, not a post-connect `SET NAMES`. |
| `:12` | `new PDO($dsn, DB_USER, DB_PASS)` | No `PDO::ATTR_TIMEOUT` and no `ATTR_PERSISTENT`; a hung database hangs the request indefinitely. |
| `:13` | `ERRMODE_EXCEPTION` | Correct — but it is what makes §2's missing-`try` sites fatal. |
| `:14` | `catch (PDOException $e)` | **Catches only `PDOException`.** Undefined constants raise `Error`, so the catch cannot see them (A2-008). |
| `:16` | `die("DB ERROR: " . $e->getMessage())` | Prints driver detail to the visitor (A1-012, reconfirmed). |

`db.php:2-4` then republishes the handle as `global $pdo` for pre-kernel modules. `config.php` is a 9-line loader whose only real work is `config.local.php:8` — a `file_exists` guard, so a missing local config degrades silently into undefined constants rather than an explicit error.

**No `mysqli` link is opened by the spine**, but `kernel/task_generator.php:21` calls `bind_param()` (`mysqli` API) on a PDO handle, so that file could never have worked.

---

## 2. Error display

| Location | Setting | Effect |
|---|---|---|
| `shell.php:3-4` | `error_reporting(E_ALL); ini_set('display_errors', 1);` | Every warning, notice and failed include is printed **into the rendered page** for the whole request — including absolute server paths and SQL fragments. |
| 10 further files | same `display_errors` idiom: `prospect.php`, `modules/semantic_cluster_module.php`, `modules/predictive_link_module_v1.php`, `view_ingest.php`, `temp_dashboard.php`, `pages/shell_template.php`, `pages/test/shell_module_test.php`, `api/v8/run_worker.php`, `api/v8/generate_tasks.php` | Two of these are **live routed modules** (`semantic_cluster`, `predictive_link_module_v1`), so the leak is not confined to dead code. |
| `.htaccess` | **no** `php_flag display_errors off`, no `php_value error_log` anywhere | Nothing at the server level countermands the per-file `ini_set`. |
| `kernel/system_health.php` | `$e->getMessage()` echoed into JSON at `:96`, `:121`, `:150` | An unauthenticated caller reads SQLSTATE text and table names. |

`display_errors` is not inherited from `shell.php` into `api/*.php` (those are separate requests), so the API surface depends on the host's `php.ini` — unknown, and therefore a limit (§9).

---

## 3. Files that return file contents from a URL parameter

### 3.1 `modules/vault_module.php` — report download (**P0**)

| Line | Code | Problem |
|---|---|---|
| `:14` | `if (isset($_GET['action']) && $_GET['action'] === 'download' && isset($_GET['report_path']))` | The path arrives directly from the query string. |
| `:15` | `$report_path = $_GET['report_path'];` | No normalisation, no allow-list. |
| `:16` | `$base_dir = realpath(__DIR__ . '/../data/clients');` | The intended boundary — computed once, then compared by prefix. |
| `:19` | `if (realpath($report_path) && strpos(realpath($report_path), $base_dir) === 0 && file_exists($report_path))` | **Prefix** containment test. `…/data/clients_archive/x.pdf` starts with `…/data/clients` and passes. `realpath()` is called three times; the `file_exists()` check is on the raw, unnormalised string. |
| `:20-22` | `Content-Type: application/pdf`, `Content-Disposition`, `Content-Length` | Sets an attachment header for whatever passed the test. |
| `:23` | `readfile($report_path);` | Streams the bytes. |
| `shell.php:20` | `if (... 'vault' && ... 'download') { require ...; exit; }` | Reached **before** any HTML and before any identity check. |

Two independent ways in: the shell route (`shell.php?module=vault&action=download&report_path=…`) and the module's own URL (`modules/vault_module.php?action=download&report_path=…`, no `KERNEL_ROOT` guard at `:1`).

### 3.2 `api/file.php` — normalized file reader (**P0**)

| Line | Code | Assessment |
|---|---|---|
| `:5` | `$dir = __DIR__ . "/../normalized/";` | Fixed directory — good. |
| `:7` | `$file = basename($_GET['file'] ?? '');` | `basename()` neutralises `../` — traversal is **not** possible here. |
| `:15` | `$content = file_get_contents($path);` | Reads the whole file into memory; no size cap. |
| `:24` | `"content" => $content` | Returns the entire file to the caller — no auth, no extension allow-list, and `normalized/` is where ingest output lives. |

Correctly hardened against traversal, completely open to anonymous reading. `api/file.php` has **zero references** (A1: UNWIRED) and is still callable by URL.

### 3.3 Flagged, not adjudicated here

`api/search_load.php` takes `ref=source:type:key` (`:24`) and maps `type` to a data directory (`:38-43`) — the same shape as 3.1. It is out of A2's file list; its containment check is **not** verified in this block and is carried to the search/API block. Recording it here so it cannot be lost.

---

## 4. Endpoints with no authentication

Counted at the URL level, which is the level that matters:

| Surface | Count | Evidence |
|---|---:|---|
| HTML screens via `shell.php` | 35 registry keys + lobby | `shell.php:32-58`, no identity gate (A1-001) |
| Pre-HTML intercepts | 3 (report `:14`, vault `:20`, brain `:26`) | `shell.php:10-29` |
| `api/*.php` top level | 33 files, each its own URL | 5 used by the UI, 28 with no reference — all still callable |
| `api/v8/*.php` | 35 files | reachable through `api.php?…` even though nothing links to it |
| `modules/*.php` directly | 29 unguarded | A1-004; the 6 guarded ones still lack auth, they only block direct fetch |
| Diagnostics / artefacts | `system_health.php`, `legaisee.db`, `.sql` dump, `.sftp.json`, `.vscode/sftp.json` | this block |

`kernel/system_health.php` deserves its own line: it requires `kernel_boot` (`:17`) and **echoes JSON directly** (`:186`) with no guard — a public endpoint that lists every table in the database and the text of any SQL failure.

---

## 5. Secrets inventory — file and line only, no values

| File | Line | Identifier | Notes |
|---|---:|---|---|
| `config.local.php` | 3 | `DB_HOST` | DB endpoint |
| `config.local.php` | 4 | `DB_NAME` | database name |
| `config.local.php` | 5 | `DB_USER` | DB account |
| `config.local.php` | 6 | `DB_PASS` | DB password |
| `config.local.php` | 12 | `CLAUDE_API_KEY` | value matches the `sk-…` API-key pattern (the only file in the tree that does) |
| `.sftp.json` | — | host / user / password keys (656 b) | not read; file presence and size only |
| `.vscode/sftp.json` | — | host / user / password keys (614 b) | not read; file presence and size only |

No secret value appears anywhere in this report or in the workspace files this audit created. `config.local.php` was **not** opened — identifiers were extracted with a pattern that stops before the value (`define('NAME',`), so `DB_PASS` and `CLAUDE_API_KEY` never entered the transcript.

---

## 6. Git state and ignore coverage

### 6.1 Tracking cannot be verified — the repository is damaged

```
$ git status --porcelain
fatal: unknown index entry format 0x092e0000
$ git log --oneline
error: corrupt loose object 'c27c19be9414cf357a6155a113738d6fe6c38c80'
fatal: loose object … is corrupt
-rw-r--r-- 1 LEGAiSEE 197121 50760 Oct 21 02:02 .git/index
```

`git ls-files` exits without listing anything, because the **index is corrupt**, not because the tree is empty. **This retracts A0's correction C-02** ("nothing under `commandcenter/` is tracked"), which was produced by the same broken command and read a failure as a fact. Whether `config.local.php`, `sftp.json`, `*.db` or the `.sql` dump are tracked is currently **unknown and unprovable on this host** until the index is rebuilt (`git read-tree`/re-clone). Treat it as unknown, not as safe.

The repo root is `commandcenter/` itself (`git rev-parse --show-toplevel`), so `_governance/` sits inside the repository.

### 6.2 `.gitignore` coverage — read from the file, not inferred

Only one ignore file exists: `commandcenter/.gitignore` (129 b). There is **no root-level `.gitignore`** (the repository root is `commandcenter/`, so that is not a gap).

| Sensitive path | Covered? | Governing rule |
|---|---|---|
| `.vscode/sftp.json` | **yes** | `.vscode/` |
| `.env` | yes | `.env` |
| `_backup/`, `*.zip` | yes | `_backup/`, `*.zip` |
| `config.local.php` | **NO** | — |
| `.sftp.json` (root-level file) | **NO** | `.vscode/` does not match it |
| `legaisee.db`, `kernel/legaisee.db` | **NO** | no `*.db` rule |
| `` `db-before-migration-2026-10-29.sql`.sql `` | **NO** | no `*.sql` rule |
| `data/` (per-case client JSON) | **NO** | only `data/cache/` and `data/temp/` are ignored |
| `normalized/` (ingest output) | **NO** | — |
| `_governance/` (these audit reports) | **NO** | — |

So the ignore file protects the tooling (`vendor/`, `.vscode/`) and the two temp caches, and protects **none** of the six things that actually hold credentials or client records.

---

## 7. File table

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `shell.php` | Single HTML entry; three early intercepts, registry dispatch, lobby + sidebar | WORKS-WITH-DEFECT | A1-001 no auth (`:6-8`, `:14/20/26`, `:32`, `:58`); A2-007 `:3-4` `display_errors=1` for the whole request | Gate `:12` on an authenticated identity; turn display_errors off and log instead | P0 |
| `kernel/kernel_boot.php` | Requires `db`, `kernel_paths`, `ui_bootstrap`; starts session; republishes `$db` | WORKS-WITH-DEFECT | A1-001b `session_start()` at `:12-13` never binds a user; A1-013 `kernel_assets()` at `:41` is never called | Enforce identity here, where every entry point already passes through | P0 |
| `kernel/db.php` | `kernel_db()` — the only PDO, statically cached | WORKS-WITH-DEFECT | A2-008 `:14` catches `PDOException` only, so a missing `config.local.php` raises an uncaught `Error` from `:11-12`; A1-012 `:16` `die()` prints driver detail; no connect timeout at `:12` | Catch `Throwable`, validate constants, log instead of die, set `ATTR_TIMEOUT` | P1 |
| `kernel/kernel_paths.php` | Defines `KERNEL_ROOT`, `DATA_ROOT`, `FILES_ROOT`, `CLIENTS_ROOT`, `CASES_ROOT`, `MEMORY_ROOT` | WORKS | — | Keep | — |
| `kernel/module_registry.php` | 35 name→filename pairs; the routing table | WORKS | — | Keep | — |
| `kernel/kernel.php` | Deprecated stub, `return true` | WORKS-WITH-DEFECT | A1-010 still required by `modules/view_module.php:9` and by `kernel/guard.php:3`; loads nothing | Stop including it; archive the stub | P2 |
| `kernel/bootstrap.php` | One-line shim: `require ../db.php` | DEAD | 0 full-path refs; the 47 stem hits are all *other* `bootstrap.php` files (`shell.php:7` is `modules/utils/`). Duplicates the root `db.php` shim | ARCHIVE | P2 |
| `kernel/guard.php` | `kernel_guard()` — "SYSTEM ENFORCER"; only asserts `$pdo` is non-null | DEAD | A2-012 `:17` calls `kernel_db()` but `:3` requires only `kernel.php`, which loads no DB → fatal if loaded standalone; 0 full-path refs (the 1 stem hit is the unrelated string `"engagement_guard"` at `engine/policy_enforcement_engine.php:102`) | FINISH: make it a real boot assertion, or ARCHIVE | P2 |
| `kernel/ingestion_pipeline.php` | `ingestToNode()` — text → node, written into `network.json` | WORKS | Live only from `modules/ingest_module.php:110` (conditional on upload + `case_id`); JSON store, not MySQL (data block) | Keep; the JSON write is the data block's problem | P1 (deferred) |
| `kernel/cluster_intelligence.php` | `detectClusters()` over `network.json`, similarity > 60 | DEAD | 0 references of any form | ARCHIVE, or FINISH if clustering is wanted | P2 |
| `kernel/graph_auto_builder.php` | `buildGraph()` — pairwise similarity → `edges`, writes `network.json` | DEAD | 0 references of any form | ARCHIVE | P2 |
| `kernel/graph_engine.php` | `graph_get_data()` — folders/files/`page_relations` → nodes+links | DEAD | A2-010 `:44-46` queries `page_relations`, which **does not exist** in the dump (verified: 51 tables, no `page_relations`) → uncaught `PDOException`, no `try` in the function | Rewrite against real tables, or ARCHIVE | P1 |
| `kernel/folder_engine.php` | Folder tree / pages / create folder over `folders`, `page` | UNWIRED | Its only caller is `ui/file_explorer.php:3`, itself unreachable | Wire to the file browser or ARCHIVE | P2 |
| `kernel/task_generator.php` | Recommendations → `tasks` + `processing_queue` rows | DEAD | A2-009 `:3` requires `kernel/recommendation_engine.php` — **file does not exist** (fatal); `:19` `bind_param()` is the mysqli API on a PDO handle; `:29` uses undefined `$pdo` after `$conn->lastInsertId()`; `:15-17` inserts `action`/`priority`, columns absent from `tasks` (`id, case_id, task_type, status, input_data, output_data, created_at`) | FINISH from scratch against the real `tasks` shape, or ARCHIVE | P1 |
| `kernel/system_health.php` | Read-only diagnostics: kernel, DB, modules, files, graph → JSON | DEAD | A2-011 `:50` `SELECT … FROM sqlite_master` on MySQL throws, aborting the whole DB block so `database.status` is always `ERROR`; `:91` `array_column($registry,'file')` on a `key => 'file.php'` map returns `[]`, so **all 35 modules are reported as orphans**; `:38` `COMMANDCENTER_BOOTSTRAPPED` is defined **nowhere** in the tree, so `booted` is always false; `:185` emits everything to an unauthenticated caller | Fix the three probes (no `sqlite_master`, `array_values($registry)`, drop the phantom constant) and put it behind auth | P1 |
| `kernel/kernel_contract.php` | Comment-only placeholder (implementation removed to avoid duplicate definitions) | UNWIRED | Only ref is `test_modules.php:4`, itself unreachable | ARCHIVE | P2 |
| `kernel/module_contract.php` | Comment-only rules file ("modules must…") | UNWIRED | Only ref is `test_modules.php:5`, unreachable; documents rules nothing enforces | Keep as documentation or ARCHIVE | P2 |
| `kernel/model/page_model.php` | `page_find()` — LIKE search over `page` + `page_content` | DEAD | 0 references of any kind; tables exist, so it is unused, not broken | ARCHIVE, or FINISH if search wants it | P2 |
| `kernel/engine_bindings.php` | Declares which engines each module should load (6 modules) | DEAD | 0 references of any form; names engines that are themselves unreachable — a design document, not a runtime file | FINISH: read it from the module loader, or ARCHIVE | P2 |
| `kernel/legaisee.db` | 0-byte SQLite file | BROKEN | 0 bytes; static file inside the webroot | ARCHIVE | P2 |
| `config.php` | Loads `config.local.php` if present | WORKS | Missing local config degrades into undefined constants rather than an explicit failure (`:8`) — see A2-008 | Fail fast with a clear message | P1 |
| `config.local.php` | Real DB constants + `CLAUDE_API_KEY` | WORKS-WITH-DEFECT | A2-004 `:3-6` and `:12` hold credentials; `.htaccess:11` does not deny this filename; `.gitignore` does not cover it | Deny it, ignore it, rotate the key | P0 |
| `db.php` | Root shim: `global $pdo; $pdo = kernel_db();` | WORKS | Runs `kernel_db()` at include time, so any include of it is a hard DB dependency (two routed modules depend on that) | Keep, or move to lazy access | P2 |
| `.htaccess` | Disables mod_security; denies 3 filenames | WORKS-WITH-DEFECT | A1-002 `:1-8` (`SecFilterEngine Off` at `:2`, `SecRuleEngine Off` at `:7`); A1-003 / A2-001 `:11` denies only `config.php`, `.env`, `.gitignore` — not `config.local.php`, `.sftp.json`, `.vscode/`, `*.db`, `*.sql`, `_governance/`; no `php_flag display_errors off` | Re-enable the filter, deny the artefact and dot-directory set, turn display_errors off at the server | P0 |
| `ui/ui_bootstrap.php` | `legaisee_ui_bootstrap()` returns a stylesheet link | WORKS-WITH-DEFECT | A1-013 `:3-6` never called; `shell.php` hardcodes the same link | Remove duplicate or call the helper | P2 |

### Webroot artefacts (same check, outside the file list)

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `.sftp.json` | Editor/Deploy SFTP config — host, user, password | BROKEN (as a web asset) | A2-001 656 b of SFTP credentials served as static text; not matched by `.htaccess:11` | Move outside the webroot; deny dotfiles | P0 |
| `.vscode/sftp.json` | Second copy of the same SFTP config | BROKEN (as a web asset) | A2-001 614 b of the same credentials, in a dot-directory Apache will serve | Move outside the webroot; deny dotfiles | P0 |
| `` `db-before-migration-2026-10-29.sql`.sql `` | Full pre-migration dump, 51 tables, 70 `INSERT` blocks | BROKEN (as a web asset) | A2-002 5,232,685 b of client data downloadable; not ignored, not denied | Move outside the webroot; deny `*.sql` | P0 |
| `legaisee.db` | Legacy SQLite database, 57,344 b | BROKEN (as a web asset) | A2-003 downloadable binary; not ignored, not denied | Move outside the webroot; deny `*.db` | P0 |

---

## 8. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A2-001 | `.sftp.json:1`; `.vscode/sftp.json:1` | SFTP host, username and password sit in the webroot and are served as static files; `.htaccess:11` denies only three filenames and nothing in dot-directories | P0 | V1 |
| A2-002 | `db-before-migration-2026-10-29.sql:1` (root of webroot) | The full 5,232,685-byte client database dump is downloadable over HTTP | P0 | V1 (data breach) |
| A2-003 | `legaisee.db:1` | 57,344-byte legacy SQLite database downloadable over HTTP; `kernel/legaisee.db` is a 0-byte twin | P0 | V1 |
| A2-004 | `config.local.php:3-6,12` | DB credentials and a live-pattern API key in a file the `.htaccess` deny list does not cover and `.gitignore` does not ignore | P0 | V1 |
| A2-005 | `modules/vault_module.php:19,23` | Report download streams `$_GET['report_path']` via `readfile()`; containment is a `strpos() === 0` **prefix** test that a `clients…`-prefixed sibling directory defeats; reached pre-auth from `shell.php:20` and also directly | P0 | V1 |
| A2-006 | `api/file.php:15,24` | Returns the complete contents of any file in `normalized/` to an unauthenticated caller; `basename()` blocks traversal but there is no auth and no allow-list | P0 | V1 |
| A2-007 | `shell.php:3-4` (+9 more files) | `error_reporting(E_ALL)` + `display_errors=1` print warnings, paths and SQL into the page; nothing in `.htaccess` countermands it | P1 | V1 polish |
| A2-008 | `kernel/db.php:11-14`; `config.php:8` | If `config.local.php` is absent, `DB_HOST`/`DB_NAME`/`DB_USER`/`DB_PASS` are undefined → PHP `Error`, which `catch (PDOException)` cannot catch → uncaught fatal, printed in full because of A2-007 | P1 | Fresh deploy / restore |
| A2-009 | `kernel/task_generator.php:3,19,29` | Requires a file that does not exist; uses `mysqli` `bind_param()` on a PDO handle; reads undefined `$pdo`; inserts `action`/`priority` columns absent from `tasks` | P1 | Task generation |
| A2-010 | `kernel/graph_engine.php:44-46` | Queries `page_relations`, absent from the schema; no `try`, so the function is fatal whenever called | P1 | Graph data |
| A2-011 | `kernel/system_health.php:50,91,38,185` | `sqlite_master` probe on MySQL aborts the DB block (status always ERROR); `array_column` on a name→file map reports all 35 modules as orphans; `COMMANDCENTER_BOOTSTRAPPED` is defined nowhere; output is unauthenticated | P1 | Diagnostics |
| A2-012 | `kernel/guard.php:3,17` | The "enforcer" requires only the no-op `kernel.php`, so `kernel_db()` is undefined when the guard loads — the one file whose job is to guarantee the DB would itself crash | P1 | Any future wiring of the guard |
| A2-013 | `.gitignore:1-21` | Does not cover `config.local.php`, `.sftp.json`, `*.db`, `*.sql`, `data/`, `normalized/`, `_governance/`; covers only tooling and two temp caches | P1 | Repo hygiene |
| A2-014 | `.git/index` (repo state) | The index is corrupt (`unknown index entry format 0x092e0000`) and a loose object is unreadable, so no tracking claim can be verified — including A0's C-02 | P1 | Any git-based check |

---

## 9. Limits

- **Git tracking is unverifiable.** The index is corrupt and one loose object is unreadable. A0's C-02 ("nothing is tracked") is **retracted**: it was a silent zero from a failing command. Whether `config.local.php`, `sftp.json`, `*.db` or the `.sql` dump are tracked must be re-checked after `git read-tree` / a fresh clone.
- **`.gitignore` coverage is assessed by reading the file**, not with `git check-ignore` — that command returns nothing usable while the index is broken.
- **No server was contacted.** "Downloadable" means the file sits inside the webroot with no deny rule matching it; whether the host serves it depends on the vhost, Apache vs nginx, and `Options -Indexes`. The `.htaccess` present is Apache 2.2-style (`Order allow,deny`), which is **ignored by Apache 2.4 unless `mod_access_compat` is on** — worth confirming on the live host, because if it is ignored then even `config.php` is not denied.
- `config.local.php` was deliberately **not opened**; only `define('NAME',` prefixes were read. No secret value appears in any artefact this audit produced.
- `api/search_load.php`'s containment check was **not** verified here (out of scope, §3.3) and is carried to the search/API block.
- `display_errors` behaviour for `api/*.php` depends on the host `php.ini`; only the 11 files that set it themselves are provable from source.
- No source file was modified in this block.

---

### Legend
**Status** — `WORKS` reachable + correct by inspection · `WORKS-WITH-DEFECT` reachable, defect recorded · `BROKEN` fails when reached · `UNWIRED` complete but nothing loads it · `DEAD` proven unreferenced (`00-GROUND-RULES.md` §5).
**Severity** — `P0` blocks V1 / security hole · `P1` wrong results, broken capability, or data loss · `P2` cosmetic or hygiene.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions.
