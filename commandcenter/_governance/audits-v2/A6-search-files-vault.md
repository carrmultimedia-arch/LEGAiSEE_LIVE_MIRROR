# A6 — Search, Files, Vault (S3, S4)

**Date:** 2026-10-29
**Scope:** `modules/search_module.php`, `api/search_load.php`, `modules/files_module.php`, `api/files_action.php`, `modules/vault_module.php`, `normalized/`.
**Method:** each file read in full; every path parameter traced from the JS that sends it to the PHP that resolves it; every SQL statement checked column by column against `schema-source.sql`; the file manager's root resolved to its actual directory; the Vault link compared character-for-character against its handler; `.htaccess` read for what it actually protects.
**Inputs:** `schema-source.sql`, `A1-reachability.md`, `A2-spine-security.md`, `A3-data-layer.md`, `A4-ingest-excavation-review.md`.

---

## The answers in one line each

1. **Path safety:** `search_load.php` is **safe** — `realpath()` containment, verified. `files_action.php` is **safe against `../` but catastrophically unsafe by design** — its root is `commandcenter/` itself, so "containment" means "may read and write the entire application".
2. **Folder the file manager reaches:** the **whole app** — `api/`, `kernel/`, `config.local.php`, `sftp.json`, the DB dump, `data/`, `.git`. Confirmed: `FM_ROOT = realpath(KERNEL_ROOT)` and `KERNEL_ROOT = kernel/../`.
3. **Vault parameter mismatch:** **confirmed.** Link emits `report_id` (`:85`), handler requires `report_path` (`:14`). Every download 404s.
4. **Can search find MySQL-stored transcripts?** **Yes** — `search_module.php:130-131` and `search_load.php:131` both query `raw_transcript` with correct column aliases. It is the only working full-text path in the app. But **three of the five MySQL sources beside it are silently dead** on wrong column names.

---

## 1. Path safety, parameter by parameter

| Parameter | File:line | Guard | Verdict |
|---|---|---|---|
| `ref` (json branch) | `api/search_load.php:19`, `:53-58` | `realpath($dir . $key)` then `strpos($path, $real_dir) !== 0` → reject | **SAFE.** `../../config.local.php` resolves outside `data/cases/` and is refused. Only `data/{cases,clients,prospects,network}` are reachable anywhere from here |
| `ref` (mysql branch) | `api/search_load.php:85` | `intval($key)` | **SAFE.** No injection; non-numeric → `(invalid record ID)` |
| `path` | `api/files_action.php:39-53` (`fm_resolve`) | `realpath()`, then `strpos($real, FM_ROOT) !== 0` → reject; unresolved paths re-check the *parent* | **SAFE against traversal.** Prefix compare lacks a trailing separator (A6-014), but that is a side issue next to A6-001 |
| `name` / `new_name` | `api/files_action.php:167`, `:188`, `:239` | `preg_replace('/[^a-zA-Z0-9_\-.]/','',…)` | **SAFE.** No separator survives, so no escape and no subdirectory creation |
| `src` / `dest` | `api/files_action.php:258-278` | both through `fm_resolve`; `dest` must already be a directory | **SAFE against traversal** |
| upload filename | `api/files_action.php:290` | `preg_replace('/[^a-zA-Z0-9._-]/','_',$orig)` — **extension preserved** | **UNSAFE by content** — a `.php` upload is stored as `.php` (A6-002) |
| `report_path` | `modules/vault_module.php:14-19` | `realpath()` then `strpos(…, $base_dir) === 0` | **SOUND, and unreachable** — the UI never sends this parameter (A6-010) |

`fm_resolve`'s non-existent-path branch returns the **unresolved** candidate for create operations (`:47-51`). That is acceptable only because every caller then appends a slash-free sanitised name — the one exception is `save_file`, which requires `is_file()`, so it cannot create.

---

## 2. How far the file manager reaches

```php
kernel/kernel_paths.php:9   define('KERNEL_ROOT', __DIR__ . '/../');   // = commandcenter/
api/files_action.php:30     define('FM_ROOT', realpath(KERNEL_ROOT));  // = the whole app
api/files_action.php:29     // "KERNEL_ROOT = commandcenter/ — operators can see everything in the system"
```

The comment is accurate, and it is the defect. `get_file` (`:144-163`) has a text-extension allow-list (`:86`) that includes `php`, `json`, `sql`, `env`, `ini`, `conf` — precisely the sensitive ones. `fm_is_text` returns `true` for them, so `file_get_contents($path)` returns the body.

Reachable **read** targets, all under `FM_ROOT`, none of them protected by `.htaccess`:

| Target | Why it matters |
|---|---|
| `config.local.php` (339 B) | DB credentials + `CLAUDE_API_KEY` (A2 confirmed the key is defined at `:12`) |
| `sftp.json` (627 B) | deployment host, user, remote path — almost certainly a password |
| `` `db-before-migration-2026-10-29.sql`.sql `` | full client-data dump |
| `data/clients/*` (14 dirs), `data/cases/*` (29), `prospects/` | client PII, test and real |
| `normalized/*` (36 files, 9.0 MB) | raw client transcripts |
| `.git/` | full history |

Reachable **write** targets: everything. `create_file` (`:186`) writes an empty file anywhere, then `save_file` (`:302-311`) writes arbitrary bytes into it — including PHP into `api/`. Or skip both: `upload` (`:280-299`) accepts any extension into any directory. Either path lands executable code inside the webroot.

`.htaccess` (whole file, 16 lines) denies only `config.php`, `.env`, `.gitignore` via `FilesMatch`. **`config.local.php` does not match that pattern** (the regex is anchored `^(config\.php|\.env|\.gitignore)$`), so it is fetchable directly over HTTP as well as through the file manager. There is no `api/.htaccess`, no rule for `data/`, none for `normalized/`.

---

## 3. Files table

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `modules/search_module.php` | System search across 4 JSON dirs + 5 MySQL tables, into a dual-pane viewer | WORKS-WITH-DEFECT | A6-005 `:79` `files` selects `filename`,`filetype` — real columns `title`,`content`,`file_type`; A6-006 `:94` `entities` selects `name`,`type` — real `canonical_name`,`entity_type`; A6-007 `:111-113` relationships joins `r.entity_a_id`/`r.entity_b_id`/`e1.name` — real `from_entity_id`/`to_entity_id`/`canonical_name`; A6-008 empty catches `:75`,`:90`,`:105`,`:125`,`:142`; A6-015 `:36-40` reads every JSON file in 4 dirs per query | Correct the three column sets; log instead of swallow | P1 |
| `api/search_load.php` | Standalone JSON loader: returns pane text for one `ref` | WORKS-WITH-DEFECT | A6-004 `:19-26` unauthenticated, any integer id returns any transcript or client document; A6-009 `:103` `files` branch selects four columns that do not exist (`filename`,`filepath`,`filetype`,`filesize`) → `DB error:` leaked at `:146`; A6-007 `:121-122` same bad relationship join | Whitelist + fix columns + generic error text | P1 |
| `modules/files_module.php` | File-manager UI: tree, list, viewer, create/delete/move/upload | WORKS | None in the module itself — it is a faithful client for its API. Everything it renders is whatever `files_action.php` returns | Keep; it is only as dangerous as its API | — |
| `api/files_action.php` | 9 filesystem actions for the file manager | WORKS-WITH-DEFECT | A6-001 `:30` root is the whole app + `:144` reads `config.local.php`/`sftp.json`/`*.sql` with no auth; A6-002 `:186`,`:302`,`:280` arbitrary PHP write/upload into webroot; A6-003 `:214` protects only `FM_ROOT`,`kernel/` from delete; A6-014 `:44`,`:47` prefix compare without trailing separator | Re-root at a data dir, add an allow-list, add auth | **P0** |
| `modules/vault_module.php` | Lists report PDFs per client, offers download + payment | WORKS-WITH-DEFECT | A6-010 `:85` link sends `report_id`, `:14` requires `report_path` → every download 404s; A6-011 `:121-131` omits `node_id`, which `payment_module.php:37` requires → "Missing required fields"; A6-013 `:11` `$GLOBALS['pdo']` never used; A6-016 `:16-19` `$base_dir` could be `false` | Emit `report_path`; send `node_id`; drop the dead variable | P1 |
| `normalized/` (dir) | 36 files / 9.0 MB of extracted text from client documents | WORKS | A6-012 inside the webroot with no `.htaccess` rule; names are md5 except `20260422_015914_server_sys_build_4-21-26.md` and `_state_s_*.json` | Deny from web, or move above the root | P1 |

---

## 4. Vault — the parameter mismatch, exactly

```php
modules/vault_module.php:14   if (isset($_GET['action']) && $_GET['action'] === 'download'
                                  && isset($_GET['report_path'])) {
modules/vault_module.php:85   <a href="?module=vault&action=download&report_id=<?= urlencode($report['filename']) ?>"
```

`report_path` is never sent; `report_id` is. So `:14` is false on every click, the handler never runs, and the anchor performs a GET to `?module=vault&action=download&report_id=report_1786350404.pdf`, which re-renders the Vault page. The operator clicks "Download" and the page reloads.

This is not a template that never fires — **6 report PDFs exist** under `data/clients/test2/cases/case_1785280056/reports/`, so the `glob` at `:49` finds them, the client block renders, and the link is live and broken. Even if the parameter name were corrected, `report_id` carries `basename()` while `:19` needs an absolute filesystem path inside `data/clients/` — the handler contract and the link contract disagree on the *type* of argument, not just the name.

The payment button has a parallel break: `:121-131` posts `client_id`, `case_id`, `report_id`, `tier`, `client_email` — `payment_module.php:31-38` additionally requires `node_id` and rejects the request outright.

---

## 5. Can search find content in MySQL-stored transcripts?

**Yes, and it is the one place in the application that works.**

- `search_module.php:130-131` — `WHERE session_title LIKE :q OR project_tag LIKE :q OR raw_transcript LIKE :q`, aliased `session_title AS session_label`, `source_ai AS platform`. All four columns exist.
- `api/search_load.php:131` — same aliases, returns `$meta . $row['raw_text']`, i.e. **the full transcript** in the pane, with the session header and word count above it.

So a 19-row `memory_ingest` is fully searchable by body text and readable in Pane A. Contrast with `ingest_module.php:164`, which reads `session_label`/`platform` unaliased and shows *"No sessions stored yet"* (A4-004) — the search module got the aliasing right and the ingest module did not.

What search **cannot** find: `entities` (2,433 rows), `relationships` (2,721 rows), or anything in `files`, because the three statements use column names that do not exist:

| Source | Statement uses | Schema actually has |
|---|---|---|
| `files` (`:79`) | `filename`, `filetype` | `title`, `content`, `file_type`, `folder_id` |
| `entities` (`:94`) | `name`, `type` | `canonical_name`, `entity_type` |
| `relationships` (`:111-113`) | `r.type`, `r.entity_a_id`, `r.entity_b_id`, `e1.name` | `relation_type`, `from_entity_id`, `to_entity_id`, `canonical_name` |

Each throws, each is caught by an empty block (`:90`, `:105`, `:125`), and the page reports **"No results for …"** — identical to a genuine zero-hit search. The operator concludes the system holds nothing about a client while 2,721 relationships sit in MySQL.

`documents` (`:63`) is correct and works; `memory_ingest` is correct and works. **Two of five.**

---

## 6. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A6-001 | `api/files_action.php:30,144-163` | `FM_ROOT` is the whole application; `get_file` returns `config.local.php` (DB password, `CLAUDE_API_KEY`), `sftp.json`, and the DB dump to any unauthenticated caller | **P0** | V1, all client confidentiality |
| A6-002 | `api/files_action.php:186,280,302` | `create_file` + `save_file`, and `upload` with extension preserved, write executable PHP anywhere in the webroot → remote code execution | **P0** | V1 |
| A6-003 | `api/files_action.php:214` | Delete guard covers only `FM_ROOT` and `kernel/`; `config.php`, `db.php`, `data/`, `.git` are all removable | P1 | Data integrity |
| A6-004 | `api/search_load.php:19-26` | Unauthenticated, id-enumerable read of any client document and any full transcript (`0`–`n` over `mysql:memory_ingest:<id>`) | P1 (inherits the app-wide P0 in A2) | Confidentiality |
| A6-005 | `modules/search_module.php:79` | `files` search uses `filename`/`filetype`; real columns are `title`/`file_type` → always throws | P1 | File search |
| A6-006 | `modules/search_module.php:94` | `entities` search uses `name`/`type`; real columns `canonical_name`/`entity_type` → always throws | P1 | Entity search |
| A6-007 | `modules/search_module.php:111-113`; `api/search_load.php:121-122` | Relationship search joins on `entity_a_id`/`entity_b_id` and reads `r.type`/`e1.name`; all four are wrong | P1 | Relationship search, graph drill-down |
| A6-008 | `modules/search_module.php:75,90,105,125,142` | Five empty `catch (Exception $e) {}` turn every SQL failure into "No results" | P1 | Diagnosis of A6-005/006/007 |
| A6-009 | `api/search_load.php:103,146` | `files` branch selects four non-existent columns; the catch returns `DB error: <SQLSTATE + message>` to the browser | P1 | Info leak + dead branch |
| A6-010 | `modules/vault_module.php:14,85` | Link sends `report_id`, handler requires `report_path`; download is permanently 404 (or a silent page reload) over 6 real PDFs | P1 | Report delivery |
| A6-011 | `modules/vault_module.php:121-131` | Payment POST omits `node_id`; `payment_module.php:37` requires it → always "Missing required fields" | P1 | Revenue path |
| A6-012 | `normalized/` (36 files, 9.0 MB) | Inside the webroot, no `.htaccess` rule; md5 names except two predictable ones | P1 | Confidentiality |
| A6-013 | `modules/vault_module.php:11` | `$db = $GLOBALS['pdo']` — never read; and undefined when the module is `require`d inside `renderModule()` (`shell.php:50`) | P2 | — |
| A6-014 | `api/files_action.php:44,47` | `strpos($real, FM_ROOT) !== 0` has no trailing separator, so a sibling `commandcenter_x/` passes containment | P2 | — |
| A6-015 | `modules/search_module.php:36-40` | Every query re-reads every entry in all four JSON dirs (19 cases, 14 clients, 27 prospects, 9 network = 69) with `file_get_contents` + `stripos`; no index, no FTS | P2 | Search speed |
| A6-016 | `modules/vault_module.php:16-19` | `$base_dir` is `false` if `data/clients` is missing, and `strpos($x, false)` is a type error | P2 | — |

---

## 7. Limits

- **Nothing was executed.** A6-001/A6-002 are proven by reading `FM_ROOT`'s derivation and the dispatch table, not by fetching `config.local.php` over HTTP. No secret was read, printed, or compared — only the file's size (339 B) and the fact that A2 located `CLAUDE_API_KEY` at `:12` inside it.
- Whether the web server actually serves `normalized/` and `data/` depends on the vhost; both are inside the document root by path, and `.htaccess` contains no rule for either. That is the basis for A6-012, not a live fetch.
- `sftp.json`'s contents were not read; its size and filename are the only facts used.
- A6-004's enumeration claim assumes sequential integer ids, which the schema's `AUTO_INCREMENT` implies; ids were not read from the live database.
- The Vault `glob` at `:49` was verified by finding the PDFs on disk (6), not by rendering the module.
- `search_module.php`'s JSON scan was measured by directory-entry count (69 across four directories), not timed.
- No source file was modified in this block.

---

### Legend
**Status** — `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD` (`00-GROUND-RULES.md` §5).
**Severity** — `P0` blocks V1 / security hole · `P1` wrong results · `P2` cosmetic/cleanup.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions proposed.
