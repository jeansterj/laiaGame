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
              correctClicks++;
              aciertos.textContent = correctClicks;
              console.log(`Clics correctos: ${correctClicks}`);
              genControl(correctClicks);


            } else if (imageElement.src.includes("diananeg.png")) {
              audiofail.play();

              correctClicks--;
              aciertos.textContent = correctClicks;
              console.log(`Clics incorrectos: ${incorrectClicks}`);
              genControl(correctClicks);
            }
            else if (imageElement.src.includes("dianadoble.png")) {
              audio2p.play();
              correctClicks=correctClicks+10;
              // correctClicks++;
              // correctClicks++;
              aciertos.textContent = correctClicks;


              console.log(`Clics incorrectos: ${correctClicks}`);
              genControl(correctClicks);
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

  }, Math.floor(Math.random() * 1000) + 400);
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
      clearGen();
    
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
      clearGen();
    
      clearInterval(timerInterval);
      incorrectClicks = 0;
      correctClicks = 0;
      gameIsOver = false;
      timerEnded = false;
    
    
      durationInSeconds = 60;
      updateTimer();
    
    
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






function genControl(correctClicks) {
  let celda1 = document.getElementById("celda1");
  let celda2 = document.getElementById("celda2");
  let celda3 = document.getElementById("celda3");
  let celda4 = document.getElementById("celda4");
  let celda5 = document.getElementById("celda5");
  let celda6 = document.getElementById("celda6");
  let celda7 = document.getElementById("celda7");
  let celda8 = document.getElementById("celda8");
  let celda9 = document.getElementById("celda9");
  let celda10 = document.getElementById("celda10");

  if (correctClicks > 9 && correctClicks < 20) {
    celda1.style.backgroundColor = "#139648";
    
  } else {
    celda1.style.backgroundColor = ""; // Reset to default color
  }

  if (correctClicks > 19 && correctClicks < 30) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
  } else {
    celda2.style.backgroundColor = "";
  }

  if (correctClicks > 29 && correctClicks < 40) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
  } else {
    celda3.style.backgroundColor = "";
  }

  if (correctClicks > 39 && correctClicks < 50) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
    celda4.style.backgroundColor = "#139648";
  } else {
    celda4.style.backgroundColor = "";
  }

  if (correctClicks > 49 && correctClicks < 60) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
    celda4.style.backgroundColor = "#139648";
    celda5.style.backgroundColor = "#139648";
  } else {
    celda5.style.backgroundColor = "";
  }

  if (correctClicks > 59 && correctClicks < 70) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
    celda4.style.backgroundColor = "#139648";
    celda5.style.backgroundColor = "#139648";
    celda6.style.backgroundColor = "#139648";
  } else {
    celda6.style.backgroundColor = "";
  }

  if (correctClicks > 69 && correctClicks < 80) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
    celda4.style.backgroundColor = "#139648";
    celda5.style.backgroundColor = "#139648";
    celda6.style.backgroundColor = "#139648";
    celda7.style.backgroundColor = "#139648";
  } else {
    celda7.style.backgroundColor = "";
  }

  if (correctClicks > 79 && correctClicks < 90) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
    celda4.style.backgroundColor = "#139648";
    celda5.style.backgroundColor = "#139648";
    celda6.style.backgroundColor = "#139648";
    celda7.style.backgroundColor = "#139648";
    celda8.style.backgroundColor = "#139648";
  } else {
    celda8.style.backgroundColor = "";
  }

  if (correctClicks > 89 && correctClicks < 100) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
    celda4.style.backgroundColor = "#139648";
    celda5.style.backgroundColor = "#139648";
    celda6.style.backgroundColor = "#139648";
    celda7.style.backgroundColor = "#139648";
    celda8.style.backgroundColor = "#139648";
    celda9.style.backgroundColor = "#139648";
  } else {
    celda9.style.backgroundColor = "";
  }

  if (correctClicks >= 100) {
    celda1.style.backgroundColor = "#139648";
    celda2.style.backgroundColor = "#139648";
    celda3.style.backgroundColor = "#139648";
    celda4.style.backgroundColor = "#139648";
    celda5.style.backgroundColor = "#139648";
    celda6.style.backgroundColor = "#139648";
    celda7.style.backgroundColor = "#139648";
    celda8.style.backgroundColor = "#139648";
    celda9.style.backgroundColor = "#139648";
    celda10.style.backgroundColor = "#139648";
  } else {
    celda10.style.backgroundColor = "";
  }

showEndScren();





}





function clearGen(){
  let celda1 = document.getElementById("celda1");
  let celda2 = document.getElementById("celda2");
  let celda3 = document.getElementById("celda3");
  let celda4 = document.getElementById("celda4");
  let celda5 = document.getElementById("celda5");
  let celda6 = document.getElementById("celda6");
  let celda7 = document.getElementById("celda7");
  let celda8 = document.getElementById("celda8");
  let celda9 = document.getElementById("celda9");
  let celda10 = document.getElementById("celda10");



  celda1.style.backgroundColor = "";
  celda2.style.backgroundColor = "";
  celda3.style.backgroundColor = "";
  celda4.style.backgroundColor = "";
  celda5.style.backgroundColor = "";
  celda6.style.backgroundColor = "";
  celda7.style.backgroundColor = "";
  celda8.style.backgroundColor = "";
  celda9.style.backgroundColor = "";
  celda10.style.backgroundColor = "";


}


function showEndScren(){
  if(correctClicks>=20||timerElement.textContent==="00:00"){
    console.log("Dentro de replayEvent");
    let punt =document.getElementById("puntuacion");
    let infofinal = document.getElementById("textoFinal");
    let puntuacion = correctClicks;
    let infovictoria = "enhorabuena te lo has pasado";
    let infofail ="no has conseguido suficiente energia , vuelve a intentarlo crack"

    punt.textContent = puntuacion;


    document.getElementById("end-screen").style.display = "block";
    document.getElementById("content").style.display = "none";
   
    
     let  puntuacionInput = document.getElementsByName("puntuacion")[0];
 
     
     
     puntuacionInput.value = puntuacion;
     document.querySelector('input[name="puntuacion"]').value = puntuacion;

    if(puntuacion>=20){
      infofinal.textContent=infovictoria;

    }else{
      infofinal.textContent= infofail;

    }
    }




}









