import * as THREE from "three";

const canvas = document.querySelector("#panorama");
const loaderEl = document.querySelector("#loader");
const loaderBar = document.querySelector(".loader-line span");
const progressBar = document.querySelector("#progressBar");
const chapterNo = document.querySelector("#chapterNo");
const coordinates = document.querySelector("#coordinates");

const scenes = [
  {
    file: "./assets/library.jpg",
    yaw: 0.00,
    pitch: 0.02,
    fov: 58
  },
  {
    file: "./assets/gallery.jpg",
    yaw: 0.72,
    pitch: -0.035,
    fov: 55
  },
  {
    file: "./assets/atelier.jpg",
    yaw: -0.78,
    pitch: 0.055,
    fov: 51
  }
];

const renderer = new THREE.WebGLRenderer({
  canvas,
  antialias: true,
  alpha: false,
  powerPreference: "high-performance"
});
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75));
renderer.setSize(innerWidth, innerHeight);
renderer.outputColorSpace = THREE.SRGBColorSpace;
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.toneMappingExposure = 1.0;

const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(
  scenes[0].fov,
  innerWidth / innerHeight,
  0.1,
  100
);
camera.position.set(0, 0, 0);

const geometry = new THREE.SphereGeometry(50, 96, 64);
geometry.scale(-1, 1, 1);

const materials = scenes.map(() => new THREE.MeshBasicMaterial({
  side: THREE.DoubleSide,
  transparent: true,
  opacity: 0
}));

const meshes = materials.map(material => new THREE.Mesh(geometry, material));
meshes.forEach(mesh => scene.add(mesh));

const textureLoader = new THREE.TextureLoader();
let loaded = 0;

function loadTexture(sceneData, index) {
  textureLoader.load(
    sceneData.file,
    texture => {
      texture.colorSpace = THREE.SRGBColorSpace;
      texture.anisotropy = renderer.capabilities.getMaxAnisotropy();
      materials[index].map = texture;
      materials[index].needsUpdate = true;

      loaded++;
      loaderBar.style.width = `${(loaded / scenes.length) * 100}%`;

      if (loaded === scenes.length) {
        materials[0].opacity = 1;
        requestAnimationFrame(() => loaderEl.classList.add("is-done"));
        animate();
      }
    },
    undefined,
    error => {
      console.error("Panorama failed to load:", sceneData.file, error);
    }
  );
}

scenes.forEach(loadTexture);

let targetYaw = scenes[0].yaw;
let targetPitch = scenes[0].pitch;
let currentYaw = targetYaw;
let currentPitch = targetPitch;
let currentFov = scenes[0].fov;

let mouseX = 0;
let mouseY = 0;
let scrollProgress = 0;

window.addEventListener("pointermove", event => {
  mouseX = (event.clientX / innerWidth - 0.5) * 2;
  mouseY = (event.clientY / innerHeight - 0.5) * 2;
}, { passive: true });

window.addEventListener("scroll", updateScroll, { passive: true });

function clamp(v, min, max) {
  return Math.max(min, Math.min(max, v));
}

function smoothstep(t) {
  return t * t * (3 - 2 * t);
}

function updateScroll() {
  const maxScroll = document.documentElement.scrollHeight - innerHeight;
  scrollProgress = maxScroll > 0 ? clamp(scrollY / maxScroll, 0, 1) : 0;

  // The first three 180vh chapters occupy most of the journey.
  const chapterFloat = clamp(scrollProgress * 3, 0, 2.999);
  const index = Math.floor(chapterFloat);
  const local = chapterFloat - index;
  const next = Math.min(index + 1, scenes.length - 1);

  // Crossfade panorama textures.
  const fade = smoothstep(clamp((local - 0.72) / 0.28, 0, 1));
  if (index === next) {
    materials[index].opacity = 1;
  } else {
    materials[index].opacity = 1 - fade;
    materials[next].opacity = fade;
  }

  // Interpolate the camera path between authored scene states.
  const a = scenes[index];
  const b = scenes[next];

  targetYaw = THREE.MathUtils.lerp(a.yaw, b.yaw, local);
  targetPitch = THREE.MathUtils.lerp(a.pitch, b.pitch, local);
  currentFov = THREE.MathUtils.lerp(a.fov, b.fov, local);

  // Add subtle cursor parallax without destroying the scroll-authored motion.
  const parallaxYaw = mouseX * 0.045;
  const parallaxPitch = mouseY * 0.025;

  currentYaw += ((targetYaw + parallaxYaw) - currentYaw) * 0.055;
  currentPitch += ((targetPitch + parallaxPitch) - currentPitch) * 0.055;

  chapterNo.textContent = String(Math.min(index + 1, 3)).padStart(2, "0");
  progressBar.style.height = `${scrollProgress * 100}%`;

  const deg = THREE.MathUtils.radToDeg(currentYaw);
  const pitchDeg = THREE.MathUtils.radToDeg(currentPitch);
  coordinates.textContent =
    `YAW ${String(Math.round(((deg % 360) + 360) % 360)).padStart(3, "0")}° · ` +
    `PITCH ${String(Math.round(pitchDeg + 360) % 360).padStart(3, "0")}°`;
}

function render() {
  // Camera looks around the inside of the sphere.
  camera.rotation.order = "YXZ";
  camera.rotation.y = currentYaw;
  camera.rotation.x = currentPitch;

  // Slight cinematic FOV breathing.
  camera.fov += (currentFov - camera.fov) * 0.045;
  camera.updateProjectionMatrix();

  renderer.render(scene, camera);
}

function animate() {
  requestAnimationFrame(animate);
  render();
}

window.addEventListener("resize", () => {
  camera.aspect = innerWidth / innerHeight;
  camera.updateProjectionMatrix();
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75));
  renderer.setSize(innerWidth, innerHeight);
});

updateScroll();
