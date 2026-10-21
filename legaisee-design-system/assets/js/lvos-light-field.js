/* =========================================================
   LVOS LIGHT FIELD V7 — VERTICAL SCROLL RESTORED
========================================================= */

(function () {

    const LIGHT = {
        key:  { x: 0.70, y: 0.20, intensity: 1.3 },
        fill: { x: 0.30, y: 0.60, intensity: 1.0 },
        rim:  { x: 0.50, y: 0.10, intensity: 0.9 }
    };

    function falloff(dx, dy) {
        const d = Math.sqrt(dx * dx + dy * dy);
        return 1 / (1 + d * 4.2);
    }

    function sample(nx, ny) {

        const key  = falloff(nx - LIGHT.key.x, ny - LIGHT.key.y) * LIGHT.key.intensity;
        const fill = falloff(nx - LIGHT.fill.x, ny - LIGHT.fill.y) * LIGHT.fill.intensity;
        const rim  = falloff(nx - LIGHT.rim.x, ny - LIGHT.rim.y) * LIGHT.rim.intensity;

        return {
            key:  Math.min(Math.max(key, 0), 1),
            fill: Math.min(Math.max(fill, 0), 1),
            rim:  Math.min(Math.max(rim, 0), 1)
        };
    }

    function compute() {

        const els = document.querySelectorAll('.render-object');

        const vh = window.innerHeight;
        const docH = document.documentElement.scrollHeight;
        const scrollY = window.scrollY || 0;

        for (const el of els) {

            const r = el.getBoundingClientRect();

            // 🔥 CRITICAL FIX: use VERTICAL POSITION ONLY

            const centerY = r.top + scrollY + (r.height * 0.5);

            const nx = 0.5; // keep stable horizontal center
            const ny = centerY / docH;

            const L = sample(nx, ny);

            el.style.setProperty('--light-key', L.key);
            el.style.setProperty('--light-fill', L.fill);
            el.style.setProperty('--light-rim', L.rim);
        }
    }

    let ticking = false;

    function tick() {
        if (ticking) return;

        ticking = true;
        requestAnimationFrame(() => {
            compute();
            ticking = false;
        });
    }

    window.addEventListener('scroll', tick, { passive: true });
    window.addEventListener('resize', compute);
    window.addEventListener('load', compute);

    window.LVOS_LightField = compute;

    compute();

/* =========================================================
   LVOS LIGHT FIELD — DEBUG VISUALIZER V1
   PURPOSE: prove per-element variation exists
========================================================= */

(function () {

    function compute() {

        const els = document.querySelectorAll('.render-object');

        let i = 0;

        for (const el of els) {

            // FORCE UNIQUE VALUE PER ELEMENT (test only)
            const id = i++;

            const x = (id % 10) / 10;
            const y = Math.floor(id / 10) / 10;

            el.style.setProperty('--light-key', x);
            el.style.setProperty('--light-fill', y);
            el.style.setProperty('--light-rim', (x + y) / 2);

            // VISUAL DEBUG BORDER SHIFT
            el.style.outline = `1px solid rgba(255,255,255,${x})`;
        }
    }

    window.addEventListener('scroll', compute);
    window.addEventListener('resize', compute);
    window.addEventListener('load', compute);

    compute();

})();
