<?php


include('../../php_librarys/bdlaia.php');

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style/style.css">
    <title>Kenia Memory</title>
</head>

<body>

    <div class="seleccionNivel" id="facil">

        <h2>Selecciona el Nivel a Jugar</h2>

        <button type="button" onclick="primerNivel()"><img src="..\img\facil.png" alt="">
            <button type="button" onclick="window.location.href='../LaiaJuegoNivel2/index.php'"><img
                    src="..\img\dificil.png" alt="">

    </div>

    <div class="SeleccionInicio" id="seleccion">
        <label for="rows">Filas</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="rows">
            <option selected>Selecciona Cuantas filas deseas</option>
            <option value="2">Dos</option>
            <option value="4">Cuatro</option>
            <option value="6">Seis</option>
        </select>

        <label for="cols">Columnas</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="cols">
            <option selected>Selecciona Cuantas columnas deseas</option>
            <option value="4">Cuatro</option>
            <option value="5">Cinco</option>
            <option value="6">Seis</option>
            <option value="7">Siete</option>
        </select>

        <button onclick="loadingGame()"><img src="..\img\play.png" alt="playGame"></button>

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
        <section class="section2">

            <h2 class="stats" id="aciertosEnd"></h2>
            <h2 class="stats" id="timeEnd"></h2>
            <h2 class="stats" id="moveEnd"></h2>
            <h2 class="stats" id="puntosEnd"></h2>
            <h2 class="stats2" > Has Ganado la siguiente pieza <img src="..\img\solarPanel.png" alt=""> </h2>

        <form action="../../php_controllers/laiaController.php" METHOD="POST">
          <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>" <?php echo $_SESSION['idUser'] ?>>
          <input type="hidden" name="puntuacion" value="">


          <button class="btn  custom-btnrejugar" type="submit" name="Keniadata" id="siguientejuego"><img src="..\img\logo.png" alt="volverLanding"> </button>
        </form>

        </section>

    </div>

    <div id="loserGame">
        <section class="section2 just">

            <h2 class="stats3" id="byeEnd"></h2>
            <button type="button" onclick="window.location.href='./index.php'"class="orangeButton">Reiniciar
            <button type="button" onclick="window.location.href='../../tierra2.php'"class="greenButton">Inicio 



        </section>

    </div>

    <script src="./apps/app.js"></script>

</body>

</html>