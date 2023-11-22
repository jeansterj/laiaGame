var scene = new THREE.Scene();
var camera = new THREE.PerspectiveCamera(30, window.innerWidth / window.innerHeight, 0.1, 1000);
var renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

var backgroundTexture = new THREE.TextureLoader().load('./Imagenes/space4k.jpg');
scene.background = backgroundTexture;


var loader = new THREE.TextureLoader();
var texture = loader.load('./Imagenes/mapWorld.png');  // Reemplaza esta URL con la URL de tu textura de la Tierra
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
            gl_Position.xyz += normalize(gl_Position.xyz) * 0.05;  // Ajusta el valor 0.05 según el grosor del contorno deseado
        }
    `,
    fragmentShader: `
        void main() {
            gl_FragColor = vec4(0.5, 1.0, 1.0, 1.0);  // Color azul celeste
        }
    `
});

var outlineMesh1 = new THREE.Mesh(geometry, outlineMaterial1);
scene.add(outlineMesh1);

var imageTexture = new THREE.TextureLoader().load('./Imagenes/bombillaApagada.png');
var imageTextureCompletada = new THREE.TextureLoader().load('./Imagenes/BombillaEncendida.png');


//materiales de las bombillas
var spriteMaterial = new THREE.SpriteMaterial({ map: imageTexture });
var spriteMaterial2 = new THREE.SpriteMaterial({ map: imageTexture });
var spriteMaterial3 = new THREE.SpriteMaterial({ map: imageTexture });
var spriteMaterial4 = new THREE.SpriteMaterial({ map: imageTexture });


//Sprites de las bombillas y colocacion en el mapa 
var imageSprite = new THREE.Sprite(spriteMaterial);
imageSprite.position.set(0, 1, 0); 
imageSprite.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite);        

var imageSprite2 = new THREE.Sprite(spriteMaterial2);
imageSprite2.position.set(0, 1, 0); 
imageSprite2.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite2);   

var imageSprite3 = new THREE.Sprite(spriteMaterial3);
imageSprite3.position.set(0, 1, 0); 
imageSprite3.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite3);

var imageSprite4 = new THREE.Sprite(spriteMaterial4);
imageSprite4.position.set(0, 1, 0); 
imageSprite4.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite4);     

//textura bombilla encendida
var textureCompleted = new THREE.TextureLoader().load('./Imagenes/BombillaEncendida.png');    


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

function onMouseClick(event) {
raycaster.setFromCamera(mouse, camera);
var intersects = raycaster.intersectObjects([imageSprite, imageSprite2, imageSprite3, imageSprite4]);

//Logica del click de las bombillas     
intersects.forEach((intersect) => {
    if (intersect.object === imageSprite) {
        console.log('imageSprite clicked!'); 

        let myModal = new bootstrap.Modal(document.getElementById('modalbcn'))

        myModal.show();
       
        
        //Logica del cambio de textura de las bombillas
        intersect.object.material.map = textureCompleted;
        intersect.object.material.needsUpdate = true;     
        
              
        
    } else if (intersect.object === imageSprite2) {
        console.log('imageSprite2 clicked!');

        
        
    } else if (intersect.object === imageSprite3) {
        console.log('imageSprite3 clicked!');
       
       
    } else if (intersect.object === imageSprite4) {
        console.log('imageSprite4 clicked!');
       
       
    }
});
}

function checkIntersection() {
raycaster.setFromCamera(mouse, camera);

//Logica de deteccion de click de las bombilla
var intersectsSprite1 = raycaster.intersectObject(imageSprite);
var intersectsSprite2 = raycaster.intersectObject(imageSprite2);
var intersectsSprite3 = raycaster.intersectObject(imageSprite3);
var intersectsSprite4 = raycaster.intersectObject(imageSprite4);

if (intersectsSprite1.length > 0) {
    imageSprite.scale.lerp(new THREE.Vector3(0.25, 0.25, 1), 0.1);
} else {
    imageSprite.scale.lerp(new THREE.Vector3(0.2, 0.2, 1), 0.1);
}

if (intersectsSprite2.length > 0) {
    imageSprite2.scale.lerp(new THREE.Vector3(0.25, 0.25, 1), 0.1);
} else {
    imageSprite2.scale.lerp(new THREE.Vector3(0.2, 0.2, 1), 0.1);
}

if (intersectsSprite3.length > 0) {
    imageSprite3.scale.lerp(new THREE.Vector3(0.25, 0.25, 1), 0.1);
} else {
    imageSprite3.scale.lerp(new THREE.Vector3(0.2, 0.2, 1), 0.1);
}


if (intersectsSprite4.length > 0) {
    imageSprite4.scale.lerp(new THREE.Vector3(0.25, 0.25, 1), 0.1);
} else {
    imageSprite4.scale.lerp(new THREE.Vector3(0.2, 0.2, 1), 0.1);
}
}

//funcion para colocar la bombillas 
function bombillas(sprite,radio, theta, phi)
{
    var x = radio * Math.sin(theta) * Math.cos(phi);
    var y = radio * Math.cos(theta);
    var z = radio * Math.sin(theta) * Math.sin(phi);

    sprite.position.set(x, y, z);        
    sprite.position.applyEuler(sphere.rotation);   
            
}


function render() {
    requestAnimationFrame(render);         
    sphere.rotation.y += 0.0005;
    outlineMesh1.rotation.y += 0.005;   
    
    bombillas(imageSprite, 1.09,7.57,6.4); 
    bombillas(imageSprite2, 1.09,8.47,6.4);
    bombillas(imageSprite3, 1.09,8.47,7.4);
    bombillas(imageSprite4, 1.09,8.47,10.4);             
                  
                  
    renderer.render(scene, camera);
}
render();