# LVOS V2 GOVERNANCE SYSTEM

## CORE RULES

1. No partial file edits in production layer
2. All system changes must be full-file replacements
3. Demo layer is isolated from production layer
4. Page system must follow schema consistency
5. No parallel experimental architectures
6. All modules must reference shared token system
7. Navigation must remain structurally identical across pages
8. No orphaned files allowed

---

## PAGE SYSTEM RULES

- All pages must use:
  - .lv-page
  - .lv-hero
  - .lv-museum
  - .lv-card-grid
  - .lv-footer

- Navigation must be identical across all pages
- Relative paths must resolve only within /pages/demos/

---

## ARCHITECTURE CONTROL

- Core system is immutable unless explicitly upgraded
- Page system is expandable only after schema validation
- Labs are experimental but must not affect production/demo layers

---

## STABILITY PRINCIPLE

The system prioritizes:
STRUCTURAL CONSISTENCY > VISUAL VARIATION > EXPERIMENTATION