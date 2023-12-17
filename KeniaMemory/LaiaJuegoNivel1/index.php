<?php


include('../../php_librarys/bdlaia.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../style/style.css">

    <title>Kenia Memory</title>

</head>

<body>


    <div class="seleccionNivel" id="facil">

        <h2>Selecciona el nivel que desees jugar</h2>

        <button type="button" onclick="primerNivel();" class="orangeButton"><img src="..\img\facil.png" draggable="false" alt="">

        <button type="button" onclick="segundoNivel()" class="greenButton"><img src="..\img\dificil.png" draggable="false" alt="">

        <button type="button" data-bs-toggle="modal" data-bs-target="#instrucciones" class="AjusteInstrucciones">Instrucciones

    </div>
    <div class="SeleccionInicio" id="seleccion">
        <div>
            <label for="rows">Filas</label>
            <select id="rows">
                <option selected>Selecciona Cuantas filas deseas</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
            </select>

            <label for="cols">Columnas</label>
            <select id="cols">
                <option selected>Selecciona Cuantas columnas deseas</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
            </select>
        </div>
        <div class="play">
            <button onclick="loadingGame()" id="play"><img src="..\img\play.png" alt="playGame" draggable="false"></button>
        </div>

    </div>
    <!--  
    <div class="container text-center" id="hide">
        <div class="headrow">
            <div class="col1">
                <p>Energía</p>
                <p id="scoreHTML">0</p>
            </div>
            <div class="col2">
                <div class="progressBar">
                    <div class="milestone milestone-40">
                        <span class="milestone-label">40</span>
                    </div>
                    <div class="milestone milestone-60">
                        <span class="milestone-label">60</span>
                    </div>
                    <div class="milestone milestone-80">
                        <span class="milestone-label">80</span>
                    </div>
                    <div class="milestone milestone-100">
                        <span class="milestone-label">100</span>
                    </div>
                    <div class="progress" id="currentProgress"></div>
                </div>
            </div>
        </div>
        -->

    <div id="game">
        

        <main>

   

            <section class="section1">



                <h1>Kenia Memory</h1>


                <table id="memoryTable"></table>

            </section>

            <section class="section2">

                <h2 class="stats" id="aciertos"></h2>
                <h2 class="stats" id="time"></h2>
                <h2 class="stats" id="move"></h2>

            </section>

        </main>
    </div>

    <div id="endGame">
        <div class="ajuste">
            <h2 class="stats" id="aciertosEnd"></h2>
            <h2 class="stats" id="timeEnd"></h2>
            <h2 class="stats" id="moveEnd"></h2>
        </div>

        <div>

            <h2 class="stats" id="puntosEnd"></h2>

            <form action="../../php_controllers/laiaController.php" METHOD="POST">
                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>"
                    <?php echo $_SESSION['idUser'] ?>>
                <input type="hidden" name="puntuacion" value="">

                <h2 class="stats2"> Has Ganado la siguiente pieza <img src="..\img\solarPanel.png" alt="" draggable="false">

                    <button type="submit" name="Keniadata" id="siguientejuego">Continuar </button></h2>
            </form>

        </div>

    </div>

    <div id="loserGame">
        <section class="section2 just">

            <h2 class="stats3" id="byeEnd"></h2>
            <button type="button" onclick="window.location.href='./index.php'" class="orangeButton">Reiniciar
                <button type="button" onclick="window.location.href='../../tierra2.php'" class="greenButton">Inicio

        </section>

    </div>

    <button class="info" data-bs-toggle="modal"  aria-labelledby="instrucciones" onclick="abrirModal();" id="botonInfo"><img src="..\img\info.png" alt="" draggable="false"></button>

    <div class="modal spaceAjust" tabindex="-1" id="instrucciones">
        <div class="modal-dialog">
            <div class="modal-content modalModification">
                <div class="modal-body">
                    <b><p>Embárcate en un antiguo y místico ritual para emparejar todos los símbolos mágicos frágiles,
                        evitando movimientos innecesarios que puedan perturbar su energía. Encuentra todos los pares
                        antes de que
                        el tiempo se agote para revelar la pieza oculta.
                    </p></b>

                    <div class="col4">
                        <h1>¿Cómo jugar?</h1>
                        <ol start="1">
                            <b><li>Inicio del Ritual:</b>

                                <ul type="disc">
                                    <li>Inicia el juego y observa la disposición inicial de los símbolos mágicos en el
                                        tablero.</li>
                                </ul>

                            </li>
                            <b><li>Energía Mística:</b>

                                <ul type="disc">
                                    <li>Cada vez que emparejas dos símbolos mágicos, generas energía mística mediante el
                                        antiguo ritual.</li>
                                </ul>

                            </li>
                            <b><li>Movimientos Sutiles:</b>

                                <ul type="disc">
                                    <li>Haz clic en un símbolo mágico para revelarlo y, luego, haz clic en otro para
                                        buscar su pareja.</li>
                                    <li>Evita movimientos innecesarios para no perturbar la energía mística.</li>
                                </ul>

                            </li>
                            <b><li>Tiempo de Rituales:</b>

                                <ul type="disc">
                                    <li>El ritual tiene un tiempo limitado para completarse.</li>
                                    <li>Encuentra todos los pares antes de que la energía mística se agote.</li>
                                </ul>

                            </li>
                            <b><li>Puntuación Arcana:</b>

                                <ul type="disc">
                                    <li>Tu puntuación se determina por la rapidez con la que completas el ritual y la
                                        mínima cantidad de movimientos que realizas.</li>
                                </ul>

                            </li>
                            <b><li>Desvelar la Pieza Oculta:</b>

                                <ul type="disc">
                                    <li>Después de emparejar todos los símbolos mágicos, revelarás una pieza oculta que necesitaras mas adelante.</li>
                                </ul>

                            </li>
                            <b><li>Final del Ritual:</b>

                                <ul type="disc">
                                    <li>El ritual concluye cuando encuentras todos los pares de símbolos o cuando el
                                        tiempo místico se agota.</li>
                                </ul>

                            </li>

                        </ol>
                        <p>¡Que los símbolos mágicos te guíen en tu búsqueda de la pieza oculta y que la energía mística te acompañe en tu viaje!</p>

                    <p>Siempre puedes hacer click en <img src="..\img\infoBlack.png" alt="" draggable="false"> si quieres volver a ver las instrucciones</p>
                    </div>
                    <div class="col3 ">
                            <img src="../img/muestraGame.gif" alt="" draggable="false">
                            <br>
                        </div>

                


                </div>
            </div>
        </div>

        <script src="./apps/app.js"></script>

        </body>

</html>