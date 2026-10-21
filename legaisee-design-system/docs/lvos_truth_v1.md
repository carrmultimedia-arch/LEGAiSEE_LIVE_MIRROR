This becomes the source of truth for every future chat, every future CSS file, every future JS file.

Chapter 1 — Core Principle
LVOS is a Material Response System.

Lighting is fixed.

Camera is fixed.

Materials respond to lighting.

Content moves through lighting fields.

The system simulates a museum exhibit environment,
not webpage gradients.
Chapter 2 — Production Rig
World contains:

1. Key Light
2. Fill Light
3. Rim Light
4. Bounce Light

These lights remain fixed.

Lights do not scroll.

Lights do not move with content.

Content moves through the environment.

Your diagram becomes official law:

RIM
|
|
|
|             ARTIFACT
|
|
FILL ----- CAM ----- KEY
Chapter 3 — Materials

This is the next thing we build.

Not more lighting.

Materials.

MATERIAL-LACQUER

Reference:

Steinway Piano
Gibson Les Paul
Martin D-28
Concert Violin

Behavior:

Very high specular reflection
Hard highlight
Mirror-like reflection
Minimal diffusion
MATERIAL-GLASS

Reference:

Museum display case
Luxury framed exhibit

Behavior:

Edge reflections
Fresnel response
Transmission
Light scatter
MATERIAL-GOLD

Reference:

Polished gold frame
Gold leaf trim

Behavior:

Warm reflections
High specular response
Edge glints
MATERIAL-BACKGROUND

Reference:

Dark museum wall
Black velvet
Exhibit room

Behavior:

Minimal light response
Chapter 4 — Depth System

Keep it simple:

depth-0
depth-1
depth-2
depth-3
depth-4

Depth controls:

elevation
shadow
hierarchy

NOT lighting.

Chapter 5 — Importance System

Controls:

importance-1
importance-2
importance-3
importance-4
importance-5

This affects:

brightness weighting
animation priority
visual attention

NOT material behavior.

Chapter 6 — File Architecture
/assets/css

lvos-core.css
lvos-materials.css
lvos-lighting.css

/assets/js

lvos-light-field.js
lvos-render-bridge.js

/docs

lvos_truth_v1.md
lvos_changelog.md
lvos_handoff.md

/experimental

render-system-demo-v1.html
After the document is written

The next actual build target should be:

/assets/css/lvos-materials.css

Not lighting.

Not JS.

Not cards.

Not layouts.

Materials.

Because right now:

material-lacquer
material-glass
material-gold

are mostly visual placeholders.

They are not yet behaving like:

a piano finish
museum glass
polished gold

which is the whole point of the system.

So the build order becomes:

Step 1

Create:

docs/lvos_truth_v1.md
Step 2

Build:

assets/css/lvos-materials.css
Step 3

Return to:

assets/js/lvos-light-field.js

and connect the fixed production rig to material response.

That sequence will prevent the project from drifting every time a new chat starts.