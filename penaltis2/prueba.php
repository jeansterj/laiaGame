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



    <div class="container" id="explicacionpr">



      <div>ELIGE LA DIFICULTAD</div>
      <br>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
          id="botondifi">
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
      <div><img src="./img/dianadoble.png" alt=""> +5 P</div>
      <br>
      <div><img src="./img/diananeg.png" alt=""> -1 P</div>
      <br>






      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"id="buttoninfo">
  <img src="./img/info.png" alt="" id="informacioningame">
</button>


      <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content text-dark">

            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">TUTORIAL BRASILIA, PRESTA ATENCION AL TUTORIAL</h1>

            </div>
            <div class="modal-body">
              <img id="tutogif" src="./img/tutorial.gif" alt="">

            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="botonendendido" onclick="habilitarboton();"
                disabled>Entendido</button>

            </div>
          </div>
        </div>
      </div>








      <button class="start2 custom-btn2" onclick="startGame() ,reproducirAudio();"disabled id="botonstart">
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





          <button class="btn  custom-btnrejugar border-light text-light" type="submit" name="brasildata"
            id="siguientejuego">SIGUIENTE JUEGO

          </button>
          <br>
          <div id="lorefinal">Te has ganado esta pieza!

            <div><img src="./img/windturbine.png" alt="" class="border-light"></div>
          </div>



        </form>



      </div>
    </div>

  </div>





  <div id="content" style="display: none" class="">
    <div class="container text-center">

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
              <div class="font-weight-bold"><img src="./img/dianadoble.png" alt="diana2" /> + 5 P </div>
              <br>
              <div><img src="./img/diananorm.png" alt="diana1" /> + 1 P</div>


              <br>
              <div class=""><img src="./img/diananeg.png" alt="diana2" /> - 1 P </div>

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
      <button type="button" class="btn " id="botoninfo2" data-bs-toggle="modal" data-bs-target="#modal2">
  <img src="./img/info.png" alt="">
</button>
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
    
    

<!-- Modal -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">TUTORIAL BRASILIA, PRESTA ATENCION AL TUTORIAL</h1>

            </div>
            <div class="modal-body">
              <img id="tutogif" src="./img/tutorial.gif" alt="">

            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
       
      </div>
    </div>
  </div>
</div>
  </div>

  <script src="./script.js"></script>
</body>

</html>