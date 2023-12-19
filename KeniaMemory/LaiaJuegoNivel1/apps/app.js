let tarjeta = null;
let tarjeta1 = null;
let tarjeta2 = null;
let primerResultado = null;
let segundoResultado = null;
let moves = 0;
let aciertos = 0;
let temp = false;
let timer = 0;
let timerRegre = null;
let timeIni = timer;

let showMove = document.getElementById('move');
let showAciertos = document.getElementById('aciertos');
let showTime = document.getElementById('time');

let showMoveEnd = document.getElementById('moveEnd');
let showAciertosEnd = document.getElementById('aciertosEnd');
let showTimeEnd = document.getElementById('timeEnd');
let showPointEnd = document.getElementById('puntosEnd');
let PointEnd = document.getElementById('puntuacion');

let end = document.getElementById('byeEnd');

let myModal = new bootstrap.Modal(document.getElementById('instrucciones'));

let tarjetaDestapada = 0;
let puntos;
let totalTime;

let startTarjeta = 0;

let numeros = [];
let maxAciertos;

let controlTiempo = true;

//Medidor de puntos, movimientos, Aciertos

const seconsTrans = 1000;
const tiempoVolteo = 800;

let minTime;
let minMoves;

let madTime;
let madMoves;

let medTime;
let medMoves;

let maxTime;
let maxMoves;

showTime.innerHTML = `Tiempo: ${timer} segundos`;
showAciertos.innerHTML = `Aciertos: ${aciertos}`;
showMove.innerHTML = `Movimientos: ${moves}`;

let tamanoArray  = null;

//Sonidos

let coincidencia = new Audio ('./../sounds/coincidencia.wav');
let error = new Audio ('./../sounds/error.wav');
let victory = new Audio ('./../sounds/finGame.mp3');
let loser = new Audio ('./../sounds/gameOver.mp3');
let change = new Audio ('./../sounds/voltear.wav');
let music = new Audio ('./../sounds/keniaMusic.mp3');
music.volume = 0.3;




function primerNivel() {
    music.play();
    document.getElementById("loserGame").style.display = "none";
    document.getElementById("facil").style.display = "none";
    document.getElementById("seleccion").style.display = "flex";
}
function segundoNivel() {
 
    window.location.href='./../LaiaJuegoNivel2/index.php';

}

function loadingGame() {
    document.getElementById("botonInfo").style.display = "block";

    let rowsSelect = document.getElementById("rows");
    let colsSelect = document.getElementById("cols");

    let rows = parseInt(rowsSelect.value);
    let cols = parseInt(colsSelect.value);

     tamanoArray  = cols * rows;
     maxAciertos = tamanoArray/2;

     console.log(rows);
     console.log(cols);

     if ( !isNaN(rows) && !isNaN(cols)) {
        let miBoton = document.getElementById("play");
        miBoton.disabled = false;
    } else {
        miBoton.disabled = true;
    }

  iniciarArray();

        // Obtén la referencia a la tabla
    let table = document.getElementById("memoryTable")
    // Bucle para crear las filas y columnas
    for (let i = 0; i < rows; i++) {
        // Crea una fila
        let row = table.insertRow(i);

        for (let j = 0; j < cols; j++) {
            // Crea una celda en la fila
            let cell = row.insertCell(j);

            // Crea un botón en la celda
            let button = document.createElement("button");
            button.id = i * cols + j; // Asigna un ID único al botón
            button.onclick = function() {
                voltear(this.id); // Asigna la función de voltear al evento click
            };

            // Añade el botón a la celda
            cell.appendChild(button);
        }
    }
    document.getElementById("seleccion").style.display = "none";
    document.getElementById("game").style.display = "block";
    iniciarControlPuntaje();
}

function iniciarControlPuntaje() {

    if (tamanoArray >= 8 && tamanoArray <=15) {


minTime = 45;
minMoves = maxAciertos*2;

 madTime = minTime+5;
 madMoves = minMoves+5;

 medTime = madTime+5;
 medMoves = madMoves+5;

 maxTime = madTime+5;
 maxMoves = madMoves+5;

 timer = 60;
 timeIni = timer;

        
    } else   if (tamanoArray >= 16 && tamanoArray <=23){

        minTime = 80;
        minMoves = maxAciertos*2;
        madTime = minTime+10;
        madMoves = minMoves+10;
  
        medTime = madTime+10;
        medMoves = madMoves+10;
  
        maxTime = madTime+10;
        maxMoves = madMoves+10;
  
        timer = 120;
        timeIni = timer;
  
  
  
      } else {
          minTime = 130;
          minMoves = maxAciertos*2;
          madTime = minTime+15;
          madMoves = minMoves+15;
    
          medTime = madTime+15;
          medMoves = madMoves+15;
    
          maxTime = madTime+15;
          maxMoves = madMoves+15;
  
          timer = 180;
          timeIni = timer;
  
  
      }
}

function iniciarArray() {
    for (let h = 0; h < tamanoArray ; h+=2) {
        numeros[h] = startTarjeta;    
        numeros[h+1] = startTarjeta;   
        startTarjeta++;
    
    }

    numeros = numeros.sort(() => { return Math.random() - 0.5 });

}

function contarTiempo() {

    timerRegre = setInterval(() => {

        timer--;
        showTime.innerHTML = `Tiempo: ${timer} segundos`;

        if (timer == 0) {
            clearInterval(timerRegre);

            blockCard();

            loserGame();


        }

    }, seconsTrans)


}
function blockCard() {
    for (let i = 0; i < tamanoArray; i++) {
        let block = document.getElementById(i);
        if (block) {  // Verifica si el elemento existe antes de manipularlo
            block.innerHTML = `<img  src="./../img/${numeros[i]}.png" draggable="false" user-select: none;  alt=""></img>`;
            block.disabled = true;
        }
    }
}

function voltear(id) {

    if (temp == false) {


        contarTiempo();
        temp = true;
        controlTiempo = false;

    }


    tarjetaDestapada++;

    if (tarjetaDestapada == 1) {

        primerResultado = numeros[id];

        tarjeta1 = mostrarImagen(id,primerResultado);

        change.play();

      
    } else if (tarjetaDestapada == 2) {
        segundoResultado = numeros[id];


       tarjeta2 = mostrarImagen(id,segundoResultado);


        moves++;

        showMove.innerHTML = `Movimientos: ${moves}`;

        if (primerResultado == segundoResultado) {
            coincidencia.play();

            tarjetaDestapada = 0;


            aciertos++;
            showAciertos.innerHTML = `Aciertos: ${aciertos}`;


            if (aciertos == maxAciertos) {
            finGame();
            } 
            

        } else {

            setTimeout(() => {

                tarjeta1.innerHTML = ` `;
                tarjeta2.innerHTML = ` `;

                tarjeta1.disabled = false;
                tarjeta2.disabled = false;
                tarjetaDestapada = 0;

                error.play();


            }, tiempoVolteo);
        }

    }

}

function mostrarImagen(id,resultado) {

    tarjeta = document.getElementById(id);
       
    tarjeta.innerHTML = `<img src="./../img/${resultado}.png" draggable="false" user-select: none;   alt=""></img>`;

    tarjeta.disabled = true;

    return tarjeta;
}

function finGame() {
    document.getElementById("game").style.display = "none";
    document.getElementById("botonInfo").style.display = "none";
    document.getElementById("endGame").style.display = "flex";
    clearInterval(timerRegre);
    music.pause();
   victory.play();

    if (totalTime < minTime || moves < minMoves) { 

        puntos=80;

     } else if (totalTime < madTime || moves < madMoves) {
        
        puntos=60; 

    } else if  (totalTime < medTime || moves < medMoves) { 
        
        puntos=40; 

    } else if (totalTime < maxTime || moves < maxMoves) { 

        puntos=20; 

    } else {

        puntos = 0;
    }

    showAciertosEnd.innerHTML = `Felicidades llegaste a los ${aciertos} aciertos`;
    showTimeEnd.innerHTML = `Acabaste en ${timeIni - timer} segundos`;
    showMoveEnd.innerHTML = `Movimientos ${moves}`;
    showPointEnd.innerHTML = `El total de puntos ganados son ${puntos} `;

    let  puntuacionInput = document.getElementsByName("puntuacion")[0];
    puntuacionInput.value = puntos;

    setCookie('KenyaGameCompleted', 'true', 7);


}

function loserGame() {
    
    document.getElementById("game").style.display = "none";
    document.getElementById("botonInfo").style.display = "none";

    document.getElementById("loserGame").style.display = "block";

    end.innerHTML = `Lo sentimos, no se ha completado todas las parejas, ¿Deseas volver a Intentarlo?`;
    music.pause();
    loser.play();

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

  function abrirModal() {
    clearInterval(timerRegre);
    myModal.toggle();
  }

document.addEventListener('DOMContentLoaded', function () {

    myModal._element.addEventListener('hidden.bs.modal', function () {
    if (!controlTiempo) {
        
            contarTiempo();
        }
        });
    
   
});

function updateProgressBar(puntos) {

    if (puntos <= 100) {
      let progressBar = document.getElementById('currentProgress');
          progressBar.style.width = puntos + '%';
    }
  }

  function updateScore() {
  
    let scoreHTML = document.getElementById("scoreHTML")
    scoreHTML.innerHTML = puntos
    updateProgressBar(puntos)
  }

