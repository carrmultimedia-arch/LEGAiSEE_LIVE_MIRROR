# LEGAiSEE Public Website 2.0

## Purpose

A clean, governance-led rebuild of the public LEGAiSEE website. This project is separate from the current live site and separate from the LEGAiSEE Command Center.

## Non-negotiable build rules

1. Build new production files from scratch: HTML/PHP, CSS, JavaScript, and shared components.
2. Do not import, extend, or patch the current site's CSS or JavaScript.
3. Port only approved copy, approved images, essential brand assets, and verified functionality.
4. Treat the Lixury Governance doctrine as binding design law. The doctrine governs visual and interaction decisions.
5. Build and test in this isolated directory. Do not modify the current live root during development.
6. Rebuild one page at a time, beginning with the homepage. The homepage establishes the visual and component language for all following pages.
7. Reuse shared components where consistency is required; art-direct each page where its content requires a distinct composition.
8. No placeholder production imagery, dummy copy, dead controls, or unverified integrations.
9. Preserve existing public URLs at cutover wherever practical.
10. At final cutover, preserve replaced originals as `.bak` files. Do not rename or replace live files before their new counterparts pass validation.
11. Keep the Command Center, its backend code, and its interface outside this public-site rebuild.
12. Keep a build log and update the page inventory as work is completed.

## Planned structure

```
public_site_v2/
  index.html
  pages/
  components/
  assets/
    css/
    js/
    images/
    fonts/
    icons/
  docs/
    rebuild_inventory.md
    content_porting_register.md
    functionality_register.md
    qa_checklist.md
    build_log.md
```

The structure may be extended only when a concrete implementation need is identified. Do not create empty framework layers or speculative subsystems.

## Build sequence

1. Inventory and protect the current site.
2. Translate the governing doctrine into a practical implementation specification.
3. Establish the homepage design system and build the homepage.
4. Validate the homepage at desktop, tablet, and mobile sizes.
5. Lock the shared foundation.
6. Rebuild remaining public pages one at a time.
7. Validate all routes, forms, links, accessibility, performance, and integrations.
8. Cut over only after the complete site passes validation.

## Current state

- Rebuild branch: `public-site-v2`
- Production site: unchanged
- First build target: homepage
- New museum photography: awaiting user's supplied asset set
- Doctrine URL: `https://www.legaisee.com/Lixury_Governance.md`
