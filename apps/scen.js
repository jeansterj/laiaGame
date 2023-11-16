var scene = new THREE.Scene();
var camera = new THREE.PerspectiveCamera(30, window.innerWidth / window.innerHeight, 0.1, 1000);
var renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

var backgroundTexture = new THREE.TextureLoader().load('../Imagenes/space4k.jpg');
scene.background = backgroundTexture;

var loader = new THREE.TextureLoader();
var texture = loader.load('../Imagenes/mapWorld.png');
var geometry = new THREE.SphereGeometry(1, 64, 64);
var material = new THREE.MeshBasicMaterial({ map: texture });
var sphere = new THREE.Mesh(geometry, material);
scene.add(sphere);

var controls = new THREE.OrbitControls(camera, renderer.domElement);
camera.position.z = 5;

var outlineMaterial1 = new THREE.ShaderMaterial({
    side: THREE.BackSide,
    uniforms: {},
    vertexShader: `
        void main() {
            vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
            gl_Position = projectionMatrix * mvPosition;
            gl_Position.xyz += normalize(gl_Position.xyz) * 0.05;
        }
    `,
    fragmentShader: `
        void main() {
            gl_FragColor = vec4(0.5, 1.0, 1.0, 1.0);
        }
    `
});

var outlineMesh1 = new THREE.Mesh(geometry, outlineMaterial1);
scene.add(outlineMesh1);

var imageTexture = new THREE.TextureLoader().load('./Imagenes/bocadillo.png');

var spriteMaterial = new THREE.SpriteMaterial({ map: imageTexture });

var imageSprite = new THREE.Sprite(spriteMaterial);
imageSprite.position.set(0, 1, 0);
imageSprite.scale.set(0.1, 0.1, 1);
scene.add(imageSprite);

var radio = 1.09;
var theta = 7.57;
var phi = 6.4;

var raycaster = new THREE.Raycaster();
var mouse = new THREE.Vector2();

window.addEventListener('mousemove', onMouseMove, false);
window.addEventListener('click', onMouseClick, false);

function onMouseMove(event) {
    event.preventDefault();
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
    checkIntersection();
}

// function onMouseClick(event) {
//     raycaster.setFromCamera(mouse, camera);
//     var intersects = raycaster.intersectObject(imageSprite);
//     if (intersects.length > 0) {
//         mostrarModalBCN();
//     }
// }
function onMouseClick(event) {
    raycaster.setFromCamera(mouse, camera);
    var intersects = raycaster.intersectObject(imageSprite);

    if (intersects.length > 0) {
        var modal = document.getElementById('modalbcn');

        if (modal) {
            var showEvent = new Event('show.bs.modal');
            modal.dispatchEvent(showEvent);


            modal.classList.add('show');
            modal.style.display = 'block';

            var shownEvent = new Event('shown.bs.modal');
            modal.dispatchEvent(shownEvent);


            var closeButton = modal.querySelector('.btn-secondary');
            if (closeButton) {
                closeButton.addEventListener('click', function () {
                    modal.classList.remove('show');
                    modal.style.display = 'none';

                    var hiddenEvent = new Event('hidden.bs.modal');
                    modal.dispatchEvent(hiddenEvent);

                });
            }
        }
    }
}


// function mostrarModalBCN() {
//     console.log("hola");

//     // Obtener el modal por su ID
//     var modal = document.getElementById('modalbcn');

//     // Asegurarse de que el modal existe
//     if (modal) {
//         // Mostrar el modal cambiando su estilo de display a 'block'
//         modal.style.display = 'block';

//         // Puedes agregar aquí cualquier otra lógica que necesites al mostrar el modal
//     }
// }


function checkIntersection() {
    raycaster.setFromCamera(mouse, camera);
    var intersects = raycaster.intersectObject(imageSprite);
    if (intersects.length > 0) {
        imageSprite.scale.lerp(new THREE.Vector3(0.25, 0.25, 1), 0.1);
    } else {
        imageSprite.scale.lerp(new THREE.Vector3(0.2, 0.2, 1), 0.1);
    }
}

function render() {
    requestAnimationFrame(render);
    sphere.rotation.y += 0.0005;
    outlineMesh1.rotation.y += 0.005;
    var x = radio * Math.sin(theta) * Math.cos(phi);
    var y = radio * Math.cos(theta);
    var z = radio * Math.sin(theta) * Math.sin(phi);
    imageSprite.position.set(x, y, z);
    imageSprite.position.applyEuler(sphere.rotation);
    renderer.render(scene, camera);
}
render();