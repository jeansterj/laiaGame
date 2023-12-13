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
let timeIni; 

let showMove = document.getElementById('move');
let showAciertos = document.getElementById('aciertos');
let showTime = document.getElementById('time');

let showMoveEnd = document.getElementById('moveEnd');
let showAciertosEnd = document.getElementById('aciertosEnd');
let showTimeEnd = document.getElementById('timeEnd');
let showPointEnd = document.getElementById('puntosEnd');
let PointEnd = document.getElementById('puntuacion');

let end = document.getElementById('byeEnd');

let tarjetaDestapada = 0;
let puntos;
let totalTime;

let startTarjeta = 0;

let numeros = [];
let maxAciertos;


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


function primerNivel() {
    document.getElementById("loserGame").style.display = "none";
    document.getElementById("facil").style.display = "none";
    document.getElementById("seleccion").style.display = "flex";
}

function loadingGame() {

    let rowsSelect = document.getElementById("rows");
    let colsSelect = document.getElementById("cols");

    let rows = parseInt(rowsSelect.value);
    let cols = parseInt(colsSelect.value);

     tamanoArray  = cols * rows;
     maxAciertos = tamanoArray/2;

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


minTime = 20;
minMoves = maxAciertos+5;

 madTime = minTime+5;
 madMoves = minMoves+5;

 medTime = madTime+5;
 medMoves = madMoves+5;

 maxTime = madTime+5;
 maxMoves = madMoves+5;

 timer = 30;
 timeIni = timer;

        
    } else if (tamanoArray >= 16 && tamanoArray <=23){

      minTime = 30;
      minMoves = maxAciertos+10;
      madTime = minTime+5;
      madMoves = minMoves+5;

      medTime = madTime+5;
      medMoves = madMoves+5;

      maxTime = madTime+5;
      maxMoves = madMoves+5;

      timer = 45;
      timeIni = timer;


    } else {
        minTime = 45;
        minMoves = maxAciertos+15;
        madTime = minTime+5;
        madMoves = minMoves+5;
  
        medTime = madTime+5;
        medMoves = madMoves+5;
  
        maxTime = madTime+5;
        maxMoves = madMoves+5;

        timer = 60;
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
            console.log("entrooooo");

            loserGame();
            console.log("entrooooo");


        }

    }, seconsTrans)


}
function blockCard() {
    for (let i = 0; i < tamanoArray; i++) {
        let block = document.getElementById(i);
        if (block) {  // Verifica si el elemento existe antes de manipularlo
            block.innerHTML = `<img src="./../img/${numeros[i]}.png" alt=""></img>`;
            block.disabled = true;
        }
    }
}

function voltear(id) {

    if (temp == false) {

        contarTiempo();
        temp = true;
    }


    tarjetaDestapada++;

    if (tarjetaDestapada == 1) {

        primerResultado = numeros[id];

        tarjeta1 = mostrarImagen(id,primerResultado);

      
    } else if (tarjetaDestapada == 2) {
        segundoResultado = numeros[id];


       tarjeta2 = mostrarImagen(id,segundoResultado);


        moves++;

        showMove.innerHTML = `Movimientos: ${moves}`;

        if (primerResultado == segundoResultado) {

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


            }, tiempoVolteo);
        }

    }

}

function mostrarImagen(id,resultado) {

    tarjeta = document.getElementById(id);
       
    tarjeta.innerHTML = `<img src="./../img/${resultado}.png" alt=""></img>`;

    tarjeta.disabled = true;

    return tarjeta;
}

function finGame() {
    document.getElementById("game").style.display = "none";
    document.getElementById("endGame").style.display = "flex";
    clearInterval(timerRegre);

   

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
    document.getElementById("loserGame").style.display = "block";

    end.innerHTML = `Lo sentimos, se a completado todas las parejas, ¿Deseas volver a Intentarlo?`;


}

// function resetGame() {
// tarjeta= null;
// tarjeta1= null;
// tarjeta2= null;
// primerResultado= null;
// segundoResultado= null;
// moves = 0;
// aciertos = 0;
// temp= false;
// timer = 0;
// timerRegre= null;
// timeIni= null;
// tarjetaDestapada = 0;
// puntos = 0;
// totalTime = 0;
// startTarjeta =0;
// maxAciertos = 0;
// tamanoArray = 0;
// minTime= 0;
// minMoves= 0;
// madTime= 0;
// madMoves= 0;
// medTime= 0;
// medMoves= 0;
// maxTime= 0;
// maxMoves= 0;
// table = null;
// rowSelect = null;
// colsSelect= null;
// rows= null;
// cols= null;
// i = 0;
// cell = null;
// button =null;
// numeros = [];

// primerNivel();
// }

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }
