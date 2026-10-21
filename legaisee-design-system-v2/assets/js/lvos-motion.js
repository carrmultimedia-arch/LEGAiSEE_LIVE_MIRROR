
LVOS.Motion.prototype.labUpdate = function(scrollRatio) {
  this.timeline.intensity = 0.7 + Math.sin(scrollRatio * Math.PI) * 0.3;
  this.timeline.fade = 1 - scrollRatio;
};