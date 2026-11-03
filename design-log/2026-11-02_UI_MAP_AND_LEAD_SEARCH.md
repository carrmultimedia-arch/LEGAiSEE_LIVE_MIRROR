# LEGAiSEE design log: 2026-11-02

Status: proposed by Claude, requested by John to be logged and applied. Anything here can change. This is a record of the current direction, not a rule that blocks a new one.

## Problem

The current Grand Lobby groups about 35 modules by what the code is (Intelligence Engines, Graph & Entities) instead of what John does in a day. Everything is crammed into one command center, and reaching the first dashboard takes a long web address.

## Daily business execution menu

The top menu follows the order a client moves through the business. Each stage is its own page.

| Stage | What you do there | Modules folded in |
|---|---|---|
| Home | Good morning page: what needs you today, money, what ran overnight | cockpit, dashboard, intelligence_dashboard, executive, alert |
| Leads | Find and win clients | prospect.php (Prospect Dig, standalone), lead forms and contacts (planned), lead search (planned) |
| Clients | Board of every client by stage, one page per client | clients, cases, client_view (opens from a client card) |
| Intake | Bring material in | ingest, ingest_view, files, search, vault |
| Dig | Find and verify | excavation, dig_review |
| Insights | One page, four tabs | Map: graph, entity_resolution, relations. Patterns: cluster, semantic_cluster, cross_case_engine. Risks: anomaly_engine, root_cause. Next Moves: recommendation, decision, predictive, predictive_link_module_v1, time_intelligence, insight |
| Deliver & Get Paid | Finish and collect | report, payment |
| Calendar & Tasks | Your week | pm |
| Back Room (small icon, not in the menu) | The only place "how" lives | brain, compare, view, system health and settings (planned) |

All 35 entries in kernel/module_registry.php are placed above.

## Lead search (Leads stage, built later)

A whole pipeline, not only a website analyzer. John does not know where family and generational owners show up online, so the search must cover everything and report which places pay off.

1. Find: sweep Google listings, YouTube, Facebook and Instagram pages, directories (Chamber of Commerce, BBB), local news and plain web search. Also search the legacy wording itself: "family owned since", "third generation", "serving the area since".
2. Match up: merge the same business found in several places into one record, with the website and social pages attached.
3. Check: read the website and public records for years in business and family or generational signals (since-years, the About page, how far back the site goes, state registration date).
4. Score: a legacy score and one plain sentence of why.
5. Save: good ones go onto the Leads board with one click.
6. Hand off: a chosen lead goes into Prospect Dig.

Each result shows where it was found. After a few searches the system reports which sources produced the best family-business hits.

Known limits:
- Yearly gross and net are mostly not public for private businesses. Use size bands labeled as estimates (staff count, public loan records). Net income comes out in conversation or the shallow dig.
- Google, Facebook and Instagram often block automated searching. Use their official lookups. Some cost money or need approval. Confirm each before building.
- The current shared hosting cannot run long background searches. The first version runs when Search is pressed, in small batches.
- A search service is needed for the sweep and usually charges per search. Check cost first.

LeadsGorilla was the model John knew. His old login still works but its upgrades have no working functionality, so this is built in-house.

## Look and feel

The glass shell (home.html) is the starting point: pill top menu, frosted-glass cards, dark and light themes, a key-light switch (left or right) following the three-point lighting rule, a cursor spotlight on a few cards, and a slide-out detail panel. Colors and looks get tuned after the structure is in place. Reference templates John likes: Vitrea, Kerfa, Solvik and Selvar from codeandchill.store (paid templates, so the look is recreated, not copied).

## Open items

- Short front-door web address (John has not yet said what he types today).
- Confirm the stage order and names.
- Client stage board and client page, then move modules into their pages one stage at a time.
