# A8 — Project Manager (S9, S12)

**Date:** 2026-10-29
**Scope:** `modules/pm_module.php` (the live screen), `ProjectManager/` (the standalone app, 94 PHP files / 8,170 lines excl. vendor / 30 MB with vendor).
**Method:** `pm_module.php` read in full and every table it writes traced to the dump; `ProjectManager` inventoried by directory, then its schema declaration, repositories, config, bootstrap, router and two entry pages read; both apps' status vocabularies compared element by element; every repository table name checked against the standalone app's own `schema.php`; a tree-wide search run for any link from the Live app to `ProjectManager/`.
**Inputs:** `schema-source.sql`, `A4-ingest-excavation-review.md`, `A3-data-layer.md`.

---

## The two things, in one line each

**`modules/pm_module.php` works.** 922 lines, real HTML, real MySQL, three views (List / Board / Projects Board), full CRUD on tasks, project create + status, and AI-session linking. It renders **real HTML**, not a JSON dump — the best-built module in the audit so far.

**`ProjectManager/` is a second, larger application that shares the task table but not the project table** — and it cannot boot on this machine at all, because its config requires an absolute path outside the project.

---

## 1. Live PM screen — `modules/pm_module.php`

**Tables it uses (all verified present):**

| Table | Operations | Purpose |
|---|---|---|
| `projects` | `SELECT id,name,status` (`:311`), `INSERT` (`:99`), `UPDATE status` (`:120`) | Project list — **the wrong table, and the INSERT fails**: `domain_id` is `NOT NULL` and never supplied (see §3) |
| `pm_tasks` | `INSERT` (`:157`), `UPDATE` ×2 (`:256`, `:286`), `DELETE` (`:299`), `SELECT` (`:339`, `:358`) | Tasks |
| `task_sessions` | `INSERT` (`:176`, `:207`), `DELETE` (`:229`), `SELECT` (`:374`) | Task ↔ AI-session join |
| `memory_ingest` | `UPDATE processed = 1` (`:184`, `:215`), `SELECT` unprocessed (`:326`) | Session linking |

Every statement is prepared; `project_id` and `task_id` are `intval()`'d; statuses are whitelisted against `$STATUSES` (`:22`) and `$PROJECT_STATUSES` (`:27`) before writing. A stale `project_id` is caught by an existence check (`:144`, `:248`) and the task is created unlinked with a warning rather than throwing an FK error — deliberate and correct.

**What it does well:** one page, no reload between List/Board/Projects-Board (JS view switch), drag-and-drop status updates on both boards via `fetch`, a task-detail modal backed by a pre-serialised `$tasks_json` (`:405`) so clicking a task costs no round trip, and JSON encoded with `JSON_HEX_TAG|HEX_AMP|HEX_APOS|HEX_QUOT` (`:815`) — the only place in the audit using hex flags.

**Defects:** the project CRUD targets `projects` (A8-001); `updated_at` is never set on task update (A8-006); error messages echo `$e->getMessage()` into the flash (A8-007); `pm_tasks.source_ingest_id` exists in the schema but the module uses a separate `task_sessions` table for the same relationship, so two mechanisms coexist and the column stays empty (A8-008).

---

## 2. `ProjectManager/` — what it is and whether it runs

**Shape:** a full layered application — `app/Core` (Application, Container, Database, Dispatcher, ExceptionHandler, Request, Response, Router), `app/Repositories` (15 classes), `app/Models` (11), `app/Controllers` (11), `app/Policies`, `app/Services`, `app/middleware`, `app/jobs`, `app/events`, `database/{migrations,schema,seeders,triggers,views,functions}`, `api/` with **21 endpoint directories** (`tasks, projects, subtasks, milestones, comments, labels, notes, attachments, customfields, timeline, activity, search, reports, calendar, automations, graph, cases, intelligence, ingest, clients, members`), plus `permissions.php` with a 40-entry permission registry.

| Question | Answer |
|---|---|
| Entry points | `index.php` → `router.php`; plus two standalone pages, `projects_dashboard.php` and `project_board.php` |
| Is the router wired? | **No.** `router.php:16-17` — *"Application routes will be registered here"* and nothing is registered. `index.php` boots an `Application` with zero routes |
| What actually works | The two standalone pages: `projects_dashboard.php` (create + list projects) and `project_board.php` (Kanban / List / Calendar per project, create task, drag to move) |
| Database | **A separate credential file at an absolute path outside the project:** `config.php:4` `require '/home/carmulti/private/pm_db_credentials.php'`. Absent → fatal on the first require, so **nothing in `ProjectManager/` can execute on this machine** |
| Auth | **None.** `projects_dashboard.php:16-18`: *"There is no login system yet, so there is no 'current user'"* — it auto-creates an owner `John Carr / admin@legaisee.local` on first run (`:31-35`). `AuthController` exists and calls `session_start()` (`:69,85,102`) but no page or API uses it |
| Linked from the Command Center | **No.** A tree-wide search for `ProjectManager` outside its own directory returns **zero** hits |
| Views / Components layer | `app/Views` **empty**, `app/Components` **empty** — the UI is the two PHP pages, not a view layer |
| Schema drift inside the app | `database/schema.php` declares 13 tables, but the repositories query `project_members` (6), `labels` (4), `node_details` (2) and `tree_nodes` (4) — the first three are **not declared in `schema.php`**, and `project_members` and `labels` **do not exist in the live database at all** (only `node_details` and `tree_nodes` do) |

---

## 3. The `pm_tasks` / `projects` mismatch

This is the block's central finding, and it is worse than a naming inconsistency.

```php
modules/pm_module.php:157   INSERT INTO pm_tasks (project_id, …)   -- project_id = projects.id
ProjectManager/app/Repositories/TaskRepository.php  FROM pm_tasks    -- project_id = pm_projects.id
```

**Both applications write the same `pm_tasks` table, and both put a different parent table's id into `project_id`.**

| | Live screen (`pm_module.php`) | Standalone (`ProjectManager/`) |
|---|---|---|
| Parent table | **`projects`** — `(id, domain_id, slug, name, description, status, created_at, updated_at)` | **`pm_projects`** — `(id, uuid, name, description, status, color, owner_id, start_date, due_date, created_at, updated_at)` |
| Task table | `pm_tasks` | `pm_tasks` |
| Rows in dump | `projects` 1, `pm_tasks` 1 | `pm_projects` 1, `pm_tasks` 1 |
| Task statuses | `Backlog, Architecting, Building, Review, Blocked, Done` (`:22`) | `Backlog, In Progress, Blocked, Done` (`project_board.php:74`) |

`projects` is **not a project-management table**. It carries `domain_id` and a `slug`, which makes it a domain-scoped registry — and `ProjectManager/database/schema.php:47-50` says so explicitly:

> *"This database is shared with the main LEGAiSEE Command Center app, which already has its own unrelated `projects` and `tasks` tables (a domain/business registry, not project-management data) — the prefix keeps ProjectManager's schema from ever colliding with it."*

So the standalone app was deliberately built **against** `pm_projects`, and the live screen was built **on top of** the registry table the other app warned about. And `pm_module.php:99` never supplies `domain_id`. The dump settles what that costs:

```sql
`domain_id` int(11) NOT NULL,
`slug`      varchar(191) NOT NULL,
```

`domain_id` is **NOT NULL with no default**, so `INSERT INTO projects (name, slug, description, status, created_at)` throws `Field 'domain_id' doesn't have a default value`. It is caught at `:105` and surfaced as a red "DB error" flash (`:106`). **Creating a project on the live screen does not work** — the one write the screen's sidebar is built around.

**Three concrete consequences, all provable from source:**

1. **Cross-linked tasks.** A task created on the live screen stores `projects.id` in `project_id`; `ProjectManager` reads that column as `pm_projects.id`. With one row in each table the ids coincide (both `1`), so today it looks fine — it will silently misfile the first time either table grows.
2. **Invisible tasks.** `project_board.php:69` fixes four columns, then only renders those four (`:268` `foreach ($columns as $status)`). The grouping at `:77-80` tolerates unknown statuses, but nothing renders them — so tasks in `Architecting`, `Building` or `Review` (three of the live screen's six states) **never appear on the standalone Kanban**.
3. **Two different "projects".** Creating a project in the Command Center writes `projects`; creating one in `ProjectManager` writes `pm_projects`. Neither list shows the other's rows. The same user, on the same database, maintains two disjoint project lists.

---

## 4. Finished vs missing in `ProjectManager/`

| Area | State | Evidence |
|---|---|---|
| Core framework | **Finished** | 8 classes in `app/Core`, PSR-4 autoloader, DI container, exception handler |
| Repositories / models | **Finished** | 15 repositories, 11 models, prepared statements |
| Permissions registry | **Finished** | 40 permissions in `permissions.php`; 5 auth tables declared |
| Schema / migrations / seeders / triggers / views | **Present** | `database/{schema,migrations,seeders,triggers,views,functions}` |
| Router | **Empty** | `router.php:16-17` registers nothing |
| Views layer | **Missing** | `app/Views` 0 files, `app/Components` 0 files |
| Auth enforcement | **Missing** | `AuthController` exists; no page or API calls it; dashboard auto-creates an owner |
| API endpoints | **Built, unguarded, unrouted** | 21 directories; no auth call in `api/tasks/index.php` or `api/projects/index.php` |
| Config portability | **Broken** | Absolute `require '/home/carmulti/private/pm_db_credentials.php'` |
| Schema declaration | **Stale** | `project_members`, `labels`, `node_details` queried but undeclared |
| Deployment target | **Unknown** | Separate credentials file implies a separate DB; the DB name is not in the repo |

**Verdict: roughly 70% of a framework, 0% of a deployed application.** It is a scaffold with real repositories and no routing, no auth, no views, and no reachable configuration.

---

## 5. Can the two share one data model?

**Yes — and they already share half of it by accident.** `pm_tasks` matches `ProjectManager`'s declaration column for column:

```
pm_tasks: id, project_id, title, detail, status, priority, due_date,
          blocked_reason, source_ingest_id, created_at, updated_at
```

Both apps write every one of those columns except `source_ingest_id`. The only conflict is the **parent table** and the **status vocabulary**. That is two decisions, not a redesign.

**Recommended single model** — `pm_projects` as the one parent, because:
- `pm_tasks.project_id` is already documented against it in the standalone app, and the live screen's `pm_tasks` writes are otherwise compatible;
- `pm_projects` carries the fields a PM needs (`uuid`, `owner_id`, `color`, `start_date`, `due_date`) that `projects` lacks;
- it leaves `projects` free to remain the domain registry it was designed as, which stops PM data polluting it;
- the live screen needs `name`, `description`, `status`, `id` — all present in `pm_projects`.

**Status vocabulary** — adopt the live screen's six (`Backlog, Architecting, Building, Review, Blocked, Done`) as canonical, because it is the one users already see and it is richer; then widen `project_board.php:69`'s `$columns` to match. The project-level lifecycle (`intake…archived`, `:27-28`) has no counterpart in the standalone app and needs no change.

---

## 6. Smallest path to a working PM screen in V1

**Nothing needs to be rebuilt. One file changes table.**

`modules/pm_module.php` already renders a complete, real-HTML PM screen with working CRUD. The minimum to make it correct and to end the split:

1. **Repoint project CRUD from `projects` to `pm_projects`** — five sites: `:70` (slug uniqueness), `:99` (INSERT), `:120` (UPDATE status), `:311` (list), and the `LEFT JOIN projects p` at `:358`. Supply `uuid`, `owner_id`, `color` defaults on INSERT.
2. **Drop the slug generator** (`pm_generate_unique_slug`, `:61-76`) or move it onto a `slug` column — `pm_projects` has no slug; on `pm_projects`, uniqueness is the uuid.
3. **Leave `pm_tasks`, `task_sessions` and `memory_ingest` untouched** — they are already correct and correctly joined.
4. **Decide `ProjectManager/`'s fate separately** (ARCHIVE is the honest verdict: it is unreachable, unconfigured, unauthenticated and unrouted). Do not delete it; it is the only place the richer project model is written down.

This also clears A8-001 for free: `pm_projects` has no `domain_id`, so the failing INSERT starts working as soon as it targets the right table. That is 5 line-level edits in 1 file, no schema migration, no new code. After it, the project list, task board, projects board, task modal and session linking all remain as they are today, and the two apps stop disagreeing about what a project is.

---

## 7. Files table

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `modules/pm_module.php` | Live PM workspace: projects, tasks, boards, session links | WORKS-WITH-DEFECT | A8-001 `:99` INSERT omits `NOT NULL domain_id` → project creation always fails; A8-011 `:70,311,358` writes/reads `projects` (a domain registry) as the task parent; A8-006 `:256-268` never sets `updated_at`; A8-007 `:106,123,297` echo SQL messages to the UI; A8-008 `:157` ignores `pm_tasks.source_ingest_id` in favour of `task_sessions` | Repoint the five sites to `pm_projects` | P1 |
| `ProjectManager/config.php` | App config; loads DB credentials | BROKEN | A8-002 `:4` absolute `require '/home/carmulti/private/pm_db_credentials.php'` → fatal wherever that path is absent; `debug => true` in `environment => production` (`:10-11`) | Move credentials into the project's own config | P1 |
| `ProjectManager/router.php` | Registers routes and runs the app | UNWIRED | A8-003 `:16-17` no routes registered; `index.php` boots an empty app | Register the built controllers, or archive | P1 |
| `ProjectManager/projects_dashboard.php` | Create + list projects | WORKS-WITH-DEFECT | A8-004 `:16-35` auto-creates a hard-coded owner because "there is no login system yet"; no auth | Gate behind the app's auth | P1 |
| `ProjectManager/project_board.php` | Per-project Kanban / List / Calendar | WORKS-WITH-DEFECT | A8-005 `:69,268` only four statuses; tasks in Architecting/Building/Review are silently invisible | Widen `$columns` to the canonical six | P1 |
| `ProjectManager/database/schema.php` | Declares the app's tables | WORKS-WITH-DEFECT | A8-009 declares 13 tables; `project_members`, `labels`, `node_details` are queried by repositories but undeclared | Reconcile with the repositories | P2 |
| `ProjectManager/app/**` (Core, Repositories, Models, Controllers) | Framework + data layer | UNWIRED | A8-010 21 API dirs, no auth guard, no route binding | Keep as reference | P2 |

---

## 8. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A8-001 | `modules/pm_module.php:99` | `INSERT INTO projects` omits `domain_id`, which is `int(11) NOT NULL` with no default → **every project creation fails**; the flash at `:106` prints the SQL error | **P0** | PM screen |
| A8-011 | `modules/pm_module.php:70,311,358` | Project CRUD targets `projects` (domain registry) while `pm_tasks.project_id` is documented against `pm_projects` → task parentage is two tables at once | P1 | PM correctness |
| A8-002 | `ProjectManager/config.php:4` | `require '/home/carmulti/private/pm_db_credentials.php'` — absolute path outside the project; absent → the whole app fatals | P1 | ProjectManager boot |
| A8-003 | `ProjectManager/router.php:16-17` | No routes registered; `index.php` runs an empty application | P1 | ProjectManager routing |
| A8-004 | `ProjectManager/projects_dashboard.php:16-35` | No login system; auto-creates owner `John Carr / admin@legaisee.local` on first run | P1 | Auth |
| A8-005 | `ProjectManager/project_board.php:69,268` | Kanban renders only 4 statuses; `Architecting`, `Building`, `Review` tasks never appear | P1 | Data visibility |
| A8-006 | `modules/pm_module.php:256-268` | `UPDATE pm_tasks` never touches `updated_at` | P2 | Audit trail |
| A8-007 | `modules/pm_module.php:106,123,297` | SQL exception text echoed into the operator flash | P2 | Info leak |
| A8-008 | `modules/pm_module.php:157` vs `:176` | `pm_tasks.source_ingest_id` exists but is never written; `task_sessions` duplicates the relationship | P2 | Redundant model |
| A8-009 | `ProjectManager/database/schema.php` | Declares 13 tables; repositories query `project_members`, `labels`, `node_details` — none declared, and `project_members`/`labels` are absent from the live schema entirely | P2 | Schema drift |
| A8-010 | `ProjectManager/api/**` | 21 endpoint directories, no auth call, no router binding | P2 | API reachability |

---

## 9. Limits

- **`ProjectManager/` was never executed.** A8-002 is proven by reading `config.php:4`; the credentials file's absence was inferred from it being an absolute path outside the project, not by running the page.
- The standalone app's actual database name is **not in the repository** (it lives in that external credentials file), so "separate DB" vs "same DB, different tables" could not be settled. The schema comment claims shared-database, and the live dump does contain its `pm_*` tables — consistent, but not proof.
- The concrete cross-link failure (A8-001) is latent: both `projects` and `pm_projects` currently hold exactly **1** row each, so their ids coincide today. The defect is in the model, and it triggers on the second project either app creates.
- `pm_module.php` was read in full; the 94 files of `ProjectManager` were inventoried and sampled (schema, config, bootstrap, router, both entry pages, repository table names) — not every controller and repository was read line by line.
- Row counts come from `INSERT` statements in the dump, not from the live database.
- `projects.domain_id` was confirmed `int(11) NOT NULL` (no default) from the dump, so A8-001 is a hard failure, not a possibility. The dump is a `mysqldump` of the production schema; a live `SHOW CREATE TABLE` could in principle differ.
- No source file was modified.

---

### Legend
**Status** — `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD`.
**Severity** — `P0` blocks V1 / security hole · `P1` wrong results · `P2` cosmetic/cleanup.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions proposed.
