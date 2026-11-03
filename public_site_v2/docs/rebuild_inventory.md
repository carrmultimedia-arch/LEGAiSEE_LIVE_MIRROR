# Existing Public Site — Rebuild Inventory

## Scope

Repository: `carrmultimedia-arch/LEGAiSEE_LIVE_MIRROR`  
Default branch at inventory: `main`  
Inventory basis: recursive Git tree and root-level source review  
Repository tree entries: 5,741

This inventory concerns the public website only. The Command Center and backend operating system are excluded.

## Current public page files

| File | Current role | Rebuild disposition |
|---|---|---|
| `index.html` | Homepage | Rebuild first |
| `archaeology.html` | Business Archaeology | Rebuild |
| `method.html` | Method / frameworks | Rebuild |
| `serve.html` | Who We Serve | Rebuild |
| `architect.html` | Architect | Rebuild |
| `practitioner.html` | Practitioner | Rebuild |
| `commissions.html` | Commissions | Rebuild |
| `registry.html` | Private Registry | Rebuild; preserve verified workflow |
| `comparison.html` | Comparison / explanatory page | Rebuild or consolidate after content review |
| `career.html` | Career resource | Not in primary LEGAiSEE navigation; keep separate pending future portfolio/career consolidation |
| `portfolio.html` | Portfolio resource | Separate destination; not part of primary public-site page sequence |

## Existing source files not to reuse as the new foundation

- `legaisee.css`
- `legaisee-luxury.css`
- `legaisee-master.css`
- `index-lighting.css`
- Existing page-embedded CSS
- Existing page-specific JavaScript

These remain available as historical reference only. The new site must not depend on them.

## Existing design-system directories

The repository contains prior design-system generations, including:

- `legaisee-design-system/`
- `legaisee-design-system-v2/`
- `Kimi Rebuild 6-18-26/`
- `_oldwww/`

They are historical research/reference material, not the new production codebase. Their useful concepts may be evaluated against the governing doctrine, but their implementation files are not to be imported into the new build.

## Existing image inventory

- `Images/` contains 81 tracked image files.
- Combined image payload is approximately 411.6 MB.
- The `Images/360/` directory contains very large panoramic images, many approximately 13–28 MB each.
- The repository's current image collection is not automatically approved for the rebuild.
- User has newer, less-obtrusive museum photography intended for consideration.
- Final image selection, crop, dimensions, format, and compression must be decided for each page.

## Confirmed preservation principles

1. Preserve the existing site while the new site is developed.
2. Port copy only after content review.
3. Port images only after visual approval.
4. Preserve existing public URLs where practical.
5. Identify and test every form, endpoint, external script, and private-registry interaction before cutover.
6. Keep Career and Portfolio separate from the main page sequence unless the information architecture review explicitly changes that decision.

## Work still required before homepage cutover

- Read and translate the complete Lixury Governance doctrine into implementation rules.
- Inspect the latest museum photo set supplied by the user.
- Extract and classify current homepage copy.
- Inventory homepage links, scripts, buttons, forms, and tracking.
- Confirm any server-side behavior that the homepage depends on.
- Establish desktop, tablet, and mobile acceptance checks.

## Status

Inventory baseline created. No production files changed. No current public files renamed. No live deployment performed.
