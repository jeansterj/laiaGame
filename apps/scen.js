let scene = new THREE.Scene();
let camera = new THREE.PerspectiveCamera(30, window.innerWidth / window.innerHeight, 0.1, 1000);
let renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

let backgroundTexture = new THREE.TextureLoader().load('./Imagenes/space4k.jpg');
scene.background = backgroundTexture;

let loader = new THREE.TextureLoader();
let texture = loader.load('./Imagenes/mapWolrd.png');  // Reemplaza esta URL con la URL de tu textura de la Tierra
let geometry = new THREE.SphereGeometry(1, 64, 64);
let material = new THREE.MeshBasicMaterial({ map: texture });
let sphere = new THREE.Mesh(geometry, material);
scene.add(sphere);

let controls = new THREE.OrbitControls(camera, renderer.domElement);
controls.minDistance = 3;  
controls.maxDistance = 8; 
camera.position.z = 5;

let outlineMaterial1 = new THREE.ShaderMaterial({
    side: THREE.BackSide,
    uniforms: {},
    vertexShader: `
        void main() {
            vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
            gl_Position = projectionMatrix * mvPosition;
            gl_Position.xyz += normalize(gl_Position.xyz) * 0.09;
        }
    `,
    fragmentShader: `
        void main() {
            gl_FragColor = vec4(0.5, 1.0, 1.0, 1.0);
        }
    `
});

let outlineMesh1 = new THREE.Mesh(geometry, outlineMaterial1);
scene.add(outlineMesh1);

let imageTexture = new THREE.TextureLoader().load('./Imagenes/bombillaApagada.png');
let imageTextureCompletada = new THREE.TextureLoader().load('./Imagenes/BombillaEncendida.png');

let spriteMaterial = new THREE.SpriteMaterial({ map: imageTexture });
let spriteMaterial2 = new THREE.SpriteMaterial({ map: imageTexture });
let spriteMaterial3 = new THREE.SpriteMaterial({ map: imageTexture });
let spriteMaterial4 = new THREE.SpriteMaterial({ map: imageTexture });

let imageSprite = new THREE.Sprite(spriteMaterial);
imageSprite.position.set(0, 1, 0); 
imageSprite.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite);        

let imageSprite2 = new THREE.Sprite(spriteMaterial2);
imageSprite2.position.set(0, 1, 0); 
imageSprite2.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite2);   

let imageSprite3 = new THREE.Sprite(spriteMaterial3);
imageSprite3.position.set(0, 1, 0); 
imageSprite3.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite3);

let imageSprite4 = new THREE.Sprite(spriteMaterial4);
imageSprite4.position.set(0, 1, 0); 
imageSprite4.scale.set(0.1, 0.1, 1); 
scene.add(imageSprite4);     

let textureCompleted = new THREE.TextureLoader().load('./Imagenes/BombillaEncendida.png');    

let raycaster = new THREE.Raycaster();
let mouse = new THREE.Vector2();

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
    let intersects = raycaster.intersectObjects([imageSprite, imageSprite2, imageSprite3, imageSprite4]);

    intersects.forEach((intersect) => {
        if (intersect.object === imageSprite) {
            console.log('imageSprite clicked!'); 

            let myModal = new bootstrap.Modal(document.getElementById('modalbcn'))
            myModal.show();

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

    let intersectsSprite1 = raycaster.intersectObject(imageSprite);
    let intersectsSprite2 = raycaster.intersectObject(imageSprite2);
    let intersectsSprite3 = raycaster.intersectObject(imageSprite3);
    let intersectsSprite4 = raycaster.intersectObject(imageSprite4);

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

function bombillas(sprite, radio, theta, phi) {
    let x = radio * Math.sin(theta) * Math.cos(phi);
    let y = radio * Math.cos(theta);
    let z = radio * Math.sin(theta) * Math.sin(phi);

    sprite.position.set(x, y, z);        
    sprite.position.applyEuler(sphere.rotation);   
            
}

document.addEventListener('DOMContentLoaded', function () {
   
    if (!getCookie('yaVisitado')) {
        let myModal = new bootstrap.Modal(document.getElementById('modalini'));
        myModal.show();

        
        setCookie('yaVisitado', 'true', 30); // La cookie expira en 30 días
    }
});

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}


function render() {
    requestAnimationFrame(render);         
    sphere.rotation.y += 0.0005;
    outlineMesh1.rotation.y += 0.005;   
    
    bombillas(imageSprite, 1.09,7.38,6.52); 
    bombillas(imageSprite2, 1.09,8.10,7.49);
    bombillas(imageSprite3, 1.09,8.0,5.85);
    bombillas(imageSprite4, 1.09,7.77,5.1);          
          
                  
    renderer.render(scene, camera);
}
render();