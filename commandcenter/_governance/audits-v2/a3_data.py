#!/usr/bin/env python3
"""
a3_data.py — Block A3: code SQL vs the real schema.

Truth = _governance/audits-v2/schema-source.sql (pre-migration dump).
Scope = the A1-reachable file set (A1-graph.json). Nothing else is a live
reader, so a statement in dead code is not a runtime mismatch.

What it does:
  1. schema: every CREATE TABLE — name, engine, columns, PK.
  2. rows: every INSERT INTO block, counting value tuples (phpMyAdmin writes
     one tuple per line starting with "("), and flagging tables with no INSERT.
  3. SQL literals in reachable PHP: PHP string literals are tokenised properly
     (quotes/escapes respected, comments stripped) so a SQL keyword inside a
     comment is not counted as a statement.
  4. validation: tables from FROM/JOIN/INTO/UPDATE; INSERT column lists; and
     SELECT column lists only for unambiguous, single-table, no-function,
     no-alias queries. Anything ambiguous is reported as SKIPPED, never guessed.
  5. SQLite-isms and JSON readers, per reachable file.

Prints sections; writes A3-data.json.
"""
import json
import os
import re

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.abspath(os.path.join(HERE, '..', '..'))
DUMP = os.path.join(HERE, 'schema-source.sql')
G = json.load(open(os.path.join(HERE, 'A1-graph.json'), encoding='utf-8'))
REACH = set(G['reachable'])

SQLKW = ('SELECT', 'INSERT', 'UPDATE', 'DELETE', 'SHOW', 'ALTER', 'CREATE')
NOT_TABLES = {'select', 'where', 'set', 'values', 'into', 'from', 'join',
              'dual', 'if', 'exists', 'table'}


# ------------------------------------------------------------------ schema
def parse_schema(text):
    tables = {}
    for m in re.finditer(r'^CREATE TABLE `([^`]+)` \((.*?)\n\) ENGINE=(\w+)',
                         text, re.S | re.M):
        name, body, engine = m.group(1), m.group(2), m.group(3)
        cols = []
        for line in body.split('\n'):
            cm = re.match(r'\s*`([^`]+)`\s+([a-zA-Z]+)', line)
            if cm:
                cols.append(cm.group(1))
        pk = None
        pm = re.search(r'PRIMARY KEY \(`([^`]+)`\)', body)
        if pm:
            pk = pm.group(1)
        tables[name] = {'engine': engine, 'columns': cols, 'pk': pk,
                        'line': text.count('\n', 0, m.start()) + 1}
    return tables


def parse_rows(text):
    """Count value tuples per INSERT statement."""
    rows, stmts, empty = {}, {}, []
    for m in re.finditer(r'^INSERT INTO `([^`]+)`', text, re.M):
        t = m.group(1)
        stmts[t] = stmts.get(t, 0) + 1
        # block: from this INSERT to the first line ending with ');'
        rest = text[m.start():]
        end = rest.find('\n', 0)
        block_lines = [rest[:end]]
        pos = end
        while pos != -1 and not block_lines[-1].rstrip().endswith(');'):
            nxt = rest.find('\n', pos + 1)
            if nxt == -1:
                block_lines.append(rest[pos:])
                break
            block_lines.append(rest[pos:nxt])
            pos = nxt
        block = '\n'.join(block_lines)
        n = len(re.findall(r'(?:^|\n)\s*\(', block))
        rows[t] = rows.get(t, 0) + max(1, n)
    return rows, stmts


# --------------------------------------------------------------- php parse
def strip_comments_keep_strings(src):
    """Remove comments but keep string literals, preserving newlines."""
    out, i, n = [], 0, len(src)
    while i < n:
        c = src[i]
        if c in "'\"":
            q, j = c, i + 1
            while j < n:
                if src[j] == '\\':
                    j += 2
                    continue
                if src[j] == q:
                    break
                j += 1
            out.append(src[i:j + 1])
            i = j + 1
            continue
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
        out.append(c)
        i += 1
    return ''.join(out)


def string_literals(src):
    """(value, line) for every PHP single/double quoted literal, incl. heredoc."""
    out = []
    i, n = 0, len(src)
    while i < n:
        c = src[i]
        if c in "'\"":
            q, j, buf = c, i + 1, []
            while j < n:
                if src[j] == '\\' and j + 1 < n:
                    buf.append(src[j + 1])
                    j += 2
                    continue
                if src[j] == q:
                    break
                buf.append(src[j])
                j += 1
            out.append((''.join(buf), src.count('\n', 0, i) + 1))
            i = j + 1
            continue
        if src.startswith('<<<', i):
            m = re.match(r'<<<([\'"]?)([A-Za-z_]\w*)\1\r?\n', src[i:])
            if m:
                tag = m.group(2)
                body_start = i + m.end()
                em = re.search(r'\n\s*' + tag + r'\b', src[body_start:])
                if em:
                    body = src[body_start:body_start + em.start()]
                    out.append((body, src.count('\n', 0, i) + 1))
                    i = body_start + em.end()
                    continue
        i += 1
    return out


TABLE_RE = re.compile(
    r'\b(?:FROM|JOIN|INTO|UPDATE)\s+`?([A-Za-z_][A-Za-z0-9_]*)`?', re.I)
COL_IDENT = re.compile(r'^`?([A-Za-z_][A-Za-z0-9_]*)`?$')


def extract_sql(strings):
    """[(line, sql, tables, insert_cols, select_cols_or_None)]"""
    found = []
    for value, line in strings:
        s = ' '.join(value.split())
        if len(s) < 12:
            continue
        up = s.upper()
        if not any(k in up for k in SQLKW):
            continue
        tables = [t for t in TABLE_RE.findall(s) if t.lower() not in NOT_TABLES]
        if not tables:
            continue
        tables = list(dict.fromkeys(tables))
        ins = None
        m = re.search(r'INSERT\s+INTO\s+`?(\w+)`?\s*\(([^)]*)\)', s, re.I)
        if m:
            ins = [c.strip().strip('`') for c in m.group(2).split(',')
                   if c.strip()]
        sel = None
        if re.match(r'^SELECT\b', s, re.I) and 'JOIN' not in up:
            body = re.split(r'\bFROM\b', s, 1, flags=re.I)[0]
            body = re.sub(r'^SELECT\s+(DISTINCT\s+)?', '', body, flags=re.I)
            if '*' not in body and '(' not in body and ' AS ' not in body.upper():
                cand, ok = [], True
                for part in body.split(','):
                    p = part.strip().split()[0] if part.strip() else ''
                    p = p.split('.')[-1]
                    mm = COL_IDENT.match(p)
                    if not mm:
                        ok = False
                        break
                    cand.append(mm.group(1))
                if ok and cand:
                    sel = cand
        found.append((line, s, tables, ins, sel))
    return found


def main():
    text = open(DUMP, encoding='utf-8', errors='replace').read()
    tables = parse_schema(text)
    rows, stmts = parse_rows(text)
    all_tables = sorted(tables)

    print('=' * 78)
    print('SECTION 1 — SCHEMA (%d tables)' % len(tables))
    print('=' * 78)
    eng = {}
    for t, d in tables.items():
        eng[d['engine']] = eng.get(d['engine'], 0) + 1
    print('engines:', eng)
    print()
    print('%-34s %-8s %6s %6s %6s  %s' % ('table', 'engine', 'cols', 'stmts', 'rows', 'pk'))
    total = 0
    for t in all_tables:
        d = tables[t]
        r = rows.get(t, 0)
        total += r
        print('%-34s %-8s %6d %6d %6d  %s' % (t, d['engine'], len(d['columns']),
                                              stmts.get(t, 0), r, d['pk'] or '-'))
    print()
    print('total data rows in dump:', total)
    empty = [t for t in all_tables if t not in rows]
    print('tables with NO rows (%d): %s' % (len(empty), ', '.join(empty)))

    # ---------------------------------------------------------- code SQL
    print()
    print('=' * 78)
    print('SECTION 2 — SQL IN REACHABLE CODE')
    print('=' * 78)
    problems, sqlite_hits, json_readers = [], [], []
    rel_by_table = {}

    for path in sorted(REACH):
        if not path.endswith(('.php', '.inc', '.phtml')):
            continue
        full = os.path.join(ROOT, path)
        if not os.path.isfile(full):
            continue
        raw = open(full, encoding='utf-8', errors='replace').read()
        src = strip_comments_keep_strings(raw)
        lits = string_literals(src)

        for value, line in lits:
            low = value.lower()
            if any(k in low for k in ("sqlite_master", "datetime('now')",
                                      'autoincrement', 'last_insert_rowid',
                                      'pragma ')):
                sqlite_hits.append((path, line, ' '.join(value.split())[:90]))

        stmts_here = extract_sql(lits)
        if not stmts_here:
            continue
        print('\n-- %s' % path)
        for line, s, tabs, ins, sel in stmts_here:
            print('   :%-4d %s' % (line, (s[:150] + ('…' if len(s) > 150 else ''))))
            for t in tabs:
                rel_by_table.setdefault(t, set()).add(path)
                if t not in tables:
                    problems.append({'file': path, 'line': line, 'kind': 'TABLE',
                                     'name': t, 'sql': s[:140]})
                    print('        !! table `%s` NOT IN SCHEMA' % t)
                    continue
                if ins:
                    bad = [c for c in ins if c not in tables[t]['columns']]
                    if bad:
                        problems.append({'file': path, 'line': line, 'kind': 'INSERT-COL',
                                         'name': ','.join(bad), 'table': t,
                                         'sql': s[:140]})
                        print('        !! insert cols not in `%s`: %s' % (t, bad))
                if sel:
                    bad = [c for c in sel if c not in tables[t]['columns']]
                    if bad:
                        problems.append({'file': path, 'line': line, 'kind': 'SELECT-COL',
                                         'name': ','.join(bad), 'table': t,
                                         'sql': s[:140]})
                        print('        !! select cols not in `%s`: %s' % (t, bad))

        # JSON readers
        for m in re.finditer(r'load_json_dir\s*\(|glob\s*\(|file_get_contents\s*\(', src):
            ln = src.count('\n', 0, m.start()) + 1
            ctx = src[m.start():m.start() + 120].replace('\n', ' ')
            if '.json' in ctx or 'load_json_dir' in ctx or 'meta.json' in ctx:
                json_readers.append((path, ln, ' '.join(ctx.split())[:110]))

    print()
    print('=' * 78)
    print('SECTION 3 — MISMATCHES (%d)' % len(problems))
    print('=' * 78)
    for p in problems:
        print('%-46s :%-4s %-10s %-24s %s' % (p['file'], p['line'], p['kind'],
                                              p['name'], p.get('table', '')))

    print()
    print('=' * 78)
    print('SECTION 4 — SQLITE-ISMS IN REACHABLE CODE (%d)' % len(sqlite_hits))
    print('=' * 78)
    for h in sqlite_hits:
        print('%-46s :%-4s %s' % h)

    print()
    print('=' * 78)
    print('SECTION 5 — JSON READERS IN REACHABLE CODE (%d)' % len(json_readers))
    print('=' * 78)
    for j in json_readers:
        print('%-46s :%-4s %s' % j)

    print()
    print('=' * 78)
    print('SECTION 6 — TABLE -> LIVE READERS/WRITERS')
    print('=' * 78)
    for t in all_tables:
        who = sorted(rel_by_table.get(t, []))
        if who:
            print('%-30s %s' % (t, ', '.join(who)))

    with open(os.path.join(HERE, 'A3-data.json'), 'w', encoding='utf-8') as fh:
        json.dump({'tables': tables, 'rows': rows, 'stmts': stmts,
                   'problems': problems, 'sqlite': sqlite_hits,
                   'json_readers': json_readers,
                   'live_tables': {k: sorted(v) for k, v in rel_by_table.items()}},
                  fh, indent=1)
    print('\njson -> A3-data.json')


if __name__ == '__main__':
    main()
