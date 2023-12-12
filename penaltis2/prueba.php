<?php


include('../php_librarys/bdlaia.php');

?>

<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="./style/styles.css" />
  <title>Minijuego de Lanzar Penaltis</title>
</head>

<body>

  <div id="start-screen" class="start-screen">
   
    
    <!-- <button class="start custom-btn2" onclick="startGame() ,reproducirAudio();">
      <img src="./img/play.png" alt="Imagen" class="img-fluid w-180 h-180 mr-2" />
    </button> -->
    <div class="container" id="explicacionpr">


      <!-- <div id="explicacionpr"> <img src="./img/start.png" alt=""></div> -->
      
      <button class="btn btn-light" onclick ="dificultad1();">DIFICULTAD1</button>
      <button class="btn btn-info"" onclick ="dificultad2();"">DIFICULTAD2</button>

     









    </div>
    <button class="start2 custom-btn2" onclick="startGame() ,reproducirAudio();">
        <img src="./img/play.png" alt="Imagen" class="img-fluid w-180 h-180 mr-2" />
      </button>

  </div>

  <div id="end-screen" class="end-screen container text-center" style="width :350px ">
    <div class="card border-dark mb-3 bg-info" style="max-width: 18rem;">
      <div class="card-header bg-transparent ">Juego finalizado!</div>
      <div class="card-body text-dark">
        <h5 class="card-title">Puntuacion final: <a id="puntuacion">0</a>
        </h5>
        <p class="card-text" id="textoFinal"></p>
      </div>
      <div class="card-footer bg-transparent ">
        <a id="textovolver"></a>
        <button class="btn  custom-btnrejugar " id="botonfail">
          <img src="./img/replay.png" onclick="rePlay('botonreplay');" alt="Imagen" class="img-fluid w-180 h-180 mr-2"
            id="rejugar" />

        </button>



        <form action="../php_controllers/laiaController.php" METHOD="POST">
          <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>" <?php echo $_SESSION['idUser'] ?>>
          <input type="hidden" name="puntuacion" value="">





          <button class="btn  custom-btnrejugar" type="submit" name="brasildata" id="siguientejuego">SIGUIENTE JUEGO

          </button>
        </form>



      </div>
    </div>

  </div>





  <div id="content" style="display: none" class="">
    <div class="container text-center">
      <a class="logo" href="http://localhost:8080/laiaGame/tierra2.php"><img style="width: 175px; height: 85px; "
          src="../Imagenes/logo.png" alt="logo_centiks"></a>
      <div class="row">
        <div class="col-md-8">
          <div id="campo de juego" class="centered">
            <img src="./img/campo.jpg" draggable="false" alt="campo" style="user-select: none;" />
            <div class="game-board" id="game-board"></div>

            <button class="btn btn-light custom-btn mb-3">
              <img src="../penaltis2/img/volumemute.png" onclick="controlarAudio();" alt="Imagen"
                class="img-fluid w-180 h-180 mr-2" id="imagensonido" />
            </button>


            <button class="btn btn-light custom-btn mb-3" id="replayingame">
              <img src="./img/replay.png" onclick="rePlay('replayingame');" alt="Imagen"
                class="img-fluid w-180 h-180 mr-2" id="imagensonido" />
            </button>
          </div>
        </div>




        <div class="col-md-2 custom-card   text-dark">
          <div class="card p-0 d-flex bg-info text-dark" style="width: 18rem ">
            <div class="container  bg-info text-dark " id="explicacion">
              <div class="font-weight-bold"><img src="./img/dianadoble.png" alt="diana2" /> + 2 punto </div>
              <br>
              <div><img src="./img/diananorm.png" alt="diana1" /> + 1 punto</div>


              <br>
              <div class=""><img src="./img/diananeg.png" alt="diana2" /> - 1 punto </div>

            </div>


            <ul class="list-group list-group-flush bg-info text-dark">
              <li class="list-group-item bg-info">
                TIEMPO RESTANTE : <span id="timer"></span>
              </li>
              <li class="list-group-item bg-info">
                ACIERTOS <span id="aciertos"></span>
              </li>

              <audio id="musica" src="./audio/musicabrazuka.mp3"></audio>
              <audio id="succsound" src="./audio/mario-coin.mp3"></audio>
              <audio id="failsound" src="./audio/mario-brosfail.wav"></audio>
              <audio id="2psound" src="./audio/mario-bros vida.mp3"></audio>
              <li class="list-group-item bg-transparent">
                Potencia actual: <span id="potencia"></span>
                <div id="caja-generador">
                  <div id="celda1"></div>
                  <div id="celda2"></div>
                  <div id="celda3"></div>
                  <div id="celda4"></div>
                  <div id="celda5"></div>
                  <div id="celda6"></div>
                  <div id="celda7"></div>
                  <div id="celda8"></div>
                  <div id="celda9"></div>
                  <div id="celda10"></div>
                  <div>


                  </div>

                </div>




              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./script.js"></script>
</body>

</html>