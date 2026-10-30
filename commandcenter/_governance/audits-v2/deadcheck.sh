#!/usr/bin/env bash
# =============================================================================
# deadcheck.sh — DEAD-proof harness (audit v2, Block A0 item 5)
# VERSION: 3 (grep-based; full-path proof; index-cache aware)
# =============================================================================
# A file is DEAD only when the whole tree holds ZERO execution references to
# it. This prints that search, class by class, with line numbers.
#
# usage:  bash deadcheck.sh <path> [<path>...]
#         bash deadcheck.sh --selftest
#
# v3 corrections over v2 (both were producing wrong verdicts):
#   1. PRIMARY proof matches the FULL RELATIVE PATH ("engine/graph_engine.php"),
#      not the bare basename. With a duplicated basename the bare name credits
#      both copies with the same caller. A separate clearly-labelled
#      "basename-only" pass shows the ambiguity instead of hiding it.
#   2. FILE-INDEX ARTEFACTS ARE NOT REFERENCES. `system_index_cache.json` is a
#      generated listing of paths that exist; it names every file and calls
#      nothing. It is quarantined into class INDEX and excluded from counts.
#      Same for *_cache.json, index.json, inventory.txt.
#
# Reference classes counted as proof:
#   1 php-include   require/include(_once) naming the file
#   2 php-string    other PHP occurrence (arrays, registry, call sites)
#   3 js-browser    .js/.mjs/.html/.htm string
#   4 htaccess      .htaccess / web.config / *.ini / *.conf
#   5 config        .json/.yaml/.yml  (autoload, cron manifests)
#   6 shell/task    .sh/.bat/.ps1/.py
#   7 stem-only     bare stem, word-bounded (registry keys, hand-built paths)
# Revealed but never counted: archive copies, INDEX artefacts, doc mentions.
#
# DESIGN RULE: a search that errors (missing tool, unreadable dir) makes the
# verdict INVALID. Silence must never be reportable as "zero references".
# =============================================================================
set -uo pipefail

HERE="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT="$(cd "$HERE/../.." && pwd)"
cd "$ROOT" || { echo "FATAL: cannot cd $ROOT"; exit 2; }

INCLUDE_ALL=(--include='*.php' --include='*.phtml' --include='*.inc'
             --include='*.js' --include='*.mjs' --include='*.cjs'
             --include='*.html' --include='*.htm'
             --include='.htaccess' --include='web.config'
             --include='*.ini' --include='*.conf'
             --include='*.json' --include='*.yaml' --include='*.yml'
             --include='*.sh' --include='*.bat' --include='*.ps1' --include='*.py')

EXCLUDE_DIRS=(--exclude-dir=.git --exclude-dir=vendor --exclude-dir=node_modules
              --exclude-dir=_governance --exclude-dir=dompdf)

ARCH_PAT='(z_Deleted|_backup|/archive/|\.bak)'
INDEX_PAT='(system_index_cache|_cache\.json|/index\.json:|/inventory[^/]*\.txt|\.index\.json)'

WORK="$(mktemp -d "${TMPDIR:-/tmp}/deadcheck.XXXXXX")" || exit 2
trap 'rm -rf "$WORK"' EXIT
ERRORS=0

g() { # g <outfile> <grep-args...>  — never hides a tool failure
  local out="$1"; shift
  grep -rn --binary-files=without-match "${EXCLUDE_DIRS[@]}" "$@" . >"$out" 2>"$out.err"
  local rc=$?
  if [ "$rc" -ge 2 ]; then
    printf '  !! SEARCH ERROR (rc=%s) — %s — VERDICT INVALID\n' "$rc" "$(basename "$out")"
    sed -n '1,2p' "$out.err" | sed 's/^/     /'
    ERRORS=$((ERRORS+1)); : >"$out"; return 2
  fi
  return 0
}

# split <raw> <tag>  -> <tag>.live  <tag>.arch  <tag>.idx
split_refs() {
  local raw="$1" tag="$2"
  grep -Ev "$SELFPAT" "$raw" 2>/dev/null >"$tag.n" || : >"$tag.n"
  grep -E "$ARCH_PAT"  "$tag.n" 2>/dev/null >"$tag.arch" || : >"$tag.arch"
  grep -Ev "$ARCH_PAT" "$tag.n" 2>/dev/null >"$tag.noarch" || : >"$tag.noarch"
  grep -E "$INDEX_PAT" "$tag.noarch" 2>/dev/null >"$tag.idx"    || : >"$tag.idx"
  grep -Ev "$INDEX_PAT" "$tag.noarch" 2>/dev/null >"$tag.live"  || : >"$tag.live"
}

count() { wc -l <"$1" 2>/dev/null | tr -d ' ' || echo 0; }

show() { # show <label> <file> [max]
  local label="$1" f="$2" max="${3:-20}" n
  n=$(count "$f")
  if [ "$n" -eq 0 ]; then printf '  %-14s : 0\n' "$label"
  else printf '  %-14s : %s\n' "$label" "$n"; head -"$max" "$f" | sed 's/^/      /'
       [ "$n" -gt "$max" ] && printf '      ... (%s more)\n' "$((n-max))"
  fi
}

check_one() {
  local target="${1#./}"
  local base stem rel esc
  base="$(basename "$target")"
  stem="${base%.*}"
  rel="$target"
  esc="$(printf '%s' "$rel" | sed 's/[][\.^$*+?(){}|]/\\&/g')"
  SELFPAT="^\\./${target//./\\.}:"

  echo "=============================================================================="
  echo "TARGET: $target"
  echo "PROOF KEY: \"$rel\"  (full relative path substring)"
  echo "=============================================================================="

  # duplicate-basename warning — the v1 trap
  local dups dupn
  dups=$(find . -name "$base" -not -path './.git/*' -not -path '*/vendor/*' -not -path '*/node_modules/*' 2>/dev/null)
  dupn=$(printf '%s\n' "$dups" | grep -c . || true)
  if [ "$dupn" -gt 1 ]; then
    echo "  !! DUPLICATED BASENAME ($dupn copies) — bare-name proof is ambiguous here:"
    printf '%s\n' "$dups" | head -8 | sed 's/^/       /'
  fi

  # PRIMARY: full relative path, all executable file types
  g "$WORK/rel" "${INCLUDE_ALL[@]}" -F "$rel"
  split_refs "$WORK/rel" "$WORK/rel"

  # detail passes (same filters applied)
  g "$WORK/inc" "${INCLUDE_ALL[@]}" --include='*.php' --include='*.phtml' --include='*.inc' \
      -E "(require|include)(_once)?[^;]{0,80}${esc}"
  split_refs "$WORK/inc" "$WORK/inc"
  g "$WORK/js" --include='*.js' --include='*.mjs' --include='*.cjs' --include='*.html' --include='*.htm' -F "$rel"
  split_refs "$WORK/js" "$WORK/js"
  g "$WORK/cfg" --include='.htaccess' --include='web.config' --include='*.ini' --include='*.conf' -F "$rel"
  split_refs "$WORK/cfg" "$WORK/cfg"
  g "$WORK/stem" --include='*.php' --include='*.js' --include='*.html' -w -F "$stem"
  split_refs "$WORK/stem" "$WORK/stem"

  echo "--- references to the full path ---"
  show "php-include" "$WORK/inc.live"
  show "php-string"  "$WORK/rel.live"
  show "js-browser"  "$WORK/js.live"
  show "server-config" "$WORK/cfg.live"
  echo "--- stem-only (registry keys, hand-built paths) ---"
  show "stem"        "$WORK/stem.live" 12

  local arch idx stemn live
  live=$(count "$WORK/rel.live")
  arch=$(count "$WORK/rel.arch")
  idx=$(count "$WORK/rel.idx")
  stemn=$(count "$WORK/stem.live")

  # basename-only, shown with its ambiguity, never counted as proof
  g "$WORK/base" --include='*.php' --include='*.js' --include='*.html' -F "$base"
  split_refs "$WORK/base" "$WORK/base"

  local docn
  docn=$(grep -rl --binary-files=without-match --include='*.md' --include='*.txt' \
         --exclude-dir=.git --exclude-dir=vendor -F "$base" . 2>/dev/null | wc -l | tr -d ' ')

  echo "------------------------------------------------------------------------------"
  echo "  live: $live   archive: $arch   index-artefact: $idx   stem: $stemn   DOC-ONLY: $docn"
  echo "  basename-only (ambiguous if duplicated): $(count "$WORK/base.live") — not used as proof"
  if [ "$ERRORS" -gt 0 ]; then
    echo "  PROOF: INVALID — a search failed; do not assign DEAD"
  elif [ "$live" -eq 0 ] && [ "$stemn" -eq 0 ]; then
    echo "  PROOF: 0 execution references to \"$rel\" -> DEAD eligible"
  elif [ "$live" -eq 0 ]; then
    echo "  PROOF: 0 full-path refs, $stemn stem-only -> inspect stems (hand-built path?)"
  else
    echo "  PROOF: $live live reference(s) -> NOT dead; classify the caller(s) above"
  fi
  echo
}

if [ "${1:-}" = "--selftest" ]; then
  echo "SELFTEST — positive control, negative control, duplicate-name control."
  check_one "kernel/db.php"       >"$WORK/pos.txt"
  check_one "Color_Creator.php"   >"$WORK/neg.txt"
  check_one "kernel/graph_engine.php" >"$WORK/dup.txt"
  pos=$(grep -oE 'live: [0-9]+' "$WORK/pos.txt" | head -1 | grep -oE '[0-9]+')
  neg=$(grep -c 'DEAD eligible' "$WORK/neg.txt" || true)
  dup=$(grep -oE 'live: [0-9]+' "$WORK/dup.txt" | head -1 | grep -oE '[0-9]+')
  echo "  positive  kernel/db.php          live=$pos   (must be > 0)"
  echo "  negative  Color_Creator.php      dead-eligible=$neg  (must be 1)"
  echo "  duplicate kernel/graph_engine.php live=$dup   (must be 0; the caller belongs to engine/)"
  if [ "${pos:-0}" -gt 0 ] && [ "$neg" -eq 1 ] && [ "${dup:-1}" -eq 0 ]; then
    echo "SELFTEST PASS"; exit 0
  fi
  echo "SELFTEST FAIL — do not trust DEAD verdicts"; exit 1
fi

if [ "$#" -eq 0 ]; then
  echo "usage: bash deadcheck.sh <path> [<path>...]  |  --selftest"; exit 2
fi
for t in "$@"; do check_one "$t"; done
exit $(( ERRORS > 0 ? 3 : 0 ))
