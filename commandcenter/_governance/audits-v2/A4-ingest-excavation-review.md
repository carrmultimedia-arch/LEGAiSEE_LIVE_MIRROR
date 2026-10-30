# A4 — Ingest, Excavation, Dig Review (S5, S6)

**Date:** 2026-10-29
**Scope:** 13 files — `modules/ingest_module.php`, `ingest_view_module.php`, `insight_module.php`, `excavation_module.php`, `entity_resolution_module.php`, `dig_review_module.php`, `engine/entity_extraction_engine.php`, `kernel/ingestion_pipeline.php`, `prospect.php`, `ingest.php`, `ingest2.php`, `session.php`, `create_session.php`.
**Method:** every file read end to end; the two intake paths traced call by call; empty-catch census by pattern (`catch (Exception $e) {}`) and by reading each site; column claims checked against `schema-source.sql`; "who calls the extractor" proven by grep over the whole tree.
**Inputs:** `schema-source.sql` (51 tables, 10,486 rows), `A1-reachability.md` (reachability), `A3-data-layer.md` (column truth), `AUDIT-APPENDIX-FILE-STATUS.md` (v1 ledger, re-adjudicated).

---

## The answer in one line

There are **two working intake paths and they end in different places**. Paste writes one MySQL row and stops. Upload copies a file, writes a `documents` row, and throws the file's text away. Extraction runs only when someone happens to open the Excavation screen or loads `prospect.php` — and the review queue that should turn extracted edges into confirmed findings is **structurally unable to accept a single row**, because its INSERT selects a column (`entities.context`) that has never existed.

---

## 1. Trace 1 — pasted transcript, end to end

1. Operator opens `shell.php?module=ingest`. `shell.php:32` loads the registry, `:58` requires `modules/ingest_module.php`; the module's `KERNEL_ROOT` guard (`:11`) passes because `kernel_paths.php:9` defined it.
2. The Paste tab posts `ingest_action=paste_transcript` with `raw_text`, `session_label`, `platform`, `project_tag`, `domain_id`, `project_id` (`:20-29`).
3. Only validation is `strlen($raw_text) < 20` (`:31`).
4. `INSERT INTO memory_ingest (session_title, project_tag, source_ai, domain_id, project_id, raw_transcript, word_count, context, created_at, processed)` (`:36-45`). All ten columns exist (A3 verified); `context` is hard-coded `'memory'` and `processed` is `0`.
5. Flash: *"Stored N words as session #id."* The write succeeds.
6. **B1 — the path stops here.** `lee_extract_and_store()` is never called. A tree-wide grep finds exactly three call sites, none in this file: `modules/excavation_module.php:54`, `:96`, `prospect.php:145`. So nothing extracts entities from a pasted transcript, ever.
7. `processed` is set to `1` by exactly one place in the tree — `modules/pm_module.php:184`, when a PM task is linked to a session. Nothing in ingest, excavation or review ever changes it.
8. **B2 — the module cannot even list what it just wrote.** The Sessions tab queries `SELECT id, session_label, project_tag, platform, word_count, created_at FROM memory_ingest` (`:164-165`). `memory_ingest` has **`session_title`** and **`source_ai`**, not `session_label`/`platform`. The query throws, `catch (Exception $e) {}` at `:166` swallows it, `$sessions` stays `[]`, and the tab renders *"No sessions stored yet."* while 19 rows sit in the table.
9. The row *is* visible elsewhere: `insight_module.php:131-135` selects the same data **with aliases** (`session_title AS session_label, source_ai AS platform`) and renders it correctly, as does `ingest_view_module.php:14-16`. So the record exists and two other screens can see it — the tab that created it cannot.
10. **Reviewable where: nowhere.** `dig_review_module.php` builds its list from `review_flags` (empty) merged with JSON case findings under `data/clients/*/cases/*/meta.json` (`:120-190`). Neither source includes `memory_ingest`.

**Where path 1 breaks:** after step 5. No extraction (B1), no listing (B2), no review (step 10).

---

## 2. Trace 2 — uploaded file, end to end

1. Upload tab posts `ingest_action=upload_file` with `$_FILES['upload_file']` and an optional `case_id` (`:64-67`).
2. Validation is only `!empty(tmp_name) && error === UPLOAD_ERR_OK` (`:64`). **No extension allow-list, no MIME sniff, no size cap.**
3. `$orig_name = basename($_FILES[…]['name'])` (`:65`), then `$safe_name = preg_replace('/[^a-zA-Z0-9._-]/', '_', $orig_name)` (`:66`) — strips path separators and spaces, but leaves the extension untouched.
4. Destination: if `$case_id` and `is_dir(data/cases/$case_id)` → `data/cases/<case_id>/files/`; else `DATA_ROOT.'files/'` (`:70-74`). `mkdir(…, 0755, true)` if needed.
5. `$target = $target_dir . time() . '_' . $safe_name` (`:77`) — second-resolution timestamp, so two uploads of the same name in one second collide.
6. `move_uploaded_file` (`:79`), then a copy into `normalized/` named by `md5_file()` (`:81-84`).
7. Text is read **only** for `txt, md, csv, json, html, htm` and only ≤200,000 bytes (`:87-90`). A PDF or DOCX — the formats the UI advertises first — yields `$textBody = ''`.
8. `INSERT INTO documents (title, content, source_type, metadata, created_at)` with `source_type='upload'` and a JSON metadata blob (`:92-96`). Columns are valid.
9. If `$case_id` is set: `$content = file_get_contents($target);` (`:108`) then `ingestToNode($case_id, "File uploaded: {$safe_name}", $network_file);` (`:109`).
10. **B3 — the file's content is read and discarded.** `$content` on `:108` is never used again. The pipeline receives only the literal string `"File uploaded: <name>"`.
11. **B4 — the upload's extraction writes JSON, not MySQL.** `ingestToNode()` (`kernel/ingestion_pipeline.php:54`) appends a node to `data/cases/<id>/network.json` (`:67-77`). It never touches `entities` or `relationships`. So even that filename-only node does not become graph data.
12. **B5 — failures are silent.** The whole block sits in `try { … } catch (Exception $e) {}` (`:111`), so a failed `documents` INSERT still reports *"uploaded successfully"*.
13. The file is never passed to `lee_extract_and_store()`, so an upload produces **zero entities and zero relationships** regardless of content.
14. Note also: nothing writes the `files` table on upload — only `documents`. The Search screen's `files` query has no upload-side producer.

**Where path 2 breaks:** steps 10, 11 and 13 — content dropped, extraction bypassed, output sent to a JSON file that no graph query reads.

---

## 3. Why the review queue is empty — the decisive defect

`dig_review_module.php` has a "↓ Queue New Findings" button that POSTs `review_action=queue_unreviewed`. The handler (`:71-116`):

```sql
INSERT INTO review_flags (source_table, source_id, context, status)
VALUES ('entities', :sid, (SELECT context FROM entities WHERE id = :sid2), 'pending')   -- :83-84
```

`entities` is `id, entity_type, canonical_name, normalized_hash, confidence, created_at` — **there is no `context` column** (schema verified; A3 §3). The statement throws before a single row is inserted, the `catch` at `:118` returns `{"ok":false,"error":…}`, and because the entity loop runs *first*, the relationship loop (`:93-105`) is never reached. **The queue can never be populated.** That is why `review_flags` has 0 rows while 2,433 entities and 2,721 relationships sit in the database.

And even if the queue worked, confirming a flag would still not produce a finding: `update_status` (`:53-63`) only sets `review_flags.status`. A tree-wide grep for `INSERT INTO findings` finds exactly one hit — `test_hierarchy_of_truth.php:63`, a dead test. **Nothing in the live tree ever writes `findings`**, which is why `findings` is empty and Client View reports "No findings have been approved".

---

## 4. File table

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `modules/ingest_module.php` | Intake screen: paste a transcript into `memory_ingest`, or upload a file into `data/` | WORKS-WITH-DEFECT | A4-001 `:67,70-71,107` unsanitised `case_id` in paths; A4-002 `:64-66` no type/size validation; A4-003 `:108-109` content read then dropped; A4-004 `:111` empty catch still reports success; A4-005 `:164-165` selects `session_label`/`platform`; A4-006 `:36-45` stores and never extracts | Sanitise `case_id`, validate uploads, pass `$content`, fix the column names, call the extractor | P0 |
| `modules/ingest_view_module.php` | Read-only list of the 20 latest ingests (aliased correctly) | WORKS | — | Keep | — |
| `modules/insight_module.php` | Near-duplicate of the ingest screen with a stats panel and the processed/pending badge | WORKS-WITH-DEFECT | A4-016 `:1-13` header names `ingest_module.php`; a second writer for `memory_ingest` that omits the case link (`:63-80`) | Merge into one ingest surface, or make this read-only | P2 |
| `modules/excavation_module.php` | Scans client case files, extracts entities, clusters signals, builds narratives, writes `auto_case_*.json` | BROKEN | A4-007 `:3` requires the 2-byte `{}` stub so `shell` returns `{}` and the report array is discarded; A4-008 `:39-97` extraction runs as a side effect of every GET; A4-009 `:263-276` one file per artifact into the same path (last write wins); `@mkdir 0777` at `:270` | Drop the stub require, move extraction behind an explicit action, write one file per case | P1 |
| `modules/entity_resolution_module.php` | Candidate finder + merge evaluator for entities | WORKS-WITH-DEFECT | A4-013 `:66-90` `break 2` after the first candidate and **no UPDATE anywhere** — scans, reports `merges_executed ≤ 1`, merges nothing | Implement the merge, or rename the action to "suggest" | P1 |
| `modules/dig_review_module.php` | Human review queue: confirm / reject / needs-info per extracted item | BROKEN | A4-011 `:53-63` confirming only updates `review_flags`; nothing writes `findings`; A4-012 `:83-84` queue INSERT selects `entities.context`, which does not exist → the whole action throws | Fix the INSERT, and write a `findings` row on confirm | P0 |
| `engine/entity_extraction_engine.php` | Regex/heuristic extractor: entities, aliases, sentence-level relationships → MySQL | WORKS-WITH-DEFECT | A4-010 `:42` blacklists `Brad, Moore, Builders, Perry, Drees, Journey, Hill, Country` as noise, so the primary client can never be an entity; `:262-263` 64-char truncation (A3-006); `$nameToId` built at `:317` and never used | Remove the client names from the noise list; use `$nameToId` or delete it | P1 |
| `kernel/ingestion_pipeline.php` | `ingestToNode()` — appends a node to a case's `network.json` | WORKS | By design writes JSON, not MySQL (`:67-77`); no dedupe, no id | Keep as the JSON path, or retarget to `entities`/`relationships` | P1 (deferred) |
| `prospect.php` | Standalone Prospect Dig: signals, authority score, entity extraction, dossier JSON + `prospect_ingests` | WORKS | A4-017 `:226-228` dossier JSON with `mkdir 0777` beside the MySQL ingest row; `:4` `display_errors=1` (A2-007); `:145` extraction inherits the noise-list problem | Finish: single store, and fix the noise list | P2 |
| `ingest.php` | Legacy JSON intake: posts a node to `api/v8/network_add_node.php` | UNWIRED | A4-014 `:3` hard-coded `$network_id`; `:25-29` sends only `network_id/type/strength` — `title`/`content` never leave the request; `:23` `http://` + `$_SERVER['HTTP_HOST']` | Archive, or finish it against a real network id | P2 |
| `ingest2.php` | Byte-identical copy of `ingest.php` (same md5) | UNWIRED | Same as above; a duplicate with no unique behaviour | Archive | P2 |
| `session.php` | Renders a dig session's `raw/*.md` files grouped by dig number | UNWIRED | A4-015 `:11` base path `DOCUMENT_ROOT/legaisee/clients/`, not the app's `data/clients/`; zero live callers | Archive with its creator | P2 |
| `create_session.php` | Creates `clients/<client>/excavations/<ts>/{raw,processed,output}` and `session.json` | UNWIRED | A4-015 `:34` same wrong base path; `mkdir` errors unchecked; no auth; **zero references in the tree** | Archive, or repoint at `data/clients/` and wire it | P2 |

---

## 5. Checks the block asked for

### 5.1 Swallowed errors (empty catch blocks)

20 sites across the set. The ones that change behaviour:

| File:line | What is swallowed | Consequence |
|---|---|---|
| `ingest_module.php:111` | The entire post-upload block (documents INSERT + pipeline) | Upload reports success after a failed write |
| `ingest_module.php:164-166` | The Sessions query | "No sessions stored yet" with 19 rows present |
| `ingest_module.php:137-140` | Four stats queries | Stats silently show 0 |
| `ingest_module.php:145-146` | Project/domain dropdown queries | Empty dropdowns, no explanation |
| `insight_module.php:116-119, 124-125, 136` | Same five queries, same silence | Same symptoms |
| `insight_module.php:89` | `documents` INSERT on upload | Upload reports success after a failed write |
| `dig_review_module.php:118` | `queue_unreviewed` | Queue silently stays empty; UI only shows a generic error |
| `dig_review_module.php:225` | Flags query | Review list renders empty |
| `dig_review_module.php:266` | Per-flag hydration | Cards show `—` with no explanation |
| `entity_resolution_module.php:9-11` | DB connect (returns an error array — correctly handled) | n/a — this one is right |

### 5.2 File content read but not passed on

| File:line | Read | Passed on? |
|---|---|---|
| `ingest_module.php:108` | `$content = file_get_contents($target)` | **No** — variable is dead; `:109` sends only the filename string |
| `ingest_module.php:88-90` | `$textBody` | Into `documents.content` only — never to the extractor |
| `ingest.php:6` / `ingest2.php:6` | `$content` from POST | **No** — `:25-29` posts only `network_id/type/strength` |
| `ingest.php:5` | `$title` from POST | **No** — never referenced after assignment |
| `excavation_module.php:42` | `$rawText` | Yes → `lee_extract_and_store()` at `:54` |
| `prospect.php:145` | `$rawInput` | Yes → `lee_extract_and_store()` |
| `ingestion_pipeline.php:54` | `$text` | Yes → written into the node's `content` |

### 5.3 Case-id path safety

`$case_id = trim($_POST['case_id'] ?? '')` (`:67`) is used **unsanitised** in three filesystem paths:

| Line | Path | Gate |
|---|---|---|
| `:70` | `is_dir(__DIR__.'/../data/cases/'.$case_id)` | the gate itself accepts `..` segments |
| `:71` | `$target_dir = …'/data/cases/'.$case_id.'/files/'` | `mkdir -p` + `move_uploaded_file` |
| `:107` | `…'/data/cases/'.$case_id.'/network.json'` | **none at all** |

`is_dir("…/data/cases/../../../")` resolves to the parent of `commandcenter/` and is true, so `case_id=../../..` passes the gate, and `:107` does not even require that. With `ingestToNode()` doing `file_put_contents($network_file, …)` (`ingestion_pipeline.php:77`), this is a **write-anywhere primitive** restricted only by a fixed `/network.json` suffix — with no authentication in front of it (A1-001/A2).

### 5.4 Upload validation

| Control | Present? |
|---|---|
| PHP upload error check (`UPLOAD_ERR_OK`) | yes (`:64`) |
| Filename sanitisation | yes — `[^a-zA-Z0-9._-]` → `_` (`:66`) |
| Extension allow-list | **no** |
| MIME / magic-byte check | **no** |
| Maximum size | **no** |
| `is_uploaded_file()` | implied by `move_uploaded_file()` |
| Destination outside webroot | **no** — `data/files/`, `data/cases/<id>/files/` sit under the webroot |
| Overwrite protection | partial — `time()` prefix collides within the same second (`:77`) |

A `.php` upload lands in a web-served directory with no auth in front of the app. That is the single highest-risk finding in this block after A4-001.

### 5.5 Insight vs ingest column mismatch

| File:line | Statement | Verdict |
|---|---|---|
| `ingest_module.php:36-45` | INSERT `session_title, project_tag, source_ai, domain_id, project_id, raw_transcript, word_count, context, created_at, processed` | ✅ all exist |
| `ingest_module.php:164-165` | SELECT `session_label, project_tag, platform, word_count, created_at` | ❌ `session_label`/`platform` do not exist |
| `insight_module.php:37-46` | Same INSERT as above | ✅ |
| `insight_module.php:131-135` | `SELECT … session_title AS session_label, source_ai AS platform …` | ✅ aliased |
| `ingest_view_module.php:14-16` | Same aliasing | ✅ |
| `pm_module.php:325-328` | `SELECT id, session_title, source_ai … WHERE processed = 0` | ✅ |

**The mismatch is inside one file.** `ingest_module` writes with the real column names and reads with names that never existed; the two sibling modules read it correctly. It is not a schema disagreement — it is one un-updated SELECT, hidden by an empty catch.

---

## 6. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A4-001 | `modules/ingest_module.php:67,70-71,107` | Unsanitised `case_id` interpolated into filesystem paths; `:107` has no `is_dir` gate, giving a `file_put_contents` write primitive to any path ending `/network.json` | P0 | V1 |
| A4-002 | `modules/ingest_module.php:64-66` | Upload accepts any extension, MIME type and size, into a web-served directory, behind no auth | P0 | V1 |
| A4-003 | `modules/ingest_module.php:108-109` | Uploaded file's content is read into `$content` and discarded; the pipeline receives only `"File uploaded: <name>"` | P1 | Extraction |
| A4-004 | `modules/ingest_module.php:111` | `catch (Exception $e) {}` wraps the documents INSERT and pipeline, then reports success | P1 | Trust in upload |
| A4-005 | `modules/ingest_module.php:164-165` | Sessions tab selects `session_label`/`platform`; the table has `session_title`/`source_ai` → always empty | P1 | Sessions tab |
| A4-006 | `modules/ingest_module.php:36-45` | Pasted transcript is stored and never extracted; `processed` stays 0 and only `pm_module.php:184` ever changes it | P1 | Intake → graph |
| A4-007 | `modules/excavation_module.php:3` | Requiring the 2-byte `{}` stub makes `shell.php` return `{}` instead of the module's array — the Excavation screen renders `{}` | P1 | Excavation screen |
| A4-008 | `modules/excavation_module.php:39-97` | Extraction runs as a side effect of every GET page load, re-reading every client file (7.3 MB of JSON plus artifacts) | P1 | Performance/determinism |
| A4-009 | `modules/excavation_module.php:263-276` | Persistence loop writes one `auto_case_<signal>_<time>.json` per artifact into the same directory/file, so each artifact overwrites the last; `@mkdir … 0777` | P1 | Case output |
| A4-010 | `engine/entity_extraction_engine.php:42` | Noise list blacklists `Brad, Moore, Builders, Perry, Drees, Journey, Hill, Country` — the primary client can never be extracted | P1 | Entity quality |
| A4-011 | `modules/dig_review_module.php:53-63` | Confirming a flag updates `review_flags.status` only; nothing inserts into `findings`, so review never produces output | P0 | Review → report |
| A4-012 | `modules/dig_review_module.php:83-84` | Queue INSERT selects `context` from `entities`, which has no such column → the action throws and `review_flags` can never be populated | P0 | Review queue |
| A4-013 | `modules/entity_resolution_module.php:66-90` | `break 2` after the first candidate and no UPDATE anywhere: the scan suggests at most one merge and executes none | P1 | Resolution |
| A4-014 | `ingest.php:3,25-29` / `ingest2.php:3,25-29` | Hard-coded `$network_id`; only `network_id/type/strength` are posted, so `title`/`content` never leave the request; `http://` + Host header | P1 | Legacy ingest |
| A4-015 | `create_session.php:34`; `session.php:11` | Base path `DOCUMENT_ROOT/legaisee/clients/` is not the app's `data/clients/`; no `legaisee/` directory exists; both files have zero live references | P2 | — |
| A4-016 | `modules/insight_module.php:1-13,63-80` | Header names the wrong file; the module duplicates the ingest form and INSERT as a second writer for `memory_ingest`, without the case link | P2 | — |
| A4-017 | `prospect.php:226-228` | Dossier written to `data/prospects/*.json` with `mkdir 0777` beside the MySQL `prospect_ingests` row — two stores for one record | P2 | — |

---

## 7. What would make the chain work

Recorded because every defect above has a small, bounded fix and the order matters:

1. `dig_review_module.php:84` — drop the `(SELECT context FROM entities …)` subquery (use `NULL`). This alone makes the queue able to accept 5,154 items.
2. `dig_review_module.php:53-63` — on `confirmed`, insert a `findings` row. This is the missing link between review and report.
3. `ingest_module.php:164` — alias the two columns. The Sessions tab starts working.
4. `ingest_module.php:108-109` — pass `$content` to `lee_extract_and_store()`. Uploads start producing entities.
5. `ingest_module.php:70,107` — validate `case_id` against `^[A-Za-z0-9_-]+$` and `realpath()` containment.
6. `entity_extraction_engine.php:42` — remove the client names from the noise list.

---

## 8. Limits

- Static reading only; nothing was executed. "Works" means every path was followed in source, not that a request was served.
- The `documents` INSERT was judged valid from the column list; whether MySQL's `sql_mode` rejects the empty `content` for a PDF was not tested.
- Upload validation is assessed for what the code checks; a hosting-level `php.ini` (`upload_max_filesize`, `file_uploads`) could impose limits this block cannot see.
- Whether `data/files/` is actually reachable over HTTP depends on the vhost; the files are inside the webroot by path, which is the condition that makes A4-002 a P0 rather than a P2.
- `prospect.php`'s scoring and narrative sections were read only where they touch storage and extraction; its 400 lines of presentation were not adjudicated here.
- No source file was modified in this block.

---

### Legend
**Status** — `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD` (`00-GROUND-RULES.md` §5).
**Severity** — `P0` blocks V1 / security · `P1` wrong results or lost data · `P2` hygiene.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions.
