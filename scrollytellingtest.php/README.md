# LEGAiSEE — 360 Spherical Panorama Scrollytelling Demo

This prototype maps the three supplied 1456×720 panoramas onto the inside of a WebGL sphere and uses page scroll to author a cinematic camera path.

## Run it

Because the browser's ES-module and local-file security rules can block some assets when opening `index.html` directly, run it through a tiny local web server.

### Option A — VS Code Live Server
Open this folder in VS Code and use Live Server on `index.html`.

### Option B — Python
From this folder:

    python -m http.server 8080

Then open:

    http://localhost:8080

## What the prototype does

- True spherical/WebGL panorama environment
- Three panorama scenes
- Scroll-driven camera yaw and pitch
- Scroll-driven field-of-view changes
- Smooth crossfade between panoramas
- Mouse parallax
- Fixed cinematic UI / chapter indicator
- Mobile responsive layout
- No build system required
- Three.js loaded from jsDelivr

## Important image note

A true equirectangular 360 panorama is normally exactly 2:1 (for example 4000×2000). The supplied files are 1456×720 (~2.02:1), so they are close enough to test the spherical technique, but they may not be mathematically perfect 360 equirectangular captures.

If these images were generated specifically as 360/equirectangular panoramas, the production version can use them directly. If they are conventional ultra-wide perspective renders, the sphere will reveal projection artifacts and a different approach should be used.

## Production direction

The same architecture can be extended into a much more sophisticated luxury scrollytelling experience:

1. Multiple authored camera paths per room.
2. Hotspots that reveal text, objects, documents, or products.
3. Depth/parallax layers for selected architectural elements.
4. Scroll velocity affecting camera inertia.
5. GSAP ScrollTrigger for timeline-level choreography.
6. Preloading / compressed KTX2 textures for faster mobile delivery.
7. Optional gyroscope/device orientation on mobile.
8. Transition effects between rooms rather than simple crossfades.
