# Homepage Porting Register — LEGAiSEE 2.0

## Source

Current source: `index.html` on `main`  
Page structure: 9 primary sections  
Current external runtime dependency: Lenis scroll library  
Current homepage form count: none detected  
Current primary navigation destinations: Home, Archaeology, Method, Who We Serve, Architect, Practitioner, Commissions, Registry

This is a content and behavior transfer plan, not approval of the existing visual design or source code.

## Section-by-section content disposition

| Current section | Existing material | Disposition | Rebuild direction |
|---|---|---|---|
| 01 — Hero | Business Archaeology / Authority Systems; “The Restoration of Asymmetric Authority”; forensic excavation and reconstruction promise; Registry and Archaeology CTAs | REVISE | Preserve the core promise and strong authority language. Reconcile the brand descriptor with current positioning before final headline/copy. Keep one primary action and one secondary action. |
| 02 — Private Record | Established-enterprise narrative; loss/fading of market signal; “The Condition” | KEEP CONCEPT / REWRITE COPY | Preserve the empathetic recognition of a successful business whose market signal has weakened. Reduce theatrical language and make the client's business problem and benefit unmistakable. |
| 03 — Philosophy / Narrative Drift | Strategic continuity, historical advantage, leadership transitions, digital transition, rebrand and institutional-memory loss; Lindy Effect | KEEP CORE IDEAS / REWRITE | Retain Narrative Drift and the value of durable historical advantages. Remove repetition, tighten the argument, and avoid treating the Lindy Effect as proof of an individual client's commercial performance. |
| 04 — Business Archaeology | Five-stage concepts begin; “we do not create marketing”; excavation, evidence, reconstruction; Operating Principle | KEEP CORE POSITIONING / REWRITE | This is the clearest explanation of the service distinction. Keep the idea that LEGAiSEE excavates and restores rather than functioning as a content-production agency. Port only approved copy. Remove all public CAT identifiers. |
| 05 — Five Stages of Restoration | Natural Habitat, Raw Stone, Cut & Shaped, Mounted, Museum Display; five “Photo Here” placeholders | KEEP CONCEPT / REBUILD VISUALS | Retain the five-stage metaphor if the governance doctrine supports it. Replace every placeholder with selected museum photography or purpose-built visual assets. Do not display internal CAT-HAB/CAT-RAW/CAT-CUT/CAT-MNT/CAT-DSP identifiers. |
| 06 — Bedrock | Every Word Is Sacred; 3-Source Rule; Continuous Verification; evidence confidence and verification principles | KEEP / CLARIFY | Preserve the rigor and evidence discipline. Resolve the wording conflict: the current “3-Source Rule” says a minimum of two independent sources, ideally three or more. Public wording must accurately describe the actual protocol. |
| 07 — Ten Frameworks | Ten framework names and methodology explanation | KEEP FRAMEWORK IP / REVIEW COPY | Preserve approved framework names and intellectual property. Verify that all ten are current, correctly named, and suitable for public disclosure. Reduce density and avoid turning the homepage into a technical manual. |
| 08 — Signal Restored | Interlocking frameworks, private/confidential work, no public case studies, Commissions and Architect links | REWRITE | Keep confidentiality and the idea of restored authority. Reconcile statements about private results and testimonials with what can actually be substantiated. Avoid repeating the same promise in multiple sections. |
| 09 — Private Registry | Invitation-only message, restored-authority metaphor, Registry and Commissions CTAs, geographic service note | KEEP / REVISE | Retain the Registry as the primary conversion destination if that remains the intended intake path. Make access expectations and service geography precise. Avoid redundant CTAs. |

## Remove from public homepage

- All literal “Photo Here” placeholder text.
- All public-facing CAT-XXX-### exhibit identifiers.
- Legacy CSS class names and page-specific style dependencies.
- Duplicate or inconsistent navigation markup.
- Any statement that cannot be substantiated or no longer reflects the current offer.
- Any animation or smooth-scroll dependency that is not necessary to the experience or that compromises accessibility/performance.

## Port only after review

- Existing logo artwork and approved brand marks.
- Current approved homepage copy.
- Any current images that pass the new visual standard.
- Link destinations that remain part of the approved information architecture.

## Homepage interaction inventory

| Existing behavior | New implementation decision |
|---|---|
| Desktop navigation and active-page state | Build as one shared navigation component |
| Mobile hamburger/menu | Build as an accessible shared component |
| Scroll-reveal effects | Rebuild only if the doctrine permits; honor reduced-motion preferences |
| Lenis smooth scrolling | Do not carry forward by default; use native scrolling unless a demonstrated requirement justifies a dependency |
| Homepage CTAs | Preserve valid destinations and test every route |
| Homepage forms | None detected in the current source |

## Homepage acceptance criteria

- The page uses only new LEGAiSEE 2.0 files.
- The Lixury Governance doctrine is translated into enforceable visual and interaction rules before styling is finalized.
- New museum photography is reviewed and selected before production placement.
- No placeholder imagery, CAT identifiers, dead links, or dummy controls remain.
- All copy is approved for current positioning and offer accuracy.
- Desktop, tablet, and mobile layouts are checked.
- Keyboard navigation, focus visibility, reduced motion, contrast, and image alternatives are checked.
- Performance is checked with final image formats and responsive sizes.
- Existing homepage URL remains unchanged at final cutover.
