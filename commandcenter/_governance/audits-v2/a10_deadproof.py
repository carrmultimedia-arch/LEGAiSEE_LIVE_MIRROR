#!/usr/bin/env python3
"""A10 — independent proof pass over the v1 dead list.

For every file v1 marked DEAD / REFERENCED-DEAD / ORPHAN-WEB:
  - search the whole tree for the full relative path and for the bare stem
  - classify each citing file as executable code, prose, or backup
  - a reference only rescues a file if the citer is executable AND alive
  - md5 every file so duplicates surface
"""
import os, re, hashlib, json, collections

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))
APX = os.path.join(ROOT, '_governance', 'AUDIT-APPENDIX-FILE-STATUS.md')
OUT_T = os.path.join(HERE, 'A10-table.md')
OUT_L = os.path.join(HERE, 'A10-lists.md')
OUT_J = os.path.join(HERE, 'A10-result.json')

SKIP_DIRS = {'_governance', '.git', 'vendor', 'node_modules', 'z_Deleted by claude', '_backup', 'archive'}
SKIP_EXT = {'.png', '.jpg', '.jpeg', '.gif', '.webp', '.ico', '.pdf', '.zip', '.woff', '.woff2',
            '.ttf', '.eot', '.svg', '.mp4', '.db', '.sqlite', '.gz', '.tar'}
TARGET = ('DEAD', 'REFERENCED-DEAD', 'ORPHAN-WEB')
CODE_EXT = {'.php', '.js', '.inc', '.html', '.htm', '.sh', '.py'}
PROSE_EXT = {'.md', '.txt'}

A1_RESCUED = {
    'engine/entity_extraction_engine.php', 'kernel/ingestion_pipeline.php', 'ui/ui_engine.php',
    'ui/layout.php', 'kernel/nav_engine.php', 'lib/semantic_diff_engine.php', 'prospect.php',
    'kernel/kernel.php', 'db.php', 'config.php', 'api/file.php', 'api/tree.php',
    'api/v8/network_add_node.php', 'engine/hierarchy_of_truth_engine.php',
    'engine/plain_english_helper.php',
}

# ---------- 1. the v1 ledger ----------
ledger, dead, seen = [], set(), set()
with open(APX, encoding='utf-8', errors='replace') as fh:
    for line in fh:
        if not line.lstrip().startswith('|'):
            continue
        cells = [c.strip() for c in line.strip().strip('|').split('|')]
        if len(cells) < 6:
            continue
        m = re.match(r'^`(.+)`$', cells[0])
        if not m:
            continue
        p = m.group(1)
        if p in seen:
            continue
        try:
            nb = int(cells[1].replace(',', ''))
            nl = int(cells[2].replace(',', ''))
        except ValueError:
            continue
        seen.add(p)
        ledger.append((p, nb, nl, cells[3], cells[4], cells[5]))
        if cells[4] in TARGET:
            dead.add(p)

all_paths = {r[0] for r in ledger}
print('ledger rows:        %d' % len(ledger))
print('in the dead set:    %d' % len([r for r in ledger if r[4] in TARGET]))

# ---------- 2. corpus ----------
corpus = {}
for dp, dns, fns in os.walk(ROOT):
    dns[:] = [d for d in dns if d not in SKIP_DIRS]
    for fn in fns:
        if os.path.splitext(fn)[1].lower() in SKIP_EXT:
            continue
        ap = os.path.join(dp, fn)
        try:
            if os.path.getsize(ap) > 3_000_000:
                continue
            with open(ap, encoding='utf-8', errors='replace') as h:
                corpus[os.path.relpath(ap, ROOT).replace(os.sep, '/')] = h.read()
        except OSError:
            pass
print('corpus files:       %d' % len(corpus))

# ---------- 3. duplicates ----------
digests = collections.defaultdict(list)
for p, *_ in ledger:
    ap = os.path.join(ROOT, p.replace('/', os.sep))
    if os.path.isfile(ap):
        try:
            digests[hashlib.md5(open(ap, 'rb').read()).hexdigest()].append(p)
        except OSError:
            pass
dup_of = {}
for v in digests.values():
    if len(v) > 1:
        for m in v:
            dup_of[m] = [x for x in v if x != m]

# ---------- 4. classify ----------
def kind(rel):
    low = rel.lower()
    if low.endswith('.phpbak') or low.endswith('.bak') or '.bak-' in low:
        return 'backup'
    if low.endswith('.htaccess'):
        return 'code'
    e = os.path.splitext(low)[1]
    if e in CODE_EXT:
        return 'code'
    if e in PROSE_EXT:
        return 'prose'
    return 'other'

def classify(path):
    base = os.path.basename(path)
    stem = base[:-4] if base.lower().endswith('.php') else base
    prx = re.compile(re.escape(path), re.I)
    srx = re.compile(r'(?<![\w/.-])' + re.escape(stem) + r'(?![\w.-])', re.I)
    ph, sh = [], []
    for rel, text in corpus.items():
        if rel == path:
            continue
        if prx.search(text):
            ph.append(rel)
        elif srx.search(text):
            sh.append(rel)
    hits = ph + sh
    callers = [h for h in hits if kind(h) == 'code' and h not in dead and h not in all_paths]
    prose = [h for h in hits if kind(h) in ('prose', 'backup')]
    if callers:
        v = 'LIVE-CODE'
    elif hits:
        v = 'PROSE-ONLY'
    else:
        v = 'ZERO-REF'
    return v, callers[:4], prose[:4], len(hits)

def logic(text):
    return len(re.findall(r'\b(function\s+\w+|class\s+\w+|CREATE\s+TABLE)\b', text, re.I))

results = []
for p, nb, nl, storage, status, citedby in ledger:
    if status not in TARGET:
        continue
    if p in A1_RESCUED:
        results.append(dict(path=p, status=status, verdict='A1-RESCUED', lines=nl, bytes=nb,
                            storage=storage, path_hits=[], prose_hits=[], n=0,
                            dup=dup_of.get(p, []), defs=0))
        continue
    v, callers, prose, n = classify(p)
    results.append(dict(path=p, status=status, verdict=v, lines=nl, bytes=nb, storage=storage,
                        path_hits=callers, prose_hits=prose, n=n,
                        dup=dup_of.get(p, []), defs=logic(corpus.get(p, ''))))

# ---------- 5. three lists ----------
def unique_logic(r):
    return (r['verdict'] in ('ZERO-REF', 'PROSE-ONLY')
            and not r['dup'] and r['defs'] >= 3 and r['lines'] >= 40)

safe  = [r for r in results if r['verdict'] in ('ZERO-REF', 'PROSE-ONLY') and not unique_logic(r)]
keep  = [r for r in results if unique_logic(r)]
human = [r for r in results if r['verdict'] == 'LIVE-CODE']

TABLE_HEAD = '| # | File | v1 status | Lines | Proof | Executable caller / prose mention | Duplicate of |\n|---:|---|---|---:|---|---|---|\n'
with open(OUT_T, 'w', encoding='utf-8') as fh:
    fh.write(TABLE_HEAD)
    for i, r in enumerate(sorted(results, key=lambda x: x['path'].lower()), 1):
        cite = ', '.join('`%s`' % c for c in (r['path_hits'] or r['prose_hits'])[:2]) or '—'
        dup = ', '.join('`%s`' % d for d in r['dup'][:1]) or '—'
        fh.write('| %d | `%s` | %s | %d | %s | %s | %s |\n'
                 % (i, r['path'], r['status'], r['lines'], r['verdict'], cite, dup))

def block(lf, title, rows, extra):
    lf.write('\n### %s — %d files\n\n%s\n\n' % (title, len(rows), extra))
    lf.write(TABLE_HEAD.replace('| # | File | v1 status | Lines | Proof | Executable caller / prose mention | Duplicate of |',
                                '| File | v1 status | Lines | Proof | Duplicate of |')
                      .replace('|---:|---|---|---:|---|---|---|', '|---|---|---:|---|---|'))
    for r in sorted(rows, key=lambda x: x['path'].lower()):
        if r['verdict'] == 'ZERO-REF':
            proof = 'zero references of any kind'
        elif r['verdict'] == 'LIVE-CODE':
            proof = 'called by `%s`' % (', '.join(r['path_hits'][:1]) or '?')
        else:
            proof = 'prose/backup only: `%s`' % (', '.join(r['prose_hits'][:1]) or '?')
        dup = ', '.join('`%s`' % d for d in r['dup'][:1]) or '—'
        lf.write('| `%s` | %s | %d | %s | %s |\n' % (r['path'], r['status'], r['lines'], proof, dup))

with open(OUT_L, 'w', encoding='utf-8') as lf:
    lf.write('# A10 — generated lists\n')
    block(lf, 'SAFE-TO-ARCHIVE', safe,
          'No executable file references these. Move to `_archive/`; do not delete (`00-GROUND-RULES.md` §6).')
    block(lf, 'KEEP-FOR-REUSE', keep,
          'Unreferenced by any executable, not a duplicate, and carrying unique logic (>=3 declarations, >=40 lines).')
    block(lf, 'NEEDS-HUMAN-DECISION', human,
          'An executable file that is not itself dead names these. Either a missed caller or a stale string.')

json.dump(results, open(OUT_J, 'w'), indent=1)

print()
for v, c in collections.Counter(r['verdict'] for r in results).most_common():
    print('%-12s %d' % (v, c))
print()
print('SAFE=%d  KEEP=%d  HUMAN=%d' % (len(safe), len(keep), len(human)))
print('dead-set bytes: %s   safe bytes: %s   keep bytes: %s'
      % (format(sum(r['bytes'] for r in results), ','),
         format(sum(r['bytes'] for r in safe), ','),
         format(sum(r['bytes'] for r in keep), ',')))
print('duplicate groups: %d' % len([v for v in digests.values() if len(v) > 1]))
print('\nwrote A10-table.md / A10-lists.md / A10-result.json')
