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
    <div class="container text-center">
        <div class="headrow">
            <div class="col1">
                <p>Energia</p>
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
            </div>
            <div class="col4">
                <table>
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
                            <img src="img/wire/horizontal.png"></td>
                            <td><p>1</p></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="piece" id="connector" draggable="true">
                                <img src="img/connector/connector.png"></td>
                            <td><p>2</p></td>
                        </tr>
                        <tr>
                            <td>
                            <div class="piece" id="windTurbine" draggable="true">
                            <img src="img/windTurbine/windTurbine.png"></td>
                            <td><p>5</p></td>
                        </tr>
                        
                        <tr>
                            <td>
                                <div class="piece" id="solarPanel" draggable="true">
                                    <img src="img/solarPanel/solarPanel.png"></td>
                            <td><p>10</p></td>
                        </tr>
                        <tr>
                            <td>
                                <button id="deleteLastElement"></button>
                                </td>
                            <td><p id="contador">0:00</p></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    </div>
    <script type="module" src="scripts/main.js"></script>
</body>

</html>