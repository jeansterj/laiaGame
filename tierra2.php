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

            <button type="button" class="infoButton" data-bs-toggle="modal" data-bs-target="#modalini"><img class="book"
                    src="./Imagenes/open-book.png" alt=""></button>
                
            <button type="button" class="nuevoRanking" data-bs-toggle="modal" data-bs-target="#bcnranking"><img class="book"
                    src="./Imagenes/trophy.png" alt=""></button>

            <button type="button" class="basicButton" data-bs-toggle="modal" data-bs-target="#modalDesa"
                data-translate="sobreNosotros">Sobre
                Nosotros</button>


            <?php if (isset($_SESSION['user'])): ?>
                <!-- Si la sesión está iniciada, muestra el botón "Cerrar Sesión" -->
                <button class="btn btnLogin-popup" onclick="logout();"


                    name="logoutLink" data-translate="cerrarSesion">CERRAR
                    SESION</button>


            <?php else: ?>
                <!-- Si la sesión no está iniciada, muestra el botón "Iniciar Sesión" -->
                <button class="btnLogin-popup" name="loginLink" data-bs-toggle="modal" data-bs-target="#loginForm"
                    data-translate="iniciarSesion">Iniciar
                    Sesión</button>
            <?php endif; ?>


            <!-- Modal -->
            <div class="modal modalLogin fade" id="loginForm" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="popupContainer">
                            <div class="form-box login ">
                                <h2 data-translate="iniciarSesion">Iniciar Sesión</h2>
                                <form action="./php_controllers/laiaController.php" method="POST">
                                    <div class="input-box">
                                        <span class="icon">
                                            <ion-icon name="person-circle-outline"></ion-icon>
                                        </span>
                                        <input type="text" name="userName" required>
                                        <label data-translate="nombreUsuario">Nombre de usuario</label>
                                    </div>
                                    <div class="input-box">
                                        <span class="icon">
                                            <ion-icon name="lock-closed-outline"></ion-icon>
                                        </span>
                                        <input type="password" name="password" required>
                                        <label data-translate="password">Password</label>
                                    </div>
                                    <button type="submit" name="login" class="btn"
                                        data-translate="iniciarSesion">Iniciar Sesion</button>

                                    <div class="loginRegister">
                                        <p data-translate="noTienesCuenta">¿No tienes cuenta?</p>
                                        <a href="#" name="registerLink" class="registerLink"
                                            data-translate="registrate">Registrate</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-box register">
                            <h2 data-translate="registro">Registro</h2>
                            <form action="./php_controllers/laiaController.php" method="POST">
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                    </span>
                                    <input type="text" name="userName" required>
                                    <label data-translate="nombreUsuario">Nombre de Usuario</label>
                                </div>
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                    </span>
                                    <input type="password" name="password" required>
                                    <label data-translate="password">Password</label>
                                </div>
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="person-outline"></ion-icon>
                                    </span>
                                    <input type="text" name="nombre" required>
                                    <label data-translate="nombre">Nombre</label>
                                </div>
                                <div class="input-box">
                                    <span class="icon">
                                        <ion-icon name="people-outline"></ion-icon>
                                    </span>
                                    <input type="text" name="primer_Apellido" required>
                                    <label data-translate="apellido">Apellido/s</label>
                                </div>
                                <div class="input-box">
                                    <label for="fecha_Nacimiento" class="fecha_Naci" name="fecha_Nacimiento"
                                        data-translate="fechaNacimiento"> Fecha de
                                        Nacimiento</label>
                                    <span class="icon">
                                        <ion-icon name="calendar-outline"></ion-icon>
                                    </span>
                                    <input type="date" name="fecha_Nacimiento" required>
                                    <input type="hidden" id="id_Rol" value="3" name="id_Rol">
                                    <label></label>
                                    <!--  Falta, que no se pueda poner una fecha mayor que la actual y hacer controladores de los campos -->
                                </div>
                                <div>
                                    <div>
                                        <label id="terminos"> <input type="checkbox" require>
                                            <p data-translate="terminos" class="terminos">Acepto los términos y condiciones</p>
                                        </label>

                                    </div>
                                    <button type="submit" class="btn" name="registro"
                                        data-translate="registro">Registro</button>
                                    <div class="loginRegister">
                                        <p data-translate="cuentaExistente">¿Ya tienes cuenta?</p>
                                        <a href="#" class="loginLink" data-translate="iniciarSesion">Inicia Sesion</a>
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
                                    <p data-translate="desaBrasil">Creador y desarrollador de Brazil</p>
                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="modal-body">
                            <div class="contenido-modal">
                                <img src="./Imagenes/aleix.png" alt="aleix_Imagen" class="imagen-redonda">
                                <div class="textos-modal">
                                    <h2>Aleix</h2>
                                    <p data-translate="desaIndia">Creador y desarrollador de India</p>
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
                                    <p data-translate="desaKenia">Creador y desarrollador de Kenia Memory</p>
                                </div>

                            </div>
                            <hr>
                            <div class="modal-body">
                                <!-- Contenido del modal -->
                                <div class="contenido-modal">
                                    <img src="./Imagenes/alex.png" alt="alex_Imagen" class="imagen-redonda">
                                    <div class="textos-modal">
                                        <h2>Alex</h2>
                                        <p data-translate="desaWarcelona">Creador y desarrollador de Warcelona</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
        </nav>
    </header>


    <div class="modal modalStory fade" id="modalbcn" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="colModalIntroLore1">
                        <h2>WARCELONA</h2>
                        <p data-translate="loreWarcelona">En las bulliciosas calles de Barcelona, Laia, ingeniera audaz,
                            se enfrenta a un desafío único.
                            Más allá de sus habilidades eléctricas, su misión implica navegar las intrincadas
                            callejuelas, evitando atracadores,
                            en busca de una pieza crucial para su viaje global. En este juego de supervivencia, Laia no
                            solo busca recolectar fondos,
                            sino también perseguir una misteriosa pieza. ¿Podrás ayudar a Laia a salir ilesa, con el
                            codiciado botín y asegurar la pieza
                            indispensable para su travesía?</p>
                        <div class="buttons">
                            <?php
                            if (isset($_SESSION['user'])): ?>
                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./warcelona9.0/warcelona5.0/warcelona.php'">JUGAR</button>
                            <?php else:

                                ?>

                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./penaltis2/prueba.php'" disabled>JUGAR</button>
                              

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
    <div class="modal fade modalRankings" id="bcnranking" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body rankingSpace">
                    <?php include_once('./rankingprueba.php') ?>
                    <button class="rankingButton" id="rankingButton" data-bs-target="#modalbcn"
                        data-bs-toggle="modal">VOLVER</button>
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
                        <h2 data-translate="brasil">BRASIL</h2>
                        <p data-translate="loreBrasil">Tras dejar Barcelona, Laia llega a Brasil enfrentándose a un
                            apagón masivo. Para restaurar la electricidad,
                            debe golpear estratégicamente dianas, generando energía para iluminar el país. Cada diana es
                            un desafío único y solo la precisión y
                            rapidez de Laia pueden salvar el día. En su viaje, Laia también busca conseguir una pieza
                            esencial. ¿Estás listo para
                            electrificar Brasil con Laia?</p>
                        <div class="buttons">
                            <?php
                            if (isset($_SESSION['user'])): ?>
                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./penaltis2/prueba.php'">JUGAR</button>
                                    
                            <?php else:

                                ?>

                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./penaltis2/prueba.php'" disabled>JUGAR</button>
                              
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\Brasil.png" alt="" class="liderBrasil">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modalRankings" id="bcnranking" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body rankingSpace">
                    <?php include_once('./rankingprueba.php') ?>
                    <button class="rankingButton" id="rankingButton" data-bs-target="#modalBrazil"
                        data-bs-toggle="modal">VOLVER</button>
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
                        <h2 data-translate="kenia">KENIA</h2>
                        <p data-translate="loreKenia">Después de su éxito en Brasil, Laia se aventura en Kenia con el
                            propósito de generar electricidad a través de un ancestral ritual
                            africano. En un juego de parejas mágicas, cada acierto desata energía vital. Laia, rápida y
                            precisa, debe iluminar aldeas canalizando esta energía. Además,
                            para avanzar en su búsqueda global, debe conseguir una pieza esencial de Kenia. ¿Podrás
                            ayudar a Laia a iluminar Kenia y asegurar la pieza necesaria
                            en esta nueva y fascinante misión?</p>
                        <div class="buttons">
                            <?php
                            if (isset($_SESSION['user'])): ?>
                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./KeniaMemory/LaiaJuegoNivel1/index.php'">JUGAR</button>
                                    
                            <?php else:

                                ?>

                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./penaltis2/prueba.php'" disabled>JUGAR</button>
                               
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\Kenya.png" alt="" class="liderKenia">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modalRankings" id="bcnranking" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body rankingSpace">
                    <?php include_once('./rankingprueba.php') ?>
                    <button class="rankingButton" id="rankingButton" data-bs-target="#modalKenia"
                        data-bs-toggle="modal">VOLVER</button>
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
                        <p data-translate="loreIndia">En su última aventura, Laia, la ingeniera apasionada por la
                            energía sostenible, llega a Bangalore, India,
                            enfrentándose al desafío de llevar luz a casas con necesidades eléctricas diarias. Este
                            rompecabezas requiere una gestión cuidadosa de recursos y
                            estrategia. ¿Estás listo para ayudar a Laia a iluminar Bangalore y demostrar tus habilidades
                            en energías renovables? Además, descubre que las piezas
                            obtenidas durante su viaje son esenciales para proporcionar energía a la India.</p>
                        <div class="buttons">
                            <?php
                            if (isset($_SESSION['user'])): ?>
                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./India/reglas.php'">JUGAR</button>
                                  
                            <?php else:

                                ?>

                                <button class="jugarButton" data-translate="jugar"
                                    onclick="window.location.href='./penaltis2/prueba.php'" disabled>JUGAR</button>
                               
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="colModalIntroLore2">
                        <img src=".\Imagenes\India.png" alt="" class="liderIndia">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modalRankings" id="bcnranking" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body rankingSpace">
                    <?php include_once('./rankingprueba.php') ?>
                    <button class="rankingButton" id="rankingButton" data-bs-target="#modalIndia"
                        data-bs-toggle="modal">VOLVER</button>
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
                        <h2>Laia, ens il·lumines</h2>
                            <p data-translate="loreInicial">Laia, una ingeniera apasionada por la energía sostenible, se
                                lanza a una aventura global. Su
                                misión es iluminar el mundo. En cada etapa, Laia utiliza sus habilidades únicas para superar
                                desafíos electrizantes y rompecabezas inteligentes, llevando luz y esperanza a cada rincón
                                que visita. Acompaña a Laia en esta saga inspiradora ¿Podrás ayudarla a cumplir su misión y
                                alzarte con el triunfo?</p>
                                <div id="imageneslore">
                                    <div id="connector"><img src="./Imagenes/connector.png" alt=""> </div>
                                    <div id="panelsolar"><img src="./Imagenes/solarPanel.png" alt=""></div>
                                    <div id="turbina"><img src="./Imagenes/windTurbine.png" alt=""></div>
                                </div>
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
                        <button class="btn btn-info" type="submit" name="brasil" value="2">BRASIL</button>
                        <button class="btn btn-light" type="submit" name="kenia" value="3">KENIA</button>
                        <button class="btn btn-info" type="submit" name="india" value="4">INDIA</button>
                        <button class="btn btn-light" type="submit" name="global" value="Global">GLOBAL</button>
                    </form>


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Posicion </th>
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
                            } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kenia'])) {
                                $paiselegido = $_POST['kenia'];
                                $ranking = rankingxPais($paiselegido);
                            } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['india'])) {
                                $paiselegido = $_POST['india'];
                                $ranking = rankingxPais($paiselegido);
                            } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['global'])) {
                                $paiselegido = $_POST['global'];
                                $ranking = rankingGlobal();
                            } else {
                                $ranking = rankingxPais(2);
                            }

                            $posicion = 0;



                            ?>
                            <?php foreach ($ranking as $puntuacion) { ?>

                                <tr>
                                    <td>
                                        <?php $posicion++; ?>
                                        <?php echo $posicion ?>
                                    <td>

                                        <?php echo $puntuacion['nombreUsuario']; ?>


                                    </td>

                                    <td>
                                        <?php
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['global'])) {
                                            echo $puntuacion['totalPuntuacion'];

                                        } else {
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