# A1 — Entry points and real reachability

**Date:** 2026-10-29
**Scope:** all 346 first-party PHP files under `commandcenter/` (vendor, `lib/dompdf`, `z_Deleted by claude/`, `_backup/`, `archive/`, `*.bak-*` and `*.phpbak` excluded from the graph)
**Method:** `_governance/audits-v2/a1_reach.py` → `A1-graph.json`, rendered by `a1_report.py` → `A1-report.txt`. Three independent surfaces were measured, not one:

| Surface | How | Why |
|---|---|---|
| PHP includes | `require/include(_once)` parsed with a real expression evaluator: `__DIR__`, `__FILE__`, `dirname(__DIR__)`, `dirname(__DIR__, 2)`, `DIRECTORY_SEPARATOR`, string concatenation, bare relative literals resolved against the including file's directory | v1's scanner could not follow any computed path, which is why it could not see `shell.php`'s registry dispatch |
| Browser surface | quoted `*.php` URLs in `fetch(`, `XMLHttpRequest.open`, `$.ajax`, `href=`, `src=`, `action=`, `location` inside screens, JS and markup | v1 never looked inside screens, so every `api/*.php` looked uncalled |
| Server config | every `.htaccess` / `.user.ini` / `web.config` directive | rewrites and `auto_prepend_file` are execution paths |

Seeds, per the block definition: `shell.php`; all 35 files named by `kernel/module_registry.php` (resolved from the array, since `shell.php:58` builds the path at runtime); the three modules `shell.php` requires directly in its early intercepts (`report`, `vault`, `brain`); every `api/*.php` named by JS inside a reachable screen; `cli/*` named by a module or a task runner; and `.htaccess`.

**Inputs:** `schema-source.sql` (server `5.7.44-percona`, 51 tables), `AUDIT-APPENDIX-FILE-STATUS.md` + `audit_files.csv` (v1 ledger, re-adjudicated — never inherited).

---

## Result in one line

The live spine is **tiny and one page wide**: `shell.php` → `kernel_boot` → `db` → `config` → `config.local`, plus 35 registry modules. **60 first-party PHP files are reachable; 286 are not.** `shell.php` has **no authentication of any kind**.

| Measure | Count |
|---|---:|
| First-party PHP files walked | 346 |
| Registry modules declared / files present | 35 / 35 |
| Reachable nodes (60 first-party + 2 bundled autoloads) | 62 |
| First-party PHP files unreachable | 286 |
| Top-level `api/` endpoints reachable | 5 of 33 |
| `api/v8/` endpoints reachable | 0 of 35 |
| `cli/` scripts reachable | 0 of 3 |
| Files with a browser-surface URL | 182 |
| Files with a computed `require` that could not be resolved | 12 (all inspected by hand, see §7) |

---

## 1. Start points

| # | Class | Resolved start points | Note |
|---|---|---|---|
| 1 | Direct entry | `shell.php` | The only HTML entry point in use. |
| 2 | Registry modules | 35 keys in `kernel/module_registry.php:5-40` → `modules/*.php`, all 35 present | Reached through `shell.php:58 require $file` — the computed path v1 could not follow. |
| 3 | Early intercepts | `modules/report_module.php`, `modules/vault_module.php`, `modules/brain_module.php` | Required at `shell.php:14`, `:20`, `:26` **before** any HTML and before any identity check. |
| 4 | JS-called API | `api/search_load.php` (`modules/search_module.php:237`), `api/files_action.php` (`modules/files_module.php:91`) | Only **two** endpoints are called from JavaScript anywhere. |
| 5 | PHP-required API | `api/brain_orchestrator.php` (`modules/brain_module.php:23`) | Server-side `require`, not a browser call. |
| 6 | Standalone link | `prospect.php` (`shell.php:251`) | The only non-module page reachable from the UI. |
| 7 | Cli / cron | none called by cron; `cli/worker.php` named only by `api/v8/run_worker.php:20` (`shell_exec`) | No crontab, no `*cron*` file anywhere in the tree. |
| 8 | `.htaccess` | **no rewrite, no `auto_prepend_file`, no `ErrorDocument`** | 13 lines total; only mod_security toggles and a `<FilesMatch>` deny. Nothing in it creates a route. |

---

## 2. File table — entry points, spine, and everything the spine pulls in

Status — `WORKS` reachable and correct by inspection · `WORKS-WITH-DEFECT` reachable with a recorded defect · `BROKEN` fails when reached · `UNWIRED` complete but nothing loads it · `DEAD` proven unreferenced (§6).

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `shell.php` | Single HTML entry: routes `?module=` through the registry, renders lobby + sidebar | WORKS-WITH-DEFECT | A1-001 no auth/session check anywhere (`:6-8` requires, `:14/20/26` intercepts, `:32` registry, `:58` dispatch); serves every screen to an anonymous visitor | Require an authenticated identity before `:12` | P0 |
| `kernel/kernel_boot.php` | Loads `db`, `kernel_paths`, `ui_bootstrap`; starts a session; exposes `$db` fallback | WORKS-WITH-DEFECT | A1-001b `session_start()` at `:12-13` starts a session but never binds or verifies a user | Use the session it already opens to enforce identity | P0 |
| `kernel/db.php` | `kernel_db()` — the single MySQL PDO, static-cached | WORKS-WITH-DEFECT | A1-012 `:16` `die("DB ERROR: ".$e->getMessage())` prints driver detail to the browser | Log it, return a generic 500 | P2 |
| `kernel/kernel_paths.php` | Defines `KERNEL_ROOT`, `DATA_ROOT`, `FILES_ROOT`, `CLIENTS_ROOT`, `CASES_ROOT`, `MEMORY_ROOT` | WORKS | — | Keep | — |
| `kernel/module_registry.php` | 35 name→filename pairs — the routing table | WORKS | — | Keep | — |
| `kernel/kernel.php` | Legacy stub that returns `true` | WORKS-WITH-DEFECT | A1-010 still required by `modules/view_module.php:9`; carries no behaviour | Drop the include, then archive the stub | P2 |
| `config.php` | Loads `config.local.php` if present | WORKS | v1 credited `ProjectManager/bootstrap.php` as its caller; the real caller is `kernel/db.php:3` | Keep | — |
| `config.local.php` | Real DB constants (untracked) | WORKS | A1-003 not covered by the `.htaccess` deny list (`.htaccess:11`) | Deny it explicitly | P0 |
| `db.php` | Root shim: `global $pdo; $pdo = kernel_db();` | WORKS | v1 credited a dead caller; real callers are `modules/semantic_cluster_module.php:11`, `modules/vault_module.php:10` | Keep | — |
| `ui/ui_bootstrap.php` | `legaisee_ui_bootstrap()` returns a stylesheet `<link>` | WORKS-WITH-DEFECT | A1-013 `:3-6` nothing calls it (`kernel_assets()` is never invoked); `shell.php`'s `<head>` hardcodes the same link | Remove the duplicate or use the helper | P2 |
| `ui/ui_engine.php` | `ui_page()` / `ui_panel()` render pipeline; the only place that includes `layout.php` | WORKS | — | Keep | — |
| `ui/layout.php` | Page chrome for `ui_page()` (`ui_engine.php:24`) | WORKS | — | Keep | — |
| `kernel/nav_engine.php` | `kernel_nav_push()` / `kernel_nav_back()` over `$_SESSION['nav_history']` | WORKS | — | Keep | — |
| `lib/semantic_diff_engine.php` | Semantic diff/compare engine | WORKS | 31 of its 32 includes come from unreachable scripts; the live edge is `modules/view_module.php:8` | Keep | — |
| `modules/utils/bootstrap.php` | Defines `load_json_dir()` | WORKS-WITH-DEFECT | A1-007 defines the function every JSON module needs, but 12 call sites never include it (they rely on `shell.php:7`) | Have each module require it, or move it into the kernel | P1 |
| `modules/utils/uic_v1.php` | UIC v1 renderer (`uic_render`) | WORKS | — | Keep | — |
| `modules/utils/json_helpers.php` | **2 bytes: the literal text `{}`** — not PHP | BROKEN | A1-006 `modules/alert_module.php:3` and `modules/excavation_module.php:3` `require_once` it, emitting a literal `{}` into the page before any markup | Replace with a real PHP file or remove both includes | P1 |
| `api/brain_orchestrator.php` | Brain run: orchestrate → route → synthesise | WORKS | — | Keep | — |
| `api/model_router.php` | Model selection for the brain run | WORKS | — | Keep | — |
| `api/brain_synthesis.php` | Synthesis step of the brain run | WORKS | — | Keep | — |
| `api/search_load.php` | JSON endpoint: loads one result's content into a compare pane | WORKS-WITH-DEFECT | MYSQL+JSON dual store (data layer, deferred to the data block) | Deferred | P1 (deferred) |
| `api/files_action.php` | JSON endpoint: all file-browser operations | WORKS-WITH-DEFECT | JSON store for file actions (data layer, deferred) | Deferred | P1 (deferred) |
| `api/tree.php` | `tree_nodes` CRUD (`create`/`rename`/`move`/`delete`/`get_tree`) | DEAD | A1-008 `:124` `WITH RECURSIVE` — unsupported on the dump's `5.7.44-percona`, so `move` throws a syntax error even if wired; zero references (§6) | Rewrite the descendant check without a CTE, then wire | P1 |
| `api.php` | The only `api/v8` dispatcher: `:35 include __DIR__."/api/v8/".$file` | DEAD | A1-009 zero execution references, so all 35 `v8` handlers are unreachable through it | Decide the v8 surface, then wire it or archive both | P1 |
| `api/file.php` | Serves a file from `normalized/` as JSON, `basename()`-sanitised | UNWIRED | 0 references of any kind | Wire into the file browser or archive | P2 |
| `cli/worker.php` | Background worker | UNWIRED | No live caller; only `api/v8/run_worker.php:20` (`shell_exec`), itself unreachable. v1's `BROKEN` claim not re-verified in A1 | Keep pending the worker decision | P2 |
| `cli/chain_evolver.php` | Evolution chain generator | DEAD | Zero references (§6) | Archive | P2 |
| `cli/chain_generator.php` | Chain generator | DEAD | Zero references | Archive | P2 |
| `prospect.php` | Standalone Prospect Dig page; requires the entity engine at `:7` | WORKS | v1 called it `REFERENCED-DEAD`; it is linked from `shell.php:251` and self-links at `:501/:518/:650` | Keep | — |
| `modules/client_view_module.php` | Client record screen | **BROKEN** | A1-005 `:223` `require __DIR__.'/../graph_view.php'` → `commandcenter/graph_view.php` **does not exist** (the file is `views/graph_view.php`) → fatal "failed to open stream" whenever that branch renders | Point it at `views/graph_view.php` | P1 |
| `engine/entity_extraction_engine.php` | Artifacts → entities/relations → MySQL; the billable extraction unit | WORKS | v1 marked `REFERENCED-DEAD` while naming its live caller — direct contradiction | Keep | — |
| `kernel/ingestion_pipeline.php` | `ingestToNode()` — writes an ingest into a case's network graph | WORKS | Reachable only through `modules/ingest_module.php:110` inside the upload branch (`if ($case_id)`), so an upload without a case never exercises it | Keep | — |
| `engine/hierarchy_of_truth_engine.php` | Truth hierarchy over findings | UNWIRED | Its only reference is `test_hierarchy_of_truth.php:17`, itself unreachable (§6) | Wire to the insight surface or archive with its test | P2 |
| `engine/plain_english_helper.php` | Turns module numbers into client-readable sentences (`lee_interpret`) | DEAD | Zero references; the single "hit" is its own docblock example at `:10`; `:16` dies unless `KERNEL_ROOT` is defined | Wire into insight/recommendation output | P2 (highest value dead file) |

---

## 3. Every registered module: what it requires, includes, fetches or links to

This is the answer to "list every file it requires, includes, fetches, or links to, including `href` and JS `fetch` URLs". One row per registry entry, in registry order.

| Module (registry key) | Requires / includes (line) | Fetches / links (JS, href, action) | All targets resolve? |
|---|---|---|---|
| `alert` → `alert_module.php` | `modules/utils/json_helpers.php:3` | — | **No** — the target is the `{}` stub (A1-006); also calls `load_json_dir()` at `:5` without including it (A1-007) |
| `anomaly_engine` → `anomaly_engine_module.php` | none | none | n/a — self-contained (DB via shell global) |
| `brain` → `brain_module.php` | `api/brain_orchestrator.php:23` (server require), `kernel/module_registry.php:33` | — | Yes |
| `cases` → `cases_module.php` | `modules/utils/bootstrap.php:4` | — | Yes (load_json_dir at `:6-7` covered by that include) |
| `clients` → `clients_module.php` | `kernel/kernel_boot.php:8` | `shell.php?module=client_view&id=…:65` | Yes |
| `client_view` → `client_view_module.php` | `kernel/kernel_boot.php:4`, `../graph_view.php:223` | `graph_view.php` | **No** — A1-005, target missing |
| `cluster` → `cluster_module.php` | `kernel/kernel_boot.php:2` | — | Yes |
| `cockpit` → `cockpit_module.php` | `kernel/db.php:5` | — | Yes |
| `compare` → `compare_module.php` | none | none | n/a — renders two inputs, calls no engine (v1 `SHELL-ONLY`, confirmed) |
| `cross_case_engine` → `cross_case_engine.php` | none | none | n/a — reads `data/clients` + `data/cases` by hand-built path (`:15-18`) |
| `dashboard` → `dashboard_module.php` | `modules/utils/bootstrap.php:3` | — | Yes |
| `decision` → `decision_module.php` | `modules/utils/bootstrap.php:3` | — | Yes |
| `entity_resolution` → `entity_resolution_module.php` | `kernel/db.php:4` | — | Yes |
| `excavation` → `excavation_module.php` | `modules/utils/json_helpers.php:3`, `engine/entity_extraction_engine.php:26`, `kernel/db.php:27` | — | **Partly** — `:3` hits the `{}` stub (A1-006); the engine edge is live |
| `executive` → `executive_dashboard_module.php` | `modules/utils/bootstrap.php:3` | — | Yes |
| `files` → `files_module.php` | none | `api/files_action.php:91` (`fetch`) | Yes |
| `graph` → `graph_module.php` | none | none | n/a — DB-backed, no include |
| `insight` → `insight_module.php` | none | none | n/a — but `:14` guards on `KERNEL_ROOT` |
| `ingest` → `ingest_module.php` | `kernel/ingestion_pipeline.php:110` (conditional) | — | Yes, only on upload-with-case |
| `ingest_view` → `ingest_view_module.php` | none | none | n/a — uses `$db` global from shell |
| `intelligence_dashboard` → `intelligence_dashboard_module.php` | `modules/utils/uic_v1.php:12` | — | Yes — but the "intelligence" is a mock layer (v1 `MOCK`, not re-adjudicated here) |
| `pm` → `pm_module.php` | none | none | n/a — 47 KB, DB via `$db` |
| `predictive` → `predictive_module.php` | `modules/utils/bootstrap.php:3` | — | Yes |
| `predictive_link_module_v1` → `predictive_link_module_v1.php` | `modules/utils/bootstrap.php:12` | — | Yes |
| `recommendation` → `recommendation_module.php` | `modules/utils/bootstrap.php:4` | — | Yes |
| `relations` → `relations_module.php` | `modules/utils/bootstrap.php:3` | — | Yes |
| `report` → `report_module.php` | `kernel/kernel_boot.php:10`, `lib/dompdf/autoload.inc.php:11` | — | Yes — required early by `shell.php:14` |
| `root_cause` → `root_cause_graph_module.php` | `modules/utils/bootstrap.php:3` | — | Yes |
| `search` → `search_module.php` | `modules/utils/bootstrap.php:15` | `api/search_load.php:237` (`XMLHttpRequest`) | Yes — bare relative require at `:15` (A1-011) |
| `semantic_cluster` → `semantic_cluster_module.php` | `db.php:11` | — | Yes |
| `time_intelligence` → `time_intelligence_module.php` | `modules/utils/bootstrap.php:3` | — | Yes |
| `vault` → `vault_module.php` | `db.php:10` | — | Yes — also required early by `shell.php:20` |
| `view` → `view_module.php` | `kernel/kernel_boot.php:3`, `ui/ui_engine.php:6`, `kernel/nav_engine.php:7`, `lib/semantic_diff_engine.php:8`, `kernel/kernel.php:9` | — | Yes — this one module is what makes 5 files v1 called dead actually live |
| `payment` → `payment_module.php` | `kernel/kernel_boot.php:10`, `config.php:11`, `lib/vendor/autoload.php:12` | `shell.php?module=payment&action=success…:79,143`, `action=cancel…:80`, `module=client_view&id=…:144` | Yes |

**Modules with no include and no URL (7):** `anomaly_engine`, `compare`, `cross_case_engine`, `graph`, `insight`, `ingest_view`, `pm`. They depend entirely on globals `shell.php` has already created (`$db`, `$registry`) — correct while dispatched by the shell, fatal if fetched directly, which is exactly what A1-004 permits.

**Db-visible but unregistered (2, unchanged from v1, out of A1 scope):** `modules/build_dossier.php`, `modules/governance_module.php`.

---

## 4. The 11 named targets — verdicts with the reference that decides each

Search form for every row: `bash _governance/audits-v2/deadcheck.sh <path>` (full-relative-path proof; stem-only hits reported but never counted). Selftest passed before use: `positive kernel/db.php live=21`, `negative Color_Creator.php dead-eligible=1`, `duplicate kernel/graph_engine.php live=0` → `SELFTEST PASS`.

| # | File | Reachable? | Deciding reference | Status |
|---|---|---|---|---|
| 1 | `engine/entity_extraction_engine.php` | **YES** | `modules/excavation_module.php:26` (module is `ROUTED`); also `prospect.php:7` | WORKS |
| 2 | `kernel/ingestion_pipeline.php` | **YES** (conditional) | `modules/ingest_module.php:110`, inside `if ($case_id)` in the upload branch | WORKS |
| 3 | `ui/ui_engine.php` | **YES** | `modules/view_module.php:6` | WORKS |
| 4 | `ui/layout.php` | **YES** | `ui/ui_engine.php:24 require __DIR__.'/layout.php'` | WORKS |
| 5 | `kernel/nav_engine.php` | **YES** | `modules/view_module.php:7` | WORKS |
| 6 | `lib/semantic_diff_engine.php` | **YES** | `modules/view_module.php:8` | WORKS |
| 7 | `prospect.php` | **YES** | `shell.php:251` standalone nav link (`$standaloneLinks`) | WORKS |
| 8 | `api/tree.php` | **NO** | `live: 0`, `stem: 37` — all 37 stems are `fm-tree-*` DOM ids and the word "tree" in `modules/files_module.php`; no path, no URL, no include, anywhere | DEAD |
| 9 | `api/v8/network_add_node.php` | **NO** | `live: 2` — `ingest.php:23`, `ingest2.php:23` (both unreachable), plus `api.php:90` legacy string and 1 archive copy | UNWIRED |
| 10 | `engine/hierarchy_of_truth_engine.php` | **NO** | `live: 1` — `test_hierarchy_of_truth.php:17`, itself unreachable | UNWIRED |
| 11 | `engine/plain_english_helper.php` | **NO** | `live: 0`, `stem: 0`, `DOC-ONLY: 35`; the only occurrence in code is its own docblock at `:10` | DEAD |

**Why #8 and #11 are DEAD while #9 and #10 are not:** a reference that exists but sits in an unreachable file still proves the code was written to be called — it is a wiring gap, not dead weight. Zero references of any kind is a different fact, and only that earns DEAD.

---

## 5. Auth check — answer: **NO**

`shell.php` has **no login and no authorization check of any kind.** There is no identity gate, no session assertion, no `require` of an auth file, and no guard on the module path.

Evidence, in execution order:

| Line | What happens |
|---|---|
| `shell.php:6-8` | Requires `kernel_boot`, `bootstrap`, `uic_v1`. No auth file. |
| `shell.php:14`/`:20`/`:26` | Three early intercepts run **before anything else**: report generation (`:14`), vault download (`:20`), brain run (`:26`). A POST to `?module=vault&action=download&report_path=…` reaches the file-serving code with no identity. |
| `shell.php:32` | Loads the registry — the only gate on which module runs. An unknown `?module=` returns a friendly "not registered" string rather than a denial. |
| `shell.php:58` | `require $file` — the module executes in the global scope of the request, inheriting every global the shell created. |
| `kernel/kernel_boot.php:12-13` | `session_start()` only. The session is opened and never read for identity. |

Tree-wide search for an auth primitive: `grep -rn --include='*.php' -E "password_verify|password_hash|$_SESSION['(user|uid|auth|logged)"` returns **11 hits, all inside `ProjectManager/`** (a dead 94-file tree, see A1-010). **Zero hits in the live spine.** `kernel/guard.php` exists and defines `kernel_guard()`, but its body only checks that `$pdo` is non-null (`kernel/guard.php:15-22`) — it is not an auth guard, and nothing requires it.

Consequence: every reachable screen, both JS endpoints, all three early intercepts, and (via A1-004) 29 modules fetched directly are open to anyone who can reach the host.

---

## 6. Corrections to the old scan

v1's appendix marked these files dead or referenced-dead. Each is either reachable today or mis-scored, and each correction states the proof. **v1's DEAD count of 277 cannot stand**: 9 files it called dead are in the live spine.

| File | v1 status | v2 finding | Proof |
|---|---|---|---|
| `engine/entity_extraction_engine.php` | REFERENCED-DEAD | **REACHABLE** — `ROUTED` module includes it | `modules/excavation_module.php:26` |
| `kernel/ingestion_pipeline.php` | REFERENCED-DEAD | **REACHABLE** via the ingest upload branch | `modules/ingest_module.php:110` |
| `ui/ui_engine.php` | REFERENCED-DEAD | **REACHABLE** | `modules/view_module.php:6` |
| `ui/layout.php` | REFERENCED-DEAD | **REACHABLE** | `ui/ui_engine.php:24` |
| `kernel/nav_engine.php` | REFERENCED-DEAD | **REACHABLE** | `modules/view_module.php:7` |
| `lib/semantic_diff_engine.php` | REFERENCED-DEAD | **REACHABLE** | `modules/view_module.php:8` |
| `prospect.php` | REFERENCED-DEAD | **REACHABLE** — linked from the shell's own nav | `shell.php:251` |
| `kernel/kernel.php` | REFERENCED-DEAD (caller `kernel/guard.php`) | **REACHABLE** — separately required by a live module | `modules/view_module.php:9` |
| `db.php` | LIVE-CORE, caller `ExcavationCommand/dashboard.php` | **REACHABLE but caller misattributed** — that caller is unreachable; the live edges are two routed modules | `modules/semantic_cluster_module.php:11`, `modules/vault_module.php:10` |
| `config.php` | LIVE-CORE, caller `ProjectManager/bootstrap.php` | **REACHABLE but caller misattributed** — real caller is the kernel | `kernel/db.php:3` |
| `api/tree.php` | ORPHAN-WEB "dead SQL writer" | **DEAD confirmed** (0 full-path refs; 37 stems dismissed) | §4 #8 |
| `api/file.php` | LIVE-ENDPOINT | **UNWIRED** — 0 references of any form | `deadcheck api/file.php` |
| `api.php` | DEAD | **DEAD confirmed** — the 3 "hits" are client JSON *data records* (`clients/file_intelligence/…/session.json`), not callers | `deadcheck api.php` → `php-include 0, js-browser 0, server-config 0` |
| `api/v8/network_add_node.php` | REFERENCED-DEAD (caller `api.php`) | **UNWIRED** — callers are `ingest.php`/`ingest2.php`, both unreachable | `ingest.php:23` |
| `engine/plain_english_helper.php` | DEAD-BUT-WANTED | **DEAD confirmed** — the only match is its own usage example | `engine/plain_english_helper.php:10` |
| `api/v8/*` (35 files) | mixed DEAD / REFERENCED-DEAD | **0 reachable**, 2 referenced only by unreachable callers, 33 with no reference at all | `A1-report.txt` §API/V8 |

Also corrected: v1 said "**28 of 33** `api/` endpoints are unreachable" — correct in total, but it named the 3 live ones as `search_load`, `files_action`, `brain_orchestrator`. The real set is **5 reachable** (`brain_orchestrator`, `brain_synthesis`, `model_router`, `files_action`, `search_load`): `brain_orchestrator.php` is a server-side `require` that pulls in the other two, so they are live too. The remaining **28 have zero references of any form** — not "orphan web pages", but uncalled files.

---

## 7. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A1-001 | `shell.php:6-58`; `kernel/kernel_boot.php:12-13` | No authentication or authorization anywhere in the live spine; the early intercepts (`:14`/`:20`/`:26`) run before any identity check; sessions are started and never used for identity | P0 | V1 |
| A1-002 | `.htaccess:1-8` | mod_security is switched **off** (`SecFilterEngine Off`, `SecRuleEngine Off`) — the request filter that would catch injection attempts is disabled at the root | P0 | V1 |
| A1-003 | `.htaccess:11` | `<FilesMatch "^(config\.php|\.env|\.gitignore)$">` denies only those three names; `config.local.php` (the file that actually holds the credentials, per `config.php:8`) and `.sftp.json`/`sftp.json` are **not** denied | P0 | V1 |
| A1-004 | `modules/*.php:1` (29 files); `modules/vault_module.php:19` | 29 of 35 registry modules have no `KERNEL_ROOT`/direct-access guard and `modules/` is web-addressable. `report_module.php` loads its own kernel (`:10`) and generates reports for an anonymous caller; `vault_module.php` reaches its download branch with `$db` null and serves any PDF under `data/clients`. Its containment check is a **prefix** test on `realpath()` (`:19`), so a sibling directory whose name starts with `clients` passes. Guarded ones: `ingest`, `search`, `files`, `pm`, `dig_review`, `insight` | P0 | V1 |
| A1-005 | `modules/client_view_module.php:223` | `require __DIR__.'/../graph_view.php'` resolves to `commandcenter/graph_view.php`, which does not exist (the file is `views/graph_view.php`) → fatal "failed to open stream" on the client record branch | P1 | Client record screen |
| A1-006 | `modules/utils/json_helpers.php:1` | File is 2 bytes of `{}`, not PHP, yet `alert_module.php:3` and `excavation_module.php:3` `require_once` it — literal `{}` is emitted into the page before any markup | P1 | Alert + Excavation screens |
| A1-007 | `modules/cases_module.php:6-7`, `predictive:11`, `decision:11`, `relations:11-12`, `dashboard:5-6`, `root_cause:5`, `executive:11-12`, `alert:5`, `recommendation:6`, `time_intelligence:5` | `load_json_dir()` is called but `modules/utils/bootstrap.php` is never included by those modules; it only works because `shell.php:7` loaded it into the same request | P1 | Any direct fetch of those modules (see A1-004) |
| A1-008 | `api/tree.php:124` | `WITH RECURSIVE descendants AS (…)` — recursive CTEs need MySQL 8.0+; the dump is from `5.7.44-percona`, so the `move` action raises a syntax error | P1 | File-tree move |
| A1-009 | `api.php:35` | The only `api/v8` dispatcher has zero execution references, so all 35 v8 handlers are unreachable through the one path that can reach them | P1 | v8 API |
| A1-010 | `kernel/kernel.php:19` | Legacy stub (`return true`) still required by a live module — an include that does nothing and hides the real dependency graph | P2 | — |
| A1-011 | `modules/search_module.php:15` | Bare relative `require_once 'utils/bootstrap.php'` resolves only by PHP's calling-script-directory rule; it breaks the moment the file is moved or required from another directory | P2 | — |
| A1-012 | `kernel/db.php:16` | `die("DB ERROR: ".$e->getMessage())` sends driver-level detail (host, user, SQLSTATE) to an anonymous visitor | P2 | — |
| A1-013 | `ui/ui_bootstrap.php:3-6` | `legaisee_ui_bootstrap()` is never called (`kernel_assets()` in `kernel_boot.php:41` is unused) while `shell.php`'s `<head>` hardcodes the identical stylesheet link — two sources for one asset | P2 | — |

---

## 8. Limits

- **Static analysis only.** Nothing was executed; no page was loaded, no query run. "Reachable" means an execution path exists in the source, not that the page renders correctly. Correctness of what each file outputs is deferred to later blocks.
- Conditional includes are counted as reachable when their guard is satisfiable. `kernel/ingestion_pipeline.php` needs an upload *with* a `case_id`; if production never uploads with a case, that path is untaken in practice.
- **`api/files_action.php` and `api/search_load.php` are assumed live** because reachable JS names them. `a1_reach.py` reads their URL literal (`modules/files_module.php:91`, `modules/search_module.php:237`); it cannot prove the browser request succeeds (CORS, path, session) — that needs a live check.
- The browser-surface scan reads quoted `.php` strings, so it can catch a docblock example as a "reference". That happened once (`engine/plain_english_helper.php:10`) and is dismissed by inspection; the six targets in §4 were each opened by hand.
- **Duplicate basenames** remain the trap v1 fell into. All §4 verdicts use full-relative-path proof; the `basename-only` count is printed by the harness and never used as evidence.
- `cli/worker.php`'s v1 `BROKEN` claim (a missing `engine/cluster_engine.php` require) was **not** re-verified here — the file is unreachable, so A1 records it as UNWIRED and leaves the BROKEN question to the block that deals with the worker.
- 346 PHP files were walked; v1's ledger has 347 rows. The difference is archive/backup files and the two 0-byte modules excluded from the graph — not a discrepancy in live code.
- No source file was modified in this block. Only `_governance/audits-v2/` was written.

---

### Legend
**Status** — `WORKS` reachable + correct by inspection · `WORKS-WITH-DEFECT` reachable, defect recorded · `BROKEN` fails when reached · `UNWIRED` complete but nothing loads it · `DEAD` proven unreferenced (`00-GROUND-RULES.md` §5).
**Severity** — `P0` blocks V1 / security hole · `P1` wrong results, broken screen, or data loss · `P2` cosmetic or hygiene.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions.
