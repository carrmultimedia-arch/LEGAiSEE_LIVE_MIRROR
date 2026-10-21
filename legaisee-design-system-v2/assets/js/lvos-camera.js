
LVOS.MaterialEngine.prototype.labUpdate = function(light) {
  for (let id in this.materials) {
    const m = this.materials[id];

    m.emissive = light.key.intensity * 0.18;
    m.reflectivity = 0.4 + light.fill.intensity * 0.3;
    m.roughness = 1.0 - light.ambient.intensity * 0.6;
  }
};