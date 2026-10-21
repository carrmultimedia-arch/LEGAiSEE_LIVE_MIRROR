(function () {

    console.log("LVOS render engine loaded");

    const STATE = {
        key:  { x: 0.78, y: 0.45, intensity: 1.4 },
        fill: { x: 0.22, y: 0.48, intensity: 1.0 },
        rim:  { x: 0.50, y: 0.15, intensity: 0.8 }
    };

    function falloff(dx, dy) {
        const d = Math.sqrt(dx * dx + dy * dy);
        return 1 / (1 + d * 2.2);
    }

    function sample(nx, ny) {

        let key =
            falloff(nx - STATE.key.x, ny - STATE.key.y) *
            STATE.key.intensity;

        let fill =
            falloff(nx - STATE.fill.x, ny - STATE.fill.y) *
            STATE.fill.intensity;

        let rim =
            falloff(nx - STATE.rim.x, ny - STATE.rim.y) *
            STATE.rim.intensity;

        return {
            key:  Math.min(Math.pow(key, 0.65) * 1.35, 1),
            fill: Math.min(Math.pow(fill, 0.75) * 1.10, 1),
            rim:  Math.min(Math.pow(rim, 0.85) * 0.95, 1)
        };
    }

    function compute() {

        const els = document.querySelectorAll('.render-object');

        console.log("compute running | objects:", els.length);

        const vw = window.innerWidth;
        const vh = window.innerHeight;

        const maxScroll = document.documentElement.scrollHeight - vh;

        els.forEach(el => {

            const r = el.getBoundingClientRect();

            const cx = r.left + r.width * 0.5;
            const cy = r.top + window.scrollY + r.height * 0.5;

            const nx = cx / vw;
            const ny = cy / (maxScroll + vh);

            const light = sample(nx, ny);

            el.style.setProperty('--light-key', light.key);
            el.style.setProperty('--light-fill', light.fill);
            el.style.setProperty('--light-rim', light.rim);
        });
    }

    function boot() {
        console.log("LVOS boot starting");

        compute();

        window.addEventListener('scroll', compute, { passive: true });
        window.addEventListener('resize', compute);
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", boot);
    } else {
        boot();
    }

})();