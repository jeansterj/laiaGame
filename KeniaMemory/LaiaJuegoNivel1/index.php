<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style/style.css">
    <title>Kenia Memory</title>
</head>

<body>

    <main>

 
        <section class="section1">
            <h1>Kenia Memory</h1>
            <table>

                <tr>
                    <td><button id="0" onclick="voltear(0)"></button></td>
                    <td><button id="1" onclick="voltear(1)"></button></td>
                    <td><button id="2" onclick="voltear(2)"></button></td>
                    <td><button id="3" onclick="voltear(3)"></button></td>
                </tr>
                <tr>
                    <td><button id="4" onclick="voltear(4)"></button></td>
                    <td><button id="5" onclick="voltear(5)"></button></td>
                    <td><button id="6" onclick="voltear(6)"></button></td>
                    <td><button id="7" onclick="voltear(7)"></button></td>
                </tr>
                <tr>
                    <td><button id="8" onclick="voltear(8)"></button></td>
                    <td><button id="9" onclick="voltear(9)"></button></td>
                    <td><button id="10" onclick="voltear(10)"></button></td>
                    <td><button id="11" onclick="voltear(11)"></button></td>
                </tr>
                <tr>
                    <td><button id="12" onclick="voltear(12)"></button></td>
                    <td><button id="13" onclick="voltear(13)"></button></td>
                    <td><button id="14" onclick="voltear(14)"></button></td>
                    <td><button id="15" onclick="voltear(15)"></button></td>
                </tr>
            </table>



        </section>
        <section class="section2">

            <h2 class="stats" id="aciertos">Aciertos: 0</h2>
            <h2 class="stats" id="time">Tiempo: 30 segundos</h2>
            <h2 class="stats" id="move">Movimientos: 0</h2>


        </section>


    </main>

    <script src="apps/app.js"></script>

</body>

</html>