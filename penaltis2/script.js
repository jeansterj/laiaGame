const rows = 3;
const cols = 4;

let board;
let correctClicks = 0;
let incorrectClicks = 0;
let aciertos = document.getElementById("aciertos");
let fallos = document.getElementById("fallos");
let timerElement = document.getElementById("timer");
let durationInSeconds = 60;
let imageIsShowing = false;
let gameIsOver = false;
let timerInterval;
let timerEnded = false;
let audiosucc = document.getElementById("succsound");

let audiofail = document.getElementById("failsound");
let audio2p = document.getElementById("2psound");
let dificultad = 1000;
let dificultad1 = Math.floor(Math.random() * 1000) + 800;
let dificultad2 = Math.floor(Math.random() * 600) + 400;
let dificultad3 = Math.floor(Math.random() * 200) + 100;
let botondificultad1 = document.getElementById("botondifi");
let puntdorado =15;
let puntnormal =1;
let puntneg =1;


function createGameBoard(rows, cols) {
  board = new Array(rows);
  for (let i = 0; i < rows; i++) {
    board[i] = new Array(cols).fill(0);
  }
  return board;
}

function updateGameBoardUI(board) {
 



  const gameBoardElement = document.querySelector(".game-board");
  gameBoardElement.innerHTML = '';

  const cellWidth = 611 / cols;
  const cellHeight = 221 / rows;

  for (let i = 0; i < rows; i++) {
    for (let j = 0; j < cols; j++) {
      const cell = document.createElement("div");
      cell.classList.add("cell");
      cell.style.width = cellWidth + "px";
      cell.style.height = cellHeight + "px";
      cell.dataset.row = i;
      cell.dataset.col = j;
      gameBoardElement.appendChild(cell);

      if (!gameIsOver) {
        cell.addEventListener("click", () => {
          const imageElement = cell.querySelector("img");
          if (imageElement !== null) {
            if (imageElement.src.includes("diananorm.png")) {
              audiosucc.play();

              // Clic correcto (imagen de diana)
              correctClicks= correctClicks+puntnormal;
              aciertos.textContent = correctClicks;
              console.log(`Clics correctos: ${correctClicks}`);
              updateProgressBar(correctClicks);


            } else if (imageElement.src.includes("diananeg.png")) {
              audiofail.play();

              correctClicks=correctClicks-puntneg;
              aciertos.textContent = correctClicks;
              console.log(`Clics incorrectos: ${incorrectClicks}`);
              updateProgressBar(correctClicks);
            }
            else if (imageElement.src.includes("dianadoble.png")) {
              audio2p.play();
              correctClicks=correctClicks+puntdorado;
              // correctClicks++;
              // correctClicks++;
              aciertos.textContent = correctClicks;
              updateProgressBar(correctClicks);


              console.log(`Clics incorrectos: ${correctClicks}`);
            }
            cell.innerHTML = '';
            board[i][j] = 0;
            imageIsShowing = false;
          }
        });
      }
    }
  }
}


function loadRandomImage() {
  if (imageIsShowing || timerEnded) {
    return;
  }
  // showEndScren();
  const emptyCells = [];
  for (let i = 0; i < rows; i++) {
    for (let j = 0; j < cols; j++) {
      if (board[i][j] === 0) {
        emptyCells.push({ row: i, col: j });
      }
    }
  }

  if (emptyCells.length === 0) {
    return;
  }

  const randomIndex = Math.floor(Math.random() * emptyCells.length);
  const randomCell = emptyCells[randomIndex];

  const cell = document.querySelector(`.cell[data-row="${randomCell.row}"][data-col="${randomCell.col}"]`);


  const images = ["./img/diananorm.png", "./img/diananeg.png", "./img/dianadoble.png"];
  const randomImageIndex = Math.floor(Math.random() * images.length);
  const image = document.createElement("img");
  image.src = images[randomImageIndex];

  image.style.maxWidth = "100%";
  image.style.maxHeight = "100%";
  image.style.display = "block";
  image.draggable = false;
  image.style.userSelect = "none"; 
  cell.innerHTML = '';
  cell.appendChild(image);
  board[randomCell.row][randomCell.col] = 1;
  imageIsShowing = true;

  setTimeout(() => {
    cell.innerHTML = '';
    board[randomCell.row][randomCell.col] = 0;
    imageIsShowing = false;
    loadRandomImage();

  }, dificultad);
}

function stopGame() {
 
  gameIsOver = true;

  const cells = document.querySelectorAll(".cell");
  cells.forEach((cell) => {
    cell.removeEventListener("click", () => { });
  });
  
 
}

document.addEventListener("DOMContentLoaded", function () {
  createGameBoard(rows, cols);
  updateGameBoardUI(board);
  loadRandomImage();


});

function updateTimer() {
  var minutes = Math.floor(durationInSeconds / 60);
  var seconds = durationInSeconds % 60;
  var formattedTime =
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
  timerElement.textContent = formattedTime;
  if (durationInSeconds === 0) {
    showEndScren();

  }
  
}





function startGame() {
  // Mostrar el contenido al hacer clic en el botón "Start"
  document.getElementById("start-screen").style.display = "none";
  document.getElementById("content").style.display = "block";
  timerInterval = setInterval(function () {
    if (durationInSeconds > 0) {
      durationInSeconds--;
      updateTimer();
    } else {
      clearInterval(timerInterval);
      // timerElement.textContent = "TIME OUT";
      timerEnded = true;
      stopGame();
      stopmusic();
      let imagencontrol = document.getElementById("imagensonido");

      imagencontrol.src = "./img/volumenplay.png";
    }
  }, 1000);


  



}



function reproducirAudio() {
  let musica = document.getElementById("musica");
  musica.play();
  musica.volume = 0.3;
}



function rePlay(idButton) {
  let imagencontrol = document.getElementById("imagensonido");
  const gameBoardElement = document.querySelector(".game-board");

  switch (idButton) {
    case "replayingame":
      
      console.log("reinciando...");
      updateProgressBar(0);
    
      clearInterval(timerInterval);
      incorrectClicks = 0;
      correctClicks = 0;
      gameIsOver = false;
      timerEnded = false;
    
    
      durationInSeconds = 60;
      updateTimer();
      
    
    
      aciertos.textContent = 0;
      
    
    
     
      gameBoardElement.innerHTML = '';
    
    
      createGameBoard(rows, cols);
      updateGameBoardUI(board);
      stopGame();
      
      startGame();
      loadRandomImage();
    
      stopmusic();
      musica.play();
      imagencontrol.src = "./img/volumemute.png";
     
      
      
      break;

      case "botonreplay":


      console.log("reinciando...");
    
      clearInterval(timerInterval);
      incorrectClicks = 0;
      correctClicks = 0;
      gameIsOver = false;
      timerEnded = false;
    
    
      durationInSeconds = 60;
      updateTimer();
    updateProgressBar(0);
    
      aciertos.textContent = 0;
      
    
    
      // const gameBoardElement = document.querySelector(".game-board");
      gameBoardElement.innerHTML = '';
    
    
      createGameBoard(rows, cols);
      updateGameBoardUI(board);
      stopGame();
      
      startGame();
      loadRandomImage();
    
      stopmusic();
      musica.play();
      imagencontrol.src = "./img/volumemute.png";

      document.getElementById("end-screen").style.display = "none";
      document.getElementById("content").style.display = "block";

      break;
  
    default:
      break;
  }


 

  






}






function stopmusic() {
  let musica = document.getElementById("musica");

  musica.pause();
  musica.currentTime = 0;


}
function controlarAudio() {


  let musica = document.getElementById("musica");
  let imagencontrol = document.getElementById("imagensonido");
  console.log("Ruta de la imagen:", imagencontrol.src);



  if (imagencontrol.src ===  "http://localhost:8080/penaltis2/img/volumemute.png") {
    musica.pause();
    console.log("musicapausada");
    imagencontrol.src = "http://localhost:8080/penaltis2/img/volumenplay.png";

  } else {
    musica.play();
    console.log("musicaactiva");
    imagencontrol.src = "http://localhost:8080/penaltis2/img/volumemute.png";




  }
}














function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}


function showEndScren(){
  if(correctClicks>=100||timerElement.textContent==="00:00"){
    correctClicks =100;
    console.log("Dentro de replayEvent");
    let punt =document.getElementById("puntuacion");
    let infofinal = document.getElementById("textoFinal");
    let puntuacion = correctClicks;
    let infovictoria = "Enhorabuena, has conseguido suficiente energia para iluminar Brasil";
    let infofail ="No has conseguido suficiente energia , vuelve a intentarlo "
    let siguientejuego = document.getElementById("siguientejuego");
    let textovolver = document.getElementById("textovolver");

    setCookie('brasilGameCompleted', 'true', 7);    

    let botonfail = document.getElementById("botonfail");
    

     punt.textContent = puntuacion;
     


    document.getElementById("end-screen").style.display = "block";
    document.getElementById("content").style.display = "none";
   
    
     let  puntuacionInput = document.getElementsByName("puntuacion")[0];
 
     
     
     puntuacionInput.value = puntuacion;
     document.querySelector('input[name="puntuacion"]').value = puntuacion;
     
    if(puntuacion>=100){
     
      infofinal.textContent=infovictoria;
      botonfail.style.display="none";
      siguientejuego.style.display="block";
      
      textovolver.textContent="";

    }else{
      infofinal.textContent= infofail;
      siguientejuego.style.display="none";
      textovolver.textContent="Volver a intentarlo";
      


    }
    }

   



}



function DIF1(){
  dificultad = dificultad1;
  console.log("dificultad 1");
  botondifi.textContent="DIFICULTAD 1";
  
} 

function DIF2(){
  dificultad = dificultad2;
  console.log("dificultad 2")
  botondifi.textContent="DIFICULTAD 2";
  
}

function DIF3(){
  dificultad = dificultad3;
  console.log("dificultad 3");
  botondifi.textContent="DIFICULTAD 3";
  
}

function updateProgressBar(correctClicks) {

  if (correctClicks <= 100) {
    var progressBar = document.getElementById('currentProgress');
        progressBar.style.width = correctClicks + '%';
  }
  if (correctClicks >= 100) {
   showEndScren();
  }
}