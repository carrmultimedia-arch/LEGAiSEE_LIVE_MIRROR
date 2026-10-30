# A5 — Graph, Insight, Brain (S7, S8)

**Date:** 2026-10-29
**Scope:** 12 intelligence modules (`graph`, `cluster`, `semantic_cluster`, `root_cause_graph`, `relations`, `predictive`, `predictive_link_module_v1`, `decision`, `recommendation`, `cross_case_engine`, `anomaly_engine`, `time_intelligence`), the 3 live brain API files (`api/brain_orchestrator.php`, `api/model_router.php`, `api/brain_synthesis.php`), the one reachable engine (`engine/entity_extraction_engine.php`) and `engine/plain_english_helper.php`.
**Method:** every module read to its `return`; the return shape matched against `shell.php`'s render branches (`:59-96`); data sources traced to MySQL or to `data/*.json`; engine coupling proven by grepping each module's `require_once` list; `lee_interpret` coverage matched function by function; `model_router.php` read line by line for outbound calls.
**Inputs:** `schema-source.sql`, `A1-reachability.md`, `A3-data-layer.md`, `A4-ingest-excavation-review.md`.

---

## The answer in one line

**`model_router.php` makes real model calls — genuine `curl` to Anthropic, OpenAI and Gemini, key-gated, with real error handling.** Everything else in this block is thinner than its name: **zero of the twelve modules require a single `engine/` file**, six of them end in a `json_encode()` dumped into a `<pre>`, three return bare arrays that the shell reduces to "N records", and `plain_english_helper.php` — which has a purpose-built interpreter for eight of these screens — is called by nothing.

---

## 1. Where the data comes from

| Source | Modules | Rows available |
|---|---|---|
| MySQL `entities` + `relationships` | `graph`, `semantic_cluster`, `predictive_link_v1`, `anomaly` | 2,433 / 2,721 |
| MySQL `clusters` + `page` | `cluster` | `clusters` 0, `page` 16 |
| `data/cases/*` JSON (`load_json_dir`) | `root_cause_graph`, `relations`, `predictive`, `decision`, `recommendation`, `time_intelligence` | 29 files, some invalid |
| `data/clients/*` + `data/cases/*` JSON | `cross_case_engine` | 25 + 29 files |
| Nothing (no DB, no file) | — | — |

That split is the same one A3 measured: three modules read the live graph in MySQL, six read the JSON layer that holds placeholder clients, and **no module joins the two**. On this data set the six JSON readers are computing over scaffolding while 2,721 real edges sit unused in the database.

**Engine coupling: zero.** Not one of the twelve `require`s anything from `engine/`:

```
graph_module.php                  (no require beyond shell globals)
cluster_module.php                kernel/kernel_boot.php
semantic_cluster_module.php       db.php
root_cause_graph_module.php       modules/utils/bootstrap.php
relations_module.php              modules/utils/bootstrap.php
predictive_module.php             modules/utils/bootstrap.php
predictive_link_module_v1.php     modules/utils/bootstrap.php
decision_module.php               modules/utils/bootstrap.php
recommendation_module.php         modules/utils/bootstrap.php
cross_case_engine.php             (none)
anomaly_engine_module.php         (none)
time_intelligence_module.php      modules/utils/bootstrap.php
```

`engine/` holds 37 files; exactly **one is reachable** (`engine/entity_extraction_engine.php`, via excavation and prospect). The engines named for these screens — `system_insight_engine.php`, `recommendation_engine.php`, `decision_engine_v2.php`, `semantic_cluster_engine.php`, `cross_case_engine.php`, `predictive_intelligence_engine.php`, `policy_enforcement_engine.php` — are unreachable, and the screens do their own inline arithmetic instead.

---

## 2. Render path per module — the exact branch

`shell.php` has four branches for a module's return value (`:59-96`): a non-empty output buffer wins; then `is_string`; then an array with `type` → `uic_render()`; then `title` + `items` → `render_inspector()` (a `<pre>` per item); otherwise a key/value `exec-panel`, where **any nested array is collapsed to `count() . ' records'`** (`:78-80`).

| Module | Return value | Shell branch | What the operator actually sees | `lee_interpret_*` available? |
|---|---|---|---|---|
| `graph` | `['Entities'=>2433,'Relationships'=>2721]` (`:114`) | `exec-panel` | **Two numbers.** The BFS traversal (`GraphModule::query`, `:8`) is unreachable from the shell — only via `?start_entity=` through the standalone guard at `:101` | ✅ `lee_interpret_graph` (`:88`) |
| `cluster` | emits HTML directly (`:18-26`) | buffer wins | **Real HTML**: an `<h2>`, a paragraph, and a card grid of `page` rows | ✅ `lee_interpret_cluster` (`:210`) |
| `semantic_cluster` | `['clusters'=>[…],'total_clusters'=>n]` (`:223`) | `exec-panel` | **"N records"** — every computed cluster discarded by the shell | ⚠️ none (closest: cluster) |
| `predictive_link_v1` | `['predicted_links'=>[…],'total_predictions'=>n]` (`:181`) | `exec-panel` | **"N records"** — the ranked predictions are dropped | ⚠️ none |
| `root_cause_graph` | `title`/`type`/`items` with `json_encode(['nodes'=>…,'edges'=>…])` (`:163-174`) | `render_inspector` | **JSON dump** in `<pre>` | ✅ maps to `lee_interpret_graph` |
| `relations` | `title`/`type`/4 items, each `json_encode` (`:184-213`) | `render_inspector` | **JSON dump** ×4 | ✅ `lee_interpret_relations` (`:59`) |
| `predictive` | `title`/`items`, `json_encode` (`:149-172`) | `render_inspector` | **JSON dump** ×3 | ⚠️ none |
| `decision` | `title`/`items`, `json_encode` (`:197-214`) | `render_inspector` | **JSON dump** ×2 | ⚠️ none |
| `cross_case_engine` | `title`/`type`/3 items, `json_encode` (`:151-175`) | `render_inspector` | **JSON dump** ×3 | ✅ `lee_interpret_cross_case` (`:235`) |
| `time_intelligence` | `title`/`items`, `json_encode($trends)` (`:108-119`) | `render_inspector` | **JSON dump** | ✅ `lee_interpret_time_intelligence` (`:258`) |
| `anomaly` | `['risk_score'=>…,'risk_level'=>'LOW|MODERATE|HIGH|CRITICAL', counts…]` (`:70-77`) | `exec-panel` | **Readable numbers** — the only module whose primary output is legible without training | ✅ `lee_interpret_anomaly` (`:123`) |
| `recommendation` | `['type'=>'list','title','items'=>[{title,meta,content}]]` (`:45-48`) | `uic_render` | **Real list HTML** — the only module that renders as designed UI | ✅ `lee_interpret_recommendation` (`:180`) |

**Tally:** real HTML **2** (`cluster` static, `recommendation` list) · readable numbers **1** (`anomaly`) · count-only **3** (`graph`, `semantic_cluster`, `predictive_link_v1`) · JSON dump **6** (`root_cause`, `relations`, `predictive`, `decision`, `cross_case`, `time_intelligence`).

Two of the three count-only modules compute real work and then have it discarded by `shell.php:78-80` — that is a render-layer defect, not a logic defect.

---

## 3. `plain_english_helper.php`

Eleven public functions: a dispatcher (`lee_interpret`, `:24`), a block wrapper (`lee_interpret_block`, `:35`), and interpreters for `relations`, `graph`, `anomaly`, `insight`, `recommendation`, `cluster`, `cross_case`, `time_intelligence`, plus a `generic` fallback.

**It applies to 8 of the 12 modules by function name — and is invoked by none.** The only occurrences of `lee_interpret` in the whole tree are inside its own file (the definition, the dispatcher's string concatenation at `:25`, and the docblock example at `:10-11`). Nothing `require`s it; A1 proved zero references.

So the answer to *"does plain_english_helper apply"* is: **it is applicable and unused.** Every JSON dump and every bare count in §2 is exactly the output this file was written to replace — for example `lee_interpret_graph(['entities'=>2433,'relationships'=>2721])` would return a sentence about network density, while the screen currently prints two integers. This is the single highest-value unwired file in the tree.

---

## 4. `model_router.php` — real calls, or scaffolding?

**Real.** Each provider is a genuine `curl` POST to the vendor endpoint, key-gated before the call:

| Provider | Endpoint (`:line`) | Key constant | Behaviour without key |
|---|---|---|---|
| Claude | `https://api.anthropic.com/v1/messages` (`:34`) | `CLAUDE_API_KEY` (`:19`, `:42`) | returns `not_configured` |
| OpenAI | `https://api.openai.com/v1/chat/completions` (`:97`) | `OPENAI_API_KEY` (`:79`) | returns `not_configured` |
| Gemini | `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-pro:generateContent` (`:158-160`) | `GEMINI_API_KEY` (`:137`) | returns `not_configured` |

Each sets `CURLOPT_RETURNTRANSFER`, `CURLOPT_POST`, a JSON body, the right auth header, `CURLOPT_TIMEOUT => 60`, then distinguishes curl errors, non-200 responses (surfacing the vendor's own `error.message`) and unexpected response shapes. `route_models()` (`:206-212`) fans out to all three and returns `['claude'=>…, 'openai'=>…, 'gemini'=>…]`.

Because `config.local.php:12` defines `CLAUDE_API_KEY`, **Claude is live today**; OpenAI and Gemini have working code paths (`:97`, `:158`) that return `not_configured` only because those keys are absent, and `brain_synthesis.php:31-38` reports them honestly in `models_unavailable`.

One drift worth recording: the file's own header (`:13-14`) says *"Currently configured: Claude only. Scaffolded, ready to activate: OpenAI, Gemini"* — but the OpenAI and Gemini functions are fully implemented curl calls, not stubs. The comment understates the code. `route_models()` therefore makes one real call today and is ready to make three.

Two caveats that are not modelled-call failures but do affect whether it works: model identifiers `claude-sonnet-4-6` (`:27`) and `gpt-5` (`:91`) cannot be verified offline — if either is not a published id, that provider returns HTTP 400 and the UI shows the vendor's message (the code handles it correctly, the call simply fails); and there is no prompt-size guard anywhere (`:34-38` embeds the whole file, output capped at 1024 tokens at `:28`).

---

## 5. File table

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `modules/graph_module.php` | `GraphModule::query()` — BFS over `relationships` from a start entity | WORKS-WITH-DEFECT | A5-006 `:114` shell mode returns only `Entities`/`Relationships` counts, so the traversal at `:8` is unreachable from the UI (standalone guard `:101`) | Render the ranked paths, or link to the standalone form | P1 |
| `modules/cluster_module.php` | Single cluster view: heading + `page` rows for `?id=` | WORKS-WITH-DEFECT | A5-005 `:18` and `:20` read `$cluster['name']` / `$cluster['summary']`; `clusters` is `(id, case_id, label, members, score, created_at)` — no `name`, no `summary`, so the title falls back to "Cluster" and the paragraph is empty (the `page` join at `:13` is valid) | Read `label`/`members` and format them | P1 |
| `modules/semantic_cluster_module.php` | Similarity clustering over all entities + relationships, optional `clusters.json` write | WORKS-WITH-DEFECT | A5-008 `:223-225` returns `['clusters'=>…,'total_clusters'=>n]` → shell prints "N records"; `SELECT *` of 2,433 + 2,721 rows every load (`:24`, `:31-33`) | Return `title`/`items` with rendered cluster text | P1 |
| `modules/root_cause_graph_module.php` | Builds a clustered root-cause graph from case JSON | WORKS-WITH-DEFECT | A5-007 `:163-174` `json_encode` into `render_inspector` → JSON in `<pre>`; writes `network.json` at `:149` | Render nodes/edges as HTML, or use the graph view | P1 |
| `modules/relations_module.php` | Case→client, client→case, case→pattern, pattern co-occurrence | WORKS-WITH-DEFECT | A5-007 `:184-213` four `json_encode` dumps; writes `insights.json` at `:154` (A3-008) | Render tables; migrate to `cases`/`clients` | P1 |
| `modules/predictive_module.php` | Pattern transition probabilities per case | WORKS-WITH-DEFECT | A5-007 `:149-172` JSON dumps; reads `data/cases` only (A3-008) | Render text; read MySQL | P1 |
| `modules/predictive_link_module_v1.php` | Predicted entity links from graph degree/strength | WORKS-WITH-DEFECT | A5-008 `:181-183` returns arrays → "N records"; `SELECT *` on both graph tables per load (`:24`, `:30`) | Return `title`/`items` | P1 |
| `modules/decision_module.php` | Per-case decisions + global priorities | WORKS-WITH-DEFECT | A5-007 `:197-214` JSON dumps; `data/cases` only | Render text; read MySQL | P1 |
| `modules/recommendation_module.php` | Recommendation list from case signals | WORKS-WITH-DEFECT | A5-010 `:38-44` injects a hard-coded "No Patterns Detected / Run excavation pipeline" item that renders as if it were a finding | Return an empty state, not a fake item | P2 |
| `modules/cross_case_engine.php` | Client→case map, industry clusters, cross-case links | WORKS-WITH-DEFECT | A5-007 `:151-175` JSON dumps; reads only `data/` JSON (`:15-18`) | Render text; read MySQL | P1 |
| `modules/anomaly_engine_module.php` | Orphan/hub/weight/alias/contradiction detection → risk score | WORKS | A5-012 `:58-68` magic weights (1.2/2.0/1.5/2.5/3.0) and thresholds (30/150) with no rationale — reproducible, but unvalidated | Keep; document the weights | P2 |
| `modules/time_intelligence_module.php` | 7d/30d trend baselines from case JSON | WORKS-WITH-DEFECT | A5-007 `:108-119` JSON dump; `data/cases` only | Render text; read MySQL | P1 |
| `api/model_router.php` | Real multi-provider model calls (Claude/OpenAI/Gemini) | WORKS | A5-011 `:27`,`:91` model ids unverifiable offline; no prompt-size cap (60s timeout at `:45`,`:107`,`:169`) | Verify ids; truncate input | P2 |
| `api/brain_orchestrator.php` | `run_brain_on_file()` — read a normalized file, prompt all models, synthesise | WORKS-WITH-DEFECT | A5-003 `:60-68` standalone branch is an unauthenticated paid-API endpoint; `:34-38` no size cap | Gate on auth; truncate | P0 |
| `api/brain_synthesis.php` | Merges provider outputs into one insight + confidence | WORKS-WITH-DEFECT | A5-004 `:48` and `:54` set confidence to the constants 70 (single-model) and 75 (multi), presented as a computed score; there is no agreement test anywhere in the file | Compute agreement, or label it as a fixed weight | P1 |
| `engine/entity_extraction_engine.php` | The one reachable engine — entities/aliases/relationships to MySQL | WORKS-WITH-DEFECT | A4-010 `:42` client names in the noise list (carried forward) | Remove them | P1 |
| `engine/plain_english_helper.php` | 11 functions that turn these modules' numbers into sentences | DEAD | A5-009 zero references (only its own docblock at `:10-11`) | Wire into the shell's render path | P1 (highest value) |

---

## 6. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A5-001 | — | *(reserved: no P0 found in module logic itself; the P0 is A5-003)* | — | — |
| A5-002 | — | *(reserved)* | — | — |
| A5-003 | `api/brain_orchestrator.php:60-68`; `modules/brain_module.php:20-26` | `run_brain_on_file()` is reachable unauthenticated by direct URL and by `?module=brain` POST, so anyone can spend paid Claude credits on any file in `normalized/` | P0 | V1 |
| A5-004 | `api/brain_synthesis.php:44,48,54` | `confidence` is a hard-coded 0/70/75 presented as a score; no cross-model agreement test exists | P1 | Trust in output |
| A5-005 | `modules/cluster_module.php:18,20` | Reads `clusters.name` and `clusters.summary`; the table has `label`, `members`, `score` — heading degrades to "Cluster", summary to empty | P1 | Cluster screen |
| A5-006 | `modules/graph_module.php:114` | Shell mode returns two counts; the actual traversal (`:8`) is unreachable from the UI | P1 | Graph screen |
| A5-007 | `root_cause:163-174`, `relations:184-213`, `predictive:149-172`, `decision:197-214`, `cross_case:151-175`, `time_intelligence:108-119` | Six modules end in `json_encode()` rendered inside `<pre>` — the operator reads raw JSON, not intelligence | P1 | Six screens |
| A5-008 | `semantic_cluster:223-225`, `predictive_link_v1:181-183` | Return bare arrays; `shell.php:78-80` collapses every nested array to "N records", discarding the computed result entirely | P1 | Two screens |
| A5-009 | `engine/plain_english_helper.php` (whole file) | Zero references; interpreters exist for 8 of these 12 modules and none is called | P1 | All output legibility |
| A5-010 | `modules/recommendation_module.php:38-44` | Hard-coded fallback item ("No Patterns Detected", "Run excavation pipeline") renders as a real recommendation | P2 | — |
| A5-011 | `api/model_router.php:27,91` | Model ids (`claude-sonnet-4-6`, `gpt-5`) cannot be verified offline; no prompt-size cap, so a large normalized file 400s or over-spends | P2 | Brain runs |
| A5-012 | `modules/anomaly_engine_module.php:58-68` | Risk weights and thresholds are unexplained magic numbers; the score is reproducible but unvalidated | P2 | — |

*(A5-001 and A5-002 are deliberately left unassigned rather than renumbered — the sequence stays stable for later blocks.)*

---

## 7. Limits

- **No model call was made.** "Real calls" is a reading of the code: genuine `curl_init` against the three vendor endpoints, with the key gate before it. Whether `claude-sonnet-4-6` and `gpt-5` are valid ids at the time of reading could not be confirmed offline — if they are not, the code is correct and the provider returns 400.
- Render paths are derived from `shell.php`'s four branches plus each module's `return`; they were not observed in a browser. A module that also echoes before returning would take the buffer branch instead — `cluster` is the only one in this set that does.
- `page.cluster_id` was checked and **exists** (used correctly at `cluster_module.php:13`); only the `clusters` column mismatch in A5-005 is asserted.
- The six JSON-reading modules were judged on data *source* (A3 already proved the JSON layer holds placeholder clients); how each computes over it was read only far enough to establish the return shape.
- `engine/*` reachability is inherited from A1's graph, not re-derived.
- No source file was modified in this block.

---

### Legend
**Status** — `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD` (`00-GROUND-RULES.md` §5).
**Severity** — `P0` blocks V1 / security · `P1` wrong or unreadable results · `P2` hygiene.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions.
