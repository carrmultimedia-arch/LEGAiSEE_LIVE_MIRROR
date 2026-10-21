/* ==========================================================
   LVOS V2 — SYSTEM LOADER (BOOTSTRAP CORE)
========================================================== */

(function () {

  const LVOS = window.LVOS = window.LVOS || {};

  function boot() {
    console.log("[LVOS] Boot sequence initiated");

    // Step 1 — Ensure engine exists
    if (!LVOS.Engine) {
      console.error("[LVOS] Engine missing");
      return;
    }

    // Step 2 — Initialize core subsystems safely
    try {
      LVOS.Engine.init?.();
      LVOS.Camera?.init?.();
      LVOS.Light?.init?.();
      LVOS.Material?.init?.();
      LVOS.Motion?.init?.();
    } catch (e) {
      console.error("[LVOS] Init error:", e);
    }

    // Step 3 — Attach runtime loop
    bindRuntime();

    // Step 4 — Activate labs if present
    if (window.LVOS_LABS?.enabled) {
      console.log("[LVOS] Lab system active");
    }

    console.log("[LVOS] Boot complete");
  }

  function bindRuntime() {
    let lastScroll = 0;

    window.addEventListener("scroll", () => {
      lastScroll = window.scrollY || 0;

      const height = document.body.scrollHeight - window.innerHeight;
      const ratio = height > 0 ? lastScroll / height : 0;

      runtimeTick(lastScroll, ratio, height);
    });

    function runtimeTick(scrollY, ratio, height) {
      if (!LVOS.Engine) return;

      // Core engine update
      LVOS.Engine.tick?.(scrollY, ratio);

      // Lab layer (if injected)
      if (window.LVOS_LABS?.enabled && LVOS_LAB_TICK) {
        LVOS_LAB_TICK(scrollY, height);
      }
    }
  }

  // DOM READY BOOT
  if (document.readyState === "complete") {
    boot();
  } else {
    window.addEventListener("DOMContentLoaded", boot);
  }

})();