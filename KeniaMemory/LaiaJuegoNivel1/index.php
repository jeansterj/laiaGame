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
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/style.css">
  
        <title>Kenia Memory</title>

</head>

<body>

    <div class="seleccionNivel" id="facil">

        <h2>Selecciona el nivel que desees jugar</h2>

        <button type="button" onclick="primerNivel()"><img src="..\img\facil.png" alt="">
            <button type="button" onclick="window.location.href='../LaiaJuegoNivel2/index.php'"><img
                    src="..\img\dificil.png" alt="">

    </div>

    <div class="SeleccionInicio" id="seleccion">
        <div>
        <label for="rows">Filas</label>
        <select  id="rows">
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
    <button onclick="loadingGame()"><img src="..\img\play.png" alt="playGame"></button>
    </div>

    </div>

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
            

            <div >

            <h2 class="stats" id="puntosEnd"></h2>

        <form action="../../php_controllers/laiaController.php" METHOD="POST">
          <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>" <?php echo $_SESSION['idUser'] ?>>
          <input type="hidden" name="puntuacion" value="">

          <h2 class="stats2" > Has Ganado la siguiente pieza <img src="..\img\solarPanel.png" alt=""> 

          <button type="submit" name="Keniadata" id="siguientejuego">Continuar </button></h2>
        </form>

            </div>
            
    </div>

    <div id="loserGame">
        <section class="section2 just">

            <h2 class="stats3" id="byeEnd"></h2>
            <button type="button" onclick="window.location.href='./index.php'"class="orangeButton">Reiniciar
            <button type="button" onclick="window.location.href='../../tierra2.php'"class="greenButton">Inicio 



        </section>

    </div>

    <button class="info"><img src="..\img\info.png" alt=""></button>

    <script src="./apps/app.js"></script>
  

</body>

</html>