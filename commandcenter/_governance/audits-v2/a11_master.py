#!/usr/bin/env python3
"""A11 — merge A1..A10 into one verdict per file.

ARCHIVE is reserved for (a) byte duplicates and (b) proven-dead files belonging to a
superseded generation that no planned build still needs. A proven-dead file that
implements a capability the planned system still lacks is FINISH, not ARCHIVE.
"""
import os, re, json, collections

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))
APX = os.path.join(ROOT, '_governance', 'AUDIT-APPENDIX-FILE-STATUS.md')
CSV_OUT = os.path.join(HERE, 'A11-master-verdict.csv')
SUM_OUT = os.path.join(HERE, 'A11-summary.json')

# ---------- 1. universe ----------
files, v1 = [], {}
with open(APX, encoding='utf-8', errors='replace') as fh:
    for line in fh:
        if not line.lstrip().startswith('|'):
            continue
        c = [x.strip() for x in line.strip().strip('|').split('|')]
        if len(c) < 6:
            continue
        m = re.match(r'^`(.+)`$', c[0])
        if not m or m.group(1) in v1:
            continue
        try:
            nb, nl = int(c[1].replace(',', '')), int(c[2].replace(',', ''))
        except ValueError:
            continue
        files.append(m.group(1))
        v1[m.group(1)] = (c[4], nb, nl, c[3])

for extra in ['.htaccess', 'config.local.php', '.sftp.json', 'sftp.json',
              'db-before-migration-2026-10-29.sql', 'legaisee.db', 'kernel/legaisee.db']:
    if extra not in v1:
        files.append(extra)
        v1[extra] = ('NON-PHP', 0, 0, 'non_php')

# ---------- 2. defects ----------
defects = collections.defaultdict(list)
sev_of, sev_text = {}, {}
path_rx = re.compile(r'([A-Za-z0-9_][A-Za-z0-9_./\- ]*?\.(?:php|sql|json|db))')
row_rx = re.compile(r'^\|\s*(A\d-\d{3})\s*\|\s*(.+?)\s*\|\s*(.+?)\s*\|\s*(P[012])')
for fn in sorted(os.listdir(HERE)):
    if not re.match(r'^A\d-', fn) or not fn.endswith('.md') or fn.startswith('A10'):
        continue
    with open(os.path.join(HERE, fn), encoding='utf-8', errors='replace') as fh:
        for line in fh:
            m = row_rx.match(line)
            if not m:
                continue
            did, loc, text, sev = m.group(1), m.group(2), m.group(3), m.group(4)
            if 'reserved' in text.lower():
                continue
            sev_of[did] = sev
            sev_text[did] = (loc, text)
            paths = path_rx.findall(loc) or path_rx.findall(text)
            if not paths and '.htaccess' in loc:
                paths = ['.htaccess']
            for p in paths:
                p = p.strip().strip('`').strip()
                if p and not p.startswith('http'):
                    defects[p].append((did, sev))

a10 = {r['path']: r for r in json.load(open(os.path.join(HERE, 'A10-result.json')))}
dup = {p for p, r in a10.items() if r['dup']}
dead_proven = {p for p, r in a10.items() if r['verdict'] in ('ZERO-REF', 'PROSE-ONLY', 'LIVE-CODE')}

# ---------- 3. the build catalogue (OS Contents.txt + North Star) ----------
BUILDS = [
    ('B01', 'Core Kernel', 'V1'),
    ('B02', 'Brain layer (LLM orchestration)', 'V2'),
    ('B03', 'Analysis & extraction engines', 'V1'),
    ('B04', 'UI system — Master OS shell', 'V1'),
    ('B05', 'Data layer (MySQL migration)', 'V1'),
    ('B06', 'Tools & automation', 'V2'),
    ('B07', 'Project manager', 'V2'),
    ('B08', 'Knowledge system (compounding memory)', 'V2'),
    ('B09', 'Client & case intake / shallow dig', 'V1'),
    ('B10', 'Full dig (40+ channels)', 'V2'),
    ('B11', 'Reports, vault & delivery', 'V1'),
    ('B12', 'Billing & third-party support', 'V1'),
    ('B13', 'Live client dashboard & good-morning logic', 'V1'),
    ('B14', 'Authority Marketing System', 'V2'),
    ('B15', 'Pipeline monitoring & system health', 'V2'),
    ('B16', 'Artifact library, search & file access', 'V1'),
    ('B17', 'Yearly review dossier', 'V2'),
    ('B18', 'Autonomous digs & self-building', 'V3'),
    ('B19', 'Legaisee voice interface', 'V3'),
    ('B20', 'CAMERA Authority System', 'V1 (add-on)'),
]

# explicit per-file build assignments for the obvious ones
def build_for(p):
    low, base = p.lower(), os.path.basename(p.lower())
    if base in ('config.php', 'config.local.php', '.htaccess', '.sftp.json', 'sftp.json',
                'legaisee.db', 'db-before-migration-2026-10-29.sql', 'db.php') or low.startswith('kernel/db'):
        return 'B05'
    if low.startswith('kernel/'):
        return 'B15' if 'health' in base else 'B01'
    if low.startswith('engine/') or low.startswith('lib/'):
        if 'plain_english' in base:
            return 'B03'
        if 'semantic_diff' in base:
            return 'B04'
        if 'portfolio' in base or 'cross_case' in base:
            return 'B03'
        return 'B03'
    if low.startswith('api/v8/') or low == 'api.php':
        return 'B02'
    if low.startswith('api/'):
        if 'brain' in base or 'model_router' in base:
            return 'B02'
        if 'search' in base:
            return 'B16'
        if 'files' in base:
            return 'B16'
        if 'tree' in base:
            return 'B16'
        return 'B02'
    if low.startswith('modules/'):
        if any(k in base for k in ('ingest', 'insight', 'excavation', 'dig_review', 'prospect')):
            return 'B09'
        if 'build_dossier' in base or 'report' in base or 'vault' in base:
            return 'B11'
        if 'payment' in base:
            return 'B12'
        if 'pm_' in base or 'governance' in base:
            return 'B07'
        if any(k in base for k in ('search', 'files', 'compare', 'view')):
            return 'B16'
        if 'client_view' in base:
            return 'B13'
        if 'cockpit' in base or 'dashboard' in base:
            return 'B13'
        if 'brain' in base:
            return 'B02'
        return 'B03'
    if low.startswith(('ui/', 'views/', 'components/')):
        return 'B04'
    if low.startswith('pages/'):
        return 'B04'
    if low.startswith(('cli/', 'tools/')):
        return 'B06'
    if low.startswith('projectmanager/governance') or low.startswith('knowledgesystem'):
        return 'B08'
    if low.startswith('projectmanager/'):
        return 'B07'
    if low.startswith('excavationcommand/'):
        return 'B09'
    if 'prospect' in base or base == 'intelligence.php' or base == 'ingest.php' or base == 'ingest2.php':
        return 'B09'
    if 'payment' in base or 'stripe' in base:
        return 'B12'
    if low.startswith('database/') or 'migration' in low or 'schema' in base:
        return 'B05'
    if base in ('create_findings_tables.php', 'create_review_flags.php'):
        return 'B11'
    return 'B01'

def subsystem_for(p):
    for pre, name in [('ProjectManager/', 'ProjectManager (standalone)'), ('engine/', 'Brain / engines'),
                      ('lib/', 'Brain / engines'), ('kernel/', 'Kernel'), ('modules/', 'Modules'),
                      ('api/v8/', 'API (v8)'), ('api/', 'API'), ('ui/', 'UI'), ('views/', 'UI'),
                      ('pages/', 'UI'), ('components/', 'UI'), ('cli/', 'Tools'), ('tools/', 'Tools'),
                      ('database/', 'Data layer'), ('ExcavationCommand/', 'Intake (legacy)')]:
        if p.startswith(pre):
            return name
    return 'Root / config'

# ---------- 4. verdict ----------
# generations replaced by a live equivalent — proven dead here means archive, not wire
SUPERSEDED = ('api/v8/', 'pages/', 'components/', 'tools/', 'ExcavationCommand/',
              'database/migrations/', 'ProjectManager/app/', 'ProjectManager/api/',
              'ProjectManager/tests/', 'ProjectManager/database/migrations/')
REFERENCE_KEEP = ('ProjectManager/governance/', 'ProjectManager/permissions.php',
                  'ProjectManager/database/schema.php', 'ProjectManager/database/connection.php',
                  'ProjectManager/config.php', 'ProjectManager/bootstrap.php',
                  'ProjectManager/router.php', 'ProjectManager/index.php',
                  'ProjectManager/projects_dashboard.php', 'ProjectManager/project_board.php')
FINISH_ENGINES = ('engine/plain_english_helper.php', 'engine/hierarchy_of_truth_engine.php')

def verdict_for(p):
    ds = defects.get(p, [])
    sevs = {s for _, s in ds}
    low = p.lower()
    if p == 'views/graph_view.php':
        return 'KEEP', 'live module dependency filed in the wrong directory (A1-005)'
    if p in dup:
        return 'ARCHIVE', 'byte-identical duplicate (A10 §2)'
    if p.startswith(REFERENCE_KEEP):
        return 'KEEP', 'spec / config for the project-manager build'
    if low.startswith(SUPERSEDED):
        if p in dead_proven:
            return 'ARCHIVE', 'proven dead and its generation is replaced by a live file'
        return 'FIX' if sevs & {'P0', 'P1'} else 'KEEP', 'reachable or referenced inside a superseded tree'
    if p in FINISH_ENGINES:
        return 'FINISH', 'capability the planned build needs, called by nothing (A5-009 / A1 §4)'
    if low.startswith('engine/') and p in dead_proven:
        return 'FINISH', 'engine capability unwired; the build still needs it'
    if 'P0' in sevs or 'P1' in sevs:
        return 'FIX', 'serves a planned build and carries P0/P1 defects'
    if p in dead_proven:
        return 'ARCHIVE', 'proven dead, serves no planned build'
    if v1[p][0] in ('UNWIRED', 'ORPHAN-WEB', 'DEAD-CONFIG', 'DEAD-BUT-WANTED'):
        return 'FINISH', 'complete but nothing loads it'
    return 'KEEP', 'reachable, no recorded P0/P1'

def order_for(p, v):
    sevs = {s for _, s in defects.get(p, [])}
    if 'P0' in sevs:
        sec = any(k in p for k in ('shell.php', '.htaccess', 'config', 'files_action',
                                   'brain_orchestr', 'ingest_module', 'payment_module'))
        return '1' if sec else '2'
    if 'P1' in sevs:
        return '3'
    if 'P2' in sevs:
        return '4'
    return {'FINISH': '5', 'ARCHIVE': '6'}.get(v, '4')

rows = []
for p in files:
    b = build_for(p)
    v, why = verdict_for(p)
    rows.append(dict(path=p, subsystem=subsystem_for(p), build=b, verdict=v, why=why,
                     defects=','.join(sorted({d for d, _ in defects.get(p, [])})),
                     order=order_for(p, v)))

with open(CSV_OUT, 'w', encoding='utf-8', newline='') as fh:
    fh.write('File,Subsystem,Planned build it serves,Verdict,Defect IDs,Fix order\n')
    q = lambda s: '"%s"' % str(s).replace('"', '""')
    bname = {b[0]: b[1] for b in BUILDS}
    for r in sorted(rows, key=lambda x: (x['order'], x['path'].lower())):
        fh.write(','.join([q(r['path']), q(r['subsystem']), q('%s %s' % (r['build'], bname[r['build']])),
                           q(r['verdict']), q(r['defects']), q(r['order'])]) + '\n')

counts = collections.Counter(r['verdict'] for r in rows)
by_build = collections.defaultdict(collections.Counter)
for r in rows:
    by_build[r['build']][r['verdict']] += 1
p0 = sorted({d for ds in defects.values() for d, s in ds if s == 'P0'})
p1 = sorted({d for ds in defects.values() for d, s in ds if s == 'P1'})
json.dump(dict(counts=dict(counts), by_build={k: dict(v) for k, v in by_build.items()},
               p0=p0, p1=p1, total=len(rows), builds=BUILDS,
               sev_text={k: list(v) for k, v in sev_text.items()}),
          open(SUM_OUT, 'w'), indent=1)

print('rows %d' % len(rows), dict(counts))
print('P0 %d | P1 %d' % (len(p0), len(p1)))
for b, name, ph in BUILDS:
    c = by_build.get(b, collections.Counter())
    print('  %s %-46s %s' % (b, name, dict(c)))
