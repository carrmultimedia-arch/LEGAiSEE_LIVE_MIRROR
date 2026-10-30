#!/usr/bin/env python3
"""a1_report.py — render A1-graph.json into the tables the report needs."""
import json
import os
import re

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))
G = json.load(open(os.path.join(HERE, 'A1-graph.json'), encoding='utf-8'))

reach = set(G['reachable'])
unreach = set(G['unreachable'])
graph = G['graph']
browser = G['browser_refs']

# reverse: target <- source(line)
rev_static, rev_browser = {}, {}
for src, edges in graph.items():
    for e in edges:
        rev_static.setdefault(e['target'], []).append((src, e['line'], e['expr']))


def url_to_path(u):
    u = u.split('?')[0].split('#')[0]
    if not u.endswith('.php'):
        return None
    for pre in ('/commandcenter/', 'commandcenter/', '/'):
        if u.startswith(pre):
            u = u[len(pre):]
            break
    return None if u.startswith('..') else u


for src, refs in browser.items():
    for r in refs:
        t = url_to_path(r['url'])
        if t:
            rev_browser.setdefault(t, []).append((src, r['line'], r['url'], r['kind']))

print('==== COUNTS ====')
print(json.dumps(G['counts'], indent=1))

print('\n==== REACHABLE (%d) ====' % len(reach))
for p in sorted(reach):
    ins = rev_static.get(p, [])[:3] + [(a, b, c) for a, b, c, _ in rev_browser.get(p, [])[:2]]
    srcs = ', '.join(sorted({s for s, _, _ in ins})) or 'SEED'
    print('%-50s <- %s' % (p, srcs[:90]))

print('\n==== API ENDPOINTS (top level, 33) ====')
api = sorted(p for p in list(graph) if p.startswith('api/') and p.count('/') == 1)
for p in api:
    st = 'REACHABLE' if p in reach else ('REFERRED-BY-DEAD' if (rev_static.get(p) or rev_browser.get(p)) else 'NO-REFERENCE')
    who = [s for s, _, _ in rev_static.get(p, [])] + [s for s, _, _, _ in rev_browser.get(p, [])]
    who = sorted(set(who))[:4]
    print('%-38s %-18s %s' % (p, st, ', '.join(who)))

print('\n==== API/V8 (35) ====')
v8 = sorted(p for p in list(graph) if p.startswith('api/v8/'))
n = {'REACHABLE': 0, 'REFERRED-BY-DEAD': 0, 'NO-REFERENCE': 0}
for p in v8:
    if p in reach:
        n['REACHABLE'] += 1
    elif rev_static.get(p) or rev_browser.get(p):
        n['REFERRED-BY-DEAD'] += 1
    else:
        n['NO-REFERENCE'] += 1
print(n)
for p in v8:
    if rev_static.get(p) or rev_browser.get(p):
        who = [s for s, _, _ in rev_static.get(p, [])] + [s for s, _, _, _ in rev_browser.get(p, [])]
        print('  %-40s <- %s' % (p, ', '.join(sorted(set(who)))))

print('\n==== PER-MODULE OUTBOUND (includes + browser) ====')
reg = G['registry']
for name, fn in reg.items():
    p = 'modules/' + fn
    inc = ['%s:%s %s' % (e['target'], e['line'], 'OK' if e['exists'] else 'MISSING')
           for e in graph.get(p, [])]
    br = ['%s:%s %s' % (r['url'], r['line'], r['kind']) for r in browser.get(p, [])
          if url_to_path(r['url'])]
    print('%-26s %s' % (name, '; '.join(inc + br) or '(no requires, no URLs)'))

print('\n==== CLI ====')
for p in sorted(x for x in list(graph) + list(browser) if x.startswith('cli/')):
    who = [s for s, _, _ in rev_static.get(p, [])] + [s for s, _, _, _ in rev_browser.get(p, [])]
    print('%-30s reach=%s refs=%s' % (p, p in reach, sorted(set(who))))
for p in sorted(x for x in os.listdir(os.path.join(ROOT, 'cli'))):
    full = 'cli/' + p
    who = [s for s, _, _ in rev_static.get(full, [])] + [s for s, _, _, _ in rev_browser.get(full, [])]
    print('%-30s reach=%s refs=%s' % (full, full in reach, sorted(set(who))))

print('\n==== FILES V1 CALLED DEAD BUT REACHABLE NOW ====')
import csv
v1 = {}
with open(os.path.join(ROOT, '_governance', 'audit_files.csv'), encoding='utf-8-sig') as fh:
    for row in csv.DictReader(fh):
        p = row.get('path', '')
        if not p.endswith('.php'):
            continue
        if 'z_Deleted' in p or p.startswith('ProjectManager/vendor'):
            continue
        v1[p] = {'ref_by': row.get('ref_by', ''), 'bytes': row.get('bytes', '')}

# v1 statuses from the appendix table
appx = open(os.path.join(ROOT, '_governance', 'AUDIT-APPENDIX-FILE-STATUS.md'),
            encoding='utf-8', errors='replace').read()
v1_status = {}
for m in re.finditer(r'^\| `([^`]+\.php)` \| [^|]+ \| [^|]+ \| [^|]+ \| ([A-Z\-]+) \|', appx, re.M):
    v1_status[m.group(1)] = m.group(2)

print('v1 statuses parsed:', len(v1_status))
for p in sorted(reach):
    s = v1_status.get(p)
    if s and s in ('DEAD', 'REFERENCED-DEAD', 'ORPHAN-WEB', 'DEAD-BUT-WANTED', 'DEAD-CONFIG', 'UNREGISTERED'):
        print('  %-48s v1=%-16s reachable=YES' % (p, s))

print('\n==== UNREACHABLE FIRST-PARTY, WITH INBOUND ====')
for p in sorted(unreach):
    if p.startswith(('vendor/', 'lib/vendor/', 'lib/dompdf/')):
        continue
    who = sorted(set([s for s, _, _ in rev_static.get(p, [])]
                     + [s for s, _, _, _ in rev_browser.get(p, [])]))
    live = [w for w in who if w in reach]
    tag = 'INBOUND-FROM-LIVE' if live else ('INBOUND-FROM-DEAD' if who else 'NO-INBOUND')
    print('%-52s %-18s %s' % (p, tag, ', '.join(who)[:70]))
