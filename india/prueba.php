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
    <div class="explanation">
    <h1>Camí de la llum</h1>
                    <p>Construye una ciudad sostenible conectando las casas con un camino que comienza en el generador central!</p>
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
                            <button type="button">JUGAR</button>
                        </div>
                    </div>
    </div>
</body>

</html>