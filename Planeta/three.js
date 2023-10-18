var scene = new THREE.Scene();
var camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
var renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

var loader = new THREE.TextureLoader();
var texture = loader.load('https://threejsfundamentals.org/threejs/resources/images/wall.jpg');  // Reemplaza esta URL con la URL de tu textura de la Tierra
var geometry = new THREE.SphereGeometry(1, 32, 32);
var material = new THREE.MeshBasicMaterial({ map: texture });
var sphere = new THREE.Mesh(geometry, material);
scene.add(sphere);

var dragControls = new THREE.DragControls([sphere], camera, renderer.domElement);
dragControls.addEventListener('drag', render);


camera.position.z = 5;
function render() {
  renderer.render(scene, camera);
}
render();


function animate() {
    requestAnimationFrame(animate);
    render();
  }
  animate();