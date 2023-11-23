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
    <button class="start custom-btn2" onclick="startGame() ,reproducirAudio();">
      <img src="./img/play.png" alt="Imagen" class="img-fluid w-180 h-180 mr-2" />
    </button>

  </div>

  <div id="end-screen" class="end-screen">
    <div class="card border-success mb-3" style="max-width: 18rem;">
      <div class="card-header bg-transparent border-success">Juego finalizado!</div>
      <div class="card-body text-success">
        <h5 class="card-title" >Puntuacion final: <p id ="puntuacion">0</p> </h5>
        <p class="card-text" id ="textoFinal"></p>
      </div>
      <div class="card-footer bg-transparent border-success">

        <button class="btn  custom-btnrejugar ">
          <img src="./img/replay.png" onclick="rePlay('botonreplay');" alt="Imagen" class="img-fluid w-180 h-180 mr-2"
            id="rejugar" />
        </button>


        <form action="../php_controllers/laiaController.php"  METHOD= "POST">
          <input type="hidden" name="idUsuario"  value="<?php echo $_SESSION['idUser'];?>"  <?php  echo $_SESSION['idUser']?>>
          <input type="hidden" name="puntuacion"value ="">
         

        
          

        <button class="btn  custom-btnrejugar" type="submit" name ="brasildata">SIGUIENTE JUEGO
         
         </button>
        </form>
       


      </div>
    </div>

  </div>





  <div id="content" style="display: none">
    <div class="container">
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
        <div class="col-md-2 custom-card">
          <div class="card p-0 d-flex" style="width: 18rem">
            <div class="container" id="explicacion">
              <div><img src="./img/dianadoble.png" alt="diana2" /> + 2 punto </div>
              <br>
              <div><img src="./img/diananorm.png" alt="diana1" /> + 1 punto</div>


              <br>
              <div><img src="./img/diananeg.png" alt="diana2" /> - 1 punto </div>

            </div>
           

            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                TIEMPO RESTANTE : <span id="timer"></span>
              </li>
              <li class="list-group-item">
                ACIERTOS <span id="aciertos"></span>
              </li>
              <!-- <li class="list-group-item">
                  FALLOS <span id="fallos"></span>
                </li> -->
              <audio id="musica" src="./audio/musicabrazuka.mp3"></audio>
              <audio id="succsound" src="./audio/mario-coin.mp3"></audio>
              <audio id="failsound" src="./audio/mario-brosfail.wav"></audio>
              <audio id="2psound" src="./audio/mario-bros vida.mp3"></audio>
              <li class="list-group-item">
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