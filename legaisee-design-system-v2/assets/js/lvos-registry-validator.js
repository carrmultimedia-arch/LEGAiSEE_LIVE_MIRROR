/* ==========================================================
   LVOS V2 — REGISTRY VALIDATOR
   Enforces TOC ↔ FILE SYSTEM CONSISTENCY
========================================================== */

window.LVOS = window.LVOS || {};

LVOS.RegistryValidator = {
  registry: null,

  async load(registryPath = "../../docs/pageregistry.json") {
    try {
      const res = await fetch(registryPath);
      this.registry = await res.json();
      console.log("[LVOS] Registry loaded");
    } catch (e) {
      console.error("[LVOS] Registry load failed", e);
    }
  },

  validatePage(path) {
    if (!this.registry) return false;

    const allPages = this.registry.structure.pages;
    const flat = Object.values(allPages).flatMap(section =>
      Object.values(section)
    );

    return flat.includes(path);
  },

  validateLab(path) {
    const labs = this.registry.structure.pages.labs;
    return Object.values(labs).includes(path);
  }
};