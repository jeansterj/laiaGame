<?php


include('../php_librarys/bdlaia.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc de l'indiaS</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
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
        <div class="row">
            <div class="col3">
                <div id="gameBoard"></div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalHelp"></button>
            </div>
            <div class="col4">
                <table class="tableGame">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Valor energético</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="piece" id="wire" draggable="true">
                                    <img src="img/wire/horizontal.png">
                                </div>
                            </td>
                            <td>
                                <p>1</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="piece" id="connector" draggable="true">
                                    <img src="img/connector/connector.png">
                                </div>
                            </td>
                            <td>
                                <p>2</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="piece" id="windTurbine" draggable="true">
                                    <img src="img/windTurbine/windTurbine.png">
                                </div>
                            </td>
                            <td>
                                <p>5</p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="piece" id="solarPanel" draggable="true">
                                    <img src="img/solarPanel/solarPanel.png">
                                </div>
                            </td>
                            <td>
                                <p>10</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id="deleteLastElement"></button>
                            </td>
                            <td>
                                <p id="contador">0:00</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modalHelp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h1>Camí de la llum</h1>
                    <p>Construye una ciudad sostenible conectando las casas con un camino que comienza en el generador
                        central!</p>
                    <div class="modal-cols">
                        <div class="col4">
                            <h2>¿Como jugar?</h2>
                            <ol>
                                <li>Arrastra las piezas al tablero.</li>
                                <li>Conecta las casas al generador.</li>
                                <li>Alcanza la puntuación requerida para cada casa.</li>
                                <li>¡Completa la ciudad antes de que se agote el tiempo!</li>
                            </ol>
                            <h2>Piezas:</h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="piece">
                                                <img src="img/wire/horizontal.png">
                                            </div>
                                        </td>
                                        <td>
                                            <p>Valor</p>
                                            <p>1</p>
                                        </td>
                                        <td>
                                            <div class="piece">
                                                <img src="img/connector/connector.png">
                                            </div>
                                        </td>
                                        <td>
                                            <p>Valor</p>
                                            <p>2</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="piece">
                                                <img src="img/windTurbine/windTurbine.png">
                                            </div>
                                        </td>
                                        <td>
                                            <p>Valor</p>
                                            <p>5</p>
                                        </td>
                                        <td>
                                            <div class="piece">
                                                <img src="img/solarPanel/solarPanel.png">
                                            </div>
                                        </td>
                                        <td>
                                            <p>Valor</p>
                                            <p>10</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h2>Consejos:</h2>
                            <p>
                                - Verifica la puntuación y las condiciones especiales.<br>
                                - Elimina la última pieza si es necesario.
                            </p>
                        </div>
                        <div class="col3">
                            <img src="img/arrastrarIndia.gif" alt="">
                            <button type="button" data-bs-dismiss="modal"> CONTINUAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center" id="show">
        <h2>TU PUNTUACIÓN HA SIDO DE <span id="finalScore"></span>! ¡JUEGO FINALIZADO!</h2>
        <p>Has navegado por desafíos peligrosos, resuelto rompecabezas complejos y llevado luz a comunidades de todo el mundo. 
            Tu aventura es un recordatorio poderoso de cómo la innovación y la determinación pueden cambiar el mundo. Gracias por acompañar a Laia en este viaje inspirador,
             donde cada victoria es un paso hacia un futuro más brillante y sostenible. Además, la recopilación de piezas en tu travesía ha sido fundamental para construir un camino 
             hacia la sostenibilidad y el progreso.
        </p>
        <form action="../php_controllers/laiaController.php" METHOD="POST">
            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>" <?php echo $_SESSION['idUser'] ?>>
            <input type="hidden" name="puntuacion" value="">





            <button class="btn  custom-btnrejugar border-light" type="submit" name="indiadata"
                id="siguientejuego">VOLVER

            </button>
        </form>
    </div>
    <script type="module" src="scripts/main.js"></script>
</body>

</html>