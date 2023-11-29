<?php require_once('./php_librarys/bdlaia.php'); ?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esfera Tierra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

</head>
<script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>

<body>
    

    <header>
    
        <a class="logo" href="http://localhost:8080/laiaGame/tierra2.php"><img src="./Imagenes/logo.png"
                alt="logo_centiks"></a>
                
                <?php require_once('./php_partials/mensajes.php'); ?> 

        <nav class="navigation">
        
        
            
            <button type="button" class="basicButton" data-bs-toggle="modal" data-bs-target="#modalDesa">Sobre
                Nosotros</button>

            <?php if (isset($_SESSION['user'])): ?>
                <!-- Si la sesión está iniciada, muestra el botón "Cerrar Sesión" -->
                <button class="btn btnLogin-popup" onclick="window.location.href='./logout.php'" name="logoutLink">CERRAR
                    SESION</button>


            <?php else: ?>
                <!-- Si la sesión no está iniciada, muestra el botón "Iniciar Sesión" -->
                <button class="btnLogin-popup" name="loginLink" data-bs-toggle="modal" data-bs-target="#loginForm">Iniciar
                    Sesión</button>
            <?php endif; ?>

          
            <!-- Modal -->
            <div class="modal modalLogin fade" id="loginForm" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="popupContainer">
                            <div class="form-box login ">
                                <h2 data-translate="IniciarSesion">Iniciar Sesión</h2>
                                <form action="./php_controllers/laiaController.php" method="POST">
                                    <div class="input-box">
                                        <span class="icon">
                                            <ion-icon name="person-circle-outline"></ion-icon>
                                        </span>
                                        <input type="text" name="userName" required>
                                        <label>Nombre de usuario</label>
                                    </div>
                                    <div class="input-box">
                                        <span class="icon">
                                            <ion-icon name="lock-closed-outline"></ion-icon>
                                        </span>
                                        <input type="password" name="password" required>
                                        <label>Password</label>
                                    </div>
                                    <button type="submit" name="login" class="btn">Iniciar Sesion</button>

                                    <div class="loginRegister">
                                        <p>¿No tienes cuenta?</p>
                                        <a href="#" name="registerLink" class="registerLink">Registrate</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-box register">
                            <h2>Registro</h2>
                            <form action="./php_controllers/laiaController.php" method="POST">
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                    </span>
                                    <input type="text" name="userName" required>
                                    <label>Nombre de Usuario</label>
                                </div>
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                    </span>
                                    <input type="password" name="password" required>
                                    <label>Password</label>
                                </div>
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="person-outline"></ion-icon>
                                    </span>
                                    <input type="text" name="nombre" required>
                                    <label>Nombre</label>
                                </div>
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="people-outline"></ion-icon>
                                    </span>
                                    <input type="text" name="primer_Apellido" required>
                                    <label>Apellido/s</label>
                                </div>
                                <div class="input-box">
                                    <label for="fecha_Nacimiento" class="fecha_Naci" name="fecha_Nacimiento"> Fecha de
                                        Nacimiento</label>
                                    <span class="icon">
                                        <ion-icon name="calendar-outline"></ion-icon>
                                    </span>
                                    <input type="date" name="fecha_Nacimiento" required>
                                    <label></label>
                                    <!--  Falta, que no se pueda poner una fecha mayor que la actual y hacer controladores de los campos -->
                                </div>
                                <div>
                                    <div>
                                        <label><input type="checkbox"> Acepto los términos y condiciones</label>
                                    </div>
                                    <button type="submit" class="btn" name="registro">Registro</button>
                                    <div class="loginRegister">
                                        <p>¿Ya tienes cuenta?</p>
                                        <a href="#" class="loginLink">Inicia Sesion</a>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <a href="#" id="esLink">ES</a>
            <a href="#" id="catLink">CAT</a>
            <a href="#" id="engLink">ENG</a>




            <!-- Modal Desarrolladores -->
            <div class="modal modalDesa fade" id="modalDesa" tabindex="-1" aria-labelledby="miModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Contenido del modal -->
                            <div class="contenido-modal">
                                <img src="./Imagenes/pedro.png" alt="pedro_Imagen" class="imagen-redonda">
                                <div class="textos-modal">
                                    <h2>Pedro</h2>
                                    <p>Crador y desarrollador de Brazil</p>
                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="modal-body">
                            <div class="contenido-modal">
                                <img src="./Imagenes/jean.png" alt="aleix_Imagen" class="imagen-redonda">
                                <div class="textos-modal">
                                    <h2>Aleix</h2>
                                    <p>Crador y desarrollador de India</p>
                                </div>
                            </div>
                            <!-- Contenido del modal -->

                        </div>
                        <hr>

                        <div class="modal-body">
                            <!-- Contenido del modal -->

                            <div class="contenido-modal">
                                <img src="./Imagenes/jean.png" alt="jean_Imagen" class="imagen-redonda">
                                <div class="textos-modal">
                                    <h2>Jean</h2>
                                    <p>Crador y desarrollador de Kenia Memory</p>
                                </div>

                            </div>
                            <hr>
                            <div class="modal-body">
                                <!-- Contenido del modal -->
                                <div class="contenido-modal">
                                    <img src="./Imagenes/jean.png" alt="alex_Imagen" class="imagen-redonda">
                                    <div class="textos-modal">
                                        <h2>Alex</h2>
                                        <p>Crador y desarrollador de Warcelona</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
        </nav>
    </header>


    <div class="modal modalStory fade" id="modalbcn" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="colModalIntroLore1">
                        <h2>WARCELONA</h2>
                        <p>En las vibrantes calles de Barcelona, Laia, una ingeniera audaz y talentosa, enfrenta un
                            desafío único. Su misión es navegar a través de las peligrosas calles de la ciudad,
                            evadiendo atracadores con astucia y utilizando sus habilidades en electricidad. En este
                            juego de supervivencia, Laia debe recolectar la mayor cantidad de dinero posible mientras
                            utiliza sus poderes eléctricos para zafarse de los peligros. ¿Podrás ayudar a Laia a salir
                            ilesa y con el botín en mano?</p>
                        <div class="buttons">  
                        <?php 
                           if(isset($_SESSION['user'])): ?>
                            <button class="jugarButton"onclick="window.location.href='./warcelona9.0/warcelona5.0/warcelona.html'">JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php else:

?>

                            <button class="jugarButton"onclick="window.location.href='./penaltis2/prueba.php'"disabled >JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php endif; ?>  
                           

                        </div>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\laia.png" alt="" class="liderbcn">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modalStory fade" id="modalBrazil" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="colModalIntroLore1">
                        <h2>BRASIL</h2>
                        <p>Tras su partida de Barcelona, Laia llega a Brasil, solo para encontrarse 
                            con un apagón masivo. En este juego, Laia debe usar su ingenio y habilidades 
                            en ingeniería para restaurar la electricidad. Golpeando dianas estratégicamente colocadas, 
                            generará la energía necesaria para iluminar Brasil de nuevo. Cada diana es un reto en sí mismo, 
                            y solo la precisión y la rapidez de Laia pueden salvar el día. </br>¿Estás listo para electrificar Brasil con Laia?</p>
                        <div class="buttons">    
                           <?php 
                           if(isset($_SESSION['user'])): ?>
                            <button class="jugarButton"onclick="window.location.href='./penaltis2/prueba.php'">JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php else:

?>

                            <button class="jugarButton"onclick="window.location.href='./penaltis2/prueba.php'"disabled >JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\Brasil.png" alt="" class="liderbcn">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modalStory fade" id="modalKenia" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="colModalIntroLore1">
                        <h2>KENIA</h2>
                        <p>Después de su éxito en Brasil, Laia se embarca en una nueva aventura en Kenya. 
                            Aquí, su objetivo es generar electricidad para los lugareños mediante un antiguo
                             y místico ritual africano. En este juego de parejas, cada acierto en el emparejamiento 
                             de símbolos mágicos desencadena un flujo de energía. Laia debe ser rápida y precisa en 
                             sus elecciones para canalizar la energía necesaria a las aldeas. ¿Podrás ayudar a Laia a 
                             iluminar Kenya con la sabiduría de sus ancestros?</p>
                        <div class="buttons">    
                        <?php 
                           if(isset($_SESSION['user'])): ?>
                            <button class="jugarButton"onclick="window.location.href='./KeniaMemory/LaiaJuegoNivel1/index.php'">JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php else:

?>

                            <button class="jugarButton"onclick="window.location.href='./penaltis2/prueba.php'"disabled >JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\Kenya.png" alt="" class="liderbcn">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modalStory fade" id="modalIndia" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="colModalIntroLore1">
                        <h2>INDIA</h2>
                        <p>En su última aventura, Laia, la ingeniera apasionada por la energía sostenible, 
                            se dirige a la bulliciosa India, específicamente al corazón de Bangalore. 
                            Aquí, se enfrenta al desafío de llevar luz a las casas del pueblo, cada una marcada 
                            con la cantidad de electricidad que necesita diariamente. Este rompecabezas requiere 
                            una meticulosa gestión de recursos y una estrategia inteligente. ¿Estás listo para 
                            ayudar a Laia a iluminar Bangalore y demostrar tus habilidades en la gestión de energías renovables?</p>
                        <div class="buttons">    
                        <?php 
                           if(isset($_SESSION['user'])): ?>
                            <button class="jugarButton"onclick="window.location.href='./India/index.php'">JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php else:

?>

                            <button class="jugarButton"onclick="window.location.href='./penaltis2/prueba.php'"disabled >JUGAR</button>
                            <button class="rankingButton" onclick="window.location.href='./ranking.php'">RANKING</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\India.png" alt="" class="liderbcn">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal modalStory fade" id="modalini" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="colModalIntroLore1">
                        <h2>Iniciar Sesión</h2>
                        <p>En las vibrantes calles de Barcelona, Laia, una ingeniera audaz y talentosa, enfrenta un
                            desafío único. Su misión es navegar a través de las peligrosas calles de la ciudad,
                            evadiendo atracadores con astucia y utilizando sus habilidades en electricidad. En este
                            juego de supervivencia, Laia debe recolectar la mayor cantidad de dinero posible mientras
                            utiliza sus poderes eléctricos para zafarse de los peligros. ¿Podrás ayudar a Laia a salir
                            ilesa y con el botín en mano?</p>
                        <button>JUGAR</button>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\laia.png" alt="" class="liderbcn">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal modalStory fade" id="modalranking" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                        <h2>RANKING</h2>
                        <form method="post" action="">
        
            <button class="btn btn-danger" type="submit" name="españa" value="1">WARCELONA</button>
            <button  class ="btn btn-info" type="submit" name="brasil" value="2">BRASIL</button>
            <button  class ="btn btn-light" type="submit" name="kenia" value="3">KENIA</button>
            <button  class ="btn btn-info" type="submit" name="india" value="4">INDIA</button>
            <button class ="btn btn-light" type="submit" name="global" value="Global">GLOBAL</button>
        </form>

                
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Posicion  </th>
                    <th>Nombre Usuario</th>
                    
                    <th>Puntuacion</th>
                  
               
                </tr>
            </thead>

            <body>
                <?php 
                  
                 
                  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['brasil'])) {
                      $paiselegido = $_POST['brasil'];
                      $ranking = rankingxPais($paiselegido);
          
                    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['españa'])) {
                        $paiselegido = $_POST['españa'];
                        $ranking = rankingxPais($paiselegido);
                  }
                  else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kenia'])) {
                    $paiselegido = $_POST['kenia'];
                    $ranking = rankingxPais($paiselegido);
                }
                 else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['india'])) {
                    $paiselegido = $_POST['india'];
                    $ranking = rankingxPais($paiselegido);
                 }
                 else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['global'])) {
                    $paiselegido = $_POST['global'];
                    $ranking = rankingGlobal();
                 }
                 else{
                    $ranking = rankingxPais(2);
                 }

                 $posicion=0;
               
                
                
                ?>
                <?php foreach ($ranking as $puntuacion) { ?>
                  
                    <tr>
                        <td>
                      <?php   $posicion++; ?>
                            <?php echo $posicion ?>
                        <td>
                       
                           <?php echo $puntuacion['nombreUsuario']; ?>

                        
                        </td>
                       
                        <td>
                            <?php
                            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['global'])) {
                               echo $puntuacion['totalPuntuacion'];
                                
                            }else{
                                 echo $puntuacion['puntuacion']; 
                            }
                             
                                ?>
           



                        </td>

                    </tr>
                <?php } ?>
                </tbody>
        </table>
    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="./apps/translations.js"></script>
<script src="./apps/scen.js"></script>
<script src="./apps/main.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>