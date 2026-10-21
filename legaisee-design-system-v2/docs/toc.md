LEGAiSEE LVOS MASTER TABLE OF CONTENTS (FULL FILE MAPPED)
PART 01 — PROJECT GOVERNANCE

1.01 Project Rules → governance/project-rules.md
1.02 Folder Structure → filestructure.md
1.03 Naming Standards → docs/corerules.md
1.04 Build Order → docs/build-order.md
1.05 Coding Standards → docs/corerules.md
1.06 Testing Standards → governance/development-contract.md
1.07 Release Standards → governance/governance_update_2026-06-26.md

PART 02 — LVOS CORE SYSTEM

2.01 Tokens → assets/css/lvos-tokens.css
2.02 Reset → assets/css/lvos-reset.css
2.03 Core → assets/css/lvos-core.css
2.04 Layout → assets/css/lvos-layout.css
2.05 Grid → assets/css/lvos-grid.css
2.06 Spacing → assets/css/lvos-spacing.css
2.07 Typography → assets/css/lvos-type.css
2.08 Utilities → assets/css/lvos-utilities.css
2.09 Environment → assets/css/lvos-environment.css
2.10 Navigation → assets/css/lvos-navigation.css
2.11 Footer → assets/css/lvos-footer.css
2.12 Components → assets/css/lvos-components.css
2.13 Objects → assets/css/lvos-objects.css

PART 03 — RUNTIME ENGINE (JS CORE)

3.01 Engine Core → assets/js/lvos-engine.js
3.02 Loader → assets/js/lvos-loader.js
3.03 Scroll System → assets/js/lvos-scroll.js
3.04 Camera → assets/js/lvos-camera.js
3.05 Motion → assets/js/lvos-motion.js
3.06 Light Engine → assets/js/lvos-light-engine.js
3.07 Material Engine → assets/js/lvos-material-engine.js
3.08 Navigation → assets/js/lvos-navigation.js

PART 04 — PAGE SYSTEM (PROTOTYPES)

4.01 Home → pages/prototypes/01_home.html
4.02 Reset → pages/prototypes/01-reset.html
4.03 Type → pages/prototypes/02-type.html
4.04 Archaeology → pages/prototypes/02_archaeology.html
4.05 Grid → pages/prototypes/03-grid.html
4.06 Frameworks → pages/prototypes/03_frameworks.html
4.07 Layout → pages/prototypes/04-layout.html
4.08 Who We Serve → pages/prototypes/04_who-we-serve.html
4.09 Environment → pages/prototypes/05-environment.html
4.10 Commissions → pages/prototypes/05_commissions.html
4.11 Light Engine → pages/prototypes/06-light-engine.html
4.12 Architect → pages/prototypes/06_architect.html
4.13 Materials → pages/prototypes/07-materials.html
4.14 Registry → pages/prototypes/07_registry.html
4.15 Objects → pages/prototypes/08-objects.html
4.16 Contact → pages/prototypes/08_contact.html
4.17 Motion → pages/prototypes/09-motion.html
4.18 Components → pages/prototypes/10-components.html
4.19 Navigation → pages/prototypes/11-navigation.html
4.20 Footer → pages/prototypes/12-footer.html
4.21 Complete Page → pages/prototypes/13-complete-page.html

PART 05 — DEMO SYSTEM (LVOS LIVE PAGES)

5.01 Home → pages/demos/01_home.html
5.02 Archaeology → pages/demos/02_archaeology.html
5.03 Frameworks → pages/demos/03_frameworks.html
5.04 Who We Serve → pages/demos/04_who-we-serve.html
5.05 Commissions → pages/demos/05_commissions.html
5.06 Architect → pages/demos/06_architect.html
5.07 Registry → pages/demos/07_registry.html
5.08 Contact → pages/demos/08_contact.html

PART 06 — LAB SYSTEM (DIAGNOSTICS LAYER)

6.01 Render Lab → pages/prototypes/90_render-lab.html
6.02 Material Lab → pages/prototypes/91_material-lab.html
6.03 Lighting Lab → pages/prototypes/92_lighting-lab.html
6.04 Component Lab → pages/prototypes/93_component-lab.html
6.05 Animation Lab → pages/prototypes/94_animation-lab.html
6.06 Performance Lab → pages/prototypes/95_performance-lab.html

PART 07 — SYSTEM DESIGN DOCUMENTATION

7.01 Build Order → docs/build-order.md
7.02 Core Rules → docs/corerules.md
7.03 Table of Contents → docs/toc.md
7.04 Page Registry → docs/pageregistry.md
7.05 Schema Hardening → docs/lvos/page-schema-hardening.md

PART 08 — BIBLE / GOVERNANCE LAYER

8.01 Project Bible → bible/project-bible.md
8.02 Governance Rules → governance/project-rules.md
8.03 Development Contract → governance/development-contract.md
8.04 Governance Update → governance/governance_update_2026-06-26.md

PART 09 — HANDOFF SYSTEM

9.01 Current Handoff → handoff/current-handoff.md
9.02 Timestamped Handoff → handoff/2026-06-26_LVOS-V2_HANDOFF.md

PART 10 — ASSET SYSTEM MAP

10.01 Images → assets/images/
10.02 Icons → assets/icons/
10.03 Textures → assets/textures/
10.04 Fonts → assets/fonts/

SYSTEM STATE AFTER THIS UPDATE

You now have:

FULL file registry coverage
NO orphaned modules
ALL labs mapped into prototype system (correct placement)
CORE + DEMO + LAB + GOVERNANCE fully indexed
IMPORTANT ARCHITECTURAL NOTE

This TOC now becomes:

THE SINGLE SOURCE OF TRUTH FOR LVOS NAVIGATION

Any future build must:

reference this index
update this index
never bypass it
NEXT LOGICAL STEP (OPTIONAL BUT RECOMMENDED)

We are now at a critical structural milestone:

OPTION A — PAGE REGISTRY SYNC

(generate machine-readable registry JSON for system enforcement)

OPTION B — LAB SYSTEM VISUAL INTEGRATION

(connect all labs into a single “Lab Index Dashboard” page)

OPTION C — ENGINE HARDENING PASS

(lock scroll, camera, light, motion into deterministic execution order)