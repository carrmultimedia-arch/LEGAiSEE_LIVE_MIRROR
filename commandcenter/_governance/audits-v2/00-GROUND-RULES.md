# Audit v2 — Ground Rules & Method Contract

**Established:** 2026-10-29 (Block A0)
**Workspace:** `commandcenter/_governance/audits-v2/`
**Authority:** these rules govern every subsequent block. Where a block instruction and this file disagree, the block instruction wins and this file is corrected.

---

## 1. A0 checklist — what was done

| # | Instruction | Status | Evidence |
|---|---|---|---|
| 1 | Create `_governance/audits-v2/` | DONE | directory exists |
| 2 | Copy dump to `schema-source.sql`, original untouched | DONE | `sha256 51b2e0c9…65c` identical for source and copy; source mtime still `2026-10-29 15:16:02`; original path with backticks unchanged |
| 3 | Read the three v1 artifacts as input, not proof | DONE | `AUDIT-COMMANDCENTER-2026-10-29.md` (271 lines), `AUDIT-APPENDIX-FILE-STATUS.md` (435 lines), `AUDIT-DATA-CONSOLIDATED.md` (8,133 lines, TOC + sampled sections). Nothing from them is quoted as evidence; every v2 verdict is re-derived. |
| 4 | Fixed report format | DONE | §3 below, plus `report-template.md` |
| 5 | DEAD requires proof, search stated alongside | DONE | `deadcheck.sh` + §5 below |

**Schema source identity:** 5,232,685 bytes · phpMyAdmin dump · server `5.7.44-percona` · generated `2026-10-29 20:16` · **51 tables** · 70 `INSERT` blocks.

**Correction to v1 already found in A0:** v1 §3.2 states "InnoDB/utf8mb4 (one MyISAM table)". The dump actually reads **31 × `ENGINE=MyISAM`, 20 × `ENGINE=InnoDB`**. That is the majority MyISAM, not one table. Consequence for later blocks: no transactions, no foreign-key enforcement, and crash-unsafe writes on most of the schema. v2 treats this as a P1 data-integrity defect, not a footnote.

---

## 2. Input trust level

| Artifact | Role in v2 |
|---|---|
| `AUDIT-COMMANDCENTER-2026-10-29.md` | **Index only.** Good for where to look; every claim re-verified before reuse. |
| `AUDIT-APPENDIX-FILE-STATUS.md` / `audit_files.csv` | **Starting ledger.** 347 rows. Statuses are v1's, not v2's, and are re-adjudicated per block. |
| `AUDIT-DATA-CONSOLIDATED.md` | **Context / prior findings.** Contain secondary prose, not runtime behaviour. Contains one known-fabricated doc (`SYSTEMAUDITREPORT.md`) — never cite it as code evidence. |
| `schema-source.sql` | **Proof** for anything about tables, columns, indexes, engines, and stored rows. |
| The source tree itself | **The only proof** for connections, defects, and deadness. |

---

## 3. Report format — every block

Exact table header, in this column order:

```
| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
```

Rules:

- **One row per file**, path relative to `commandcenter/`.
- **Purpose** is what the file does at runtime, not what its header comment claims. If header and behaviour disagree, the behaviour wins and the disagreement is a defect.
- **Status** is exactly one of: `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD`.
  - `WORKS` — reachable, executes, and produces correct output by inspection.
  - `WORKS-WITH-DEFECT` — reachable and functional, but has at least one recorded defect.
  - `BROKEN` — reachable or intended-reachable, and fails (fatal, wrong SQL, missing include).
  - `UNWIRED` — code is complete and correct but nothing loads or calls it.
  - `DEAD` — proven unreferenced (§5). Never assigned on suspicion.
- **Defects** — one line per defect, each prefixed with its ID, and each carrying `file:line`. A defect without a line number is not admissible; if the defect is the absence of a line, cite the line where the missing thing should be and say "absent".
- **Fix** — one line, imperative, naming the change not the goal.
- **Severity:**
  - `P0` — blocks V1 or is a security hole (auth bypass, credential exposure, path traversal, live fatal).
  - `P1` — produces wrong results, loses data, or breaks a documented capability.
  - `P2` — cosmetic, dead-weight, hygiene.

**Defect IDs:** `<BLOCK>-<NNN>` sequential per block, e.g. `A4-003`. IDs are permanent — never renumber or reuse, even if a defect is later fixed.

**Row order:** grouped by subsystem, then by path. Files with no defects still appear (Status `WORKS`, Defects `—`).

---

## 4. Verdict vocabulary — no deletions

| Verdict | Meaning |
|---|---|
| `KEEP` | Works as intended; leave it alone. |
| `FIX` | Small, bounded change to an existing file |
| `FINISH` | Deliberately incomplete; the work is defined and worth completing |
| `ARCHIVE` | Move to `_archive/`, keep recoverable. **Never delete.** |

This **overrides** v1's many `DELETE` recommendations. Where v1 said "delete-safe", v2 records `ARCHIVE` with the duplicate evidence, so the decision stays reversible.

---

## 5. The DEAD protocol (mandatory proof)

### 5.1 Rule
A file is `DEAD` only when the whole tree contains **zero execution references** to it. "No PHP `require`" is not enough. All of these count as a reference:

1. PHP `require` / `require_once` / `include` / `include_once`, literal.
2. Hand-built paths: `$file = __DIR__.'/modules/'.$registry[$name]`, `sprintf('%s_module.php',$x)`, `MODULE_DIR . $x`, `"engine/{$e}.php"`.
3. Registry/config arrays mapping a URL name to a filename (`kernel/module_registry.php`).
4. JavaScript and markup: `fetch('…')`, `href="…"`, `src="…"`, `action="…"`, `$.ajax`, `XMLHttpRequest`, `location.href`.
5. `.htaccess`, `.user.ini`, `web.config`, nginx conf — rewrites, `auto_prepend_file`, `ErrorDocument`, `php_value include_path`.
6. Config/JSON/INI (composer autoload, cron manifests, sitemaps).
7. Shell/task runners: `*.sh`, `*.bat`, `*.ps1`, crontab, `*.py`.

**Not references — quarantined, never counted:**

- **Generated file indexes.** `ExcavationCommand/system_index_cache.json` (and its `z_Deleted` twin) lists every file by `name` and `path`. It names 400+ files and calls nothing. Counting it would credit every file in the tree with a caller. Same treatment for `*_cache.json`, `index.json`, `inventory*.txt`.
- **Archive copies.** `.bak-*`, `z_Deleted/`, `_backup/` are adjudicated as archives, not as callers of live files.
- **Documentation.** `*.md`, `*.txt`, `*.sql`, `*.csv`, `_governance/` — reported as `DOC-ONLY n` only.

### 5.2 How it is run
```bash
bash _governance/audits-v2/deadcheck.sh <path> [<path>...]
bash _governance/audits-v2/deadcheck.sh --selftest   # must pass before any DEAD verdict
```
The script prints the seven reference classes with line numbers, a stem-only pass for registry and hand-built paths, and a `PROOF:` line that is pasted verbatim beside the DEAD verdict.

**Tooling note, recorded because it invalidated a first attempt:** ripgrep is **not installed on this host**. A first harness built on `rg` sent `rg: command not found` to `/dev/null` and reported `0 references` for every file tested — including `kernel/guard.php` and `engine/graph_engine.php`, which are referenced. A proof-of-deadness harness that fails silently is more dangerous than no harness, because it manufactures confident verdicts. The current version is `grep`-based, and any search that exits ≥ 2 (tool missing, directory unreadable) prints `PROOF: INVALID` and marks the whole run's verdicts untrustworthy. `--selftest` runs a positive control (`kernel/db.php`, must find references) and a negative control (`Color_Creator.php`, must find none) so the harness itself is verified before it is believed.

Documentation (`*.md`, `*.txt`, `*.sql`, `*.csv`, `_governance/`) is **excluded** from proof and reported separately as `DOC-ONLY n`. A file referenced only by docs is still DEAD-eligible, but the verdict says so explicitly, because those docs may be the only description of intent.

### 5.3 Known blind spots in v1 — the reason v2 exists
v1 called 277 files unreachable using include/call analysis only. Five systematic holes:

- **Registry dispatch.** `shell.php` builds the module path at runtime, so all 35 modules looked unreachable until the registry array was read by hand.
- **JS string URLs.** `api/*.php` endpoints are named only inside `<script>` blocks; a PHP-only search never sees them.
- **Duplicate basenames.** `graph_engine.php` exists twice, `bootstrap.php` five times, `recommendation_engine.php` twice, `cross_case_engine.php` twice. A search for the basename "proves" a reference that belongs to the *other* copy. **Every DEAD verdict on a duplicated basename must be proven by full relative path, and the copy that is referenced is stated explicitly.**
- **Tooling silence.** A search that cannot run returns no matches, and "no matches" reads exactly like "no references". Every proof must state the command, and the harness must fail loudly (§5.2).
- **Generated indexes counted as callers.** `system_index_cache.json` names every path in the tree. It is a snapshot of what exists, not what calls anything. A basename search that includes it makes every file look referenced; a harness that trusts it can never report DEAD. Quarantined in class `INDEX`.

**Proof therefore matches the full relative path**, with the bare basename shown only as a labelled ambiguity indicator. First-run evidence for both corrections: v2 of this harness credited `kernel/graph_engine.php` with the `api/v8/build_graph.php` include that actually names `engine/graph_engine.php`, and credited `kernel/guard.php`, `engine/plain_english_helper.php` and `modules/governance_module.php` with 2 "live refs" that were both lines of `system_index_cache.json`.

### 5.4 Verdict discipline
- Evidence next to the verdict, always: the `PROOF:` line and the command that produced it.
- If the reference count is > 0, the file is not DEAD. It is `UNWIRED` (caller itself dead) or `WORKS-WITH-DEFECT`. Classify the caller, not the target.
- Archive copies (`.bak-*`, `z_Deleted/`, `_backup/`) are adjudicated as archive, not dead code, and never counted as callers of live files.
- A 0-byte file is `BROKEN`, not `DEAD` — it exists to be loaded and cannot be.

---

## 6. Standing invariants for every block

1. **No source file under audit is modified** during measurement. Repairs happen only in a block that explicitly asks for them.
2. **No deletes.** Max verdict is `ARCHIVE`.
3. **`schema-source.sql` is read-only.** Queries run against a restored copy, never the original and never against production.
4. **Line numbers are from the file as it exists at audit time**, recorded with the file hash so a later edit cannot silently invalidate a finding.
5. **Word "works" is reserved** for behaviour actually read in the source. Nothing is described as working because a comment says so.
6. **Secrets are never reproduced.** `config.local.php` / `sftp.json` findings cite the key name and line only.

---

## 7. Workspace layout

```
_gov/audits-v2/
  schema-source.sql        copy of the pre-migration dump (read-only input)
  00-GROUND-RULES.md       this file
  report-template.md       the empty table + legend, for every block
  deadcheck.sh             DEAD-proof harness
  <block-id>/              per-block outputs, one directory each
```

v1 artifacts stay where they are; they are inputs, never overwritten.

---

## 8. Corrections log

Found during A0 setup, before any file was adjudicated. Each one changes how a later block must be written.

| # | Claim being corrected | v2 finding | Evidence | Effect |
|---|---|---|---|---|
| C-01 | v1 §3.2: “InnoDB/utf8mb4 (one MyISAM table)” | **31 of 51 tables are MyISAM**, 20 InnoDB | `grep -oE 'ENGINE=[A-Za-z]+' schema-source.sql \| sort \| uniq -c` → `31 MyISAM`, `20 InnoDB` | P1: no transactions and no FK enforcement across the majority of the schema. Any migration block must state engine per table. |
| C-02 | v1 §5 item 6 and SEC-01/02: credentials are “tracked” in git | **Nothing under `commandcenter/` is tracked.** `git ls-files commandcenter` = 0 files; `config.local.php` and `sftp.json` are untracked; repo has 2 commits; only `commandcenter/.gitignore` (129 b) exists, no root ignore file | `git ls-files`, `git ls-files --error-unmatch` | The exposure is **on-disk and in any deploy/backup archive** (`Legaisee_Live.zip` sits untracked at repo root), not in git history. Remediation is rotate + exclude from archives, not history rewriting. Still P0. |
| C-03 | v1 appendix “First caller / evidence” column | It does not distinguish a **live** caller from a dead one. `kernel/db.php` is credited to `api.php` (itself unreachable); `engine/entity_extraction_engine.php` is marked `REFERENCED-DEAD` while its caller `modules/excavation_module.php` is `ROUTED` and required it — a direct contradiction with v1 §1.2, which lists that exact edge as one of only five live engine call sites | `commandcenter/_governance/AUDIT-APPENDIX-FILE-STATUS.md` rows for both files vs v1 §1.2 | **v1's DEAD count (277) is overstated.** Every DEAD verdict must be re-proven in v2; none are inherited. |
| C-04 | Searches can be trusted to return “no matches” | `ripgrep` is not installed on this host. The first harness sent `rg: command not found` to `/dev/null` and reported **zero references for every file tested**, including files with known callers | `command -v rg` → not found; `grep -rn -F "graph_engine.php"` → real hit in `api/v8/build_graph.php:3` | Harness rebuilt on `grep`, fails loudly, and ships `--selftest` with positive/negative/duplicate controls |
| C-05 | A filename match anywhere proves a caller | Two false-proof sources: **duplicate basenames** (`graph_engine.php` ×2, `bootstrap.php` ×5) and **generated indexes** (`ExcavationCommand/system_index_cache.json` lists every path and calls nothing). Together they made `kernel/guard.php`, `engine/plain_english_helper.php` and `modules/governance_module.php` appear referenced | v2 harness run before/after: those three went from “2 live refs” to 0; `kernel/graph_engine.php` went from 4 to 0 while `engine/graph_engine.php` kept its 1 real caller | DEAD proof now matches the **full relative path**; index artefacts are quarantined in class `INDEX` |

### 8.1 Verification of the harness (A0 exit criteria)

```
$ bash _governance/audits-v2/deadcheck.sh --selftest
  positive  kernel/db.php            live=21   (must be > 0)
  negative  Color_Creator.php        dead-eligible=1  (must be 1)
  duplicate kernel/graph_engine.php  live=0   (must be 0; the caller belongs to engine/)
SELFTEST PASS
```

And on the real targets that v1 mis-scored:

| File | v2 proof | Corrected status |
|---|---|---|
| `engine/graph_engine.php` | 1 live ref — `api/v8/build_graph.php:3` (caller itself unreachable) | `UNWIRED`, not DEAD: it has a real include, from a dead entry point |
| `kernel/graph_engine.php` | 0 full-path refs | DEAD-eligible (the only basename hits belong to the other copy) |
| `kernel/guard.php` | 0 full-path refs (1 unrelated stem hit: `"engagement_guard"` in `engine/policy_enforcement_engine.php:102`) | `UNWIRED`, wanted |
| `engine/plain_english_helper.php` | 0 refs of any kind | `UNWIRED` |
| `modules/governance_module.php` | 0 refs of any kind | `UNWIRED` |

Stem-only hits are advisory: an unrelated identifier that merely shares the stem (e.g. `engagement_guard`) does **not** block a DEAD verdict, but it must be printed and dismissed by inspection, never skipped.
