# LVOS V2 — PAGE SCHEMA HARDENING

Status: ACTIVE
Scope: Demo Layer Pages (01–08)
Version: 1.0

---

## PURPOSE

This document defines the canonical structural contract for all LVOS V2 demo pages.

All pages in `/pages/demos/` MUST conform to this schema without exception.

No stylistic deviation is allowed outside defined tokens, layout primitives, or motion rules.

---

## GLOBAL PAGE CONTRACT

Every page MUST include:

1. SYSTEM BOOT HEADER
2. TOKEN INJECTION BLOCK
3. CAMERA LAYER (if applicable)
4. LIGHT LAYER (if applicable)
5. CONTENT STACK
6. INTERACTION LAYER
7. FOOTER STATE

---

## REQUIRED PAGE STRUCTURE ORDER

1. `system-header`
2. `token-core`
3. `scene-container`
4. `camera-layer`
5. `light-layer`
6. `material-stage`
7. `content-stack`
8. `motion-overlay`
9. `ui-layer`
10. `footer-state`

---

## LAYER RULES

### 1. SYSTEM HEADER
- Declares LVOS version
- Declares page ID
- Declares render mode (demo only)

### 2. TOKEN CORE
- Must pull from `/assets/css/tokens.css`
- No inline overrides allowed

### 3. SCENE CONTAINER
- Root 3D / visual composition container
- Must exist even if empty

### 4. CAMERA LAYER
- Scroll-driven or static camera abstraction
- Must expose:
  - position
  - focus target
  - depth field reference

### 5. LIGHT LAYER
- Must support:
  - key light
  - fill light
  - ambient base
- Must be declarative only (no hardcoded values inside pages)

### 6. MATERIAL STAGE
- All visual surfaces defined here
- No content allowed in this layer

### 7. CONTENT STACK
- Only semantic content allowed
- Must NOT contain layout logic

### 8. MOTION OVERLAY
- All transitions, fades, scroll triggers
- No DOM structure changes allowed here

### 9. UI LAYER
- Navigation, buttons, overlays
- Must be non-invasive to content stack

### 10. FOOTER STATE
- Closing state machine for page
- Must reset camera/light to neutral

---

## ENFORCEMENT RULES

- No page may bypass any layer
- No inline styling outside token system
- No direct DOM manipulation outside motion layer
- No duplication of layout logic across pages
- All visual changes must originate from:
  tokens → materials → light → motion

---

## VALIDATION CHECKLIST

Each page must pass:

- [ ] Layer order correct
- [ ] Token dependency clean
- [ ] No inline styles
- [ ] Camera layer present
- [ ] Light layer present
- [ ] Motion isolation verified
- [ ] Content stack semantic only

---

END SPEC