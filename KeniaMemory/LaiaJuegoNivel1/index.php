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

        <button onclick="loadingGame()">Jugar</button>

    </div>

    <div id="game">

        <main>

            <section class="section1">

                <h1>Kenia Memory</h1>
                <table id="memoryTable"></table>

            </section>

            <section class="section2">

                <h2 class="stats" id="aciertos">Aciertos: </h2>
                <h2 class="stats" id="time">Tiempo: segundos</h2>
                <h2 class="stats" id="move">Movimientos: </h2>

            </section>

        </main>
    </div>

    <div id="endGame">
        <section class="section2">

            <h2 class="stats" id="aciertos">Aciertos Completados </h2>
            <h2 class="stats" id="time">Tardaste </h2>
            <h2 class="stats" id="move">En movimientos </h2>

        </section>


    </div>

    <script src="./apps/app.js"></script>

</body>

</html>