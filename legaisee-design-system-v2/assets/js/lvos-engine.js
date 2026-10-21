/* ==========================================================
   LVOS V2 — LAB SYSTEM REGISTRY (INLINE EXTENSION)
========================================================== */

window.LVOS_LABS = {
  enabled: true,

  subsystems: {
    render: true,
    light: true,
    material: true,
    camera: true,
    motion: true
  },

  mode: "demo-lab-active"


LVOS.Engine.validateRegistry = function(path) {
  return LVOS.RegistryValidator?.validatePage(path);
};