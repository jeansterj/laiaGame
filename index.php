<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esfera Tierra</title>

    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<header>
    <h2 class="logo">Logo</h2>
    <nav class="navigation">
        <button class="btnIniciar">Iniciar Sesion</button>
        <a href="#">ES/</a>
        <a href="#">CAT/</a>
        <a href="#">ENG</a>

    </nav>
</header>




<body>
    <div class="wrapper">
        <div class="form-box iniciar">
             <h2>Iniciar Sesion</h2>
             <form action="#">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label name="email">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label name="password">Password</label>
                </div>
                </div>
               <button type="submit" class="btn">Iniciar Sesion</button>
               <div class="iniciar-Registro">
                <p>¿No tienes cuenta?</p> <a href="#" class="link-Registro">Registrate</a>
               </div>
    
             </form>   
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>

<script>
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(30, window.innerWidth / window.innerHeight, 0.1, 1000);
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

var backgroundTexture = new THREE.TextureLoader().load('./Imagenes/space4k.jpg');
scene.background = backgroundTexture;


    var loader = new THREE.TextureLoader();
    var texture = loader.load('./Imagenes/pollonBueno1.png');  // Reemplaza esta URL con la URL de tu textura de la Tierra
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

    var imageTexture = new THREE.TextureLoader().load('/Imagenes/bocadillo.png');

    
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

    function onMouseClick(event) {
        raycaster.setFromCamera(mouse, camera);
        var intersects = raycaster.intersectObject(imageSprite);
        if (intersects.length > 0) {
            
            console.log('Sprite clicked!');
        }
    }

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
</script>
</body>
</html>