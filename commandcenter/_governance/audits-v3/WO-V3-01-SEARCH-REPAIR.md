# WO-V3-01 — Search Repair

**Date:** 2026-10-29
**Claude role:** Architect (spec + complete replacement files)
**Executor:** You, in the cPanel code editor
**Approval required before running:** John
**Fixes:** A3-001, A3-002, A3-003, A3-004, A6-005, A6-006, A6-007, A6-008, A6-009

## Why

The search screen asks the database for columns that do not exist, then hides the error, so the answer is always "No results." Your database already holds the data: 2,433 entities, 2,721 relationships, your files and your sessions. Search just couldn't see it.

| Search area | What the code asked for | What the database really has |
|---|---|---|
| Files | `filename`, `filetype` | `title`, `file_type`, `content` |
| Entities | `name`, `type` | `canonical_name`, `entity_type` |
| Relationships | `type`, `confidence`, `entity_a_id`, `entity_b_id` | `relation_type`, `strength`, `from_entity_id`, `to_entity_id` |

## What changes (2 files, nothing else)

1. `modules/search_module.php` — correct column names; file search now also looks inside file text; each of the five silent failures now shows "Could not search: …" on screen and writes the real error to the server log.
2. `api/search_load.php` — same column fixes for the side-by-side panes; no more raw database error text sent to the browser.

No new database tables. No new styles. No other file touched.

## Steps

**Step 1 — Back up the two files first (so you can undo)**
1. Log in to cPanel and open **File Manager**.
2. Go to the `commandcenter` folder, then the `modules` folder.
3. Click `search_module.php` once, then click **Copy** at the top.
4. In the box that appears, type the path ending in `commandcenter/_governance/backup-V3-01/` and click **Copy File(s)**. (If that folder doesn't exist, make it first with **+ Folder**.)
5. Do the same for `commandcenter/api/search_load.php`.

**Step 2 — Replace `search_module.php`**
1. Open `commandcenter/modules/search_module.php` in the cPanel code editor.
2. Click inside the text, press **Ctrl+A** (select all), then **Delete**.
3. Open the attached file `modules/search_module.php`, press **Ctrl+A**, **Ctrl+C**.
4. Go back to the editor, press **Ctrl+V**, then click **Save Changes**.

**Step 3 — Replace `search_load.php`**
1. Open `commandcenter/api/search_load.php` in the cPanel code editor.
2. Same as above: **Ctrl+A**, **Delete**, paste the attached `api/search_load.php`, **Save Changes**.

## Test (about 3 minutes)

1. Open the Command Center and click **Search** in the left sidebar.
2. Type `Brad` and click **Execute**. **Pass:** you see results with an ENTITY-type badge (for example "Brad Moore Builders") and REL results. Before this fix there were none.
3. Type `ingest` and click Execute. **Pass:** you see a file result named "test ingest."
4. Click one ENTITY result, then click **Set A**. **Pass:** the left pane fills with Name, Type and Confidence. Click one REL result, **Set B**. **Pass:** it shows Entity A, Relationship, Entity B, Strength.
5. **Fail signs:** a line saying "Could not search: …" appears, or a pane says "(could not load this record …)". If so, tell me which word was in the line and I'll read the server log entry with you.

## Undo

Open the copies in `_governance/backup-V3-01/`, copy their contents, and paste them back over the two files the same way as Steps 2 and 3.

## Notes

- Search is still reachable without logging in. That belongs to WO-V3-11 (the lockdown), not this one.
- One thing the test may reveal: the entity list contains noisy items like "Analyze" and "Builders" (audit A4-010). That is an extraction-quality problem, handled later with the engine work, not a search bug.
