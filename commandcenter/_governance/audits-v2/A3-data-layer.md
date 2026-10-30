# A3 — Data layer vs real schema

**Date:** 2026-10-29
**Truth:** `schema-source.sql` — pre-migration dump, server `5.7.44-percona`, 51 tables, 10,486 data rows, generated 2026-10-29 15:16.
**Scope:** every SQL statement and every filesystem-JSON read in the **A1-reachable** set (60 first-party files + the two JS-called endpoints). A statement in dead code is not a runtime mismatch and is out of scope.
**Method:** `_governance/audits-v2/a3_data.py` — parses the dump into tables/columns/engines and counts value tuples per `INSERT`; tokenises PHP string literals properly (quotes, escapes, heredoc; comments stripped) so a SQL keyword in a comment is not a statement; extracts tables from `FROM`/`JOIN`/`INTO`/`UPDATE`, column lists from `INSERT`, and `SELECT` lists only where the query is single-table, function-free and alias-free. Every flag was then opened and read by hand.
**Outputs:** `A3-run.txt` (per-file SQL dump), `A3-data.json` (machine-readable), this report.

---

## Headline

The knowledge graph is **real and populated**: 2,433 entities, 2,495 aliases, 2,721 relationships. The client record is **real but tiny**: 3 clients, 1 case. Everything built on top of the graph that involves a **review or delivery step is empty** — `findings`, `review_flags`, `clusters`, `tasks`, `payments` and `reports` all have zero rows.

And the two surfaces a user reaches for first — search and the record pane — query **columns that do not exist**. Three of those queries fail inside `catch (Exception $e) {}`, so they return nothing and report no error.

---

## 1. SQL in live code vs the dump

The script parsed every SQL literal in the reachable set. It produced **11 flags**; inspection confirmed **6 real mismatches** in 2 files and dismissed **5 parser artifacts**.

### 1.1 Real mismatches

| File:line | Statement (columns as written) | Table | Reality in dump | Effect |
|---|---|---|---|---|
| `modules/search_module.php:79` | `SELECT id, filename, filetype FROM files WHERE filename LIKE :q` | `files` | `files` is `id, folder_id, title, content, file_type, created_at` — **no `filename`, no `filetype`** | PDOException → caught at `:90` → **file search returns zero rows, silently** |
| `modules/search_module.php:94` | `SELECT id, name, type, confidence FROM entities WHERE name LIKE :q` | `entities` | `entities` is `id, entity_type, canonical_name, normalized_hash, confidence, created_at` — **no `name`, no `type`** | caught → **entity search returns zero rows, silently** |
| `modules/search_module.php:108-113` | `SELECT r.id, r.type, r.confidence, e1.name AS a, e2.name AS b … LEFT JOIN entities e1 ON e1.id = r.entity_a_id` | `relationships` + `entities` | `relationships` is `id, from_entity, to_entity, relation_type, strength, context, metadata, created_at, from_entity_id, to_entity_id` — **no `type`, no `confidence`, no `entity_a_id`/`entity_b_id`**; `entities` has **no `name`** | caught → **relationship search returns zero rows, silently** |
| `api/search_load.php:103` | `SELECT filename, filepath, filetype, filesize FROM files WHERE id = …` | `files` | same as above — none of the four columns exist | live endpoint: caught by the `try` at `:92` → pane cannot load a file record |
| `api/search_load.php:110` | `SELECT name, type, confidence FROM entities WHERE id = …` | `entities` | no `name`, no `type` | same |
| `api/search_load.php:117-123` | `SELECT r.type, r.confidence, r.source_text, e1.name AS entity_a … ON e1.id = r.entity_a_id` | `relationships` + `entities` | no `type`/`confidence`/`source_text`/`entity_a_id`/`entity_b_id`; no `entities.name` | same |

Both files appear to have been written against a **different, older `files`/`entities`/`relationships` shape** — one with `filename`, `filepath`, `filesize`, `entity_a_id`, `type`, `confidence`, `source_text`. That schema is not in the dump.

### 1.2 Dismissed flags (verified by reading the code)

| Flag | Verdict | Why |
|---|---|---|
| `modules/pm_module.php:130,284,300` table `failed` | artifact | `failed` is a word inside an error-message string, not a table; `:130` is `if ($action === 'add_task')` |
| `modules/cockpit_module.php:37` table `INFORMATION_SCHEMA` | artifact | `:34` is a legitimate `SELECT 1 FROM INFORMATION_SCHEMA.TABLES` existence probe |
| `modules/dig_review_module.php:87` insert-cols onto `entities` | artifact | the statement is `INSERT INTO review_flags (source_table, source_id, context, status) VALUES ('entities', …)`; all four columns exist |
| `modules/dig_review_module.php:104` insert-cols onto `relationships` | artifact | same pattern with the literal `'relationships'` |
| `modules/ingest_module.php:172` select-cols `session_label, platform` | artifact | `:165` selects `session_title AS session_label, source_ai AS platform` — aliases are legal; the literal was split across concatenation |

### 1.3 Statements that match the schema

Every other statement validated clean. The table→code map the script produced (this is also the answer to "which live file touches which table"):

| Table | Live readers/writers |
|---|---|
| `entities` | `api/search_load.php`, `engine/entity_extraction_engine.php`, `modules/anomaly_engine_module.php`, `client_view_module.php`, `dig_review_module.php`, `entity_resolution_module.php`, `graph_module.php`, `predictive_link_module_v1.php`, `search_module.php`, `semantic_cluster_module.php` |
| `relationships` | same ten files |
| `entity_aliases` | `engine/entity_extraction_engine.php`, `anomaly_engine_module.php`, `entity_resolution_module.php` |
| `memory_ingest` | `api/search_load.php`, `ingest_module.php`, `ingest_view_module.php`, `insight_module.php`, `pm_module.php`, `search_module.php` |
| `documents` | `api/search_load.php`, `dig_review_module.php`, `ingest_module.php`, `insight_module.php`, `search_module.php` |
| `files` | `api/search_load.php`, `ingest_module.php`, `insight_module.php`, `search_module.php` |
| `clients` | `clients_module.php`, `cockpit_module.php`, `report_module.php` |
| `cases` | `client_view_module.php`, `cockpit_module.php`, `report_module.php` |
| `review_flags` | `client_view_module.php`, `dig_review_module.php`, `report_module.php` |
| `clusters` | `cluster_module.php` |
| `payments` | `client_view_module.php`, `payment_module.php` |
| `projects` | `ingest_module.php`, `insight_module.php`, `pm_module.php` |
| `pm_tasks` | `pm_module.php` |
| `task_sessions` | `pm_module.php` |
| `processing_queue` | `client_view_module.php`, `cockpit_module.php` |
| `prospect_ingests` | `cockpit_module.php`, `prospect.php` |
| `tree_nodes` | `client_view_module.php` |
| `page` / `page_content` | `lib/semantic_diff_engine.php`, `cluster_module.php`, `view_module.php` |
| `memory_domains` | `ingest_module.php`, `insight_module.php` |

---

## 2. SQLite-isms in reachable code: **zero**

| Search | Reachable hits |
|---|---|
| `sqlite_master` | **0** |
| `datetime('now')` | **0** |
| `AUTOINCREMENT` | **0** |
| `last_insert_rowid` | **0** |
| `PRAGMA` | **0** |

Three exist in the tree, all outside the reachable set:

| File:line | Snippet | Status |
|---|---|---|
| `kernel/system_health.php:50` | `SELECT name FROM sqlite_master WHERE type='table'` | DEAD file (A2-011); it is the one that aborts its own DB probe on MySQL |
| `database/migrations/010_create_tree_nodes_table.php:7` | `id INTEGER PRIMARY KEY AUTOINCREMENT` | DEAD migration; the real table is InnoDB `tree_nodes` |
| `database/migrations/010_create_tree_nodes_tablebk.php:7` | identical | byte-duplicate of the above |

**The live data path is MySQL-only.** SQLite survives only as dead scaffolding and one broken diagnostic.

---

## 3. `relationships` — what is written vs what is read

Ten live files read or write this table. Written by exactly one: `engine/entity_extraction_engine.php:254`.

### 3.1 Columns

| Column | Type | Written by extractor? | Read by |
|---|---|---|---|
| `id` | int PK | auto | all readers |
| `from_entity` | varchar(64) | ✅ `substr($fromName, 0, 64)` `:262` | `anomaly_engine` (contradictions), `test_extraction_fix.php` |
| `to_entity` | varchar(64) | ✅ `substr($toName, 0, 64)` `:263` | same |
| `relation_type` | varchar(50) | ✅ | `graph_module:64`, `dig_review:249`, `client_view:56`, `anomaly`, `semantic_cluster` |
| `strength` | float | ✅ | `graph_module:64`, `dig_review`, `client_view`, `semantic_cluster`, `anomaly` |
| `context` | text | ✅ | `dig_review:87,100` (copied into `review_flags.context`) |
| `metadata` | json | ❌ **never** | nothing reads it |
| `created_at` | timestamp | ✅ `NOW()` | — |
| `from_entity_id` | bigint | ✅ | `graph_module:64`, `dig_review:249`, `client_view:56`, `anomaly:17-45` |
| `to_entity_id` | bigint | ✅ | `graph_module:64`, `dig_review:249`, `client_view:56`, `anomaly` |

**Conclusion:** the extractor and the three consumers named in the brief — Graph, Dig Review, Client View — agree **exactly** on the id-based columns. All three join on `from_entity_id`/`to_entity_id` and read `relation_type` + `strength`, and they resolve display names through `entities.canonical_name`. That path is coherent.

The divergence is **not** between extractor and those three — it is in **search**, which is the only pair of files that assumes a different shape (`r.type`, `r.confidence`, `r.source_text`, `entity_a_id`). So the graph renders, but a relationship cannot be found by search or opened in the compare pane.

### 3.2 Two write-path defects the graph inherits

- **`from_entity`/`to_entity` are `varchar(64)`** and the writer truncates with `substr(..., 0, 64)` (`:262-263`). Business names longer than 64 characters are silently cut in the display columns while the `*_id` join keys stay correct — so the graph labels and the entity records can disagree.
- **`metadata` is declared and never populated** (2,721/2,721 rows NULL). Any future work that keys off edge metadata starts from nothing.
- **Dedupe depends on ids being non-null.** The existence check (`:247-252`) matches on `from_entity_id AND to_entity_id AND relation_type`; rows written with a NULL id would never be found and would duplicate on every re-run.

---

## 4. Live files that still read JSON records

`a3_data.py`'s automated JSON list found only **3**, because its window filter looked for the literal `.json` within 120 characters of the call. Expanding by hand (grep + reads) gives **20 reachable files**. This is a limitation of my filter, not a property of the code — the list below is the complete set, verified by reading each site.

| File (line) | What it reads | MySQL table that should replace it |
|---|---|---|
| `modules/cases_module.php:6-7` | `load_json_dir(data/cases)`, `load_json_dir(data/clients)` | `cases`, `clients` |
| `modules/dashboard_module.php:5-6` | same two dirs | `cases`, `clients` |
| `modules/decision_module.php:11` | `load_json_dir(data/cases)` | `cases` |
| `modules/relations_module.php:11-12` | cases + clients dirs; writes `insights.json` at `:134` | `cases`, `clients`; insights → `findings` |
| `modules/root_cause_graph_module.php:5,112` | cases dir + client case dirs | `cases` |
| `modules/executive_dashboard_module.php:11-12` | cases + clients dirs | `cases`, `clients` |
| `modules/alert_module.php:5` | cases dir | `cases` (+ computed rules) |
| `modules/recommendation_module.php:6` | cases dir | `cases` |
| `modules/time_intelligence_module.php:5` | cases dir | `cases` |
| `modules/predictive_module.php:11` | cases dir | `cases` |
| `modules/search_module.php:40` | `scandir` + `file_get_contents` over `data/{cases,clients,prospects,network}` `:24-32` | `cases`, `clients`, `prospect_ingests` |
| `modules/report_module.php:101-102` | `glob(data/clients/*/cases/*/meta.json)` | `cases` (+ `clients`) |
| `modules/ingest_module.php:152-153` | `glob(data/cases/*/meta.json)` | `cases` |
| `modules/dig_review_module.php:124-172` | `meta.json`, `insights.json`, `clusters.json`, `network.json` | `cases`, `findings`, `clusters`, `relationships`/`entities` |
| `modules/semantic_cluster_module.php:183` | `glob(data/clients/*/cases/*)` dirs | `cases` |
| `modules/entity_resolution_module.php:96,106` | case dirs + `insights.json` | `cases`, `findings` |
| `modules/vault_module.php:37-49` | client dirs, `profile.json`, `reports/*.pdf` | `clients`, `reports` |
| `modules/client_view_module.php:77` | `glob(.../reports/report_*.pdf)` | `reports` |
| `modules/cross_case_engine.php:42` | every JSON under `data/clients`, `data/cases` | `entities`, `relationships` |
| `modules/excavation_module.php:39-75` | `glob(data/clients/*/cases/*/files/*)` + raw text | `artifacts` (empty table) |

`api/search_load.php` also has a `source === 'json'` branch that reads the four data dirs — the same fallback A1 flagged.

**The two stores disagree, and that is the real risk.** MySQL `clients` holds *Brad Moore Builders*, *Carr Multimedia*, *Good Ol Rockin Therapy* (real Texas businesses, 2026-05-08). The JSON `clients` hold *Acme Manufacturing*, *Bright Dental Group*, *Summit Realty* — placeholders. Nine routed modules read the JSON; three read MySQL. Two screens can show two different client books.

---

## 5. Row counts by table (from `INSERT` tuples in the dump)

**10,486 rows total across 19 populated tables.**

| Table | Engine | Rows |
|---|---|---:|
| `relationships` | MyISAM | 2,721 |
| `relationships_bak_20261027` | MyISAM | 2,721 |
| `entity_aliases` | MyISAM | 2,495 |
| `entities` | MyISAM | 2,433 |
| `prospect_ingests` | InnoDB | 26 |
| `memory_ingest` | MyISAM | 19 |
| `page` | MyISAM | 16 |
| `page_content` | MyISAM | 16 |
| `tree_nodes` | InnoDB | 9 |
| `projects` | MyISAM | 7 |
| `pm_tasks` | InnoDB | 6 |
| `folders` | MyISAM | 5 |
| `clients` | MyISAM | 3 |
| `memory_domains` | MyISAM | 3 |
| `files` | MyISAM | 2 |
| `cases` | MyISAM | 1 |
| `documents` | InnoDB | 1 |
| `pm_projects` | InnoDB | 1 |
| `users` | InnoDB | 1 |

### Empty tables — 32 of 51

`activity_log`, `artifacts`, `attachments`, `audit_logs`, `chat_ingest`, `clusters`, `conversations`, `events`, `finding_sources`, **`findings`**, `goal_proposals`, `intake_queue`, `memory_chunks`, `memory_ingests`, `node_attributes`, `node_details`, **`payments`**, `permissions`, `pm_comments`, `pm_milestones`, `pm_notes`, `pm_task_ingests`, `processing_queue`, `prompts`, **`reports`**, **`review_flags`**, `role_permissions`, `roles`, `saved_views`, `task_sessions`, **`tasks`**, `user_roles`.

The five bold ones are the delivery chain: extraction → review → finding → report → invoice. Extraction ran (2,721 edges), and **nothing downstream has ever stored a row**. That is consistent with a system whose review queue has never been used on production data, not with a migration that lost rows.

---

## 6. Is the JSON real client work or test data?

| Evidence | Verdict |
|---|---|
| `data/clients/client_001.json` = *Acme Manufacturing* / Industrial; `client_002` = *Bright Dental Group* / Healthcare; `client_3` = *Summit Realty* / Real Estate — each file only 3 keys (`id`, `name`, `industry`) | **Test scaffolding.** Textbook placeholder names, no address, no contacts, no dates. |
| MySQL `clients` = *Brad Moore Builders*, *Carr Multimedia*, *Good Ol Rockin Therapy* with city/state/industry/status and `2026-05-08` timestamps | **Real client work.** |
| MySQL `cases` = one row, `business_name = 'Test Business'`, city New Braunfels, `processing_status = 'pending'` | **Test.** |
| `data/cases/case_001.json` → `Expecting ',' delimiter: line 7` | **Corrupt.** `json_decode` returns null and `load_json_dir` skips it silently (`bootstrap.php:20-24` requires `is_array`). |
| `data/cases/case_002.json` → `Extra data: line 8` | **Corrupt** in the same way. |
| `data/cases/1/case.json` | `[]` — **empty array**, not an object. |
| Only **3** `meta.json` exist in the whole tree, two of them under `test_client_1785280056` | **Test.** |
| `data/prospects/prospect_brad_moore_builders_*.json` — nine files, **3,016 bytes each**, unix-stamped 1778493544-1778499479 | **Real prospect work, duplicated.** Nine scrapes of the same business with no dedupe key. |
| `data/network/` — 9 files: `net_case_1.json` 13,921 b, one 6,349 b, **six at 132-165 b** | **Mostly empty graph stubs** written by `ingestToNode`. |
| `data/cases/1/network.json` — nodes=2, edges=0 | **Thin.** The one case with a network file has two nodes and no edges. |
| `normalized/` — 36 files, mostly 32-hex `.txt` digests plus one `.md` + `.md.json` sidecar | **Real ingest output** (hash-named), no client identity attached. |
| All 103 `data/*.json` files modified `2026-10` | Recent, consistent with an active-but-thin working set. |

**Verdict:** the JSON layer is **predominantly test/sample scaffolding plus corrupt files**, with one pocket of real work (Brad Moore Builders prospect scrapes, duplicated 9×). The real client records and the only substantial graph live in **MySQL**. Migration direction is therefore one-way: MySQL is the source of truth; the JSON reads are the thing to retire, not the thing to preserve.

---

## 7. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A3-001 | `modules/search_module.php:79` | File search queries `files.filename` / `files.filetype`; the table has `title`, `content`, `file_type`. Exception swallowed at `:90` → zero file results, no error shown | P1 | Search |
| A3-002 | `modules/search_module.php:94` | Entity search queries `entities.name` / `entities.type`; the table has `canonical_name`, `entity_type`. Swallowed → zero entity results | P1 | Search |
| A3-003 | `modules/search_module.php:108-113` | Relationship search queries `r.type`, `r.confidence`, `e1.name`, joins on `r.entity_a_id`/`entity_b_id` — none exist. Swallowed → zero relationship results, so 2,721 edges are unsearchable | P1 | Search |
| A3-004 | `api/search_load.php:103,110,117-123` | Same three wrong column sets on a live endpoint; caught by the `try` at `:92`, so the compare pane silently refuses to open files, entities and relationships | P1 | Compare pane |
| A3-005 | schema (`findings`, `review_flags`, `clusters`, `tasks`, `payments`, `reports`) | 32 of 51 tables empty; the entire review→finding→report→invoice chain has never stored a row despite 2,721 extracted relationships | P1 | Delivery loop |
| A3-006 | `engine/entity_extraction_engine.php:262-263` | `from_entity`/`to_entity` truncated to 64 chars by `substr()` into `varchar(64)`; display names drift from `entities.canonical_name` | P1 | Graph labels |
| A3-007 | `schema-source.sql:5818` (`metadata json`) | `relationships.metadata` is declared and never written by the only writer — 2,721/2,721 NULL | P2 | — |
| A3-008 | 20 files (list §4) | Routed modules read `data/*.json` while the record lives in MySQL; the JSON holds placeholder clients (*Acme*, *Bright Dental*, *Summit*) and MySQL holds real ones (*Brad Moore Builders*, *Carr Multimedia*, *Good Ol Rockin Therapy*) | P1 | Client screens |
| A3-009 | `data/cases/case_001.json:7`, `case_002.json:8` | Invalid JSON; `load_json_dir` requires `is_array` and drops them silently, so those cases vanish from every JSON-reading screen | P1 | Cases screen |
| A3-010 | `relationships_bak_20261027` | Full 2,721-row duplicate of `relationships` inside the production schema; no code references it | P2 | — |
| A3-011 | `memory_ingest` vs `memory_ingests` | Two near-identically named tables; 19 rows in `memory_ingest`, 0 in `memory_ingests`, and only the first is used | P2 | — |
| A3-012 | `data/prospects/` | Nine 3,016-byte scrapes of the same prospect (Brad Moore Builders) written seconds apart; no dedupe key | P2 | Prospect dig |

C-01 (31 of 51 tables are MyISAM — no transactions, no FK enforcement) applies to every table above and is not re-numbered here.

---

## 8. Limits

- **Row counts come from `INSERT` tuples**, not `SELECT COUNT(*)` against the live server. The dump was generated 2026-10-29 15:16; anything written since is invisible to this block. Multi-row `INSERT` blocks were counted one tuple per line, which matches this dump's phpMyAdmin format but would undercount a dump written differently.
- `LEFT JOIN`/`OR` conditions are validated by hand only where the script flagged them. A column that exists in the dump but is never populated is not detectable from the schema alone.
- The automated JSON-reader list was too narrow (3 of 20); §4's list is manual and complete for the reachable set, but a JSON path built entirely from variables (`$base . $name . '.json'`) would still be invisible to both.
- "Real vs test" is a judgement from names, dates, sizes and structure — no client was contacted and no file was opened beyond selected fields. It is strong evidence, not proof of provenance.
- Dynamic SQL (`"... WHERE id = {$id}"`) is injection-prone but is a security matter already recorded in A2; A3 only judges column existence.
- No source file was modified in this block.

---

### Legend
**Status** — `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD` (`00-GROUND-RULES.md` §5).
**Severity** — `P0` blocks V1 / security · `P1` wrong results or lost data · `P2` hygiene.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions.
