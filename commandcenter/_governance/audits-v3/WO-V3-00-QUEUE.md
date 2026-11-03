# LEGAiSEE — Audit v3 Work Order Queue (to V1)

**Issued:** 2026-10-29
**Source of truth:** `_governance/audits-v2/` (A11 master verdict, P0/P1 registers, schema-source.sql)
**Claude role:** Architect — writes the work order and the complete replacement files
**You:** approve, then paste each file into the cPanel code editor
**Rule for every work order:** small, one purpose, complete replacement files (no patches), a plain-language test at the end, and a way to undo it.

## How this queue was built

- V1 means the five screens from OS Contents: **Command View, Case/Client View, Excavation Queue, Vault & Delivery, System Health**, plus a basic live client dashboard and a simple "good morning" summary.
- The audit found only **99 files** need building work. 225 are archive candidates and are NOT work items.
- Order = (1) make what exists tell the truth and actually work, (2) finish the screens V1 is made of, (3) lock the doors, (4) build the two missing V1 pieces.
- Nothing in this queue deletes anything. Dead files get moved to `_archive/` later, with a list.

## The queue

| WO | What it fixes in plain words | Files | Audit defects | V1 screen it helps |
|---|---|---|---|---|
| **V3-01** | Search finds nothing because it asks the database for columns that don't exist; failures hidden | `modules/search_module.php`, `api/search_load.php` | A3-001..004, A6-005..009 | Command View / search |
| V3-02 | Shell prints raw errors, marks every module "working", shows "N records" or raw JSON instead of results | `shell.php` | A9-001, A9-007, A9-008, A9-011, A2-007, A5-008 | All screens |
| V3-03 | Intake: uploaded file contents are thrown away, pasted transcripts never analyzed, errors swallowed, Sessions tab always empty | `modules/ingest_module.php` | A4-002..006 (A4-001 in V3-11) | Case/Client View |
| V3-04 | Dig Review: confirming a flag creates no finding; the queue insert uses a column that doesn't exist | `modules/dig_review_module.php` | A4-011, A4-012 | Excavation Queue |
| V3-05 | Reports print ID numbers instead of findings, mix cases together, never save a record, PDF gets page HTML in front; vault download link broken | `modules/report_module.php`, `modules/vault_module.php` | A7-003..009, A6-010, A6-011 | Vault & Delivery |
| V3-06 | System Health screen crashes on a SQLite check; the "intelligence" screen is made-up numbers; brain screen looks in a folder that doesn't exist | `kernel/system_health.php`, `modules/intelligence_dashboard_module.php`, `modules/brain_module.php` | A2-011, A9-002, A9-003 | System Health |
| V3-07 | The 28 finished engines are not connected to any screen; plain-English helper unused; cluster/graph screens show wrong columns | `engine/plain_english_helper.php`, `modules/cluster_module.php`, `modules/graph_module.php` + wiring | A5-005, A5-006, A5-009 | Case/Client View |
| V3-08 | Excavation screen shows `{}`; extraction runs on every page load; artifacts overwrite each other | `modules/excavation_module.php`, `modules/utils/json_helpers.php` | A4-007..009, A1-006 | Excavation Queue |
| V3-09 | Project creation fails; kanban hides 3 statuses; tasks point at two different project tables | `modules/pm_module.php` | A8-006..008, A8-011 | (V2 PM, but unblocks tasks) |
| V3-10 | Missing styles (`fm-*`, `pm-*`, `ui-tabs`) and a page nested inside a page | `ui/global.css`, `modules/view_module.php`, `ui/ui_engine.php` | A9-009, A9-010 | All screens, matches website |
| V3-11 | **Lockdown (code side):** no login anywhere, unprotected modules, file manager can reach the whole app, open Claude endpoint, upload path hole | `shell.php`, `kernel/kernel_boot.php`, `.htaccess`, `modules/*`, `api/*` | A1-001..004, A2-005, A2-006, A4-001, A5-003, A6-001..004 | Required before any client sees it |
| V3-12 | **Build:** good-morning summary + live client dashboard (real counts from real tables) | new module, built on cockpit | B13 | Command View |
| V3-13 | Billing end to end (needs your live Stripe keys + one test checkout) | `modules/payment_module.php` | A7-001, A7-002, A7-011..014 | Vault & Delivery |

## Parked on purpose (your call, not forgotten)

- **Passwords and keys** (exposed in the public repo): parked at your request. Note that V3-11 and V3-13 assume you have rotated them first.
- **Moving the 5 MB database dump, the SQLite file and the FTP settings file out of the website folder:** goes with V3-11.
- **Archive move** of the 225 dead files: after V3-10, as one manifest-driven step.
- **Not in V1 at all** (no code exists, correctly V2/V3): knowledge system, full dig, Authority Marketing System, yearly dossier, autonomous digs, voice, CAMERA module.

## Status board

| WO | Status |
|---|---|
| V3-01 | READY — files attached |
| V3-02 .. V3-13 | Queued — next one is written on your "next" |
