# PROJECT RULES

1.
Build complete files.

2.
No patching.

3.
No live website development.

4.
Everything built in test environment.

5.
Replace production pages only after complete testing.

6.
Minimal explanations.

7.
Only explain failures.

8.
One source of truth.

9.
Every build updates:

Project Bible

Handoff

TOC

10.
Every new chat starts from current handoff.

11.
System-wide thinking before writing code.

12.
Architecture first.

13.
Micro tuning only after architecture is complete.

14.
Every file must be production quality.

15.
No experimental code inside production files.

16.

All file and folder naming must follow LVOS naming contract:

lowercase only
underscores only as separators
no hyphens allowed in filenames
zero-padded numeric prefixes (01–99) where ordering applies
names must reflect system hierarchy, not creation sequence
no mixed naming styles within a directory

17.
Directory consolidation does not modify naming standards.
Any migration (merge/move) must immediately conform to existing governance rules without introducing transitional formats.

18.
Prototype and test environments must still follow naming rules unless explicitly marked as archive/legacy.

19. Handoff files must be timestamped and stored as immutable system snapshots
20. Every handoff must include full system state (not partial summaries)
21. Always update current-handoff.md alongside timestamped backups





