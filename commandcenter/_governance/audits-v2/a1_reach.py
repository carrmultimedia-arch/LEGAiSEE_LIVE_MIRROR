#!/usr/bin/env python3
"""
a1_reach.py — Block A1 reachability graph.

Why this exists: v1's scanner could not follow computed paths (shell.php builds
the module path at runtime) and never looked inside screens for JS URLs. This
builds the graph from three independent surfaces:

  A. PHP include edges, with a real expression evaluator so that
     __DIR__ . '/x', dirname(__DIR__) . '/x', dirname(__DIR__, 2) and bare
     relative literals resolve the way PHP resolves them.
  B. Browser surface: quoted *.php URLs found in fetch()/XMLHttpRequest/href/
     src/action/location inside screens, JS files and markup.
  C. Server config: .htaccess / .user.ini / web.config rules.
  D. CLI: files referenced by cron manifests or by modules.

Then BFS from the real seeds (shell.php + registry modules + standalone links)
and report what is reachable, what is not, and who references each target.

Outputs _governance/audits-v2/A1-graph.json and prints a summary.
No source file is modified.
"""
import json
import os
import re
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))  # commandcenter/

SKIP_DIRS = {'.git', 'vendor', 'node_modules', '_governance', 'dompdf',
             'z_Deleted', '_archive', '__pycache__', 'archive', '_backup'}


def skip_dir(name):
    """Exact-name skip plus prefix skip: 'z_Deleted by claude' is a real dir
    that an exact-match set would have walked, crediting live files with
    references from an archived tree."""
    return (name in SKIP_DIRS or name.startswith('z_Deleted')
            or name.startswith('_backup') or name.startswith('archive'))
CODE_EXT = {'.php', '.phtml', '.inc'}
WEB_EXT = {'.js', '.mjs', '.cjs', '.html', '.htm', '.css'}
CFG_NAMES = {'.htaccess', 'web.config', '.user.ini'}

# ---------------------------------------------------------------- file walk


def rel(p):
    return os.path.relpath(p, ROOT).replace('\\', '/')


def walk():
    out = []
    for dirpath, dirnames, filenames in os.walk(ROOT):
        dirnames[:] = [d for d in dirnames if not skip_dir(d)]
        for fn in filenames:
            full = os.path.join(dirpath, fn)
            ext = os.path.splitext(fn)[1].lower()
            if '.bak' in fn or fn.endswith('.phpbak'):
                continue  # archive copies would credit live files with callers
            if ext in CODE_EXT or ext in WEB_EXT or fn in CFG_NAMES:
                out.append(full)
    return out


# ------------------------------------------------------- expression evaluator

TOKQ = re.compile(r"""'(?:[^'\\]|\\.)*'|"(?:[^"\\]|\\.)*\"""", re.S)


def tokenize(s):
    toks, i, n = [], 0, len(s)
    while i < n:
        c = s[i]
        if c in ' \t\r\n':
            i += 1
            continue
        if c in "'\"":
            q = c
            i += 1
            buf = []
            while i < n and s[i] != q:
                if s[i] == '\\' and i + 1 < n:
                    buf.append(s[i + 1])
                    i += 2
                else:
                    buf.append(s[i])
                    i += 1
            i += 1
            toks.append(('str', ''.join(buf)))
            continue
        if c == '.':
            toks.append(('dot', '.')); i += 1; continue
        if c == '(':
            toks.append(('lp', '(')); i += 1; continue
        if c == ')':
            toks.append(('rp', ')')); i += 1; continue
        if c == ',':
            toks.append(('comma', ',')); i += 1; continue
        m = re.match(r'\d+', s[i:])
        if m:
            toks.append(('num', m.group(0))); i += len(m.group(0)); continue
        m = re.match(r'\$[A-Za-z_][A-Za-z0-9_]*', s[i:])
        if m:
            toks.append(('var', m.group(0))); i += len(m.group(0)); continue
        m = re.match(r'[A-Za-z_][A-Za-z0-9_]*', s[i:])
        if m:
            toks.append(('id', m.group(0))); i += len(m.group(0)); continue
        toks.append(('other', c)); i += 1
    return toks


def _atom(toks, pos, filedir):
    if pos >= len(toks):
        return None, pos
    kind, val = toks[pos]
    if kind == 'str':
        return val, pos + 1
    if kind == 'id':
        if val == '__DIR__':
            return filedir, pos + 1
        if val == '__FILE__':
            return filedir + '/__FILE__', pos + 1
        if val == 'DIRECTORY_SEPARATOR':
            return '/', pos + 1
        if val == 'dirname':
            pos += 1
            if pos < len(toks) and toks[pos][0] == 'lp':
                pos += 1
            inner, pos = _atom(toks, pos, filedir)
            levels = 1
            if pos < len(toks) and toks[pos][0] == 'comma':
                pos += 1
                if pos < len(toks) and toks[pos][0] == 'num':
                    levels = int(toks[pos][1]); pos += 1
            if pos < len(toks) and toks[pos][0] == 'rp':
                pos += 1
            if inner is None:
                return None, pos
            for _ in range(levels):
                inner = inner.replace('\\', '/').rsplit('/', 1)[0]
            return inner, pos
        return None, pos + 1  # unknown constant/function
    return None, pos + 1


def eval_expr(expr, filedir):
    toks = tokenize(expr)
    if not toks:
        return None
    val, pos = _atom(toks, 0, filedir)
    while pos < len(toks):
        if toks[pos][0] == 'dot':
            nxt, pos = _atom(toks, pos + 1, filedir)
            val = None if val is None or nxt is None else val + nxt
        else:
            return None  # anything unexpected is dynamic
    return val


# ---------------------------------------------------------------- php parse

def strip_comments(src):
    out, i, n = [], 0, len(src)
    while i < n:
        c = src[i]
        if c in "'\"":
            q = c
            j = i + 1
            while j < n:
                if src[j] == '\\':
                    j += 2
                    continue
                if src[j] == q:
                    break
                j += 1
            out.append(src[i:j + 1]); i = j + 1; continue
        if src.startswith('//', i) or c == '#':
            j = src.find('\n', i)
            i = n if j < 0 else j
            out.append('\n')
            continue
        if src.startswith('/*', i):
            j = src.find('*/', i + 2)
            seg = src[i:(n if j < 0 else j + 2)]
            out.append('\n' * seg.count('\n'))
            i = n if j < 0 else j + 2
            continue
        out.append(c); i += 1
    return ''.join(out)


INC_RE = re.compile(
    r'\b(require|require_once|include|include_once)\b\s*(?:\(\s*)?'
    r'([^;]{0,400}?)\s*\)?\s*;', re.I | re.S)


def line_of(src, idx):
    return src.count('\n', 0, idx) + 1


def parse_php(full):
    try:
        raw = open(full, encoding='utf-8', errors='replace').read()
    except OSError:
        return [], [], []
    src = strip_comments(raw)
    filedir = os.path.dirname(full).replace('\\', '/')
    includes, dynamic, browser = [], [], []

    for m in INC_RE.finditer(src):
        stmt, expr = m.group(0), m.group(2).strip()
        ln = line_of(src, m.start())
        value = eval_expr(expr, filedir)
        if value is None:
            dynamic.append({'line': ln, 'stmt': stmt.strip()[:160]})
            continue
        value = value.replace('\\', '/')
        if '://' in value:
            continue
        if not os.path.isabs(value):
            value = os.path.normpath(os.path.join(filedir, value)).replace('\\', '/')
        else:
            value = os.path.normpath(value).replace('\\', '/')
        includes.append({
            'line': ln,
            'expr': expr[:120],
            'target': rel(value) if value.startswith(ROOT.replace('\\', '/')) else value,
            'exists': os.path.isfile(value),
        })

    # browser surface: quoted .php URLs
    for m in re.finditer(r"""['"]([^'"\s<>()]*?\.php)(\?[^'"\s<>()]*)?['"]""", raw):
        ln = line_of(raw, m.start())
        ctx = raw[max(0, m.start() - 90):m.start()]
        ctx = ' '.join(ctx.split())[-70:]
        kind = 'other'
        for k, pat in (('fetch', 'fetch'), ('xhr', 'open'), ('ajax', '$ajax'),
                       ('href', 'href'), ('src', 'src'), ('action', 'action'),
                       ('location', 'location'), ('include-str', 'include'),
                       ('require-str', 'require')):
            if pat in ctx:
                kind = k
                break
        browser.append({'line': ln, 'url': m.group(1) + (m.group(2) or ''),
                        'kind': kind, 'ctx': ctx})
    return includes, dynamic, browser


# ------------------------------------------------------------- target norm

def url_to_path(url):
    u = url.split('?')[0].split('#')[0].strip()
    if not u.endswith('.php'):
        return None
    if u.startswith('http'):
        return None
    for pre in ('/commandcenter/', 'commandcenter/', '/'):
        if u.startswith(pre):
            u = u[len(pre):]
            break
    if u.startswith('../'):
        return None
    return u


# ------------------------------------------------------------------ build

def main():
    files = walk()
    php = [f for f in files if os.path.splitext(f)[1].lower() in CODE_EXT]
    web = [f for f in files if os.path.splitext(f)[1].lower() in WEB_EXT]
    cfgs = [f for f in files if os.path.basename(f) in CFG_NAMES]

    graph, dyn, browser_all = {}, {}, {}
    for f in php:
        inc, dy, br = parse_php(f)
        graph[rel(f)] = inc
        if dy:
            dyn[rel(f)] = dy
        if br:
            browser_all[rel(f)] = br
    for f in web:
        inc, _, br = parse_php(f)
        if br:
            browser_all[rel(f)] = br

    # registry
    registry = {}
    reg_path = os.path.join(ROOT, 'kernel', 'module_registry.php')
    if os.path.isfile(reg_path):
        txt = open(reg_path, encoding='utf-8', errors='replace').read()
        for m in re.finditer(r"'([a-z0-9_]+)'\s*=>\s*'([^']+)'", txt):
            registry[m.group(1)] = m.group(2)
        reg_lines = {m.group(1): txt.count('\n', 0, m.start()) + 1
                     for m in re.finditer(r"'([a-z0-9_]+)'\s*=>\s*'([^']+)'", txt)}

    # server config rules
    cfg_rules = {}
    for c in cfgs:
        txt = open(c, encoding='utf-8', errors='replace').read()
        rules = []
        for i, ln in enumerate(txt.splitlines(), 1):
            if re.search(r'(RewriteRule|RewriteCond|ErrorDocument|auto_prepend_file|'
                         r'include_path|php_value|Redirect|Deny|Require|Order|'
                         r'<Files|DirectoryIndex)', ln, re.I):
                rules.append({'line': i, 'text': ln.strip()[:200]})
        cfg_rules[rel(c)] = rules

    # reverse index
    rev = {}
    for src, edges in graph.items():
        for e in edges:
            rev.setdefault(e['target'], []).append(
                {'from': src, 'line': e['line'], 'expr': e['expr']})
    bref = {}
    for src, refs in browser_all.items():
        for r in refs:
            t = url_to_path(r['url'])
            if t:
                bref.setdefault(t, []).append(
                    {'from': src, 'line': r['line'], 'url': r['url'], 'kind': r['kind']})

    # seeds
    seeds = []
    if os.path.isfile(os.path.join(ROOT, 'shell.php')):
        seeds.append('shell.php')
    for name, fn in registry.items():
        p = 'modules/' + fn
        if os.path.exists(os.path.join(ROOT, p)):
            seeds.append(p)
    for s in ('modules/report_module.php', 'modules/vault_module.php',
              'modules/brain_module.php'):
        if os.path.exists(os.path.join(ROOT, s)) and s not in seeds:
            seeds.append(s)

    # BFS over include edges + browser edges
    reach, order = set(), []
    queue = list(dict.fromkeys(seeds))
    while queue:
        cur = queue.pop(0)
        if cur in reach:
            continue
        reach.add(cur)
        order.append(cur)
        nxt = []
        for e in graph.get(cur, []):
            if e['target'] in reach:
                continue
            if os.path.exists(os.path.join(ROOT, e['target'])):
                nxt.append(e['target'])
        for r in browser_all.get(cur, []):
            t = url_to_path(r['url'])
            if t and os.path.exists(os.path.join(ROOT, t)):
                nxt.append(t)
        queue.extend(nxt)

    # rglob php not reachable
    all_php = sorted(rel(f) for f in php)
    unreachable = [p for p in all_php if p not in reach]

    targets = [
        'engine/entity_extraction_engine.php',
        'kernel/ingestion_pipeline.php',
        'ui/ui_engine.php',
        'ui/layout.php',
        'kernel/nav_engine.php',
        'lib/semantic_diff_engine.php',
        'prospect.php',
        'api/tree.php',
        'api/v8/network_add_node.php',
        'engine/hierarchy_of_truth_engine.php',
        'engine/plain_english_helper.php',
    ]
    verify = {}
    for t in targets:
        verify[t] = {
            'exists': os.path.isfile(os.path.join(ROOT, t)),
            'reachable': t in reach,
            'static_referrers': rev.get(t, []),
            'browser_referrers': bref.get(t, []),
        }

    out = {
        'counts': {
            'php_files': len(all_php),
            'reachable': len(reach),
            'unreachable': len(unreachable),
            'registry_modules': len(registry),
            'modules_present': sum(1 for fn in registry.values()
                                   if os.path.exists(os.path.join(ROOT, 'modules', fn))),
        },
        'registry': registry,
        'seeds': seeds,
        'reachable': sorted(reach),
        'unreachable': unreachable,
        'graph': graph,
        'dynamic_requires': dyn,
        'browser_refs': browser_all,
        'config_rules': cfg_rules,
        'verify': verify,
    }
    outp = os.path.join(HERE, 'A1-graph.json')
    with open(outp, 'w', encoding='utf-8') as fh:
        json.dump(out, fh, indent=1)

    print('================ A1 SUMMARY ================')
    print('php files        :', len(all_php))
    print('registry modules :', len(registry),
          '| present:', out['counts']['modules_present'])
    print('reachable        :', len(reach))
    print('unreachable      :', len(unreachable))
    print('files with browser refs :', len(browser_all))
    print('files with dynamic require :', len(dyn))
    print()
    print('--- registry modules: exists? includes? ---')
    for name, fn in registry.items():
        p = 'modules/' + fn
        ex = os.path.exists(os.path.join(ROOT, p))
        incs = [e['target'] for e in graph.get(p, [])]
        print('%-26s %-34s %-6s %s' % (name, fn, 'OK' if ex else 'MISSING',
                                       ', '.join(incs) if incs else '-'))
    print()
    print('--- dynamic requires (need manual path resolution) ---')
    for f, lst in sorted(dyn.items()):
        for d in lst:
            print('%-46s:%-4s %s' % (f, d['line'], d['stmt']))
    print()
    print('--- the 11 named targets ---')
    for t, v in verify.items():
        print('%-46s exists=%-5s reach=%-5s static=%d browser=%d' % (
            t, v['exists'], v['reachable'],
            len(v['static_referrers']), len(v['browser_referrers'])))
        for r in v['static_referrers'][:6]:
            print('        <- %s:%s  [%s]' % (r['from'], r['line'], r['expr']))
        for r in v['browser_referrers'][:6]:
            print('        <- %s:%s  %s (%s)' % (r['from'], r['line'], r['url'], r['kind']))
    print()
    print('--- unreachable php (first 60) ---')
    for p in unreachable[:60]:
        print('   ', p)
    print()
    print('--- .htaccess rules ---')
    for c, rules in cfg_rules.items():
        print(c, len(rules), 'rule-ish lines')
        for r in rules:
            print('   %-4s %s' % (r['line'], r['text']))
    print('json ->', outp)


if __name__ == '__main__':
    main()
