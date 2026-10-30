# A9 — Dashboards and UI rendering (S2)

**Date:** 2026-10-29
**Scope:** `cockpit`, `dashboard`, `executive_dashboard`, `intelligence_dashboard`, `brain` modules; `shell.php`'s render functions; `modules/utils/uic_v1.php`; `ui/global.css`.
**Method:** all five dashboard modules read in full and each `return` matched to `shell.php:38-100`'s branches; every one of the registry's modules classified by return shape; `global.css` (1,924 lines) searched for the 20 class families the modules actually use; the sidebar's status literals counted; the brain's engine probe path checked against the filesystem.
**Inputs:** `module_registry.php`, `A5-graph-intelligence.md`, `A6-search-files-vault.md`, `A7-report-payment.md`, `A8-project-manager.md`.

---

## The four answers

1. **Which screens show readable output?** **Cockpit** (real DB, real HTML), **search**, **pm**, **files**, **ingest**, **dig_review**, **client_view**, **vault**, **cases**, **clients**, **compare**, **recommendation**, **insight**, and **intelligence_dashboard** — the last of which is readable but **entirely fabricated**.
2. **Which dump JSON or bare counts?** **`executive_dashboard`** (4 JSON blobs), **`brain`** (5 JSON blobs), and the six from A5 (`root_cause`, `relations`, `predictive`, `decision`, `cross_case`, `time_intelligence`). Bare counts: **`graph`** (2 numbers), **`semantic_cluster`** and **`predictive_link_v1`** ("N records"), **`dashboard`** (a two-number JSON inside a list row).
3. **Which hardcode "working" status?** **`shell.php:181-~250`** — `'status' => 'working'` is a literal on **every** sidebar entry, so no broken module is ever flagged. **`intelligence_dashboard`** fabricates its own numbers and announces *"Executive dashboard operational"*. **`executive_dashboard`** sets `'engine_state' => 'ACTIVE'` unconditionally. **`cockpit`** stamps every health row `'status' => 'OK'`. **`brain`** sets `'status' => 'ACTIVE', 'shell' => 'CONNECTED'` as literals.
4. **What CSS is actually loaded?** **One file:** `/commandcenter/ui/global.css`, linked once at `shell.php:261`. Eight modules carry their own `<style>` block. **`files_module` has no styles anywhere** (`fm-*`: 0 definitions), and `pm_module`'s classes are also undefined — those two screens render as unstyled HTML.

---

## 1. The render pipeline, exactly

`shell.php:38` `renderModule()` tries four things in order, and the order is what decides every screen:

```
:49-52   ob_start(); require $file; $buffer = ob_get_clean();
         if (!empty(trim($buffer))) return $buffer;        ← DIRECT HTML WINS
:54      if (is_string($result)) return $result;           ← module returned HTML
:56-61   array[0]['type'] set → uic_render each             ← UIC packets
:62      array['type'] set    → uic_render($result)
:63-65   array['title']+['items'] → render_inspector()      ← <pre> JSON DUMP
:67-78   anything else → exec-panel, and every array value
                          collapsed to count($v) . ' records'
:80-82   catch (Throwable) → "<div class='error'>…" . $e->getMessage()
```

Two consequences worth naming:

- **`render_inspector()` (`:85-95`) is the JSON-dump branch.** It prints `$item['content']` inside `<pre class='inspector-content'>`. Every module that returns `title` + `items` with `json_encode(...)` content lands here. That is a code path, not an accident, and it currently serves six of the intelligence screens.
- **`exec-panel` (`:67-78`) destroys nested data.** `if (is_array($v)) $v = count($v) . ' records';` — so a module that computes 40 clusters and returns them under a key shows literally "40 records".

`display_errors` is forced on at `:3-4` (`error_reporting(E_ALL); ini_set('display_errors', 1);`) in a page with no authentication, so the catch at `:80` prints exception text straight into the operator's browser.

---

## 2. The five dashboards

| Module | Return | Branch | What a person sees |
|---|---|---|---|
| `cockpit` | echoes HTML | buffer | **Real, readable**: "Good Morning, Operator" + today's date, client/case counts from `SELECT COUNT(*)`, up to 5 queue items, up to 5 prospect ingests, a health list, and 7 "System Pillars" tiles. **The best screen in the app** |
| `dashboard` | `['type'=>'list', items:[{title:'Totals', content: json_encode([cases, clients])}]]` | `uic_render` → `render_list` | One row reading **"Totals — Overview"** with a nested key/value panel showing `cases: 29`, `clients: 14`. Two numbers, styled |
| `intelligence_dashboard` | array of 3 UIC packets | `uic_render` each | An **"Executive Intelligence Snapshot"** card with 4 bullet signals, a 4-row metric panel, and a green system line. **Every value is hardcoded** |
| `executive_dashboard` | `title` + 4 `items`, all `json_encode` | `render_inspector` | **4 JSON blobs** in `<pre>`: Overview, Top Risk Patterns, Pattern Frequency, System Health |
| `brain` | echoes HTML | buffer | 5 inspector cards, each JSON in `<pre>`, plus **literal ``` fences** printed as text (`:107`, `:149`) and a "Run Brain" button that spends live API credit |

**`intelligence_dashboard_module.php` is the clearest case of a screen lying about its own state.** Its own header calls it a *"TEMPORARY MOCK LAYER"* (`:21`) in the function `dashboard_intelligence_engine()` (`:30`), which returns:

```php
$signals = [ 4 hardcoded sentences ];                    // no query, no file, no engine
uic_artifact(..., confidence: 0.78, ...)              // :43-51
uic_dataset(records: [
    ['Active Signals',              12, 'elevated'],
    ['Excavation Streams',           4, 'stable'],
    ['Artifact Library Size',      148, 'growing'],
    ['Recommendation Engine Output', 9, 'active'] ])      // four invented metrics
uic_system("Executive dashboard operational. …")          // :92-94
```

No query, no file, no engine — `:51` sets the confidence to the literal `0.78`. The four numbers are invented and the closing sentence (`:92-94`) asserts the system is operational. On the Command group of the lobby, this sits directly beside `dashboard` (which at least counts real files).

**`brain`'s engine probe looks in a directory that does not exist.** `:78-85` tests `file_exists(__DIR__ . '/../system/cross_case_engine.php')` and four siblings. There is **no `system/` directory** — the engines live in `engine/` (37 files). So all five entries report `false`, and the card renders a JSON block implying the system has no engines at all.

**`cockpit`'s health rows are literals.** `:45` pushes `['label'=>'Database Connection','status'=>'OK','value'=>'Connected']` before any query, and `:47-49` stamps every table count `'status' => 'OK'`. The counts are real; the verdicts are decoration.

---

## 3. CSS: one global file, eight local ones, two unstyled screens

`shell.php:261` is the **only** `<link rel="stylesheet">` in the application: `/commandcenter/ui/global.css`, 1,924 lines. Eight modules then inject their own `<style>` block: `client_view` (`:147`), `cockpit` (`:63`), `dig_review` (`:390`), `payment` (`:321`), `report` (`:144`, `:172`), `vault` (`:98`), `view` (`:44`).

Definitions in `global.css`, by class family the modules actually use:

| Family | Definitions | Verdict |
|---|---|---|
| `srch3-*` (search) | **104** | Fully styled by the global sheet |
| `uic-*` (uic_v1 renderers) | **16** | Styled |
| `sidebar-*` / `lobby-*` / `dashboard-*` / `module-view-*` | 8 / 6 / 2 / 4 | Styled |
| `exec-*` (render_generic, render_dataset, render_list) | 4 | Styled |
| `inspector-*` (JSON dumps) | 5 | Styled — the JSON dumps look intentional |
| `badge-*` | 5 | Styled |
| `ui-card*` / `layout-grid` | 6 / 1 | Styled |
| **`fm-*` (file manager)** | **0** | **Unstyled — and `files_module.php` has no `<style>` block either. The file manager renders as raw HTML** |
| **`pm-*` (project board)** | **0** | **Unstyled. `pm_module.php`'s only `<style>`-looking line is a comment (`:10`). `stat-grid`, `card-title`, `gov-tab`, `pm-board-col`, `success`, `error-msg` are also undefined** |
| `cv-*` / `vault-*` / `cockpit-*` / `pillar-*` | 0 in global, **but defined locally** | Styled by their own blocks |
| **`ui-tabs` (client_view tab bar)** | **0 anywhere** | Unstyled |
| **`layout-grid-three-col` (shell's ingest layout, `:325`)** | **0 anywhere** | Unstyled — the three-column ingest page collapses to a stack |

So the CSS story is coherent for the modules that got attention (search, pm's markup, the UIC renderers) and absent for the two newest screens. `files` is the worst: a full file navigator with a tree, table, toolbar and modal, shipped with no styles at all.

---

## 4. The sidebar's "working" badge is a literal

`shell.php:181` onward:

```php
['key' => 'dashboard', 'title' => 'System Dashboard', 'status' => 'working'],
['key' => 'intelligence_dashboard', 'title' => 'Intel Dashboard', 'status' => 'working'],
['key' => 'executive', 'title' => 'Executive Dashboard', 'status' => 'working'],
… 34 entries, all 'working'
```

The only real gate is `isset($registry[$key])` at `:374` — so nothing in the sidebar ever shows "(Not Yet Working)" unless it is unregistered, and every entry *is* registered. The result: **`payment` (BROKEN, A7-002), `report` (no findings can exist, A7-003/005), `vault` (downloads 404, A6-010) and `graph` (two counts, A5-006) all present as healthy links.** The badge does not measure anything; it is a hard-coded string repeated 34 times.

One registry key never reaches the sidebar at all: **`client_view`** is registered (`module_registry.php:11`) but has no sidebar entry — 35 registry keys against 34 sidebar rows. It is only reachable by hand-typing `?module=client_view&id=N`.

The same pattern appears one level down: `$dashboardGroups` (the Lobby) lists **29 cards** with aspirational descriptions ("Case & client overview", "Executive intelligence overview") that describe intent rather than current behaviour.

---

## 5. Every module — what a person sees today

Branch legend: **HTML** = own markup, **UIC** = `uic_render`, **JSON** = `render_inspector` `<pre>`, **KV** = `exec-panel` key/value, **COUNT** = collapsed to "N records".

| Module | What a person sees today | Branch |
|---|---|---|
| `cockpit` | Greeting, real client/case counts, attention list, diary, health rows all marked OK, 7 pillar tiles | HTML |
| `dashboard` | One "Totals" row containing `{cases, clients}` as two numbers | UIC / JSON-in-list |
| `intelligence_dashboard` | A polished executive card with 4 invented signals and 4 invented metrics | UIC |
| `executive_dashboard` | Four raw JSON blocks: overview, top risks, pattern frequency, health | JSON |
| `brain` | Five JSON cards + two literal ``` lines; engine list all `false`; "Run Brain" spends credit | HTML |
| `pm` | Working List / Board / Projects Board with drag-and-drop — but classes have no CSS | HTML |
| `clients` | List of client records, or a system message when empty | UIC |
| `cases` | Case list as markup | HTML |
| `client_view` | Full client dashboard with tabs; needs `?id=`; tab bar unstyled | HTML |
| `vault` | Per-client report list with a Download link that 404s and a Payment button that errors | HTML |
| `report` | A case dropdown and "Generate PDF Report"; output is a PDF of IDs, or nothing | HTML |
| `payment` | The Exhibit tier price list; every checkout attempt 500s | HTML |
| `excavation` | Excavation run report | UIC (generic) |
| `ingest` | Paste form, upload form, Sessions tab showing "No sessions stored yet" | HTML |
| `ingest_view` | A last-20 list of ingested sessions with platform and date | UIC |
| `files` | A working file tree and viewer with **no stylesheet**, over a root that is the whole app | HTML |
| `search` | A real search box, result list and dual panes; finds transcripts, not entities | HTML |
| `dig_review` | The review queue — always empty, because its INSERT cannot succeed | HTML |
| `insight` | Transcript paste + upload with working flash messages | HTML |
| `graph` | Two numbers: Entities, Relationships | KV |
| `cluster` | "Cluster" heading, an empty paragraph, and a card grid of `page` rows | HTML |
| `semantic_cluster` | "N records" | COUNT |
| `entity_resolution` | Merge candidates | UIC / JSON |
| `relations` | Four JSON blocks (case→client, client→case, case→pattern, co-occurrence) | JSON |
| `root_cause` | One JSON block of nodes and edges | JSON |
| `cross_case_engine` | Three JSON blocks | JSON |
| `anomaly_engine` | A risk score, a level (LOW…CRITICAL), and five counts — legible | KV |
| `recommendation` | A styled list of recommendations, or one fabricated "No Patterns Detected" | UIC |
| `decision` | Two JSON blocks | JSON |
| `predictive` | Three JSON blocks | JSON |
| `predictive_link_module_v1` | "N records" | COUNT |
| `time_intelligence` | One JSON block of 7d/30d trends | JSON |
| `alert` | A few key/value lines from a generic render (`alert` has no UIC handler) | KV |
| `compare` | Dual-pane markup for two documents | HTML |
| `view` | **A whole second HTML document nested inside the shell** — `return ui_page(...)` re-emits `<html>` via `layout.php` | HTML (invalid) |

**38 files exist in `modules/`; 35 are registered.** The three unregistered ones — `001_create_tree_nodes.php`, `build_dossier.php`, `governance_module.php` — are unreachable from the shell, and `governance_module.php` (374 lines, real `<h2>` output) is the only substantial screen that no one can navigate to.

**`view_module.php` is the one module that breaks the contract.** `:264` returns `ui_page("Executive Diff", $body)`, and `ui_page()` (`ui/ui_engine.php:11-33`) requires `layout.php` (`:25`) — a full document with its own `<html>`, `<head>` and stylesheet. `renderModule` returns that string into `.module-view-body`, so the browser receives a second document inside the first. `ui_engine.php`'s header claims it is *"the ONLY place that loads layout.php"*; in practice it is a second, competing layout that the shell never calls.

---

## 6. Defect ledger

| ID | File:line | Defect | Severity |
|---|---|---|---|
| A9-001 | `shell.php:181-250` | `'status' => 'working'` hardcoded on all 34 sidebar entries; only `isset($registry[])` is checked, so BROKEN modules render as healthy | P1 |
| A9-002 | `modules/intelligence_dashboard_module.php:21-95` | Entire screen is mock data — invented metrics, constant `confidence: 0.78`, and a message asserting the system is "operational" | P1 |
| A9-003 | `modules/brain_module.php:78-85` | Engine probe points at `system/` which does not exist; all five engines report `false` (they live in `engine/`, 37 files) | P1 |
| A9-004 | `modules/brain_module.php:107,149` | Two literal ``` fences rendered as page text | P2 |
| A9-005 | `modules/executive_dashboard_module.php:177` | `'engine_state' => 'ACTIVE'` is a literal, not a measurement | P2 |
| A9-006 | `modules/cockpit_module.php:45,49` | Health rows stamped `'status' => 'OK'` before/independently of the query succeeding | P2 |
| A9-007 | `shell.php:67-78` | `exec-panel` collapses every nested array to "N records", discarding computed output | P1 |
| A9-008 | `shell.php:63-65` + six modules | `render_inspector` prints `json_encode` output in `<pre>` — six intelligence screens are JSON dumps by design | P1 |
| A9-009 | `ui/global.css` | `fm-*` (0), `pm-*` (0), `ui-tabs` (0), `layout-grid-three-col` (0) — file manager and project board ship unstyled | P1 |
| A9-010 | `modules/view_module.php:264` → `ui/ui_engine.php:25` | Module returns a complete `ui_page()`, nesting a second `<html>` document inside the shell | P1 |
| A9-011 | `shell.php:3-4` | `display_errors=1` on an unauthenticated page; `catch (Throwable)` at `:80` prints exception messages into the UI | P1 |
| A9-012 | `modules/` | 3 of 38 files unregistered and unreachable, including the 374-line `governance_module.php` | P2 |

---

## 7. Limits

- **No page was rendered in a browser.** Every "what a person sees" line is derived from the module's `return`/output plus the branch it must hit in `shell.php:38-100`. The branch order is unambiguous, but a module that both echoes and returns takes the buffer path — that is noted where it applies.
- CSS findings are class-name presence in `global.css` only. Whether an unstyled screen is *usable* is a judgement, not a measurement; `files`' tree and table will still function without styles.
- `global.css` was searched by prefix, not read line by line; a class defined through a combined selector (`.a, .fm-wrap`) would still match the prefix search, so the 0-results are reliable.
- The counts (34 sidebar entries, 29 lobby cards, 35 registered / 38 files) come from `grep` and the registry file's own text; they were not cross-checked against a running `count()`.
- `build_dossier.php`, `001_create_tree_nodes.php` and `governance_module.php` were identified as unregistered but not audited in this block.
- No source file was modified.

---

### Legend
**Status** — `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD`.
**Severity** — `P0` blocks V1 / security hole · `P1` wrong results · `P2` cosmetic/cleanup.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions proposed.
