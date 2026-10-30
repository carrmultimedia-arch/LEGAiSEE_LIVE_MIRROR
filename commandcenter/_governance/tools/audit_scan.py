#!/usr/bin/env python3
"""Static connection + data-layer audit for the commandcenter tree. v2.

Fixes: __DIR__ resolution on Windows (leading-slash join), plus UI reference
detection so "connected" means something is actually calling the file.
"""
import os, re, json, csv, hashlib
from collections import defaultdict

ROOT = os.path.abspath(os.getcwd())
OUT_JSON = os.path.join(ROOT, "_governance", "audit_graph.json")
OUT_CSV = os.path.join(ROOT, "_governance", "audit_files.csv")

SKIP_DIRS = {".git", "node_modules", "__pycache__"}
VENDOR_PREFIXES = ("ProjectManager/vendor/", "lib/vendor/", "lib/dompdf/")

INCLUDE_RE = re.compile(r'\b(?:require|include)(?:_once)?\s*[\(\s]*([^;]+?)\s*[;\)]', re.I)
FUNC_DEF_RE = re.compile(r'\bfunction\s+([A-Za-z_]\w*)\s*\(')
CLASS_DEF_RE = re.compile(r'\b(?:class|interface|trait)\s+([A-Za-z_]\w*)')
NEW_RE = re.compile(r'\bnew\s+([A-Za-z_]\w*)\s*\(')
CALL_RE = re.compile(r'(?<![\w>$:\\])([A-Za-z_]\w*)\s*\(')

PHP_KEYWORDS = set("""if else elseif while for foreach switch case return echo print isset unset empty
array list function class new clone exit die include include_once require require_once and or xor not
try catch finally throw static self parent int float string bool void callable iterable object mixed
match fn use namespace global instanceof insteadof extends implements public private protected
endif endwhile endforeach endfor endswitch declare default break continue goto yield
""".split())

MARKERS = {
    "mysql":   [r'mysql:host', r'new\s+mysqli', r'mysqli_connect', r'SHOW TABLES', r'information_schema'],
    "sqlite":  [r'sqlite:', r'sqlite_master', r'legaisee\.db', r'new\s+SQLite3'],
    "kernel_db":[r'kernel_db\s*\('],
    "pdo":     [r'new\s+PDO', r'->prepare\s*\(', r'->query\s*\(', r'PDO::FETCH'],
    "load_json_dir": [r'load_json_dir\s*\('],
    "json_io": [r'json_decode\s*\(', r'json_encode\s*\('],
    "file_io": [r'file_get_contents\s*\(', r'file_put_contents\s*\(', r'fopen\s*\(', r'fwrite\s*\('],
    "http_in": [r'\$_GET', r'\$_POST', r'\$_REQUEST', r'php://input'],
    "session": [r'session_start', r'\$_SESSION'],
    "html_out":[r'<!DOCTYPE', r'<html', r'<div'],
    "global_db":[r'\$db->', r'global\s+\$db'],
}

def is_vendor(rel):
    return rel.replace("\\", "/").startswith(VENDOR_PREFIXES)

def is_archive(rel):
    r = rel.lower()
    return (".bak-" in r or ".bak" in r or r.endswith(".phpbak") or r.endswith(".phps")
            or r.startswith("z_deleted by claude/") or r.startswith("_backup/")
            or r.startswith("archive/"))

def read_text(path):
    try:
        raw = open(path, "rb").read()
    except OSError:
        return None, 0
    if b"\x00" in raw[:4096]:
        return None, len(raw)
    for enc in ("utf-8", "cp1252", "latin-1"):
        try:
            return raw.decode(enc), len(raw)
        except UnicodeDecodeError:
            continue
    return raw.decode("utf-8", "replace"), len(raw)

ANCHORS = ("__DIR__", "__FILE__", "dirname", "__dir__")

def resolve_include(expr, fdir):
    e = expr.strip()
    dynamic = "$" in e
    lits = [a or b for a, b in re.findall(r"'([^']*)'|\"([^\"]*)\"", e)]
    if not lits:
        return None, True
    lit = (lits[0] if not dynamic else "".join(lits)).replace("\\", "/").strip()
    if lit.lower().endswith(".php") is False and "." not in os.path.basename(lit):
        pass
    anchored = any(a in e for a in ANCHORS)
    if anchored:
        lit = lit.lstrip("/")
        bases = [fdir]
    elif lit.startswith("/"):
        lit = lit.lstrip("/")
        bases = [ROOT]
    else:
        bases = [fdir, ROOT, os.path.join(ROOT, "kernel"), os.path.join(ROOT, "modules"),
                 os.path.join(ROOT, "modules", "utils"), os.path.join(ROOT, "lib"),
                 os.path.join(ROOT, "ui"), os.path.join(ROOT, "components")]
    for b in bases:
        cand = os.path.normpath(os.path.join(b, lit))
        if os.path.isfile(cand):
            return os.path.relpath(cand, ROOT).replace("\\", "/"), dynamic
    return os.path.normpath(os.path.join(bases[0], lit)).replace("\\", "/"), True

def walk():
    files = []
    for dirpath, dirnames, filenames in os.walk(ROOT):
        dirnames[:] = [d for d in dirnames if d not in SKIP_DIRS]
        rel_dir = os.path.relpath(dirpath, ROOT).replace("\\", "/")
        if rel_dir == ".":
            rel_dir = ""
        for fn in filenames:
            files.append((rel_dir + "/" + fn) if rel_dir else fn)
    return sorted(files)

def main():
    all_files = walk()
    php = [f for f in all_files if f.lower().endswith(".php")]
    info, func_defs, class_defs = {}, defaultdict(list), defaultdict(list)
    texts = {}

    for rel in php:
        path = os.path.join(ROOT, rel)
        text, size = read_text(path)
        rec = {"rel": rel, "size": size, "vendor": is_vendor(rel), "archive": is_archive(rel),
               "sha": None, "includes": [], "dynamic_includes": [], "funcs": [], "classes": [],
               "news": [], "calls": set(), "marks": {}, "lines": 0, "text_ok": text is not None,
               "empty": size == 0}
        if text is None:
            info[rel] = rec
            continue
        texts[rel] = text
        rec["lines"] = text.count("\n") + 1
        rec["sha"] = hashlib.sha1(text.encode("utf-8", "ignore")).hexdigest()[:12]
        fdir = os.path.dirname(os.path.join(ROOT, rel)) or ROOT
        for m in INCLUDE_RE.finditer(text):
            target, dyn = resolve_include(m.group(1), fdir)
            if target:
                rec["dynamic_includes" if dyn else "includes"].append(target)
        rec["funcs"] = sorted(set(FUNC_DEF_RE.findall(text)))
        rec["classes"] = sorted(set(CLASS_DEF_RE.findall(text)))
        rec["news"] = sorted(set(NEW_RE.findall(text)))
        rec["calls"] = {n for n in CALL_RE.findall(text)
                        if n.lower() not in PHP_KEYWORDS and len(n) >= 3}
        for key, pats in MARKERS.items():
            hits = sum(len(re.findall(p, text, re.I)) for p in pats)
            if hits:
                rec["marks"][key] = hits
        info[rel] = rec
        for f in rec["funcs"]:
            func_defs[f].append(rel)
        for c in rec["classes"]:
            class_defs[c].append(rel)

    # ---------- include edges ----------
    edges = set()
    for rel, rec in info.items():
        for t in rec["includes"] + rec["dynamic_includes"]:
            t = t.replace("\\", "/")
            if t in info and t != rel:
                edges.add((rel, t))
    # ---------- call edges (unambiguous defs only) ----------
    call_edges = set()
    for rel, rec in info.items():
        if rec["vendor"]:
            continue
        for name in rec["calls"]:
            defs = func_defs.get(name, [])
            if len(defs) == 1 and defs[0] != rel and not info[defs[0]]["vendor"]:
                call_edges.add((rel, defs[0]))

    # ---------- who references whom by filename string (UI / fetch / href) ----------
    referenced = defaultdict(set)
    for rel, text in texts.items():
        base = os.path.basename(rel)
        if len(base) < 6:
            continue
        pat = re.compile(re.escape(base), re.I)
        for other, otext in texts.items():
            if other == rel:
                continue
            if base in otext:
                referenced[rel].add(other)

    # ---------- reachability ----------
    def closure(seeds):
        adj = defaultdict(set)
        for a, b in edges:
            adj[a].add(b)
        seen, stack = set(), list(seeds)
        while stack:
            n = stack.pop()
            if n in seen:
                continue
            seen.add(n)
            stack.extend(x for x in adj.get(n, ()) if x not in seen)
        return seen

    shell_seeds = {"shell.php"}
    shell_reach = closure(shell_seeds)

    endpoint_seeds = set()
    for rel in info:
        if re.match(r"^(api|cli)/[^/]+\.php$", rel):
            if referenced.get(rel):
                endpoint_seeds.add(rel)
    endpoint_reach = closure(endpoint_seeds)

    def http_entry(rel):
        m = info[rel]["marks"]
        return m.get("http_in", 0) > 0

    http_seeds = {r for r in info if http_entry(r) and not info[r]["vendor"]}

    live = shell_reach
    active = shell_reach | endpoint_reach

    inbound = defaultdict(set)
    for a, b in edges:
        inbound[b].add(a)
    call_inbound = defaultdict(set)
    for a, b in call_edges:
        call_inbound[b].add(a)

    for rel, rec in info.items():
        rec["inbound"] = sorted(inbound.get(rel, []))
        rec["call_inbound"] = sorted(call_inbound.get(rel, []))
        rec["referenced_by"] = sorted(referenced.get(rel, []))
        rec["in_shell"] = rel in live
        rec["in_active"] = rel in active
        rec["web_entry"] = http_entry(rel)
        rec["calls"] = sorted(rec["calls"])[:400]

    # ---------- storage classification ----------
    for rel, rec in info.items():
        m = rec["marks"]
        tags = []
        if m.get("sqlite"):
            tags.append("SQLITE")
        if m.get("mysql") or m.get("kernel_db"):
            tags.append("MYSQL")
        if m.get("load_json_dir") or (m.get("json_io") and m.get("file_io")):
            tags.append("JSON")
        elif m.get("file_io") and not tags:
            tags.append("FILES")
        if m.get("json_io") and "JSON" not in tags and ("data/" in texts.get(rel, "") or "clients/" in texts.get(rel, "")):
            tags.append("JSON?")
        rec["storage"] = "+".join(tags) if tags else "NONE"

    # ---------- duplicates / collisions ----------
    by_sha = defaultdict(list)
    for rel, rec in info.items():
        if rec["sha"] and not rec["vendor"]:
            by_sha[rec["sha"]].append(rel)
    dupes = {k: v for k, v in by_sha.items() if len(v) > 1}
    by_base = defaultdict(list)
    for rel in info:
        if not info[rel]["vendor"]:
            by_base[os.path.basename(rel)].append(rel)
    collisions = {k: v for k, v in by_base.items() if len(v) > 1}

    result = {
        "counts": {
            "all_files": len(all_files),
            "php_total": len(php),
            "php_vendor": sum(1 for r in php if info[r]["vendor"]),
            "php_first_party": sum(1 for r in php if not info[r]["vendor"]),
            "php_archive": sum(1 for r in php if info[r]["archive"]),
            "php_empty": sum(1 for r in php if info[r]["empty"]),
            "in_shell": len(live),
            "in_active": len(active),
            "http_entry_files": len(http_seeds),
        },
        "include_edges": sorted(edges),
        "call_edges": sorted(call_edges),
        "shell_reach": sorted(live),
        "endpoint_seeds": sorted(endpoint_seeds),
        "files": {r: {k: v for k, v in rec.items() if k not in ("calls",)} for r, rec in info.items()},
        "calls": {r: rec["calls"] for r, rec in info.items()},
        "duplicates": dupes,
        "collisions": collisions,
        "non_php": [f for f in all_files if not f.lower().endswith(".php")],
    }
    with open(OUT_JSON, "w", encoding="utf-8") as f:
        json.dump(result, f, indent=1)

    with open(OUT_CSV, "w", newline="", encoding="utf-8-sig") as f:
        w = csv.writer(f)
        w.writerow(["path", "bytes", "lines", "vendor", "in_shell", "in_active",
                    "web_entry", "ref_by", "inbound", "includes", "storage"])
        for rel in all_files:
            v = info.get(rel)
            if not v:
                w.writerow([rel, "", "", "", "", "", "", "", "", "", "non_php"])
                continue
            w.writerow([rel, v["size"], v["lines"], v["vendor"], v["in_shell"], v["in_active"],
                        v["web_entry"], len(v["referenced_by"]), len(v["inbound"]),
                        len(v["includes"]), v["storage"]])

    print(json.dumps(result["counts"], indent=1))
    print("include_edges:", len(edges), "call_edges:", len(call_edges))
    print("WROTE", OUT_JSON, OUT_CSV)

if __name__ == "__main__":
    main()
