# LEGAiSEE — CONSOLIDATED AUDIT DATA

Every audit document from the project, in one file, in original wording. Generated 2026-10-29 from the three governance stores plus the machine inventories. Nothing was edited, summarised or reordered beyond grouping and normalizing three legacy-encoded inventory files to UTF-8.

**How to read this:** each entry carries its original source path so any claim can be traced back to the file it came from. Section A is the most recent full-stack sweep (Sep 2026) and is the freshest description of the system. Section B is the Aug 2026 micro-audit series that A partly supersedes. Section C is the capability/wiring audit ladder — Pass 10 is the latest and supersedes Passes 4-9. Section D is raw evidence (file inventories, tree dumps, an older system audit report).

**Useful context:** every audit here predates the Oct 2026 migration work order (`WORKORDER-JSON-SQLite-to-MySQL.md`), so their JSON/SQLite findings are the historical record of why that ticket exists, not the current state.

**Corpus integrity — read before citing.**

1. **Three audits were named but never written.** These files exist at 0 bytes, so the areas they cover are *unaudited*, not audited-and-clear:
   - `LEGAiSEE System Audit — api Top-Level non-v8.md` → the ~45 non-v8 `api/` endpoints were never read.
   - `LEGAiSEE System Audit — modules-utils-bootstrap.md` → `modules/utils/bootstrap.php`, which the kernel audit identifies as load-bearing for the live Recommendation logic, was never opened.
   - `LEGAiSEE System Audit — modules-utils-bootstrap-the Recommendation Module Question.md` → the open question of which of the three Recommendation implementations is live was never resolved.
2. **`SYSTEMAUDITREPORT.md` (Section D) is not a trustworthy audit of this codebase.** It cites names that appear nowhere in the project (`module1.php`, `module2.php`, `table2`-`table5`, a `domains` table with rows "Oceanic"/"Mountain") and invented row counts (`projects` 1,200, `clients` 890, `cases` 3,450). It was evidently produced without reading the code, and is kept only so the record is complete — do not cite it as evidence.
3. **Duplicate checklists, both kept:** `8-26-26_Legaisee Audit Checklist.md` and `8-26-262_Legaisee Audit Checklist.md` are two versions of the same document (18,034 vs 18,036 bytes, 2 diff lines). Both included rather than deduplicated.

## Contents

### A. System Audit Series — full-stack sweep (Sep 2026)

| # | Document | Bytes | Lines |
|---|---|---|---|
| 1 | LEGAiSEE Full System Audit — Master Checklist.md | 5146 | 147 |
| 2 | LEGAiSEE System Audit Backend Layer.md | 8944 | 48 |
| 3 | LEGAiSEE System Audit — 51 Top-Level Standalone Files.md | 5596 | 30 |
| 4 | LEGAiSEE System Audit — Brain Dashboard.md | 2993 | 19 |
| 5 | LEGAiSEE System Audit — Command Sidebar Section.md | 4556 | 42 |
| 6 | LEGAiSEE System Audit — Final Small Folders.md | 3546 | 21 |
| 7 | LEGAiSEE System Audit — Graph & Entities Sideba….md | 6694 | 53 |
| 8 | LEGAiSEE System Audit — Intelligence Engines Si….md | 8167 | 58 |
| 9 | LEGAiSEE System Audit — Planning, Clients & Cases….md | 6044 | 54 |
| 10 | LEGAiSEE System Audit — ProjectManager.md | 5985 | 26 |
| 11 | LEGAiSEE System Audit — api Top-Level non-v8.md | 0 | 0 |
| 12 | LEGAiSEE System Audit — kernel.md | 6985 | 34 |
| 13 | LEGAiSEE System Audit — modules-utils-bootstrap-the Recommendation Module Question.md | 0 | 0 |
| 14 | LEGAiSEE System Audit — modules-utils-bootstrap.md | 0 | 0 |
| 15 | LEGAiSEE System Audit — ui Rendering Layer.md | 6403 | 34 |
| 16 | LEGAiSEE — Brain Cluster Micro-Audit.md | 7735 | 124 |
| 17 | LEGAiSEE — MASTER PREFACE_9-3-26_PROJECT BOOTSTRAP-FULL.md | 16867 | 472 |
| 18 | LEGAiSEE — What the Orphaned Engine Files Actuall….md | 8270 | 50 |

### B. Claude Memory — micro-audits, checklists, state (Aug 2026)

| # | Document | Bytes | Lines |
|---|---|---|---|
| 19 | 8-24-26_Legaisee Master System Law.md | 12687 | 64 |
| 20 | 8-24-26_Legaisee Ui Micro Audit.md | 7056 | 33 |
| 21 | 8-24-26_Legaisee Brain Micro Audit.md | 11949 | 42 |
| 22 | 8-25-26_Legaisee Kernel Micro Audit.md | 8228 | 36 |
| 23 | 8-25-26_Legaisee Api Toplevel Audit.md | 4213 | 19 |
| 24 | 8-25-26_Legaisee Modules Micro Audit.md | 11374 | 43 |
| 25 | 8-25-26_Legaisee Pages Micro Audit.md | 4075 | 22 |
| 26 | 8-25-26_Legaisee Toplevel Dirs Micro Audit.md | 11410 | 42 |
| 27 | 8-25-26_Legaisee Engine Micro Audit.md | 12517 | 45 |
| 28 | 8-26-26_Legaisee Audit Checklist.md | 18034 | 52 |
| 29 | 8-26-262_Legaisee Audit Checklist.md | 18036 | 53 |
| 30 | 8-26-26_Legaisee Loose Scripts Audit.md | 15411 | 34 |
| 31 | 8-26-26_Legaisee Recovery Roadmap.md | 13123 | 28 |
| 32 | 8-26-26_Legaisee Current State.md | 12941 | 50 |
| 33 | 8-27-26_Legaisee Work Orders.md | 11213 | 35 |

### C. Capability + Wiring Audits — Passes 4-10 (Business Plan)

| # | Document | Bytes | Lines |
|---|---|---|---|
| 34 | 005_LEGAiSEE OM_PART 5 — EXISTING COMMAND CENTER CAPABILITY AUDIT.md | 30171 | 606 |
| 35 | 006_LEGAiSEE_PART 5B — EXISTING COMMAND CENTER CAPABILITY AUDIT v2.md | 15042 | 282 |
| 36 | 007_LEGAiSEE Wiring Audit-Pass 4.md | 15993 | 269 |
| 37 | 008_LEGAiSEE Wiring Audit-Pass 5.md | 14295 | 276 |
| 38 | 010_LEGAiSEE Wiring Audit-Pass 6.md | 11631 | 256 |
| 39 | 011_LEGAiSEE Wiring Audit-Pass 7.md | 13458 | 280 |
| 40 | 012_LEGAiSEE Wiring Audit-Pass 8.md | 13803 | 317 |
| 41 | 013_LEGAiSEE Wiring Audit-Pass 9.md | 10528 | 196 |
| 42 | 014_LEGAiSEE Wiring Audit-Pass 10.md | 13813 | 229 |

### D. Machine inventories + system audit report

| # | Document | Bytes | Lines |
|---|---|---|---|
| 43 | SYSTEMAUDITREPORT.md | 4267 | 118 |
| 44 | inventory.txt | 125257 | 811 |
| 45 | full_inventory3.txt | 62692 | 807 |
| 46 | tree.txt | 31971 | 1028 |
| 47 | OS Contents.txt | 5266 | 100 |
| 48 | +Legaisee-gpt audit sys.md | 5167 | 250 |


---

# A. System Audit Series — full-stack sweep (Sep 2026)


<a id="doc-1"></a>
## 1. LEGAiSEE Full System Audit — Master Checklist.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE Full System Audit — Master Checklist.md` · 5146 bytes · 147 lines · encoding normalized to UTF-8*

LEGAiSEE Full System Audit — Master Checklist
Purpose: Track macro-audit coverage of the entire ~1,243-file codebase across sessions, since sessions have hit chat limits mid-audit before. Read this first at the start of any audit session to see exactly where to resume.
Standard for "audited": not "does the PHP execute" — does it connect to real data/other modules, and can a human read the result. Files just "connectivity-checked" (grep for references) but not read line-by-line are marked separately from fully read files.
Output location: each completed section becomes its own file, named LEGAiSEE_System_Audit_<Section>.md, saved to Google Docs by John.

✅ DONE — Fully audited (contents read, findings documented)
Area
Files
Output file
Key finding
Sidebar: Graph & Entities
7
LEGAiSEE_System_Audit_Graph_Entities.md
Network Graph shows counts only; real graph data exists but unwired
Sidebar: Excavation
6
LEGAiSEE_System_Audit_Excavation.md
Ingest file-upload has confirmed silent-failure bug
Sidebar: Intelligence Engines
7
LEGAiSEE_System_Audit_Intelligence_Engines.md
Insight = mis-wired Ingest duplicate; Predictive Link V1 output destroyed by renderer
Sidebar: Command
5
LEGAiSEE_System_Audit_Command.md
uic_v1.php (good renderer) exists, barely used
Sidebar: Planning, Clients & Cases, Tools + whole-sidebar summary
~12
LEGAiSEE_System_Audit_Planning_Clients_Tools_and_Summary.md
Compare module is a stub; real compare_engine.php orphaned
engine/ (all 36-37 files)
37
LEGAiSEE_System_Audit_Backend_and_Orphaned_Systems.md (connectivity) + LEGAiSEE_Orphaned_Engine_Files_Explained.md (deep-dive on the 15 orphaned ones)
plain_english_helper.php = ready-built unused fix; 15 files form a real unfinished autonomous-agent pipeline
api.php, api/v8/ (connectivity only, not line-read)
30
LEGAiSEE_System_Audit_Backend_and_Orphaned_Systems.md
Entirely unreachable — api.php has zero callers
cli/ (connectivity only)
9
same
Only reachable via orphaned index.php prototype
index.php (read + live-tested)
1
same
Separate abandoned prototype, still directly reachable by exact URL
ExcavationCommand/ (connectivity only)
3
same
Zero references anywhere — fully orphaned
ProjectManager/ (connectivity only — confirmed disconnected, contents NOT read)
88
same
Zero live wiring from shell.php/modules; internal contents still unknown


kernel/
21
Core plumbing — db connection, bootstrap, module registry. HIGH PRIORITY — everything else depends on this layer, and it's already ground zero for the SQLite/MySQL migration bug.


51 top-level standalone PHP files
51
Mixed bag — some clearly load-bearing (bootstrap.php, config.php, db.php, shell.php, graph_view.php, prospect.php), some clearly test/debug clutter (test_*.php ×8, peek.php, diagnostics2.php, temp_dashboard.php), several genuinely unknown purpose (ai_process.php, dossier_v2.php, intelligence.php, mission.php, response.php, indexer.php, parser.php, semantic_engine.php, excavation_engine.php, cluster_engine.php — note: possible top-level duplicates of same-named engine/ files, worth checking for the Insight/Ingest-style duplicate-conflict pattern).


ui/
19
The rendering engine itself, including the already-found orphaned compare_engine.php.
api/ (top-level, non-v8)
~45 remaining unread
Only search_load.php and files_action.php confirmed live so far — the other ~45 files' purpose/connectivity unknown.
ProjectManager/ internals
88
Connectivity confirmed dead from outside, but never opened — could contain its own working sub-system, orphaned engines, or duplicate bugs worth knowing about even if not linked in yet.
components/
6
Unknown purpose, not yet opened.
database/
2
Unknown purpose, not yet opened.


Running total fully/partially covered: ~185 of 1,243 files (~15%)

⬜ NOT YET STARTED — contents unread
Area
File count
Notes / why it matters










































_backup/
1
Old backup file(s) — likely just historical, low priority.

Remaining: ~1,058 files not yet opened

Recommended next-session order (highest leverage first)
kernel/ (21 files) — foundational, everything else sits on top of it.
Triage the 51 top-level standalone files — sort into load-bearing / test-clutter / genuinely unknown, then only deep-read the unknowns.
ui/ (19 files) — the rendering layer, directly relevant to the presentation-gap finding already established.
api/ top-level (45 unread files) — likely more real endpoints like search_load/files_action, worth confirming which are live.
ProjectManager/ internals (88 files) — biggest remaining chunk; open once the smaller/higher-leverage areas are done.
components/, database/, _backup/ — small, likely low-risk, quick to close out.

Update this table (and the full narrative in [[legaisee-command-center]]) at the end of every audit session — mark completed rows, move rows from "not started" to "done," and update the running totals — so resuming after a chat-limit cutoff starts here, not from scratch.




<a id="doc-2"></a>
## 2. LEGAiSEE System Audit Backend Layer.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit Backend Layer.md` · 8944 bytes · 48 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit Backend Layer
Audit type: Macro / system-level, backend this time — not "what's in the UI," but what code actually exists, what calls it, and if nothing does, why not.
Method: for every file in these directories, checked whether any other file in the entire 1,243-file codebase references it at all. Zero references = genuinely dead code, not just "not in the sidebar."

THE HEADLINE FINDING
The codebase is not one system with some rough edges — it's at least three separate, mostly non-communicating systems layered on top of each other, plus a large body of never-connected speculative code. This is the real answer to "why does the system feel bigger than what I can see": most of its size isn't live surface area at all.
The real, live system — shell.php + modules/ (39 files, already fully audited) + a working slice of engine/ and kernel/ underneath it.
An abandoned earlier prototype — index.php, a self-labeled <!--TEST--> "LEGAiSEE Control Center UI" that reads/writes its own flat JSON files directly (bypassing the MySQL database entirely), separate from everything shell.php does.
A large, ambitious, never-wired "autonomous AI agent" architecture — goal-setting, planning, governance, and self-directed execution code that appears to have been designed but never connected to anything that runs.

engine/ — 36 files: 15 are completely dead, several more only reachable through other dead files
Checked every file for real references anywhere in the codebase (not just the sidebar). Result:
Zero references anywhere — fully orphaned: cross_case_learning_compiler.php, decision_governor.php, execution_feedback_engine.php, executive_dashboard_engine.php, goal_alignment.php, goal_engine.php, goal_generator.php, governance_policy_engine.php, graph_mutation_engine.php, insight_mutator.php, long_horizon_planner.php, pattern_stability.php, plain_english_helper.php, system_behavior_spec.php, temporal_memory_engine.php
Referenced only by other dead files (so also effectively dead):
goal_arbitration_engine.php and goal_conflict_resolver.php — only called by goal_engine.php, which is itself dead.
memory_evolution_engine.php — only called by executive_dashboard_engine.php (NOT the real, live modules/executive_dashboard_module.php — a different file with a near-identical name), which is itself dead.
case_manager.php, client_manager.php — only called by create_test_data.php, a data-seeding script, not the live app.
graph_data.php — only called by test_graph.php, a test file.
Reachable only through cli/ or api/v8/, which are themselves not called from the live web app (see below): execution_router.php (via kernel/engine_bindings.php, itself orphaned), pipeline_adapters.php and predictive_intelligence_engine.php (via cli/worker.php), graph_engine.php (via api/v8/build_graph.php).
Genuinely wired into the live system: entity_extraction_engine.php (confirmed already, powers Dig Review/Excavation), cluster_engine.php, cross_case_engine.php, recommendation_engine.php, system_insight_engine.php, decision_engine_v2.php, policy_enforcement_engine.php, portfolio_engine.php, semantic_cluster_engine.php, system_recommendation_engine.php, dashboard_engine.php, reasoning_engine.php.
What the dead cluster actually was trying to be, based on file names alone: a full autonomous-agent system — goals get generated (goal_generator), arbitrated against each other (goal_arbitration_engine), checked for conflicts (goal_conflict_resolver) and alignment (goal_alignment), planned over a long horizon (long_horizon_planner), governed by policy (governance_policy_engine, decision_governor), executed (execution_router, execution_feedback_engine), and the system's own memory evolves over time (memory_evolution_engine, temporal_memory_engine). This is a coherent, ambitious design for a self-directing system — and none of it runs today.

api/ vs. api/v8/ — two different things wearing the same name
Top-level api/ (not v8): search_load.php and files_action.php are confirmed real and live — Search and Files modules call them directly via JavaScript fetch(). This part is genuinely working backend infrastructure.
api.php (a single top-level router file with a legacy() wrapper) — checked every file in the codebase for anything that calls it: nothing does. It has zero callers.
api/v8/ (29 files — insights.php, compressor.php, graph_ranker.php, predictor.php, dossier_v2.php, memory_store.php, agent.php, create_network.php, run_worker.php, and more) is only reachable through api.php's legacy() wrapper — which, per the above, nothing calls. The entire api/v8/ directory is dead code, unreachable from the live site.
cli/ — 9 files, reachable only through the abandoned prototype
meta_goal_engine.php, chain_evolver.php, event_worker.php, autonomous_run.php, chain_generator.php, graph_scheduler.php, worker.php, reasoning_engine.php (a different file from engine/reasoning_engine.php), and a second, different goal_engine.php.
The only thing in the entire codebase that calls into cli/ is index.php — the abandoned prototype (see below) — via a ?run_worker=1 URL parameter that runs shell_exec("php cli/worker.php"). Nothing in the live shell.php/modules/ system touches cli/ at all. I found no cron-job reference in the code confirming whether anything on the server schedules these — that's a live-server question (cPanel's Cron Jobs page), not something visible from the codebase.
index.php — a second, abandoned entry point, still possibly reachable
This is a real finding worth flagging clearly: index.php is a completely separate system from shell.php. It's explicitly labeled <!--TEST--> in its own opening comment. It reads and writes its own flat JSON files under data/portfolio/ and data/clients/ — bypassing the MySQL database that every real module you use relies on. It also contains that ?run_worker=1 trigger described above.
Why this matters practically: index.php is the standard default filename a web server loads when someone visits a folder URL with nothing after it. I checked the site's .htaccess file and found no rule redirecting the bare URL to shell.php — meaning it's plausible that visiting your site's folder root (rather than the shell.php?module=... URLs you actually use) could still serve this old prototype instead of the real system. This needs a live check, not something I can confirm from the code alone — worth visiting your site's bare root URL (no shell.php, no ?module=) and telling me what loads.
ExcavationCommand/ (3 files) — confirmed fully orphaned
Checked every file in the codebase: nothing references ExcavationCommand/ at all. Whatever this was (a second dashboard/planner prototype, per its file names), it's completely disconnected from the live system today.
ProjectManager/ (88 files) — confirmed structurally disconnected, not just "not working yet"
This matches what's already on record as "confirmed NOT working yet" — but the audit adds a sharper finding: nothing in shell.php or modules/ links to it at all. It's not a working feature with bugs; it's a fully separate 88-file sub-application with no live entry point from anywhere you actually navigate.

What this means, plainly
Of the roughly 1,243 PHP files in the codebase, a very large share — the 15+ dead engine/ files, all 29 api/v8/ files plus api.php, all 9 cli/ files, index.php's entire prototype, the 3 ExcavationCommand/ files, and the 88 ProjectManager/ files — are not part of the system you actually use. That's real weight contributing to "I don't know what's working anymore" that has nothing to do with bugs — it's inventory that was never live, or was superseded and left behind.
The live system is meaningfully smaller than the codebase suggests: shell.php, the 39 modules/ files, the working slice of engine/ (about a dozen files) and kernel/, plus api/search_load.php and api/files_action.php.
Real open questions this raises (not fixes yet, per your instruction — just what needs a decision)
Does anything on the live server actually run cli/worker.php on a schedule (cron)? Can't tell from code — needs a look at cPanel's Cron Jobs page.
Does the bare site URL (no shell.php) serve index.php's old prototype? Needs a live look.
Is the ?run_worker=1 trigger on index.php still reachable by anyone who knows the URL, with no login check visible in the code I read? Worth a direct look at whether that file requires authentication at all.
ProjectManager/ and ExcavationCommand/ — are these meant to be revived, or are they safe to formally retire? That's a scope decision, not a bug.

This completes the backend layer. Combined with the 5 earlier files, the audit now covers: all 7 shell.php sidebar sections (~30 modules), the engine/kernel logic layer, and the orphaned/parallel systems (api/v8, cli/, index.php, ExcavationCommand, ProjectManager).




<a id="doc-3"></a>
## 3. LEGAiSEE System Audit — 51 Top-Level Standalone Files.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — 51 Top-Level Standalone Files.md` · 5596 bytes · 30 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — 51 Top-Level Standalone Files
Audit type: Macro/system-level — real connections, not "does it execute."

THE PATTERN
Checked every file in this group for real references anywhere in the codebase. Almost all of them — roughly 40 of 51 — have zero references from anywhere. This isn't scattered coincidence: most of them share one thing in common — they all pull in the same file, lib/semantic_diff_engine.php (245 lines) — which is itself never referenced by anything in the live system either. This is a third disconnected island, alongside the old index.php prototype and the api/v8/cli/engine-goal cluster already found: a set of standalone experimental tools built around a shared library, none of it wired into shell.php.
Files confirmed genuinely dead (zero references anywhere)
ai_process.php, create_review_flags.php, create_session.php, diagnostics2.php, dossier_v2.php, embed_generate.php, export_report.php, intelligence.php, legaisee_prospects.php, load_module.php, load_sets.php, mission.php, parser.php, peek.php, save_set.php, saved_views.php, search_dual.php, semantic_engine.php, session.php, setup.php, view_file.php
Files with 1-2 references (effectively still isolated — referenced only within this same dead cluster)
excavation_engine.php, files.php, indexer.php, temp_dashboard.php, view_ingest.php, cluster_engine.php
The one real, reused utility in this group
response.php (7 references) — a clean "API Response Contract Guard" (json_response()), meant to standardize how API endpoints return JSON so the UI doesn't crash on bad responses. This is genuinely good practice and actually gets reused — worth keeping regardless of what happens to the rest.

Two things worth flagging directly, not just "orphaned"
setup.php — a public "Initialize Database" script that creates a SQLite database (legaisee.db) via SQLite3. This is a leftover from before the SQLite→MySQL migration already on record. It's disconnected from anything today, but if it were ever hit directly by URL, it would create a stray SQLite file, unrelated to the real MySQL database everything else uses — worth deleting outright rather than leaving it live, since it has no legitimate current purpose and creates real confusion if triggered.
embed_generate.php — an "Embedding Generator" meant to call OpenAI, with a placeholder in the source: $OPENAI_API_KEY = "YOUR_API_KEY_HERE";. Never configured, so it can't currently leak anything — but it's a plain-text placeholder for a real secret sitting in a web-accessible file. Worth knowing about now, before anyone ever fills that placeholder in without also moving it out of a publicly reachable script.
What this cluster appears to have been building toward
Reading them together: dossier_v2.php and excavation_engine.php both reference the exact same hardcoded network ID (net_69eee12e374d30_99173905) — meaning these were built and tested against one specific piece of sample data, not general-purpose. session.php and create_session.php reference a legaisee/clients/{client}/excavations/{session}/ folder structure — a fourth data layout, different from both the MySQL tables and the data/cases/, data/clients/ flat-JSON layer already confirmed live elsewhere. This reads as an earlier or parallel experiment in "semantic diffing" and session-based excavation browsing that never got adopted — plausibly predating, or built alongside, the current live system, then abandoned when the current modules/+MySQL+data/cases/ approach became the real one.
One file in here is a different kind of thing entirely: legaisee_prospects.php (676 lines) — not a system tool at all. It's a standalone, styled HTML sales/lead-generation page ("Legaisee Prospect List — Austin & San Antonio Corridor"). Unrelated to the archaeology system's functionality — likely a business-development page that happens to live in the same folder.

Genuinely load-bearing top-level files (already confirmed elsewhere, not re-audited here)
bootstrap.php, config.php, db.php, shell.php, graph_view.php, prospect.php, index.php, api.php — all already accounted for in earlier audit files.
Confirmed test/debug clutter, not yet individually opened but self-evidently scaffolding
test_db.php, test_excavation_module.php, test_full_checkout.php, test_graph.php, test_kernel.php, test_modules.php, test_search.php, test_ui.php, test_visual.php, create_test_data.php — file names alone make their purpose clear; low priority to open individually unless you want confirmation of what each specifically tests.

Section summary
Of the 51 top-level files, roughly 4 are genuinely load-bearing (once you exclude the ones already covered elsewhere), ~10 are self-evident test/debug scaffolding, 1 is a real, reused utility (response.php), and the remaining ~36 form a third disconnected experimental cluster (the semantic-diff/excavation-session tools) plus two files worth a security-hygiene look (setup.php, embed_generate.php) and one unrelated marketing page (legaisee_prospects.php).
Combined with the earlier backend audit, the honest picture is now: three separate disconnected systems exist in this codebase (old index.php prototype, the unwired engine/+api/v8+cli autonomous-agent cluster, and this semantic-diff experimental cluster) layered around one real, live system (shell.php + modules/ + the working slice of engine//kernel/).

Top-level files complete. Per the master checklist, next up: ui/ (19 files), then api/ top-level (45 unread), then ProjectManager/ internals (88 files).




<a id="doc-4"></a>
## 4. LEGAiSEE System Audit — Brain Dashboard.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — Brain Dashboard.md` · 2993 bytes · 19 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — Brain Dashboard Recovered Fragments
Audit type: Feature-history investigation, prompted by John's memory of a prior "Brain" dashboard.
What John remembers
The Brain module used to have its own dashboard showing all the intel in the system at once, including a drawn node/connection graph.
What's live today
modules/brain_module.php is registered and reachable (?module=brain), but it's a stripped-down, read-only system-status inspector. It reports: whether the shell is connected, how many modules are registered, item counts in each data folder (files/clients/cases/memory), and whether five specific engine files exist on disk. No intel display, no graph — just health-check numbers as JSON.
What was found — two real, disconnected fragments that match the memory
pages/network_view.php — a genuine, working force-directed graph using vis-network.js. Draws colored nodes (red for anomalies, green otherwise) with connecting edges, pulled from a network JSON file (currently hardcoded to one specific network ID). This is very likely the actual graph-drawing code John remembers — real and functional, just not wired into any live page today.
pages/shell_template.php ("The Grand Lobby") — an earlier, more ambitious version of the whole app. Instead of the current live shell's one-module-at-a-time view (?module=X), this version laid out every module as a "wing" on one page — Brain, Dashboard, Graph, Cluster, Insight, Predictive, Recommendation, and more, all rendered simultaneously side by side. This matches "showed all the intel in the system at once" closely.
The gap
These two pieces don't appear to have been the same page. The Grand Lobby's Brain wing would only have shown the same plain JSON stats the live Brain module shows today — it doesn't pull in the graph. The graph renderer (network_view.php) reads from a different data source than the Brain module's own memory/session files (data/brains/*.json, written by api/brain_memory_graph.php and api/brain_stream.php/brain_stream_v4.php, part of the dead "autonomous agent/brain" cluster documented in the api/ top-level audit).
So either:
an even earlier version combined these into one true "Brain Dashboard," and that combined version isn't in this codebase snapshot, or
the pieces were always separate and got assembled/disassembled differently across the project's several rebuilds.
Either way, both fragments are real, working code, currently unused, and both would need to be pulled together (and pointed at the Brain's own graph data rather than the network_view's hardcoded network) to actually reconstruct the dashboard John remembers.
Status: open thread
This is not closed out. If more fragments turn up during the remaining audit (especially ProjectManager/, still unopened) — anything else graph-related, anything else "brain," anything resembling a combined dashboard — they should be added here rather than treated as a new, separate finding.





<a id="doc-5"></a>
## 5. LEGAiSEE System Audit — Command Sidebar Section.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — Command Sidebar Section.md` · 4556 bytes · 42 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — "Command" Sidebar Section
Audit type: Macro / system-level. Not "does the PHP execute."
Status labels in shell.php: all 5 marked 'status' => 'working'.

POSITIVE FINDING: a third, genuinely good rendering system already exists and is barely used
modules/utils/uic_v1.php is a small, well-designed component library — uic_artifact() (title, summary, bulleted signals, confidence %), uic_dataset() (readable metric/value/status rows), uic_system() (a plain status message). These render as real cards and labeled rows, not JSON dumps. Only Intelligence Dashboard (below) currently uses it.
This matters a lot for "how do we fix this without months of work": the fix for most of the JSON-dump problem found across Graph & Entities, Excavation, and Intelligence Engines doesn't require inventing a new display pattern — it requires routing existing correct data through uic_dataset()/uic_artifact() instead of json_encode(). That's a mechanical swap in each module, not new design.

1. System Dashboard (modules/dashboard_module.php)
Supposed to do: overview of cases & clients.
What it actually does: counts cases and clients — that's the entire module, 20 lines.
Rendering path: JSON-dump pattern (small — just two numbers, but still wrapped as raw JSON text rather than "X cases, Y clients").
Verdict: Trivial, correct, poorly presented for how simple a fix would be.
2. Intel Dashboard (modules/intelligence_dashboard_module.php)
Supposed to do: executive intelligence overview.
What it actually does: builds a real artifact card + dataset + system-status message using the uic_v1 system above.
Rendering path: the good one — actual cards, not JSON.
Verdict: Built correctly, and proof the good rendering pattern already works elsewhere in the system.
3. Executive Dashboard (modules/executive_dashboard_module.php)
Supposed to do: system overview, top risk patterns, pattern frequency, system health.
What it actually does: real computed data across all four sections.
Rendering path: JSON-dump pattern for all four blocks — ironically, this dashboard doesn't use the uic system Intel Dashboard (a very similarly-named, similarly-purposed module) already uses two files away.
Verdict: Real data, same fixable translation gap. Notable that two dashboards with near-identical purposes ended up on two different rendering paths — one good, one not.
4. Brain (modules/brain_module.php)
Supposed to do, per its own sidebar description: "System intelligence & module registry" — i.e., this is meant to be the system's own self-status report.
What it actually does: genuinely checks system status, the module registry, data-layer readiness, and engine health.
Rendering path: JSON-dump pattern for every section.
Verdict: worth calling out specifically — the one module whose entire job is telling you what state the system is in fails the exact same legibility test as everything it's supposed to be reporting on.
5. Cockpit (modules/cockpit_module.php)
Supposed to do: main landing dashboard with health status and navigation into the rest of the system.
What it actually does: real HTML, health-status indicators, and a "System Pillars" tile grid linking into Clients, Excavation, Dig Review, Graph, Vault, Payments, Ingest.
Rendering path: bypasses the fallback system entirely — hand-built HTML, like Clusters/Ingest/Files/Search/Dig Review.
Verdict: Built correctly. Consistent with the earlier note that Cockpit was the first clean full render confirmed in this system.
One thing worth naming: its "System Pillars" tile for Knowledge System links to ?module=graph — the same Network Graph card confirmed broken (bare counts only) in the first audit. Cockpit itself is fine; it's pointing at a module downstream that isn't.

Section summary
2 of 5 (Cockpit, Intel Dashboard) are built correctly — one via hand-written HTML, one via the good uic_v1 component system.
3 of 5 (System Dashboard, Executive Dashboard, Brain) have real, correct underlying data undermined entirely by the JSON-dump rendering path — including Brain, whose whole job is supposed to be showing you system health in the first place.
Confirms the fix priority forming across the whole audit so far: this is overwhelmingly a presentation-layer problem, not a logic problem. Most engines compute the right thing; most screens fail to say so in plain language.

Next: Clients & Cases (Client Vault, Cases, Vault, Reports, Payments) and Tools (Compare, View, Alert) — the last two sections.




<a id="doc-6"></a>
## 6. LEGAiSEE System Audit — Final Small Folders.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — Final Small Folders.md` · 3546 bytes · 21 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — Final Small Folders
Audit type: Macro/system-level — real connections, not "does it execute." This closes out the full macro-audit checklist.
root-level /components/ (10 files)
Confirmed: this folder's only purpose is as the component library for the dead second UI rendering system documented in the ui/ audit (ui/component_registry.php and ui/component_boot.php are the only two files anywhere that reference it — both already confirmed dead). Nothing new to add connectivity-wise; contents read for completeness:
ui_card.php, ui_tag.php, ui_folder_tree.php — small, clean render-helper functions (card, tag, recursive folder-tree HTML), meant to be called by the dead component registry
card.php — a similar but separate card renderer, expects raw variables rather than a props array (an earlier or alternate version of the same idea)
compare.php — a side-by-side comparison card renderer (A/B layout) — likely meant for the same Compare feature that's live today through ui/ui_engine.php and pages/network_view.php, just a different, unused implementation of it
nav.php — a simple top nav bar referencing index.php, search.php, ingest.php, files.php as flat top-level links. This is a different navigation model than the current live shell.php (which switches modules via ?module=X inside one page) — likely a remnant of an earlier, simpler site structure from before the module-based shell existed
blur_bkgd — a standalone visual-effect HTML demo (backdrop blur), unrelated to the rest, no live use
legaisee_web_colors.md/.png — design reference only, not code (already noted in the ui/ report)
database/ (2 files)
Both files are the same migration, duplicated: 010_create_tree_nodes_table.php and 010_create_tree_nodes_tablebk.php (a manual backup copy — content is byte-for-byte identical). This is a SQLite migration (not MySQL) that creates a tree_nodes table with parent/child folder relationships — this is the real database schema behind the file-browser feature found in the api/ top-level audit (api/tree.php), confirming that feature was built with a genuine, if abandoned, SQLite migration. No migration runner exists anywhere in the codebase that would actually execute this file — it's a design artifact, not something that runs automatically. This also lines up with the earlier finding that setup.php (top-level files audit) creates a stray SQLite database — both appear to date from the same SQLite-era attempt, before the project settled on MySQL.
_backup/ (2 files)
index_5-17-26-0804pm.php — a manually-dated snapshot of an old index.php, from May 17, 2026. Exactly what it looks like: a personal backup copy, not live code. Worth keeping as-is for historical reference given John's interest in reconstructing the project's timeline, but not worth further analysis.
.gitignore — a standard version-control ignore file, no content of note.
Section summary
Nothing here changes the overall picture — all three folders are small, confirmed dead or purely archival, and each one closes a loop already opened elsewhere in the audit: components/ completes the dead UI-system story, database/ fills in the real schema behind the file-browser feature, and _backup/ is exactly what its name says.

This closes the full macro-audit
With this, every folder and top-level file group on the original checklist has been read and connectivity-traced. See the checklist file for the complete running index of all report files and the final coverage total.




<a id="doc-7"></a>
## 7. LEGAiSEE System Audit — Graph & Entities Sideba….md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — Graph & Entities Sideba….md` · 6694 bytes · 53 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — "Graph & Entities" Sidebar Section 8-23-26
Audit type: Macro / system-level — does the module connect to real data and other modules, and can John read the result — NOT "does the PHP execute."
Status labels in shell.php for this whole section: all 7 marked 'status' => 'working' — hardcoded text, not computed from any real check.

1. Network Graph (modules/graph_module.php)
Supposed to do: show the entity/relationship network as a graph.
What it actually does when opened from the sidebar: runs two COUNT(*) SQL queries and returns two numbers (Entities, Relationships). That's the entire output.
Real capability that exists but is unreachable: the file also contains a working path-finding algorithm (multi-hop traversal, scoring, ranking) — but it only runs if the URL is hit directly with special parameters (?start_entity=...). The sidebar never does this.
Does it connect to anything else? No. It reads only live DB counts. It does NOT read network.json (the file that would actually have graph shape data — see #4 below).
Human-legible? No — two raw numbers, no context, no visual.
Verdict: Broken relative to its purpose. Real graph logic exists in the codebase; the UI path to it doesn't.
2. Entities (modules/entity_resolution_module.php)
Supposed to do: entity resolution — find duplicate/alias entities and let you merge them.
What it actually does by default: shows two counts (entities, aliases) plus a text hint listing raw query-parameter syntax (?action=scan | ?action=analyze&id=N) — i.e., it tells a developer how to operate it via URL, not a business user via the UI.
Does it connect to anything? Partially — if the scan action is manually triggered (via URL, not a button in the UI as far as I can see), it writes results to an "insights" file tied to a case. That's a real connection, but it's not reachable through normal use.
Human-legible? No — counts + raw parameter syntax.
Verdict: Executes, but exposes a developer console, not a business tool.
3. Relations (modules/relations_module.php)
Supposed to do: show how cases, clients, and patterns relate to each other.
What it actually does: builds four real data structures (Case→Client, Client→Case, Case→Pattern, Pattern Co-Occurrence) — this part genuinely works and the data is real — but then hands each one back as a raw pretty-printed JSON text block to be displayed as-is.
Human-legible? No — you'd see walls of { "key": "value" } text, not sentences or a diagram.
Verdict: Real data, correctly connected, completely unreadable presentation. This is the clearest case of "the module does its job but John can't see it."
4. Root Cause (modules/root_cause_graph_module.php)
Supposed to do: build a root-cause graph for a case.
What it actually does: builds real node/edge data AND — importantly — writes it to data/cases/{case_id}/network.json, the exact file that graph_view.php (the one file in this whole system that DOES render a real visual graph) reads from.
The catch: this file only writes that data if a case_id is passed in. And even when it does, its own on-screen output is still a raw JSON blob, same as Relations above.
Real finding: this module is the correct data source for a working visual graph — but it's wired to the wrong display (JSON dump) instead of to graph_view.php, and it's disconnected from the sidebar's "Network Graph" card (#1), which uses a totally different, dumber data source (live DB counts).
Verdict: This is the piece that should be feeding #1, and isn't.
5. Clusters (modules/cluster_module.php)
Supposed to do: show a named cluster and its member pages.
What it actually does: the ONE module in this section that renders real, readable HTML — a heading, a summary sentence, and clickable cards.
Verdict: Actually works the way a business user would expect. Worth treating as the template for what "done" should look like elsewhere in this section.
6. Semantic Cluster (modules/semantic_cluster_module.php)
Supposed to do: deeper AI-driven clustering of entities.
What it actually does: produces real cluster data and writes it to clusters.json for the case (a real connection — feeding potential future consumers), but its own on-screen return is a raw array (clusters, total_clusters) — same unreadable pattern as #3/#4.
Verdict: Real logic, no human-facing translation.
7. Cross-Case Engine (modules/cross_case_engine.php)
Supposed to do: find patterns across multiple clients/cases (the actual differentiator value of the whole system, per the Authority Engine vision).
What it actually does: builds three real structures (Client→Case map, Industry Clusters, Cross-Case Links) — genuinely the most business-valuable data in this whole section — then returns them the same way: raw JSON text blocks.
Verdict: The most valuable engine in the section is also completely unreadable as built.

The pattern across all 7 (this is the real finding)
Two separate, independent problems are being labeled with the same word ("working"):
Wiring problem: data that one module correctly produces (Root Cause's network.json) isn't being read by the module that should display it (Network Graph). Two disconnected paths exist for the same concept.
Translation problem: in 4 of 7 modules, real, correct data is being generated — then handed to you as raw JSON text instead of sentences, tables, or a rendered picture. The system is doing its job internally and failing entirely at the last step: telling you, in your language, what it found.
Only one module in this section (Clusters) clears both bars — connects to real data AND presents it in a way a human reads normally.
Suggested fix priority (cheapest leverage first)
Rewire #1 to read network.json (already being written by #4) and render it through the same vis-network code already proven in graph_view.php. This is a data-source swap, not new development — the working graph code already exists in the codebase.
Give Relations, Root Cause, Semantic Cluster, and Cross-Case Engine a plain-language rendering layer modeled on what Clusters already does — even a simple "X relates to Y because Z" sentence list would clear the human-legibility bar without new backend logic.
Replace the hardcoded 'status' => 'working' labels in shell.php with something that reflects a real check — even a simple manual flag you update as sections get verified would stop the dashboard from lying to you about what's actually usable.

Next: continue this same audit format through the remaining sidebar sections (Intelligence Engines, Excavation/Ingest, Tools) to build the full system-level picture.




<a id="doc-8"></a>
## 8. LEGAiSEE System Audit — Intelligence Engines Si….md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — Intelligence Engines Si….md` · 8167 bytes · 58 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — "Intelligence Engines" Sidebar Section
Audit type: Macro / system-level. Not "does the PHP execute."
Status labels in shell.php: all 7 marked 'status' => 'working' — same hardcoded pattern as every prior section.

ROOT-CAUSE FINDING (applies system-wide, not just this section)
Traced why modules show raw JSON or bare numbers instead of readable output. There is one shared rendering function, renderModule() in shell.php, that every module's return value passes through unless the module builds its own full HTML page (like Clusters, Files, Search, Dig Review, Memory Ingest, Ingest View already do). For everything else, it picks one of two fallback paths based on the shape of data the module returns:
If a module returns ['title' => ..., 'items' => [...]] → goes to render_inspector(), which wraps each item's content field in a <pre> tag. A <pre> tag displays text exactly as typed — so if content is a JSON string (which is how the Graph & Entities modules built their output), the user sees the raw JSON, verbatim, in a fixed-width box. This is not a bug being hunted for — it is exactly, mechanically, what the code is built to do.
If a module returns a flat list of key→value pairs (e.g. risk_score, entities, etc.) → goes to a generic exec-panel loop that prints key: value lines. This one is actually somewhat readable (labeled fields, not raw JSON) — except for one serious side effect: if a value is itself an array, the code replaces it with just its count (count($v) . ' records'). Any module whose real output is a list of things (predictions, entities, links) gets silently flattened down to a single number by this fallback, regardless of how good the underlying data is.
This is the actual macro-level lever. Rather than fixing each module's display individually, fixing (or bypassing) these two fallback paths in renderModule()/render_inspector() once would fix the presentation layer for every module that currently dumps JSON or bare counts — a single, shared point of leverage instead of N separate module-by-module rewrites.

1. Anomaly (modules/anomaly_engine_module.php)
Supposed to do: risk & anomaly detection across the entity/relationship graph.
What it actually does: genuinely computes a weighted risk score from five real signals (orphaned entities, hub nodes, weight anomalies, alias explosions, contradictions) and buckets it into CRITICAL/HIGH/MODERATE/LOW.
Rendering path: flat key→value → hits the exec-panel fallback. Since none of its values are arrays, it renders as readable labeled lines (e.g. "risk_level: HIGH", "orphans_detected: 12"). Not pretty, but genuinely legible.
Verdict: Real computation, borderline-acceptable presentation (labeled fields, no narrative sentence, but not raw JSON either).
2. Insight (modules/insight_module.php) — MAJOR FINDING
Supposed to do, per the sidebar: "Case status intelligence."
What the file actually is: its own internal header comment literally reads * ingest_module.php / LEGAiSEE — Ingest & AI Memory Module — this file is a near-duplicate copy of the Memory Ingest module's paste/upload/sessions code, wired to the insight sidebar key instead. There is no case-status-intelligence logic anywhere in this file — I searched for it directly and found none.
The dangerous part: its database insert uses a different set of column names than the real Memory Ingest module —
Real Ingest writes: session_label, project_tag, platform, ..., raw_text, ..., created_at
This "Insight" duplicate writes: session_title, project_tag, source_ai, ..., raw_transcript, ..., created_at, processed
Both target the same table, memory_ingest, with two incompatible column sets. I couldn't confirm the live table schema from the codebase alone, but structurally, this is a real conflict: whichever set of column names doesn't match the live table will fail to save (or silently create orphaned/invisible data), and if the table happens to have both column sets, data pasted through one page would never appear when viewed through the other.
This is a strong candidate explanation for at least part of the "ingest doesn't save" experience — if you (or an earlier session) ever pasted a transcript on whatever page "Insight" resolves to, expecting it to behave like Ingest, it could be silently going to different columns than the ones the Sessions list reads from.
Verdict: Mislabeled, misfiled, duplicate code — not a rendering problem, a wiring/build mistake. This needs a live check: does clicking "Insight" in the sidebar show something that looks like the ingest paste form? If yes, that confirms this finding live.
3. Recommendation (modules/recommendation_module.php)
Supposed to do: turn detected patterns into action recommendations.
What it actually does: maps detected patterns to plain-English titles and action sentences (e.g. "Stabilize Workforce Signals — Investigate staffing consistency and delivery quality"), with a sensible fallback message when nothing's been ingested yet.
Rendering path: title/items shape → render_inspector() → but unlike the Graph & Entities modules, its content field is a plain sentence, not JSON — so the <pre> tag just displays a normal readable sentence.
Verdict: Actually works the way a business user would expect. A third clean example (with Clusters and Ingest View) of the system doing this correctly.
4. Decision Engine (modules/decision_module.php)
Supposed to do: decision logic across cases.
What it actually does: computes real per-case decisions and a ranked global priority list.
Rendering path: title/items with JSON-string content → same raw-JSON-in-a-box problem as most of Graph & Entities.
Verdict: Real logic, translation gap.
5. Predictive (modules/predictive_module.php)
Supposed to do: forecast pattern transitions.
What it actually does: computes real transition probabilities and case-level predictions.
Rendering path: same JSON-dump pattern as Decision Engine above.
Verdict: Real logic, translation gap.
6. Predictive Link V1 (modules/predictive_link_module_v1.php)
Supposed to do: predict likely new relationships between entities using a weighted structural/semantic/cluster/influence score.
What it actually does: a genuinely sophisticated scoring model — computes four separate similarity signals per candidate pair and combines them, keeping only predictions above a real confidence threshold (0.72).
Rendering path: returns a flat predicted_links (array) + total_predictions (number) — hits the exec-panel fallback, which (per the root-cause finding above) collapses the array to just its count. So the actual output — a ranked list of specific predicted relationships with real confidence scores — never reaches the screen at all. You'd see "predicted_links: 37 records" and nothing else.
Verdict: The most sophisticated engine found in this whole audit so far, and it's the most completely invisible. This is the clearest single example of the array-collapsing rendering bug doing real damage.
7. Time Intelligence (modules/time_intelligence_module.php)
Supposed to do: temporal trend analysis (7-day vs. 30-day baseline).
What it actually does: computes real trend deltas, sorted by movement.
Rendering path: same JSON-dump pattern.
Verdict: Real logic, translation gap.

Section summary
1 file shouldn't exist where it is (Insight = a mis-wired duplicate of Ingest, not case-status logic) — a wiring/build mistake, the most serious finding in this section.
1 engine's real output is actively destroyed by the renderer before it reaches the screen (Predictive Link V1) — highest-value fix candidate found so far, since the underlying logic is already sophisticated and correct.
4 of 7 modules (Decision, Predictive, Time Intelligence, and Excavation from the prior section) share the exact same fixable-in-one-place JSON-dump problem.
2 of 7 modules (Recommendation, and Anomaly to a lesser extent) already clear the human-legibility bar as built.

Next: Command section (System Dashboard, Intel Dashboard, Executive Dashboard, Brain, Cockpit), then Clients & Cases, then Tools.




<a id="doc-9"></a>
## 9. LEGAiSEE System Audit — Planning, Clients & Cases….md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — Planning, Clients & Cases….md` · 6044 bytes · 54 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — Planning, Clients & Cases, and Tools
Audit type: Macro / system-level. Final three sidebar sections.

Planning
Project Board (modules/pm_module.php)
Supposed to do: task/project kanban, Backlog → Done.
What it actually does: a substantial (922-line), real drag-and-drop kanban board with live status updates.
Verdict: Built correctly. Consistent with the level of investment visible in the ProjectManager governance docs already on file.

Clients & Cases
Client Vault (modules/clients_module.php)
What it actually does: real client list with city/state/UID, dispatched through the 'type' => 'list' rendering path (a real named renderer, not the generic fallbacks).
Verdict: Built correctly, human-legible.
Cases (modules/cases_module.php)
What it actually does: real HTML — case ID, color-coded status, client name, pattern tags.
Verdict: Built correctly, human-legible.
Vault (modules/vault_module.php)
What it actually does: real file/artifact storage UI — and also contains the actual "create Stripe checkout" JavaScript logic.
Cross-module finding: the checkout-creation code lives here, in Vault — not in the separate "Payments" module (below), which is what the sidebar implies would handle payments.
Reports (modules/report_module.php)
What it actually does: generates a real PDF, confirmed working mechanically. Already flagged in prior sessions as a "thin dossier" — it only pulls approved findings with a note, not a composed Authority System record. No new finding here, just confirming it's consistent with what's already on record.
Payments (modules/payment_module.php)
Supposed to do, per sidebar: "Stripe checkout & billing."
What it actually does: displays a static price list for the Exhibit tiers. That's it — no checkout button, no billing history, no actual Stripe interaction in this file.
Cross-module finding, paired with Vault above: the sidebar puts "Payments" and "Vault" in the same section as if they're separate concerns, but the real checkout logic is in Vault, not Payments. If you click "Payments" expecting to start or review a checkout, you'll only ever see a price list — the actual working feature is one click away, mislabeled.
Verdict: Static/incomplete relative to its own label; the real capability exists but is filed under the wrong sidebar entry.

Tools
Compare (modules/compare_module.php) — MAJOR FINDING
Supposed to do, per sidebar: "Dual-document intelligence compare."
What it actually does: a form with two text boxes (Set A / Set B). If both are filled in, it just echoes back whatever you typed — there is no comparison logic in this file at all.
The real logic exists and is orphaned: ui/compare_engine.php contains a genuine comparison renderer (side-by-side rendering, a toggle view) — but I searched the entire codebase for anything that includes or requires this file, and nothing does. It's dead code, fully built, completely disconnected from the module the sidebar actually points to.
Verdict: Same pattern as Root Cause/Network Graph and Predictive Link V1 — real capability exists in the codebase, wired to nothing. This is the clearest "stub in front, real logic orphaned behind" case found in the whole audit.
View (modules/view_module.php)
What it actually does: a real interactive artifact/diff viewer, JS-driven.
Verdict: Built correctly.
Alert (modules/alert_module.php)
What it actually does: real detection logic (e.g. flags a "lead decline detected" pattern per case) producing genuine alerts.
Rendering path: JSON-dump pattern, same fixable translation gap as most of Intelligence Engines.
Verdict: Real logic, translation gap.

Whole-system summary (all sections combined)
The dominant pattern across all ~30 modules audited: the system's underlying logic is, in most places, genuinely working and often quite sophisticated — real risk scoring, real pattern prediction, real clustering, real client/case data. The system fails almost entirely at the last step: showing you what it found in a way you can read. That happens in three distinct, now-identified ways:
Raw JSON dumped into a <pre> box — the single most common failure, traced to one shared function (render_inspector()), affecting roughly half of all modules audited (Relations, Root Cause, Semantic Cluster, Cross-Case, Excavation, Decision, Predictive, Time Intelligence, Alert, Executive Dashboard, Brain, System Dashboard).
Real list data silently collapsed to just a count — a second shared function (exec-panel fallback), confirmed to destroy Predictive Link V1's actual output entirely.
Real, working logic that exists in the codebase but is never called by the module the sidebar actually points to — confirmed three times: Root Cause writes graph data Network Graph never reads; a real comparison engine (compare_engine.php) is fully orphaned behind a stub; Vault holds the real payment logic that "Payments" implies it should have itself.
Two additional standalone findings, unrelated to presentation:
Insight is a mis-wired duplicate of Ingest, writing to conflicting column names in the same database table — a build/wiring mistake, not a display issue, and a plausible partial explanation for "ingest doesn't save."
Memory Ingest's file-upload path has a confirmed silent-failure bug (leftover SQLite syntax + an empty error catch) that can show "success" even when the database save failed.
What already works well, as a reference for what "done" looks like: Cockpit, Clusters, Ingest View, Files, Search, Dig Review, Client Vault, Cases, Project Board, Intel Dashboard (via the uic_v1 system), Compare's sibling engine file (though unwired), and Recommendation.
Every module in the whole sidebar is still labeled 'status' => 'working' in shell.php's source, regardless of any of the above — confirmed system-wide, not section-specific.

Audit complete — all sidebar sections covered: Command, Planning, Clients & Cases, Excavation, Intelligence Engines, Graph & Entities, Tools.




<a id="doc-10"></a>
## 10. LEGAiSEE System Audit — ProjectManager.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — ProjectManager.md` · 5985 bytes · 26 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — ProjectManager 88 PHP files 
Audit type: Macro/system-level — real connections, not "does it execute." Plus a read of the folder's own governance documentation to establish intent and stopping point.
This one is different from everything else found so far
Every other dead cluster in this audit has been experimental, ad-hoc, or abandoned mid-thought. ProjectManager/ is not that. It's a deliberate, disciplined attempt to build a complete standalone Project Management application for LEGAiSEE — the folder's own documentation compares the goal directly to Notion, Asana, Monday, and Jira, with LEGAiSEE's intelligence features meant to enhance it, not replace normal PM workflows. It has a proper MVC architecture (Controllers, Models, Repositories, Policies, Services, a real dependency-injection Container, its own Router/Dispatcher), 9 database migrations, and its own test suite. Confirmed fully isolated: zero references in or out of the rest of the LEGAiSEE codebase — this could be deleted or moved tomorrow without touching anything else.
Security flag — deal with this regardless of what else happens to the folder
ProjectManager/config.php contains a live, plaintext database password, connecting to the same production database the rest of LEGAiSEE runs on. (Not reproducing the credential itself here — just its location.) Because nothing calls into this folder, it isn't reachable through normal use of the live site. But ProjectManager/index.php would run if hit directly by URL — and would connect to production with full credentials, including migration files that create database tables. Worth a deliberate decision — rotate the credential, lock the folder down, or remove it — rather than leaving it as-is.
What actually got built vs. what didn't
The folder runs its own strict governance process (documented in governance/BUILD_STATUS.md): write a spec chapter, get it approved, lock it, then generate all the real code for it, in order, no skipping ahead. Reading where that process actually stopped tells the real story:
Fully written and built (backend only):
Foundation & governance chapters (0000–0020): manifest, governance rules, design principles, file ownership, build rules — all complete
Data layer chapters (0100–0340): product overview, feature matrix, user roles, permission model (595 lines), database architecture & schema, relationship model, attachment model, activity log — all complete
Matching real code for all of it: Project, Task, Comment, Client, Milestone, Label, ProjectMember each have a full Model + Repository + Controller + API endpoint. A full role/permission system exists (Permission, Role models, AuthorizationService, per-entity Policy classes for Documents, Permissions, Projects, Roles, Tasks, Users). 9 real database migrations exist (users, roles, permissions, role_permissions, user_roles, attachments, activity_log, audit_tables, projects).
Never started (chapters 0400 onward — every UI-facing chapter is a literal 0-byte empty file):
UI Design Language, Layout System, Component Library, Form/Table/Modal Standards
Every actual page: Project Workspace, Overview, Tasks, Task Detail, Kanban Board, Calendar, Timeline, Files, Notes, Activity, Project Settings, Custom Fields, Labels, Milestones, Dependencies, Automations
System Integrations, Ingest Library tie-in, Client Portal, Permission Filtering, Shared Projects
API Specification doc itself (though the actual API endpoints got built anyway, just never formally spec'd)
Confirmed empty on disk: the assets/, storage/, and vendor/ folders all exist per the frozen structure but contain nothing — no front-end files, no uploaded/generated files, no installed dependencies.
Where it actually stopped — this is documented, not guesswork
The folder contains its own session-handoff note (0999_SESSION_HANDOFF.md) written for whoever picked this back up next. It explicitly lists what was done (the models/repositories/controllers/API list above) and states the next action in plain terms: "Stop generating blindly. Audit existing... Then continue with: UserController, User API, Authentication wiring, Front-end views, JS API client, Kanban/List UI." So even user login/authentication wiring wasn't finished — every controller and policy exists, but nothing verifies who's logged in yet. Every single front-end page — the entire visible product — was still ahead of where work stopped.
The same handoff note also carries an explicit constraint worth knowing: "This is V1 Wrike/Asana style PM only. Do not add LEGAiSEE AI OS features. Do not redesign architecture." Whoever was steering this deliberately kept it a plain, standard PM tool for this version, not another AI-feature layer — a real design decision, not an oversight.
Code quality note
Spot-checked several of the Model/Controller files directly rather than trusting the governance docs alone. The actual PHP is clean, modern, and complete — typed properties, strict_types declared, proper encapsulation — not placeholder or stub code. Whatever else happened to this codebase over its history, this particular attempt was executed carefully as far as it got.
Section summary
ProjectManager/ is a real, ambitious, well-executed attempt at a standalone Notion/Asana-style PM tool for LEGAiSEE, with its backend data layer, permission system, and 7 of 8 core entities' API surface genuinely finished — and its entire front end, plus user authentication, never begun. It stopped cleanly, at a documented handoff point, not mid-collapse. Given how disciplined the governance process is, this looks like one of the more recoverable pieces found in the whole audit if there's ever appetite to finish it — the hard architectural decisions are already made and locked. Separately, the live plaintext database credential in config.php should be addressed on its own, independent of whether this project is ever revived.




<a id="doc-11"></a>
## 11. LEGAiSEE System Audit — api Top-Level non-v8.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — api Top-Level non-v8.md` · 0 bytes · 0 lines · encoding normalized to UTF-8*




<a id="doc-12"></a>
## 12. LEGAiSEE System Audit — kernel.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — kernel.md` · 6985 bytes · 34 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — kernel
Audit type: Macro/system-level — real connections and legibility, not "does it execute."

Genuinely live, foundational — the real spine of the system
db.php (43 references) — defines kernel_db(), the single real MySQL/PDO connection function. This is the correct, current connection layer.
bootstrap.php (46 references, but trivial — just 2 lines) — a compatibility shim: requires the top-level /db.php, which in turn requires kernel/db.php and exposes a global $pdo. Good news, not a bug: earlier I flagged a possible second/conflicting database connector at the top-level /db.php — checked its actual content directly, and it's just this 3-line wrapper, not a competing connection method. Confirmed non-issue.
kernel_boot.php (24 references) — the real canonical boot sequence: loads db.php, kernel_paths.php, conditionally loads ui/ui_bootstrap.php if present, starts the session, and explicitly sets a global $db fallback with a comment: "Modules built before kernel_db() existed use $db directly. This makes both approaches work." This confirms, in the system's own words, that two different calling conventions for the database coexist intentionally — worth knowing as a standing fragility, even though it's handled deliberately rather than accidentally.
kernel_paths.php (real, used) — single source of truth for KERNEL_ROOT, DATA_ROOT, FILES_ROOT, CLIENTS_ROOT, CASES_ROOT, MEMORY_ROOT. Clean, correct.
module_registry.php (real, used) — the actual key→file map behind every sidebar module already audited.
kernel.php — self-documented as deprecated in its own comments: "This file previously contained database logic. That responsibility now belongs exclusively to /kernel/kernel_boot.php... intentionally left minimal." Honestly labeled, not a landmine — just a leftover stub that says so.
nav_engine.php — a real, working session-based navigation history tracker (keeps your last 50 pages visited, dedupes consecutive repeats).
ingestion_pipeline.php — confirmed live, required directly by modules/ingest_module.php (the real Memory Ingest paste flow already audited). Its analyzeStrength() function is a simple length-based heuristic with its own comment: "simple heuristic scoring (upgrade later with AI)" — worth knowing that the "strength" score you see on ingested sessions today is a basic placeholder, not real analysis, by the system's own admission.
Orphaned — zero real references anywhere in the codebase
engine_bindings.php — a real, sensible-looking config mapping module keys to which engine files should power them (e.g. 'brain' => cross_case_engine, system_insight_engine, system_recommendation_engine). Confirms an earlier finding from the backend audit: this file is unused.
guard.php — a defensive "kernel guard" meant to catch missing DB connections and silent bootstrap failures before they cause bigger problems. Built, never wired into the actual boot sequence.
system_health.php (184 lines) — worth flagging specifically. Its own header says exactly what you've been asking for this whole audit: "Provides deterministic runtime diagnostics for: DB integrity, module registry validity, file system consistency, graph data integrity... READ-ONLY diagnostics." This is a real, already-built system-health checker — and nothing calls it. Like plain_english_helper.php from the engine/ audit, this is a second "we already built the tool for the problem we're trying to solve" discovery.
task_generator.php — converts recommendations into database tasks. Unused — and if it ever were wired in, it has a real latent bug: it calls $conn->prepare(...)->bind_param("iss", ...), which is mysqli syntax, not PDO. Since the rest of the live system uses PDO's kernel_db(), this file would fail immediately if connected to the current database layer without being rewritten first.
graph_auto_builder.php — a real node-to-edge conversion engine using keyword-similarity matching. Unused — most likely superseded by the more sophisticated entity-extraction pipeline already confirmed live in engine/.
Dead-end chains — real code, but every path to reach it is itself dead
kernel/graph_engine.php — zero references anywhere. (Separately, engine/graph_engine.php — a different file with the same name — is only reached through api/v8/build_graph.php, which is itself unreachable per the earlier backend audit. Both "graph_engine.php" files are effectively dead, from two different folders.)
kernel/recommendation_engine.php — only required by kernel/task_generator.php (confirmed orphaned above). Important resolved question: the well-working "Recommendation" module found in the very first audit (readable, plain-English output) does NOT use this file, or its engine/recommendation_engine.php namesake either — both are dead. Its real logic traces to modules/utils/bootstrap.php, which hasn't been opened yet. So there are effectively three different "recommendation" implementations across the codebase — two dead, one live and unexamined.
cluster_intelligence.php → only required by insight_generator.php, which is only required by the (orphaned) kernel/recommendation_engine.php above. Dead chain.
folder_engine.php → only required by ui/file_explorer.php, which itself has zero references anywhere. The real, working Files module (confirmed good in the first audit) doesn't use this — it has its own separate logic. Dead chain.
module_contract.php — not code, just written rules ("modules must never create DB connections, never render layout, only output content"). Good documented intent — worth checking later whether the modules actually audited comply with this (some clearly build their own full HTML pages, which may or may not violate the spirit of "only output content").
kernel_contract.php — 4-line deprecated stub, honestly labeled, no issue.

Section summary
The true operational core is small and solid: db.php, bootstrap.php, kernel_boot.php, kernel_paths.php, module_registry.php, ingestion_pipeline.php, nav_engine.php.
Two more "we already built the fix" discoveries, matching plain_english_helper.php from the engine/ audit: system_health.php is a ready-made system diagnostic tool, and guard.php is a ready-made safety check — both unused.
A real naming-collision hazard confirmed twice: graph_engine.php and recommendation_engine.php each exist as two separate, different files in kernel/ and engine/ — a real risk that a future edit (by you, Windsurf, or any AI) could target the wrong one without realizing it.
One open thread: modules/utils/bootstrap.php — where the real, working Recommendation logic actually lives — has not been opened yet. Worth a look given it's clearly load-bearing for at least one confirmed-good module.

kernel/ complete. Per the master checklist, next up: triage the 51 top-level standalone files, then ui/, then api/ top-level, then ProjectManager/ internals.




<a id="doc-13"></a>
## 13. LEGAiSEE System Audit — modules-utils-bootstrap-the Recommendation Module Question.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — modules-utils-bootstrap-the Recommendation Module Question.md` · 0 bytes · 0 lines · encoding normalized to UTF-8*




<a id="doc-14"></a>
## 14. LEGAiSEE System Audit — modules-utils-bootstrap.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — modules-utils-bootstrap.md` · 0 bytes · 0 lines · encoding normalized to UTF-8*




<a id="doc-15"></a>
## 15. LEGAiSEE System Audit — ui Rendering Layer.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE System Audit — ui Rendering Layer.md` · 6403 bytes · 34 lines · encoding normalized to UTF-8*

LEGAiSEE System Audit — ui Rendering Layer
Audit type: Macro/system-level — real connections, not "does it execute."
The honest picture, up front
Of the ~27 files in ui/ (16 top-level PHP files, plus a ui/components/ subfolder and a global.css), only two files are genuinely load-bearing in a real, currently-used way — and even one of those is functionally inert. Everything else here is either already-known orphaned code, or a second, more disciplined rendering system that was built and never wired in.
What's actually live
ui/ui_engine.php + ui/layout.php — the one real, working piece. These are pulled in by modules/view_module.php, which IS registered in the live module system (?module=view). This route is a side-by-side "page compare / executive diff" tool — pick two saved pages from a page/page_content database table, and it highlights additions, removals, and keyword-signal shifts between them. layout.php is the actual HTML shell this tool renders inside — its own full <!DOCTYPE html> page with an inline <style> block (the black/gold/"diamond" luxury theme).
Correction to the earlier top-level-files finding: that report said lib/semantic_diff_engine.php (the shared library behind the big disconnected "semantic-diff" cluster) was "never referenced by anything in the live system." That's not quite right — view_module.php requires it, and view_module.php is live and reachable. So that experimental cluster isn't fully dead; it has exactly one live doorway into it, through the Compare/Executive-diff view. Worth knowing since a fix or cleanup pass touching lib/semantic_diff_engine.php would actually affect a working feature, not just dead files.
ui/ui_bootstrap.php — technically loaded by kernel/kernel_boot.php (which is live), but functionally dead: it defines a function that returns a <link> tag for global.css, but the wrapper function meant to call it (kernel_assets(), defined right next to it in kernel_boot.php) is never actually called anywhere in the codebase. So it's loaded into memory but never does anything.
The big finding: global.css is a dead "single source of truth"
ui/global.css is 1,924 lines and its own header comment states: "All pages link this. No embedded CSS anywhere else." That's false in practice — because of the dead ui_bootstrap.php chain above, this stylesheet is never actually linked into any live page. Meanwhile, at least three separate inline <style> blocks exist and do the real work instead: one in shell.php (the main app shell), one in ui/layout.php (the Compare-view shell), and one in modules/view_module.php itself. There's also a fourth, fully orphaned CSS file, ui/theme.php, using the same gold/obsidian palette but wired into nothing. All four use recognizably the same design language (matches the palette in ui/components/legaisee_web_colors.md), so this reads like an intended-but-abandoned consolidation: someone built the "real" global stylesheet and then the actual pages kept their own copies instead of switching over.
Confirmed orphaned (already known from the kernel/ audit)
ui/compare_engine.php
ui/file_explorer.php
A second, more disciplined — and fully dead — component system (11 files)
This is the most interesting find in the folder: a parallel rendering architecture, more structured than what's actually live, that appears to have been built as a replacement and never adopted.
ui/component_contract.php — a documented rule set for how components should behave (string-only output, no inline styles, no DB access, no business logic)
ui/component_registry.php + ui/component.php — a registry-driven component loader (ui_component($name, $props))
ui/component_boot.php — registers components (card, button, tag, folder_tree) against handler functions
ui/registry.php — a second, different component registry (inline closures for card, button, panel, compare)
ui/layout_engine.php + ui/layout_contract.php — a layout renderer that takes an array of {type, props} blocks and dispatches each to the registry above
ui/ui.php + ui/ui_boot.php — yet another small "core" helper pair (ui_shell(), ui_card())
ui/components.php — a folder-tree HTML renderer
None of these 11 files are referenced anywhere outside this group — zero external callers. component_boot.php does correctly resolve its includes, but to a different, root-level /components/ folder (not ui/components/) — one the master checklist had listed as "unknown purpose, 6 files unread." It's actually 10 files, and this audit confirms its purpose: it's the component library for this dead second rendering system (ui_card.php, ui_folder_tree.php, ui_tag.php, plus nav.php, compare.php, and design-reference files). Worth folding that into the same finding rather than auditing it as a mystery folder later.
Separately, ui/component_registry.php also points at four files inside ui/components/ that don't exist at all — button.php, heading.php, input.php, folder_tree.php. So even on its own terms, this system was left mid-build.
ui/components/ subfolder (inside ui/, distinct from the root /components/ above)
card.php — referenced only by the dead component_registry.php, not live
ingestforshell.php and ingest_exec snap.php (note: literal space in the filename) — two near-identical files (~4,750 bytes each), zero references anywhere
legaisee_web_colors.md / .png — a design reference (color palette + swatch image), not code
blur_bkgd, scroll_fx — extensionless HTML snippets (visual effects), zero references anywhere
ui/images/
One background image, confirmed genuinely in use — but via other already-covered live files (prospect.php, ingest.php, global.css itself, template pages), not through anything in this ui/ audit specifically.
Section summary
Of everything in ui/, exactly one feature is truly live: the Compare/Executive-diff view (ui_engine.php + layout.php, reached via ?module=view), which also turns out to be the sole live doorway into the previously-flagged lib/semantic_diff_engine.php cluster. The documented "single global stylesheet" (global.css) is dead code in practice — never linked into any page — while three-plus competing inline style blocks do the actual work. And there's a second, architecturally cleaner component/layout system sitting fully unused alongside the live one, itself missing some of the files it points to.




<a id="doc-16"></a>
## 16. LEGAiSEE — Brain Cluster Micro-Audit.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE — Brain Cluster Micro-Audit.md` · 7735 bytes · 124 lines · encoding normalized to UTF-8*

LEGAiSEE — Brain Cluster Micro-Audit
Companion to the full function inventory (engine/, api/v8/, api/ top-level ~30). This is the final deliverable of the brain micro-audit: which functions are true duplicates, which are divergent capabilities, and a KEEP/RESTORE/FIX/FINISH/INTEGRATE/REPLACE/DEFER/DELETE call for each.

GROUP A — REAL, DB-backed, working paradigm (the "good half")
These all use kernel_db()/PDO against real MySQL tables (entities, cases, clients, tree_nodes, processing_queue, tasks). This is the only paradigm with genuine data behind it.
Function/File
Location
Does
Triage
graph_engine.php (queue_graph_build_for_case, mutateGraph)
engine/
Per-case graph building against real tables
KEEP
build_graph.php
api/v8
Wires to graph_engine.php
KEEP
semantic_cluster_engine.php (buildSemanticClusters)
engine/
Clustering over real entities
KEEP
cluster_insights.php
api/v8
Wires to semantic_cluster_engine.php
KEEP
graph_ranker.php
api/v8
Ranks top-10 entities by strength/confidence
KEEP
get_cases.php / get_clients.php
api/v8
Real case/client data access
KEEP (already established)
network_add_node.php
api/v8
Session-based node identity, matches locked Master System Law Part V
KEEP — this is the canonical identity-layer implementation
debug_queue.php / debug_tasks.php
api/v8
Raw-mysqli ops dumps
KEEP (low-risk ops tools, not core brain logic)

This is the real skeleton of a working brain system. Nothing here needs replacing — it needs connecting to a live UI page, which none of it currently has.

GROUP B — Fake flat-JSON "data/network/" universe (one family, not six ideas)
All read/write the same disconnected flat-file world. Zero real AI, zero real DB. build_edges.php hardcodes a single test network_id.
Function/File
Duplicate of (Group A)
Verdict
create_network.php
— (originates the fake universe)
DELETE
compressor.php
Conceptually overlaps cluster_insights.php (both "aggregate signal by type") but toy math, not clustering
DELETE
event_emit.php
No real equivalent — genuinely unique idea (event queue) but zero consumers found anywhere
DELETE (or DEFER if John wants the concept preserved for a future real event bus)
build_edges.php
Duplicate of graph_engine.php's real graph-building, but hardcoded/toy
DELETE — also has the corrupted-trailing-code bug
compare_networks.php
Duplicate of graph_ranker.php's "score the graph" idea, but toy/disconnected
DELETE — also corrupted-trailing-code bug
mesh.php
No real equivalent, aggregates node type counts across the fake universe
DELETE — also corrupted-trailing-code bug

Recommendation: delete this entire family as one decision, not file-by-file — they only exist to serve each other's flat-file format, and the one real capability they gesture at (graph building, ranking, clustering) already exists properly in Group A.

GROUP C — Simulation / agent-dispatch cluster (api/ top-level, ~30 files)
Already documented as 100% simulation — flat JSON in data/agency/, data/brains/, data/cases/, data/network/. Two pieces worth calling out individually rather than deleting the whole cluster outright:
Function/File
Why it's different from the rest of Group C
Triage
model_router.php
The ONE piece that, if built out for real, would make the whole brain concept functional — currently fake stubs echoing prompts back
FINISH — this is the actual missing piece, not dead weight
brain_orchestrator.php + brain_synthesis.php
Architecturally coherent skeleton (prompt → route to 3 models → weighted-confidence synthesis) built entirely on the fake router above
RESTORE once model_router.php is real — structurally sound, just needs a real engine underneath
brain_start.php
Session-based node_id pattern — same idea as network_add_node.php in Group A, which already won and is live
DELETE — superseded, keep only as historical reference if useful
Remaining ~26 files (agent.php, autonomous_engine.php, dossier*.php, cases.php, insights.php, patterns.php, forecast.php, predictor.php, investigator.php, learn.php, feedback.php, alerts.php, summary.php, etc.)
Deterministic toy-math over flat JSON, hardcoded test network_id, no real logic
DELETE — this is the disposable bulk of the cluster


GROUP D — Everything else (divergent, not duplicate)
Function/File
What it is
Triage
widget_registry.php
Static UI-schema reference data, no consumer found
DEFER — interesting design intent (backend-driven widget schemas), but no live UI to wire it to yet
generate_tasks.php
Explicit unfinished stub ("TEMP SAFE OUTPUT, NO LOGIC YET")
FINISH or DELETE — currently misleading since it silently returns fake data as if real
run_worker.php
Real shell_exec() invocation of cli/worker.php
FIX — works, but shell_exec from a web-reachable endpoint is a fragile pattern worth hardening regardless of the cluster's fate
portfolio_engine.php (loadAllCases, buildGlobalGraph)
Real functions, but reads a THIRD data location (data/clients/{client}/cases/{case}/network.json) that nothing else in the audit touches
VERIFY FIRST — before triaging, confirm whether this path is ever actually populated live; the "most real" cluster (predictive_intelligence_engine.php) depends on it
dashboard_engine.php (renderDashboardPath)
Real, simple recommendation-card HTML renderer
DEFER — cross-reference to the open Brain Dashboard fragments thread; doesn't match the "node graph" memory but is a genuine new fragment


THE BUG LIST (independent of any triage decision)
Regardless of what gets kept/deleted, these are real defects worth fixing or removing outright:
Hard syntax errors (won't execute at all): api/v8/agent.php, forecast.php, alerts.php
Corrupted trailing output (~13 files now): insights.php, patterns.php, predictor.php, investigator.php, learn.php, cases.php, memory_store.php, memory_weight.php, summary.php, autonomous_engine.php, build_edges.php, compare_networks.php, mesh.php — all end with a dead echo json_encode($response); exit; after a real echo already fired
Naming collisions: already documented elsewhere (graph_engine.php, recommendation_engine.php, cluster_engine.php, excavation_engine.php, semantic_engine.php each exist in 2+ locations)

BOTTOM LINE — the merge/rebuild question this micro-audit set out to answer
There is no scenario where 2-3 partial implementations get merged into one better brain system. The honest picture:
Group A (real, DB-backed) is the actual foundation — it already works, already matches the locked Master System Law identity design, and just needs a live UI page pointing at it.
Group B (fake flat-JSON universe) and the bulk of Group C (simulation cluster) are disposable — not because they're orphaned, but because Group A already does what they were reaching for, using real data instead of toy JSON.
The one genuinely missing piece is model_router.php — real AI-model calls. Nothing else in any of the 3 locations has attempted this; it's not a duplicate of anything, it's the actual gap between "brain that queries a database" and "brain that reasons."
brain_orchestrator.php/brain_synthesis.php's architecture is worth keeping as the shape for how a real model_router would get consumed — prompt-build → multi-model route → weighted synthesis is a reasonable design, it's just sitting on nothing real.
Recommended next action: decide whether John wants to (a) build a real model_router.php and restore the orchestrator/synthesis skeleton on top of Group A's real data, or (b) treat "brain" as Group A's existing DB-backed functions only, wired into a live page, with AI-model reasoning deferred entirely to a later phase.




<a id="doc-17"></a>
## 17. LEGAiSEE — MASTER PREFACE_9-3-26_PROJECT BOOTSTRAP-FULL.md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE — MASTER PREFACE_9-3-26_PROJECT BOOTSTRAP-FULL.md` · 16867 bytes · 472 lines · encoding normalized to UTF-8*

LEGAiSEE — MASTER PREFACE / PROJECT BOOTSTRAP
PURPOSE OF THIS DOCUMENT
This document is the persistent bootstrap context for LEGAiSEE.
It exists so a new Claude conversation can understand the current state, objective, methodology, and rules of the LEGAiSEE recovery/completion project without requiring the entire historical conversation to be carried forward.
This document is not the complete project documentation.
It is the starting point and controlling context for each new Claude work session.
Claude should read this document first, then consult the appropriate current audit, state, task, code, and documentation files needed for the specific task at hand.

1. THE OBJECTIVE
LEGAiSEE already has a substantial amount of code, systems, modules, engines, interfaces, experiments, prototypes, and partially completed functionality.
The immediate objective is NOT to redesign LEGAiSEE from scratch.
The immediate objective is to determine, with evidence, what LEGAiSEE actually is today.
We need to establish the first genuinely complete view of the system that was built, started, abandoned, disconnected, duplicated, broken, unfinished, or otherwise left behind.
Only after that understanding exists should we decide what the final LEGAiSEE system should become.

2. THE RECOVERY / COMPLETION SEQUENCE
The project proceeds through these major stages.
STAGE 1 — COMPLETE THE SYSTEM ARCHAEOLOGY
We have an extensive audit already underway.
The audit is not simply asking:
"Does this PHP file execute?"
It asks:
What does this file/system actually do?
Is it connected to anything?
What data does it use?
What other systems depend on it?
Does another system duplicate its functionality?
Is it working?
Is it partially working?
Is it broken?
Is it orphaned?
Is it unfinished?
Is it potentially valuable despite being disconnected?
Can it be restored?
Does it belong to the eventual LEGAiSEE system?
Continue the audit until we have sufficient knowledge of the entire codebase to make informed decisions.
Do not prematurely delete, redesign, replace, or rebuild systems during archaeology.

3. STAGE 2 — TRIAGE WHAT WE FOUND
Once sufficient archaeology has been completed, classify the discovered systems and files.
Possible classifications include:
KEEP
Working or valuable systems that belong in LEGAiSEE.
RESTORE
Systems that appear fundamentally sound but have become disconnected, broken, or unusable.
FIX
Systems that are useful but contain identifiable defects.
FINISH
Systems that are substantially built but incomplete.
INTEGRATE
Systems that work independently but need to be connected to the rest of LEGAiSEE.
REPLACE
Systems whose purpose is valid but whose implementation is inferior or conflicting with another implementation.
DEFER
Potentially useful systems that should not be addressed yet.
DELETE
Only genuinely disposable material.
DELETE is a conclusion reached from evidence, not a default consequence of being orphaned.
An orphaned system may contain valuable unfinished functionality.

4. STAGE 3 — DOCUMENT THE ACTUAL LEGAiSEE SYSTEM
After archaeology and triage, create the first comprehensive description of the system that actually exists.
Document the system in logical major and minor sections.
The eventual terminology for these sections — modules, wings, systems, engines, domains, etc. — should emerge from understanding the actual code rather than being imposed prematurely.
This documentation should establish:
what each system does
what data it works with
what its inputs are
what its outputs are
what it depends upon
what depends upon it
how it connects to other systems
whether it is active, dormant, broken, incomplete, or obsolete
This becomes the factual foundation for the next stage.

5. STAGE 4 — CREATE THE COMPLETE SYSTEM MAP / SITE MAP
Once the actual system is understood, determine how it should be organized for human use.
This includes determining:
major system sections
modules
submodules
dashboards
standalone views
combined views
navigation
relationships between systems
which functionality deserves its own PHP/view
which functionality belongs together on a labeled dashboard
how the user moves through LEGAiSEE
The order of LEGAiSEE business execution to put the system together in a Pipeline order
Do not design the final UI before this system map is understood.
The site map should emerge from the actual capabilities and relationships discovered during archaeology.

6. STAGE 5 — RECOVER, FIX, FINISH, AND WIRE THE SYSTEM
Only after the system has been sufficiently mapped should implementation recovery begin.
The objective is to make the discovered LEGAiSEE functionality actually work together.
This includes:
fixing broken functionality
restoring disconnected functionality
completing unfinished functionality
connecting orphaned-but-valuable systems
resolving duplicate/conflicting implementations
fixing data flow
fixing routing
fixing rendering
fixing backend/frontend connections
testing real functionality
Temporary ugly test pages are explicitly acceptable.
If a simple Test Page.php is the fastest and safest way to prove that a system works, create one.
The test page is a diagnostic tool, not the final UI.
Do not spend time making test pages attractive.
The priority is:
Does the underlying system actually work?

7. STAGE 6 — BUILD THE FINAL LEGAiSEE OS / UI
Only after the underlying system has been recovered, connected, and functionally tested should the final user interface be built/refined.
The final UI should make the recovered system:
understandable
navigable
usable
visually coherent
efficient
appropriate for John as the actual user
The UI is the final presentation layer.
It should not be used to hide unresolved architectural or functional problems underneath it.

8. DOCUMENT THE ENTIRE PROCESS
The recovery process itself must be documented.
Documentation should capture:
what was discovered
what was retained
what was restored
what was fixed
what was completed
what was integrated
what was replaced
what was deferred
what was deleted
why significant decisions were made
how systems connect
how the finished LEGAiSEE system works
Do not create an enormous documentation "Bible" prematurely.
Start with a Master Table of Contents / roadmap.
Expand the chapters as the actual system becomes understood.

9. NON-NEGOTIABLE WORKING RULES
DO NOT REDESIGN THE SYSTEM PREMATURELY
The existing codebase contains potentially valuable work that may currently be disconnected.
Do not assume that a cleaner-looking new implementation is better than recovering an existing one.

DO NOT DELETE BASED ON ORPHAN STATUS ALONE
"Orphaned" means disconnected.
It does not automatically mean useless.
An orphaned system may contain valuable functionality that should be restored.

DO NOT REBUILD SOMETHING BEFORE DETERMINING WHETHER IT ALREADY EXISTS
Before creating a new implementation, search the existing codebase for:
duplicate functionality
alternate implementations
prototypes
abandoned implementations
engines
renderers
APIs
helper classes
existing data structures
This is especially important because the audit has already discovered examples where valuable functionality exists but is disconnected.

PRESERVE DISCOVERIES
When something potentially important is discovered, document it before modifying or removing it.

FOLLOW THE EVIDENCE
Do not assume what a system is supposed to do based solely on filenames.
Read the code and follow its actual behavior and connections.

WORK IN BOUNDED TASKS
Do not attempt to execute the entire LEGAiSEE recovery project in a single conversation.
Each Claude session should have a clearly defined current objective.
Finish that objective, document the result, update the project state, and leave a clean continuation point.

10. CURRENT AUDIT STATUS
The LEGAiSEE codebase contains approximately 1,243 files.
Approximately 185 files (~15%) have been fully or partially covered by the audit.
Approximately 1,058 files remain to be opened.
The audit distinguishes between:
fully read/audited files
connectivity-checked files
files whose contents have not yet been examined
This distinction is important.
"Connectivity checked" does NOT mean "fully understood."

11. COMPLETED AUDIT AREAS
The following areas have already been audited to varying degrees:
Sidebar — Graph & Entities
7 files.
Finding:
Network Graph shows counts only; real graph data exists but is unwired.
Sidebar — Excavation
6 files.
Finding:
Ingest file-upload has a confirmed silent-failure bug.
Sidebar — Intelligence Engines
7 files.
Findings include:
Insight is a mis-wired Ingest duplicate.
Predictive Link V1 output is destroyed by the renderer.
Sidebar — Command
5 files.
Finding:
uic_v1.php is a good renderer but is barely used.
Planning, Clients & Cases, Tools + Sidebar Summary
Approximately 12 files.
Finding:
Compare module is a stub while the real compare_engine.php is orphaned.
engine/
Approximately 36–37 files.
Important discovery:
plain_english_helper.php appears to be a ready-built unused fix.
More importantly:
15 orphaned engine files appear to form a real unfinished autonomous-agent pipeline.
This discovery is particularly important.
Do not dismiss those files merely because they are orphaned.
api.php / api/v8/
Approximately 30 files connectivity-checked.
Finding:
Entirely unreachable; api.php has zero callers.
cli/
9 files connectivity-checked.
Finding:
Only reachable through an orphaned index.php prototype.
Top-level index.php
Read and live-tested.
Finding:
Separate abandoned prototype that remains directly reachable by exact URL.
ExcavationCommand/
3 files connectivity-checked.
Finding:
Zero references anywhere; fully orphaned.
ProjectManager/
88 files.
External connectivity has been confirmed dead from the main shell/modules.
The internal contents have not yet been read.
Therefore the internal state of ProjectManager remains unknown.

12. OTHER PARTIALLY AUDITED AREAS
kernel/
21 files.
High priority.
This is foundational plumbing involving areas such as:
database connection
bootstrap
module registry
It is especially important because it is already associated with the SQLite/MySQL migration problem.
Top-level standalone PHP files
51 files.
Known mixture of:
load-bearing files
test/debug clutter
unknown-purpose systems
Examples of potentially important unknowns include:
ai_process.php
dossier_v2.php
intelligence.php
mission.php
response.php
indexer.php
parser.php
semantic_engine.php
excavation_engine.php
cluster_engine.php
Some may represent top-level duplicates of functionality also found under engine/.
This should be investigated rather than assumed.
ui/
19 files.
This is the rendering layer and includes the already discovered orphaned compare_engine.php.
Top-level api/
Approximately 45 files remain unread.
Only search_load.php and files_action.php have so far been confirmed live.
components/
6 files.
Not yet examined.
database/
2 files.
Not yet examined.
_backup/
1 file.
Likely historical/low priority, but not yet formally closed.

13. CURRENT AUDIT PRIORITY
Unless new evidence changes the priority, continue in this general order, unless these are already done:
kernel/
Top-level standalone PHP files
ui/
Top-level api/
ProjectManager/ internals
components/
database/
_backup/
This order is a starting point, not an immutable command.
If audit evidence reveals that another area is higher leverage, document the reason before changing priority.

14. SESSION START PROTOCOL
At the beginning of a new Claude conversation:
Step 1
Read this Preface.
Step 2
Read the current project state / continuation document.
Step 3
Determine the current project phase and current bounded task.
Step 4
Read only the relevant audit/documentation/code required for that task.
Step 5
Work on that task.
Step 6
Do not unnecessarily reconstruct the entire historical conversation.
Step 7
At the end of the session, update:
completed work
discoveries
decisions
unresolved issues
next task
relevant documentation
audit counts/status
The next Claude session should be able to continue from those artifacts without needing the previous conversation.

15. SESSION COMPLETION PROTOCOL
Every significant work session should leave behind a concise continuation record containing:
SESSION DATE:

CURRENT PHASE:

TASK:

WHAT WAS EXAMINED:

WHAT WAS DISCOVERED:

WHAT WAS CHANGED:

WHAT WAS NOT CHANGED:

DECISIONS MADE:

SYSTEMS AFFECTED:

DOCUMENTATION CREATED/UPDATED:

TESTS PERFORMED:

KNOWN PROBLEMS:

QUESTIONS REQUIRING FUTURE DECISION:

NEXT RECOMMENDED TASK:
This record is more important than preserving the entire conversation.

16. MASTER TO-DO / DOCUMENTATION TOC
This is intentionally a living structure.
Do not fill in chapters merely for the sake of filling them.
PART I — SYSTEM ARCHAEOLOGY
Complete Codebase Audit
System Inventory
Connectivity Map
Orphaned Systems
Duplicate / Conflicting Systems
Existing Engines
Existing Renderers
Existing APIs
Existing Data Structures
PART II — SYSTEM TRIAGE
KEEP
RESTORE
FIX
FINISH
INTEGRATE
REPLACE
DEFER
DELETE
PART III — THE ACTUAL LEGAiSEE SYSTEM
Core / Kernel
Excavation
Intelligence
Graph / Entities
Command
Planning
Clients / Cases
Tools
Project Manager
APIs
Other Discovered Systems
PART IV — SYSTEM MAP
System Relationships
Data Flow
Module Relationships
Navigation
Views
Dashboards
Site Map
PART V — SYSTEM RECOVERY
Broken Systems
Disconnected Systems
Incomplete Systems
Integration
Functional Testing
Temporary Test Pages
PART VI — FINAL LEGAiSEE OS / UI
Final Information Architecture
Navigation
Dashboard
Module Views
User Experience
Visual Design
PART VII — FINAL DOCUMENTATION
Final System Overview
System Map
Technical Documentation
Functional Documentation
User Documentation
Maintenance / Continuation Documentation
This TOC is allowed to change as the actual system is discovered.

17. DEFINITION OF SUCCESS
The project is not successful merely because:
the PHP executes
pages load
errors disappear
the UI looks good
individual modules work in isolation
The eventual objective is a coherent, functioning LEGAiSEE system in which the valuable functionality that already exists has been identified, preserved where appropriate, repaired/restored where appropriate, completed where appropriate, connected where appropriate, and presented through a usable final interface.
The final system should reflect what has actually been discovered and validated rather than an imagined architecture imposed before the archaeology is complete.

18. MOST IMPORTANT INSTRUCTION TO CLAUDE
Do not try to finish LEGAiSEE in this conversation.
Your job is to advance the project from its current documented state to the next verified state.
Preserve what you learn.
Document what you change.
Do not make the next Claude session depend upon the memory of this Claude session.
The project files and documentation are the persistent memory.
The conversation is temporary.

CURRENT PROJECT POSITION
We are currently in SYSTEM ARCHAEOLOGY / AUDIT.
The next major priority is:
Continue completing the audit, beginning with kernel/, unless the current project state specifies a newer task.
Do not jump to final UI design.
Do not prematurely delete orphaned systems.
Do not redesign LEGAiSEE.
First determine what LEGAiSEE actually contains.
Then decide what survives.
Then map it.
Then recover it.
Then make it usable.



Why I would use this version
This is deliberately not much longer than your original Preface, despite adding the operating rules. The important difference is that it separates project knowledge from instructions about how Claude should work.
That matters for the exact problem you're trying to solve.
Your original document tells Claude:
Here is what we've discovered and what we intend to do.
This version additionally tells Claude:
Here is how you are supposed to behave when you enter a fresh context.
I would save this as something like:
LEGAiSEE_MASTER_PREFACE.md
Then separately maintain:
LEGAiSEE_CURRENT_STATE.md
and eventually:
LEGAiSEE_MASTER_TOC.md
That gives you a small permanent bootstrap + changing state + bounded task, rather than repeatedly feeding Claude the entire historical conversation.
And I would not put all ~1,243 files, all audit reports, or the entire original chat into the Preface. Claude can retrieve/read those only when the current task requires them. That is the part that will give you the biggest context-efficiency benefit.




<a id="doc-18"></a>
## 18. LEGAiSEE — What the Orphaned Engine Files Actuall….md

*Source: `_governance/Docs/WEBSITE/LEGAiSEE — MASTER PREFACE 9-3-26_PROJECT BOOTSTRAP-FULL/LEGAiSEE — What the Orphaned Engine Files Actuall….md` · 8270 bytes · 50 lines · encoding normalized to UTF-8*

LEGAiSEE — What the Orphaned Engine Files Actually Are
You asked the right question: they weren't built for nothing. Read through all 15+ of them. They fall into two very different categories that need two very different answers.

CATEGORY 1: A ready-made fix for today's #1 problem — plain_english_helper.php
This one is not speculative architecture. It's a direct, already-built solution to the exact core finding of this whole audit.
Its own file header says, verbatim: "Every module currently shows raw numbers. This helper converts them into sentences a client can read."
Someone — almost certainly a past AI session — diagnosed this exact problem before, and built the fix. It has working, specific translator functions for:
Relations (lee_interpret_relations)
Graph / Network (lee_interpret_graph)
Anomaly (lee_interpret_anomaly)
Insight (lee_interpret_insight)
Recommendation (lee_interpret_recommendation)
Cluster (lee_interpret_cluster)
Cross-Case (lee_interpret_cross_case)
Time Intelligence (lee_interpret_time_intelligence)
Plus a generic fallback for anything not named above.
That list maps almost one-to-one onto the modules flagged in the earlier audits as "real data, dumped as raw JSON" — Relations, Network Graph, Cross-Case Engine, Time Intelligence, Anomaly, and Recommendation are named specifically.
Why it's disconnected: nothing calls lee_interpret(). It was built, and then the work to actually route each module's output through it — replacing json_encode($content) with lee_interpret($module, $data) — never happened. It's a finished tool sitting in a drawer.
Should it be wired in? Yes — this is close to a genuine "we already built the fix" situation, not new work. It doesn't need to be designed; it needs to be called. This should move to the top of whatever fix-priority list comes out of the audit, above the uic_v1.php approach discussed earlier — this file already exists specifically for this purpose, hand-tailored to these exact modules, and doesn't require touching the rendering machinery in shell.php at all.

CATEGORY 2: A real, coherent, unfinished "autonomous intelligence" architecture
The rest — goal_engine, goal_generator, goal_alignment, goal_arbitration_engine, goal_conflict_resolver, long_horizon_planner, decision_governor, governance_policy_engine, graph_mutation_engine, execution_feedback_engine, cross_case_learning_compiler, temporal_memory_engine, memory_evolution_engine, pattern_stability, insight_mutator, system_behavior_spec — are not random scraps. Read together, they form one coherent pipeline, in order:
goal_generator.php — scans the graph, groups signals by cluster, proposes candidate goals.
goal_alignment.php — scores how well a graph node supports a given goal (a simple keyword-overlap + strength/priority formula — functional but basic, not sophisticated NLP).
goal_arbitration_engine.php — filters out low-confidence goals (below 60%), ranks the rest.
goal_conflict_resolver.php — removes contradictory goals, keeps the higher-priority one.
pattern_stability.php — statistically checks a pattern isn't just noise before it's allowed to become a goal (needs 5+ data points, checks variance).
long_horizon_planner.php — looks at historical trend + the surviving goals, simulates where the system is heading.
decision_governor.php — the actual gatekeeper: scores a proposed action starting at 100 and subtracts points if it's not goal-aligned or violates other rules — this is what would decide whether the system is allowed to act on its own conclusions.
governance_policy_engine.php — the constraints file: max 10 active goals, max 200 queued tasks, max 15 "mutations" per cycle, plus named prohibited behaviors.
graph_mutation_engine.php — labeled in its own header "controlled self-rewriting intelligence layer" — actually edits the graph based on insights.
execution_feedback_engine.php — compares what the system did against what actually happened, generates a learning signal.
cross_case_learning_compiler.php — aggregates those learning signals across every client/case into system-wide weights, separating universal patterns from single-case noise.
temporal_memory_engine.php / memory_evolution_engine.php — snapshot the system's state and beliefs over time, so it can be compared later ("what we believed then vs. now").
system_behavior_spec.php — a config file naming LEGAiSEE's primary domain (client business intelligence) and listing intended future expansion domains: CRM, archaeology AI, document intelligence, media analysis, field data processing.
This is not filler code. It's a real, thought-through design for a self-directing system: propose goals from real data → filter/rank/deconflict them → check they're stable, not noise → plan a trajectory → gate any action against goals and hard constraints → act → measure the outcome → learn from it, per-case and system-wide → remember what changed over time.
And here's the important part: this is the same architecture already described in your [[legaisee-authority-engine]] vision doc — recommendations with a full lifecycle (evidence → decision → outcome → reassessment), quarterly system evolution, versioned beliefs over time, a change-detection engine. Someone (likely during a Windsurf or GPT "architect mode" session, matching the pattern already flagged in that file) started actually building toward that vision at the code level — and it stopped mid-wiring, before anything in modules/ was ever connected to it.
Why it's disconnected — most likely explanation: this is exactly the shape of a multi-session AI build that ran out of runway (quota, context, or scope) after the components were written but before the last step — wiring them into the live request path — happened. Nothing here looks abandoned due to being wrong; it looks abandoned due to being unfinished.
Should it be wired in?
Honestly — not yet, and not as the next move. Two reasons:
It depends on things that don't exist yet. This whole pipeline assumes a goals database table, and assumes the graph/entity data underneath it is trustworthy — but this same audit found the graph pipeline itself has wiring gaps (Network Graph not reading network.json) and a presentation layer that hides real data. Autonomous goal-generation built on top of a foundation that's still being stabilized would just produce a more sophisticated version of the same "confidently wrong/invisible" problem already found everywhere else today.
It's the single biggest scope risk in the whole codebase. This is the exact kind of thing you flagged wanting to avoid — an ambitious autonomous system becoming its own months-long project, layered on top of a foundation that isn't finished.
Is it a feature you'd lose by not wiring it in right now? No — nothing currently depends on it, so leaving it alone loses nothing. It's safe to set aside as a real, already-designed future phase — worth keeping (don't delete it), worth referencing when the Authority Engine work resumes, but not worth activating until the basics (presentation, real ingest, correct wiring) are solid enough to trust feeding it.

Direct answers to your four questions
What do they do? One (plain_english_helper.php) is a ready-made fix for today's core finding. The rest form a real, coherent autonomous goal/planning/governance/learning pipeline.
Why were they built? Almost certainly a prior AI session working toward the same long-term vision already in [[legaisee-authority-engine]] — persistent, evolving, self-improving business memory — starting at the code level before the foundation under it was ready.
Why are they not connected? Most likely ran out of build session before the final wiring step. Nothing found suggests they were abandoned because they were broken or wrong.
Should they be connected? Do you lose a feature by not doing it now? plain_english_helper.php — yes, connect it soon, it's a near-free fix. The goal/planning/governance cluster — no, not yet; nothing depends on it today, and wiring it in before the foundation is stable would risk becoming exactly the kind of open-ended project you've said you want to avoid.




---

# B. Claude Memory — micro-audits, checklists, state (Aug 2026)


<a id="doc-19"></a>
## 19. 8-24-26_Legaisee Master System Law.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-24-26_Legaisee Master System Law.md` · 12687 bytes · 64 lines · encoding normalized to UTF-8*

8-24-26_Legaisee Master System Law
Summary
LEGAiSEE Master System Law v1.0 — the approved single source of truth governing doc for the whole system end to end (build order, identity layer, client lifecycle, divisions, brain pipeline, public site, command center, doctrine, bugs, v2 list); governs and supersedes ad hoc decisions in [[legaisee-os-vision]] and [[legaisee-command-center]]
Details
Delivered "LEGAiSEE Master System Law — The Build Table of Contents, Version 1.0" as the single source of truth for LEGAiSEE's structure end to end. Rule: once approved, work proceeds by opening this doc, finding the next unbuilt or broken item, and building only that. Changes only as bug-fix corrections or explicit deliberate revisions John approves — new ideas become a v2 note, not a mid-build detour. Pipeline: Claude thinks, executor builds, John approves, nobody improvises. Code delivery format: complete replacement files with explicit paths, no patches/diffs/snippets unless John explicitly asks otherwise.
Document build order (lower layers built first since upper layers depend on them): I. Business Definition, II. Identity Layer, III. Operation Ladder, IV. System Divisions, V. Intake & Excavation/Brain Pipeline, VI. Public Site, VII. Command Center, VIII. Methodology & Doctrine, IX. Known Issues/Bugs, X. Out of Scope for v1.
Part I — Business Definition
LEGAiSEE = solo-practice luxury B2B consultancy; proprietary methodology "Business Archaeology" — forensic excavation of a company's own institutional history (abandoned assets, proven-but-forgotten positioning, Golden Era patterns) reconstructed into a present-day Authority System. Recovers proven messages, never invents them; grades evidence on a 4-tier confidence scale.
Target client: businesses operating 5–10+ years, OR family/generationally owned, OR $30M+ revenue; primarily San Antonio/Austin I-35 corridor. Capacity deliberately capped by design.
Core gemstone metaphor (canon across site, methodology, deliverables): Stage 0 Natural Habitat (undiscovered history) → Stage 1 Raw Stone (excavated, uncut) → Stage 2 Cut & Shaped/Lapidary (refined) → Stage 3 Mounted (set into Authority System) → Stage 4 Museum Display (delivered/verified/presented).
Bedrock Pledge: every claim excavated or triangulated, never invented (Pillar I); 3-Source Rule — two independent sources or one Tier 1 verified primary (Pillar II); Continuous Verification — new evidence after delivery incorporated via addenda, never hidden (Pillar III).
Hierarchy of Truth: Tier 1 Verified Primary, Tier 2 Probable, Tier 3 Plausible, Tier 4 Uncertain. Client-facing confidence label set (canon, used verbatim): VERIFIED / PROBABLE / PLAUSIBLE / UNCERTAIN / UNVERIFIED.
Part II — Identity Layer (OPEN, current top build priority)
Founding mandate: whole system based on a file-tree system, John wants full control of where things are stored. Replaces three fragmented identity schemes (client_id/case_id, brain_id, raw prospect_ingests rows) with one: tree_nodes table.
Every client/project/sub-project/item is a row in tree_nodes: node_id (PK), parent_id (nullable FK, null = top-level client), name, node_type (client/project/subproject/item), sort_order, created_at, updated_at. Depth unlimited, never hard-coded.
api/tree.php: create, rename, move (re-parent), delete (BLOCKS if node has children, surfaces warning — no silent cascade), get_tree.
Migration: three live prospects in prospect_ingests (Brad Moore Builders, Faust Hotel, Cowboy Plumbing) become the first three top-level nodes; prospect_ingests gains a node_id column rather than being replaced.
Rule: no new feature/table/pipeline stage may invent its own identity scheme — everything attaches to node_id (intake.php, Brain pipeline, network_add_node.php, search.php all pending rework to key off node_id).
Part III — Operation Ladder (client lifecycle)
Sequence: Lead Generation → Dig Site Surface Scrape (lead magnet) → Shallow Dig $2,500 (Golden Era estimate, 1–3 surfaced assets, competitive gap mapping, one inflection point, excavation brief; delivered live) → Full Signal Excavation (Exhibit A) → Full Institutional Record (Exhibit B) → Institutional Signal Retainer (Exhibit C) → Enterprise Commissions (Enterprise Signal Retainer, The Permanent Record, Exhibit D CAMERA, Private Commissions Exhibits E/F/G).
Build requirement: each rung must eventually be a queryable status/milestone on a client's tree node.
Part IV — System Divisions (access-control concern, not separate codebases; all share tree_nodes)
LEGAiSEE Division: excavation/dig/search assistant (40+ channel taxonomy, multi-model search), the Brain/OS (ingests, organizes, connects, analyzes, builds Shallow Dig reports/Dossiers/Dig Reports, suggests strategy), continuous monitoring + Client Portal updates, self-monitoring.
Private Division: John's own ingests (personal AI chats, LEGAiSEE growth notes) — same engine, walled off from any client-facing surface.
Operations Division ("Legaisee Operations"): CRM, billing, email, and the Client Portal itself.
Part V — Intake & Brain Pipeline
Core defect: none of the nine Brain files (intake.php, search.php variants, brain_start/stream/stream_v4/orchestrator/memory_graph/dossier/state/synthesis.php, network_add_node.php) carry client identity — only file + brain_id. Missing layer, not a one-file bug.
Fix (locked): brain_start.php requires + persists node_id in session JSON alongside brain_id; every downstream stage reads node_id from the session (never re-collects from frontend) — mirrors the pattern brain_dossier.php/brain_state.php already use for brain_id lookups.
Rebuild order: tree_nodes live → brain_start.php revised → other six brain files revised to read node_id from session → network_add_node.php re-pointed to node_id → intake.php rebuilt as a real form bound to node_id → search.php demoted to secondary filter over the tree.
Open question flagged for later: brain_synthesis.php confidence scoring is currently a random placeholder (rand(60,95)) — must be replaced with real Hierarchy-of-Truth-based scoring before any Dossier output reaches a client. Not blocking the identity rebuild.
The Master System Law itself, and other governing/spec docs like it, are working Google Docs John has kept through the build and that keep changing as the build progresses — not static. He also has a large volume of LLM chat logs containing similar/overlapping planning info that he wants ingested into the system's Brain/intel layer to be organized and structured into coherent docs/ideas, rather than living scattered across chats.
Part VI — Public Site (legaisee.com)
Seven destinations: index.html (Home), archaeology.html, method.html, serve.html (Industries), practitioner.html ("Exhibit Zero: A Live Reconstruction" — archaeology performed on John himself), commissions.html (Exhibits A–G + CAMERA + Bedrock Pledge), registry.html (confidentiality cells, intake entry point).
Locked design tokens: Obsidian #050505 (bg), Gold #C9A961 (accent/CTA), Platinum #EBEBEB (text); fonts Cinzel/Cormorant Garamond/Inter (display/body-serif/UI). Violet is forbidden — remnant of a discarded earlier theme.
.card--illumine effect (museum top-light, gold, hover-triggered) is an approved closed spec applied to: Exhibit cards + Bedrock Pledge clauses (commissions.html), three archetype cards (serve.html), Lindy proof cells (archaeology.html), confidentiality cells (registry.html). CSS lives in legaisee-luxury.css.
Logo splash: animated SVG intro, ~58 addressable spark points in ~12 groups, three diamond gems + polyhedron as primary ignition points; in production in Affinity Designer/Illustrator (asset task, not code task, until delivered).
Part VII — Command Center (internal backend, legacy/current)
Server: /home/carrmulti/www/www/commandcenter/ — SureServer, MySQL 5.7 Percona, PHP 8.4. DB: carrmulti_legaiseearchive.
Locked rules: shell.php is the sole page-rendering routing entry; kernel_db() is the only permitted DB access pattern; ui/global.css is the only permitted stylesheet; AJAX cannot route through shell.php (ob_start buffering) — JSON endpoints must live in api/ and be called directly.
Modules built: prospect excavation w/ entity extraction, Dig Review interface, search module (3-column, pending demotion), file manager, ingest module, 18+ file governance/doctrine system.
Part VIII — Doctrine (canon reference copy, implemented faithfully wherever referenced)
Ten Interlocking Frameworks: 40+ Channel Taxonomy (8 evidence classes), 3-Source Rule, Hierarchy of Truth, Triangulation Protocol, Continuous Verification, 8-Dimension Voice Profile, ROI Triggers, Competitive Asymmetry, Private Archaeology Protocol.
CAMERA Authority Framework™ (Exhibit D, on commissions.html): Character Positioning, Audience Psychology, Monetization Alignment, Engagement Engineering, Repurposing Infrastructure, AI Acceleration.
Pricing ladder (canon): Phase 0 Surface Survey $2,500 · Exhibit A Archaeological Excavation $5,000–$7,500 · Exhibit B The Lapidary $8,500–$18,000 · Exhibit C The Mounting from $4,500/mo · Exhibit D CAMERA $6,500–$7,500 · Exhibit E Master Craftsman's Presence $18,000/mo · Exhibit F Estate & Provenance Appraisal $25,000–$50,000 · Exhibit G Curator's Secret Intelligence $35,000/qtr.
Part IX — Known Issues (working list, removed only when confirmed fixed)
REVISION (8/19, John's own call): Law docs are working reference points, not scripture — explicitly revisable as the system evolves. First confirmed revision: the Authority Marketing System component (turning reviewed Findings into the actual structured client deliverable) was assumed done/covered by report_module.php but is confirmed missing. Reclassified from "v2 polish" to a real v1 gap — client journey should not be run for a real first client until this exists, to avoid discovering missing pieces mid-engagement.
Standing near-term priority (8/19): before building anything new, verify the already-built Client View/Drill-In (Timeline/Graph/Findings/Report/Payment/Email) works live end-to-end on one real case — John has not personally seen this run start to finish despite it being marked built.
network_add_node.php double-write/double-echo: FIXED this session, pending deployment confirmation.
Brain pipeline missing client identity: diagnosed, fix designed (Part V), not yet implemented.
intake.php under-built (too few fields, no node binding): OPEN.
2–3 competing search.php UIs: OPEN, to be demoted once tree browsing exists.
brain_synthesis.php placeholder scoring (rand(60,95)): OPEN, flagged.
No file-tree/node system exists yet: OPEN — Part II is the spec, not yet built.
Part X — v2 / Deferred (not rejected, just sequenced; needs explicit approval to move up)
Long-horizon vision (not v1): once ProjectManager/ is finished as its own clean standalone app, connect it to LEGAiSEE's Brain/decision engine so the engine can author its own work orders directly into ProjectManager (e.g. detecting a needed PHP maintenance/upgrade and creating the task itself) rather than just surfacing findings in a report. Same mechanism extends client-facing: dig-down findings → client portal updates → scheduling, all routed through the same task/milestone spine — ProjectManager, client dig-down, client portal, and scheduling becoming cohesive connected "wings" for both John's own operations and the client engagement, not just internal system upkeep. Explicitly sequenced behind ProjectManager reaching a finished, isolated v1 first — the isolation is what protects this integration from becoming another half-built mid-build detour.
Client Portal (full client-facing login, update feed, report access).
CRM, billing, email integration inside Legaisee Operations.
Self-monitoring/predictive maintenance system.
Real multi-model excavation assistant ("4up AI models / 40+ locations" search engine); model_router.php exists but not yet reviewed/specified.
Real confidence scoring in brain_synthesis.php to replace placeholder.
Animated SVG logo splash integration (asset itself is in production now; integration is v2).
Appendix B — Server & Path Reference
Client tree path (current, pre-Part II): /data/clients/{client_id}/cases/{case_id}/tasks/queue.json. API endpoints: /api/v8/ (called directly, never through shell.php). Brain session files: /data/brains/{brain_id}.json. Brain memory graph: /data/brains/graph.json. Normalized source documents: /normalized/. Public site stylesheets: legaisee.css (base), legaisee-luxury.css (luxury v2.0).




<a id="doc-20"></a>
## 20. 8-24-26_Legaisee Ui Micro Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-24-26_Legaisee Ui Micro Audit.md` · 7056 bytes · 33 lines · encoding normalized to UTF-8*

8-24-26_Legaisee Ui Micro Audit
Summary
Function-level micro-audit of LEGAiSEE's UI rendering systems (ui/ folder, root /components/, and a newly-discovered third live shell system) — same rigor as the brain micro-audit, applied to UI rendering. Read this to resume or reference the UI micro-audit specifically.
Details
Second micro-audit in the sequence (after legaisee-brain-micro-audit), going down the 6 rebuild families list per John's instruction: examine everything first, document EVERYTHING, only THEN do system-wide triage, THEN execute repair/fix/delete as one pass, THEN build — no fixing/coding mid-examination
Source: commandcenter.zip, read directly via bash/view tools in Claude's sandbox
STATUS: INVENTORY COMPLETE for this cluster
MAJOR NEW DISCOVERY — a third, real, currently-live UI/shell system nobody had found yet
Beyond the two systems the macro audit already documented (inline-HTML "live" version scattered across pages, and the dead registry-based component system), there is a THIRD system:
shell.php (root level) — a full, mature module-routing app shell. "Grand Lobby" landing page, top nav, sidebar grouped into 7 categories (Command, Planning, Clients & Cases, Excavation, Intelligence Engines, Graph & Entities, Tools) listing 34 registered modules with per-module working/not-working status badges.
kernel/module_registry.php — the real module registry shell.php routes through (34 modules mapped to their module files) — NOT the same file as ui/registry.php or ui/component_registry.php (name collision risk, already flagged pattern in this codebase).
modules/utils/uic_v1.php — "UI Contract v1": a typed rendering contract (uic_artifact, uic_dataset, uic_system helper functions + a real switch-based uic_render() dispatcher) — more architecturally mature than either previously-documented UI system.
CONFIRMED LIVE, not orphaned: shell.php is directly linked from 10+ live module files (ingest_module.php, pm_module.php, dig_review_module.php, insight_module.php, search_module.php, governance_module.php, graph_module.php, clients_module.php, files_module.php, payment_module.php) plus prospect.php, api/search_load.php, api/files_action.php, ingest.php — all treat it as the navigation hub to return to.
Distinct from pages/shell_template.php — the earlier "Grand Lobby" already logged in legaisee-brain-micro-audit's companion Brain Dashboard fragments thread. That one is a simpler, all-modules-as-wings single-page layout; this shell.php is a proper routed multi-page shell with per-module status tracking.
Distinct from index.php — the file previously documented (in the top-level-files audit) as "read + live-tested by John," which does unrelated data/portfolio+data/clients JSON scanning, nothing to do with this module-shell system.
OPEN QUESTION, not yet resolved: which of index.php / shell.php / pages/shell_template.php is the actual current production entry point a browser hits today. shell.php's inbound-link pattern strongly suggests it's the real current one, but this needs a direct confirmation (e.g. checking what URL the live site currently loads) before triage assumes it.
CORRECTION to the original macro audit
The macro audit's UI report concluded global.css is functionally dead because kernel_assets() (the function meant to link it) is never called. This is WRONG as stated: global.css IS live, linked via hardcoded literal <link rel="stylesheet" href="/commandcenter/ui/global.css"> tags directly in shell.php and 7 modules (ingest_module.php, pm_module.php, insight_module.php, search_module.php, governance_module.php, build_dossier.php, files_module.php) — bypassing the unused kernel_assets()/legaisee_ui_bootstrap() indirection entirely. The indirect path is dead; the destination file is not.
CONFIRMED still fully dead — the registry-based component system (11 files)
Precise connectivity check (not substring-grep, which produced false positives against kernel/module_registry.php and ui/component_registry.php) confirms ui/registry.php has ZERO real callers anywhere. The whole family remains dead as originally found: ui/component.php, component_boot.php, component_contract.php, component_registry.php, components.php, layout_contract.php, layout_engine.php, registry.php, theme.php, ui.php, ui_boot.php — plus ui_engine.php, which IS live but only via the single 'view' module doorway already documented in the macro audit.
New defects found within the dead component system (documentation only, no fix made)
component_registry.php has dead code after its own return statement: file opens with return [...] (the array ui/component.php actually reads), followed by function definitions (ui_register, ui()) that are unreachable at runtime after the return — though PHP would still compile/declare the function signatures themselves; the $UI_COMPONENTS = []; initializer line never executes. Two competing registry designs (static path-array vs. function-closure registry) crammed into one file.
component_registry.php's paths are stale: points to ui/components/card.php (exists), but button.php, heading.php, input.php, folder_tree.php do NOT exist in ui/components/ — confirms/refines the macro audit's "points to 4 files that don't exist" note.
ui/theme.php is not valid PHP — raw CSS content with no <?php tag; would pass through as literal output if ever included.
ui/layout_contract.php is not valid PHP — a raw JSON-like array literal, no assignment or php tags; reads as a scratch/notes file, not executable code.
Real naming/signature collision found: ui_folder_tree() is defined twice — once in ui/components.php (dead system) and once in root /components/ui_folder_tree.php (used by the dead component_boot.php registration) — same name, near-identical logic, in two locations. ui_card() is defined twice with CONFLICTING SIGNATURES — ui/ui.php's version takes (string $title, string $content), root /components/ui_card.php's version takes (array $props) — if both ever loaded in the same request, PHP would fatal-error on redeclaration.
The live 'view' module doorway (already known, re-confirmed)
ui_engine.php + layout.php, reached only via modules/view_module.php (?module=view) — a page-compare/executive-diff tool. Still the only live path into the ui/ folder's own systems (separate from the new shell.php/uic_v1.php discovery above, which lives outside ui/ entirely).
STILL TO DO
Resolve the open question: is shell.php the actual current production entry point? (verification, not a fix — just needs confirming which URL the live site serves)
Continue down the rebuild-family list per John's instruction — next: recommendation engine, semantic-diff/excavation-session cluster, ingested-content search, ProjectManager/ (all still awaiting their own micro-audit pass)
All triage/DELETE/KEEP calls for this cluster wait for the single system-wide triage-then-execute pass per legaisee-recovery-roadmap's corrected sequencing — nothing gets acted on from this file in isolation




<a id="doc-21"></a>
## 21. 8-24-26_Legaisee Brain Micro Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-24-26_Legaisee Brain Micro Audit.md` · 11949 bytes · 42 lines · encoding normalized to UTF-8*

8-24-26_Legaisee Brain Micro Audit
Summary
Focused function-level micro-audit of LEGAiSEE's autonomous agent/brain system across its 3 rebuild locations (engine/, api/v8/, api/ top-level) — same rigor as the whole-system macro audit, applied to just this cluster. Read this to resume the brain micro-audit specifically.
Details
Triggered because the macro audit found the autonomous agent/brain concept rebuilt from scratch 3 separate times (engine/, api/v8/, api/ top-level ~30 files), never shipped/wired into the live UI in any of the 3 — John confirmed he still wants a real brain/intel/decision engine (e.g. as the future engine that could author its own ProjectManager work orders, per legaisee-master-system-law Part X v2 vision) and wants this treated as a full standalone micro-audit rather than a single-cluster triage call
Requested method: same shape as the whole-codebase macro audit but scoped to just this cluster — determine whether the 3 attempts are duplicate rebuilds of the same functions, or contain genuinely separate functions that could be merged into one better master brain system; produce a micro/macro view of the brain system specifically (what exists, what potentially works, what doesn't, what's kept/fixed/merged/trashed) before any triage label is assigned
Scope: engine/ (brain-related subset of its 36-37 files), api/v8/ (~30 files), api/ top-level brain cluster (~30 files: agency_, agent_, brain_, case_, network_*, node_builder.php, graph_synthesizer.php, anomaly_detector.php, intel_cache.php, model_router.php, dossier.php, file_tree.php, excavate.php, excavation_run.php)
STATUS: FULL INVENTORY COMPLETE (2026-08-24 session 2). All of engine/ (9 brain files + portfolio_engine.php + dashboard_engine.php), all of api/ top-level brain cluster (30), all of api/v8/ (30/30). Source: commandcenter.zip re-uploaded 2026-08-24, unpacked and read directly. Next task: none left to read — proceed straight to overlap/merge map + per-function triage below.
FINAL BATCH FINDINGS (last 14 api/v8 files + 2 engine deps)
Bug class expanded: 3 more files carry the same corrupted-trailing-code defect (valid echo already fired, then a dead echo json_encode($response); exit; referencing an undefined var, double-emitting output) — build_edges.php, compare_networks.php, mesh.php. Total corrupted-output file count now ~13, not ~10.
Two more REAL/live-paradigm api/v8 files confirmed: build_graph.php (wires to engine/graph_engine.php's queue_graph_build_for_case, real) and graph_ranker.php (kernel_db(), entities table, real top-10 ranking) — same clean paradigm as get_cases.php/get_clients.php/network_add_node.php.
Self-contained fake flat-JSON universe identified as ONE family, not 6 separate ideas: create_network.php (originates data/network/{id}.json) + compressor.php + event_emit.php + build_edges.php (hardcoded test network_id "net_69eee12e374d30_99173905") + compare_networks.php + mesh.php — all read/write the same flat-file universe, zero DB, zero real AI. All require lib/semantic_diff_engine.php but most never call anything from it (dead require).
widget_registry.php — static hardcoded UI-schema reference data (4 widget types), comment claims "backend authoritative UI system" but no consumer found calling this endpoint anywhere.
generate_tasks.php — explicit stub, comment reads "TEMP SAFE OUTPUT (NO LOGIC YET)," unconditionally returns fake insight data.
debug_queue.php / debug_tasks.php — real raw-mysqli dumps of processing_queue/tasks tables, simple ops/debug tools, not brain logic per se.
run_worker.php — shell_exec() to cli/worker.php, real mechanism (actually invokes the worker), but shell_exec from a web-reachable endpoint is a fragile/risky pattern worth flagging even though the path is currently hardcoded (no direct user-input injection as written).
portfolio_engine.php (engine/, dependency of predictive_intelligence_engine.php) — loadAllCases()/buildGlobalGraph(), REAL functions but reads from a THIRD separate data location: data/clients/{client}/cases/{case}/network.json — neither MySQL nor the data/network/ flat-file universe above. Even the "most real" cluster has this unverified flat-file dependency; open question whether that path is ever actually populated live.
dashboard_engine.php (engine/, dependency of api/v8/dashboard.php) — renderDashboardPath(), real simple HTML-card renderer for a recommendations.json file. New fragment for legaisee-brain-micro-audit's sibling open thread (Brain Dashboard fragments) — doesn't match John's "node graph" memory (no graph here, just recommendation cards), but worth logging there too.
FINDINGS SO FAR
Cluster 1 — engine/ (9 files, 759 lines): Real function definitions (createCase, cross_case_engine, queue_graph_build_for_case, mutateGraph, buildPredictiveInsights, buildSemanticClusters). engine/cluster_engine.php is confirmed 0 bytes (dead empty stub). graph_data.php and graph_engine.php touch REAL MySQL tables (clusters, page, page_relations, processing_queue) — not toy JSON. predictive_intelligence_engine.php requires portfolio_engine.php (not yet located/verified — follow-up needed) and semantic_cluster_engine.php. This cluster looks like the most "real" of the three locations — actual DB-backed logic, not simulation.
Cluster 2 — api/ top-level brain cluster (~30 files, 950 lines): Confirmed 100% simulation, zero real AI calls anywhere. model_router.php's call_openai/call_claude/call_gemini are fake stubs that just echo the prompt back with a label prefix — no real API integration exists yet despite the function names. ALL data persists to flat JSON files in data/agency/, data/brains/, data/cases/, data/network/ — a fully separate universe from the live MySQL DB the rest of LEGAiSEE uses. brain_orchestrator.php + brain_synthesis.php together form the most ARCHITECTURALLY COHERENT skeleton found anywhere (build prompt → route to 3 models → weighted-confidence synthesis) — but it's built entirely on the fake model_router, so structurally right, functionally empty. brain_start.php already implements session-based node_id identity exactly as later locked in Master System Law Part V (uses $_SESSION['brain_node_id']) — this file's design was evidently kept/reused as the pattern for the real system.
Cluster 3 — api/v8/ (30 files, ~1310 lines): Contains TWO different paradigms mixed together, this is the key finding.
OLD/FAKE paradigm (agent.php, autonomous_engine.php, dossier.php, dossier_v2.php, cases.php, insights.php, patterns.php, forecast.php, predictor.php, investigator.php, learn.php, feedback.php, alerts.php, summary.php): all hardcode the SAME test network_id string "net_69eee12e374d30_99173905", read/write flat JSON in data/network/, deterministic threshold logic (counts signal vs anomaly node types) — no real AI, just toy math. Matches known issue already flagged elsewhere that dossier_v2/excavation share a hardcoded test ID.
REAL/LIVE paradigm (get_cases.php, get_clients.php, network_add_node.php): correctly use kernel_db() (PDO) + response.php + real MySQL tables (cases, clients, tree_nodes). network_add_node.php matches the CURRENT locked Identity Layer design in Master System Law Part V exactly (session-based node_id, inserts into tree_nodes) — this is likely the already-fixed/deployed version referenced there.
recommendations.php requires engine/recommendation_engine.php — this is the LIVE wiring path into the recommendation engine cluster (cross-reference for that cluster's own triage later).
insights_generate.php uses a DIFFERENT, older raw-mysqli $conn->query() pattern (not kernel_db()/PDO) — inconsistent DB access pattern vs. the rest, though the one user input (case_id) is intval()'d so not SQL-injectable as written.
dashboard.php requires engine/dashboard_engine.php (not yet examined).
feedback.php calls learn.php via a real internal curl loopback to a hardcoded localhost URL — workable but fragile.
CRITICAL NEW BUG CLASS FOUND (not previously known) — file corruption pattern across ~13 api/v8/ files: Looks like an interrupted/botched refactor (probably attempting to wrap all endpoints in a standard json_response() envelope) left broken fragments in place:
HARD SYNTAX ERRORS (file cannot execute at all right now): api/v8/agent.php (unclosed array, stray semicolon mid-literal), api/v8/forecast.php (duplicate <?php opening tag causes parse error), api/v8/alerts.php (same unclosed-array/stray-semicolon pattern as agent.php)
CORRUPTED TRAILING CODE (runs but produces double/malformed JSON output, references undefined $response variable): insights.php, patterns.php, predictor.php, investigator.php, learn.php, cases.php, memory_store.php, memory_weight.php, summary.php, autonomous_engine.php — each ends with a real, valid output followed by dead orphan lines echo json_encode($response); exit; that would emit a spurious extra "null" onto the same response body. This is a real, previously-undocumented bug set — worth flagging to John as its own follow-up regardless of what triage label the cluster gets, since 3 files are completely non-functional and ~10 more are silently corrupting their own API output.
MICRO-AUDIT COMPLETE — overlap map + per-function triage delivered
→ LEGAiSEE_Brain_MicroAudit_Overlap_And_Triage.md (presented to John 2026-08-24, not yet logged to his Google Doc)
Bottom line: no real merge scenario exists. Group A (real, DB-backed: graph_engine.php, semantic_cluster_engine.php, cluster_insights.php, graph_ranker.php, get_cases/get_clients.php, network_add_node.php) is the actual working foundation — already matches the locked Master System Law identity design, just needs a live UI page. Group B (fake flat-JSON "data/network/" universe: create_network, compressor, event_emit, build_edges, compare_networks, mesh.php) and the bulk of Group C (api/ top-level simulation cluster, ~26 of 30 files) are recommended DELETE as families, not file-by-file — Group A already does for real what they toy-simulate. The one genuinely missing piece, not a duplicate of anything: model_router.php (real AI-model calls — currently fake stubs). brain_orchestrator.php + brain_synthesis.php's architecture (prompt-build → multi-model route → weighted synthesis) is worth KEEPING as the design shape for a real model_router, once built.
Open decision for John: (a) build a real model_router.php and restore the orchestrator/synthesis skeleton on top of Group A's real data, or (b) treat "brain" as Group A's existing DB functions only, wired to a live page, deferring AI-model reasoning to a later phase.
Also: bug list expanded to ~13 files with corrupted trailing output (3 new: build_edges.php, compare_networks.php, mesh.php) — independent of triage, worth fixing/deleting regardless. portfolio_engine.php's data/clients/{client}/cases/{case}/network.json path is unverified as live-populated — flagged, not yet checked.
STILL TO DO
No fixing/repair/deletion work happens yet — John's explicit correction (2026-08-24): stay in examine/document mode across the WHOLE system per the 3-file protocol (Preface → Current State → Master TOC) until nothing is left to examine, THEN execute all triage decisions together, THEN repair/fix/delete, THEN build. This brain cluster's findings are documented and done, but they don't get acted on in isolation.
Verify whether data/clients/{client}/cases/{case}/network.json is ever populated live (portfolio_engine.php dependency) — documentation-only check, not a fix
Log dashboard_engine.php as a new fragment in the companion Brain Dashboard thread (open — no graph match, but a real fragment)
When the whole-system examine phase is finished, this cluster's Group A/B/C findings + DELETE recommendations feed into the single system-wide triage-then-execute pass (legaisee-recovery-roadmap Phase 2) alongside every other cluster




<a id="doc-22"></a>
## 22. 8-25-26_Legaisee Kernel Micro Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-25-26_Legaisee Kernel Micro Audit.md` · 8228 bytes · 36 lines · encoding normalized to UTF-8*

8-25-26_Legaisee Kernel Micro Audit
Summary
Function-level micro-audit of kernel/ (22 files + model/ subdir) — reveals a THIRD parallel data paradigm (page/folder wiki tables), a broken system_health.php self-check, a genuinely-broken task_generator.php function, and confirms part of the "fake" flat-JSON network system is actually live-wired
Details
Read directly from commandcenter.zip in Claude's sandbox, 2026-08-25 session, continuing the file-by-file examine phase after legaisee-modules-micro-audit
STATUS: kernel/ FOLDER FULLY READ (22 files + model/page_model.php)
Core scaffolding (real, consistent, no issues)
kernel_boot.php — canonical boot file: requires db.php + kernel_paths.php, starts session, sets global $db as a compatibility fallback, defines kernel_validate_runtime().
db.php — the one real kernel_db() PDO singleton, MySQL DSN built from config constants.
../db.php (root, one level up) — just a thin shim: requires kernel/db.php then sets $GLOBALS['pdo'] = kernel_db(), for older modules using the global $pdo pattern (semantic_cluster_module.php, vault_module.php, task_generator.php, etc. depend on this). Not a duplicate connection — just an alternate access shim. Confirms why some modules use kernel_db() directly and others use global $pdo.
config.php (root) — SAFE pattern: no credentials in the tracked file itself, just loads config.local.php if present. Not a repeat of the ProjectManager plaintext-password hazard.
kernel_paths.php — single source of truth for KERNEL_ROOT/DATA_ROOT/FILES_ROOT/CLIENTS_ROOT/CASES_ROOT/MEMORY_ROOT constants. Real, used everywhere.
kernel.php, kernel_contract.php — both intentionally emptied stubs with comments explaining why (moved to kernel_boot.php to avoid duplicate function definitions) — deliberate, not orphaned.
module_contract.php — rules-only doc comment (no functions), documents the module pattern (no DB connections, no layout, output-only).
module_registry.php — the real single source of truth mapping nav keys → module filenames (confirmed already cross-referenced against modules/ in the prior audit).
nav_engine.php — real session-based back-navigation stack (kernel_nav_push/kernel_nav_back), used by view_module.php.
guard.php — thin real wrapper requiring a live PDO or it dies; not clear anything currently calls kernel_guard() — not confirmed as dead, just not seen invoked yet.
NEW — a THIRD parallel data paradigm found: "page/folder wiki" tables
folder_engine.php, graph_engine.php (kernel/ version — different from engine/graph_engine.php already covered in the brain audit), and model/page_model.php all operate on folders, page, page_content, page_relations tables — a completely separate content/wiki-style schema from both (a) the flat-JSON data/cases/ universe and (b) the entities/relationships/clients/cases MySQL schema modules/ uses. Real, functional-looking code (recursive folder tree, file-as-node graph, LIKE-based page search) but not yet confirmed whether any live module actually calls these three files — need a follow-up "who calls this" check before triage.
NEW — system_health.php: a FOURTH self-inspection/diagnostics implementation, with its own bugs
Separate from modules/brain_module.php's inspection panel (already flagged) — this one is a dedicated JSON diagnostics endpoint checking DB tables, module registry, filesystem, and graph counts. Two real bugs found:
Module registry check is silently broken: it does array_column($registry, 'file') expecting rows shaped like ['file' => '...'], but kernel/module_registry.php actually returns a flat 'key' => 'filename.php' map — array_column on that shape returns an empty array every time, so missing_files and orphan_files are permanently vacuous/wrong (every real module would incorrectly report as "orphan").
Dead constant checks: reports on COMMANDCENTER_BOOTSTRAPPED and DB_AUTHORITY/SYSTEM_MODE — grepped the whole codebase, none of these constants are ever actually defined anywhere. Same "checks for something that was never wired up" pattern as brain_module.php's /system/ folder check.
Also runs a SELECT name FROM sqlite_master query against what should be a pure-MySQL PDO connection (per db.php) — either a harmless try/catch-suppressed leftover from an earlier SQLite era, or evidence this file hasn't been touched since the SQLite→MySQL migration. Consistent with a genuinely dead-but-present kernel/legaisee.db — a 0-byte SQLite file still sitting in kernel/ (same species as the already-fixed setup.php stray SQLite DB, but this one is NOT yet cleaned up).
NEW — task_generator.php is a genuinely broken function if ever called
createTasksFromRecommendations() mixes mysqli-style calls ($conn->prepare(), bind_param()) with a PDO call ($pdo->lastInsertId()) — but $pdo is never defined or declared global inside the function, only $conn is passed as a parameter. Calling this function would throw an undefined-variable / fatal error. Independent of any triage decision — this is a plain bug.
Flat-JSON "network.json" cluster (kernel/ versions) — partially CORRECTS the earlier brain-audit "100% fake" finding
cluster_intelligence.php (detectClusters — groups nodes by text similarity), graph_auto_builder.php (buildGraph — builds edges from keyword+text-similarity scoring), insight_generator.php (generateInsights — simple rule-based text on cluster labels), ingestion_pipeline.php (ingestToNode — converts raw text into a scored/typed/tagged node, appends to a case's network.json). All heuristic-only (string matching, similar_text()), not real AI — consistent with legaisee-brain-micro-audit's "Group B fake flat-JSON universe" finding. BUT: ingestion_pipeline.php's ingestToNode() is actually called live — from modules/ingest_module.php's file-upload handler, when a case_id is selected, it requires this file directly and calls ingestToNode() to add a node to that case's real network.json. This means part of the "fake" flat-JSON network system is not purely simulated dead code — it's reachable from a real, currently-live module. Worth flagging back to legaisee-brain-micro-audit as a correction: at least this slice of Group B has a genuine live caller, so "delete as a family" may need a carve-out for ingestion_pipeline.php specifically (or its caller needs to be cut too, John's call at triage).
NEW — engine_bindings.php is a dead/aspirational config
Static map of nav-key → expected engine filenames (system_insight_engine.php, system_recommendation_engine.php, decision_engine_v2.php, policy_enforcement_engine.php, execution_router.php, cross_case_engine.php) — these are the SAME nonexistent /system/ files brain_module.php's health-check looks for. Confirms those files genuinely don't exist anywhere in the codebase; this mapping was written aspirationally and nothing currently reads/uses engine_bindings.php's return value (not yet confirmed with a full grep — flag as open).
Follow-ups resolved this session
Page/folder wiki paradigm IS live: ui/file_explorer.php calls folder_get_tree($pdo) from kernel/folder_engine.php — confirmed real caller, not orphaned. (graph_engine.php's graph_get_data() and model/page_model.php's page_find() weren't confirmed called from that same file — still worth a closer look at ui/file_explorer.php's full contents when the ui/ area comes up again.)
engine_bindings.php — confirmed fully orphaned: zero callers anywhere in the codebase. Dead/aspirational config, safe delete candidate.
guard.php / kernel_guard() — confirmed fully orphaned: zero callers anywhere. Dead code, safe delete candidate.
kernel/legaisee.db (0-byte SQLite file) is still referenced: root setup.php has $db_file = 'legaisee.db';. This looks like the SAME species of issue as the standing hazard note "setup.php stray SQLite DB — FIXED (deleted)" — but that fix may have been a different setup.php (there are multiple in this codebase, per the naming-collision pattern), because THIS root setup.php + kernel/legaisee.db pair still exists un-fixed. Needs a quick confirm-or-correct pass on the standing hazard note before triage — don't assume this one is already handled.




<a id="doc-23"></a>
## 23. 8-25-26_Legaisee Api Toplevel Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-25-26_Legaisee Api Toplevel Audit.md` · 4213 bytes · 19 lines · encoding normalized to UTF-8*

8-25-26_Legaisee Api Toplevel Audit
Summary
Micro-audit of the remaining api/ top-level files not already covered by legaisee-brain-micro-audit (tree.php, file.php, search.php, recommendations_generate.php, files_action.php, search_load.php) — completes api/ (api/v8/ + top-level brain cluster were already done in the brain audit)
Details
Read 2026-08-25, continuing the file-by-file examine phase after legaisee-pages-micro-audit. The ~30 brain/agency/case/network files in api/ top-level (agency_, agent_, brain_, case_, network_*, node_builder, graph_synthesizer, anomaly_detector, intel_cache, model_router, dossier, file_tree, excavate, excavation_run) were already fully micro-audited in legaisee-brain-micro-audit — not re-covered here. api/v8/ (30 files) was also already fully covered there.
STATUS: api/ FOLDER NOW FULLY COVERED (combining this file + legaisee-brain-micro-audit)
tree.php (8.9KB) — real, solid REST-style API for tree_nodes
Full CRUD (create/rename/move/delete/get_tree) against a tree_nodes table, uses a recursive CTE to prevent moving a node into its own descendant, proper validation throughout. This is the WO-I identity-layer API already referenced in legaisee-command-center — that file already notes tree_nodes' live schema didn't match what this code assumes (no column literally named 'id' on the pre-existing live table) — not re-verified here, just cross-referenced.
files_action.php (15KB) — real, sandboxed file manager backend for modules/files_module.php
list_dir/get_file/create_dir/create_file/delete/rename/move/upload/save_file — full real implementation, all operations path-guarded against escaping outside FM_ROOT. Worth flagging: FM_ROOT is set to the entire KERNEL_ROOT (the whole commandcenter/ application directory), not a dedicated data folder. So the live "Files" nav item, once reachable, gives read/write/delete/rename access to the entire application's own source code and any config/credential files sitting in that tree — not just user data. Not a bug in the sandboxing logic itself (it correctly prevents escaping FM_ROOT), but the scope of FM_ROOT is a design choice worth a second look at triage.
search_load.php (6.6KB) — real, safe JSON content-loader for modules/search_module.php's dual-compare panes
Handles two source types: json (reads from data/cases, data/clients, data/prospects, data/network — each path realpath()-checked against escaping its own root) and mysql (looks up by intval()'d id). Clean, no issues found.
NEW — a 5th distinct "network file" naming/location convention found
api/recommendations_generate.php builds its network file path as data/network/net_case_{$case_id}.json — yet another naming scheme, different from all of: the hardcoded test ID "net_69eee12e374d30_99173905" (api/v8 old paradigm + pages/network_view.php), data/network/{id}.json (create_network.php family per brain audit), and data/clients/{client}/cases/{case}/network.json (portfolio_engine.php per brain audit). At least 5 different, non-interoperable conventions exist across the codebase for "where is this case's network JSON file." Worth flagging as its own cross-cutting hazard theme for triage — any real fix to the network/graph system needs to pick ONE convention and migrate everything to it.
api/file.php and api/search.php — small real flat-file utilities
Both operate on normalized/ (file.php returns a single file's content/excerpt as JSON; search.php is the JSON-API sibling of pages/search.php's same keyword-search-over-normalized/ logic — a duplicate of that logic, not shared). file.php uses basename() on its input, safely preventing path traversal.
Bottom line
api/ as a whole (top-level + v8) is now fully read. Real, working pieces: tree.php, files_action.php, search_load.php, api/search.php/file.php, plus (from the brain audit) get_cases.php/get_clients.php/network_add_node.php/build_graph.php/graph_ranker.php. Everything else in api/ top-level and all of api/v8/ was already characterized in legaisee-brain-micro-audit (mix of fake-simulation and corrupted-output files). No fixes made — findings queued for the system-wide triage pass per legaisee-recovery-roadmap.




<a id="doc-24"></a>
## 24. 8-25-26_Legaisee Modules Micro Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-25-26_Legaisee Modules Micro Audit.md` · 11374 bytes · 43 lines · encoding normalized to UTF-8*

8-25-26_Legaisee Modules Micro Audit
Summary
COMPLETE function-level micro-audit of the modules/ folder (all 34 registered modules + extras) — real MySQL feature set is far larger than first thought, plus a live confirm→PDF→vault report pipeline, a new insight/ingest duplicate-schema hazard, and 3 more naming-collision families discovered
Details
Started after the original 6-family list (legaisee-brain-micro-audit, legaisee-ui-micro-audit, legaisee-recommendation-micro-audit, legaisee-excavation-semanticdiff-micro-audit, legaisee-search-micro-audit, legaisee-projectmanager-micro-audit) was completed — this is new unexamined surface found while checking what's left system-wide, per John's "continue/keep going down the list" instruction
Source: commandcenter.zip, read directly via bash/view tools in Claude's sandbox
STATUS: modules/ FOLDER FULLY READ (2026-08-25 session). All 34 registered kernel/module_registry.php entries + migration scripts + extras now examined.
Previously-read files (13, session 1) — see prior findings, unchanged:
clients_module.php, cluster_module.php, entity_resolution_module.php, graph_module.php, ingest_view_module.php, 001_create_tree_nodes.php, 002_migrate_clients_to_tree.php, intelligence_dashboard_module.php (MOCK), compare_module.php (stub), dashboard_module.php (thin), alert_module.php, cases_module.php, time_intelligence_module.php — flat-JSON data/cases/ paradigm.
Newly-read this session — REAL, MySQL-backed, substantial:
pm_module.php (922 lines, largest in modules/) — fully real, live Project/Task manager: projects table (9-stage lifecycle: intake→approved→planning→active→on_hold→at_risk→review→completed→archived) and pm_tasks table (6-stage: Backlog→Architecting→Building→Review→Blocked→Done), drag-drop kanban board for both projects and tasks, links tasks to memory_ingest AI sessions via task_sessions join table. This is the actual live "PM" nav item — a DIFFERENT, third implementation from the standalone ProjectManager/ app (its own Bible/governance system, already audited in legaisee-projectmanager-micro-audit) and from modules/project_manager/ (see below). pm_tasks IS the real, actively-used live table — relevant to the standing hazard that ProjectManager/'s TaskRepository.php queries a mismatched pm_tasks table; worth checking during triage whether TaskRepository is trying to reuse this same table or a different one entirely.
dig_review_module.php (558 lines) — real human-in-the-loop confirm/reject queue. Auto-creates review_flags table if missing (source_table/source_id/status/operator_note). Pulls candidates from both MySQL (entities, relationships) and flat-file case JSON (insights.json/clusters.json/network.json under data/clients//cases//). Confirmed findings are what feed report_module.php. Minor hazard: several queries interpolate {$flag['source_id']} directly into SQL instead of using bound params (values come from DB so lower risk, but not parameterized).
report_module.php — real PDF generation via dompdf, pulls ONLY review_flags rows with confirmed status, tied to case_id/client_id.
vault_module.php — real, stores/retrieves the PDFs report_module.php generates, has a path-traversal guard (realpath() containment check) on download. → dig_review → report → vault is a real, fully-wired end-to-end pipeline (human confirms finding → PDF generated → stored/downloadable) — one of the more complete feature chains found in the whole audit.
payment_module.php — real Stripe Checkout integration, payments table, EXHIBIT_PRICING tier constants ($500–$250,000) matching legaisee-services's Exhibit System tiers.
client_view_module.php (17.6KB) — real hub file, joins clients, cases, payments, entities, relationships, review_flags, processing_queue — one client's full picture in one place.
cockpit_module.php — real "needs your attention" dashboard, queries clients, cases, processing_queue, and a not-previously-seen prospect_ingests table.
files_module.php — real Windows-style file manager UI; all actual file operations delegate to api/files_action.php (not yet audited — new item for the api/ backlog).
governance_module.php — real, live: renders operational UI from _governance/, _operations/, and _generated/ text files, plus a hardcoded AI-platform quick-link panel (Claude/ChatGPT/Gemini/etc). _operations/ and _generated/ are two more untouched top-level directories not previously on the "still to do" list (previous list only had _governance/).
anomaly_engine_module.php — real, entities/relationships/entity_aliases tables, detectOrphans()/detectHubs() (degree>25) functions — genuine simple graph-anomaly logic, no toy JSON.
predictive_link_module_v1.php — real, MySQL-backed (entities, relationships) — a DIFFERENT data paradigm than predictive_module.php (flat-JSON data/cases/), same "predictive" name.
semantic_cluster_module.php — real, MySQL-backed (entities, relationships), but requires ../db.php and uses global $pdo instead of the standard kernel_db() pattern every other module uses — inconsistent DB-access style, worth flagging for triage even though functional.
Newly-read — flat-JSON data/cases/ paradigm (same ecosystem as session-1 files, via shared modules/utils/bootstrap.php helper load_json_dir()):
decision_module.php, executive_dashboard_module.php, predictive_module.php, relations_module.php, root_cause_graph_module.php, recommendation_module.php (patternMap: ops_delay/pricing_pressure/lead_friction/labor_issue — matches legaisee-recommendation-micro-audit vocabulary), excavation_module.php ("Executive Narrative Stitching Engine" — Artifacts→Signals→Clusters→Narratives, reads data/clients/ artifacts). cross_case_engine.php (modules/ version) — pure /data JSON reader, "V1 SCHEMA LOCKED", no DB, no UI — confirms this is genuinely a different implementation from engine/cross_case_engine.php, still unresolved which (if either) is the "real" one for triage.
NEW HAZARD — insight/ingest duplicate with mismatched schema, BOTH live-registered
insight_module.php and ingest_module.php are near-identical files (insight's own docblock even says "ingest_module.php" — copy-paste leftover). Both are separately registered and reachable ('insight' => insight_module.php, 'ingest' => ingest_module.php in kernel/module_registry.php). insight_module.php is an OLDER/DIVERGED version: inserts into memory_ingest using column names session_label/raw_text while ingest_module.php (and pm_module.php's reads) use session_title/raw_transcript/processed — if the schema only has the newer columns, submitting the form on the "Insight" nav page would likely throw a DB error or silently fail. insight_module.php also lacks ingest_module.php's case-linking/network.json ingestion-pipeline logic. Needs a live-DB schema check during triage to confirm severity.
NEW — modules/brain_module.php is the ACTUAL live 'brain' nav item, NOT covered by legaisee-brain-micro-audit
That earlier audit covered engine/, api/ top-level, and api/v8/ (a 4th, separate "brain" concept — a self-simulating fake-AI cluster). But kernel/module_registry.php's 'brain' => 'brain_module.php' actually points to a completely different file in modules/: a simple read-only system self-inspection panel (module count, data-dir file counts, engine file_exists() checks). This is the same file already flagged in the handoff doc's hazard list — its engine-health checks point at a /system/ folder that doesn't exist, so all 5 flags always read false. Confirmed here as the real live nav wiring; brain-micro-audit's Group A/B/C findings are a separate, deeper question about what the "brain" should become, not what's currently on screen.
NEW — 3 more files in modules/ share names with already-audited clusters (not yet cross-checked against those audits)
excavation_module.php, recommendation_module.php, search_module.php, view_module.php all exist in modules/ and are the ones actually registered/live per kernel/module_registry.php — search_module.php ("System Search + Dual Compare," delegates to api/search_load.php) and view_module.php (requires lib/semantic_diff_engine.php, ui_engine.php, nav_engine.php — a compare-two-records viewer) look like they may be the true live front-ends for legaisee-search-micro-audit and legaisee-excavation-semanticdiff-micro-audit's clusters respectively — worth a follow-up pass to confirm whether those two audits already accounted for these exact files or missed them the way brain-micro-audit missed modules/brain_module.php.
NEW — modules/project_manager/ subdirectory: a THIRD "project manager" implementation
Has its own api/, assets/, data/, views/, and project_manager.php — separate from pm_module.php (real, MySQL, audited above) and the standalone ProjectManager/ app (legaisee-projectmanager-micro-audit). Not registered anywhere in kernel/module_registry.php — appears orphaned/dead, but has real substance (multiple subfolders) so not yet confirmed harmless. Third instance of the project-manager naming-collision pattern.
NEW — modules/utils/ shared helper library
bootstrap.php (defines load_json_dir() — the function every flat-JSON module above depends on), json_helpers.php, file_helpers.php, debug_helpers.php, uic_v1.php, uic_v2.php. Common infrastructure, not itself a module.
NEW — dead/backup cruft found sitting in modules/
modules/archive/build_dossier.php — an archived copy alongside a live modules/build_dossier.php (real: compiles memory_ingest records into a dossier for report_module.php's downstream use, not yet deep-read).
modules/clients_module.phpbak — broken backup (literal duplicate <?php tag, would fail if ever executed), flat-JSON-based OLDER version of clients_module.php (the confirmed-real MySQL live one). Not .php, not registered — cosmetic cleanup candidate only.
Note for John
modules/ itself is now fully read (34 registered files + extras). The real, MySQL-backed feature surface is much bigger than the original "6 families" suggested — PM/kanban, dig-review→report→vault pipeline, Stripe payments, client hub view, and anomaly detection are all real and live. But this pass also surfaced 3 brand-new naming-collision families (brain, project-manager, and possibly search/view) plus one active-looking bug (insight vs ingest schema mismatch) that weren't visible from the original 6-cluster list. Still need: cross-check search_module.php/view_module.php against their sibling audits, read api/files_action.php and modules/build_dossier.php, and confirm the insight/ingest schema mismatch against the live DB.
STILL TO DO — beyond modules/ (updated)
kernel/ (only kernel_boot, db, module_registry, task_generator, engine_bindings, recommendation_engine touched), api/ (only a handful of endpoints across prior audits + now api/files_action.php, api/search_load.php newly flagged), engine/ (needs full checklist pass), pages/ (only shell_template.php + shell_module_test.php), and untouched top-level dirs: Logs/, _backup/, _governance/, _operations/ (NEW), _generated/ (NEW), archive/, cli/ (partial), clients/, database/, dossiers/, legaisee/, normalized/, sets/, tools/, views/, plus ~45 loose top-level PHP scripts (full list in prior version of this file / recovery roadmap).





<a id="doc-25"></a>
## 25. 8-25-26_Legaisee Pages Micro Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-25-26_Legaisee Pages Micro Audit.md` · 4075 bytes · 22 lines · encoding normalized to UTF-8*

8-25-26_Legaisee Pages Micro Audit
Summary
Micro-audit of pages/ (9 files) — an earlier, unwired prototype of the live shell.php "Grand Lobby," plus one real self-contained flat-file search/compare tool and one confirmed-broken scratch file
Details
Read 2026-08-25, continuing the file-by-file examine phase after kernel/ (legaisee-kernel-micro-audit)
STATUS: pages/ FOLDER FULLY READ (8 files + test/ subfolder)
Key finding: pages/ is NOT wired into the live system at all
Grepped the whole codebase for any reference to pages/*.php by filename or a $_GET['page']-style router — found none (the only hits were unrelated matches inside the dompdf vendor library). Nothing routes to any file in pages/. This whole folder is orphaned relative to the live shell.php/module_registry.php system.
pages/shell_template.php (10.8KB) — an earlier prototype of the live Grand Lobby shell
Its own renderModule() function is functionally identical in spirit to shell.php's module loader, but its "wings" nav list and labeling ("Executive Intelligence" / "Excavation Wing" / "Client Vault" etc.) is a different, earlier design pass than what's live now (already-known terminology per legaisee-command-center — "Grand Lobby"/"Wings" are established names, so this confirms which file that terminology originated from). Contains one bug of its own: its wings array points at a module key semantic_cluster_module_v1, which renderModule() would look for as modules/semantic_cluster_module_v1_module.php — that file doesn't exist (the real one is semantic_cluster_module.php, no _v1) — would always render "Module not built yet" if this template were ever live. Moot as long as the file stays unwired.
pages/network_view.php — real code, but hardcodes the same test network_id already flagged elsewhere
Uses vis-network.js to render an actual force-directed graph from a case's network.json — genuinely functional rendering code — but hardcodes network_id = "net_69eee12e374d30_99173905", the same test ID already flagged repeatedly in legaisee-brain-micro-audit (build_edges.php, dossier_v2, api/v8 old paradigm). Confirms that hardcoded test ID pattern reaches even into pages/.
pages/search.php — a real, self-contained, DB-free search+compare tool
Reads normalized/index_meta.json and files under normalized/ (one of the previously "entirely untouched" top-level directories — now confirmed to have real, if unwired, code depending on it), does keyword search plus a side-by-side dual-file compare view. This is a fourth distinct "search+compare" implementation in the codebase, alongside modules/search_module.php (DB-based), modules/view_module.php (semantic_diff_engine.php-based), and the api/v8 compare cluster from the brain audit — all doing conceptually the same job with completely different, non-overlapping code paths. No shared logic between any of them.
pages/goals.php, home.php, logs.php, networks.php, reasoning.php — placeholder stubs
Each is a single line of static HTML (<div class="card">Goals System</div> etc.) — no logic, clearly scaffolding never filled in.
pages/test/shell_module_test.php — confirmed broken scratch/debug file
A malformed hybrid: starts as a copy of shell_template.php's HTML shell, but mid-file has brain_module.php's entire raw source pasted in verbatim (not required/included — literally pasted as inline text) inside what should have been the wings-loop PHP block, and the file cuts off without closing its tags/structure. Would fatal-error if ever executed. Zero risk since nothing routes here, but confirms this was a throwaway debug artifact, not a working file.
Bottom line for triage
Nothing in pages/ is reachable from the live system. Recommend as a family: keep pages/search.php's logic in mind as a possible reference/backup implementation (it's the only one of the four search/compare paths that needs zero database), but the folder as a whole is dead weight — safe delete-as-a-family candidate, same as engine_bindings.php/guard.php in kernel/, pending John's triage call.





<a id="doc-26"></a>
## 26. 8-25-26_Legaisee Toplevel Dirs Micro Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-25-26_Legaisee Toplevel Dirs Micro Audit.md` · 11410 bytes · 42 lines · encoding normalized to UTF-8*

8-25-26_Legaisee Toplevel Dirs Micro Audit
Summary
Micro-audit of the ~10 previously-untouched top-level directories (Logs, _backup, _governance, archive, cli, clients, database, dossiers, legaisee, normalized, sets, tools, views) — finds cli/'s FIFTH orphaned autonomous subsystem, confirms the real cli/worker.php bug actually fired in production, a completely broken tools/ maintenance suite, and 2 more live-vs-orphaned naming collisions (graph_view.php, view_module.php)
Details
Pass 1 of 2 for this session's remaining-surface sweep (per John's request to split into 2 passes to avoid mid-response cutoffs): top-level directories first, then the ~45 loose top-level PHP scripts as pass 2. Source: commandcenter.zip, freshly unzipped this session.
Of the ~10 directories the handoff listed as untouched: _operations/ and _generated/ do NOT exist in this zip (may have existed in an earlier upload or were confused with something else — discrepancy noted, not investigated further). archive/, dossiers/, and sets/ exist but are genuinely EMPTY (0 files each) — nothing to audit, confirmed via direct listing.
cli/ (9 files) — a FIFTH orphaned autonomous subsystem, entirely separate from the other 4
Only cli/worker.php was previously covered (in legaisee-engine-micro-audit, where it was found to be the real, live, fatally-broken worker). The other 8 files — autonomous_run.php, chain_evolver.php, chain_generator.php, event_worker.php, goal_engine.php, graph_scheduler.php, meta_goal_engine.php, reasoning_engine.php — form a completely different, self-contained "event → goal-alignment → multi-chain reasoning → chain evolution → chain generation" pipeline, clearly meant to run via CLI/cron (#!/usr/local/bin/php.cli shebangs). Confirmed zero live callers anywhere (checked every file, plus searched for crontab/cron references — none found; the only cron-adjacent file, api/case_scheduler.php, is an unrelated random coin-flip stub that doesn't touch cli/ at all).
Reads/writes a SIXTH-plus distinct flat-file convention: data/events/, data/goals/, data/chains/, data/reasoning_log/, data/goal_log/, data/auto_log/, data/event_log/ — on top of data/network/, data/system/, data/agency/, data/clients/{id}/cases/{id}/network.json already known.
Internally it's a genuinely clever design on paper: events get scored against active goals (cli/goal_engine.php) → multiple reasoning "chains" compete to process each event (cli/reasoning_engine.php) → outcomes get scored (cli/chain_evolver.php) → new chains get bred from historically successful steps (cli/chain_generator.php) → meta-goals periodically adjust goal weights based on system-wide accuracy stats (cli/meta_goal_engine.php).
Real bug found even within this isolated cluster: cli/reasoning_engine.php's scoring line has a variable-variable typo — $$score = (...) instead of $score = (...). This means $score is never actually set to the computed value, so the "winning chain" competition logic silently never works as designed (the comparison if ($score > $bestScore) always compares against an unset/null value). Independent of the orphan status, this cluster's core competition mechanism doesn't function correctly even if run standalone.
cli/autonomous_run.php depends on the same hardcoded test network_id (net_69eee12e374d30_99173905) already flagged as fake/toy data in legaisee-brain-micro-audit.
cli/graph_scheduler.php (no shebang, different style — likely from a different build pass) uses raw mysqli with $case_id interpolated directly into SQL (hardcoded to 1, so not exploitable as written, but same risky pattern as other raw-mysqli files found elsewhere).
Confirmed live evidence that the cli/worker.php bug (found last session) actually fired
Logs/debug_trace.log and Logs/debug_write.log contain real production entries for client_1777858282 / case_1777858282 writing real content ("social engagement falling even tho posting increased in jan 2026") to data/clients/client_1777858282/cases/case_1777858282/tasks/queue.json in May 2026 — exactly the path/pattern cli/worker.php processes. This is corroborating evidence (not proof) that the worker's undefined-function crash documented in legaisee-engine-micro-audit has likely been hit in real operation, not just a theoretical code-path.
tools/ (7 files) — a real, coherent clustering-maintenance suite, but currently 100% broken for a dumb reason
build_clusters.php → name_clusters.php → build_cluster_summaries.php (or build_cluster_summaries_ai.php, a genuinely REAL working OpenAI API integration via curl, unlike the fake model_router.php stubs found in the brain audit) → extract_cluster_insights.php → detect_cluster_opportunities.php. All real PDO code against the real page/clusters/page_relations MySQL tables (the same ones the live graph/cluster system already confirmed in legaisee-brain-micro-audit uses) — clearly meant as manual/cron maintenance scripts for the real clustering pipeline, not toy code.
All 7 files are currently guaranteed-broken, for the same root cause: every one does require_once __DIR__ . "/../bootstrap.php", which resolves to the ROOT-level bootstrap.php — and that file is just a two-line deprecation comment (// This file is deprecated. Use modules/utils/bootstrap.php instead.) with no actual code. It never defines $pdo, so every one of these scripts would fatal immediately on its first $pdo->query() call. None of them require the correct modules/utils/bootstrap.php path.
build_cluster_summaries_ai.php also references an OPENAI_API_KEY constant that is not defined anywhere in this repo's config.php (config.php only conditionally loads a config.local.php that isn't part of the zip — may be defined there on the real server, so this specific dependency is unverifiable from the zip alone, unlike the bootstrap.php issue which is a confirmed bug regardless).
Zero live callers found for any of the 7 files — orphaned in addition to broken.
Cross-reference: embed_generate.php (already flagged as a standing hazard in legaisee-recovery-roadmap for its plaintext $OPENAI_API_KEY = "YOUR_API_KEY_HERE" placeholder) is a different file with a different, definitely-fake key — not the same issue as tools/'s missing-constant dependency.
views/ (4 files) — 2 more live-vs-orphaned naming collisions confirmed
views/compare_view.php — well-built, uses the real kernel_boot.php/lib/legaisee_model.php/kernel/nav_engine.php paradigm (same as confirmed-live files elsewhere). Zero callers anywhere. Orphaned but solid.
views/ingest_view.php — a bare 11-line raw HTML <form> fragment, no kernel boot, no PHP logic. Zero callers. A registered module already exists for this concept (ingest_view => modules/ingest_view_module.php per kernel/module_registry.php) — this file is an orphaned, unrelated duplicate-by-concept, not the live one.
views/graph_view.php (312 lines) vs. root-level graph_view.php (115 lines) — CONFIRMED naming collision, genuinely different files (418-line diff, not a copy). The ROOT one is the live file — required directly by modules/client_view_module.php (require __DIR__ . '/../graph_view.php'). views/graph_view.php is a separate, more built-out, unwired version using the proper kernel_boot.php pattern — never referenced anywhere.
views/view_module.php (122 lines) vs. modules/view_module.php (263 lines) — CONFIRMED naming collision, genuinely different files (365-line diff). modules/view_module.php is the live one, registered in kernel/module_registry.php as 'view' => 'view_module.php' and reachable through the real module system. views/view_module.php is a separate, smaller, kernel_boot-based version, zero callers anywhere.
These 2 collisions extend the already-long naming-collision pattern log in legaisee-recovery-roadmap (now: brain, project-manager 3x, search/view/compare 4x, cross_case_engine, predictive, clients_module, network-JSON-location 5x, and now graph_view + view_module).
database/migrations/ (2 files) — possible missing link for the "stray SQLite DB" open thread
010_create_tree_nodes_table.php and 010_create_tree_nodes_tablebk.php are byte-for-byte identical (the second is literally a backup copy, same content). Both define the tree_nodes table using SQLite syntax (INTEGER PRIMARY KEY AUTOINCREMENT) even though config.php's docblock states "MySQL only." Zero callers/migration-runner found anywhere in the codebase — nothing ever executes these. Yet tree_nodes IS confirmed real and live-populated via api/v8/network_add_node.php per legaisee-brain-micro-audit. This is worth cross-referencing at triage against the still-open "stray SQLite DB" thread (legaisee-kernel-micro-audit: root setup.php + kernel/legaisee.db may be a second, not-yet-fixed instance) — it's plausible tree_nodes actually lives in a SQLite file somewhere rather than the main MySQL DB, which would explain the syntax mismatch. Not confirmed, just flagged as the most promising lead found yet on that open question.
_backup/ (2 files) — as advertised, not live
index_5-17-26-0804pm.php is a dated (May 17, 2026) historical snapshot of an old root index.php, sitting in a folder with its own .gitignore. No further audit needed — self-evidently a manual backup, not part of the live app.
Data-only directories (briefly characterized, not code-audited)
Logs/ — 3 real debug log files with genuine production timestamps (see worker.php cross-reference above).
clients/ (top-level, distinct from data/clients/) — small set of flat JSON client records (some clearly seed/test data like "Acme Manufacturing," one real-looking folder matching a Logs-referenced client ID) plus 2 markdown docs describing an intended client directory structure/JSON schema — documentation-only, not enforced anywhere in code as far as this pass checked.
normalized/ (36 files) — confirmed to be the real backing store for the search-indexing feature already partially identified in legaisee-api-toplevel-audit; index_meta.json contains real file-path/score/length metadata pointing at real excavation session files under clients/.../file_intelligence/excavations/.
legaisee/ (2 files) — raw ingested artifact text (title/client/system/platform/timestamp header format), i.e. input data, not code.
_governance/ (30 files) — a large trove of process/methodology text and markdown documents (numbered 00–23: execution checklists, session logs, "Windsurf Execution Bible," "Master System Bible," agent roles, error escalation, validation/deployment checklists, architecture lock, drift patterns, decision log, etc.) — this is John's own project-management/AI-collaboration documentation, not application code. Noted for completeness but not deep-read line by line (out of scope for a code audit); worth a skim later if the Phase 3+ documentation effort wants to reuse any of this scaffolding.
STILL TO DO
Pass 2 of this session: the ~45 loose top-level PHP scripts never opened at all — separate report to follow.
No fixing/repair/deletion yet — all findings here wait for the single system-wide triage-then-execute pass per legaisee-recovery-roadmap.
Worth a quick follow-up check at triage time: does config.local.php (not in this zip) actually define OPENAI_API_KEY, which would make tools/build_cluster_summaries_ai.php's only remaining blocker just the bootstrap.php path fix.




<a id="doc-27"></a>
## 27. 8-25-26_Legaisee Engine Micro Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-25-26_Legaisee Engine Micro Audit.md` · 12517 bytes · 45 lines · encoding normalized to UTF-8*

8-25-26_Legaisee Engine Micro Audit
Summary
Function-level micro-audit of engine/ (38 files) — finds the LIVE background worker (cli/worker.php) is fatally broken via 3 undefined-function calls, plus a whole second orphaned "autonomous governance" pipeline (goal→decision→execution→feedback) beyond the already-known brain rebuilds, plus one strong restore candidate (plain_english_helper.php)
Details
Fourth in the post-api/ sequence per session handoff (2026-08-25) — engine/ is the next full-folder target after modules/, kernel/, pages/, api/. Source: commandcenter.zip re-uploaded and unzipped fresh this session.
Scope note: 10 of engine/'s 38 files were already fully function-audited in legaisee-brain-micro-audit and are NOT re-audited here — case_manager.php, cluster_engine.php (confirmed 0 bytes), cross_case_engine.php, graph_data.php, graph_engine.php, graph_mutation_engine.php, predictive_intelligence_engine.php, semantic_cluster_engine.php, portfolio_engine.php, dashboard_engine.php. recommendation_engine.php and system_recommendation_engine.php were already function-audited in legaisee-recommendation-micro-audit and also skipped here. Remaining 26 files are newly read/audited this session — full inventory of all 38 confirmed against the actual zip (matches handoff's "38 files" count exactly).
STATUS: FULL INVENTORY COMPLETE for engine/
BIGGEST FINDING: the real, live background worker (cli/worker.php) is fatally broken
cli/worker.php is the actual production worker invoked via shell_exec by api/v8/run_worker.php (per legaisee-brain-micro-audit) — not a toy or test file. Inside its main per-case loop, for ANY case that simply has a tasks/queue.json file present (regardless of contents — the only gate is file_exists), it unconditionally calls three pipeline-adapter functions from engine/pipeline_adapters.php:
clusterNodesPath($path) → calls clusterNodes($case_id) — undefined anywhere in the codebase (pipeline_adapters.php requires engine/cluster_engine.php for this, but that file is confirmed 0 bytes/empty). Fatal error.
generateInsightsPath($path) → calls generateInsights($case_id) from reasoning_engine.php — this one is real and correctly wired, would work.
generateRecommendationsPath($path) → calls generateRecommendationsFromPath($caseDir) — undefined anywhere; recommendation_engine.php only defines a differently-named function (generate_recommendations_for_case). Fatal error.
At the very end of the file (outside the loop), worker.php also directly calls generateSystemInsights() — undefined anywhere (system_insight_engine.php only defines system_insight_engine()) — and generateRecommendationsFromPath($path) again, reusing $path from whatever the last loop iteration happened to leave it as (scope-leak bug, separate from the undefined-function issue).
Net effect: the worker almost certainly fatal-errors on its very first real case with any queue file, before ever reaching the bottom of the script. This is a previously undocumented, high-severity live bug — worth flagging to John as urgent regardless of triage sequencing, since it likely means the autonomous task-processing pipeline has never successfully completed a real run.
Already-known bugs in this same file reconfirmed: duplicate buildPredictiveInsights() call + redundant require (from legaisee-recommendation-micro-audit).
SECOND MAJOR FINDING: a whole second orphaned "autonomous governance" pipeline, distinct from the 3 brain rebuilds
Beyond the 3 brain-system rebuilds already documented in legaisee-brain-micro-audit (engine/, api/ top-level, api/v8/), engine/ also contains a fourth, previously-undiscovered attempt at autonomy — a full Goal → Decision → Execution → Feedback → Learning governance architecture, ~17 files: goal_engine.php, goal_generator.php, goal_arbitration_engine.php, goal_conflict_resolver.php, goal_alignment.php, governance_policy_engine.php, decision_engine_v2.php, decision_governor.php, execution_router.php, execution_feedback_engine.php, cross_case_learning_compiler.php, policy_enforcement_engine.php, long_horizon_planner.php, pattern_stability.php, insight_mutator.php, temporal_memory_engine.php, system_behavior_spec.php.
Zero live callers for the whole cluster. Confirmed via codebase-wide grep for every filename: nothing in modules/, api/, kernel/, ui/, pages/, cli/, or ExcavationCommand/ ever requires or calls any of these except (a) each other's internal requires, (b) brain_module.php's/shell_module_test.php's engine-health-check file_exists() stubs — which already point at the wrong /system/ path per legaisee-recommendation-micro-audit's systemic-bug finding, so even those checks are non-functional — and (c) one purely cosmetic placeholder string (placeholder="run engine goal_engine" in an unwired textarea on ExcavationCommand/dashboard.php's "God Mode Navigation" mockup — not a real call).
Reads/writes a FOURTH distinct flat-file data convention: data/system/*.json (feedback_events.json, learning_adjustments.json, cross_case_weights.json, global_intelligence_map.json, execution_log.json, active_actions.json, execution_results.json, decisions.json, system_recommendations.json, policy_enforced_context.json) — separate from the data/network/ universe, the data/clients/{client}/cases/{case}/network.json path, and the data/agency//data/brains//data/cases/ universe already documented in the brain audit.
Architecturally, this is the most complete design found anywhere in LEGAiSEE — genuinely more end-to-end than the brain_orchestrator/brain_synthesis skeleton the brain audit flagged as "architecturally coherent but empty": goal candidates are generated from graph clusters → arbitrated/deduplicated/scored → conflict-resolved → converted to decisions by risk/opportunity/recommendation type → routed to execution → logged → fed back as learning-weight adjustments → compiled into cross-case module/action/risk weights → enforced as policy constraints on future decisions. A genuine closed loop, on paper.
But it's also broken even on its own terms, independent of being disconnected:
goal_engine.php has top-level code (executes immediately on include, not inside a function) calling loadGoalProposals($conn, $case_id) and saveActiveGoals($conn, $final_goals, $case_id) — neither function is defined anywhere in the codebase. Guaranteed fatal if this file is ever included. Its one real function, loadGoals(), also uses raw mysqli with $case_id string-interpolated directly into the SQL query (no escaping/parameterization) — a live SQL-injection shape if ever wired to user input.
decision_governor.php's evaluateExecution() calls isGoalAligned() and isPlanConsistent() — neither defined anywhere. Would fatal if called.
executive_dashboard_engine.php's buildExecutiveDashboard() calls generateSystemInsights() and buildCrossCaseClusters() — neither defined anywhere (the real function names in its own required files are system_insight_engine() and cross_case_engine()). Would fatal if called. (Also zero callers of executive_dashboard_engine.php itself.)
temporal_memory_engine.php: same raw-mysqli pattern as goal_engine.php — $case_id interpolated unescaped/unquoted directly into an INSERT statement (only the JSON payload is escaped). Zero callers, but broken/risky if ever wired up.
decision_engine_v2.php → system_insight_engine.php → cross_case_engine.php is the one sub-chain in this cluster that IS internally functional (real logic, no undefined-function calls) — it's just never invoked by anything live. Genuinely reusable if this cluster is ever restored.
Other findings
entity_extraction_engine.php — REAL, LIVE, solid. PDO prepared statements throughout, writes to real entities/entity_aliases/relationships MySQL tables, sentence-level co-occurrence relationship detection with a real keyword-based relation-type classifier (competes_with, client_of, built, located_in, founded_by, employs, partners_with, reviewed_by, has_issue_with, regulated_by). Required by modules/excavation_module.php AND prospect.php — both real, reachable call sites. One of the most solid non-toy pieces found anywhere in engine/.
plain_english_helper.php — strong restore candidate, currently fully orphaned. A substantial (293-line) library that converts raw module output into plain-language explanations across 11 module types (relations, graph, anomaly, insight, recommendation, cluster, cross-case, time-intelligence, generic fallback). Zero callers anywhere in the codebase. Worth flagging specifically at triage as a KEEP/WIRE-UP candidate rather than delete — it's exactly the kind of non-technical-friendly explanation layer John has said he wants, already built and just never connected.
client_manager.php — a third parallel client/case data paradigm. Flat-file JSON (data/clients/{id}/profile.json, createClient()/getClients()), completely separate from the real MySQL clients/cases tables already confirmed live via get_clients.php/get_cases.php in legaisee-brain-micro-audit. Only ever invoked (together with case_manager.php) by create_test_data.php, a standalone top-level test/seed script — not part of any live user-facing flow. (case_manager.php itself already covered in the brain audit; flagging here only because client_manager.php completes the picture of what create_test_data.php actually does.)
system_behavior_spec.php — a declarative "system constitution" (loadSystemBehaviorSpec(): optimization priorities, prohibited behaviors, portability_mode, storage_model => graph_first). Zero callers anywhere — reads like aspirational meta-documentation that was never wired to actually constrain anything.
governance_policy_engine.php — separate from policy_enforcement_engine.php (another naming-collision-adjacent pair, joining the recurring pattern log). loadGovernancePolicy() returns hardcoded constants (max_active_goals, blocked_task_types, bias_weights). Zero callers anywhere.
pipeline_adapters.php is itself live-required (by cli/worker.php, confirmed above) even though 2 of its 3 adapter functions are broken (see worker.php finding). Its own require of cluster_engine.php (0 bytes) is a dead require independent of the undefined-function issue.
File-by-file status summary (26 newly-audited files)
Live & working: entity_extraction_engine.php, reasoning_engine.php (via generateInsights(), correctly called from pipeline_adapters.php/worker.php)
Live but broken (called by the real worker, would fatal): pipeline_adapters.php (2 of 3 adapter functions call undefined targets)
Wired only to a test/seed script, not the live app: client_manager.php
Orphaned, internally coherent (would work if wired up): decision_engine_v2.php → system_insight_engine.php chain, policy_enforcement_engine.php, execution_feedback_engine.php, execution_router.php, cross_case_learning_compiler.php, goal_arbitration_engine.php, goal_conflict_resolver.php, goal_generator.php, goal_alignment.php, governance_policy_engine.php, long_horizon_planner.php, pattern_stability.php, insight_mutator.php, system_behavior_spec.php, plain_english_helper.php (this one specifically flagged as worth restoring)
Orphaned AND internally broken (undefined-function calls even if wired up): goal_engine.php, decision_governor.php, executive_dashboard_engine.php, temporal_memory_engine.php (also SQL-injection-shaped)
STILL TO DO
No fixing/repair/deletion happens yet — findings here are documented and complete, but wait for the single system-wide triage-then-execute pass per legaisee-recovery-roadmap's locked sequencing, same as every other completed cluster.
Flag the cli/worker.php fatal-crash bug to John as worth knowing about sooner rather than later — it's a live-breaking bug in the actual production task-processing pipeline, not just a documentation finding like most of the rest of this file.
Per the session handoff: after engine/, move to the ~10 entirely untouched top-level directories (Logs/, _backup/, _governance/, _operations/, _generated/, archive/, cli/ [partial — cli/worker.php now read in full here], clients/, database/, dossiers/, legaisee/, normalized/, sets/, tools/, views/) and ~45 loose top-level PHP scripts never opened at all.
Not yet cross-checked: whether modules/search_module.php or modules/view_module.php (flagged in the api/ audit as possibly being true live front-ends for the search/excavation clusters) touch anything in engine/.




<a id="doc-28"></a>
## 28. 8-26-26_Legaisee Audit Checklist.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-26-26_Legaisee Audit Checklist.md` · 18034 bytes · 52 lines · encoding normalized to UTF-8*

8-26-26_Legaisee Audit Checklist
Summary
Master checklist tracking full-system macro-audit coverage of the ~1,243-file LEGAiSEE codebase across sessions — read this FIRST at the start of any audit session to see exactly where to resume
Details
SUPERSEDED AS ENTRY POINT (2026-08-26): read legaisee-preface then legaisee-current-state first, always. This file documents the original 8-24 folder-level macro-audit in detail (kept for history/reference) — the deeper 8-25/8-26 function-level micro-audits extended coverage to genuinely 100% of the codebase; see Current State for the up-to-date picture, including a real discrepancy this file's "RESOLVED hazards" section has with the newer audit (setup.php).
John wants an entire-system macro audit (not "does the PHP execute" — does it connect to real data/other modules, and can John read the result in plain language) of the full codebase, tracked via this checklist since sessions have hit chat limits mid-audit before
Full codebase unzipped from a server export John uploaded (commandcenter.zip), read directly in Claude's own sandboxed workspace via bash/view tools — this is the standing method, not pasting individual files into chat
Output format: each completed section becomes its own file named LEGAiSEE_System_Audit_<Section>.md, presented to John, who copies/logs them to Google Docs himself
John's read on WHY the codebase has so many dead/orphaned clusters: LEGAiSEE has been started over and/or revised several times over its history, and specific functions he remembers building have disappeared over time — this audit exists partly to find them again. Plan: once the full macro-audit is complete, go back through the orphaned clusters looking for which ones represent the SAME feature rebuilt at different points in time (not unrelated dead code) — likely to reconstruct a real timeline of what LEGAiSEE used to do and explain specific vanished functions. Audit evidence so far supports this: the "autonomous agent/brain" concept alone has been rebuilt from scratch in three separate locations (engine/, api/v8/, api/ top-level); two competing UI component systems exist; four different bootstrap.php files exist; the semantic-diff/excavation-session cluster is a fourth separate rebuild pattern.
DONE — fully audited (contents read, findings documented)
Sidebar: Graph & Entities (7 files) → LEGAiSEE_System_Audit_Graph_Entities.md
Sidebar: Excavation (6 files) → LEGAiSEE_System_Audit_Excavation.md
Sidebar: Intelligence Engines (7 files) → LEGAiSEE_System_Audit_Intelligence_Engines.md
Sidebar: Command (5 files) → LEGAiSEE_System_Audit_Command.md
Sidebar: Planning, Clients & Cases, Tools + whole-sidebar summary (~12 files) → LEGAiSEE_System_Audit_Planning_Clients_Tools_and_Summary.md
engine/ — all 36-37 files, connectivity-checked; 15 orphaned ones deep-read → LEGAiSEE_System_Audit_Backend_and_Orphaned_Systems.md + LEGAiSEE_Orphaned_Engine_Files_Explained.md
api.php + api/v8/ (30 files, connectivity only) → same backend file
cli/ (9 files, connectivity only) → same
index.php (read + live-tested by John) → same
ExcavationCommand/ (3 files, connectivity only) → same
ProjectManager/ (88 files — connectivity/disconnection confirmed only, internal contents NOT read) → same
kernel/ — all 21 files, fully read and connectivity-traced → LEGAiSEE_System_Audit_Kernel.md
51 top-level standalone PHP files → LEGAiSEE_System_Audit_Top_Level_Files.md — ~4 genuinely load-bearing (already covered elsewhere: bootstrap.php, config.php, db.php, shell.php, graph_view.php, prospect.php, index.php, api.php), ~10 self-evident test/debug scaffolding (test_*.php etc, not individually opened), 1 real reused utility (response.php, 7 references — API Response Contract Guard), and ~36 form a third disconnected experimental cluster (a "semantic-diff/excavation-session" system built around lib/semantic_diff_engine.php, itself unreferenced) — roughly 21 files with zero references anywhere, 6 more with only 1-2 references within the same dead cluster. Two hygiene flags: setup.php creates a stray SQLite DB unrelated to the live MySQL system if ever hit directly (recommend deleting outright); embed_generate.php has a plaintext OpenAI API key placeholder in a web-accessible file (unconfigured/not currently leaking, but a risk if ever filled in without relocating). legaisee_prospects.php (676 lines) turned out to be an unrelated marketing/lead-gen HTML page, not a system tool. dossier_v2.php and excavation_engine.php share a hardcoded test network ID; session.php/create_session.php reference a fourth, unused data-folder layout — this cluster reads as an earlier/parallel experiment abandoned when the current modules/+MySQL+data/cases/ approach became the real system.
modules/utils/bootstrap.php + Recommendation-module question → LEGAiSEE_System_Audit_Bootstrap_Recommendations.md — bootstrap.php is NOT recommendation logic; it's a generic 33-line JSON-directory loader (load_json_dir()) shared by 9 modules. The REAL live Recommendation source is modules/recommendation_module.php (48 lines) — a simple hardcoded pattern-to-action lookup table run against already-detected case patterns, no engine/AI involved. Confirmed api/recommendations_generate.php + kernel/recommendation_engine.php ARE wired into api.php's router (case "recommendations") but have zero live callers anywhere in the UI — same dead-but-reachable pattern as the api/v8 cluster. New finding: FIVE files are named bootstrap.php (root, kernel/, modules/utils/, ProjectManager/, plus an unrelated Stripe vendor test file) — all four non-vendor ones are genuinely different code, adding to the naming-collision risk list.
ui/ (16 top-level PHP files + ui/components/ subfolder + global.css) → LEGAiSEE_System_Audit_UI.md — only ONE real live feature: ui_engine.php + layout.php, reached via the registered 'view' module (?module=view), a page-compare/executive-diff tool. CORRECTION to the top-level-files report: this view module requires lib/semantic_diff_engine.php, so that "dead" semantic-diff cluster actually has one live doorway into it, not zero. global.css (1,924 lines, documented as "the one global stylesheet, no embedded CSS elsewhere") is functionally DEAD — the function that would link it (kernel_assets()) is defined but never called anywhere — while shell.php, layout.php, and view_module.php each carry their own separate inline <style> blocks instead, plus a 4th orphaned CSS file (ui/theme.php). Also found: an entire second, more architecturally disciplined component/layout rendering system (11 files: component.php, component_boot.php, component_contract.php, component_registry.php, components.php, layout_contract.php, layout_engine.php, registry.php, theme.php, ui.php, ui_boot.php) — fully unreferenced anywhere, and even internally incomplete (component_registry.php points to 4 files that don't exist). This system's real component library turned out to be the ROOT-level /components/ folder (10 files, not the 6 the checklist guessed) — resolves the "unknown purpose" flag on that folder. ui/compare_engine.php + ui/file_explorer.php reconfirmed orphaned (already known from kernel/ audit). ui/components/ subfolder also has 2 more zero-reference files (ingestforshell.php, "ingest_exec snap.php").
api/ top-level, non-v8 (37 files) → LEGAiSEE_System_Audit_API_TopLevel.md — only 2 genuinely live: files_action.php (Files module) and search_load.php (Search module), both fetched directly by JS bypassing api.php's router. recommendations_generate.php reconfirmed dead-but-reachable (already documented). Remaining 34 files dead: 30 of them (agency_, agent_, brain_, case_, network_*, node_builder.php, graph_synthesizer.php, anomaly_detector.php, intel_cache.php, model_router.php, dossier.php, file_tree.php, excavate.php, excavation_run.php) form a clear "autonomous agent/brain" cluster — self-contained JSON REST endpoints simulating agency dispatch, agent spawning/ticking, and brain orchestration/memory — architecturally the SAME abandoned concept already found in engine/ and api/v8/, now confirmed as a third separate location for it, still never wired into the live UI. The other 3 (file.php, search.php, tree.php) are NOT random stragglers — John confirmed and the code verifies this was his attempt at a Windows/Mac-style file browser to search+explore what's actually in the system's ingested content: search.php keyword-searches the normalized/ ingest folder with scoring, tree.php is a full folder/node CRUD system backed by a real tree_nodes DB table (254 lines, more built-out than most dead code found so far), file.php fetches a single normalized/ file's content for viewing. A real, coherent search→browse→view pipeline that never got wired into any live page or menu.
Brain Dashboard feature-history investigation (open thread, not a folder-completion item) → LEGAiSEE_Brain_Dashboard_Recovered_Fragments.md — John recalled the Brain module used to have its own dashboard showing all system intel at once plus a drawn node/connection graph. Live modules/brain_module.php today is just a stripped-down read-only health-check (module/data counts, engine-file existence checks) — no intel display, no graph. Found two real disconnected fragments matching the memory: pages/network_view.php (genuine working vis-network.js force-directed graph, colored nodes/edges, currently hardcoded to one network ID) and pages/shell_template.php ("The Grand Lobby" — an earlier all-modules-at-once single-page dashboard layout, every module as a "wing" rendered simultaneously instead of the current one-module-at-a-time shell). Gap: these two don't appear to have been the same page — Grand Lobby's Brain wing would only show the same plain JSON stats live today, and the graph reads from a different data source than Brain's own memory files. Either an even earlier combined version isn't in this codebase snapshot, or the pieces were always separate. STATUS: open — if ProjectManager/ or anything else turns up more graph/brain/dashboard fragments, add to this file rather than starting a new one.
ProjectManager/ (88 PHP files + 60-page governance/PROJECT_MANAGER_BIBLE doc set) → LEGAiSEE_System_Audit_ProjectManager.md — this is NOT ad-hoc/experimental like every other dead cluster: a deliberate, disciplined attempt at a full standalone PM app (Notion/Asana/Jira-style) for LEGAiSEE, fully isolated (zero references in/out of the rest of the codebase), proper MVC architecture, real 9-table migrations, its own test suite. SECURITY FLAG: config.php has a live plaintext production DB password (same DB as the rest of LEGAiSEE) — not reproduced in the report, needs a deliberate decision (rotate/restrict/remove), independent of this project's fate. Backend genuinely finished: full Model+Repository+Controller+API for Project/Task/Comment/Client/Milestone/Label/ProjectMember, plus a complete permission/role system (Permission, Role, AuthorizationService, per-entity Policy classes). Every UI-facing Bible chapter (0400+: design language, layout, kanban, calendar, tasks page, client portal, etc.) is a literal 0-byte empty placeholder — never started. assets/, storage/, vendor/ folders exist but are empty. The project's own session-handoff doc (0999_SESSION_HANDOFF.md) documents the exact stopping point: user authentication wiring was never finished, and NO front-end views/UI were ever built — explicitly the next action listed was "front-end views, JS API client, Kanban/List UI." Handoff doc also records a real design constraint: "V1 Wrike/Asana style PM only — do not add LEGAiSEE AI OS features, do not redesign architecture." Code quality spot-checked and confirmed genuinely clean/complete (typed, strict_types, proper OOP), not stubs. Most recoverable dead cluster found in the whole audit if John ever wants to finish it — hard architecture decisions already made and locked.
root-level /components/ (10 files), database/ (2 files), _backup/ (2 files) → LEGAiSEE_System_Audit_Final_Small_Folders.md — components/ confirmed dead, sole purpose is component library for the already-documented dead second UI system; also holds nav.php, a flat-link nav bar (index/search/ingest/files) from an earlier pre-module-shell site structure, and compare.php, an unused alternate implementation of the Compare feature. database/ holds 2 identical copies (one a manual "bk" backup) of a SQLite migration creating the real tree_nodes table behind the dead file-browser feature (api/tree.php, documented in the api/ audit) — no migration runner exists anywhere to actually execute it; same SQLite-era origin as the standalone setup.php flagged in the top-level-files audit, before the project settled on MySQL. _backup/ is exactly what it says: one manually dated index.php snapshot (5-17-26) plus a .gitignore.
Running total: ~404 of 1,243 files fully or partially covered (~33%) — this figure only counts files with individually-read contents; large swaths of the ~1,243 total are template/library/vendor files (e.g. ProjectManager's own vendor/ dependencies) not meaningfully auditable file-by-file. See "Audit closure note" below.
MACRO-AUDIT COMPLETE
Every folder and top-level file group on the original checklist has been opened and connectivity-traced. Nothing remains in a "not yet started" state. See "Audit closure note" below for what this does and doesn't mean.
Audit closure note
This audit answered its founding question — for every part of the codebase, does it connect to real data/other modules, and can John read the result in plain language — across all named folders and file groups. It is NOT a claim that all ~1,243 files were individually opened; many were characterized as a group (e.g. test_*.php scaffolding, vendor libraries) once their pattern was established, per the audit's own stated method.
Phase 2: Reconstruction — grouping dead clusters by feature, not location
→ LEGAiSEE_Feature_Reconstruction_Rebuild_Families.md — first pass, six rebuild families identified:
"Windows/Mac file browser" — MAJOR CORRECTION: the dead search.php+tree.php+file.php cluster's general concept actually DID get rebuilt and IS live today as modules/files_module.php + api/files_action.php (own code comment: "Windows/macOS style file navigator"). But it browses the whole app's own file system (FM_ROOT=commandcenter/, for operators), not the normalized/ ingested case content, and has no keyword search — so if John's goal is specifically "search what the system has ingested," that's still not live anywhere, even though a file browser is.
Autonomous agent/brain system — rebuilt from scratch 3x (engine/, api/v8/, api/ top-level), never shipped in any form — repeated-attempt pattern, not simplification.
Brain Dashboard — cross-ref to the open thread file.
UI rendering — two full systems built (live: inline HTML/CSS everywhere; abandoned: registry-based component system + global.css), simpler one won even though the more disciplined one was fully designed and partly built.
Recommendation engine — 2 dead versions (kernel/, engine/) vs 1 live simplified version (modules/recommendation_module.php, hardcoded lookup table) — this family is simplification-over-time, not abandonment.
Semantic-diff/excavation-session cluster — represents a whole earlier data-organization model (legaisee/clients/{client}/excavations/{session}/), not just one feature; one live doorway remains via the Compare tool. Overall pattern identified: two types of history visible — "successful simplification" (families 1's shape, 5) vs "repeated attempts never shipped" (family 2, abandoned halves of 4 and 6). Suggested next step if John has a specific vanished function in mind: match it to one of these 6 families first, rather than searching file-by-file. STATUS: open, first pass — more rebuild families may surface as reconstruction work continues.
Confirmed naming-collision hazard (kernel/ audit + top-level audit)
graph_engine.php and recommendation_engine.php each exist as TWO separate, different files — one in kernel/, one in engine/ — both pairs turned out to be dead code, but this is a real risk that a future edit (by John, Windsurf, or any AI) could target the wrong file without realizing a duplicate exists.
Resolved by the top-level audit: cluster_engine.php, excavation_engine.php, and semantic_engine.php DO also exist at top-level, as part of the dead semantic-diff cluster — confirming these are further name collisions with their engine/ counterparts, not the same file. Not yet confirmed whether the top-level and engine/ versions are identical code or diverged.
RESOLVED hazards
ProjectManager/config.php plaintext production DB password — FIXED: credential moved to /home/carrmulti/private/pm_db_credentials.php (outside web root, confirmed 404 when requested directly via browser), config.php now requires it from there. Confirmed working via live dbcheck.php test (https://www.legaisee.com/commandcenter/ProjectManager/dbcheck.php). Note: the password value itself was NOT rotated (a typo during the file move was corrected back to the original value) — actual DB password rotation is still an open follow-up, not urgent now that the file is structurally protected.
setup.php stray-SQLite-DB hazard — FIXED: file deleted from www/commandcenter/. John liked its HTML/CSS visual styling better than the current live LEGAiSEE UI and saved the page source as a static (non-executable) reference for the future final UI build before deleting the live script — not a copy-exactly template, just a color/direction reference.
Standing update rule
Update this checklist AND the narrative log in legaisee-command-center at the end of every audit session — move completed rows from "not started" to "done," update running totals — so resuming after a chat-limit cutoff starts here, not from scratch





<a id="doc-29"></a>
## 29. 8-26-262_Legaisee Audit Checklist.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-26-262_Legaisee Audit Checklist.md` · 18036 bytes · 53 lines · encoding normalized to UTF-8*

8-26-26_Legaisee Audit Checklist
Summary
Master checklist tracking full-system macro-audit coverage of the ~1,243-file LEGAiSEE codebase across sessions — read this FIRST at the start of any audit session to see exactly where to resume
Details
SUPERSEDED AS ENTRY POINT (2026-08-26): read legaisee-preface then legaisee-current-state first, always. This file documents the original 8-24 folder-level macro-audit in detail (kept for history/reference) — the deeper 8-25/8-26 function-level micro-audits extended coverage to genuinely 100% of the codebase; see Current State for the up-to-date picture, including a real discrepancy this file's "RESOLVED hazards" section has with the newer audit (setup.php).
John wants an entire-system macro audit (not "does the PHP execute" — does it connect to real data/other modules, and can John read the result in plain language) of the full codebase, tracked via this checklist since sessions have hit chat limits mid-audit before
Full codebase unzipped from a server export John uploaded (commandcenter.zip), read directly in Claude's own sandboxed workspace via bash/view tools — this is the standing method, not pasting individual files into chat
Output format: each completed section becomes its own file named LEGAiSEE_System_Audit_<Section>.md, presented to John, who copies/logs them to Google Docs himself
John's read on WHY the codebase has so many dead/orphaned clusters: LEGAiSEE has been started over and/or revised several times over its history, and specific functions he remembers building have disappeared over time — this audit exists partly to find them again. Plan: once the full macro-audit is complete, go back through the orphaned clusters looking for which ones represent the SAME feature rebuilt at different points in time (not unrelated dead code) — likely to reconstruct a real timeline of what LEGAiSEE used to do and explain specific vanished functions. Audit evidence so far supports this: the "autonomous agent/brain" concept alone has been rebuilt from scratch in three separate locations (engine/, api/v8/, api/ top-level); two competing UI component systems exist; four different bootstrap.php files exist; the semantic-diff/excavation-session cluster is a fourth separate rebuild pattern.
DONE — fully audited (contents read, findings documented)
Sidebar: Graph & Entities (7 files) → LEGAiSEE_System_Audit_Graph_Entities.md
Sidebar: Excavation (6 files) → LEGAiSEE_System_Audit_Excavation.md
Sidebar: Intelligence Engines (7 files) → LEGAiSEE_System_Audit_Intelligence_Engines.md
Sidebar: Command (5 files) → LEGAiSEE_System_Audit_Command.md
Sidebar: Planning, Clients & Cases, Tools + whole-sidebar summary (~12 files) → LEGAiSEE_System_Audit_Planning_Clients_Tools_and_Summary.md
engine/ — all 36-37 files, connectivity-checked; 15 orphaned ones deep-read → LEGAiSEE_System_Audit_Backend_and_Orphaned_Systems.md + LEGAiSEE_Orphaned_Engine_Files_Explained.md
api.php + api/v8/ (30 files, connectivity only) → same backend file
cli/ (9 files, connectivity only) → same
index.php (read + live-tested by John) → same
ExcavationCommand/ (3 files, connectivity only) → same
ProjectManager/ (88 files — connectivity/disconnection confirmed only, internal contents NOT read) → same
kernel/ — all 21 files, fully read and connectivity-traced → LEGAiSEE_System_Audit_Kernel.md
51 top-level standalone PHP files → LEGAiSEE_System_Audit_Top_Level_Files.md — ~4 genuinely load-bearing (already covered elsewhere: bootstrap.php, config.php, db.php, shell.php, graph_view.php, prospect.php, index.php, api.php), ~10 self-evident test/debug scaffolding (test_*.php etc, not individually opened), 1 real reused utility (response.php, 7 references — API Response Contract Guard), and ~36 form a third disconnected experimental cluster (a "semantic-diff/excavation-session" system built around lib/semantic_diff_engine.php, itself unreferenced) — roughly 21 files with zero references anywhere, 6 more with only 1-2 references within the same dead cluster. Two hygiene flags: setup.php creates a stray SQLite DB unrelated to the live MySQL system if ever hit directly (recommend deleting outright); embed_generate.php has a plaintext OpenAI API key placeholder in a web-accessible file (unconfigured/not currently leaking, but a risk if ever filled in without relocating). legaisee_prospects.php (676 lines) turned out to be an unrelated marketing/lead-gen HTML page, not a system tool. dossier_v2.php and excavation_engine.php share a hardcoded test network ID; session.php/create_session.php reference a fourth, unused data-folder layout — this cluster reads as an earlier/parallel experiment abandoned when the current modules/+MySQL+data/cases/ approach became the real system.
modules/utils/bootstrap.php + Recommendation-module question → LEGAiSEE_System_Audit_Bootstrap_Recommendations.md — bootstrap.php is NOT recommendation logic; it's a generic 33-line JSON-directory loader (load_json_dir()) shared by 9 modules. The REAL live Recommendation source is modules/recommendation_module.php (48 lines) — a simple hardcoded pattern-to-action lookup table run against already-detected case patterns, no engine/AI involved. Confirmed api/recommendations_generate.php + kernel/recommendation_engine.php ARE wired into api.php's router (case "recommendations") but have zero live callers anywhere in the UI — same dead-but-reachable pattern as the api/v8 cluster. New finding: FIVE files are named bootstrap.php (root, kernel/, modules/utils/, ProjectManager/, plus an unrelated Stripe vendor test file) — all four non-vendor ones are genuinely different code, adding to the naming-collision risk list.
ui/ (16 top-level PHP files + ui/components/ subfolder + global.css) → LEGAiSEE_System_Audit_UI.md — only ONE real live feature: ui_engine.php + layout.php, reached via the registered 'view' module (?module=view), a page-compare/executive-diff tool. CORRECTION to the top-level-files report: this view module requires lib/semantic_diff_engine.php, so that "dead" semantic-diff cluster actually has one live doorway into it, not zero. global.css (1,924 lines, documented as "the one global stylesheet, no embedded CSS elsewhere") is functionally DEAD — the function that would link it (kernel_assets()) is defined but never called anywhere — while shell.php, layout.php, and view_module.php each carry their own separate inline <style> blocks instead, plus a 4th orphaned CSS file (ui/theme.php). Also found: an entire second, more architecturally disciplined component/layout rendering system (11 files: component.php, component_boot.php, component_contract.php, component_registry.php, components.php, layout_contract.php, layout_engine.php, registry.php, theme.php, ui.php, ui_boot.php) — fully unreferenced anywhere, and even internally incomplete (component_registry.php points to 4 files that don't exist). This system's real component library turned out to be the ROOT-level /components/ folder (10 files, not the 6 the checklist guessed) — resolves the "unknown purpose" flag on that folder. ui/compare_engine.php + ui/file_explorer.php reconfirmed orphaned (already known from kernel/ audit). ui/components/ subfolder also has 2 more zero-reference files (ingestforshell.php, "ingest_exec snap.php").
api/ top-level, non-v8 (37 files) → LEGAiSEE_System_Audit_API_TopLevel.md — only 2 genuinely live: files_action.php (Files module) and search_load.php (Search module), both fetched directly by JS bypassing api.php's router. recommendations_generate.php reconfirmed dead-but-reachable (already documented). Remaining 34 files dead: 30 of them (agency_, agent_, brain_, case_, network_*, node_builder.php, graph_synthesizer.php, anomaly_detector.php, intel_cache.php, model_router.php, dossier.php, file_tree.php, excavate.php, excavation_run.php) form a clear "autonomous agent/brain" cluster — self-contained JSON REST endpoints simulating agency dispatch, agent spawning/ticking, and brain orchestration/memory — architecturally the SAME abandoned concept already found in engine/ and api/v8/, now confirmed as a third separate location for it, still never wired into the live UI. The other 3 (file.php, search.php, tree.php) are NOT random stragglers — John confirmed and the code verifies this was his attempt at a Windows/Mac-style file browser to search+explore what's actually in the system's ingested content: search.php keyword-searches the normalized/ ingest folder with scoring, tree.php is a full folder/node CRUD system backed by a real tree_nodes DB table (254 lines, more built-out than most dead code found so far), file.php fetches a single normalized/ file's content for viewing. A real, coherent search→browse→view pipeline that never got wired into any live page or menu.
Brain Dashboard feature-history investigation (open thread, not a folder-completion item) → LEGAiSEE_Brain_Dashboard_Recovered_Fragments.md — John recalled the Brain module used to have its own dashboard showing all system intel at once plus a drawn node/connection graph. Live modules/brain_module.php today is just a stripped-down read-only health-check (module/data counts, engine-file existence checks) — no intel display, no graph. Found two real disconnected fragments matching the memory: pages/network_view.php (genuine working vis-network.js force-directed graph, colored nodes/edges, currently hardcoded to one network ID) and pages/shell_template.php ("The Grand Lobby" — an earlier all-modules-at-once single-page dashboard layout, every module as a "wing" rendered simultaneously instead of the current one-module-at-a-time shell). Gap: these two don't appear to have been the same page — Grand Lobby's Brain wing would only show the same plain JSON stats live today, and the graph reads from a different data source than Brain's own memory files. Either an even earlier combined version isn't in this codebase snapshot, or the pieces were always separate. STATUS: open — if ProjectManager/ or anything else turns up more graph/brain/dashboard fragments, add to this file rather than starting a new one.
ProjectManager/ (88 PHP files + 60-page governance/PROJECT_MANAGER_BIBLE doc set) → LEGAiSEE_System_Audit_ProjectManager.md — this is NOT ad-hoc/experimental like every other dead cluster: a deliberate, disciplined attempt at a full standalone PM app (Notion/Asana/Jira-style) for LEGAiSEE, fully isolated (zero references in/out of the rest of the codebase), proper MVC architecture, real 9-table migrations, its own test suite. SECURITY FLAG: config.php has a live plaintext production DB password (same DB as the rest of LEGAiSEE) — not reproduced in the report, needs a deliberate decision (rotate/restrict/remove), independent of this project's fate. Backend genuinely finished: full Model+Repository+Controller+API for Project/Task/Comment/Client/Milestone/Label/ProjectMember, plus a complete permission/role system (Permission, Role, AuthorizationService, per-entity Policy classes). Every UI-facing Bible chapter (0400+: design language, layout, kanban, calendar, tasks page, client portal, etc.) is a literal 0-byte empty placeholder — never started. assets/, storage/, vendor/ folders exist but are empty. The project's own session-handoff doc (0999_SESSION_HANDOFF.md) documents the exact stopping point: user authentication wiring was never finished, and NO front-end views/UI were ever built — explicitly the next action listed was "front-end views, JS API client, Kanban/List UI." Handoff doc also records a real design constraint: "V1 Wrike/Asana style PM only — do not add LEGAiSEE AI OS features, do not redesign architecture." Code quality spot-checked and confirmed genuinely clean/complete (typed, strict_types, proper OOP), not stubs. Most recoverable dead cluster found in the whole audit if John ever wants to finish it — hard architecture decisions already made and locked.
root-level /components/ (10 files), database/ (2 files), _backup/ (2 files) → LEGAiSEE_System_Audit_Final_Small_Folders.md — components/ confirmed dead, sole purpose is component library for the already-documented dead second UI system; also holds nav.php, a flat-link nav bar (index/search/ingest/files) from an earlier pre-module-shell site structure, and compare.php, an unused alternate implementation of the Compare feature. database/ holds 2 identical copies (one a manual "bk" backup) of a SQLite migration creating the real tree_nodes table behind the dead file-browser feature (api/tree.php, documented in the api/ audit) — no migration runner exists anywhere to actually execute it; same SQLite-era origin as the standalone setup.php flagged in the top-level-files audit, before the project settled on MySQL. _backup/ is exactly what it says: one manually dated index.php snapshot (5-17-26) plus a .gitignore.
Running total: ~404 of 1,243 files fully or partially covered (~33%) — this figure only counts files with individually-read contents; large swaths of the ~1,243 total are template/library/vendor files (e.g. ProjectManager's own vendor/ dependencies) not meaningfully auditable file-by-file. See "Audit closure note" below.
MACRO-AUDIT COMPLETE
Every folder and top-level file group on the original checklist has been opened and connectivity-traced. Nothing remains in a "not yet started" state. See "Audit closure note" below for what this does and doesn't mean.
Audit closure note
This audit answered its founding question — for every part of the codebase, does it connect to real data/other modules, and can John read the result in plain language — across all named folders and file groups. It is NOT a claim that all ~1,243 files were individually opened; many were characterized as a group (e.g. test_*.php scaffolding, vendor libraries) once their pattern was established, per the audit's own stated method.
Phase 2: Reconstruction — grouping dead clusters by feature, not location
→ LEGAiSEE_Feature_Reconstruction_Rebuild_Families.md — first pass, six rebuild families identified:
"Windows/Mac file browser" — MAJOR CORRECTION: the dead search.php+tree.php+file.php cluster's general concept actually DID get rebuilt and IS live today as modules/files_module.php + api/files_action.php (own code comment: "Windows/macOS style file navigator"). But it browses the whole app's own file system (FM_ROOT=commandcenter/, for operators), not the normalized/ ingested case content, and has no keyword search — so if John's goal is specifically "search what the system has ingested," that's still not live anywhere, even though a file browser is.
Autonomous agent/brain system — rebuilt from scratch 3x (engine/, api/v8/, api/ top-level), never shipped in any form — repeated-attempt pattern, not simplification.
Brain Dashboard — cross-ref to the open thread file.
UI rendering — two full systems built (live: inline HTML/CSS everywhere; abandoned: registry-based component system + global.css), simpler one won even though the more disciplined one was fully designed and partly built.
Recommendation engine — 2 dead versions (kernel/, engine/) vs 1 live simplified version (modules/recommendation_module.php, hardcoded lookup table) — this family is simplification-over-time, not abandonment.
Semantic-diff/excavation-session cluster — represents a whole earlier data-organization model (legaisee/clients/{client}/excavations/{session}/), not just one feature; one live doorway remains via the Compare tool. Overall pattern identified: two types of history visible — "successful simplification" (families 1's shape, 5) vs "repeated attempts never shipped" (family 2, abandoned halves of 4 and 6). Suggested next step if John has a specific vanished function in mind: match it to one of these 6 families first, rather than searching file-by-file. STATUS: open, first pass — more rebuild families may surface as reconstruction work continues.
Confirmed naming-collision hazard (kernel/ audit + top-level audit)
graph_engine.php and recommendation_engine.php each exist as TWO separate, different files — one in kernel/, one in engine/ — both pairs turned out to be dead code, but this is a real risk that a future edit (by John, Windsurf, or any AI) could target the wrong file without realizing a duplicate exists.
Resolved by the top-level audit: cluster_engine.php, excavation_engine.php, and semantic_engine.php DO also exist at top-level, as part of the dead semantic-diff cluster — confirming these are further name collisions with their engine/ counterparts, not the same file. Not yet confirmed whether the top-level and engine/ versions are identical code or diverged.
RESOLVED hazards
ProjectManager/config.php plaintext production DB password — FIXED: credential moved to /home/carrmulti/private/pm_db_credentials.php (outside web root, confirmed 404 when requested directly via browser), config.php now requires it from there. Confirmed working via live dbcheck.php test (https://www.legaisee.com/commandcenter/ProjectManager/dbcheck.php). Note: the password value itself was NOT rotated (a typo during the file move was corrected back to the original value) — actual DB password rotation is still an open follow-up, not urgent now that the file is structurally protected.
setup.php stray-SQLite-DB hazard — FIXED: file deleted from www/commandcenter/. John liked its HTML/CSS visual styling better than the current live LEGAiSEE UI and saved the page source as a static (non-executable) reference for the future final UI build before deleting the live script — not a copy-exactly template, just a color/direction reference.
Standing update rule
Update this checklist AND the narrative log in legaisee-command-center at the end of every audit session — move completed rows from "not started" to "done," update running totals — so resuming after a chat-limit cutoff starts here, not from scratch






<a id="doc-30"></a>
## 30. 8-26-26_Legaisee Loose Scripts Audit.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-26-26_Legaisee Loose Scripts Audit.md` · 15411 bytes · 34 lines · encoding normalized to UTF-8*

8-26-26_Legaisee Loose Scripts Audit
Summary
Micro-audit of the 49 loose top-level PHP scripts — the FINAL piece of the full-system examine phase. Finds 3 separate plaintext live DB-credential exposures, an unauthenticated setup.php that can recreate a stray SQLite DB, an arbitrary-file-read page, a real orphaned "Memory Ingest Wing" feature, a real "Prospect Dossier" tool, and — most actionably — the actual clusterNodes() function sitting one path away from fixing the cli/worker.php crash
Details
Pass 2 of 2 for this session's remaining-surface sweep. This closes out the full-system EXAMINE phase per the session handoff's sequencing — after this file, per legaisee-recovery-roadmap, every part of the system has now been read at least once. Source: commandcenter.zip, same session as legaisee-toplevel-dirs-micro-audit.
SECURITY — worth John's attention before anything else here
3 separate exposures of real, live database credentials in plaintext, in 3 different files, with 2 different username/password pairs for the same database (carrmulti_legaiseearchive): root config.local.php (defines DB_USER/DB_PASS as PHP constants), and view_ingest.php (hardcodes a different username/password pair directly in a new PDO(...) call). A third file (embed_generate.php) has a placeholder key, not a real credential — already a known/standing hazard, not new. The two real, different credential pairs for the same DB is itself odd and worth understanding (was one rotated and the old one left behind in a different file?). Recommend rotating both credentials and centralizing all DB access through kernel/db.php's kernel_db() (the pattern most live files already correctly use) so credentials live in exactly one place.
setup.php still sits at the root, unauthenticated, and its POST handler recreates a SQLite database (legaisee.db, tables: chats/clients/artifacts) on demand — anyone who POSTs to it can recreate this file. This is a DIFFERENT SQLite artifact than the tree_nodes migration mystery flagged in legaisee-toplevel-dirs-micro-audit (different table names entirely) — there are at least 2 distinct stray-SQLite threads, not one. legaisee-recovery-roadmap's standing note that "setup.php stray SQLite DB — FIXED (deleted)" apparently refers to deleting the resulting .db file, not this script — the script itself is still present and would recreate it if triggered again.
view_file.php has no path validation at all — $_GET['file'] is passed straight to file_get_contents() with only an file_exists() check, no sandboxing to a base directory (unlike search_dual.php/intelligence.php/files.php, which all do real realpath() + prefix-check sandboxing). If this page is reachable on the live server, it's a straightforward arbitrary-file-read vector — including, plausibly, config.local.php itself. Zero internal callers were found, but it's a root-level file and therefore directly URL-accessible regardless of internal links.
SECURITY — one more, found on a second pass: root index.php has the SAME arbitrary-file-read bug as view_file.php, and it's the more likely home page
Root index.php ("LEGAiSEE Control Center UI") has its own inline AJAX file-view handler, same shape as view_file.php's: if(isset($_GET['view_file'])){ if(file_exists($file)){ echo file_get_contents($file); } } — zero path validation. Given index.php is the file a bare domain visit would serve by default (and setup.php, search_dual.php, components/nav.php all link to it), this is arguably the more urgent of the two file-read gaps to flag — index.php?view_file=config.local.php would hand back the live DB password in plaintext. Also on this same page: a "▶ Run Worker" button fires shell_exec("php cli/worker.php 2>&1") on a plain GET request (?run_worker=1) with no auth check at all — a live, unauthenticated, one-click trigger for the cli/worker.php crash already documented in legaisee-engine-micro-audit. Confirmed via git log/git ls-files that config.local.php itself is NOT tracked in git history, so at least it isn't sitting in any repo — but it's still live-readable through this bug regardless of git status, and the .htaccess's config\.php block doesn't cover config.local.php by name.
BIGGEST ACTIONABLE FIND: the real clusterNodes() function already exists — just in the wrong file
Root-level cluster_engine.php (NOT the same as the confirmed-empty engine/cluster_engine.php) actually DEFINES a working clusterNodes($case_id) function — real keyword-based clustering logic (risk/growth/opportunity/general buckets), reads data/cases/$case_id/network.json, writes clusters.json. This is exactly the function pipeline_adapters.php calls via clusterNodesPath() and cli/worker.php needs — but pipeline_adapters.php requires engine/cluster_engine.php (empty) instead of this root file. This is very likely a simple wrong-path bug, not missing functionality — one of the two undefined-function crashes in cli/worker.php (documented in legaisee-engine-micro-audit) may be this close to a real fix. Caveat: this root cluster_engine.php reads from data/cases/{case_id}/ (a flat path), while cli/worker.php's real per-client data lives at data/clients/{client}/cases/{case}/ — so pointing pipeline_adapters.php at the right file closes the "undefined function" gap but a path-convention mismatch would still need reconciling before it actually works end-to-end.
The other worker.php crash culprit, generateRecommendationsFromPath(), has NO equivalent real implementation sitting anywhere else in the codebase (confirmed via full-codebase search) — that one is genuinely missing, not just misplaced.
Cross-cutting pattern reinforced: SQLite syntax appearing in code that talks to the "MySQL only" production DB
Beyond the tree_nodes migration (found in legaisee-toplevel-dirs-micro-audit), datetime('now') (SQLite syntax, not MySQL's NOW()) also appears in engine/entity_extraction_engine.php — the file confirmed as one of the most solid, genuinely-live pieces in the whole codebase (real PDO, real entities/relationships tables, wired into modules/excavation_module.php and prospect.php) — and in modules/ingest_module.php (already known-live). This means a real, live, currently-used feature may be issuing SQL that doesn't match its stated production database engine. Worth a direct check at triage time: either MySQL is silently tolerating/ignoring this (some MySQL configs do accept datetime('now')-shaped calls oddly, unlikely but possible), or these inserts have been silently failing/warning in production, or part of the "MySQL only" claim in config.php's docblock is itself outdated and some real tables actually still live in SQLite. This ties together 3 previously-separate threads (tree_nodes migration, entity_extraction_engine.php, test_full_checkout.php's payment test) into one system-wide question worth answering before Phase 3 building starts.
New, previously-undocumented REAL features found
"Memory Ingest Wing" — a genuinely real, live-looking, fully-built feature: ingest.php (styled form, writes to a real memory_ingest table with domain_id/project_id/source_ai/session_title/raw_transcript/processed columns, pulls dropdown options from real memory_domains/projects tables) + view_ingest.php (browses/searches the same table) + temp_dashboard.php (hub linking the two). This is a transcript-archiving tool — paste an AI conversation, tag it by domain/project/source AI, store it — which maps directly onto John's own stated way of working (feeding chat transcripts into a persistent memory system). However: this specific trio (ingest.php/view_ingest.php/temp_dashboard.php) has been SUPERSEDED. modules/ingest_module.php's own docblock literally says "Migration of commandcenter/ingest.php to proper module pattern" — and confirms the live module still uses the SAME memory_ingest/memory_domains tables. So the underlying data is real and current, but these 3 specific root files are a legacy predecessor UI, not what's actually wired into shell.php's Grand Lobby today (only orphaned pages/ prototypes still link to them). ingest.php itself does link out TO shell.php ("← Grand Lobby"), suggesting it may have been left up temporarily during the module migration.
prospect.php ("Prospect Dossier" tool) — REAL, LIVE, well-built, confirmed wired into shell.php (shell.php requires it directly). Self-creates a properly-specified prospect_ingests MySQL table (real InnoDB/utf8mb4 engine, unlike the SQLite-flavored code elsewhere), uses the real entity_extraction_engine.php, and implements a versioned "ingest history per prospect" pattern (archives old ingests, tracks authority_score/signal_count over time). One of the best-built, most clearly-functional pieces found in this entire audit.
api.php — a well-designed unified API router (?action=build_graph|clusters|insights|recommendations|tasks|ingest|enqueue_task) that internally wraps the scattered api/v8/*.php endpoints via an ob_start()/include/json_decode "legacy()" adapter, plus a real processing_queue INSERT for the enqueue_task action. Currently has zero live callers anywhere — a clean consolidation attempt that was never adopted, but genuinely nice architecture; worth considering as the actual API surface going forward rather than scattering calls across individual api/v8/ files.
A second, older, parallel front-end shell — root-level index.php ("LEGAiSEE Control Center UI"), files.php (real file browser, live-linked from components/nav.php), search_dual.php, and saved_views.php/mission.php all reference a 4-link nav bar (Dashboard/Search/Ingest/Files) via components/nav.php — but components/nav.php itself is never included by any live file (confirmed via codebase-wide search), so this whole earlier-generation shell is currently disconnected from internal navigation. Important caveat: because these are root-level, directly-URL-accessible PHP files (unlike files inside modules/ which only render through shell.php's router), a visitor could still reach index.php, files.php, etc. directly by URL even with no internal links — and since index.php sits at the document root, it may well be what actually loads when someone visits the bare domain, competing with shell.php ("Grand Lobby") for the position of true home page. This can't be confirmed from the zip alone — worth an actual site-visit check.
files.php (confirmed live via components/nav.php link, itself possibly reachable via direct URL/root ambiguity above) actually curl-calls two other root scripts on submit: excavation_engine.php (fake/toy AI-simulation code — string-templated "AI {platform} analysis for: { query}" responses, not real API calls) and indexer.php (REAL — confirmed as the actual backing indexer for the normalized/ search-index data found in legaisee-toplevel-dirs-micro-audit). So part of this older shell is genuinely functional (real indexing) glued to part that's simulated (fake excavation).
Full orphaned/broken inventory (confirmed via codebase-wide caller search, zero real callers found for each)
Broken duplicates with wrong relative paths (evidence of copy-paste from a deeper original location without adjusting ../ depth): root dashboard.php (path goes 2 levels above the app root — nonsensical), root dossier_v2.php (same ../../ issue; a working version of this concept already exists and is documented as api/v8/dossier_v2.php in legaisee-brain-micro-audit's "OLD/FAKE paradigm" list).
Broken due to undefined functions/variables: ai_process.php (calls process_ai(), never defined anywhere — its own comment admits "this should already exist in your system," but it doesn't); test_db.php (checks $conn, but the db.php it requires actually sets $pdo, so this test always reports failure regardless of real DB status).
Genuinely broken by the same root bootstrap.php issue found in tools/ (legaisee-toplevel-dirs-micro-audit): export_report.php (a real, otherwise-solid dompdf-based PDF report generator for the clusters table — would fatal immediately on $pdo use, since root bootstrap.php defines nothing).
Real, well-built, but simply never wired to anything: parser.php (solid multi-format text extractor: txt/md/pdf/docx/xlsx), semantic_engine.php (real cosine-similarity related-content engine using page.embedding), load_module.php (a clean AJAX-style module-content loader — no confirmed live callers despite fitting the shell.php pattern well), create_session.php/session.php (a coherent excavation-session creator+viewer pair, zero callers anywhere), mission.php ("Mission Mode" workspace dashboard — reveals yet another schema concept, workspace/page.workspace_id/page.ai_score, not seen in any prior audit), intelligence.php (a real rule-based, non-AI local text-insight extractor), saved_views.php (real saved_views table CRUD, but includes a root nav.php that doesn't exist anywhere in the zip), load_sets.php/save_set.php (read/write the confirmed-empty sets/ directory — explains why it's empty), create_review_flags.php (a one-off migration-style script — but the review_flags table it creates IS genuinely used live by modules/client_view_module.php, dig_review_module.php, report_module.php, so this was a real, already-completed one-time setup step, not dead code).
Test/debug/scratch files with no production role: peek.php (dumps modules/insight_module.php's raw source), test_graph.php (points at a nonexistent data/graph_data.php and a self-HTTP call that wouldn't resolve), test_kernel.php, test_excavation_module.php, test_modules.php (a genuinely useful full-module-registry load-test harness, worth actually running during Phase 5 wiring/testing even though unwired now), test_visual.php (pure CSS/HTML style sandbox for the gold/violet luxury theme, no logic), test_full_checkout.php (a real, thorough Stripe payment-flow test script — confirms a genuine Stripe payment system with payments table columns for status/session/intent/paid_at/email flags), test_ui.php (an early sidebar-layout HTML prototype, predecessor to shell.php's actual layout), db_verify.php/diagnostics2.php (both genuinely useful, real diagnostic scripts against the live DB — diagnostics2.php's queries confirm 2 more previously-unmentioned real tables: activity_log, audit_logs).
Legacy/duplicate naming-collision entries (extending the running list in legaisee-recovery-roadmap): root cluster_engine.php (real, orphaned — see clusterNodes() finding above) vs. engine/cluster_engine.php (confirmed empty).
Not code — leftover content: legaisee_prospects.php (a static styled HTML business content page, "Prospect List — Austin & San Antonio Corridor," not a functional tool).
STILL TO DO
This completes the full-system EXAMINE phase per the session handoff. Per legaisee-recovery-roadmap's locked sequencing, the next step is Phase 2: system-wide triage (keep/restore/fix/delete) across everything documented in all micro-audit files — not more examining.
Worth flagging to John as a short "read this first" priority list before triage begins: (1) the 3 plaintext-credential exposures + the unauthenticated setup.php + view_file.php's arbitrary-read gap, (2) the clusterNodes() near-fix for the worker.php crash, (3) the SQLite-vs-MySQL syntax question spanning 3 files, (4) confirming whether index.php or shell.php is actually the live document-root landing page.




<a id="doc-31"></a>
## 31. 8-26-26_Legaisee Recovery Roadmap.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-26-26_Legaisee Recovery Roadmap.md` · 13123 bytes · 28 lines · encoding normalized to UTF-8*

8-26-26_Legaisee Recovery Roadmap
Summary
John's 6-phase plan for what happens after the system audit — triage, documentation, site map, wiring/testing, final UI polish. Read this to see which phase is active and what's next.
Details
John's 6-phase plan, decided once the full macro-audit (legaisee-audit-checklist) was complete:
Audit (DONE) — the complete documented audit: what's working, broken, orphaned, unconnected, across every system/section
Triage — for every piece found, decide: keep, restore, fix, finish, vs. genuinely deletable
Document the full system — the first real "what was built/started" view of all of LEGAiSEE, organized into sections/"wings" (naming TBD) covering every major and minor piece
Site map design — decide the real information architecture: which modules get their own page/view, which get combined onto a shared labeled dashboard, etc.
Wiring & testing — fix and connect everything found in the audit; create simple, deliberately ugly "test page" style scaffolding as needed just to prove functionality works, before appearance matters
Final OS/UI — make it all polished and usable, last, only once everything underneath actually works
Document this whole process as it happens — possibly starting as just a To-Do table of contents broken into chapters; undecided yet whether this next phase needs a full Bible-style spec (like the ProjectManager attempt had) or something lighter
Current phase: audit is NOT yet complete system-wide (see below) — Phase 2 triage has not begun.
Sequencing correction (2026-08-24): triage decisions are not made or acted on per-cluster as each gets examined. Full sequence, all-together, in this order: (1) finish examining/documenting EVERY part of the system with nothing left unexamined, (2) THEN make all triage decisions across the whole system together, (3) THEN execute repair/fix/delete as one pass, (4) THEN build. No fixing/repair/coding work happens until step 3 — fixing burns tokens on code and shouldn't start mid-examination. Findings from each completed micro-audit are documented and complete, but do not get executed in isolation — they wait and feed into the single system-wide triage-then-execute pass alongside every other cluster.
Formalized a 3-document Google Docs bootstrap protocol to carry context between sessions without relying on conversation history: LEGAiSEE_MASTER_PREFACE.md (rules, rarely changes), LEGAiSEE_CURRENT_STATE.md (where the project stands, updated every session), and LEGAiSEE_MASTER_TOC.md (living documentation skeleton) all live as sections in one published Google Doc John maintains and shares by link each session — read in that order at the start of any session, only then the specific audit/code files the bounded task needs. Standing instruction going forward: at the start of any new LEGAiSEE session, fetch that doc first (John will provide the current link) before relying on local memory files for project status.
Phase 2 triage starting unit: the 6 rebuild families (autonomous agent/brain 3x-rebuilt, UI rendering live-vs-abandoned, recommendation engine, semantic-diff/excavation-session cluster, ingested-content search, ProjectManager/) plus 3 standing hazard flags (ProjectManager plaintext DB password, embed_generate.php plaintext API key placeholder, setup.php stray SQLite DB) — not folder-by-folder
Original 6-family list (brain, UI, recommendation, excavation/semantic-diff, search, ProjectManager) is now fully micro-audited. Discovered mid-session that the true unexamined surface is much larger than that list implied — see legaisee-modules-micro-audit for the newly-found modules/ folder (39 files, in progress) and its own "still to do beyond modules/" list covering kernel/, api/, engine/, pages/, and ~10 entirely untouched top-level directories plus ~45 unopened loose PHP scripts. "Nothing left to examine" is not yet true system-wide — will take several more sessions of the same file-by-file treatment.
Update (2026-08-25): modules/ folder is now FULLY read (all 34 registered files). Turned up 3 more naming-collision families beyond the original list (brain — modules/brain_module.php is the real live nav item, not covered by the earlier brain cluster audit; project-manager — a 3rd implementation at modules/project_manager/; possibly search/view). Also found a real live end-to-end pipeline (dig-review confirm → PDF report → vault storage) and a live-looking bug (insight_module.php vs ingest_module.php have mismatched DB column names, both separately registered/reachable). Two more untouched top-level dirs found: _operations/, _generated/ (added to the still-to-examine list). Full detail in legaisee-modules-micro-audit.
Update (2026-08-25, same session): kernel/ folder (22 files + model/) is now FULLY read → legaisee-kernel-micro-audit. Found a THIRD parallel data paradigm (page/folder wiki tables — confirmed live, called from ui/file_explorer.php), a broken system_health.php self-check (2 real bugs), a genuinely-broken task_generator.php function (undefined $pdo), 2 confirmed-orphaned files (engine_bindings.php, guard.php — safe delete candidates), and a possible re-discovery of the "stray SQLite DB" issue (root setup.php + kernel/legaisee.db still reference it — may not actually be the same instance the standing hazard note says is already fixed, needs a quick confirm-or-correct pass before triage). Also confirms part of the "fake" flat-JSON network system (ingestion_pipeline.php) has a real live caller from modules/ingest_module.php — partial correction to legaisee-brain-micro-audit's "100% fake" Group B finding.
Update (2026-08-25, same session): pages/ folder (9 files) is now FULLY read → legaisee-pages-micro-audit. Whole folder confirmed orphaned — nothing in the live system routes to any file in pages/. Contains an earlier, unwired prototype of the live Grand Lobby shell (pages/shell_template.php — this is where the "Grand Lobby"/"Wings" terminology originated), a real self-contained flat-file search+compare tool with no DB dependency (a 4th distinct search/compare implementation, not overlapping with the other 3), and one confirmed-broken debug scratch file. Correction: the insight_module.php/ingest_module.php duplicate-schema issue flagged as "NEW" in legaisee-modules-micro-audit was actually already found and documented on 2026-08-23 in legaisee-command-center — not a new discovery, just independently re-confirmed this session.
SUPERSEDED AS ENTRY POINT (2026-08-26): read legaisee-preface then legaisee-current-state first, always. This file's running session log below is kept for history but is no longer maintained going forward — new updates go in Current State instead (which gets rewritten each session, not endlessly appended to).
Update (2026-08-25, same session): api/ folder is now FULLY covered → legaisee-api-toplevel-audit (combined with the earlier legaisee-brain-micro-audit, which already handled the ~30 brain/agency/case files and all of api/v8/). New findings: files_action.php's file-manager sandbox is scoped to the ENTIRE application directory, not just user data, so the live Files nav item can reach the app's own source/config files; and a 5th distinct, non-interoperable "network JSON file" naming convention was found in recommendations_generate.php, on top of the 4 already known — any real fix to the graph/network system needs to standardize this first. Remaining unexamined: engine/ (38 files, needs a systematic pass — many touched only incidentally so far), ~10 untouched top-level directories, ~45 loose top-level scripts.
Update (2026-08-25, new session): engine/ folder (38 files) is now FULLY covered → legaisee-engine-micro-audit (10 files already handled by legaisee-brain-micro-audit and 2 by legaisee-recommendation-micro-audit were cross-referenced, not re-audited; 26 files newly read). Two major new findings: (1) cli/worker.php — the REAL, live background worker actually invoked by the system — is likely fatally broken on every real run via undefined-function calls (clusterNodes(), generateRecommendationsFromPath(), generateSystemInsights()) inside its main per-case processing loop; flagged to John as worth knowing sooner rather than later, ahead of the normal triage-then-fix sequencing. (2) A fourth, previously-undiscovered "autonomous" rebuild attempt was found — a full Goal→Decision→Execution→Feedback→Learning governance pipeline (~17 files) — entirely orphaned (zero live callers) and reading/writing a fourth separate flat-file convention (data/system/*.json), on top of the 3 brain rebuilds already known. Also found one strong restore candidate: plain_english_helper.php, a built-but-never-wired plain-language explanation layer matching John's stated UI preferences. Remaining unexamined: ~10 untouched top-level directories, ~45 loose top-level scripts.
Update (2026-08-26, new session, pass 1 of 2): top-level directories are now FULLY covered → legaisee-toplevel-dirs-micro-audit. _operations/ and _generated/ don't exist in this zip; archive/, dossiers/, sets/ are genuinely empty. Key findings: (1) cli/ contains a FIFTH orphaned autonomous subsystem (event/goal/multi-chain-reasoning pipeline, ~8 files, zero live callers, its own real internal bug — a $$score typo that breaks its scoring logic even standalone) on top of the 4 already known. (2) Real Logs/ files provide corroborating evidence the cli/worker.php crash bug found last session likely fired in actual production. (3) tools/ — a real, coherent clustering-maintenance suite (7 files, real PDO/OpenAI code) — is currently 100% broken because it requires the deprecated root bootstrap.php (a 2-line comment with no code) instead of the real modules/utils/bootstrap.php. (4) 2 more live-vs-orphaned naming collisions confirmed: root graph_view.php (live) vs views/graph_view.php (orphaned, different/bigger file), and modules/view_module.php (live, registered) vs views/view_module.php (orphaned, different file). (5) database/migrations/'s tree_nodes table uses SQLite syntax despite MySQL-only config — flagged as the most promising lead yet on the still-open "stray SQLite DB" question from legaisee-kernel-micro-audit. Remaining: ~45 loose top-level PHP scripts (pass 2, same session).
Update (2026-08-26, same session, pass 2 of 2 — FULL-SYSTEM EXAMINE PHASE NOW COMPLETE): the ~49 loose top-level PHP scripts are now FULLY covered → legaisee-loose-scripts-audit. This closes out the examine/document phase per the locked sequencing — nothing left unexamined system-wide. Two urgent items flagged to John directly, ahead of normal triage timing: (1) 3 separate plaintext live DB-credential exposures across config.local.php, temp_dashboard.php, and view_ingest.php (2 different username/password pairs for the same production DB — worth checking which is current); (2) an unauthenticated arbitrary-file-read bug in root index.php (likely the actual document-root home page) via an unvalidated ?view_file= parameter — could directly expose config.local.php's password — plus an unauthenticated one-click "Run Worker" button on the same page that triggers the already-known cli/worker.php crash. Also found: setup.php is still live and NOT deleted (corrects this file's own standing note below — its POST handler can still recreate a stray SQLite DB); the likely precise fix location for one of the two worker.php undefined-function bugs (a real, working clusterNodes() sits in root-level cluster_engine.php — pipeline_adapters.php's require just points at the wrong, empty file in engine/ instead); 2 more real live features (a "Memory Ingest Wing" transcript archiver, since superseded by modules/ingest_module.php per that module's own docblock; and prospect.php, a well-built, confirmed-live "Prospect Dossier" tool wired into shell.php); and a whole disconnected earlier-generation front-end shell (index.php/files.php/search_dual.php/mission.php, tied together by components/nav.php, which itself has zero live callers).
CORRECTION to the earlier resolved-issues note above: "setup.php stray SQLite DB — FIXED (deleted)" is stale/inaccurate — per legaisee-loose-scripts-audit, setup.php itself is still present, unauthenticated, and web-reachable, and its POST handler still creates ./legaisee.db if one doesn't exist. Whatever was fixed was at most the resulting .db file at some point in time, not the script that can recreate it. Needs a real fix at triage, not just documentation.
SYSTEM CHANGE (2026-08-26): given the 4hr-lockout/3-4-response-per-zip-upload reality, replaced the "triage everything, then execute everything" plan with a rolling work-order queue → legaisee-work-orders, now THE entry point for any new LEGAiSEE session (read before anything else, before even asking for the zip). First batch of 7 fully-specified, ready-to-execute work orders written (5 security/Priority 0, 2 bug-fix/Priority 1). This file remains the phase-level status log; legaisee-work-orders is where actual next-action detail now lives.




<a id="doc-32"></a>
## 32. 8-26-26_Legaisee Current State.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-26-26_Legaisee Current State.md` · 12941 bytes · 50 lines · encoding normalized to UTF-8*

8-26-26_Legaisee Current State
Summary
LEGAiSEE — CURRENT PROJECT STATE. The single living-status file — read this every session, right after legaisee-preface.md. Gets REWRITTEN each session, not endlessly appended to.
Details
Companion to legaisee-preface (rules) — read the Preface first, this file for where things actually stand today. Supersedes the now-deprecated status roles of legaisee-recovery-roadmap, legaisee-audit-checklist, and legaisee-work-orders — those three files still hold real detail (pointed to below) but are no longer where a new session should start.
CURRENT PROJECT PHASE
Phase 1 — System Archaeology: COMPLETE, and more complete than John's own 8-24 doc snapshot recorded. That doc (last updated 2026-08-24) reported ~404/1,243 files (~33%) individually read via an earlier folder-level macro-audit. Since then (sessions 2026-08-25 and 2026-08-26), Claude ran a second, deeper function-level micro-audit pass covering engine/ (all 38 files), every previously-untouched top-level directory, and all ~49 loose top-level scripts — genuinely 100% of the codebase has now been read at least once, most of it at function-level detail, not just connectivity-traced.
Phase 2 — Triage: NOT YET STARTED for the big clusters. A handful of unambiguous security/bug items were pulled ahead of formal triage (see "Items already actioned ahead of triage" below) because they don't need a KEEP/RESTORE/FIX debate — they're just broken or dangerous. Do not treat this as Phase 2 having started for the real triage units listed below.
Next bounded task: real Stage 2 triage, cluster-by-cluster, using the KEEP/RESTORE/FIX/FINISH/INTEGRATE/REPLACE/DEFER/DELETE vocabulary from legaisee-preface.
⚠️ DISCREPANCY TO RESOLVE FIRST — setup.php
John's 8-24 doc records "setup.php stray-SQLite-DB hazard — FIXED: file deleted from www/commandcenter/." The 8-26 loose-scripts audit found setup.php still present in the re-uploaded commandcenter.zip, still unauthenticated, still able to recreate a stray SQLite DB. Two possible explanations: (a) it was deleted live on the server but a stale copy is still in whatever export produced this zip, or (b) it was never actually removed. This needs a live-server check (not a memory fix) before the next zip upload — if it confirms already-deleted-live, no action needed and the zip is just stale; if not, WO-5 below still applies.
Genuinely live/working today (confirmed across both audit passes)
files_action.php + search_load.php (api/) — Files and Search modules
modules/files_module.php + api/files_action.php — a "Windows/macOS style" file browser for the app's OWN filesystem (not ingested case content — no keyword search over normalized/ content exists live anywhere)
ui_engine.php + layout.php via the 'view' module — page-compare/executive-diff tool (depends on lib/semantic_diff_engine.php)
modules/recommendation_module.php — hardcoded pattern-to-action lookup table (the real, simplified recommendation logic)
modules/brain_module.php — stripped-down read-only health check only (no intel display, no graph)
entity_extraction_engine.php (engine/) — real PDO-based entity/relationship extraction, wired into excavation_module.php and prospect.php
prospect.php — confirmed-live "Prospect Dossier" tool, wired into shell.php
indexer.php + normalized/ — real backing store for search indexing
Major dead/orphaned clusters (unit of Stage 2 triage decisions)
The original 6 rebuild families from the 8-24 doc still stand; 3 more have since surfaced. Full detail for all of these lives in the micro-audit files listed under "Where the detail lives" below — this file only tracks the decision status.
Autonomous agent/brain system — rebuilt from scratch 3x (engine/, api/v8/, api/ top-level ~30 files). DECISION (8/26): John's framing is macro, not "which PHP batch survives" — goal is the smartest possible brain/intelligence backend to run the LEGAiSEE business, full stop. None of the existing attempts qualifies as-is: Group A (graph_engine.php, semantic_cluster_engine.php, cluster_insights.php, graph_ranker.php, get_cases/get_clients.php, network_add_node.php) is the only real DB-backed logic across all 5 rebuild attempts, but has no actual AI reasoning in it. brain_orchestrator.php+brain_synthesis.php (api/ top-level) is the best architectural SHAPE found (prompt-build → route to 3 models → weighted synthesis) but sits on fake model_router.php stubs. Plan: KEEP Group A as the real data foundation, KEEP the orchestrator/synthesis shape, BUILD a real model_router.php (actual OpenAI/Claude/Gemini calls), DELETE the rest of Group B/C simulation code as redundant. The two newer orphaned governance pipelines (family 7: Goal→Decision→Execution→Feedback→Learning, ~17 files; family 8: cli/ event/chain-reasoning, ~8 files) are more architecturally complete on paper but zero live callers and each has its own undefined-function bugs — not adopted outright, but decision_engine_v2.php→system_insight_engine.php→cross_case_engine.php (the one internally-working sub-chain in family 7) is worth reusing when the real brain gets built. Execution detail (what actually gets built) still needs its own work order once WO-1 through WO-7 are cleared.
UI rendering — two full systems (live: inline HTML/CSS everywhere; abandoned: registry-based component system + global.css, itself incomplete). DECISION: pending.
Recommendation engine — 2 dead versions (kernel/, engine/) vs 1 live simplified version. DECISION (8/26): same macro standard as the brain family — judge by what best runs the business, not which file survives. DELETE the 2 dead versions (kernel/'s marketing-keyword matcher, engine/'s per-case JSON version). The current live one (modules/recommendation_module.php) is a hardcoded pattern-lookup table, not real intelligence — treat it as a placeholder to eventually be superseded by real brain/model_router output once that's built, not a permanent KEEP.
Semantic-diff/excavation-session cluster — earlier data-organization model, one live doorway via Compare/view tool. DECISION: pending.
File browser vs. content search — browser DID get rebuilt and is live; the actual "search what's been ingested" need is still unmet anywhere. DECISION: pending — likely FINISH/INTEGRATE candidate since the demand is real and unmet.
ProjectManager/ (88 files) — NOT ad-hoc. Disciplined standalone PM app, real MVC + 9-table migrations + full permission system, backend genuinely finished and clean. Every UI-facing chapter is a 0-byte placeholder. Most recoverable dead cluster in the whole audit. SECURITY: config.php had a live plaintext DB password — already FIXED (moved outside web root, confirmed via live dbcheck.php test — this one's real, unlike the setup.php discrepancy above). DECISION (8/26): GO — finish it. Next concrete step when its turn comes: fix the TaskRepository.php pm_tasks/projects table-name mismatch, write migrations 010-014, then start on the UI layer (currently 100% empty).
[NEW, found 8-25] Goal→Decision→Execution→Feedback→Learning governance pipeline (~17 files in engine/) — a 4th independent autonomous-system rebuild attempt, architecturally the most complete found anywhere, zero live callers, reads/writes its own 4th flat-file convention (data/system/*.json). DECISION: pending.
[NEW, found 8-26] cli/ event/goal/multi-chain-reasoning pipeline (~8 files) — a 5th independent autonomous-system attempt, zero live callers, own flat-file convention, has its own internal bug ($$score typo breaks its scoring logic even standalone). DECISION: pending.
Duplicate root-vs-nested file pairs — John asked (8/26): are these exact copies, or different code? CONFIRMED DIFFERENT CODE in every pair checked so far, none are simple copies: cluster_engine.php (root = real, working clusterNodes(); engine/ = literally 0 bytes, not a copy at all, an empty decoy) — safe DELETE of the engine/ side. graph_view.php (root, 115 lines, live/wired) vs views/graph_view.php (312 lines, orphaned) — genuinely different, and the orphaned one is actually MORE built out — worth a quick look for functionality worth merging before deleting, not a blind delete. view_module.php (modules/, 263 lines, live/registered) vs views/view_module.php (122 lines, orphaned) — genuinely different, smaller orphaned version, safer to just delete. recommendation_engine.php (kernel/ vs engine/) — different domains entirely (marketing-keyword matching vs per-case JSON), not copies of each other or of the live modules/recommendation_module.php — see item 3 above. dashboard.php/dossier_v2.php (root) — broken copy-paste duplicates of api/v8/ originals with wrong relative-path depth, zero callers — safe DELETE. STILL UNVERIFIED (named as colliding in the original macro pass but never line-diffed): graph_engine.php, excavation_engine.php, semantic_engine.php — don't assume same disposition as the confirmed pairs until checked.
plain_english_helper.php — 293-line library, converts raw module output into plain-language explanations across 11 module types (relations, graph, anomaly, insight, recommendation, cluster, cross-case, time-intelligence, generic). John confirmed (8/26) this matches exactly what he wants it for: e.g. turning "500+ nodes and connections" into what that actually means for the business and how it helps him run it — not raw numbers. DECISION: RESTORE/INTEGRATE, confirmed. Still needs a "where does this get wired in" answer — natural candidates are the graph/node view and any brain/recommendation output surface, to be picked when this item's work order comes up.
Items already actioned ahead of formal triage (unambiguous — security/crash bugs, not real triage calls)
Full detail and exact fix instructions in legaisee-work-orders (still valid as a task list, just no longer the session entry point):
WO-1/2/3: unauthenticated arbitrary-file-read in index.php + view_file.php, and an unauthenticated "Run Worker" trigger in index.php — PENDING
WO-4: 2 different plaintext live DB passwords found across config.local.php vs temp_dashboard.php/view_ingest.php — PENDING, blocked on John confirming which is actually current
WO-5: setup.php — PENDING, see discrepancy note above, don't act until the live-server check happens
WO-6: cli/worker.php crash, partial fix identified — point engine/pipeline_adapters.php's cluster_engine.php require at the real root-level cluster_engine.php instead of the empty engine/ decoy — PENDING
WO-7: tools/ + export_report.php all broken via a dead root bootstrap.php require — swap for db.php — PENDING
Known hazards carried into triage (naming collisions, etc.)
graph_engine.php, recommendation_engine.php, cluster_engine.php, excavation_engine.php, semantic_engine.php, graph_view.php, view_module.php each exist as 2+ genuinely different files in different locations.
5 different files named bootstrap.php across the codebase (root — dead stub, kernel/, modules/utils/ — the real one, ProjectManager/, plus a vendor file).
database/migrations/'s tree_nodes table uses SQLite syntax despite a MySQL-only config — possible link to the setup.php/legaisee.db discrepancy above, unconfirmed.
embed_generate.php has a plaintext OpenAI key PLACEHOLDER (not a real key) in a web-accessible file — not currently leaking, but relocate before ever filling in a real one.
Where the detail lives (Part I reference material — open only what the current bounded task needs)
Original 8-24 macro-audit reports: LEGAiSEE_System_Audit_Graph_Entities / Excavation / Intelligence_Engines / Command / Planning_Clients_Tools_and_Summary / Backend_and_Orphaned_Systems / Kernel / Top_Level_Files / Bootstrap_Recommendations / UI / API_TopLevel / ProjectManager / Final_Small_Folders (these live in John's Google Doc + his own Google Docs copies, not all individually in Claude's memory). Deeper 8-25/8-26 function-level micro-audits (in Claude's memory, aliases in parens): legaisee-brain-micro-audit, legaisee-ui-micro-audit, legaisee-recommendation-micro-audit, legaisee-excavation-semanticdiff-micro-audit, legaisee-search-micro-audit, legaisee-projectmanager-micro-audit, legaisee-modules-micro-audit, legaisee-kernel-micro-audit, legaisee-pages-micro-audit, legaisee-api-toplevel-audit, legaisee-engine-micro-audit, legaisee-toplevel-dirs-micro-audit, legaisee-loose-scripts-audit.
NEXT RECOMMENDED TASK
Begin real Stage 2 triage. Recommend starting with whichever cluster John wants first — ProjectManager/ (cleanest go/no-go, highest recoverable value) or the combined 5-way autonomous-system decision (families 1, 7, 8 above — largest, most repeated sunk effort, and now genuinely complete information across all 5 attempts) are the best starting points since both are self-contained and don't block on the others.





<a id="doc-33"></a>
## 33. 8-27-26_Legaisee Work Orders.md

*Source: `_governance/Docs/LEGAiSEE_Claude Memory/LEGAiSEE_Claude Memory/8-27-26_Legaisee Work Orders.md` · 11213 bytes · 35 lines · encoding normalized to UTF-8*

8-27-26_Legaisee Work Orders
Summary
THE entry point for any new LEGAiSEE chat session — read this file FIRST, before anything else, even before the zip is re-uploaded. Queue of bounded, self-contained, ready-to-execute work orders generated from the completed system-wide audit, so a new session can act in 1-2 responses instead of re-deriving findings.
Details
SUPERSEDED AS ENTRY POINT (2026-08-26): read legaisee-preface then legaisee-current-state first, always — this file is now just a detail/task list, referenced from Current State's "Items already actioned ahead of formal triage" section. The work orders below are still valid and still the right level of detail for execution, they just aren't where a new session starts anymore.
Created 2026-08-26 because re-uploading commandcenter.zip only buys John 3-4 responses before a 4hr lockout, and the full-system examine phase (documented across legaisee-brain-micro-audit, legaisee-ui-micro-audit, legaisee-recommendation-micro-audit, legaisee-excavation-semanticdiff-micro-audit, legaisee-search-micro-audit, legaisee-projectmanager-micro-audit, legaisee-modules-micro-audit, legaisee-kernel-micro-audit, legaisee-pages-micro-audit, legaisee-api-toplevel-audit, legaisee-engine-micro-audit, legaisee-toplevel-dirs-micro-audit, legaisee-loose-scripts-audit) took days across many sessions. Purpose of this file: turn that finished audit into small, independently-executable tasks so future sessions spend their limited turns fixing, not re-reading.
MAJOR UPGRADE (8/26): the snippet-paste approach below is superseded — see dev-workflow for the live-mirrored GitHub repo (https://github.com/carrmultimedia-arch/LEGAiSEE_Repo) Claude can now clone and grep directly for ground truth, no zip, no snippet-pasting needed. (3) is now: Claude verifies the exact current file text and any live/dead-caller questions itself via the repo clone, and only asks John for a decision (not a paste) when something is genuinely a judgment call, not a fact-check.
John prefers to start each individual work order in a brand-new chat (not continue in the same long-running session) — this file plus legaisee-preface/legaisee-current-state are what carry context in, so a fresh chat can pick up a WO cold.
PROCESS FIX (8/26, after a bad run): a cold new chat sent John to edit root index.php as if it were live, but that file's live-vs-dead status was only ever flagged as uncertain in a separate micro-audit file, not stated in the WO text itself — the new chat missed it. New rule: every WO entry below must state the target file's confirmed live/dead status inline, right in the WO text, not just link out to an audit file. If status is unconfirmed, that's the FIRST thing a WO must ask John to resolve, before any code fix is proposed.
PRIORITY 0 — SECURITY, do these first regardless of anything else
WO-1: root index.php. STATUS UPDATE (8/26): John confirms this is CONFIRMED DEAD — an old dashboard left over from before the shell.php/modules plan existed. Fix simplified: no code edit needed — just delete the file entirely via cPanel's file manager. This closes the arbitrary-file-read hole by removing the file, not patching it. STATUS: PENDING (John to delete).
WO-2: view_file.php. CONFIRMED via direct repo grep (8/26): only referenced by index.php (already dead, WO-1). No other caller anywhere in the actual codebase. Delete outright via cPanel. STATUS: PENDING (John to delete).
WO-3: "Run Worker" button, same file as WO-1. Since index.php is confirmed dead and being deleted outright (see WO-1), this is resolved automatically — no separate action needed once WO-1's deletion happens. STATUS: RESOLVED BY WO-1.
WO-4: Consolidate/rotate the DB credentials. Files: root config.local.php (password ends @), temp_dashboard.php and view_ingest.php (both hardcode a DIFFERENT password ending $, plus bypass kernel_db() entirely). Needs John's input first: which password is actually current on the live server? Once known: (a) confirm/rotate the real one, (b) delete the two hardcoded raw-PDO connections in temp_dashboard.php/view_ingest.php and have them use kernel_db() like the rest of the app. STATUS: PENDING — blocked on John confirming current live password.
WO-5: Auth-gate or delete setup.php. File: root setup.php. Still live, unauthenticated, can recreate a stray SQLite DB (legaisee.db) via POST. Since the real MySQL DB is already initialized and working, simplest fix is likely just deleting this file outright (John to confirm nothing still depends on visiting it). STATUS: PENDING.
PRIORITY 1 — real bugs breaking live features
WO-6: Fix the cli/worker.php crash (partial, high-value fix). File: engine/pipeline_adapters.php. Its require_once __DIR__ . '/cluster_engine.php' resolves to the empty (0-byte) engine/cluster_engine.php. A real, working clusterNodes($case_id) already exists in root-level cluster_engine.php — change the require to point there instead (__DIR__ . '/../cluster_engine.php'). This fixes 1 of the 3 undefined-function crashes in the worker. The other 2 (generateRecommendationsFromPath(), generateSystemInsights()) have no existing real implementation anywhere — those need either a new function written, or removing those calls from cli/worker.php/pipeline_adapters.php until a real implementation exists. Recommend doing the clusterNodes fix now (WO-6) and deciding on the other two as a separate, smaller follow-up work order once John says which of the two he actually wants working. STATUS: PENDING.
WO-7: Fix the tools/ + export_report.php bootstrap.php dependency. Files: all 7 files in tools/ (build_clusters.php, build_relations.php, name_clusters.php, build_cluster_summaries.php, build_cluster_summaries_ai.php, extract_cluster_insights.php, detect_cluster_opportunities.php) plus root export_report.php. All require_once __DIR__ . "/../bootstrap.php" (or root bootstrap.php directly), which is a dead 2-line deprecated stub — none of these currently work. Fix: swap that require for root db.php (require __DIR__.'/../db.php'; from tools/, or require __DIR__.'/db.php'; from export_report.php) — db.php is the real, working 4-line wrapper already used correctly elsewhere. STATUS: PENDING.
Still-undecided items (need John's call before a work order can be written — not yet actionable)
[DECIDED 8/26, not yet a WO] Brain/autonomous-agent family (5 rebuild attempts total) — macro decision made, see legaisee-current-state item 1: KEEP Group A (real DB logic) + the orchestrator/synthesis shape, BUILD a real model_router.php, DELETE the rest. Still needs its own execution work order(s) once Priority 0/1 are cleared — this is a build task, not a small fix.
[DECIDED 8/26, not yet a WO] Recommendation engine — DELETE kernel/ and engine/ dead versions (see legaisee-current-state item 3). Straightforward delete-only WO, can be written anytime.
[DECIDED 8/26, not yet a WO] ProjectManager/ — GO, finish it. First real step: fix TaskRepository.php's pm_tasks vs projects table-name mismatch, then write migrations 010-014. Needs its own WO.
[DECIDED 8/26, not yet a WO] plain_english_helper.php — RESTORE/INTEGRATE confirmed, matches John's plain-language use case exactly (turning node/connection counts into what it means for the business). Still needs a "where does it get wired in" call before this becomes a WO.
[DECIDED 8/26, partially] Naming-collision duplicate pairs — confirmed NOT exact copies (see legaisee-current-state item 9 for per-pair detail). cluster_engine.php (engine/ side) and dashboard.php/dossier_v2.php (root) are safe straightforward DELETE WOs. graph_view.php's orphaned views/ copy is MORE built out than the live one — needs a look before deleting, not a blind delete. view_module.php's orphaned copy is safe to delete. graph_engine.php/excavation_engine.php/semantic_engine.php collisions still unverified — don't assume disposition yet.
The 3+ "Files" implementations (files.php, api/files_action.php, modules/ file tools) and the sandbox-too-broad issue shared by the first two — needs a decision on which one is the intended long-term Files feature before writing a consolidation work order.
search_dual.php vs the other 4 already-known search/compare implementations — needs cross-check + a "which one wins" decision.
STILL TO DO
Write WO-8+ for the naming-collision cleanup batch once John gives the go-ahead to treat "confirmed zero callers" as sufficient grounds for deletion without asking file-by-file.
After Priority 0 + Priority 1 are cleared, revisit legaisee-recovery-roadmap's original Phase 2/3/4 plan and decide whether the remaining "still-undecided" items above get their own work orders one at a time, or a batched decision session.
Sequencing note: this REPLACES the original "triage everything together, then execute everything as one pass" plan from legaisee-recovery-roadmap — that plan assumed unlimited session length, which isn't the reality. Work orders below are still roughly grouped by priority, but each is independent and can be done in any order John wants, standalone.
LOCKED ARCHITECTURE RULE (John, 8/26): everything live in LEGAiSEE routes through shell.php → modules/ folder → the specific registered module file (kernel/module_registry.php). ANY root-level file that is its own standalone page (has its own HTML output, not just a required support library) and is NOT registered as a module or required directly by shell.php is dead by definition — no further live/dead investigation needed for those, just confirm it's genuinely a standalone page (not a library other live files depend on) and delete. Confirmed exception on record: prospect.php is root-level but is required directly by shell.php itself, so it's real/live despite living at root. Applying this rule closes out WO-2 (view_file.php) and the "second older parallel front-end shell" bonus lead below in one shot.
CORRECTION (8/26): the architecture rule above is real and John-confirmed, but it got over-applied — bundled 6 files into WO-8 as "dead" by rule alone without re-checking each file's own specific audit findings, several of which contradict a blind delete. Corrected below.
WO-8 (CONFIRMED via direct repo grep, 8/26): dashboard.php, dossier_v2.php, mission.php, saved_views.php — all four confirmed zero real callers anywhere in the actual codebase (mission.php's workspace_id concept confirmed unique to itself; both mission.php and saved_views.php's only dependency, components/nav.php, confirmed required by nothing live). All four safe delete, no further check needed. STATUS: PENDING.
HELD BACK from WO-8, confirmed via repo grep NOT safe to blind-delete: files.php — confirmed via grep to be the ONLY caller of indexer.php (the real live search-backing indexer) anywhere in the codebase; deleting files.php as-is would silently kill indexing. Needs a decision: give indexer.php a new live trigger point first, or confirm John doesn't need live indexing to keep working, before this file goes. search_dual.php — also zero callers confirmed, but stays an open "which search implementation wins" decision per earlier note, not a plain dead-file delete.




---

# C. Capability + Wiring Audits — Passes 4-10 (Business Plan)


<a id="doc-34"></a>
## 34. 005_LEGAiSEE OM_PART 5 — EXISTING COMMAND CENTER CAPABILITY AUDIT.md

*Source: `LEGAiSEE Busines Plan/005_LEGAiSEE OM_PART 5 — EXISTING COMMAND CENTER CAPABILITY AUDIT.md` · 30171 bytes · 606 lines · encoding normalized to UTF-8*

# PART 5 — EXISTING COMMAND CENTER CAPABILITY AUDIT

## 5.1 Purpose

This audit establishes what the existing LEGAiSEE Command Center contains, how its components are connected, and what must be verified before additional development begins.

The objective is not to redesign the system.

The objective is to establish a reliable baseline so that subsequent work builds on the existing implementation, repairs actual deficiencies, and avoids creating duplicate functionality.

The audit distinguishes six conditions:

| Classification | Meaning |
| --- | --- |
| Confirmed in code | The relevant implementation is visible in an inspected source file. |
| Functionally verified | A defined test demonstrated that the implementation works. |
| Present, unverified | The implementation exists, but its runtime behavior has not been demonstrated. |
| Incomplete or inconsistent | The code, routing, data model, or documentation indicates an unresolved issue. |
| Missing | The required capability could not be located in the inspected scope. |
| Security or operational concern | The implementation creates a risk that must be assessed or addressed. |

**Important:** A file's existence is not proof that a feature works. A documented feature is not proof that it has been implemented. A successful test in one environment is not proof that the production server behaves identically.

This document records a preliminary source-code audit, not a completed live-server or runtime audit.

## 5.2 Source-of-Truth Rules

The authoritative live-server copy remains the operational source of truth.

The GitHub repository is an inspection source. It helps establish the implementation and identify likely defects, but it does not independently establish that the live server contains the same files or that those files are operational.

Before any code change:

1. Identify the exact live-server file.
2. Inspect its current contents.
3. Determine whether the proposed change affects existing functionality.
4. Preserve a recoverable copy of the original.
5. Make the smallest change that addresses the verified problem.
6. Test the change against explicit acceptance criteria.
7. Record the result and the actual file changed.

Do not replace working server code merely because a repository version looks cleaner.

Do not introduce a second database, application shell, project-management system, or orchestration layer until the existing implementation has been examined.

The CAMERA project and its associated folders are outside this audit's scope.

## 5.3 Application Entry Point and Routing

### Finding A — `shell.php` exists as the central application shell

**Classification:** Confirmed in code; runtime behavior unverified.

The inspected `shell.php`:

* Loads `kernel/kernel_boot.php`.
* Loads shared utility and UI-rendering files.
* Loads the module registry.
* Reads the requested module from the `module` query parameter.
* Resolves the module against the registry.
* Includes the registered module file.
* Handles several possible module return formats.
* Provides a dashboard with grouped navigation cards.
* Includes early handling for report generation and vault downloads.

This is a meaningful application structure. LEGAiSEE is not simply a collection of unrelated PHP pages; it has a central entry point intended to coordinate modules.

### Finding B — Module rendering is implemented

The `renderModule()` function in `shell.php` checks whether the requested module is registered and whether its target file exists.

It then attempts to execute the module and render its output.

The renderer supports HTML output, strings, structured UI arrays, inspector-style results, and generic data arrays.

This provides a shared mechanism for displaying different kinds of modules.

**What remains unverified:**

* Whether every dashboard destination resolves correctly.
* Whether every registered module file exists on the live server.
* Whether all modules return data in formats the renderer handles correctly.
* Whether module errors are logged and presented appropriately.
* Whether permissions are enforced consistently.
* Whether every important action persists its changes correctly.

A central router is an established implementation component. A fully functional operating system has not yet been demonstrated.

## 5.4 Module Registry

### Finding C — A central module registry exists

**Classification:** Confirmed in code; route completeness unverified.

The inspected `kernel/module_registry.php` maps module names to PHP files.

The registry includes entries for:

* `dashboard`
* `intelligence_dashboard`
* `brain`
* `pm`
* `clients`
* `cases`
* `vault`
* `report`
* `payment`
* `excavation`
* `ingest`
* `files`
* `search`
* `graph`
* `relations`
* `semantic_cluster`
* `predictive`
* `recommendation`
* `dig_review`

Additional entries cover other system functions.

This means the existing application already has a substantial collection of named module destinations.

### Required verification

The next audit step is to compare three things:

1. Every module registered in `kernel/module_registry.php`.
2. Every module file actually present in the authoritative server copy.
3. Every module destination exposed through the `shell.php` interface.

The comparison must identify:

* Registered modules whose files are missing.
* Existing modules that are not registered.
* Dashboard links that do not resolve to registered modules.
* Modules with obsolete or duplicate implementations.
* Modules that load but fail during execution.
* Modules whose visible interfaces do not perform their advertised operations.

Do not rebuild the navigation until this comparison is complete.

## 5.5 Kernel and Database Bootstrap

### Finding D — A shared kernel bootstrap exists

**Classification:** Confirmed in code; runtime behavior unverified.

The inspected `kernel/kernel_boot.php` loads:

* `kernel/db.php`
* `kernel/kernel_paths.php`
* The UI bootstrap when its expected file exists
* The PHP session when one is not already active

It also attempts to initialize a global database connection using `kernel_db()`.

If initialization throws an exception, the inspected code assigns `null` to the global `$db` variable.

A runtime-validation helper checks whether the global database object is a PDO instance.

This shows an existing effort to centralize application initialization and support both newer database access patterns and older modules.

### Operational implications

A failed database connection must not be mistaken for a functioning application merely because the bootstrap continues executing.

The audit must establish:

* Whether database initialization succeeds on the live server.
* Whether the connection uses the intended MySQL database.
* Whether required tables and columns exist.
* Whether failures are logged.
* Whether modules fail safely when the database is unavailable.
* Whether legacy modules depend on global `$db` while newer code uses `kernel_db()`.
* Whether configuration files contain credentials or other sensitive information that should not be exposed.

No database migration or connection redesign should occur until these questions are answered.

## 5.6 Dashboard

### Finding E — A dashboard module exists

**Classification:** Confirmed in code; actual runtime output unverified.

The inspected `modules/dashboard_module.php` loads case and client records from JSON directories and returns a structured result containing totals.

Its current implementation is simple: it reports the number of cases and clients loaded through those JSON-directory functions.

The existence of a dashboard module therefore does not establish that it provides a comprehensive operational overview.

### Required verification

Determine whether the dashboard:

* Loads successfully through the central shell.
* Displays accurate case and client counts.
* Reflects the authoritative data sources.
* Handles empty directories and invalid JSON files.
* Distinguishes prospects from active clients.
* Reports useful operational status rather than only record totals.
* Links to working operational functions.

The dashboard should not be expanded until the underlying data-source questions are resolved.

## 5.7 Project Management

### Finding F — An existing project-management interface is implemented

**Classification:** Confirmed in code; database operations and runtime behavior unverified.

The inspected `modules/pm_module.php` describes itself as a single-page workspace with project navigation and list/board views.

The file:

* Uses `kernel_db()`.
* Defines task statuses, including Backlog, Architecting, Building, Review, Blocked, and Done.
* Defines a separate project lifecycle, including Intake, Approved, Planning, Active, On Hold, At Risk, Review, Completed, and Archived.
* Contains code for project creation.
* Generates unique URL-safe project slugs.
* Uses prepared statements for the inspected project-creation query.

This is an existing implementation, not merely a proposed feature.

### Required verification

The audit must test:

1. Project creation.
2. Project retrieval.
3. Project editing.
4. Project status changes.
5. Task creation and updates.
6. Task-to-project relationships.
7. List and board views.
8. Persistence after a reload.
9. Handling of missing or incompatible database tables.
10. Error handling and permission enforcement.

The code excerpt inspected is not sufficient to certify all ten behaviors.

**Decision:** Preserve the existing project-management module and verify it before considering replacement or substantial redesign.

## 5.8 Data Storage and Duplication

### Finding G — The system documentation identifies multiple storage mechanisms

**Classification:** Documented concern; actual data consistency requires verification.

The existing `SYSTEM_LEGEND.md` identifies possible duplication in several areas:

**Client records**

* JSON files under `data/clients/`.
* A MySQL `clients` table.
* Potential overlap with another client directory.

**Case records**

* Individual JSON files under `data/cases/`.
* A master `data/cases.json` file.
* Possible database representations.

**Entities and relationships**

* MySQL entity and relationship tables.
* JSON network files.
* Case-specific network files.

**Memory and analysis snapshots**

* A MySQL `memory_ingest` table.
* Files under `data/memory/`.
* Files under `data/brains/`.

**Graph information**

* Database records.
* Network JSON files.
* Case-specific graphs.
* A graph snapshot under the brains directory.

The documentation also identifies possible functional overlap between some modules and engines.

These observations are important, but the existence of multiple representations does not automatically mean that the system is broken. Some may be deliberate indexes, exports, snapshots, or caches.

### Required investigation

For each important business object, determine:

1. Where it is created.
2. Where it is stored.
3. Which component reads it.
4. Which component updates it.
5. Whether a second representation is synchronized.
6. Which representation wins when records disagree.
7. Whether deletion or archival propagates correctly.
8. Whether the information can be recovered after a failure.

The audit must not arbitrarily declare MySQL or JSON to be the authoritative source for every object.

That decision must be based on actual implementation and existing operating requirements.

### Decision

Do not consolidate storage until the write paths, read paths, dependencies, and existing records have been mapped.

## 5.9 Initial Operational Risk

### Finding H — Error display requires production review

**Classification:** Security and operational concern; exploitability not established.

The inspected `shell.php` explicitly enables full PHP error reporting and sets `display_errors` to `1`.

This may expose implementation details when errors occur.

The production configuration should be checked to establish whether errors are displayed to visitors, written to logs, or handled by the hosting environment.

The intended production behavior is to log diagnostic details privately while displaying a safe error message to the user.

This finding does not establish that sensitive information has actually been exposed. It identifies a configuration that warrants immediate verification.

### Additional security checks

The audit must also inspect:

* Authentication and authorization.
* Session configuration.
* CSRF protection on state-changing requests.
* Input validation.
* File-upload handling.
* Download authorization.
* SQL query safety.
* Sensitive configuration files.
* Access to backups, diagnostic scripts, and test utilities.
* Whether error messages expose paths, queries, or credentials.

These checks are prerequisites for accepting real client information or conducting real transactions.

## 5.10 Repository Documentation Integrity

### Finding I — The root README is not LEGAiSEE project documentation

**Classification:** Confirmed in repository.

The inspected root `README.md` contains documentation for Dompdf, an HTML-to-PDF library.

It does not serve as an accurate primary guide to the LEGAiSEE application.

The repository also contains `SYSTEM_LEGEND.md`, which provides a plain-English description of the codebase and records possible duplication areas.

### Required action

Do not rely on the root README to establish application architecture.

A future documentation repair should provide a concise, accurate entry point explaining:

* What LEGAiSEE currently does.
* How the application starts.
* How modules are routed.
* How the database is initialized.
* Where important data is stored.
* How to verify a deployment.
* Which capabilities are implemented versus planned.

This documentation repair should follow the implementation audit rather than precede it.

## 5.11 Minimum Audit Sequence

The remaining audit should follow this order.

### Stage 1 — Application integrity

* Inspect the complete kernel bootstrap.
* Inspect the module registry.
* Compare registered module files against the live-server inventory.
* Identify unresolved entry points and route mismatches.
* Verify the production error-handling configuration.

### Stage 2 — Data integrity

* Identify the actual database connection and schema.
* Map important tables and JSON stores.
* Trace client, prospect, case, project, task, artifact, and review records.
* Identify authoritative write paths.
* Identify synchronization and duplication risks.

### Stage 3 — Core workflow verification

Test the minimum operational sequence:

1. Create or retrieve a prospect.
2. Create or retrieve a client.
3. Create a project or case.
4. Add an artifact.
5. Record its processing or review status.
6. Retrieve the artifact and associated records.
7. Generate or retrieve the resulting analysis.
8. Produce a deliverable.
9. Verify that changes persist.
10. Confirm that access and permissions behave correctly.

Where a workflow step does not exist, record it as missing rather than inventing an implementation.

### Stage 4 — Operational readiness

* Verify backup coverage.
* Verify that a restore can be performed.
* Confirm error logging.
* Check sensitive configuration and file exposure.
* Verify the basic operational interface.
* Record defects and their impact.

### Stage 5 — Minimal remediation

Only after the audit should we decide which existing components require repair, which require completion, and which should remain untouched.

## 5.12 Acceptance Criteria

Part 5 is complete only when the audit can answer the following questions with evidence:

* Does the live application load?
* Does the module registry match the actual module files?
* Which core modules have been tested successfully?
* Which database and JSON stores are authoritative for each major record type?
* Can a prospect become a client and enter a project or case workflow?
* Can artifacts be ingested, retrieved, and reviewed?
* Can the resulting information be used to create a deliverable?
* Do state changes persist after reload?
* Are authentication and authorization adequate for the intended use?
* Can the system be backed up and restored?
* Which defects prevent safe operational use?
* What is the smallest repair sequence that makes the existing system usable?

Until these questions are answered, the correct status is **partially inventoried, not production-certified**.

The next action is to continue the source-code audit against the authoritative server copy, using the GitHub implementation to identify the files and workflows that require verification.

===========================================================

I’ve continued the audit, and your clarification changes how I’m interpreting the data architecture.

I’ll treat MySQL as the current data architecture and the older JSON-based records as presumed legacy—not as competing authoritative databases. However, I’ve found current code that still reads some of those JSON paths. That distinction matters: obsolete data files can remain harmless, but code that still depends on them can produce incomplete or inconsistent results.

I also uncovered an urgent security issue in the public repository that takes priority over the rest of the audit.

1. Urgent: Credentials exposed in the public repository

The publicly accessible repository contains:

config.local.php with database connection credentials. sftp.json with FTP connection credentials and the server's remote application path.

I inspected both files directly. The credentials are exposed in readable source, so they must be treated as compromised. I will not reproduce them here.

Recommended immediate actions Change the database password through the hosting control panel and update the live application's private configuration to match. Change the FTP password and update your local deployment configuration. Check hosting access logs for unfamiliar connections or changes. Remove credentials from the repository and add the relevant configuration files to .gitignore. Address the Git history as well. Removing a file from the latest commit does not remove credentials from earlier commits. Review the tracked legaisee.db file to determine whether it contains any data that should not have been publicly accessible. Its presence in the repository is confirmed, but I have not established its contents.

Changing the credentials comes first. Removing the files from GitHub without invalidating the exposed credentials is insufficient.

I have not attempted to use these credentials or access your server.

LEGAiSEE Operating Manual — Part 5, Continued 2. Revised data-architecture assessment

Your clarification establishes the historical context:

Earlier versions stored information such as client records and imported AI conversations in JSON files. The system has since moved to MySQL. Many JSON files that once served as database storage are probably obsolete.

That changes the working assumption for this audit.

Data area	What the repository currently shows	Audit interpretation Client records	The client module queries MySQL's clients table.	MySQL is the current implementation path in this module. Project records	The project-management module uses kernel_db() and SQL queries.	MySQL-backed implementation. Imported AI conversations	The ingest module inserts transcripts into memory_ingest.	MySQL-backed ingestion is implemented in source. Case records	The cases module reads JSON files under data/cases/.	Legacy dependency remains in the inspected code. Case analysis	Dig Review reads JSON files for insights, clusters, and graph nodes.	Legacy analysis files still feed part of the review interface. Uploaded files	The ingest module stores files on disk and records metadata in MySQL.	Hybrid file-storage/database design.

The first three findings come from the inspected client module, project-management module, and ingest module.

The important distinction

The evidence does not support a blanket conclusion that JSON is still an authoritative data store.

It does support a narrower conclusion:

Some current modules still read JSON files, so those code paths must be examined before the corresponding files can safely be considered irrelevant.

I will not recommend migrating all JSON into MySQL, recreating old records, or consolidating the two storage mechanisms simply because both exist.

The objective is to establish what the current system actually uses.

3. Ingestion and AI-memory audit

The inspected modules/ingest_module.php contains a substantial implementation for importing information.

Confirmed in source

The module supports two principal operations.

A. Paste an AI transcript

It accepts a transcript, session label, platform, project tag, domain, and optional project association. It then inserts the transcript into memory_ingest, including its word count and context.

B. Upload a file

It accepts an uploaded file, writes it to a storage directory, copies it into normalized/, and attempts to insert file metadata into the files table. If a case is selected, it also attempts to add a node to a case network.

The module also retrieves counts from the memory_ingest, files, and documents tables, and retrieves project and domain choices from MySQL.

Findings requiring repair or verification Finding	Assessment	Priority File metadata uses datetime('now') in an insert intended for MySQL.	SQLite-style syntax is present in a MySQL-oriented module. It is a likely compatibility defect and must be tested against the actual schema and database.	High File upload errors are swallowed in a database-operation catch block.	The interface can report successful upload even if the metadata insert or case-network operation fails.	High The module reads case metadata from JSON.	This is a legacy filesystem dependency that remains in the current source.	Medium The module duplicates uploaded files into normalized/.	The purpose and downstream consumers of the second copy need verification.	Medium Upload validation is limited in the inspected section.	File-size limits, allowed types, authorization, and path safety need review.	High

The timestamp concern is based on the actual SQL expression in the file; whether it fails in production depends on the live database and schema. The swallowed exceptions and success message are visible in the implementation.

One specific concern

The code chooses a case directory using the submitted case_id and checks whether that path exists. The inspected code does not visibly constrain the submitted identifier to a safe, known case ID before constructing the path.

That warrants a path-traversal review before the upload interface is trusted with untrusted users or files.

I have not attempted to exploit it.

4. Dig Review: The human-verification layer

The Dig Review module is especially important because it sits between machine-extracted information and information that the system may treat as accepted evidence.

The module supports review states including:

Pending Confirmed Rejected Needs more information

It creates or uses a MySQL review_flags table and supports status updates through POST requests. It can also queue unreviewed entities and relationships from MySQL.

This is meaningful existing functionality.

However, I found a significant architectural complication.

The review interface merges two different sources

The module:

Reads MySQL review flags. Reads case findings from JSON files. Combines the two collections for display.

The JSON-derived findings include insights, clusters, and network nodes. They do not necessarily have the same persistent review-record IDs as the MySQL flags.

The interface only renders the review action buttons when a finding has an id. JSON-derived findings without that ID are displayed as automatically loaded case patterns rather than receiving the same persistent review controls.

Why this matters

The screen can look like a unified review queue while actually presenting two different kinds of records:

MySQL records with persistent review status. Filesystem-derived findings that are loaded for display.

Those are not equivalent capabilities.

The current source does not establish that every finding displayed in Dig Review can be confirmed or rejected and have that decision persisted.

This should be a high-priority workflow test.

Recommended direction

Do not rewrite Dig Review yet.

First establish whether the live application still contains valid case-analysis information in those JSON directories. If the files are obsolete, determine whether their loading code is obsolete too. If some contain current information, identify the intended MySQL representation and migration requirements before removing the dependency.

The goal is one coherent evidence-review workflow—not preservation of legacy JSON merely because the code still references it.

5. Client and case management

The client module queries MySQL for the latest 20 client records, including name, industry, location, status, and client UID. That is consistent with the current MySQL architecture.

The cases module, by contrast, loads case and client data from JSON directories and builds its display from those records.

This means the current codebase has different storage assumptions in adjacent business-management modules.

That is a confirmed source-level inconsistency, but it is not yet proof of a live operational failure. The live deployment may have legacy files that remain in use, or the code may no longer be part of the actual operating workflow.

Required audit questions Does the live application create and maintain cases in MySQL? Does the case list module use the current case records? Is there a current client-to-case relationship in MySQL? Does the excavation workflow create cases through the same data model? Are the JSON-based case lists still used anywhere operationally? Can a case be opened, analyzed, reviewed, and connected to a client without relying on an obsolete record?

These questions should be resolved before modifying case management.

6. The Brain module is not a complete health check

The Brain module presents a system-status view with the registered module count, data-directory counts, and engine-availability indicators.

But its health indicator checks whether certain directories exist:

data/files data/clients data/cases data/memory

It reports the data layer as ready when those directories exist.

That is a filesystem-presence check, not a comprehensive operational health check.

A directory can exist even when:

The database is unavailable. The expected tables are missing. A module is broken. An ingestion operation fails. A record cannot be retrieved. The data in that directory is no longer authoritative.

This is a relatively straightforward future improvement, but it should follow the basic application and database audit. The first task is to determine which components actually work.

7. Revised findings register

Here is the current evidence-based register from the repository inspection.

ID	Finding	Classification	Priority SEC-01	Database credentials are exposed in a public tracked configuration file.	Confirmed security exposure	Immediate SEC-02	FTP credentials are exposed in a public tracked deployment file.	Confirmed security exposure	Immediate SEC-03	A SQLite database file is present in the public repository; its contents have not been inspected.	Potential data exposure	High DATA-01	Client and project modules use MySQL, while the case-list module reads JSON.	Confirmed code-path inconsistency	High ING-01	Transcript ingestion writes to memory_ingest.	Implemented in source; runtime unverified	High ING-02	File upload metadata uses SQLite-style timestamp syntax in a MySQL-oriented insert.	Likely compatibility defect	High ING-03	Some upload-processing errors are swallowed, while success may still be reported.	Confirmed error-handling weakness	High ING-04	Case selection feeds a filesystem path without an obvious identifier allowlist in the inspected code.	Security concern requiring review	High REV-01	Dig Review merges MySQL review flags with JSON-derived findings.	Confirmed mixed-source behavior	High REV-02	JSON-derived findings do not necessarily receive persistent review controls.	Confirmed behavior in inspected rendering logic	High SYS-01	Brain's data-layer readiness indicator checks directory existence.	Confirmed limitation	Medium DOC-01	Root README contains Dompdf documentation rather than a LEGAiSEE system overview.	Confirmed documentation defect	Low

These are source-level findings, not the results of live-server tests.

8. What I recommend doing next

The audit should proceed in this order:

Contain the exposed credentials. Rotate them before any further work on the public repository. Inspect the current database schema and migration files. Establish the actual tables and relationships used by the current application. Trace the current ingestion pipeline. Follow a transcript and an uploaded document from submission through persistence and retrieval. Trace the case workflow. Determine whether cases are now MySQL-backed and identify any remaining JSON dependencies. Test Dig Review. Verify that a finding can be reviewed, that the decision persists, and that the accepted evidence can be retrieved downstream. Audit the excavation and analysis path. Establish whether the current pipeline produces useful, retrievable evidence and relationships. Only then produce the minimum repair plan.

I will continue to treat the live server as authoritative and GitHub as the source-code inspection copy. I will not assume that every repository file is current, that every module works, or that legacy JSON files should be migrated or preserved.

The key conclusion so far: LEGAiSEE contains real MySQL-backed functionality for projects, clients, and AI-session ingestion, alongside code paths that still depend on legacy filesystem data. The next audit stage must establish whether those paths are still required and whether the core excavation-to-review workflow works end to end.


<a id="doc-35"></a>
## 35. 006_LEGAiSEE_PART 5B — EXISTING COMMAND CENTER CAPABILITY AUDIT v2.md

*Source: `LEGAiSEE Busines Plan/006_LEGAiSEE_PART 5B — EXISTING COMMAND CENTER CAPABILITY AUDIT v2.md` · 15042 bytes · 282 lines · encoding normalized to UTF-8*

# PART 5 — EXISTING COMMAND CENTER CAPABILITY AUDIT

## Pass 3: Review, Reporting, and Vault Integration

### 1. Scope

This pass examines the downstream evidence lifecycle:

1. Entity and relationship extraction.
2. Dig Review queue creation.
3. Human verification.
4. Retrieval of confirmed findings.
5. PDF report generation.
6. Report storage.
7. Report retrieval through the Vault.

The purpose is to determine whether these components are connected into a coherent workflow or merely coexist in the repository.

### 2. WIR-012 — Dig Review combines database records with filesystem-derived findings

**Classification:** Confirmed mixed-source behavior **Priority:** High

**Source:** `modules/dig_review_module.php`

The module loads two different collections of findings.

The first collection comes from case-analysis files under:

`data/clients/*/cases/*/`

It searches for:

* `meta.json`
* `insights.json`
* `clusters.json`
* `network.json`

The second collection comes from MySQL's `review_flags` table.

The module merges the collections for display.

This creates two distinct review paths:

| Finding type | Origin | Persistent review record |
| --- | --- | --- |
| Entity | MySQL `entities` table, after queueing | Yes, when successfully inserted into `review_flags` |
| Relationship | MySQL `relationships` table, after queueing | Yes, when successfully inserted into `review_flags` |
| Insight | Filesystem analysis output | Not created by the display-loading code |
| Cluster | Filesystem analysis output | Not created by the display-loading code |
| Network node | Filesystem graph output | Not created by the display-loading code |

The interface only presents the normal review-action buttons when a displayed finding has an `id`. Filesystem-derived findings do not receive a persistent review-flag ID from the loading process.

Consequently, those findings appear in the interface but cannot be confirmed or rejected through the normal persistent-review action.

**Wiring conclusion:** The review interface is connected to the MySQL entity and relationship review mechanism, but the filesystem-derived findings are not connected to the same review lifecycle.

**Disposition:** Preserve both loading paths until we establish which case-analysis files are still operational. Then determine whether those findings should be retired, migrated into a supported data model, or retained as a separate analytical-results view.

Do not assume every JSON file is obsolete merely because JSON was formerly used as database storage.

### 3. WIR-013 — The review queue does not automatically include every supported source type

**Classification:** Confirmed limitation in the queueing logic **Priority:** Medium–High

The `queue_unreviewed` operation selects entities and relationships that do not already have corresponding records in `review_flags`.

It does not perform equivalent queueing for the `documents` table, even though the rendering code contains logic to retrieve document titles and sources when a review flag references a document.

This suggests an incomplete or partially evolved review interface.

The code supports displaying document-backed review records if they exist, but the inspected queueing operation does not create those records.

**Wiring conclusion:** Document review is not connected to the same automatic queueing mechanism as entity and relationship review.

**Disposition:** Determine whether documents are supposed to be reviewed directly, whether only extracted findings should be reviewed, or whether document-level verification belongs to a separate stage.

Do not add document queueing until the intended review model is established.

### 4. WIR-014 — Relationship display uses fields inconsistent with the extractor's ID-based relationships

**Classification:** Confirmed source-level field mismatch **Priority:** High

The entity extraction engine writes relationship records using both name-based fields and ID-based fields:

* `from_entity`
* `to_entity`
* `from_entity_id`
* `to_entity_id`

In the inspected implementation, the first pair contains entity names and the second pair contains entity IDs.

Dig Review's relationship hydration query joins the `entities` table using the name-based fields:

`e1.id = r.from_entity`

`e2.id = r.to_entity`

That is inconsistent with the extractor's representation.

If the schema follows the extractor's insert statements, the review query should use the ID fields for those joins.

The relevant files are:

* `engine/entity_extraction_engine.php`
* `modules/dig_review_module.php`

**Wiring conclusion:** Relationship records may be created, but the current review interface may fail to resolve their endpoint names correctly.

This is a field-contract defect between two connected components, not proof that the relationship engine itself is unusable.

**Disposition:** Verify the live MySQL schema and existing records. Then correct the joins to match the established schema, if the mismatch is confirmed against the authoritative server.

### 5. WIR-015 — Confirmed findings are not yet demonstrated to be case-specific

**Classification:** Confirmed query-scope limitation **Priority:** High

The report module retrieves confirmed findings from `review_flags` using the selected client ID as its context filter.

It does not filter those findings by the selected case ID.

The module separately loads case and client records from MySQL, but those lookups do not constrain the confirmed-findings query.

As implemented, the report-generation path can therefore select all confirmed findings associated with a client context, rather than only findings belonging to the selected case.

This creates a risk that a report for one case could contain findings associated with another case for the same client.

There is an additional uncertainty: the review queue populates context from the entity or relationship record's `context` field. The inspected extraction engine accepts a `clientId` argument, but the shown entity and relationship insert statements do not establish a consistent case-level provenance relationship.

**Wiring conclusion:** The report module is connected to the review table, but the relationship between a finding, a client, and a specific case is not adequately established by the inspected queries.

**Disposition:** Before changing report generation, establish the canonical relationship among:

* Client.
* Case.
* Source artifact.
* Extracted entity or relationship.
* Review decision.

Then ensure the report query selects findings for the correct case and client, rather than relying on an ambiguous context string.

### 6. WIR-016 — The report generator produces a PDF but includes limited finding detail

**Classification:** Confirmed limitation in report assembly **Priority:** Medium–High

The report module:

1. Loads confirmed review records.
2. Loads case and client information from MySQL.
3. Generates HTML.
4. Renders the HTML through Dompdf.
5. Saves the resulting PDF.
6. Sends the PDF to the browser.

The generated report lists the source table, source record ID, and operator note for each confirmed finding.

The inspected report-generation function does not hydrate each finding into its substantive analytical content. For example, it does not resolve an entity ID to its canonical name or a relationship ID to its endpoint names and relationship type before building the report.

Consequently, the PDF-generation mechanism exists, but the resulting content is closer to an index of confirmed records than a complete evidence-based analytical report.

**Wiring conclusion:** The report generator is connected to the review table, but the transformation from approved records into meaningful client-facing evidence is incomplete.

**Disposition:** Preserve the PDF-generation infrastructure. First repair the finding-to-case relationship and determine the required report content. Then connect the report assembler to the correct evidence and analysis records.

### 7. WIR-017 — Case selection uses JSON while report metadata is loaded from MySQL

**Classification:** Confirmed mixed-source behavior **Priority:** High

The report module builds its case-selection dropdown by scanning:

`data/clients/*/cases/*/meta.json`

When the form is submitted, it retrieves the selected case and client from MySQL.

This creates a mixed-source path:

**Filesystem case metadata → selection form → MySQL case lookup → report generation**

The approach can work if the filesystem metadata and database records remain synchronized. The inspected code does not establish that synchronization.

A case could appear in the dropdown but not exist in MySQL, or its filesystem metadata could identify a different client than the corresponding database record.

The module also falls back to placeholder metadata when a case or client lookup returns no record, rather than stopping immediately when the requested records are absent.

**Wiring conclusion:** The report interface is not using one consistently verified source for case selection and case identity.

**Disposition:** Establish the current authoritative case store. Given the migration history you described, MySQL should be treated as the current architectural direction, but the actual live schema and existing workflow must be verified before retiring the JSON case-selection path.

### 8. WIR-018 — The Vault download link does not match the download handler

**Classification:** Confirmed request-parameter mismatch **Priority:** High

The Vault module scans the filesystem for PDF reports and displays a download link containing:

`action=download&report_id={filename}`

However, its download handler checks for:

`action=download&report_path={path}`

The handler requires `report_path`; the link supplies `report_id`.

Therefore, the download link does not satisfy the handler's request contract.

Even if a report exists and appears in the Vault, the displayed link does not provide the parameter that the handler expects.

**Wiring conclusion:** The report-listing and report-download components are not correctly connected through their request parameters.

**Disposition:** Repair the interface contract rather than replacing the Vault. Prefer a stable report identifier or a validated filename that the server resolves within the authorized report directory. Do not accept arbitrary filesystem paths from the browser.

### 9. WIR-019 — Report generation and Vault storage share a filesystem convention, but client identity remains file-based

**Classification:** Confirmed filesystem dependency; canonical identity unverified **Priority:** Medium–High

The report module saves generated PDFs under:

`data/clients/{client_id}/cases/{case_id}/reports/`

The Vault scans client directories and their nested case report directories for PDFs.

Those paths are consistent with each other.

However, the Vault derives the client display name from:

`data/clients/{client_id}/profile.json`

The report generator obtains the client name from MySQL.

This creates another legacy dependency: the report file may be stored under a database client ID, while the Vault's display name depends on a JSON profile.

If the profile is missing or obsolete, the Vault falls back to displaying the directory name.

**Wiring conclusion:** Report storage and report discovery are connected through a shared directory convention, but client identity and display metadata are sourced inconsistently.

**Disposition:** Do not change the directory structure yet. Establish whether the existing report files must remain where they are and whether the Vault should read client metadata from MySQL.

### 10. WIR-020 — The Vault's payment action assumes a case ID derived from the client ID

**Classification:** Confirmed identifier assumption; runtime impact unverified **Priority:** High before accepting transactions

The Vault's payment action constructs a case identifier by transforming the client ID string.

This is not a reliable client-to-case relationship. A client may have multiple cases, and identifiers need not follow a predictable naming pattern.

The payment request also carries a report filename and a user-entered email address.

The inspected JavaScript therefore relies on an assumed relationship between client ID and case ID instead of resolving the selected report to its actual case record.

**Wiring conclusion:** The report-to-payment connection does not establish a reliable case association.

**Disposition:** Do not use this flow for real client transactions until the payment module's server-side validation and identifier relationships have been verified. Any payment request should resolve the report, case, and client through authoritative records rather than infer identifiers from strings.

### 11. Consolidated findings

| ID | Finding | Classification | Priority |
| --- | --- | --- | --- |
| WIR-012 | Dig Review merges MySQL review flags with filesystem-derived findings. | Mixed-source behavior | High |
| WIR-013 | Automatic review queueing covers entities and relationships but not documents. | Incomplete queueing path | Medium–High |
| WIR-014 | Relationship display joins entity IDs against name-based relationship fields. | Field-contract mismatch | High |
| WIR-015 | Report selection is not used to constrain the confirmed-findings query by case. | Query-scope limitation | High |
| WIR-016 | PDF generation lists record identifiers and notes rather than fully resolved finding content. | Incomplete report assembly | Medium–High |
| WIR-017 | Case selection comes from JSON while report metadata comes from MySQL. | Mixed-source behavior | High |
| WIR-018 | Vault download links send `report_id`, while the handler requires `report_path`. | Confirmed request mismatch | High |
| WIR-019 | Report discovery depends on JSON client profiles even though report generation uses MySQL client records. | Mixed-source dependency | Medium–High |
| WIR-020 | Payment request construction derives a case ID from the client ID. | Identifier-contract concern | High before transactions |

### 12. Current assessment

The repository contains a substantial amount of the intended workflow:

* Entity and relationship extraction.
* Persistent review flags.
* Human confirmation and rejection.
* PDF generation.
* Report storage.
* Report discovery.
* Payment initiation.

However, the existence of these pieces does not establish an end-to-end operational workflow.

The current source contains specific breaks in the interfaces connecting them. These include a mismatch in relationship-field usage, ambiguous case-level provenance, inconsistent sources for case and client identity, and a mismatch between the Vault's download link and its handler.

The next step is to trace the canonical database relationships and inspect the payment module's server-side contract. That will establish which defects are local interface problems and which reflect a deeper disconnect in the current data model.


<a id="doc-36"></a>
## 36. 007_LEGAiSEE Wiring Audit-Pass 4.md

*Source: `LEGAiSEE Busines Plan/007_LEGAiSEE Wiring Audit-Pass 4.md` · 15993 bytes · 269 lines · encoding normalized to UTF-8*

## 1. Payment Module: Present, Registered, but Not Reliably Safe for Production

**Source:** `modules/payment_module.php` [Inspect payment module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/payment_module.php)

The payment module implements a recognizable Stripe Checkout flow:

1. Accept a client, case, report, email, and exhibit tier.
2. Determine the price from a hard-coded tier table.
3. Insert a pending payment into MySQL.
4. Create a Stripe Checkout Session.
5. Save the Stripe session ID.
6. Receive a webhook and mark the payment as paid.
7. Send payment notifications by email.

The module is also represented in the main `shell.php` navigation as the Payments module. This establishes a route to the module, but does not prove the entire transaction flow works.

### WIR-021 — Stripe webhook signature verification is disabled

**Severity: Critical before real payments**

The webhook handler contains the Stripe signature-verification call, but it is commented out. The code instead decodes the incoming JSON payload directly.

Consequently, the handler does not establish that a notification claiming a checkout succeeded actually came from Stripe.

The handler then looks up the payment by checkout-session ID and changes its status to `paid`.

**Impact:** If the endpoint is reachable and the required session ID is known or obtained, an unverified request could potentially trigger the paid-status path. The actual exploitability depends on deployment details, but the code does not provide the required authenticity check.

**Connection affected:** Stripe → payment module → MySQL payment record → email notifications.

### WIR-022 — Payment creation accepts client, case, and report identifiers without validating their relationship

The `create_checkout` handler accepts `client_id`, `case_id`, and `report_id` from the request. It checks that the fields are present and that the requested tier exists in the pricing table.

It does not visibly establish that:

* The client exists.
* The case exists.
* The case belongs to that client.
* The report exists.
* The report belongs to that case and client.
* The requester is authorized to initiate this transaction.

The code inserts the submitted identifiers into the `payments` table.

**Impact:** The payment record can be created without the application first establishing that its three principal references describe a valid, related business transaction.

This is a data-integrity and authorization concern. Whether MySQL rejects any particular invalid combination depends on the actual table constraints, which have not yet been verified.

### WIR-023 — The submitted client email is not persisted in the visible payment flow

The initial checkout handler accepts `client_email`, but the payment insert stores the client ID, case ID, report ID, amount, currency, status, and payment method. The submitted email is not included in that insert.

After payment, the notification function looks for the client's email and name in:

`data/clients/{client_id}/profile.json`

It does not use the email supplied to the initial checkout request.

**Impact:** The address entered during checkout and the address used for payment notification can differ. If the JSON profile is missing or has no email, the client notification is skipped.

This is another example of a mixed data model: transaction details are written to MySQL, while customer contact information is read from a filesystem JSON profile.

### WIR-024 — Payment confirmation can trigger duplicate notification work

When the webhook receives a `checkout.session.completed` event, it updates the matching payment to `paid` and calls `sendPaymentNotifications()`.

The visible handler does not first check whether that payment has already been processed. It also does not visibly record a Stripe event ID for deduplication.

Stripe webhook delivery can be retried. Therefore, duplicate deliveries could cause the notification function to run repeatedly.

**Impact:** A payment could produce duplicate emails or repeated notification side effects.

The `email_sent_client` and `email_sent_john` flags are updated after sending attempts, but the handler does not use those flags to prevent a repeat before sending.

### WIR-025 — Payment status is returned without visible authorization checks

The `status` action accepts a `payment_id`, retrieves the matching payment row, and returns the row in a JSON response.

No authentication or ownership check is visible in this handler.

**Impact:** If the endpoint is accessible without external access controls, someone who obtains a payment ID could retrieve payment details. The precise exposure depends on the surrounding authentication and server configuration, which this source inspection cannot establish.

A status endpoint should return only the fields the intended requester is permitted to see.

### WIR-026 — Checkout URLs use HTTP

Both checkout-creation paths construct their success URLs with:

`http://` + `$_SERVER['HTTP_HOST']`

The cancellation URL also uses HTTP.

**Impact:** This does not establish an HTTPS destination. If the site is intended to operate securely over HTTPS, the checkout URLs should be generated from a trusted, configured HTTPS base URL rather than relying on the incoming host header and hard-coded HTTP scheme.

This should be checked against the live deployment before any payment testing.

### WIR-027 — Failed checkout-session creation can leave pending payment records

The initial handler inserts a pending payment before attempting to create the Stripe Checkout Session.

If Stripe session creation fails, the exception handler returns an error but does not visibly remove or mark the pending payment record as failed.

That is not necessarily incorrect: retaining failed attempts can be useful for auditing. However, the system needs a defined policy for abandoned or failed attempts so that pending records are not mistaken for active checkout sessions.

The separate `create_checkout_from_pending` action can create another session for an existing pending payment. The visible code does not limit how often this can occur.

**Impact:** Multiple checkout attempts can be associated with a single pending payment unless another layer prevents them.

### WIR-028 — Payment tiers are hard-coded independently of the rest of the business model

The payment module defines eight prices, ranging from $500 to $250,000.

These values are used to determine the initial checkout amount. The module does not visibly retrieve tier definitions from a shared product, service, or pricing registry.

This is not automatically a defect: fixed prices can be intentional. The wiring question is whether these eight tiers are the authoritative commercial definitions used by the rest of LEGAiSEE.

If another module defines report tiers or pricing independently, the system risks divergent prices and terminology.

**Required verification:** Establish whether these eight tiers are the current intended product catalog or an older payment implementation.

---

## 2. Main Shell Integration

**Source:** `shell.php` [Inspect main shell](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/shell.php)

The main shell includes the payment module in its dashboard cards and sidebar. Its general module-rendering mechanism loads modules through the registry.

This establishes a visible navigation connection:

`Grand Lobby → Payments → payment module`

However, the payment module also handles JSON actions, Stripe callbacks, and webhook requests. Those functions are not the same as rendering the module's interface.

The source therefore demonstrates that the module is reachable through the shell, but not that every action is routed correctly, that authentication is consistently applied, or that Stripe can complete a real transaction.

The shell also has special early intercepts for report generation and vault downloads. No corresponding early payment intercept is visible in the inspected shell source. Payment actions appear to rely on the module's normal route.

**Audit conclusion:** Payment is integrated into the shell's navigation. End-to-end transaction integration remains unverified, with the webhook signature issue being the most important visible defect.

---

## 3. Database Relationship Map: What the Code Establishes

The current evidence supports the following partial map:

```text
CLIENT
  │
  ├── CASE
  │    │
  │    ├── FILES / ARTIFACTS
  │    │
  │    ├── ENTITY EXTRACTION
  │    │      ├── ENTITIES
  │    │      └── RELATIONSHIPS
  │    │
  │    ├── REVIEW FLAGS
  │    │
  │    └── REPORT PDF
  │
  ├── PROFILE JSON
  │
  └── PAYMENT
         ├── client_id
         ├── case_id
         ├── report_id
         ├── amount / currency / status
         ├── Stripe checkout-session ID
         └── Stripe payment-intent ID
```

This is a map of observed code-level relationships, not a verified database entity-relationship diagram. In particular, it does not establish which foreign keys exist or whether the database enforces these relationships.

### WIR-029 — Client and case information is split between MySQL and filesystem JSON

Several previously inspected modules use different sources for related information:

| Information | Observed source |
| --- | --- |
| Client and case lookups in report generation | MySQL `clients` and `cases` tables |
| Case discovery for report selection | Filesystem `meta.json` files |
| Client name and email for payment notifications | Filesystem `profile.json` |
| Payment transaction records | MySQL `payments` table |
| Review decisions | MySQL `review_flags` table |
| Several excavation and analysis findings | Filesystem JSON files |

The existence of two storage mechanisms is not itself a defect. JSON can legitimately hold artifacts, analysis outputs, cached views, or other structured files.

The concern is that some modules use JSON for information that other modules expect to retrieve from MySQL.

**Impact:** A client or case can potentially be visible to one module but missing or represented differently in another, depending on which store was updated.

**Important distinction:** We have not yet established that all JSON files are obsolete. The next audit step must distinguish legacy records from active file-based artifacts and outputs.

### WIR-030 — Entity and relationship records lack a consistently demonstrated case/artifact ownership chain

The entity-extraction engine accepts a client identifier, but the previously inspected insert paths do not visibly persist that identifier with the extracted entities and relationships. The artifact reference is used as an alias rather than establishing a clear foreign-key relationship to a canonical artifact record.

The engine creates entity relationships using both entity names and entity IDs. The Dig Review module, meanwhile, joins relationship endpoint columns as though they contain entity IDs.

That mismatch was documented in Pass 3 as WIR-014.

**Impact:** Even if entity extraction creates records successfully, downstream modules may not be able to reliably identify the originating client, case, or artifact—or resolve the relationship endpoints correctly.

This is a data-contract problem, not merely a missing user-interface feature.

### WIR-031 — The review queue and report-generation path are not yet proven to share a complete evidence chain

The Dig Review module queues entities and relationships for review. The report module subsequently selects confirmed review flags by client context, but the inspected query does not filter by the selected case.

The report then places the source table, source ID, and operator note into the PDF rather than visibly resolving each source into its underlying evidence.

Together, these behaviors leave gaps in the chain:

`Source artifact → extracted finding → review decision → case-specific report`

A record may be reviewable without being demonstrably tied to a specific source artifact, and a report may include confirmed findings without restricting them to the selected case.

**Impact:** A generated report may not reliably demonstrate which underlying evidence supports each conclusion or whether every finding belongs to the requested case.

This connects the earlier findings WIR-012 through WIR-017. These should be tracked together as an evidence-provenance and case-scoping problem.

---

## 4. What Is Established—and What Is Not

### Established by source inspection

* The payment module implements a Stripe Checkout flow.
* The payment module writes payment records to MySQL.
* The visible webhook path does not verify Stripe's signature.
* The visible payment handlers do not establish a complete client–case–report ownership check.
* Payment notification code reads client information from filesystem JSON.
* The entity-extraction and review modules have an identified relationship-column mismatch.
* Report generation and Vault use a mixture of MySQL records and filesystem discovery.
* The report query previously inspected does not scope confirmed findings by case.

### Not yet established

* The complete live MySQL schema, including foreign keys, indexes, and constraints.
* Whether authentication middleware or web-server rules protect payment endpoints.
* Whether the live server contains the same code as the public repository.
* Whether the Stripe account, webhook configuration, and production URLs are correctly configured.
* Which JSON files are still active system outputs and which are legacy records.
* Whether other modules provide validation or ownership checks not visible in the inspected paths.
* Whether actual payments, notifications, report downloads, and status checks succeed end to end.

These are open verification items, not confirmed failures.

---

## 5. Recommended Audit Order

Do not rebuild these modules yet. First establish the actual data model and the intended contracts.

1. **Inventory the database migrations and table definitions.** Establish the real columns, primary keys, foreign keys, and indexes for `clients`, `cases`, artifacts/documents, `entities`, `relationships`, `review_flags`, and `payments`.
2. **Trace client and case creation.** Identify which code creates canonical MySQL records and which code creates filesystem folders or JSON metadata.
3. **Trace artifact ownership.** Determine whether every ingested artifact can be traced to a canonical client, case, and source record.
4. **Trace entity and relationship persistence.** Establish the expected meaning of every relationship endpoint column and identify the canonical entity-extraction implementation.
5. **Trace review-to-report provenance.** Verify how a confirmed finding is linked to its source artifact and selected case.
6. **Trace the payment lifecycle.** Verify the payment schema, access controls, checkout creation, webhook verification, status reporting, and notification deduplication.
7. **Classify JSON files.** Mark each as active source data, active generated output, cache, migration residue, or confirmed legacy data only after examining its readers and writers.

### Pass 4 conclusion

The payment module is not simply missing: it has a recognizable checkout implementation and database writes. The main risks are in transaction verification, ownership validation, notification behavior, and consistency with the rest of the data model.

The broader issue is becoming clearer: LEGAiSEE has multiple components that perform meaningful work, but the contracts connecting their records are not consistently demonstrated. The next priority is to establish the canonical MySQL schema and trace the ownership of clients, cases, artifacts, extracted entities, reviews, reports, and payments before changing implementation.


<a id="doc-37"></a>
## 37. 008_LEGAiSEE Wiring Audit-Pass 5.md

*Source: `LEGAiSEE Busines Plan/008_LEGAiSEE Wiring Audit-Pass 5.md` · 14295 bytes · 276 lines · encoding normalized to UTF-8*

## 1. Cases Module Reads JSON Instead of MySQL

**Source:** `modules/cases_module.php` [Inspect Cases module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/cases_module.php)

The module loads its case and client collections using:

```php
$cases   = load_json_dir(__DIR__ . '/../data/cases');
$clients = load_json_dir(__DIR__ . '/../data/clients');
```

It then builds a client index from the JSON client records and associates each displayed case with a client through `client_id`.

The shared helper, `modules/utils/bootstrap.php`, scans a directory for `.json` files, decodes them, and returns the resulting arrays.

**Finding:** The registered Cases module's displayed case list is filesystem-driven. It does not query the MySQL `cases` or `clients` tables in the inspected implementation.

By contrast, the Clients module queries MySQL's `clients` table, and Client View queries MySQL for clients, cases, payments, and review flags.

Sources:

* [Cases module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/cases_module.php)
* [JSON-loading helper](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/utils/bootstrap.php)
* [Clients module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/clients_module.php)
* [Client View module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/client_view_module.php)

### WIR-032 — Cases and Clients use different data sources

**Severity: High integration concern**

The current code establishes two paths:

```text
Cases module
    └── data/cases/*.json
        └── data/clients/*.json

Clients module
    └── MySQL clients

Client View
    ├── MySQL clients
    ├── MySQL cases
    ├── MySQL payments
    └── MySQL review_flags
```

If the JSON files and MySQL tables are not kept synchronized, the Cases module can display a different collection of cases or clients from the rest of the system.

That is particularly relevant to your earlier point that JSON was previously used as a database and that the system later moved toward MySQL.

**What is established:** The Cases module reads JSON; the Clients module and Client View read MySQL.

**What is not established:** Whether the JSON files are obsolete, intentionally retained as a separate view, or still maintained by another process. That requires tracing the writers before deciding which source should be authoritative.

**Audit disposition:** Confirm the intended source of truth before changing the Cases module.

---

## 2. Client View Uses MySQL, but Selects Only One Case

**Source:** `modules/client_view_module.php` [Inspect Client View](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/client_view_module.php)

The client-view function queries the client by ID and then retrieves a single case:

```sql
SELECT *
FROM cases
WHERE client_id = ?
ORDER BY created_at DESC
LIMIT 1
```

It also retrieves all payments for that client, but its primary case context is the most recently created case.

### WIR-033 — Client View presents a multi-case client through a single-case context

The same function retrieves payment history by `client_id`, while its report lookup uses the selected case's ID to construct a filesystem path.

This creates an important distinction:

* Payment history is client-scoped.
* The selected case is whichever matching case is newest.
* The report lookup is scoped to that selected case.
* The confirmed findings query is scoped to client context, not visibly to the selected case.

**Impact:** If a client has multiple cases, the displayed case and report can represent one case while the findings shown in Client View may include confirmed review flags associated with the client more broadly.

This is consistent with the case-scoping problem previously identified in the report module.

It does not establish that every multi-case client currently has incorrect results. It establishes that the inspected query structure does not enforce a consistent case scope across those components.

---

## 3. Review Findings Are Resolved Through Relationship Columns With Inconsistent Semantics

Client View resolves relationship findings using:

```sql
LEFT JOIN entities e1 ON e1.id = r.from_entity
LEFT JOIN entities e2 ON e2.id = r.to_entity
```

The previously inspected entity-extraction engine writes entity names into `from_entity` and `to_entity`, while also storing separate ID fields named `from_entity_id` and `to_entity_id`.

Sources:

* [Client View module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/client_view_module.php)
* [Entity extraction engine](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/engine/entity_extraction_engine.php)

### WIR-034 — The relationship-column mismatch affects more than Dig Review

This extends the earlier WIR-014 finding.

The issue is not limited to one screen: both Dig Review and Client View use `from_entity` and `to_entity` as entity IDs in their joins, while the extraction code was observed writing entity names into those fields.

If that implementation is active in the live system, relationship labels can fail to resolve correctly.

**Required verification:** Inspect the actual MySQL `relationships` table definition and live records. Confirm the intended meaning and data type of each endpoint column before deciding whether the defect is in extraction, the consumer queries, or both.

---

## 4. Client View and Payment Module Are Connected, but the Initial Checkout Route Is Not Demonstrated as the Active Path

**Sources:**

* [Client View](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/client_view_module.php)
* [Payment module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/payment_module.php)

Client View displays pending payments and offers a **Generate Pay Link** button.

That button sends a POST request to:

`?module=payment&action=create_checkout_from_pending`

Its payload contains the existing payment ID and a client email entered through a prompt.

The payment module's corresponding handler retrieves the payment by ID, requires the payment status to be `pending`, and creates a new Stripe Checkout Session using the amount and currency already stored in that payment record.

### WIR-035 — The visible payment interface uses the pending-payment route

This establishes a direct connection:

```text
Client View
    └── Generate Pay Link
          └── create_checkout_from_pending
                ├── Read pending MySQL payment
                ├── Create Stripe Checkout Session
                └── Update stored session ID
```

The initial `create_checkout` handler is a separate path that creates a new payment record and a Checkout Session. The inspected Client View button does not call that handler.

**Impact:** The initial checkout handler may be intended for another caller, but its use by the visible Client View interface has not been demonstrated.

This is not proof that the initial route is orphaned. It is an unresolved integration question: identify every caller before classifying that route as active or unused.

### WIR-036 — The pay-link interface asks for an email, but the payment handler does not use it to select the notification recipient

Client View prompts the operator to enter an email address and sends it to `create_checkout_from_pending`.

The payment module validates that the email is present, but the visible handler does not persist it in the payment record or pass it into the Stripe Checkout Session's customer-email field.

The webhook notification function instead reads the client's email from:

`data/clients/{client_id}/profile.json`

**Impact:** The operator-entered email does not control the notification destination in the inspected flow. The profile JSON remains the source used for the client receipt.

This reinforces WIR-023 from Pass 4 and the broader finding that client contact data is split between MySQL and filesystem JSON.

---

## 5. The Database Schema Is Still Unverified

The next step originally called for inspecting database migrations and table definitions. I attempted to locate likely schema files, including common migration and schema paths, but those guessed paths returned no file. That does **not** establish that the repository contains no schema definitions or migrations.

The source files inspected so far demonstrate queries against these tables:

| Table | Observed use |
| --- | --- |
| `clients` | Client listing and client lookup |
| `cases` | Case lookup by client and recent-case selection |
| `payments` | Payment history, checkout, and payment status |
| `review_flags` | Confirmed findings |
| `entities` | Entity lookup and relationship resolution |
| `relationships` | Relationship lookup |
| `processing_queue` | Pending next action for a case |

The source code tells us which columns some modules expect, but it does not prove the complete schema, foreign keys, indexes, or constraints.

### WIR-037 — Application code assumes a schema whose complete definition has not been established

This is an **audit gap**, not a confirmed schema defect.

Until the table definitions are found, we cannot reliably determine whether:

* `cases.client_id` is a foreign key to `clients.id`.
* Payment references are constrained to valid clients and cases.
* Relationship endpoint columns store names or IDs in the live database.
* IDs use compatible types across tables.
* Foreign-key constraints prevent orphan records.
* Multiple modules are creating or modifying the same table differently.

The schema should be established from the actual database or its authoritative migration files—not reconstructed from assumptions.

---

## 6. Updated Ownership Map

Based on the code inspected to date, the system has the following observed structure:

```text
                         ┌─────────────────────────┐
                         │       MySQL             │
                         │                         │
                         │ clients                 │
                         │ cases                   │
                         │ payments                │
                         │ review_flags            │
                         │ entities                │
                         │ relationships            │
                         │ processing_queue        │
                         └────────────┬────────────┘
                                      │
                  ┌───────────────────┼────────────────────┐
                  │                   │                    │
                  ▼                   ▼                    ▼
             Clients module     Client View          Payment module
                                      │                    │
                                      │                    └── Stripe
                                      │
                                      ├── Report lookup
                                      │   through filesystem
                                      │
                                      └── Confirmed findings
                                          from review_flags

                         ┌─────────────────────────┐
                         │     Filesystem JSON     │
                         │                         │
                         │ data/cases/*.json       │
                         │ data/clients/*.json     │
                         │ profile.json files     │
                         │ case analysis outputs  │
                         └────────────┬────────────┘
                                      │
                                      ▼
                                Cases module
```

This diagram represents the observed access paths. It is not a claim that the two stores are completely disconnected or that every JSON file is legacy data.

---

## 7. Pass 5 Findings Summary

| ID | Finding | Severity / status |
| --- | --- | --- |
| WIR-032 | Cases module reads JSON while Clients and Client View read MySQL | High integration concern; authority unresolved |
| WIR-033 | Client View selects one case but loads confirmed findings by client context | Case-scoping defect pattern; confirm intended behavior |
| WIR-034 | Relationship endpoint semantics conflict across extraction and display queries | High; verify against live schema and records |
| WIR-035 | Visible pay-link button uses the pending-payment checkout route | Integration established; initial route caller unresolved |
| WIR-036 | Entered checkout email is not used by the visible notification path | Confirmed source-level mismatch |
| WIR-037 | Complete schema and constraints remain unverified | Audit gap |

### Pass 5 conclusion

The evidence now supports a more specific description of the integration problem:

1. **Client and case information has competing storage paths.** The registered Cases module reads JSON, while other major modules read MySQL.
2. **Case scope is not consistently propagated.** Client View selects a single case but loads confirmed findings using client context.
3. **Entity relationships have an unresolved data contract.** Extraction and display code disagree about the meaning of relationship endpoint columns.
4. **Payment functionality has multiple entry points.** The visible pay-link interface uses the existing-pending-payment route; the initial checkout route's active caller remains unknown.

The correct next move is not to convert every JSON file to MySQL or rewrite the affected modules. First, establish which records are canonical, trace all writers, and inspect the actual schema. Then the audit can distinguish legacy code from active functionality and identify the smallest changes needed to reconnect the system.


<a id="doc-38"></a>
## 38. 010_LEGAiSEE Wiring Audit-Pass 6.md

*Source: `LEGAiSEE Busines Plan/010_LEGAiSEE Wiring Audit-Pass 6.md` · 11631 bytes · 256 lines · encoding normalized to UTF-8*

## 1. File Ingestion and Excavation Use Different Case Directories

### Ingestion module

**Source:** `modules/ingest_module.php` [Inspect ingestion module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/ingest_module.php)

When a user uploads a file and selects a case, the module checks for:

`data/cases/{case_id}/`

It then stores the uploaded file under:

`data/cases/{case_id}/files/`

The module also copies the file to `normalized/` and inserts its metadata into the MySQL `files` table. It subsequently calls the ingestion pipeline with the case ID and a network file path under the same `data/cases/{case_id}/` directory.

### Excavation module

**Source:** `modules/excavation_module.php` [Inspect excavation module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/excavation_module.php)

The excavation module scans a different structure:

`data/clients/{client_id}/cases/{case_id}/files/`

It looks for artifacts in that client-specific directory and passes their contents to the entity-extraction engine.

### WIR-038 — Ingestion writes files where excavation does not look for them

**Severity: High integration concern**

The two modules expect different paths:

| Operation | Expected or written path |
| --- | --- |
| Ingestion upload | `data/cases/{case_id}/files/` |
| Ingestion network | `data/cases/{case_id}/network.json` |
| Excavation file discovery | `data/clients/{client_id}/cases/{case_id}/files/` |
| Excavation metadata discovery | `data/clients/{client_id}/artifacts/metadata/` |

The ingestion module's case selector also obtains its cases from `data/cases/*/meta.json`, whereas excavation scans client-specific directories.

**Impact:** A file uploaded through the ingestion interface is not automatically available to excavation through the path excavation scans. The two modules can operate independently without sharing the same artifacts.

This is a direct source-level mismatch. It does not prove that the live server has no separate copying or synchronization process.

**Audit disposition:** Trace all writers and readers for both directory structures before choosing a canonical layout. Do not simply move files or rewrite paths yet.

---

## 2. Excavation Generates Case Files in a Location the Cases Module Does Not Read

The excavation module groups artifacts into signal clusters and generates synthetic executive cases with IDs such as:

`auto_case_ops_delay_{timestamp}`

Its persistence loop writes those generated cases to:

`data/clients/{client_id}/cases/{generated_case_id}.json`

The Cases module, however, loads JSON files directly from:

`data/cases/`

It does not recursively scan the client-specific case directories in the inspected implementation.

Sources:

* [Excavation module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/excavation_module.php)
* [Cases module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/cases_module.php)

### WIR-039 — Generated executive cases are written outside the Cases module's discovery path

**Severity: High integration concern**

The excavation module generates case records in a client-specific directory, while the Cases module discovers case records from a separate root directory.

Consequently, the Cases module will not discover those generated files through its current `load_json_dir()` call.

There is an additional structural difference: the excavation module writes files named after generated case IDs directly into the client-specific `cases` directory. The ingestion and excavation readers, by contrast, expect case directories containing files or metadata.

**Impact:** The system has multiple concepts of a case:

1. A case directory under `data/cases/{case_id}/`.
2. A case directory under `data/clients/{client_id}/cases/{case_id}/`.
3. A generated executive-case JSON file under `data/clients/{client_id}/cases/{generated_case_id}.json`.
4. A MySQL case record referenced by Client View.

Those may represent distinct intended objects, but the current source does not demonstrate a consistent contract connecting them.

**Audit disposition:** Determine whether generated executive cases are supposed to become canonical client cases, remain analytical outputs, or be stored as evidence attached to an existing case.

---

## 3. The Excavation Module Is Both a Reader and a Writer

The excavation module does more than analyze existing files.

It:

1. Scans client-specific case directories for files.
2. Reads file contents.
3. Calls entity extraction.
4. Scans artifact metadata JSON files.
5. Identifies simple text signals.
6. Groups artifacts into clusters.
7. Generates executive-case records.
8. Writes generated JSON into client-specific directories.

This makes the module a data producer, not merely a report view.

### WIR-040 — Generated cases are not visibly registered in MySQL

The generated executive-case persistence loop writes JSON files. The inspected loop does not insert those generated cases into the MySQL `cases` table.

Client View queries MySQL for the client's most recent case. The Cases module discovers JSON files from `data/cases/`.

**Impact:** An executive case generated by excavation is not automatically established as a canonical MySQL case, nor is it automatically visible to the Cases module through its current root-directory scan.

That may be intentional if generated cases are analytical outputs rather than client case records. The distinction must be explicit in the data model.

**Required decision:** Define whether a generated analytical case is:

* A real case record;
* An analytical finding attached to an existing case; or
* A standalone JSON output awaiting operator review.

The code should not be changed until that distinction is established.

---

## 4. File Upload Records and Physical Files Are Separate Representations

The ingestion module saves a physical file, creates a normalized copy, and inserts a row into MySQL's `files` table containing fields such as filename, filepath, file type, size, context, and case ID.

It also reads the file into a variable named `$content`, but the subsequent call to `ingestToNode()` passes a filename-based note and network path rather than the contents variable.

**Source:** [Ingestion module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/ingest_module.php)

### WIR-041 — Uploading a file does not establish that its contents reach the node-ingestion step

The inspected call is effectively:

`ingestToNode(case_id, "File uploaded: filename", network_file)`

The module reads the uploaded file contents but does not pass that string to the function.

**Impact:** The file can be saved and its metadata recorded without the node-ingestion call receiving the document text through that argument.

This does not establish that the document is never processed elsewhere. It establishes that this particular ingestion call does not pass the contents it just read.

That distinction matters because successful upload, successful metadata insertion, successful node creation, and successful extraction of document content are four different outcomes.

---

## 5. Database Compatibility: A Second Concern in File Ingestion

The ingestion module inserts a row into MySQL's `files` table using:

`datetime('now')`

The previously inspected entity-extraction engine uses the same SQLite-style expression in inserts for entities, aliases, and relationships.

Sources:

* [Ingestion module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/ingest_module.php)
* [Entity extraction engine](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/engine/entity_extraction_engine.php)

### WIR-042 — SQLite-style timestamp expressions appear in MySQL-oriented insert paths

**Severity: Potential execution defect; requires runtime verification**

The application obtains its database connection through `kernel_db()`, which is intended to provide the shared PDO connection. The affected modules execute SQL containing `datetime('now')`.

That expression is characteristic of SQLite syntax. Its behavior is not equivalent to using MySQL's normal timestamp expressions in every context.

**Impact:** These inserts may fail on the live MySQL connection, depending on the exact statement and server configuration.

The ingestion module catches and suppresses exceptions around its file metadata insertion and node-ingestion call. It can therefore report that the physical upload succeeded even if the database or network-ingestion work failed.

**Audit disposition:** Verify these statements against the actual MySQL version and schema. Do not infer successful database writes from the upload success message alone.

---

## 6. The Current Case Lifecycle Is Not a Single Demonstrated Path

Combining the preceding findings gives this observed flow:

```text
INGESTION UI
    │
    ├── Reads case choices from:
    │   data/cases/*/meta.json
    │
    ├── Saves uploaded file to:
    │   data/cases/{case_id}/files/
    │
    ├── Copies file to normalized/
    │
    ├── Attempts MySQL files insert
    │
    └── Calls node-ingestion function
             │
             └── data/cases/{case_id}/network.json

EXCAVATION MODULE
    │
    ├── Reads:
    │   data/clients/{client_id}/cases/*/files/
    │
    ├── Reads:
    │   data/clients/{client_id}/artifacts/metadata/*.json
    │
    ├── Runs entity extraction
    │
    ├── Groups simple text signals
    │
    └── Writes generated executive cases:
        data/clients/{client_id}/cases/{generated_case_id}.json

CASES MODULE
    │
    └── Reads JSON files directly from:
        data/cases/

CLIENT VIEW
    │
    ├── Reads clients and cases from MySQL
    ├── Reads payments from MySQL
    ├── Reads confirmed review flags from MySQL
    └── Locates reports in client-specific filesystem paths
```

This is not a claim that every branch is broken. It is a map of the separate paths established by the inspected source.

---

## 7. Updated Findings

| ID | Finding | Status |
| --- | --- | --- |
| WIR-038 | Ingestion and excavation use different case-file paths | Confirmed source-level mismatch |
| WIR-039 | Generated executive cases are outside the Cases module's discovery path | Confirmed source-level mismatch |
| WIR-040 | Generated executive cases are not visibly inserted into MySQL `cases` | Confirmed for the inspected persistence loop |
| WIR-041 | File contents are read but not passed to the visible node-ingestion call | Confirmed source-level omission |
| WIR-042 | SQLite-style timestamp expressions appear in MySQL-oriented inserts | Potential runtime defect; test required |

### Pass 6 conclusion

The evidence now points to three distinct integration boundaries:

1. **Storage boundary:** Different modules expect files in different directory structures.
2. **Record boundary:** Generated analytical cases are not visibly registered as canonical MySQL cases.
3. **Processing boundary:** A successful file upload does not establish that the file contents reached node ingestion or entity extraction.

These are more actionable than a general finding that the system is incomplete. They identify where data can stop moving between components.

The next step is to trace the ingestion pipeline, network readers, and canonical case-creation paths. That will show whether a second process connects these paths or whether the current implementation leaves them isolated.


<a id="doc-39"></a>
## 39. 011_LEGAiSEE Wiring Audit-Pass 7.md

*Source: `LEGAiSEE Busines Plan/011_LEGAiSEE Wiring Audit-Pass 7.md` · 13458 bytes · 280 lines · encoding normalized to UTF-8*

## 1. The File-Ingestion Pipeline Creates Nodes, Not Extracted Document Intelligence

**Sources:**

* `modules/ingest_module.php`
* `kernel/ingestion_pipeline.php`

[Inspect ingestion module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/ingest_module.php) · [Inspect ingestion pipeline](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/kernel/ingestion_pipeline.php)

The upload handler performs these steps:

1. Receives the uploaded file.
2. Saves it to the filesystem.
3. Copies it into `normalized/`.
4. Attempts to insert file metadata into MySQL.
5. Reads the uploaded file into `$content`.
6. Calls `ingestToNode()` with a filename-based message and a network-file path.

The pipeline function then creates a node containing:

* A generated node ID.
* The case ID.
* A classification.
* The supplied text.
* A heuristic strength score.
* A small set of keyword tags.
* A creation timestamp.

It appends that node to a JSON network file.

### WIR-043 — The upload pipeline indexes a filename message, not the uploaded document's contents

The upload module reads the file into `$content`, but calls:

`ingestToNode($case_id, "File uploaded: {$safe_name}", $network_file)`

The pipeline classifies and scores the text passed to it. It does not independently open or parse the uploaded document.

**Impact:** This pipeline creates a node representing the fact that a file was uploaded. It does not, through this call, create nodes from the file's actual content.

The file may be processed by another module later, but that is a separate operation and must be traced independently.

**Classification:** Confirmed source-level disconnect between the uploaded document's contents and this node-ingestion call.

---

## 2. The Pipeline's Network Output Is Not the Network the Predictive Engine Reads

### Upload pipeline writes here

`data/cases/{case_id}/network.json`

### Portfolio Engine reads here

`data/clients/{client_id}/cases/{case_directory}/network.json`

**Source:** `engine/portfolio_engine.php` [Inspect Portfolio Engine](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/engine/portfolio_engine.php)

The Portfolio Engine loops through the client directories, enters each client's `cases/` directory, and looks for a `network.json` inside each immediate child directory.

It then decodes those files and aggregates their `nodes` arrays.

The Predictive Intelligence Engine calls `loadAllCases()` to retrieve the networks it analyzes.

**Source:** `engine/predictive_intelligence_engine.php` [Inspect Predictive Intelligence Engine](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/engine/predictive_intelligence_engine.php)

### WIR-044 — The visible upload path does not feed the portfolio network loader

The ingestion module writes its network under `data/cases/`. The portfolio loader searches under `data/clients/`.

The inspected loader does not search the upload module's root-level case directories.

**Impact:** Nodes created through the visible upload pipeline are not automatically included in the predictive engine's portfolio aggregation through the loader shown here.

This is a direct path mismatch in the source.

It does not establish that no other code copies, migrates, or aggregates these files. No such bridge has been demonstrated in the inspected path.

**Classification:** Confirmed source-level disconnect; check for an external synchronization process before remediation.

---

## 3. The Portfolio Engine's Case Discovery Is Also Structurally Narrow

The Portfolio Engine uses this sequence:

```text
data/clients/
    client/
        cases/
            case_directory/
                network.json
```

It examines each immediate child of `cases/` and checks for a `network.json` inside it.

The excavation module, as previously inspected, writes generated executive-case JSON files directly into the client-specific `cases/` directory rather than creating a case directory containing a network file.

### WIR-045 — Generated executive-case JSON is not consumed as a portfolio network by the visible loader

The Portfolio Engine looks for `network.json`, not arbitrary JSON files representing cases.

A file such as:

`data/clients/{client_id}/cases/{generated_case_id}.json`

does not satisfy that discovery pattern.

**Impact:** The executive-case records generated by excavation are not automatically ingested into the Portfolio Engine by the code inspected here.

The generated case may be an analytical output rather than a network input, so this is not necessarily a defect. The missing piece is the documented or implemented transition from that output to a network that the portfolio engine can consume.

**Classification:** Confirmed mismatch between the generated output format and the portfolio loader's input format.

---

## 4. The Predictive Engine Depends on Networks That May Not Be Produced by the Main Upload Path

The Predictive Intelligence Engine:

1. Calls `loadAllCases()`.
2. Collects each loaded network's nodes.
3. Calls the semantic clustering engine.
4. Counts the resulting signal categories.
5. Applies simple threshold-based forecasting rules.
6. Writes `data/portfolio/predictive_insights.json`.

The engine therefore depends on the Portfolio Engine successfully discovering and decoding network files.

### WIR-046 — Predictive output can be generated without evidence that the main ingestion path supplied its inputs

The predictive engine includes a fallback that generates a stable-portfolio forecast when no dominant patterns are found.

If the loader returns no usable networks—or if the resulting signal distribution contains no dominant categories—the engine can still write a forecast JSON file.

**Impact:** The existence of `predictive_insights.json` does not, by itself, prove that the engine processed the intended case data.

This is particularly important when validating the system. A generated output file can indicate that the engine ran, but not that the expected artifacts reached it.

**Classification:** Confirmed behavior in the inspected predictive code. Whether the resulting output is misleading depends on how the UI presents it and whether input coverage is reported elsewhere.

**Required distinction:** Track processing success separately from data coverage. The system should be able to establish which cases and nodes actually contributed to a forecast.

---

## 5. Pasted AI Transcripts Follow a Separate Processing Path

The ingestion module has a second function: storing pasted AI transcripts.

It inserts the text into MySQL's `memory_ingest` table, along with the session label, project tag, platform, optional domain and project IDs, word count, context, and creation timestamp.

The visible transcript-submission handler does not enqueue the transcript into `processing_queue` or insert it into `raw_data`.

**Source:** [Ingestion module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/ingest_module.php)

Meanwhile, `ai_process.php` reads a pending job from `processing_queue`, retrieves the latest corresponding record from `raw_data`, constructs an AI prompt, calls `process_ai()`, and inserts the result into `tasks`.

**Source:** [AI processing script](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/ai_process.php)

### WIR-047 — Stored transcripts are not visibly connected to the AI processing queue

The two paths are:

```text
PASTE AI TRANSCRIPT
    └── memory_ingest
          └── No queue connection shown in this handler

AI PROCESSING
    └── processing_queue
          └── raw_data
                └── process_ai()
                      └── tasks
```

**Impact:** Saving an AI transcript does not, through the inspected handler, cause the transcript to enter the processing flow used by `ai_process.php`.

This may be intentional. `memory_ingest` could be an archive for later retrieval, while `raw_data` and `processing_queue` serve a separate case-analysis workflow.

The audit cannot yet establish that these tables are supposed to share a pipeline.

**Classification:** Confirmed absence of a connection in the inspected path; intended relationship remains unresolved.

**Required verification:** Determine whether archived transcripts are intended to be searchable reference material, active knowledge-ingestion inputs, or both. Do not merge these flows until that design decision is clear.

---

## 6. The AI Processing Script Uses a Different Input Contract From File Ingestion

The AI processing script assembles its prompt from three fields in `raw_data`:

* `website_history`
* `reviews`
* `social`

It selects the most recent matching record for the queued case, passes the concatenated text to `getPrompt()`, and calls `process_ai()`.

The file-upload pipeline, by contrast, creates a node from a short filename-based message and saves that node to JSON.

### WIR-048 — The two processing paths have different inputs, outputs, and ownership mechanisms

| Property | File/node ingestion | `ai_process.php` |
| --- | --- | --- |
| Input | Uploaded-file event message | Selected `raw_data` fields |
| Trigger | Upload handler | Pending `processing_queue` job |
| Primary output | Node in `network.json` | Row in `tasks` |
| Input storage | Physical file and MySQL `files` metadata | MySQL `raw_data` |
| Completion tracking | No queue status shown | Queue status changed to `done` |
| Connection to other path | Not demonstrated | Not demonstrated |

These are distinct processing systems.

**Impact:** A successful file upload does not establish that the AI processing queue ran, and a completed AI-processing job does not establish that its output was added to the network consumed by the portfolio engine.

**Classification:** Confirmed architectural separation in the inspected code; whether the separation is intentional remains unresolved.

---

## 7. Network Integrity Is Not Established by the Current Pipeline

The ingestion pipeline checks whether the network file exists. If it does not, it creates a basic JSON object with empty `nodes` and `edges` arrays.

It then decodes the file, appends the new node to `nodes`, and writes the result back.

The inspected code does not visibly verify that:

* JSON decoding succeeded.
* The decoded value is an array.
* `nodes` exists and is an array.
* The file was written successfully.
* Another request did not concurrently modify the same file.

### WIR-049 — Network writes do not visibly validate the existing network structure

If an existing network file contains malformed JSON or has an unexpected structure, the append operation may fail or produce an error rather than preserving a valid network.

The function also writes the updated file without a visible file-locking mechanism.

**Impact:** The pipeline does not establish that every attempted node insertion results in a valid, complete network file.

This is a robustness concern rather than evidence that corruption has occurred.

**Classification:** Confirmed missing validation in the inspected function; actual occurrence and severity require runtime testing.

---

## 8. Consolidated Findings

| ID | Finding | Status |
| --- | --- | --- |
| WIR-043 | File-upload node represents a filename event rather than the document contents | Confirmed source-level disconnect |
| WIR-044 | Upload network path differs from Portfolio Engine's discovery path | Confirmed source-level disconnect |
| WIR-045 | Generated executive-case JSON does not match the Portfolio Engine's network-file discovery pattern | Confirmed format mismatch |
| WIR-046 | Predictive output can be generated without establishing that intended inputs were processed | Confirmed behavior |
| WIR-047 | Stored AI transcripts are not visibly connected to `ai_process.php`'s queue | Connection unresolved |
| WIR-048 | File/node ingestion and queued AI processing have separate input/output contracts | Confirmed architectural separation |
| WIR-049 | Network writes lack visible structure validation and concurrency protection | Confirmed robustness gap |

---

## 9. Pass 7 Conclusion

The current repository contains several distinct data-processing paths:

1. **File ingestion:** Saves files, stores metadata, and creates lightweight network nodes.
2. **Excavation:** Reads client-specific files and metadata, extracts entities, and generates analytical outputs.
3. **Portfolio intelligence:** Loads client-specific network files, aggregates nodes, and generates predictive insights.
4. **AI transcript storage:** Saves pasted transcripts to `memory_ingest`.
5. **Queued AI processing:** Reads `processing_queue` and `raw_data`, calls the AI layer, and writes to `tasks`.

The main issue is not that these components are absent. It is that the inspected source does not establish a complete, consistent path connecting their inputs and outputs.

The highest-priority questions are now:

* Which ingestion path is intended to be canonical?
* Where should the authoritative case network live?
* How should uploaded document contents become evidence nodes and extracted entities?
* Are AI transcripts archival memory, active processing inputs, or both?
* How should the system distinguish a successful engine run from successful processing of the intended evidence?

These questions should be answered before combining the pipelines or changing their storage locations.


<a id="doc-40"></a>
## 40. 012_LEGAiSEE Wiring Audit-Pass 8.md

*Source: `LEGAiSEE Busines Plan/012_LEGAiSEE Wiring Audit-Pass 8.md` · 13803 bytes · 317 lines · encoding normalized to UTF-8*

## 1. The Module Registry Confirms That the Main System Exposes Multiple Intelligence Components

**Source:** `kernel/module_registry.php` [Inspect module registry](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/kernel/module_registry.php)

The registry maps module names to PHP files. It includes entries for:

* `predictive`
* `semantic_cluster`
* `cross_case_engine`
* `graph`
* `entity_resolution`
* `excavation`
* `ingest`
* `dig_review`
* `report`
* `payment`

The shell loads the registry and uses it to resolve ordinary module requests. The dashboard also presents these modules as separate navigation destinations.

**Source:** [Main shell](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/shell.php)

### WIR-050 — Registry membership proves route registration, not operational integration

A registered module can be reachable through the shell without being connected to the rest of the intelligence pipeline.

For example, the registry contains both `predictive` and `semantic_cluster`, but those names alone do not establish that the predictive module consumes the output of the semantic-clustering engine.

Similarly, the `graph` module is registered, but registration does not establish that its database queries can resolve the relationship records produced by extraction.

**Impact:** Module counts and navigation availability are insufficient indicators of system readiness.

**Classification:** Confirmed architectural distinction. This is not a defect in the registry itself; it is a limitation of what registration tells us.

---

## 2. Two Predictive Implementations Use Different Data Sources

### Implementation A: Registered Predictive module

**Source:** `modules/predictive_module.php` [Inspect Predictive module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/predictive_module.php)

This module loads JSON case records from:

`data/cases/`

It reads each case's `analysis.patterns` array, calculates pattern-transition counts and probabilities, and returns:

* Pattern transition probabilities.
* Case-level predictions.
* Global predicted patterns.

It does not use the `loadAllCases()` function from the Portfolio Engine in the inspected implementation.

### Implementation B: Portfolio-level Predictive Intelligence Engine

**Source:** `engine/predictive_intelligence_engine.php` [Inspect Predictive Intelligence Engine](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/engine/predictive_intelligence_engine.php)

This engine calls `loadAllCases()`, which searches for network files under:

`data/clients/{client_id}/cases/{case_directory}/network.json`

It aggregates network nodes, clusters them, calculates signal distributions, and writes:

`data/portfolio/predictive_insights.json`

### WIR-051 — Two predictive systems operate on different representations of a case

| Property | Registered Predictive module | Portfolio Predictive engine |
| --- | --- | --- |
| Main input | JSON case records | JSON network files |
| Input root | `data/cases/` | `data/clients/` |
| Required data | `analysis.patterns` | `nodes` |
| Processing | Pattern-transition probabilities | Keyword-based signal classification and thresholds |
| Output | Module response | `predictive_insights.json` |
| Registered as `predictive` | Yes | No separate registry entry shown for the engine itself |

Both implementations may be useful. They analyze different representations of the data and do not necessarily need to be merged.

The integration problem is that the inspected code does not establish a shared input contract or a relationship between their outputs.

**Impact:** A case may be available to one predictive implementation but absent from the other.

**Classification:** Confirmed competing implementations; whether they are intentionally separate remains unresolved.

**Required decision:** Determine which predictive functions are current product capabilities and which are experiments, earlier versions, or specialized subsystems.

Do not delete either implementation solely because they overlap.

---

## 3. The Registered Predictive Module Does Not Consume the Portfolio Engine's Output

The registered Predictive module calculates its predictions directly from the case JSON collection it loads.

The portfolio engine writes a separate output file, `data/portfolio/predictive_insights.json`.

The inspected Predictive module does not read that output file.

### WIR-052 — The two predictive outputs are not visibly integrated

The source establishes two separate paths:

```text
data/cases/*.json
        │
        ▼
modules/predictive_module.php
        │
        ▼
Pattern transition results
```

And:

```text
data/clients/*/cases/*/network.json
        │
        ▼
Portfolio Engine
        │
        ▼
Predictive Intelligence Engine
        │
        ▼
data/portfolio/predictive_insights.json
```

No connection between these output paths has been demonstrated in the inspected modules.

**Impact:** A successful run of one predictive implementation does not establish that the other has run or consumed the same evidence.

**Classification:** Confirmed separation of the inspected paths. Whether another dashboard or script combines the outputs remains to be checked.

---

## 4. The Semantic-Clustering Module and Engine Are Also Separate Implementations

**Sources:**

* `modules/semantic_cluster_module.php`
* `engine/semantic_cluster_engine.php`

[Inspect semantic-clustering engine](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/engine/semantic_cluster_engine.php)

The engine exposes:

`buildSemanticClusters($nodes)`

It classifies nodes into groups using keyword matching. The inspected categories include audience performance, risk signals, growth signals, and unclassified nodes.

The previously inspected module contains a separate clustering implementation.

### WIR-053 — The registered clustering module and engine are not demonstrated as one shared implementation

The Portfolio Predictive Engine explicitly includes and calls the engine implementation.

The existence of a separate registered semantic-clustering module means the shell exposes another clustering path.

**Impact:** Changes to one implementation do not necessarily change the behavior of the other.

This is a maintenance and consistency concern if both are intended to provide the same analytical function. It may be acceptable if one serves interactive case-level analysis and the other performs portfolio-level classification.

**Required verification:** Compare the module's inputs, outputs, and intended purpose with the engine's contract before designating either as canonical.

---

## 5. The Graph Module Uses a Different Relationship Access Pattern

**Source:** `modules/graph_module.php` [Inspect Graph module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/graph_module.php)

The Graph module queries MySQL's `entities` and `relationships` tables.

It locates the starting entity by `canonical_name`, obtains its ID, and traverses relationship records.

The neighbor lookup queries:

`relationships.from_entity = ?`

using the current entity ID. It then resolves `to_entity` by searching `entities.canonical_name`.

The previously inspected entity-extraction engine, however, writes entity names to `from_entity` and `to_entity` while separately storing `from_entity_id` and `to_entity_id`.

### WIR-054 — Graph traversal has the same endpoint-semantics conflict found in review

If the inspected extraction implementation is the writer for the live relationship table, the Graph module's neighbor lookup will compare an entity ID against a column containing entity names.

That would prevent the query from reliably finding the intended outgoing relationships.

This is related to WIR-014 and WIR-034, but it affects a separate consumer: graph traversal.

**Impact:** Even if relationships exist in MySQL, the Graph module may not traverse them correctly.

**Classification:** Confirmed inconsistency between the inspected writer and reader implementations. Actual live impact depends on the deployed schema, existing records, and whether another writer populates these columns differently.

**Required verification:** Establish one authoritative relationship contract and check every writer and reader against it.

---

## 6. The Brain Module Reports File and Directory Presence, Not Engine Functionality

**Source:** `modules/brain_module.php` [Inspect Brain module](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/brain_module.php)

The Brain module:

* Loads the module registry.
* Counts registered modules.
* Lists the registered module names.
* Checks whether certain data directories exist.
* Checks whether several engine files exist.
* Reports a `data_layer_ready` result based on directory existence.

Its source explicitly describes it as an inspection-only component.

### WIR-055 — Brain's health indicator does not verify that the intelligence pipeline works

The module can report that the data layer is ready when the required directories exist.

It does not, through the inspected checks, establish that:

* MySQL connections succeed.
* Cases can be loaded from the intended source.
* Uploaded files become evidence nodes.
* Network JSON is valid.
* Entity extraction completes.
* Relationships can be traversed.
* Reports contain case-specific evidence.
* Predictive outputs reflect the expected inputs.

**Impact:** The Brain module is useful for inspecting the system's structure, but its readiness status should not be interpreted as end-to-end operational validation.

**Classification:** Confirmed limitation of the implemented checks, not a failure of the inspection module's stated purpose.

---

## 7. The Ingest View Is Connected to Memory Storage, Not the Entire Memory-Processing Lifecycle

**Source:** `modules/ingest_view_module.php` [Inspect Ingest View](https://github.com/carrmultimedia-arch/LEGAiSEE_Repo/blob/main/modules/ingest_view_module.php)

The module queries `memory_ingest` and displays recent entries with their session labels, platforms, and timestamps.

This confirms that the system has a reader for the transcript-storage path identified in Pass 7.

It does not show that the view initiates AI processing or that entries are transformed into entities, network nodes, or searchable knowledge.

### WIR-056 — Memory storage has a visible listing interface, but its downstream transformation remains unproven

The path demonstrated by these modules is:

```text
Transcript submission
        │
        ▼
memory_ingest
        │
        ▼
Ingest View
        │
        ▼
Recent stored transcript entries
```

The separate `ai_process.php` path uses `processing_queue` and `raw_data`.

No bridge between these paths has been demonstrated in the inspected code.

**Impact:** The interface can confirm that a transcript was stored, but the listing itself does not establish that the transcript became part of the system's analytical knowledge.

This may be an intentional archival workflow. The unresolved question is whether archived transcripts are supposed to feed the Business Archaeology evidence pipeline.

---

## 8. Updated Findings

| ID | Finding | Status |
| --- | --- | --- |
| WIR-050 | Module registration does not establish operational integration | Confirmed architectural distinction |
| WIR-051 | Two predictive implementations use different inputs and outputs | Confirmed competing implementations |
| WIR-052 | Predictive output paths are not visibly connected | Confirmed separation in inspected code |
| WIR-053 | Registered semantic-clustering module and engine are separate implementations | Confirmed; intended division unresolved |
| WIR-054 | Graph traversal's relationship-column assumptions conflict with the inspected extraction writer | Confirmed source inconsistency |
| WIR-055 | Brain's readiness indicator checks presence rather than end-to-end functionality | Confirmed limitation |
| WIR-056 | Transcript listing is connected to memory storage, but downstream processing is not demonstrated | Connection unresolved |

---

## 9. Pass 8 Conclusion

This pass establishes three distinct classes of integration concern.

### A. Competing implementations

The registered Predictive module and Portfolio Predictive Engine are separate analytical paths. The registered Semantic Cluster module and clustering engine are also separate implementations.

The correct response is not automatically to consolidate them. First determine whether they serve different purposes or represent design drift.

### B. Data-contract inconsistencies

The Graph module's relationship lookup conflicts with the relationship-column semantics observed in entity extraction.

This is more consequential than duplicated code because it can prevent an existing database record from being consumed correctly.

### C. Health indicators that do not validate processing

The Brain module confirms the presence of registered modules and expected directories. It does not validate the entire path from evidence ingestion to intelligence output.

The system therefore needs a clear distinction between:

* Component exists.
* Component is reachable.
* Component executed.
* Component processed the intended input.
* Component produced a valid, traceable result.

These are different states and should not be conflated.

### Overall audit direction

Continue tracing actual callers and data contracts. Preserve components until their roles are understood. The next priority is to determine which analytical modules are actively invoked, which are only registered, and whether any scheduled or API-driven entry points connect the apparently separate paths.


<a id="doc-41"></a>
## 41. 013_LEGAiSEE Wiring Audit-Pass 9.md

*Source: `LEGAiSEE Busines Plan/013_LEGAiSEE Wiring Audit-Pass 9.md` · 10528 bytes · 196 lines · encoding normalized to UTF-8*

# LEGAiSEE Wiring Audit

## Pass 9 — API Entry Points, Ingestion Callers, and Background Processing

**Scope:** Trace visible entry points into ingestion and AI processing, determine what actually connects, and identify unresolved execution paths.

**Inspection source:** Public LEGAiSEE repository. **Limitation:** No live-server execution, database inspection, cron inspection, or production logs were available for this pass.

---

## 1. Findings at a Glance

This pass establishes four important distinctions:

1. **File upload is connected to a node-writing function**, but the function receives a filename-based description rather than the uploaded document's contents.
2. **Pasted AI transcripts are stored in `memory_ingest`**, while `ai_process.php` reads from different tables. No connection between those paths is demonstrated in the inspected code.
3. **The background processor has an incomplete visible dependency chain.** It requires `api/prompts.php` and calls `process_ai()`, but the referenced prompt file could not be retrieved at the expected path in the public repository, and the processor itself does not define `process_ai()`.
4. **An API or background-processing component cannot be classified as obsolete merely because its caller has not yet been found.** Its external callers, scheduled execution, and live-server counterpart remain unresolved.

---

## 2. WIR-057 — AI Processor References a Prompt File Not Found at the Expected Public Path

**Severity:** High — execution dependency unresolved **Status:** Source-level discrepancy; live status unknown

The public `ai_process.php` begins with:

* `require_once __DIR__ . '/kernel/db.php'`
* `require_once __DIR__ . '/api/prompts.php'`

The processor then calls `getPrompt($task, $input)`.

The expected `api/prompts.php` path could not be retrieved from the inspected public repository. This does not prove the file is missing from the live server, but it means the public source snapshot does not presently let us verify the dependency.

**Why it matters:** If the file is absent from the deployed location, the processor cannot reach its prompt-building stage.

**Next verification:** Check whether `api/prompts.php` exists on the live server and whether its deployed version defines `getPrompt()`.

Source: [ai_process.php — public repository](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/ai_process.php?utm_source=chatgpt.com)

---

## 3. WIR-058 — The AI Processor Calls an AI Function Whose Implementation Is Not Established

**Severity:** High — execution dependency unresolved **Status:** Unresolved

After assembling its input and obtaining a prompt, `ai_process.php` calls:

`process_ai($prompt)`

The file includes the database layer and the prompt file, but does not itself define `process_ai()`.

Its inline comment says that the AI layer should already exist. That comment is not evidence that the implementation is present, loaded, or operational.

**What we can establish:**

* The processor expects an AI execution function.
* The implementation is not present in the processor itself.
* The inspected file does not establish which component provides the function.

**What remains unknown:**

* Whether another included file defines it.
* Whether a bootstrap or global include is expected to provide it.
* Whether the live deployment has a dependency absent from the public snapshot.

**Next verification:** Locate the actual `process_ai()` definition and trace how it is loaded before this call.

---

## 4. WIR-059 — The Background Processor Has No Visible Connection to Pasted AI Transcripts

**Severity:** High — pipeline disconnect **Status:** No connection demonstrated in inspected code

The ingest module stores pasted transcripts in `memory_ingest`. It records the transcript text, word count, platform, project tag, and optional domain and project identifiers.

The separate `ai_process.php` processor follows a different route:

1. Select one pending row from `processing_queue`.
2. Read the corresponding case identifier.
3. Retrieve the latest matching record from `raw_data`.
4. Assemble input from `website_history`, `reviews`, and `social`.
5. Build a prompt.
6. Call `process_ai()`.
7. Store the result in `tasks`.
8. Mark the queue row as done.

The inspected processor does not read from `memory_ingest`, and the inspected transcript-storage handler does not enqueue a job for `ai_process.php`.

**Conclusion:** These are two distinct data paths in the source examined. A bridge may exist elsewhere, but it has not been demonstrated.

**Next verification:** Search for every writer to `processing_queue` and `raw_data`, then determine whether any of them consume `memory_ingest` records.

Sources:

* [Ingest module](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/modules/ingest_module.php?utm_source=chatgpt.com)
* [AI processor](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/ai_process.php?utm_source=chatgpt.com)

---

## 5. WIR-060 — Background Execution Is Not Established

**Severity:** High — operational path unknown **Status:** Unresolved

`ai_process.php` contains code to process a single pending queue item. The file does not establish how it is launched.

The inspected source does not show whether it is run through:

* A scheduled task or cron job.
* An HTTP request.
* A manual administrative action.
* Another PHP process or application component.

The file also selects a pending item without visibly claiming it atomically before processing. If multiple instances execute concurrently, they could potentially select the same pending job. Whether that occurs in practice depends on the actual execution environment.

The processor also has no visible surrounding error-handling workflow for failures during prompt creation, AI execution, or task storage.

**Important distinction:** A processor file existing is not proof that background processing is running. Conversely, failure to find its scheduler in the files examined is not proof that no scheduler exists.

**Next verification:** Inspect the live hosting control panel for scheduled tasks and identify any HTTP or application callers of `ai_process.php`. Then verify how a job is claimed, retried, and marked failed.

---

## 6. WIR-061 — The File-Upload Path Writes a Node, but Not a Document-Content Node

**Severity:** High — evidence-ingestion limitation **Status:** Confirmed in inspected source

The upload handler reads the uploaded file into `$content`, but calls:

`ingestToNode($case_id, "File uploaded: {$safe_name}", $network_file)`

The `$content` variable is not passed to that function.

The ingestion pipeline stores the supplied text in a node's `content` field and derives its basic type, strength, and tags from that text. Because the supplied text is the upload notice, the resulting node describes the upload event rather than the actual document.

**Implication for Business Archaeology:** The upload path establishes that a file was uploaded and records a filename-based node. It does not, by itself, demonstrate extraction of the file's substantive evidence into the node network.

This finding reinforces WIR-006 and WIR-041; it is not a new, independent defect.

Sources:

* [Upload handler](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/modules/ingest_module.php?utm_source=chatgpt.com)
* [Ingestion pipeline](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/kernel/ingestion_pipeline.php?utm_source=chatgpt.com)

---

## 7. WIR-062 — The Ingestion Pipeline Writes to a File Network, Not the Entity/Relationship Database Graph

**Severity:** High — integration boundary unresolved **Status:** Separate storage paths confirmed; downstream bridge not demonstrated

`ingestToNode()` loads a JSON network file, appends a node to its `nodes` array, and writes the JSON file back. It does not itself insert an entity or relationship into the MySQL graph tables.

Other inspected modules, including semantic clustering and graph traversal, query MySQL `entities` and `relationships`.

That creates two distinct structures:

| Structure | Visible responsibility |
| --- | --- |
| Case `network.json` | Stores nodes produced by the file-ingestion pipeline |
| MySQL `entities` and `relationships` | Stores entities and graph relationships used by graph-oriented modules |

A conversion or synchronization process could connect these structures, but the inspected ingestion function does not do so.

**Conclusion:** Do not treat a successful file upload or node write as proof that the MySQL entity graph has been populated.

**Next verification:** Locate every caller of the entity-extraction engine and determine whether it reads `network.json`, the original uploaded file, or another source—and whether it writes records with the IDs and ownership fields expected by graph consumers.

Sources:

* [Ingestion pipeline](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/kernel/ingestion_pipeline.php?utm_source=chatgpt.com)
* [Semantic-cluster module](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/modules/semantic_cluster_module.php?utm_source=chatgpt.com)

---

## 8. What This Pass Does—and Does Not—Establish

### Established in the inspected source

* The upload handler calls `ingestToNode()`.
* The ingestion pipeline appends nodes to a JSON network.
* The transcript handler stores transcripts in `memory_ingest`.
* `ai_process.php` uses `processing_queue`, `raw_data`, and `tasks`.
* The processor depends on `getPrompt()` and `process_ai()`.
* The inspected upload and transcript handlers do not visibly connect their inputs to the AI processor's queue.

### Still unverified

* Whether the live server contains a different or additional prompt file.
* Where `process_ai()` is defined and loaded.
* Which components create `raw_data` and `processing_queue` records.
* Whether a scheduled task or external caller launches `ai_process.php`.
* Whether any process synchronizes JSON network nodes with MySQL entities and relationships.
* Whether other API endpoints or legacy scripts provide missing connections.

### Audit discipline

These findings identify **unproven connections**, not a blanket conclusion that the corresponding components are unused. The next pass should trace the missing callers and writers before any component is classified as dead code or recommended for replacement.


<a id="doc-42"></a>
## 42. 014_LEGAiSEE Wiring Audit-Pass 10.md

*Source: `LEGAiSEE Busines Plan/014_LEGAiSEE Wiring Audit-Pass 10.md` · 13813 bytes · 229 lines · encoding normalized to UTF-8*

# LEGAiSEE Wiring Audit

## Pass 10 — Database Writers and Entity-Extraction Callers

**Scope:** Trace the visible callers of entity extraction and compare their database writes with the consumers that read the resulting records.

**Inspection source:** Public repository source files. **Limitation:** This is not a live-server test. The findings below apply to the inspected source and must be checked against the deployed files before making production changes.

---

## 1. Findings at a Glance

This pass clarifies five issues:

1. The entity-extraction engine has two documented callers: `modules/excavation_module.php` and `prospect.php`.
2. The prospect workflow is a standalone PHP entry point. The excavation module's normal route remains questionable because `shell.php` previously showed a special-case interception for `module=excavation`.
3. Entity and relationship records are stored globally in the inspected engine; the write operations do not persist the supplied client identifier as an ownership field.
4. The graph consumer's traversal query conflicts with the relationship writer's use of `from_entity` and `from_entity_id`.
5. The prospect workflow, file-ingestion workflow, and AI queue processor remain separate processing paths. No complete end-to-end pipeline connecting all three has been established.

---

## 2. WIR-063 — Entity Extraction Has Two Identified Callers, but One Has a Route Problem

**Severity:** High — execution path uncertainty **Status:** Callers identified; normal excavation route remains unresolved

The entity-extraction engine's own header identifies two callers:

* `modules/excavation_module.php`
* `prospect.php`

The excavation module includes the engine and calls `lee_extract_and_store()` while scanning files under client case directories and legacy artifact metadata.

The standalone `prospect.php` entry point also includes the engine and calls `lee_extract_and_store()` on submitted prospect text.

However, the earlier shell audit found that `shell.php` intercepts `module=excavation` and renders a different interface rather than normally dispatching to the registered excavation module.

**Implication:** The existence of the excavation module and its extraction call does not prove that the normal shell navigation executes that code.

The prospect workflow is a separate, identifiable entry point. Its actual availability and behavior on the live server have not been tested.

Sources:

* [Entity extraction engine](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/engine/entity_extraction_engine.php)
* [Excavation module](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/modules/excavation_module.php)
* [Standalone prospect entry point](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/prospect.php)

---

## 3. WIR-064 — Entity Extraction Writes Global Entities, Not Explicitly Client-Owned Entities

**Severity:** High — data ownership and isolation **Status:** Confirmed in inspected insert statements

The extraction function accepts a `$clientId` parameter, but its entity upsert writes these fields:

* `entity_type`
* `canonical_name`
* `normalized_hash`
* `confidence`
* `created_at`

The relationship upsert writes:

* `from_entity`
* `to_entity`
* `relation_type`
* `strength`
* `source_context`
* `from_entity_id`
* `to_entity_id`
* `created_at`

Neither insert persists the supplied client identifier.

Entity deduplication uses a hash of the normalized entity name. Consequently, the inspected implementation can return the same entity record for the same normalized name across separate clients.

That may be intentional if LEGAiSEE is building a shared, cross-client intelligence graph. But the source does not establish an explicit ownership or authorization model that distinguishes shared entities from client-specific evidence.

**Important distinction:** A globally shared entity is not inherently a defect. The unresolved issue is whether the application intentionally shares the entity itself, the supporting evidence, the relationships, or all three—and whether access is controlled accordingly.

**Next verification:** Inspect the deployed schema and graph access rules. Determine how evidence provenance, client ownership, case ownership, and access permissions are represented.

Source: [Entity extraction engine](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/engine/entity_extraction_engine.php)

---

## 4. WIR-065 — Relationship Storage and Graph Traversal Still Disagree About the Source Field

**Severity:** High — graph traversal may fail **Status:** Mismatch confirmed in inspected source

The relationship writer stores the source entity's name in `from_entity` and its numeric ID in `from_entity_id`.

The graph module then queries:

`WHERE from_entity = ?`

The parameter supplied to that query is the numeric entity ID.

The graph module later resolves `to_entity` by looking up its value as a canonical entity name. That second step aligns with the extraction writer, which stores the destination entity's name in `to_entity`.

The source side does not align.

**Expected consequence if these files are deployed together with the same schema:** The graph traversal may fail to find relationships because it searches the name field using a numeric ID.

The separate `from_entity_id` and `to_entity_id` columns already exist in the writer's insert statement, so the mismatch is not caused by the extraction engine failing to generate entity IDs. It is a disagreement about which column the consumer should use.

This reinforces WIR-014 and WIR-054. It should be treated as one continuing integration issue, not three unrelated defects.

Sources:

* [Entity extraction engine](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/engine/entity_extraction_engine.php)
* [Graph module](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/modules/graph_module.php)

---

## 5. WIR-066 — The Extraction Engine Uses a MySQL-Incompatible Timestamp Expression

**Severity:** High — potential runtime failure **Status:** Confirmed expression; runtime failure not tested

The entity and alias insert statements use:

`datetime('now')`

The same expression appears in the relationship insert.

The rest of the inspected database layer uses PDO with a MySQL-oriented schema and SQL syntax. In MySQL, the SQLite-style `datetime('now')` expression is not the normal equivalent of a current timestamp and can be interpreted as an invalid function call.

**Implication:** Entity extraction may fail when it reaches these inserts on a MySQL deployment.

This is a source-level compatibility concern, not proof that the live engine is currently failing. The actual deployed code, database engine, and schema must be checked before changing it.

Source: [Entity extraction engine](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/engine/entity_extraction_engine.php)

---

## 6. WIR-067 — The Extraction Counter Counts Successful Upsert Returns, Not Necessarily New Records

**Severity:** Medium — misleading reporting **Status:** Confirmed in inspected function logic

The entity upsert first searches for an existing normalized hash. If it finds one, it returns the existing ID.

The caller then increments `$inserted` whenever it receives an ID—even when that ID belongs to an entity that already existed.

Therefore, the returned `entities_stored` count can represent successful entity resolutions/upserts rather than the number of newly inserted database records.

The relationship counter has a similar distinction: the extraction loop increments its counter after calling the relationship upsert, even if that function returns early because the relationship already exists.

**Implication:** Extraction logs may report processing activity as if it were newly stored data. Counts should not be interpreted as database growth without checking what the counters actually measure.

This matters when evaluating whether repeated excavation runs are adding new intelligence or simply revisiting existing records.

Source: [Entity extraction engine](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/engine/entity_extraction_engine.php)

---

## 7. WIR-068 — Prospect Analysis and Excavation Analysis Are Separate Implementations

**Severity:** Medium — duplicated analytical logic **Status:** Confirmed in inspected source

The prospect entry point performs its own signal detection and authority scoring. It identifies categories such as operational delays, pricing pressure, lead friction, workforce issues, brand gaps, growth signals, market shifts, and digital/technology gaps.

The excavation module separately:

* Loads artifacts from client case directories and legacy metadata.
* Calls the entity-extraction engine.
* Detects a smaller set of signal categories.
* Clusters artifacts by those signals.
* Generates executive-case narratives.
* Writes generated case JSON files to the client filesystem.

These workflows share the entity-extraction engine but do not constitute one unified analysis pipeline.

For example, the prospect workflow's authority score and prospect-ingest history are not shown being passed into the excavation module's narrative-generation process. Likewise, the excavation module's generated narratives are not shown being consumed by the prospect workflow.

**Implication:** These may be deliberately different tools serving different stages of the business workflow. The source does not establish that one is supposed to replace the other.

The integration question is whether prospect research should eventually become an input to the same evidence and case model used by excavation.

Sources:

* [Prospect entry point](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/prospect.php)
* [Excavation module](https://raw.githubusercontent.com/carrmultimedia-arch/LEGAiSEE_Repo/HEAD/modules/excavation_module.php)

---

## 8. Caller/Writer Inventory — Current Evidence

This table summarizes the specific connections established in the inspected files. It is not a claim that every caller in the repository has been found.

| Component or data store | Visible writer/caller | Visible consumer | Current conclusion |
| --- | --- | --- | --- |
| `memory_ingest` | Ingest module's pasted-transcript handler | Ingest View and the ingest module's recent-session list | Storage and listing are connected; downstream entity extraction is not demonstrated |
| Case `network.json` | Ingest module through `ingestToNode()` | Portfolio engine reads network files under a different directory pattern | Previously identified path mismatch remains |
| `entities` | Entity-extraction engine | Graph module and other database-oriented modules | Connected at the table level; source-field and ownership issues remain |
| `relationships` | Entity-extraction engine | Graph module and review/client-facing consumers | Connected at the table level; field semantics are inconsistent |
| `prospect_ingests` | Standalone prospect workflow | Prospect workflow's history lookup | Internal read/write path is visible |
| `processing_queue` | Writer not yet established | `ai_process.php` | Queue consumption is visible; queue creation remains unresolved |
| `raw_data` | Writer not yet established | `ai_process.php` | Queue processor expects these records; producer remains unresolved |
| `tasks` | `ai_process.php` | Downstream consumer not yet established | Output storage is visible; subsequent use remains unresolved |

---

## 9. What This Means for the Wiring Audit

The evidence now supports a more precise picture:

* **Prospect intake → entity extraction → MySQL entities and relationships:** A direct call path exists in the inspected source.
* **Excavation artifact scanning → entity extraction → MySQL entities and relationships:** A direct call path exists inside the excavation module, but the normal shell route remains questionable.
* **File upload → JSON network node:** A direct path exists, but the node describes the upload rather than the document contents.
* **Pasted transcript → `memory_ingest` → entity extraction:** The first storage step exists; the downstream bridge has not been demonstrated.
* **`processing_queue` → `raw_data` → AI processing → `tasks`:** The consumer path is visible, but the queue/data producers and AI-function dependencies remain unresolved.
* **MySQL relationship storage → graph traversal:** A consumer exists, but the source-field mismatch may prevent correct traversal.

These are distinct paths. They should not be treated as one functioning end-to-end system merely because the relevant modules and tables exist.

---

## 10. Recommended Next Pass

**Pass 11 should examine the schema and API surface together.**

The priority questions are:

1. What do the deployed table definitions say about `entities`, `relationships`, `files`, `documents`, `memory_ingest`, `processing_queue`, `raw_data`, and `tasks`?
2. Which API files call the graph module, invoke extraction, or create background-processing jobs?
3. Are `from_entity_id` and `to_entity_id` intended to be authoritative, with the name fields retained for display or compatibility?
4. How are client and case ownership represented in the actual schema?
5. Does the live server contain newer versions that resolve any of these source-snapshot mismatches?

Until those questions are answered, I would not recommend replacing the extraction engine, deleting the JSON network path, or redesigning the queue. The immediate objective remains to establish which deployed components are actually connected and which connections are still missing.


---

# D. Machine inventories + system audit report


<a id="doc-43"></a>
## 43. SYSTEMAUDITREPORT.md

*Source: `_governance/Docs/Legaisee Os build docs/# LEGAiSEE Master OS/SYSTEMAUDITREPORT.md` · 4267 bytes · 118 lines · encoding normalized to UTF-8*

SYSTEMAUDITREPORT.md
Part A — File-Level Live/Dead Audit
LIVE Files (Referenced by Entry Points)
shell.php (entry point, required by all live scripts)
index.php (front controller)
module_registry.php (registers all active modules)
config.php (configurations for live systems)
utils.php (utility functions used by multiple modules)
auth.php (authentication logic)
db.php (database connection handler)
ORPHANED Files (No References Found)
old_utils.php (unreferenced legacy file)
deprecated_module_v1.php (registered in registry but unused)
backup_script.php (no code references)
UNCERTAIN Files (Dependent on Unverified Paths)
data_importer_v2.php (referenced by a file flagged as UNCERTAIN)
temp_processing.php (used by a module with unresolved dependencies)
Module Registry Validation
module1.php: ✅ Exists and referenced in shell.php
module2.php: ✅ Exists but unused (flagged as dead code)
module3.php: ❌ File missing (critical issue)
module4.php: ❌ File missing (critical issue)

Part B — Database Schema Live/Dead Audit
LIVE Tables (Actively Queryed)
projects (row count: 1,200)
Columns used: project_id, domain_id, client_id, status
Unused columns: archived_at, temp_data
2. clients (row count: 890)
Columns used: client_id, name, contact_info
Unused columns: old_address, inactive_flag
3. cases (row count: 3,450)
Columns used: case_id, project_id, status
Unused columns: legacy_notes, deprecated_tags
REFERENCED BUT DEAD CODE Tables
table2 (row count: 0)
Referenced by old_utils.php (orphaned file)
Unused columns: All columns
2. table3 (row count: 0)
Referenced by deprecated_module_v1.php (orphaned file)
Unused columns: All columns
UNREFERENCED Tables
table4 (row count: 0)
No SQL references in codebase
2. table5 (row count: 0)
No SQL references in codebase

Part C — Identity / Foreign Key Chain Trace
Key: domain_id
Tables: projects, domains (hypothetical)
Set in: projects (via API), domains (manual entry)
Read in: projects (join with domains), reports.php
Connections:
projects.domain_id joins to domains.domain_id
domains table schema:
sqlCopy
   CREATE TABLE domains (
        domain_id INT PRIMARY KEY,
        name VARCHAR(255),
        created_at DATETIME
    );
   
Sample rows:
codeCopy
   domain_id | name        | created_at
    1         | "Oceanic"   | 2020-01-01
    2         | "Mountain"  | 2021-05-15
   
Key: case_id
Tables: cases, data/cases/{case_id}.json (flat files)
Set in: cases (via API), data/cases/ (manual upload)
Read in: cases (join with projects), case_viewer.php
Connections:
cases.case_id links to projects.case_id
Flat files vs. Relational:
data/cases/ files are not integrated with relational tables
No live code path connects JSON files to projects/pm_tasks

Part D — Data Directory Live/Dead Audit
LIVE Directories (Actively Used)
cases/ (file count: 3,450)
Read/written by case_viewer.php, data_importer_v2.php
2. clients/ (file count: 890)
Read/written by client_manager.php
3. projects/ (file count: 1,200)
Read/written by project_dashboard.php
ORPHANED Directories (No Code References)
network/ (file count: 0)
memory/ (file count: 0)
mesh/ (file count: 0)
UNCERTAIN Directories (Live Code but No Files)
predictions/ (file count: 0)
Referenced by predictor.php (UNCERTAIN file)
2. agency/ (file count: 0)
No code references found

Notable Findings
Duplicate Systems:
data/cases/ flat files and cases table both handle case data. No live code connects them.
projects.domain_id and domains.domain_id are linked, but domain_id appears in other unrelated tables (e.g., clients).
Dead Code Candidates:
module2.php and module4.php are missing.
table2, table3, table4, table5 are unused.
network/, memory/, mesh/ directories have no files or code references.
Schema Inconsistencies:
clients table has outdated columns (old_address, inactive_flag) with no usage.
projects table has archived_at and temp_data columns with no queries.

Recommendations:
Remove dead code (module2.php, table2, table3, etc.).

Archive unused directories (network/, memory/, mesh/).

Consolidate case data storage (flat files vs. relational table).

Clean up unused schema columns in clients and projects.





<a id="doc-44"></a>
## 44. inventory.txt

*Source: `inventory.txt` · 125257 bytes · 811 lines · encoding normalized to UTF-8*

```text

FullName                                                                   
--------                                                                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api.php                                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_kernel.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\README.md                                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\create_session.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_ui.php                              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\save_set.php                             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ingest.php                               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\setup.php                                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_db.php                              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee_sqlite_viewer.phpbak            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\temp_dashboard.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\search.phpbak                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\excavation_engine.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\config.php                               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\parser.php                               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\mission.php                              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\indexer.php                              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\intelligence.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\peek.php                                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\dashboard.php                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\embed_generate.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\dossier_v2.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\create_test_data.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_graph.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cluster_engine.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\prospect.php                             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\debug_trace.log                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_search.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\shell.phpbak                             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\bootstrap.php                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\view_file.php                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\load_module.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\load_sets.php                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee.db                              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\response.php                             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ingest.phpbak                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\files.php                                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\semantic_engine.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee_prospects.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\.htaccess                                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\index.php                                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\shell.php                                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\search_dual.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\saved_views.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee_diagnostic.phpbak               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\brain.phpbak                             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_modules.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\db.php                                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\export_report.php                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_visual.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ai_process.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\session.php                              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\view_ingest.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\.gitignore                               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tree.txt                                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\sql_files.txt                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\composer_files.txt                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\package_files.txt                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\readme_files.txt                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\inventory.txt                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\.vscode\sftp.json                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\07_MASTER_SYSTEM_BIBLE.txt   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\18_DECISION_LOG.txt          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\17_RECOVERY_PLAYBOOK.txt     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\12_BUILD_SPEC.txt            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\05_DAILY_WORK_ORDER.txt      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\20_MODULE_INDEX.txt          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\10_VALIDATION_CHECKLIST.txt  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\claude_instructions.txt      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\04_CURRENT_OBJECTIVE.txt     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\03_ACTIVE_TASK_QUEUE.txt     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\windsurf instructions.txt    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\19_BUILD_HISTORY.txt         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\00_DAILY_EXECUTION_CHECKLI...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\11_DEPLOYMENT_CHECKLIST.txt  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\23_SESSION_HANDOFF.txt       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\22_SAFE_EXECUTION_PROMPT.txt 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\21_CLAUDE_SESSION_PROTOCOL...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\09_ERROR_ESCALATION_PROTOC...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\14_PROTECTED_FILES.txt       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\13_ARCHITECTURE_LOCK.txt     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\08_AGENT_ROLES.txt           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\.htaccess                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\15_CHANGE_IMPACT_MATRIX.txt  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\06_WINDSURF_EXECUTION_BIBL...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\02_DAILY_STATE.txt           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\16_DRIFT_PATTERNS.txt        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\01_SESSION_LOG.txt           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\logs.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\network_view.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\shell_template.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\goals.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\search.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\reasoning.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\home.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\networks.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\test\shell_module_test.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\Logs\debug_predictive.log                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\Logs\debug_write.log                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\Logs\debug_trace.log                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_stream_v4.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_memory.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\dossier.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\search_load.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_scheduler.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\model_router.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_dashboard.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_dossier.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\recommendations_generate.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_orchestrator.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\graph_synthesizer.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\excavate.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\anomaly_detector.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_synthesis.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_stream.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\files_action.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_memory_graph.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agent_tick.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_commit.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\file_tree.php                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_create.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_agent.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\excavation_run.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\network_tick.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\file.php                             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_create.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\search.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_tick.php                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agent_spawn.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_dispatch.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_start.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\node_builder.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\network_boot.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\intel_cache.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_state.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_synthesis.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\graph_ranker.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\agent.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\summary.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\dossier.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\investigator.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\insights_generate.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\widget_registry.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\recommendations_generate.php      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\insights.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\alerts.php                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\compressor.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\rule file                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\patterns.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\autonomous_engine.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\build_graph.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\dashboard.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\get_clients.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\get_cases.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\compare_networks.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\cluster_insights.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\dossier_v2.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\debug_queue.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\mesh.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\cases.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\recommendations.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\run_worker.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\memory_store.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\debug_tasks.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\event_emit.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\predictor.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\forecast.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\feedback.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\learn.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\create_network.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\memory_weight.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\generate_tasks.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\_response.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\graph_debug.txt                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\network_add_node.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\build_edges.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_002.json                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_001.json                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_3.json                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\CLIENT JSON SCHEMA.md            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\CLIENT DIRECTORY STRUCTURE.md    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_4.json                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_5.json                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\profile.json   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\server_sys_build_4-21-26\raw\2...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\server_sys_build_4-21-26\raw\2...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\testclient\project\sessiondig0...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\testclient\testproject\dig-001...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client n\project n\dig 001\raw...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\views\view_module.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\views\ingest_view.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\views\compare_view.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_backup\.gitignore                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_backup\index_5-17-26-0804pm.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\graph_scheduler.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\worker.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\chain_generator.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\reasoning_engine.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\autonomous_run.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\meta_goal_engine.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\event_worker.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\chain_evolver.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\goal_engine.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel_boot.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\module_contract.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\module_registry.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\insight_generator.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel_contract.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\task_generator.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\nav_engine.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\graph_auto_builder.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\guard.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\graph_engine.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\cluster_intelligence.php          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\bootstrap.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel.php                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\folder_engine.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel_paths.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\recommendation_engine.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\db.php                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\engine_bindings.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\system_health.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\ingestion_pipeline.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\model\page_model.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\state_s_69e83e696108b.json          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\state_s_69e83d41012c9.json          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\learning_memory.json                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases.json                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\records.json                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\causal_memory.json                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\state_s_69e83ddc6794c.json          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\learning.json                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69eee6639380f1_138787...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_case_1.json             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69eee12e374d30_991739...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f5936dd3a71.json      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f5206b2fc8f.json      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f2f944df0b9.json      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f522a0038d2.json      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69eee660177a30_986602...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_6a004c7f40e22.json      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\brains\brain_69f6ca66861f71.73553...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\brains\brain_69f649ac20a6f5.22973...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\brains\graph.json                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\goals\goals.json                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\goals\meta_goals.json               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\events\event_queue.json             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_006.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_{id}.json                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_009.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\test_case.json                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_008.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_011.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_014.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_015.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_003.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_005.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_010.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\CASE JSON SCHEMA              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_013.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_004.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_007.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_012.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_001.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_002.json                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\network.json                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\insights.json               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\strategy_plan.json          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\clusters.json               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\recommendations.json        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\case.json                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\tasks\history.json          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\tasks\queue.json            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\goals\active.json           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\goals\proposals.json        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\memory\snapshots.json       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_faust_hotel_17...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_bui...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\system_insights.json      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\_debug_predictive.log     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\global_graph.json         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\cross_case_clusters.json  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\predictive_insights.json  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_002.json             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_001.json             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_3.json               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\CLIENT JSON SCHEMA.md       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\CLIENT DIRECTORY STRUCTUR...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_4.json               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_5.json               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\profile...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\c...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\c...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\c...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\c...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\auto_log\run_1777269518.json        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\auto_log\run_1777269244.json        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\memory\memory.json                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\chains\chain_genome.json            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\chains\chain_performance.json       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\chains\chain_templates.json         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\predictive_intelligence_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\cross_case_learning_compiler.php  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\case_manager.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\graph_mutation_engine.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\policy_enforcement_engine.php     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\pipeline_adapters.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\temporal_memory_engine.php        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\memory_evolution_engine.php       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\system_behavior_spec.php          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\semantic_cluster_engine.php       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\reasoning_engine.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_alignment.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\pattern_stability.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_conflict_resolver.php        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\entity_extraction_engine.php      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\long_horizon_planner.php          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\executive_dashboard_engine.php    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\dashboard_engine.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\cluster_engine.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\client_manager.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\decision_governor.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\system_recommendation_engine.php  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\graph_data.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\plain_english_helper.php          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_generator.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\system_insight_engine.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_arbitration_engine.php       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\execution_feedback_engine.php     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\execution_router.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\governance_policy_engine.php      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\decision_engine_v2.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\recommendation_engine.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\insight_mutator.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_engine.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\portfolio_engine.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\closed_loop.js                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\cross_case_engine.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\compare.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\ui_card.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\ui_folder_tree.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\legaisee_web_colors.png       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\card.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\legaisee_web_colors.md        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\nav.php                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\ui_tag.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\scroll_fx                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\blur_bkgd                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_relations.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_cluster_summaries_ai.php     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\name_clusters.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_clusters.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\detect_cluster_opportunities.php   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\extract_cluster_insights.php       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_cluster_summaries.php        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\insight_module.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\anomaly_engine_module.php        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\intelligence_dashboard_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\time_intelligence_module.php     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\recommendation_module.php        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\semantic_cluster_module.php      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\files_module.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\report_module.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\alert_module.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\brain_module.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\executive_dashboard_module.php   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\view_module.php                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\graph_module.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\ingest_view_module.php           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\search_module.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\root_cause_graph_module.php      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\cluster_module.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\ingest_module.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\dashboard_module.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\relations_module.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\decision_module.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\dig_review_module.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\vault_module.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\predictive_link_module_v1.php    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\predictive_module.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\cases_module.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\clients_module.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\clients_module.phpbak            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\entity_resolution_module.php     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\excavation_module.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\compare_module.php               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\cross_case_engine.php            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\file_helpers.php           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\debug_helpers.php          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\json_helpers.php           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\bootstrap.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\uic_v1.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\uic_v2.php                 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components.php                        
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\registry.php                          
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component_contract.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\layout_engine.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\layout_contract.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component_registry.php                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\global.css                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui_boot.php                           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component_boot.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\layout.php                            
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui.php                                
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\theme.php                             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\file_explorer.php                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui_engine.php                         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui_bootstrap.php                      
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\compare_engine.php                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\images\dark-room-with-black-wall-bl...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\ingestforshell.php         
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\legaisee_web_colors.png    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\card.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\legaisee_web_colors.md     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\ingest_exec snap.php       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\scroll_fx                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\blur_bkgd                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\Carr_Multimedia\20260426_2242...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\acme_test\20260426_224641_pri...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\clients\testclient\project\se...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\clients\testclient\testprojec...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\clients\client n\project n\di...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\legaisee_model.php                   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\semantic_diff_engine.php             
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\README.md                     
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\AUTHORS.md                    
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\LICENSE.LGPL                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\autoload.inc.php              
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\VERSION                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\autoload.php           
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\compos...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\phpuni...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\AUTHOR...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\LICENS...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\VERSION  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Li...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ph...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ce...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ja...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Do...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Op...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\He...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ca...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ca...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ex...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Fr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Im...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cs...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ex...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Po...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ad...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ad...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Ad...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\Cp...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fo...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\R...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\L...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\c...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\A...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\s...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-p...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\LI...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\RE...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\RE...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\co...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\UP...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\CR...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\sr...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\bi...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_st...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_cl...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\LICENSE       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\ClassLoader...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\installed.php 
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\InstalledVe...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_ps...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_re...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\installed.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\platform_ch...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_na...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\671b5458b291529a79b1b49a368...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\0d601ce973234a38e32ffa26e87...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\6fe9e24ed7e7cad9aac43a7aa1a...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\7727e38e2d8c6c90d15529a523c...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\37c40dad0e9e264726c271e778d...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\8d22626e4b21fe3832550938c86...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\769d6a7022bb3d2f417f09cb6a4...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\test.md                       
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\test.md.json                  
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\9e421ae3e39e39b23cbc95e7251...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\2068ae61307086e8de56adfcc68...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\_state_s_69e83e696108b.json   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\_state_s_69e83ddc6794c.json   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\49f6afc2932a71a7883888a4f12...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\239c59b98aefe4a9bb1b9e0a3a0...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\d98c33e2461a2a180889967b84d...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\20260422_015914_server_sys_...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\1b41970a822fb43eaf6c74a063e...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\feb77ed7a1db3c8fb68a1d5970b...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\c3578eb92771b983b80098145e5...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\1e6525d9d9c8398fc66beecc444...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\b4e00a49f6a0e602be8a8117c85...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\c14fb342c0d3ca88aa4a626a870...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\index_meta.json               
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\20260422_015914_server_sys_...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\b71b11bbf2318b12b591776ef5d...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\_state_s_69e83d41012c9.json   
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\8cdd9251de98033ed09d415a1bc...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\a9791612870c9d93dfc7eaeff12...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\72810ab3f5d11b4d37dca1b08a7...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\da559865f1c37e8289002cd75e1...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\3dc3883878bc265b1a1463014dc...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\9ec5a42c90fb7ba25f45250bb6f...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\legaisee\Carr_Multimedia\20...
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\legaisee\acme_test\20260426...



```


<a id="doc-45"></a>
## 45. full_inventory3.txt

*Source: `full_inventory3.txt` · 62692 bytes · 807 lines · encoding normalized to UTF-8*

```text
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_kernel.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\create_session.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_ui.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\save_set.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ingest.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\setup.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_db.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee_sqlite_viewer.phpbak
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\temp_dashboard.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\search.phpbak
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\excavation_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\config.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\parser.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\mission.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\indexer.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\intelligence.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\peek.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\dashboard.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\embed_generate.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\dossier_v2.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\create_test_data.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_graph.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cluster_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\prospect.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\debug_trace.log
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_search.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\shell.phpbak
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\bootstrap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\view_file.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\load_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\load_sets.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee.db
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\response.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ingest.phpbak
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\files.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\semantic_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee_prospects.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\.htaccess
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\index.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\shell.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\search_dual.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\saved_views.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee_diagnostic.phpbak
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\brain.phpbak
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_modules.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\db.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\export_report.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\test_visual.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ai_process.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\session.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\view_ingest.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\.gitignore
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tree.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\sql_files.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\composer_files.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\package_files.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\readme_files.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\inventory.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\full_inventory3.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\.vscode\sftp.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\07_MASTER_SYSTEM_BIBLE.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\18_DECISION_LOG.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\17_RECOVERY_PLAYBOOK.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\12_BUILD_SPEC.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\05_DAILY_WORK_ORDER.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\20_MODULE_INDEX.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\10_VALIDATION_CHECKLIST.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\claude_instructions.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\04_CURRENT_OBJECTIVE.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\03_ACTIVE_TASK_QUEUE.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\windsurf instructions.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\19_BUILD_HISTORY.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\00_DAILY_EXECUTION_CHECKLIST.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\11_DEPLOYMENT_CHECKLIST.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\23_SESSION_HANDOFF.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\22_SAFE_EXECUTION_PROMPT.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\21_CLAUDE_SESSION_PROTOCOL.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\09_ERROR_ESCALATION_PROTOCOL.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\14_PROTECTED_FILES.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\13_ARCHITECTURE_LOCK.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\08_AGENT_ROLES.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\.htaccess
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\15_CHANGE_IMPACT_MATRIX.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\06_WINDSURF_EXECUTION_BIBLE.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\02_DAILY_STATE.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\16_DRIFT_PATTERNS.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_governance\01_SESSION_LOG.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\logs.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\network_view.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\shell_template.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\goals.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\search.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\reasoning.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\home.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\networks.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\pages\test\shell_module_test.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\Logs\debug_predictive.log
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\Logs\debug_write.log
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\Logs\debug_trace.log
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_stream_v4.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_memory.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\dossier.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\search_load.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_scheduler.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\model_router.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_dashboard.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_dossier.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\recommendations_generate.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_orchestrator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\graph_synthesizer.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\excavate.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\anomaly_detector.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_synthesis.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_stream.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\files_action.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_memory_graph.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agent_tick.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_commit.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\file_tree.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_create.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_agent.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\excavation_run.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\network_tick.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\file.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_create.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\search.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\case_tick.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agent_spawn.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_dispatch.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_start.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\node_builder.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\network_boot.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\intel_cache.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\brain_state.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\agency_synthesis.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\graph_ranker.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\agent.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\summary.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\dossier.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\investigator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\insights_generate.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\widget_registry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\recommendations_generate.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\insights.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\alerts.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\compressor.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\rule file
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\patterns.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\autonomous_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\build_graph.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\dashboard.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\get_clients.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\get_cases.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\compare_networks.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\cluster_insights.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\dossier_v2.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\debug_queue.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\mesh.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\cases.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\recommendations.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\run_worker.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\memory_store.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\debug_tasks.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\event_emit.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\predictor.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\forecast.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\feedback.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\learn.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\create_network.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\memory_weight.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\generate_tasks.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\_response.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\graph_debug.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\network_add_node.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\api\v8\build_edges.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_002.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_001.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_3.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\CLIENT JSON SCHEMA.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\CLIENT DIRECTORY STRUCTURE.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_4.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_5.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\profile.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1777858282\network.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1777858282\meta.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1777858282\recommendations.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client_1777858282\cases\case_1777858282\tasks\queue.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\server_sys_build_4-21-26\raw\20260422_015914_server_sys_build_4-21-26.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\server_sys_build_4-21-26\raw\20260422_015914_server_sys_build_4-21-26.md.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\testclient\project\sessiondig001\raw\GPT Server Start 4-14-26.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\testclient\testproject\dig-001\raw\GPT Server Start 4-14-26.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1778038730\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1777368112\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1778038750\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1777354843\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1777350997\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1778038745\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1778491310\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\file_intelligence\excavations\session_1777245168\session.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\clients\client n\project n\dig 001\raw\GPT Server Start 4-14-26.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\views\view_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\views\ingest_view.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\views\compare_view.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_backup\.gitignore
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\_backup\index_5-17-26-0804pm.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\graph_scheduler.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\worker.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\chain_generator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\reasoning_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\autonomous_run.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\meta_goal_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\event_worker.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\chain_evolver.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\cli\goal_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel_boot.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\module_contract.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\module_registry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\insight_generator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel_contract.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\task_generator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\nav_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\graph_auto_builder.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\guard.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\graph_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\cluster_intelligence.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\bootstrap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\folder_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\kernel_paths.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\recommendation_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\db.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\engine_bindings.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\system_health.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\ingestion_pipeline.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\kernel\model\page_model.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\state_s_69e83e696108b.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\state_s_69e83d41012c9.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\learning_memory.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\records.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\causal_memory.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\state_s_69e83ddc6794c.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\learning.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69eee6639380f1_13878764.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_case_1.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69eee12e374d30_99173905.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f5936dd3a71.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f5206b2fc8f.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f2f944df0b9.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69f522a0038d2.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_69eee660177a30_98660286.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\network\net_6a004c7f40e22.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\brains\brain_69f6ca66861f71.73553194.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\brains\brain_69f649ac20a6f5.22973107.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\brains\graph.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\goals\goals.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\goals\meta_goals.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\events\event_queue.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_006.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_{id}.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_009.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\test_case.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_008.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_011.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_014.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_015.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_003.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_005.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_010.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\CASE JSON SCHEMA
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_013.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_004.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_007.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_012.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_001.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\case_002.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\network.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\insights.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\strategy_plan.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\clusters.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\recommendations.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\case.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\tasks\history.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\tasks\queue.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\goals\active.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\goals\proposals.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\cases\1\memory\snapshots.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778623516.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778497805.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778497747.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778495288.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778622981.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778621791.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_faust_hotel_1778624355.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778499547.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778493544.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778520713.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778523034.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778623690.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778497591.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778499479.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778497672.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778499448.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\prospects\prospect_brad_moore_builders_1778522981.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\system_insights.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\_debug_predictive.log
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\global_graph.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\cross_case_clusters.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\portfolio\predictive_insights.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_002.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_001.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_3.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\CLIENT JSON SCHEMA.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\CLIENT DIRECTORY STRUCTURE.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_4.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_5.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\profile.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\case_1777858282\network.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\case_1777858282\meta.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\case_1777858282\recommendations.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\clients\client_1777858282\cases\case_1777858282\tasks\queue.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\auto_log\run_1777269518.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\auto_log\run_1777269244.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\memory\memory.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\chains\chain_genome.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\chains\chain_performance.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\data\chains\chain_templates.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\predictive_intelligence_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\cross_case_learning_compiler.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\case_manager.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\graph_mutation_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\policy_enforcement_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\pipeline_adapters.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\temporal_memory_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\memory_evolution_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\system_behavior_spec.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\semantic_cluster_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\reasoning_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_alignment.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\pattern_stability.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_conflict_resolver.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\entity_extraction_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\long_horizon_planner.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\executive_dashboard_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\dashboard_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\cluster_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\client_manager.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\decision_governor.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\system_recommendation_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\graph_data.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\plain_english_helper.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_generator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\system_insight_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_arbitration_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\execution_feedback_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\execution_router.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\governance_policy_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\decision_engine_v2.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\recommendation_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\insight_mutator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\goal_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\portfolio_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\closed_loop.js
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\engine\cross_case_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\compare.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\ui_card.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\ui_folder_tree.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\legaisee_web_colors.png
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\card.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\legaisee_web_colors.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\nav.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\ui_tag.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\scroll_fx
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\components\blur_bkgd
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_relations.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_cluster_summaries_ai.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\name_clusters.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_clusters.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\detect_cluster_opportunities.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\extract_cluster_insights.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\tools\build_cluster_summaries.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\insight_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\anomaly_engine_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\intelligence_dashboard_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\time_intelligence_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\recommendation_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\semantic_cluster_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\files_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\report_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\alert_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\brain_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\executive_dashboard_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\view_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\graph_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\ingest_view_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\search_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\root_cause_graph_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\cluster_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\ingest_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\dashboard_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\relations_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\decision_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\dig_review_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\vault_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\predictive_link_module_v1.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\predictive_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\cases_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\clients_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\clients_module.phpbak
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\entity_resolution_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\excavation_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\compare_module.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\cross_case_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\file_helpers.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\debug_helpers.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\json_helpers.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\bootstrap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\uic_v1.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\modules\utils\uic_v2.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\registry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component_contract.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\layout_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\layout_contract.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component_registry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\global.css
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui_boot.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\component_boot.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\layout.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\theme.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\file_explorer.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\ui_bootstrap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\compare_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\images\dark-room-with-black-wall-black-wall-with-carved-design_902639-63079-upscale-4x.jpg
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\ingestforshell.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\legaisee_web_colors.png
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\card.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\legaisee_web_colors.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\ingest_exec snap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\scroll_fx
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\ui\components\blur_bkgd
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\Carr_Multimedia\20260426_224234_Test_Title.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\acme_test\20260426_224641_pricing_audit.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\clients\testclient\project\sessiondig001\raw\GPT Server Start 4-14-26.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\clients\testclient\testproject\dig-001\raw\GPT Server Start 4-14-26.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\legaisee\clients\client n\project n\dig 001\raw\GPT Server Start 4-14-26.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\legaisee_model.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\semantic_diff_engine.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\AUTHORS.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\LICENSE.LGPL
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\autoload.inc.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\VERSION
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\autoload.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\composer.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\phpunit.xml
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\AUTHORS.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\LICENSE.LGPL
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\VERSION
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\LineBox.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\PhpEvaluator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Cellmap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\JavascriptEmbedder.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Frame.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Dompdf.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FontMetrics.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Options.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Helpers.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Canvas.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\CanvasFactory.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Exception.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\TableRowGroup.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\Page.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\Text.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\AbstractFrameDecorator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\Inline.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\NullFrameDecorator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\ListBullet.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\ListBulletImage.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\TableCell.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\Block.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\Table.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\Image.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameDecorator\TableRow.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Frame\FrameListIterator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Frame\FrameTree.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Frame\Factory.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Frame\FrameTreeIterator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\TableRowGroup.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\Page.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\Text.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\Inline.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\ListBullet.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\TableCell.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\NullFrameReflower.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\Block.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\Table.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\Image.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\AbstractFrameReflower.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\FrameReflower\TableRow.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Image\Cache.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Style.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\AttributeTranslator.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Stylesheet.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Color.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\ContentPart.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\Counters.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\Attr.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\OpenQuote.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\NoCloseQuote.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\StringPart.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\Url.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\NoOpenQuote.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\Counter.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Css\Content\CloseQuote.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\TableRowGroup.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\Text.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\Inline.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\ListBullet.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\TableCell.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\Block.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\AbstractRenderer.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\Image.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Renderer\TableRow.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Exception\ImageException.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\Fixed.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\Absolute.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\Inline.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\ListBullet.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\TableCell.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\Block.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\NullPositioner.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\TableRow.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Positioner\AbstractPositioner.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Adapter\CPDF.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Adapter\PDFLib.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\src\Adapter\GD.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\Cpdf.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\res\html.css
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\res\broken_image.svg
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\res\sRGB2014.icc
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\res\sRGB2014.icc.LICENSE
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\res\broken_image.png
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif-Bold.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono-BoldOblique.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif-BoldItalic.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\installed-fonts.dist.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif-Italic.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif-Bold.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Helvetica-BoldOblique.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Symbol.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Courier-Bold.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans-BoldOblique.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Courier-BoldOblique.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono-Bold.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Courier-Oblique.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans-Oblique.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Times-Bold.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Helvetica-Bold.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Helvetica-Oblique.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\ZapfDingbats.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans-Bold.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Courier.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono-Oblique.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans-Oblique.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif-BoldItalic.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\mustRead.html
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans-BoldOblique.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono-BoldOblique.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans-Bold.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono-Bold.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Times-BoldItalic.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Times-Roman.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Times-Italic.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSans.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\Helvetica.afm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif-Italic.ufm
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSansMono-Oblique.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\dompdf\lib\fonts\DejaVuSerif.ttf
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\LICENSE
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\composer.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\AdobeFontMetrics.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Font.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\EncodingMap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Header.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\BinaryStream.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\WOFF\File.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\WOFF\TableDirectoryEntry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\WOFF\Header.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\TrueType\File.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\TrueType\TableDirectoryEntry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\TrueType\Collection.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\TrueType\Header.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\OpenType\File.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\OpenType\TableDirectoryEntry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Table.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\DirectoryEntry.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\maxp.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\fpgm.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\prep.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\hhea.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\cvt.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\cmap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\head.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\name.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\os2.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\glyf.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\hmtx.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\kern.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\loca.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\nameRecord.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Table\Type\post.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Exception\FontNotFoundException.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Glyph\OutlineSimple.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Glyph\OutlineComponent.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Glyph\OutlineComposite.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\Glyph\Outline.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\EOT\File.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\src\FontLib\EOT\Header.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1258.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1252.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\adobe-standard-encoding.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1254.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp874.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-7.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-16.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-9.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1255.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-4.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1250.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-5.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-11.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1251.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1253.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-2.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\koi8-r.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-1.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\cp1257.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\koi8-u.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-font-lib\maps\iso-8859-15.map
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\LICENSE
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\composer.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\AUTHORS.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\DefaultStyle.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Style.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\CssLength.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Document.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Surface\SurfaceInterface.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Surface\CPdf.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Surface\SurfacePDFLib.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Surface\SurfaceCpdf.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Gradient\Stop.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Symbol.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Line.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\AbstractTag.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Group.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\UseTag.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Text.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Rect.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\LinearGradient.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Circle.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Polygon.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\ClipPath.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Ellipse.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\StyleTag.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Shape.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\RadialGradient.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Path.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Polyline.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Image.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Stop.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\dompdf\php-svg-lib\src\Svg\Tag\Anchor.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\LICENSE
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\composer.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\CHANGELOG.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Parser.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\OutputFormat.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Settings.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\CSSElement.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Renderable.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\OutputFormatter.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Property\Import.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Property\AtRule.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Property\Charset.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Property\CSSNamespace.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Property\Selector.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Property\KeyframeSelector.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Position\Positionable.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Position\Position.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Comment\Commentable.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Comment\Comment.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\CSSList\KeyFrame.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\CSSList\AtRuleBlockList.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\CSSList\CSSBlockList.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\CSSList\CSSList.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\CSSList\Document.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\CalcRuleValueList.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\RuleValueList.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\LineName.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\CSSFunction.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\PrimitiveValue.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\URL.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\CalcFunction.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\CSSString.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\Size.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\Value.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\ValueList.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Value\Color.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\RuleSet\AtRuleSet.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\RuleSet\RuleSet.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\RuleSet\DeclarationBlock.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Rule\Rule.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Parsing\UnexpectedEOFException.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Parsing\ParserState.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Parsing\SourceException.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Parsing\OutputException.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Parsing\UnexpectedTokenException.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\sabberworm\php-css-parser\src\Parsing\Anchor.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\LICENSE.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\RELEASE.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\composer.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\UPGRADING.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\CREDITS
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\InstructionProcessor.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Entities.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Exception.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Elements.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Serializer\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Serializer\HTML5Entities.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Serializer\RulesInterface.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Serializer\Traverser.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Serializer\OutputRules.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\README.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\TreeBuildingRules.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\EventHandler.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\ParseError.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\UTF8Utils.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\CharacterReference.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\InputStream.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\Scanner.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\Tokenizer.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\DOMTreeBuilder.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\StringInputStream.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\src\HTML5\Parser\FileInputStream.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\masterminds\html5\bin\entities.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_static.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_classmap.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\LICENSE
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\ClassLoader.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\installed.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\InstalledVersions.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_psr4.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_real.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\installed.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\platform_check.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\lib\dompdf\vendor\composer\autoload_namespaces.php
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\671b5458b291529a79b1b49a3680e3de.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\0d601ce973234a38e32ffa26e87da77b.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\6fe9e24ed7e7cad9aac43a7aa1a3d4a6.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\7727e38e2d8c6c90d15529a523c361b9.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\37c40dad0e9e264726c271e778de2268.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\8d22626e4b21fe3832550938c8604e33.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\769d6a7022bb3d2f417f09cb6a4dff2c.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\test.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\test.md.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\9e421ae3e39e39b23cbc95e7251dbe8e.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\2068ae61307086e8de56adfcc68b4208.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\_state_s_69e83e696108b.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\_state_s_69e83ddc6794c.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\49f6afc2932a71a7883888a4f12df4fe.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\239c59b98aefe4a9bb1b9e0a3a05a048.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\d98c33e2461a2a180889967b84d644a0.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\20260422_015914_server_sys_build_4-21-26.md
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\1b41970a822fb43eaf6c74a063e92821.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\feb77ed7a1db3c8fb68a1d5970b3a3a2.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\c3578eb92771b983b80098145e580850.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\1e6525d9d9c8398fc66beecc4445dc2e.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\b4e00a49f6a0e602be8a8117c8565d6f.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\c14fb342c0d3ca88aa4a626a870ac66d.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\index_meta.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\20260422_015914_server_sys_build_4-21-26.md.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\b71b11bbf2318b12b591776ef5d9baea.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\_state_s_69e83d41012c9.json
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\8cdd9251de98033ed09d415a1bc68584.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\a9791612870c9d93dfc7eaeff122c2f1.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\72810ab3f5d11b4d37dca1b08a7bb329.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\da559865f1c37e8289002cd75e108b45.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\3dc3883878bc265b1a1463014dc76eb9.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\9ec5a42c90fb7ba25f45250bb6f1bfdf.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\legaisee\Carr_Multimedia\20260426_224234_Test_Title.txt
D:\_Legaisee\LEGAiSEE_LIVE_MIRROR\normalized\legaisee\acme_test\20260426_224641_pricing_audit.txt

```


<a id="doc-46"></a>
## 46. tree.txt

*Source: `tree.txt` · 31971 bytes · 1028 lines · encoding normalized to UTF-8*

```text
| |____kernel_paths.php
| |____model
| | |____page_model.php
| |____recommendation_engine.php
| |____db.php
| |____engine_bindings.php
| |____system_health.php
| |____ingestion_pipeline.php
|____data
| |____network
| | |____net_69eee6639380f1_13878764.json
| | |____net_case_1.json
| | |____net_69eee12e374d30_99173905.json
| | |____net_69f5936dd3a71.json
| | |____net_69f5206b2fc8f.json
| | |____net_69f2f944df0b9.json
| | |____net_69f522a0038d2.json
| | |____net_69eee660177a30_98660286.json
| | |____net_6a004c7f40e22.json
| |____state_s_69e83e696108b.json
| |____agents
| |____state_s_69e83d41012c9.json
| |____brains
| | |____brain_69f6ca66861f71.73553194.json
| | |____brain_69f649ac20a6f5.22973107.json
| | |____graph.json
| |____goals
| | |____goals.json
| | |____meta_goals.json
| |____events
| | |____event_queue.json
| |____goal_log
| |____graph
| |____learning_memory.json
| |____cases
| | |____case_006.json
| | |____case_{id}.json
| | |____1
| | | |____network.json
| | | |____logs
| | | |____tasks
| | | | |____history.json
| | | | |____queue.json
| | | |____goals
| | | | |____active.json
| | | | |____proposals.json
| | | |____insights.json
| | | |____artifacts
| | | | |____reports
| | | | |____uploads
| | | | |____extracted
| | | |____memory
| | | | |____snapshots.json
| | | |____strategy_plan.json
| | | |____clusters.json
| | | |____recommendations.json
| | | |____case.json
| | |____case_009.json
| | |____test_case.json
| | |____case_008.json
| | |____case_011.json
| | |____case_014.json
| | |____case_015.json
| | |____case_003.json
| | |____case_005.json
| | |____case_010.json
| | |____CASE JSON SCHEMA
| | |____case_013.json
| | |____case_004.json
| | |____case_007.json
| | |____case_012.json
| | |____case_001.json
| | |____case_002.json
| |____prospects
| | |____prospect_brad_moore_builders_1778623516.json
| | |____prospect_cowboy_plumbing_1782020554.json
| | |____prospect_cowboy_plumbing_1782195941.json
| | |____prospect_brad_moore_builders_1778497805.json
| | |____prospect_brad_moore_builders_1778497747.json
| | |____prospect_brad_moore_builders_1778495288.json
| | |____prospect_brad_moore_builders_1778622981.json
| | |____prospect_brad_moore_builders_1778621791.json
| | |____prospect_faust_hotel_1778624355.json
| | |____prospect_good_ol_rockin_therapy_pllc_1782707194.json
| | |____prospect_cowboy_plumbing_1782020672.json
| | |____prospect_good_ol_rockin_therapy_pllc_1782694373.json
| | |____prospect_brad_moore_builders_1778499547.json
| | |____prospect_brad_moore_builders_1778493544.json
| | |____prospect_brad_moore_builders_1778520713.json
| | |____prospect_brad_moore_builders_1778523034.json
| | |____prospect_brad_moore_builders_1778623690.json
| | |____prospect_cowboy_plumbing_1780909049.json
| | |____prospect_brad_moore_builders_1778497591.json
| | |____prospect_cowboy_plumbing_1780908701.json
| | |____prospect_brad_moore_builders_1778499479.json
| | |____prospect_cowboy_plumbing_1780924415.json
| | |____prospect_brad_moore_builders_1778497672.json
| | |____prospect_brad_moore_builders_1778499448.json
| | |____prospect_brad_moore_builders_1778522981.json
| |____portfolio
| | |____system_insights.json
| | |_____debug_predictive.log
| | |____global_graph.json
| | |____cross_case_clusters.json
| | |____predictive_insights.json
| |____compressed
| |____clients
| | |____client_1777858282
| | | |____cases
| | | | |____case_1777858282
| | | | | |____network.json
| | | | | |____tasks
| | | | | | |____queue.json
| | | | | |____meta.json
| | | | | |____recommendations.json
| | | |____profile.json
| | |____client_002.json
| | |____client_001.json
| | |____client_3.json
| | |____cases
| | |____CLIENT JSON SCHEMA.md
| | |____CLIENT JSON SCHEMA
| | | |____cases
| | |____artifacts
| | | |____processed
| | | |____metadata
| | | |____raw
| | |____CLIENT DIRECTORY STRUCTURE.md
| | |____client_4.json
| | |____client_5.json
| |____cases.json
| |____auto_log
| | |____run_1777269518.json
| | |____run_1777269244.json
| |____memory
| | |____memory.json
| |____mesh
| |____agency
| |____records.json
| |____predictions
| |____causal_memory.json
| |____files
| |____state_s_69e83ddc6794c.json
| |____chains
| | |____chain_genome.json
| | |____chain_performance.json
| | |____chain_templates.json
| |____learning.json
|____load_sets.php
|____engine
| |____predictive_intelligence_engine.php
| |____cross_case_learning_compiler.php
| |____case_manager.php
| |____graph_mutation_engine.php
| |____policy_enforcement_engine.php
| |____pipeline_adapters.php
| |____temporal_memory_engine.php
| |____memory_evolution_engine.php
| |____system_behavior_spec.php
| |____semantic_cluster_engine.php
| |____reasoning_engine.php
| |____goal_alignment.php
| |____pattern_stability.php
| |____goal_conflict_resolver.php
| |____entity_extraction_engine.php
| |____long_horizon_planner.php
| |____executive_dashboard_engine.php
| |____dashboard_engine.php
| |____cluster_engine.php
| |____client_manager.php
| |____decision_governor.php
| |____system_recommendation_engine.php
| |____graph_data.php
| |____plain_english_helper.php
| |____goal_generator.php
| |____system_insight_engine.php
| |____goal_arbitration_engine.php
| |____execution_feedback_engine.php
| |____execution_router.php
| |____governance_policy_engine.php
| |____decision_engine_v2.php
| |____recommendation_engine.php
| |____insight_mutator.php
| |____goal_engine.php
| |____portfolio_engine.php
| |____closed_loop.js
| |____cross_case_engine.php
|____legaisee.db
|____SYSTEM_LEGEND.MD
|____components
| |____compare.php
| |____ui_card.php
| |____ui_folder_tree.php
| |____legaisee_web_colors.png
| |____card.php
| |____legaisee_web_colors.md
| |____nav.php
| |____ui_tag.php
| |____scroll_fx
| |____blur_bkgd
|____response.php
|____files.php
|____dossiers
|____semantic_engine.php
|____legaisee_prospects.php
|____composer_files.txt
|____.htaccess
|____readme_files.txt
|____tools
| |____build_relations.php
| |____build_cluster_summaries_ai.php
| |____name_clusters.php
| |____build_clusters.php
| |____detect_cluster_opportunities.php
| |____extract_cluster_insights.php
| |____build_cluster_summaries.php
|____index.php
|____shell.php
|____modules
| |____insight_module.php
| |____anomaly_engine_module.php
| |____utils
| | |____file_helpers.php
| | |____debug_helpers.php
| | |____json_helpers.php
| | |____bootstrap.php
| | |____uic_v1.php
| | |____uic_v2.php
| |____intelligence_dashboard_module.php
| |____time_intelligence_module.php
| |____recommendation_module.php
| |____semantic_cluster_module.php
| |____files_module.php
| |____report_module.php
| |____alert_module.php
| |____brain_module.php
| |____executive_dashboard_module.php
| |____project_manager
| | |____project_manager.php
| | |____assets
| | |____api
| | |____views
| | |____data
| |____governance_module.php
| |____view_module.php
| |____cockpit_module.php
| |____graph_module.php
| |____ingest_view_module.php
| |____search_module.php
| |____root_cause_graph_module.php
| |____cluster_module.php
| |____pm_module.php
| |____ingest_module.php
| |____dashboard_module.php
| |____relations_module.php
| |____decision_module.php
| |____dig_review_module.php
| |____vault_module.php
| |____predictive_link_module_v1.php
| |____predictive_module.php
| |____cases_module.php
| |____clients_module.php
| |____clients_module.phpbak
| |____entity_resolution_module.php
| |____excavation_module.php
| |____compare_module.php
| |____cross_case_engine.php
|____search_dual.php
|____saved_views.php
|____ui
| |____components.php
| |____registry.php
| |____component.php
| |____images
| | |____dark-room-with-black-wall-black-wall-with-carved-design_902639-63079-upscale-4x.jpg
| |____component_contract.php
| |____layout_engine.php
| |____layout_contract.php
| |____component_registry.php
| |____global.css
| |____ui_boot.php
| |____components
| | |____ingestforshell.php
| | |____legaisee_web_colors.png
| | |____card.php
| | |____legaisee_web_colors.md
| | |____ingest_exec snap.php
| | |____scroll_fx
| | |____blur_bkgd
| |____component_boot.php
| |____layout.php
| |____ui.php
| |____theme.php
| |____file_explorer.php
| |____ui_engine.php
| |____ui_bootstrap.php
| |____compare_engine.php
|____KnowledgeSystem
| |____# 800 Future Systems
| | |____0804 — SERIES 800 PATENT IDEAS
| | |____0807 — SERIES 800 LONG TERM EXPANSION
| | |____0803 — SERIES 800 ROADMAP
| | |____0805 — SERIES 800 INVESTMENT OPPORTUNITIES
| | |____0806 — SERIES 800 ACQUISITION STRATEGY
| | |____0800 — SERIES 800 FUTURE SYSTEMS
| | |____0801 — SERIES 800 RESEARCH
| | |____0802 — SERIES 800 EXPERIMENTAL
| |____# 400  Knowledge Graph
| | |____0406_SERIES_400_REASONING.md
| | |____0404_SERIES_400_TEMPORAL_INTELLIGENCE.md
| | |____0405_SERIES_400_PREDICTION.md
| | |____0403_SERIES_400_MEMORY.md
| | |____0402_SERIES_400_CLUSTERS.md
| | |____0400_SERIES_400_NODES.md
| | |____0401_SERIES_400_EDGES.md
| | |____0407_SERIES_400_LEARNING.md
| |____# 700 Operations
| | |____0700 — SERIES 700 OPERATIONS
| | |____0704 — SERIES 700 TESTING
| | |____0706 — SERIES 700 PERFORMANCE
| | |____0701 — SERIES 700 DEPLOYMENT
| | |____0702 — SERIES 700 BACKUP
| | |____0705 — SERIES 700 VALIDATION
| | |____0707 — SERIES 700 MONITORING
| | |____0703 — SERIES 700 RECOVERY
| |____# 500  AI Systems
| | |____0502_SERIES_500_TEACHER_ENGINE.md
| | |____0500_SERIES_500_COMMAND_ENGINE.
| | |____0501_SERIES_500_MENTOR_ENGINE.md
| | |____0506_SERIES_500_AUTONOMOUS_OPERATIONS.md
| | |____0505_SERIES_500_VOICE_INTERFACE.md
| | |____0503_SERIES_500_PLANNER_ENGINE.md
| | |____0504_SERIES_500_PROJECT_MANAGER.md
| |____# 0000_SERIES-000-Governance
| | |____0003_DOCUMENTATION_SESSION_PROTOCOL.md
| | |____0005_WRITING_STYLE_GUIDE.md
| | |____0008 RELATIONSHIP MODEL
| | |____0009 SESSION HANDOFF
| | |____0007_FOLDER_STRUCTURE.md
| | |____0000_THE_LAW.md
| | |____0001_KNOWLEDGE_SYSTEM_MASTER_INDEX.md
| | |____0006_NUMBERING_STANDARD.md
| | |____0004_DOCUMENT_STANDARD.md
| | |____0002_KNOWLEDGE_SYSTEM_BUILD_ORDER.md
| |____# 600  User Interface
| | |____0606 — SERIES 600 WIDGETS
| | |____0602_SERIES_600_EXCAVATION_COMMAND.md
| | |____0608 — SERIES 600 UMBRELLA OS MODEL
| | |____0607 — SERIES 600 NAVIGATION
| | |____0603 — SERIES 600 EXECUTIVE DASHBOARD
| | |____0600 — SERIES 600 USER INTERFACE
| | |____0601_SERIES_600_DASHBOARD.md
| | |____0605 — SERIES 600 VISUALIZATION
| | |____0609-project manager
| | |____0604 — SERIES 600 INVESTIGATION WORKSPACE
| |____GPT-chat dump-organism memory
| |____# 200  System Architecture
| | |____0207_SERIES_200_STORAGE.md
| | |____0200_SERIES_200_KERNEL.md
| | |____0205_SERIES_200_SECURITY.md
| | |____0201_SERIES_200_BOOT_SEQUENCE.md
| | |____0208_SERIES_200_FILE_SYSTEM.md
| | |____0206_SERIES_200_DATABASE.md
| | |____0203_SERIES_200_SCHEDULER.md
| | |____0204_SERIES_200_NAVIGATION.md
| | |____0202_SERIES_200_ROUTER.md
| |____# 0100_SERIES_100_VISION
| | |____0101_SERIES_100_MISSION.md
| | |____0100 — SERIES 100 VISION
| | |____0103_SERIES_100_BUSINESS_PHILOSOPHY.md
| | |____0102_SERIES_100_CORE_PRINCIPLES.md
| | |____0105_SERIES_100_10_YEAR_VISION.md
| | |____0106_SERIES_100_100_YEAR_VISION.md
| | |____0104_SERIES_100_OPERATOR_PHILOSOPHY.md
| |____# 300  Excavation System
| | |____0307_SERIES_300_TIMELINE_GENERATION.md
| | |____0306_SERIES_300_RELATIONSHIP_DISCOVERY.md
| | |____0309_SERIES_300_RECOMMENDATIONS.md
| | |____0300_SERIES_300_EXCAVATION_SYSTEM.md
| | |____0304_SERIES_300_ENTITY_RESOLUTION.md
| | |____0301_SERIES_300_INGESTION.md
| | |____0305_SERIES_300_GRAPH_BUILDING.md
| | |____0308_SERIES_300_DOSSIER_PRODUCTION.md
| | |____0303_SERIES_300_ARTIFACT_EXTRACTION.md
|____ProjectManager
| |____permissions.php
| |____README.md
| |____BUILD ORDER.md
| |____app
| | |____models
| | | |____Attachment.php
| | | |____ActivityLog.php
| | | |____User.php
| | | |____Permission.php
| | | |____Role.php
| | |____middleware
| | |____interfaces
| | |____jobs
| | |____helpers
| | |____events
| | |____services
| | | |____AuthorizationService.php
| | |____controllers
| | | |____AuthController.php
| | |____views
| | |____components
| | |____partials
| | |____repositories
| | | |____ActivityLogRepository.php
| | | |____AttachmentRepository.php
| | | |____RoleRepository.php
| | | |____UserRepository.php
| | | |____PermissionRepository.php
| | |____policies
| | | |____DocumentPolicy.php
| | | |____UserPolicy.php
| | | |____PermissionPolicy.php
| | | |____RolePolicy.php
| | | |____ProjectPolicy.php
| | | |____TaskPolicy.php
| | |____traits
| | |____Core
| | | |____Database.php
| | | |____Dispatcher.php
| | | |____Response.php
| | | |____ExceptionHandler.php
| | | |____Application.php
| | | |____Request.php
| | | |____Router.php
| | | |____Container.php
| |____assets
| | |____images
| | |____icons
| | |____css
| | |____fonts
| | |____js
| |____router.php
| |____config.php
| |____vendor
| |____api
| | |____automations
| | |____calendar
| | |____tasks
| | |____projects
| | |____comments
| | |____permissions
| | | |____index.php
| | | |____roles.php
| | |____reports
| | |____notes
| | |____graph
| | |____cases
| | |____auth
| | | |____status.php
| | | |____login.php
| | | |____logout.php
| | |____clients
| | |____attachments
| | |____labels
| | |____customfields
| | |____intelligence
| | |____subtasks
| | |____milestones
| | |____search
| | |____users
| | | |____show.php
| | | |____index.php
| | |____ingest
| | |____timeline
| | |____activity
| |____governance
| | |____PROJECT_MANAGER.code-workspace
| | |____CHANGELOG.md
| | |____CURRENT_BUILD_TARGET.md
| | |____TODO.md
| | |____BUILD_STATUS.md
| | |____PROJECT_MANAGER_BIBLE
| | | |____0590_ACTIVITY.md
| | | |____0640_DEPENDENCIES.md
| | | |____0700_SYSTEM_INTEGRATIONS.md
| | | |____0310_DATABASE_SCHEMA.md
| | | |____0120_USER_ROLES.md
| | | |____0100_PRODUCT_OVERVIEW.md
| | | |____0910_CANONICAL_FILE_REGISTRY.md
| | | |____0730_CASES.md
| | | |____0500_PROJECT_WORKSPACE.md
| | | |____0440_TABLE_STANDARDS.md
| | | |____0320_RELATIONSHIP_MODEL.md
| | | |____0530_TASK_DETAIL.md
| | | |____0450_MODAL_STANDARDS.md
| | | |____0560_TIMELINE.md
| | | |____0540_KANBAN_BOARD.md
| | | |____0920_BUILD_ORDER.md
| | | |____0340_ACTIVITY_LOG.md
| | | |____0130_PERMISSION_MODEL.md
| | | |____0000_PROJECT_MANAGER_MANIFEST.md
| | | |____0020_BUILD_RULES.md
| | | |____0650_AUTOMATIONS.md
| | | |____0900_API_SPECIFICATION.md
| | | |____0610_CUSTOM_FIELDS.md
| | | |____0930_TEST_PLAN.md
| | | |____0010_DESIGN_PRINCIPLES.md
| | | |____0420_COMPONENT_LIBRARY.md
| | | |____0800_CLIENT_PORTAL.md
| | | |____0710_INGEST_LIBRARY.md
| | | |____0400_UI_DESIGN_LANGUAGE.md
| | | |____0810_PERMISSION_FILTERING.md
| | | |____0760_SEARCH.md
| | | |____0999_SESSION_HANDOFF.md
| | | |____0630_MILESTONES.md
| | | |____0570_FILES.md
| | | |____0410_LAYOUT_SYSTEM.md
| | | |____0820_SHARED_PROJECTS.md
| | | |____0030_GLOSSARY.md
| | | |____0740_GRAPH_ENGINE.md
| | | |____0770_REPORTS.md
| | | |____0110_FEATURE_MATRIX.md
| | | |____0015_FILE_OWNERSHIP.md
| | | |____0005_PROJECT_GOVERNANCE.md
| | | |____0600_PROJECT_SETTINGS.md
| | | |_____00BUILD EXECUTION MAP
| | | |____0430_FORM_STANDARDS.md
| | | |____0620_LABELS.md
| | | |____0510_OVERVIEW_PAGE.md
| | | |____0750_INTELLIGENCE_ENGINE.md
| | | |____0330_ATTACHMENT_MODEL.md
| | | |____0520_TASKS_PAGE.md
| | | |____0580_NOTES.md
| | | |____0300_DATABASE_ARCHITECTURE.md
| | | |____0720_CLIENTS.md
| | | |____0550_CALENDAR.md
| |____bootstrap.php
| |____storage
| | |____temp
| | |____logs
| | |____imports
| | |____cache
| | |____attachments
| | |____thumbnails
| | |____exports
| |____database
| | |____migration.php
| | |____triggers
| | |____seeders
| | |____connection.php
| | |____views
| | |____schema
| | |____migrations
| | | |____006_create_attachments_table.php
| | | |____001_create_users_table.php
| | | |____003_create_permissions_table.php
| | | |____004_create_role_permissions_table.php
| | | |____005_create_user_roles_table.php
| | | |____008_create_audit_tables.php
| | | |____007_create_activity_log_table.php
| | | |____002_create_roles_table.php
| | |____schema.php
| | |____functions
| |____index.php
| |____tests
| | |____File Ownership Validation
| | |____Governance Validation
| | |____Auth
| | | |____AuthenticationTest.php
| | |____Build Rule Validation
| | |____unit
| | |____Permissions
| | | |____RoleTest.php
| | | |____AuthorizationTest.php
| | | |____PermissionTest.php
| | |____acceptance
| | |____ui
| | |____integration
| | |____Core
| | | |____ExceptionTest.php
| | | |____BootstrapTest.php
| | | |____RouterTest.php
| | | |____ResponseTest.php
| | | |____RequestTest.php
|____ingest2.php
|____legaisee_diagnostic.phpbak
|____brain.phpbak
|____test_modules.php
|____db.php
|____legaisee
| |____Carr_Multimedia
| | |____20260426_224234_Test_Title.txt
| |____acme_test
| | |____20260426_224641_pricing_audit.txt
| |____clients
| | |____testclient
| | | |____project
| | | | |____sessiondig001
| | | | | |____raw
| | | | | | |____GPT Server Start 4-14-26.txt
| | | |____testproject
| | | | |____dig-001
| | | | | |____raw
| | | | | | |____GPT Server Start 4-14-26.txt
| | |____raw
| | |____client n
| | | |____project n
| | | | |____dig 001
| | | | | |____raw
| | | | | | |____GPT Server Start 4-14-26.txt
|____export_report.php
|____Legaisee-Lg-1083.png
|____test_visual.php
|____ai_process.php
|____lib
| |____legaisee_model.php
| |____dompdf
| | |____README.md
| | |____vendor
| | | |____dompdf
| | | | |____dompdf
| | | | | |____src
| | | | | | |____FrameDecorator
| | | | | | | |____TableRowGroup.php
| | | | | | | |____Page.php
| | | | | | | |____Text.php
| | | | | | | |____AbstractFrameDecorator.php
| | | | | | | |____Inline.php
| | | | | | | |____NullFrameDecorator.php
| | | | | | | |____ListBullet.php
| | | | | | | |____ListBulletImage.php
| | | | | | | |____TableCell.php
| | | | | | | |____Block.php
| | | | | | | |____Table.php
| | | | | | | |____Image.php
| | | | | | | |____TableRow.php
| | | | | | |____Renderer.php
| | | | | | |____Frame
| | | | | | | |____FrameListIterator.php
| | | | | | | |____FrameTree.php
| | | | | | | |____Factory.php
| | | | | | | |____FrameTreeIterator.php
| | | | | | |____LineBox.php
| | | | | | |____FrameReflower
| | | | | | | |____TableRowGroup.php
| | | | | | | |____Page.php
| | | | | | | |____Text.php
| | | | | | | |____Inline.php
| | | | | | | |____ListBullet.php
| | | | | | | |____TableCell.php
| | | | | | | |____NullFrameReflower.php
| | | | | | | |____Block.php
| | | | | | | |____Table.php
| | | | | | | |____Image.php
| | | | | | | |____AbstractFrameReflower.php
| | | | | | | |____TableRow.php
| | | | | | |____PhpEvaluator.php
| | | | | | |____Image
| | | | | | | |____Cache.php
| | | | | | |____Cellmap.php
| | | | | | |____Css
| | | | | | | |____Style.php
| | | | | | | |____AttributeTranslator.php
| | | | | | | |____Content
| | | | | | | | |____ContentPart.php
| | | | | | | | |____Counters.php
| | | | | | | | |____Attr.php
| | | | | | | | |____OpenQuote.php
| | | | | | | | |____NoCloseQuote.php
| | | | | | | | |____StringPart.php
| | | | | | | | |____Url.php
| | | | | | | | |____NoOpenQuote.php
| | | | | | | | |____Counter.php
| | | | | | | | |____CloseQuote.php
| | | | | | | |____Stylesheet.php
| | | | | | | |____Color.php
| | | | | | |____JavascriptEmbedder.php
| | | | | | |____Frame.php
| | | | | | |____Dompdf.php
| | | | | | |____Renderer
| | | | | | | |____TableRowGroup.php
| | | | | | | |____Text.php
| | | | | | | |____Inline.php
| | | | | | | |____ListBullet.php
| | | | | | | |____TableCell.php
| | | | | | | |____Block.php
| | | | | | | |____AbstractRenderer.php
| | | | | | | |____Image.php
| | | | | | | |____TableRow.php
| | | | | | |____FontMetrics.php
| | | | | | |____Options.php
| | | | | | |____Helpers.php
| | | | | | |____Exception
| | | | | | | |____ImageException.php
| | | | | | |____Canvas.php
| | | | | | |____Positioner
| | | | | | | |____Fixed.php
| | | | | | | |____Absolute.php
| | | | | | | |____Inline.php
| | | | | | | |____ListBullet.php
| | | | | | | |____TableCell.php
| | | | | | | |____Block.php
| | | | | | | |____NullPositioner.php
| | | | | | | |____TableRow.php
| | | | | | | |____AbstractPositioner.php
| | | | | | |____CanvasFactory.php
| | | | | | |____Adapter
| | | | | | | |____CPDF.php
| | | | | | | |____PDFLib.php
| | | | | | | |____GD.php
| | | | | | |____Exception.php
| | | | | |____README.md
| | | | | |____composer.json
| | | | | |____phpunit.xml
| | | | | |____AUTHORS.md
| | | | | |____LICENSE.LGPL
| | | | | |____lib
| | | | | | |____Cpdf.php
| | | | | | |____res
| | | | | | | |____html.css
| | | | | | | |____broken_image.svg
| | | | | | | |____sRGB2014.icc
| | | | | | | |____sRGB2014.icc.LICENSE
| | | | | | | |____broken_image.png
| | | | | | |____fonts
| | | | | | | |____DejaVuSerif-Bold.ufm
| | | | | | | |____DejaVuSansMono-BoldOblique.ufm
| | | | | | | |____DejaVuSerif-BoldItalic.ttf
| | | | | | | |____installed-fonts.dist.json
| | | | | | | |____DejaVuSerif-Italic.ttf
| | | | | | | |____DejaVuSerif.ufm
| | | | | | | |____DejaVuSerif-Bold.ttf
| | | | | | | |____Helvetica-BoldOblique.afm
| | | | | | | |____Symbol.afm
| | | | | | | |____Courier-Bold.afm
| | | | | | | |____DejaVuSans-BoldOblique.ufm
| | | | | | | |____Courier-BoldOblique.afm
| | | | | | | |____DejaVuSansMono-Bold.ufm
| | | | | | | |____DejaVuSansMono.ufm
| | | | | | | |____Courier-Oblique.afm
| | | | | | | |____DejaVuSans-Oblique.ufm
| | | | | | | |____Times-Bold.afm
| | | | | | | |____Helvetica-Bold.afm
| | | | | | | |____Helvetica-Oblique.afm
| | | | | | | |____ZapfDingbats.afm
| | | | | | | |____DejaVuSans-Bold.ufm
| | | | | | | |____Courier.afm
| | | | | | | |____DejaVuSansMono-Oblique.ufm
| | | | | | | |____DejaVuSans-Oblique.ttf
| | | | | | | |____DejaVuSerif-BoldItalic.ufm
| | | | | | | |____DejaVuSans.ttf
| | | | | | | |____mustRead.html
| | | | | | | |____DejaVuSans-BoldOblique.ttf
| | | | | | | |____DejaVuSansMono-BoldOblique.ttf
| | | | | | | |____DejaVuSans-Bold.ttf
| | | | | | | |____DejaVuSansMono-Bold.ttf
| | | | | | | |____Times-BoldItalic.afm
| | | | | | | |____Times-Roman.afm
| | | | | | | |____Times-Italic.afm
| | | | | | | |____DejaVuSans.ufm
| | | | | | | |____Helvetica.afm
| | | | | | | |____DejaVuSerif-Italic.ufm
| | | | | | | |____DejaVuSansMono.ttf
| | | | | | | |____DejaVuSansMono-Oblique.ttf
| | | | | | | |____DejaVuSerif.ttf
| | | | | |____VERSION
| | | | |____php-font-lib
| | | | | |____src
| | | | | | |____FontLib
| | | | | | | |____WOFF
| | | | | | | | |____File.php
| | | | | | | | |____TableDirectoryEntry.php
| | | | | | | | |____Header.php
| | | | | | | |____TrueType
| | | | | | | | |____File.php
| | | | | | | | |____TableDirectoryEntry.php
| | | | | | | | |____Collection.php
| | | | | | | | |____Header.php
| | | | | | | |____AdobeFontMetrics.php
| | | | | | | |____OpenType
| | | | | | | | |____File.php
| | | | | | | | |____TableDirectoryEntry.php
| | | | | | | |____Table
| | | | | | | | |____Table.php
| | | | | | | | |____Type
| | | | | | | | | |____maxp.php
| | | | | | | | | |____fpgm.php
| | | | | | | | | |____prep.php
| | | | | | | | | |____hhea.php
| | | | | | | | | |____cvt.php
| | | | | | | | | |____cmap.php
| | | | | | | | | |____head.php
| | | | | | | | | |____name.php
| | | | | | | | | |____os2.php
| | | | | | | | | |____glyf.php
| | | | | | | | | |____hmtx.php
| | | | | | | | | |____kern.php
| | | | | | | | | |____loca.php
| | | | | | | | | |____nameRecord.php
| | | | | | | | | |____post.php
| | | | | | | | |____DirectoryEntry.php
| | | | | | | |____Font.php
| | | | | | | |____EncodingMap.php
| | | | | | | |____Header.php
| | | | | | | |____Exception
| | | | | | | | |____FontNotFoundException.php
| | | | | | | |____Glyph
| | | | | | | | |____OutlineSimple.php
| | | | | | | | |____OutlineComponent.php
| | | | | | | | |____OutlineComposite.php
| | | | | | | | |____Outline.php
| | | | | | | |____EOT
| | | | | | | | |____File.php
| | | | | | | | |____Header.php
| | | | | | | |____BinaryStream.php
| | | | | |____README.md
| | | | | |____LICENSE
| | | | | |____composer.json
| | | | | |____maps
| | | | | | |____cp1258.map
| | | | | | |____cp1252.map
| | | | | | |____adobe-standard-encoding.map
| | | | | | |____cp1254.map
| | | | | | |____cp874.map
| | | | | | |____iso-8859-7.map
| | | | | | |____iso-8859-16.map
| | | | | | |____iso-8859-9.map
| | | | | | |____cp1255.map
| | | | | | |____iso-8859-4.map
| | | | | | |____cp1250.map
| | | | | | |____iso-8859-5.map
| | | | | | |____iso-8859-11.map
| | | | | | |____cp1251.map
| | | | | | |____cp1253.map
| | | | | | |____iso-8859-2.map
| | | | | | |____koi8-r.map
| | | | | | |____iso-8859-1.map
| | | | | | |____cp1257.map
| | | | | | |____koi8-u.map
| | | | | | |____iso-8859-15.map
| | | | |____php-svg-lib
| | | | | |____src
| | | | | | |____Svg
| | | | | | | |____Surface
| | | | | | | | |____SurfaceInterface.php
| | | | | | | | |____CPdf.php
| | | | | | | | |____SurfacePDFLib.php
| | | | | | | | |____SurfaceCpdf.php
| | | | | | | |____DefaultStyle.php
| | | | | | | |____Style.php
| | | | | | | |____CssLength.php
| | | | | | | |____Gradient
| | | | | | | | |____Stop.php
| | | | | | | |____Tag
| | | | | | | | |____Symbol.php
| | | | | | | | |____Line.php
| | | | | | | | |____AbstractTag.php
| | | | | | | | |____Group.php
| | | | | | | | |____UseTag.php
| | | | | | | | |____Text.php
| | | | | | | | |____Rect.php
| | | | | | | | |____LinearGradient.php
| | | | | | | | |____Circle.php
| | | | | | | | |____Polygon.php
| | | | | | | | |____ClipPath.php
| | | | | | | | |____Ellipse.php
| | | | | | | | |____StyleTag.php
| | | | | | | | |____Shape.php
| | | | | | | | |____RadialGradient.php
| | | | | | | | |____Path.php
| | | | | | | | |____Polyline.php
| | | | | | | | |____Image.php
| | | | | | | | |____Stop.php
| | | | | | | | |____Anchor.php
| | | | | | | |____Document.php
| | | | | |____README.md
| | | | | |____LICENSE
| | | | | |____composer.json
| | | | | |____AUTHORS.md
| | | |____sabberworm
| | | | |____php-css-parser
| | | | | |____src
| | | | | | |____Parser.php
| | | | | | |____Position
| | | | | | | |____Positionable.php
| | | | | | | |____Position.php
| | | | | | |____Property
| | | | | | | |____Import.php
| | | | | | | |____AtRule.php
| | | | | | | |____Charset.php
| | | | | | | |____CSSNamespace.php
| | | | | | | |____Selector.php
| | | | | | | |____KeyframeSelector.php
| | | | | | |____OutputFormat.php
| | | | | | |____Settings.php
| | | | | | |____Comment
| | | | | | | |____Commentable.php
| | | | | | | |____Comment.php
| | | | | | |____CSSElement.php
| | | | | | |____CSSList
| | | | | | | |____KeyFrame.php
| | | | | | | |____AtRuleBlockList.php
| | | | | | | |____CSSBlockList.php
| | | | | | | |____CSSList.php
| | | | | | | |____Document.php
| | | | | | |____Renderable.php
| | | | | | |____RuleSet
| | | | | | | |____AtRuleSet.php
| | | | | | | |____RuleSet.php
| | | | | | | |____DeclarationBlock.php
| | | | | | |____Value
| | | | | | | |____CalcRuleValueList.php
| | | | | | | |____RuleValueList.php
| | | | | | | |____LineName.php
| | | | | | | |____CSSFunction.php
| | | | | | | |____PrimitiveValue.php
| | | | | | | |____URL.php
| | | | | | | |____CalcFunction.php
| | | | | | | |____CSSString.php
| | | | | | | |____Size.php
| | | | | | | |____Value.php
| | | | | | | |____ValueList.php
| | | | | | | |____Color.php
| | | | | | |____Rule
| | | | | | | |____Rule.php
| | | | | | |____Parsing
| | | | | | | |____UnexpectedEOFException.php
| | | | | | | |____ParserState.php
| | | | | | | |____SourceException.php
| | | | | | | |____OutputException.php
| | | | | | | |____UnexpectedTokenException.php
| | | | | | | |____Anchor.php
| | | | | | |____OutputFormatter.php
| | | | | |____README.md
| | | | | |____LICENSE
| | | | | |____composer.json
| | | | | |____CHANGELOG.md
| | | |____masterminds
| | | | |____html5
| | | | | |____LICENSE.txt
| | | | | |____src
| | | | | | |____HTML5
| | | | | | | |____Serializer
| | | | | | | | |____README.md
| | | | | | | | |____HTML5Entities.php
| | | | | | | | |____RulesInterface.php
| | | | | | | | |____Traverser.php
| | | | | | | | |____OutputRules.php
| | | | | | | |____InstructionProcessor.php
| | | | | | | |____Entities.php
| | | | | | | |____Parser
| | | | | | | | |____README.md
| | | | | | | | |____TreeBuildingRules.php
| | | | | | | | |____EventHandler.php
| | | | | | | | |____ParseError.php
| | | | | | | | |____UTF8Utils.php
| | | | | | | | |____CharacterReference.php
| | | | | | | | |____InputStream.php
| | | | | | | | |____Scanner.php
| | | | | | | | |____Tokenizer.php
| | | | | | | | |____DOMTreeBuilder.php
| | | | | | | | |____StringInputStream.php
| | | | | | | | |____FileInputStream.php
| | | | | | | |____Exception.php
| | | | | | | |____Elements.php
| | | | | | |____HTML5.php
| | | | | |____README.md
| | | | | |____RELEASE.md
| | | | | |____composer.json
| | | | | |____bin
| | | | | | |____entities.php
| | | | | |____UPGRADING.md
| | | | | |____CREDITS
| | | |____composer
| | | | |____autoload_static.php
| | | | |____autoload_classmap.php
| | | | |____LICENSE
| | | | |____ClassLoader.php
| | | | |____installed.php
| | | | |____InstalledVersions.php
| | | | |____autoload_psr4.php
| | | | |____autoload_real.php
| | | | |____installed.json
| | | | |____platform_check.php
| | | | |____autoload_namespaces.php
| | | |____autoload.php
| | |____AUTHORS.md
| | |____LICENSE.LGPL
| | |____autoload.inc.php
| | |____VERSION
| |____semantic_diff_engine.php
|____normalized
| |____671b5458b291529a79b1b49a3680e3de.txt
| |____0d601ce973234a38e32ffa26e87da77b.txt
| |____6fe9e24ed7e7cad9aac43a7aa1a3d4a6.txt
| |____7727e38e2d8c6c90d15529a523c361b9.txt
| |____37c40dad0e9e264726c271e778de2268.txt
| |____8d22626e4b21fe3832550938c8604e33.txt
| |____769d6a7022bb3d2f417f09cb6a4dff2c.txt
| |____test.md
| |____test.md.json
| |____general
| |____9e421ae3e39e39b23cbc95e7251dbe8e.txt
| |____2068ae61307086e8de56adfcc68b4208.txt
| |_____state_s_69e83e696108b.json
| |_____state_s_69e83ddc6794c.json
| |____49f6afc2932a71a7883888a4f12df4fe.txt
| |____239c59b98aefe4a9bb1b9e0a3a05a048.txt
| |____d98c33e2461a2a180889967b84d644a0.txt
| |____20260422_015914_server_sys_build_4-21-26.md
| |____1b41970a822fb43eaf6c74a063e92821.txt
| |____feb77ed7a1db3c8fb68a1d5970b3a3a2.txt
| |____c3578eb92771b983b80098145e580850.txt
| |____1e6525d9d9c8398fc66beecc4445dc2e.txt
| |____b4e00a49f6a0e602be8a8117c8565d6f.txt
| |____c14fb342c0d3ca88aa4a626a870ac66d.txt
| |____index_meta.json
| |____legaisee
| | |____Carr_Multimedia
| | | |____20260426_224234_Test_Title.txt
| | |____acme_test
| | | |____20260426_224641_pricing_audit.txt
| |____20260422_015914_server_sys_build_4-21-26.md.json
| |____b71b11bbf2318b12b591776ef5d9baea.txt
| |_____state_s_69e83d41012c9.json
| |____8cdd9251de98033ed09d415a1bc68584.txt
| |____a9791612870c9d93dfc7eaeff122c2f1.txt
| |____72810ab3f5d11b4d37dca1b08a7bb329.txt
| |____da559865f1c37e8289002cd75e108b45.txt
| |____3dc3883878bc265b1a1463014dc76eb9.txt
| |____9ec5a42c90fb7ba25f45250bb6f1bfdf.txt
|____session.php
|____view_ingest.php
|____archive
```


<a id="doc-47"></a>
## 47. OS Contents.txt

*Source: `OS Contents.txt` · 5266 bytes · 100 lines · encoding normalized to UTF-8*

```text
·Client prospect management
·Surface scrape/survey site- lead magnet
·Custom pitch for $2k shallow dig entry
·Shallow dig execution/scrape
·Ingest system- ingest artifacts, sort, store per client
·Analyze shallow dig/artifacts, detect patterns, relations
·Report on shallow dig-problems, competitor, market research, suggest how to improve
·Pitch full excavation dig - why, what, who, preserve biz legacy, institutional memory, benefits, what if, what if not.
·Execute full dig - 40+ channels, ingest, analyze,mreport, company history, use everything in system for full dig
·Create athurity marketingsystem from full dig info. Channels, content, calendar, etc. the entire promised Authority System to get business back to golden year authority.
·Execute authority system and monitor progress over time and suggest and make adjustments

More things to consider.
 In addition to i want legaisee os to match website visually. https://www.legaisee.com/commissions.html. 

Features. 
See every component of system on every client, file, resource, artifact, legaisee etc. data is data. Everything should see it and report something to the human ui for me. 

Live client dashboard. Real time project everything.from Found artifact to final bill. Client included in everything legaisee concerning him. 

Good morning logic- good morning john. Last night x. To do today,y, tonight system will z.

 Automatic prompts(prompt section in dash/ui) where ai can help with to-do,/sys builds / sys maintenence / dig info etc 

Yearly review dossier for clients with legaisee for 12 months.

 Llm prompts for digs. So what can be automaded in a dig can do so thru llm with web access. 

Can llms connect to system. Whats the cost. 

Daily am client only report Daily am system report 

Daily suggestion report 

Legaisee voice interface 

Monitor client pipeline. From onboarding to final payment. 

Monitor for errors, missed steps, new suggestions, effocienct checks etc. 

main delivery for os v1 is business history restoration and a step by step business authority marketing system based on proof of legacy marketing tatics that worked in the past. 

New system uses those artifacts as proof for new concepts of new system. 

V1 add on is CAMERA SYSTEM only. 

Marketing quote: “THE MARKET AND TRENDS CHANGE OFTEN. STAY TRUE TO WHO YOU HAVE ALWAYS BEEN AND THE MARKET WILL COME TO YOU. THAT IS AUTHORITY” 

Mornings-wake, read report, decide, system executes for itself and for the business side of legaisee. Including approved builds build themselves. 

Legaisee should become a digital assistant for business execution and a digital systems engineer for itself. 

Compounding business memory for legaisee and all clients. 

System designs and runs archaeology digs and where it looks. 
I just execute what the system can not. Eg. password protected sites. 

Estimate by end of year 1 total costs for server/servers, llm etc 

Can artifact library be local? Cloud like google, dropbox, etc. or does it need to stay on server. 

Is there an llm that can be deployed and work on server. 

Can legaisee technically eventually do what llms can? 

Original idea was to have llms do all heavy lifting of buisiness. 
Whats llm cost total for that. Can legaisee become that? 

Next llms finish their artifact dig then give me urls for manual digs with targets to look for. Next dump all artifacts and data into system. Sys analyzes, categorizes, stores etc then spits out all the deliverables. 

Priority 1 is the ui/human interface 
Priority 2 is project manager. 
But if 1 is completed and wired correctly then project mgr should already work along with everything else. 

Can legaisee be connected to web and browse/scrape like llms do. If so then it could do the archaeology digs. 

Adjust scope/plan to reflect this list.

DO YOU REMEMBER THE "NORTH STAR" CONVERSATION?
containing explinations of:

1. Core Kernel
2. Brain Layer
3. Modules
4. UI System
5. Data Layer
6. Tools
7. Project Manager
8. knowledge System
9. Client and Case intake
10. Support 3rd Party


Phasing:
·V1 — Master OS/UI replacing Grand Lobby (Command View, Case/Client View, Excavation Queue, Vault & Delivery, System Health), visually matching the LEGAiSEE site, basic live client dashboard, simple "good morning" summary view — all wired to the real backend that's now complete
·V2 — Automated daily reports, in-dashboard AI prompts, full pipeline monitoring, yearly dossiers, compounding knowledge system, the Authority Marketing System module, 3D graph upgrade
·V3 — Autonomous digs, self-building system, voice interface
·Research track — LLM cost modeling, artifact storage architecture, model-independence question
·CAMERA Authority System™ — correctly filed as a service deliverable (tenth methodology pillar), not a build item
Backend status: all eight original work orders complete, WO-G needs live Stripe keys + SDK confirmation + one full test checkout run before it's truly live.
Next step is screen/IA design for the V1 Master OS/UI itself. Want to start with the Command View (the direct Grand Lobby replacement), or with the overall navigation/shell structure that all five areas sit inside?
```


<a id="doc-48"></a>
## 48. +Legaisee-gpt audit sys.md

*Source: `_governance/Docs/+Legaisee-gpt audit sys.md` · 5167 bytes · 250 lines · encoding normalized to UTF-8*

Good — this is the correct move. You’re building a sellable front-end asset, not a backend system.
I’m going to give you all three pieces in a way you can use immediately tomorrow, not theory.

1️⃣ 📄 COPY-PASTE AUDIT TEMPLATE (GOOGLE DOC READY)
Use this exactly as your deliverable. No redesign yet — speed > polish.

SURFACE ARCHAEOLOGY AUDIT
Business: [Name]
Location: [City]
Date: [Date]

1. ARTIFACTS ANALYZED
Website:
[URL]
Reviews (Google/Yelp):
[URL]
Social Presence:
[URL]

2. WHAT WE FOUND
Website Messaging:
[Headline summary]


[Core offer]


[Tone / positioning]


Customer Perception (Reviews):
Positive themes:


[Theme 1]


[Theme 2]


Negative themes:


[Theme 1]


[Theme 2]


Social Activity:
Posting frequency:


Content type:


Engagement level:



3. KEY DISCONNECT
This is the most important section.
Example:
The business presents itself as premium and high-touch, but customer reviews consistently describe rushed service and inconsistent communication.

4. BURIED OPPORTUNITY
Example:
Customers repeatedly praise [specific strength], but this is not reflected anywhere in the website or social messaging — meaning a strong trust-building asset is being underutilized.

5. TRUST BREAKDOWN POINT
Example:
Negative reviews indicate uncertainty around pricing and expectations, which creates hesitation before booking.

6. WHAT THIS IS COSTING
Example:
This disconnect is likely reducing conversion from interested visitors into paying customers, especially those comparing multiple providers.

7. RECOMMENDED NEXT STEP
This is your upsell trigger.
Example:
A deeper Business Archaeology Audit would map messaging, customer perception, and content strategy across all platforms to rebuild alignment and increase conversion.

2️⃣ 🧠 CATEGORY-SPECIFIC PROMPT PACKS
These are optimized so you don’t have to think — just swap names.

🍽️ RESTAURANTS — ANALYSIS PROMPT
Use with Google Gemini or Claude (Anthropic)
Analyze this restaurant’s online presence.

Focus on:
- Alignment between menu/branding vs customer reviews
- Consistency between food quality perception and social media presentation
- Any mismatch between atmosphere expectations vs actual experience

Identify:
1. One major disconnect
2. One underutilized strength
3. One issue likely affecting repeat customers


🦷 DENTISTS — ANALYSIS PROMPT
Analyze this dental practice’s online presence.

Focus on:
- Trust signals vs patient concerns
- Clarity of services and pricing
- Emotional tone (fear vs reassurance)

Identify:
1. One trust gap
2. One missed credibility opportunity
3. One factor likely preventing new patient bookings


🏠 REAL ESTATE — ANALYSIS PROMPT
Analyze this real estate agent’s online presence.

Focus on:
- Personal brand vs listing quality
- Consistency of activity and authority
- Trust and expertise signals

Identify:
1. One positioning weakness
2. One credibility gap
3. One missed opportunity to generate leads

🔧 GENERAL SERVICE BUSINESSES
Analyze this business using a Business Archaeology lens.

Focus on:
- Promise vs delivery (reviews)
- Differentiation vs competitors
- Clarity of offer

Identify:
1. One major inconsistency
2. One hidden strength
3. One conversion barrier

3️⃣ 🖥️ COMMAND CENTER (YOUR IFRAME SETUP)
This is your fast manual workflow UI.
You were on the right track — here’s how to structure it so it actually works.

🔲 SIMPLE 4-PANEL LAYOUT
LEFT → DISCOVERY
Perplexity AI


TOP RIGHT → ANALYSIS
Google Gemini


BOTTOM RIGHT → STRUCTURING
OpenAI (ChatGPT)


BOTTOM LEFT → YOUR SYSTEM
Your upload / archive interface



🔁 WORKFLOW (FAST LOOP)
Enter business → Perplexity


Grab URLs


Open artifacts in new tabs


Copy content → Gemini/Claude


Copy insights → ChatGPT


Paste into your template


Export → upload to your DB


👉 This should take 15–25 minutes total

⚠️ REALITY ABOUT IFRAMES
Some platforms block embedding (X-Frame-Options), so:
If iframe fails → just use split-screen tabs


Or embed a simple note-taking panel instead


👉 Don’t get stuck solving UI problems right now

🔥 YOUR FIRST REVENUE PLAY (DO THIS EXACTLY)
OFFER:
“Free 3-Artifact Scan”
Then:
“I found something you’ll want to see — I can send a quick breakdown.”

DELIVERY:
Use template above


Keep it 1 page


No fluff



PRICING LADDER:
Free → hook


$25–$50 → quick audit


$250+ → deep dive



🧠 FINAL STRATEGIC CORRECTION
Right now your instinct is:
“build system → then sell”
Flip it:
sell → refine → then systematize
Because:
Your real IP is pattern recognition


Not tooling



👉 NEXT MOVE
If you want to tighten this even further, I can:
 Turn this into a fillable form UI inside your site


Or  script your sales message + outreach angle


Or  design the deep-dive audit structure (your real money product)


Pick the next constraint — we’ll remove it.


