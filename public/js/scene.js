// scene.js – Inicializa una escena Three.js sencilla con cámara, luz y un cubo rotante

let scene, camera, renderer, cube;

function init() {
  const canvas = document.getElementById('heroScene');
  if (!canvas) return;

  // Crear escena
  scene = new THREE.Scene();
  scene.background = new THREE.Color(0x000000);

  // Cámara
  const fov = 75;
  const aspect = canvas.clientWidth / canvas.clientHeight;
  const near = 0.1;
  const far = 1000;
  camera = new THREE.PerspectiveCamera(fov, aspect, near, far);
  camera.position.z = 5;

  // Renderizador
  renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
  renderer.setSize(canvas.clientWidth, canvas.clientHeight);
  renderer.setPixelRatio(window.devicePixelRatio);

  // Luz
  const ambient = new THREE.AmbientLight(0xffffff, 0.8);
  scene.add(ambient);
  const directional = new THREE.DirectionalLight(0xffffff, 0.5);
  directional.position.set(5, 10, 7);
  scene.add(directional);

  // Geometría – cubo con material estándar
  const geometry = new THREE.BoxGeometry(1, 1, 1);
  const material = new THREE.MeshStandardMaterial({ color: 0x1565c0, roughness: 0.5, metalness: 0.1 });
  cube = new THREE.Mesh(geometry, material);
  scene.add(cube);

  // Ajustar al redimensionar la ventana
  window.addEventListener('resize', onWindowResize);

  animate();
}

function onWindowResize() {
  const canvas = renderer.domElement;
  camera.aspect = canvas.clientWidth / canvas.clientHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(canvas.clientWidth, canvas.clientHeight);
}

function animate() {
  requestAnimationFrame(animate);
  // Rotación suave del cubo
  if (cube) {
    cube.rotation.x += 0.005;
    cube.rotation.y += 0.01;
  }
  renderer.render(scene, camera);
}

// Ejecutar al cargar el DOM
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}
