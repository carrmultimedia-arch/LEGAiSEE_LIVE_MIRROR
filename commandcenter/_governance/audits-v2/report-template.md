# <BLOCK ID> — <Block title>

**Date:** YYYY-MM-DD
**Scope:** <files / directories covered, with count>
**Method:** <what was measured, and with what command>
**Inputs:** `schema-source.sql` (tables cited), `AUDIT-APPENDIX-FILE-STATUS.md` (v1 ledger, re-adjudicated)

## Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|

## File table

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|

## Deviations from v1

| v1 claim | v2 finding | Proof |
|---|---|---|

## Limits

- <what this block could not verify, and why>

---

### Legend
**Status** — `WORKS` reachable + correct · `WORKS-WITH-DEFECT` reachable, defect recorded · `BROKEN` fails when reached · `UNWIRED` complete but nothing loads it · `DEAD` proven unreferenced (see `00-GROUND-RULES.md` §5).
**Severity** — `P0` blocks V1 / security hole · `P1` wrong results or data loss · `P2` cosmetic or hygiene.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions.
