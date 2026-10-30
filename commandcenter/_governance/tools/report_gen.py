#!/usr/bin/env python3
"""Emit the complete per-file status appendix from audit_graph.json."""
import json, os, re
from collections import Counter, defaultdict

g = json.load(open("_governance/audit_graph.json", encoding="utf-8"))
F = g["files"]
OUT = "_governance/AUDIT-APPENDIX-FILE-STATUS.md"

registry = dict(re.findall(r"'([a-z_0-9]+)'\s*=>\s*'([^']+)'",
                           open("kernel/module_registry.php", encoding="utf-8", errors="replace").read()))
reg_files = {v for v in registry.values()}

LEGACY = re.compile(r"load_json_dir\s*\(|scandir\s*\(|glob\s*\(|'(\.\./)*(data|clients|normalized)/")
SQL = re.compile(r"kernel_db\s*\(|->query\s*\(|->prepare\s*\(|mysql:|new\s+PDO")
SQLITE = re.compile(r"sqlite_master|sqlite:|legaisee\.db|SQLite3")

# files that the old audits already adjudicated, or that I judged by reading them
MANUAL = {
    "engine/plain_english_helper.php": ("DEAD-BUT-WANTED", "INTEGRATE into graph + recommendation output"),
    "kernel/guard.php":               ("DEAD-BUT-WANTED", "WIRE into kernel_boot.php"),
    "kernel/system_health.php":       ("BROKEN", "FIX sqlite_master probe, then WIRE"),
    "kernel/engine_bindings.php":     ("DEAD-CONFIG", "WIRE into load_module.php or delete"),
    "kernel/cluster_intelligence.php":("DEAD", "DELETE (superseded by engine/semantic_cluster_engine.php)"),
    "modules/governance_module.php":  ("UNREGISTERED", "REGISTER in module_registry.php or delete"),
    "modules/build_dossier.php":      ("UNREGISTERED", "REGISTER or delete"),
    "modules/intelligence_dashboard_module.php": ("MOCK", "REPLACE mock layer with engine/system_insight_engine.php"),
    "modules/compare_module.php":     ("SHELL-ONLY", "FINISH (renders inputs, no engine call)"),
    "cli/worker.php":                 ("BROKEN", "FIX require of engine/cluster_engine.php -> root cluster_engine.php"),
    "api.php":                        ("DEAD", "DELETE (0 callers; makes api/v8 unreachable)"),
    "cluster_engine.php":             ("LIVE-VIA-WORKER", "KEEP (real clusterNodes())"),
    "engine/pipeline_adapters.php":   ("BROKEN", "FIX double include + missing cluster engine"),
}

def tier_of(rel):
    try:
        t = open(rel, encoding="utf-8", errors="replace").read()
    except OSError:
        return "?"
    if SQLITE.search(t):
        return "SQLITE"
    sql, leg = bool(SQL.search(t)), bool(LEGACY.search(t))
    if sql and leg: return "MYSQL+JSON"
    if leg: return "JSON"
    if sql: return "MYSQL"
    return "NONE"

def status_of(rel, v):
    if rel in MANUAL:
        return MANUAL[rel][0]
    if v["empty"]:
        return "EMPTY"
    if rel.startswith("modules/") and os.path.basename(rel) in reg_files:
        return "ROUTED"
    if v["in_shell"]:
        return "LIVE-CORE"
    if v["in_active"]:
        return "LIVE-ENDPOINT"
    if any(not F[x]["vendor"] for x in v["referenced_by"]):
        return "REFERENCED-DEAD"
    if v["web_entry"]:
        return "ORPHAN-WEB"
    if v["inbound"] or v["call_inbound"]:
        return "ORPHAN-INCLUDED"
    return "DEAD"

def action_of(rel, st, tier):
    if rel in MANUAL:
        return MANUAL[rel][1]
    if st == "EMPTY":
        return "DELETE (0 bytes)"
    if tier == "SQLITE":
        return "REWRITE -> MySQL"
    if st in ("LIVE-CORE", "ROUTED", "LIVE-ENDPOINT", "LIVE-VIA-WORKER"):
        if tier == "JSON": return "MIGRATE -> MySQL"
        if tier == "MYSQL+JSON": return "REMOVE JSON fallback"
        return "OK"
    if st in ("DEAD", "ORPHAN-WEB", "REFERENCED-DEAD", "ORPHAN-INCLUDED"):
        return "DELETE (verify first)" if tier != "MYSQL" else "DELETE (dead SQL writer)"
    return "REVIEW"

rows = []
for rel, v in sorted(F.items()):
    if v["vendor"] or v["archive"]:
        continue
    tier = tier_of(rel)
    st = status_of(rel, v)
    ev = (v["inbound"] or v["call_inbound"] or
          [x for x in v["referenced_by"] if not F.get(x, {}).get("vendor")] or ["—"])
    rows.append((rel, v["size"], v["lines"], tier, st, ev[0], action_of(rel, st, tier)))

lines = []
w = lines.append
w("# Appendix — Per-File Status, commandcenter/")
w("")
w("Generated 2026-10-29 by `_governance/tools/audit_scan.py` + `_governance/tools/report_gen.py`.")
w("Static analysis of include/require, function definitions vs call sites, data-layer markers,")
w("and reachability from `shell.php`, `api/*.php` and `cli/*.php`. Every first-party, non-archive")
w("PHP file in the tree appears exactly once.")
w("")
w(f"**Rows:** {len(rows)} files · **Storage tiers:** " +
  ", ".join(f"{k} {n}" for k, n in Counter(r[3] for r in rows).most_common()) + " · **Status:** " +
  ", ".join(f"{k} {n}" for k, n in Counter(r[4] for r in rows).most_common()))
w("")
w("Legend — `ROUTED` = loaded by shell.php through `kernel/module_registry.php`; `LIVE-CORE` = in the")
w("`shell.php` include closure; `LIVE-ENDPOINT` = reached from a referenced `api/` or `cli/` script;")
w("`REFERENCED-DEAD` = named by another file that is itself unreachable; `ORPHAN-WEB` = PHP that answers")
w("a URL request but nothing links to it; `DEAD` = no caller, no include, no reference.")
w("")
w("| File | Bytes | Lines | Storage | Status | First caller / evidence | Action |")
w("|---|---:|---:|---|---|---|---|")
for rel, size, ln, tier, st, ev, act in rows:
    w(f"| `{rel}` | {size:,} | {ln} | {tier} | {st} | `{ev}` | {act} |")

w("")
w("## Grouped summary")
w("")
by_dir = defaultdict(Counter)
for rel, *_rest in rows:
    st = _rest[3]
    top = rel.split("/")[0] if "/" in rel else "(root)"
    by_dir[top][st] += 1
w("| Directory | Files | Status mix |")
w("|---|---:|---|")
for d in sorted(by_dir, key=lambda x: -sum(by_dir[x].values())):
    mix = ", ".join(f"{k} {v}" for k, v in by_dir[d].most_common())
    w(f"| `{d}/` | {sum(by_dir[d].values())} | {mix} |")

w("")
w("## Non-PHP inventory")
w("")
np = g["non_php"]
ext = Counter(os.path.splitext(f)[1].lower() or "(none)" for f in np)
w("| Type | Count | Disposition |")
w("|---|---:|---|")
dispo = {".md": "Documentation — keep, but 457 files includes stale audits; see AUDIT-DATA-CONSOLIDATED.md",
         ".json": "Mixed: `data/`+`clients/` are legacy stores to migrate; rest are config/fixtures",
         ".txt": "Inventory/tree dumps — archive",
         ".jpg": "Client artifacts/dossiers — keep (business records)",
         ".png": "Screenshots/branding — keep",
         ".sql": "Pre-migration dump — keep until Phase 9, then archive",
         ".bak-20261027": "Backup copies — delete after diff confirmation",
         ".bak-20261028": "Backup copies — delete after diff confirmation",
         ".phps": "PHP source backups — delete (may expose source)",
         ".docx": "Source briefs — keep",
         ".db": "Stale SQLite files — delete after migration",
         "": "Extensionless files — review"}
for e, n in ext.most_common():
    w(f"| `{e}` | {n} | {dispo.get(e, 'Review')} |")
w("")
w("Vendor trees excluded from the status table (third-party, do not audit or edit):")
w("`ProjectManager/vendor/` (Composer), `lib/vendor/` (Stripe, PHPMailer), `lib/dompdf/` — 861 PHP files.")
w("")
w("Archive / already-deleted trees excluded: `z_Deleted by claude/`, `_backup/`, `archive/`, `*.bak-*`, `*.phpbak` — 55 files.")

open(OUT, "w", encoding="utf-8").write("\n".join(lines) + "\n")
print("wrote", OUT, len(rows), "rows")
print("tiers:", dict(Counter(r[3] for r in rows)))
print("status:", dict(Counter(r[4] for r in rows)))
