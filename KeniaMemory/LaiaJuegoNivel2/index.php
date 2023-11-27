<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style/style.css">
    
    <title>Kenia Memory</title>
</head>

<body>

    <main>

 
        <section class="section1">
            <h1>Kenia Memory</h1>
            <table>

                <tr>
                    <td><button id="0" data-id="0" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="1" data-id="0" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="2" data-id="1" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="3" data-id="1" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="4" data-id="2" data-found="false" onclick="voltear(id)"></button></td>

                </tr>
                <tr>
                    <td><button id="5" data-id="2" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="6" data-id="3" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="7" data-id="3" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="8" data-id="4" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="9" data-id="4" data-found="false" onclick="voltear(id)"></button></td>

                </tr>
                <tr>
                    
                    <td><button id="10" data-id="5" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="11" data-id="5" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="12" data-id="6" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="13" data-id="6" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="14" data-id="7" data-found="false" onclick="voltear(id)"></button></td>

                </tr>
                <tr>
                    <td><button id="15" data-id="7" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="16" data-id="8" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="17" data-id="8" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="18" data-id="9" data-found="false" onclick="voltear(id)"></button></td>
                    <td><button id="19" data-id="9" data-found="false" onclick="voltear(id)"></button></td>

                </tr>
            </table>



        </section>
        <section class="section2">

            <h2 class="stats" id="aciertos">Aciertos: 0</h2>
            <h2 class="stats" id="time">Tiempo: 60 segundos</h2>
            <h2 class="stats" id="move">Movimientos: 0</h2>


        </section>


    </main>

    

</body>

</html>

<script src="./apps/app2.js"></script>