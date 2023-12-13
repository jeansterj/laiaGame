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
      <div>ELIGE LA DIFICULTAD</div>
      <br>
      <div class="btn-group" role="group">
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="botondifi">
      DIFICULTAD
    </button>
    <ul class="dropdown-menu dropdown-menu-light">
      <li><a class="dropdown-item " href="#" onclick="DIF1()">DIFICULTAD 1</a></li>
      <li><a class="dropdown-item" href="#" onclick="DIF2()">DIFICULTAD 2</a></li>
      <li><a class="dropdown-item" href="#" onclick="DIF3()">DIFICULTAD 3</a></li>
    </ul>
  </div>
      
      <br>
      <div>Clicka lo mas rapido que puedas en las dianas</div>
      <br>
      <div><img src="./img/diananorm.png" alt=""> +1 P</div>
      <br>
      <div><img src="./img/dianadoble.png" alt=""> +2 P</div>
      <br>
      <div><img src="./img/diananeg.png" alt=""> -1 P</div>
      <br>

     






      <button class="start2 custom-btn2" onclick="startGame() ,reproducirAudio();">
        <img src="./img/play.png" alt="Imagen" class="img-fluid w-180 h-180 mr-2" />
      </button>


    </div>
   

  </div>

  <div id="end-screen" class="end-screen container text-center" style="width :350px ">
    <div class="card border-light mb-3 bg-transparent" style="max-width: 18rem;">
      <div class="card-header bg-transparent text-light ">Juego finalizado!</div>
      <div class="card-body text-light">
        <h5 class="card-title">Puntuacion final: <a id="puntuacion">0</a>
        </h5>
        <p class="card-text" id="textoFinal"></p>
      </div>
      <div class="card-footer bg-transparent text-light ">
        <a id="textovolver" class="text-light"></a>
        <button class="btn  custom-btnrejugar " id="botonfail">
          <img src="./img/replay.png" onclick="rePlay('botonreplay');" alt="Imagen" class="img-fluid w-180 h-180 mr-2"
            id="rejugar" />

        </button>



        <form action="../php_controllers/laiaController.php" METHOD="POST">
          <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>" <?php echo $_SESSION['idUser'] ?>>
          <input type="hidden" name="puntuacion" value="">





          <button class="btn  custom-btnrejugar border-light" type="submit" name="brasildata" id="siguientejuego">SIGUIENTE JUEGO

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




        <div class="col-md-2 custom-card text-light bg-transparent">
          <div class="card p-0 d-flex bg-transparent text-light" style="width: 18rem ">
            <div class="container  bg-transparent text-light " id="explicacion">
              <div class="font-weight-bold"><img src="./img/dianadoble.png" alt="diana2" /> + 2 punto </div>
              <br>
              <div><img src="./img/diananorm.png" alt="diana1" /> + 1 punto</div>


              <br>
              <div class=""><img src="./img/diananeg.png" alt="diana2" /> - 1 punto </div>

            </div>


            <ul class="list-group list-group-flush bg-transparent text-light">
              <li class="list-group-item bg-transparent text-light">
                TIEMPO RESTANTE : <span id="timer"></span>
              </li>
              <li class="list-group-item bg-transparent text-light">
                ACIERTOS : <span id="aciertos"></span>
              </li>

              <audio id="musica" src="./audio/musicabrazuka.mp3"></audio>
              <audio id="succsound" src="./audio/mario-coin.mp3"></audio>
              <audio id="failsound" src="./audio/mario-brosfail.wav"></audio>
              <audio id="2psound" src="./audio/mario-bros vida.mp3"></audio>
             
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="progressBar">
                    <div class="milestone milestone-40">
                        
                    </div>
                    <div class="milestone milestone-60">
                      
                    </div>
                    <div class="milestone milestone-80">
                       
                    </div>
                    <div class="milestone milestone-100">
                      
                    </div>
                    <div class="progress" id="currentProgress"></div>
                </div>
  </div>

  <script src="./script.js"></script>
</body>

</html>