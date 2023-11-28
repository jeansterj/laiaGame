let tarjeta = null;
let tarjeta1 = null;
let tarjeta2 = null;
let primerResultado = null;
let segundoResultado = null;
let moves = 0;
let aciertos = 0;
let temp = false;
let timer = 40;
let timerRegre = null;
let timeIni = timer;

let showMove = document.getElementById('move');
let showAciertos = document.getElementById('aciertos');
let showTime = document.getElementById('time');

let tarjetaDestapada = 0;
let puntos;
let totalTime;

//Medidor de puntos, movimientos, Aciertos

const seconsTrans = 1000;
const tiempoVolteo = 800;

const maxAciertos = 8;

const minTime = 20;
const minMoves = 12;

const madTime = 25;
const madMoves = 16;

const medTime = 30;
const medMoves = 20;

const maxTime = 35;
const maxMoves = 24;

showTime.innerHTML = `Tiempo: ${timer} segundos`;
showAciertos.innerHTML = `Aciertos: ${aciertos}`;
showMove.innerHTML = `Movimientos: ${moves}`;

let rows = 4;
let cols = 4;

// Obtén la referencia a la tabla
let table = document.getElementById("memoryTable");

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

let numeros = [1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8];


numeros = numeros.sort(() => { return Math.random() - 0.5 });

console.log(numeros);


function contarTiempo() {

    timerRegre = setInterval(() => {

        timer--;
        showTime.innerHTML = `Tiempo: ${timer} segundos`;

        if (timer == 0) {
            clearInterval(timerRegre);

            blockCard();

        }

    }, seconsTrans)


}

function blockCard() {


    for (let i = 0; i <= 15; i++) {
        let block = document.getElementById(i)
        block.innerHTML =`<img src="./../img/${numeros[i]}.png" alt=""></img>` ;
        block.disabled = true;


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
                clearInterval(timerRegre);

                showAciertos.innerHTML = `Aciertos: ${aciertos} bien`;
                showTime.innerHTML = `Acabaste en : ${timeIni - timer} segundos`;
                showMove.innerHTML = `Movimientos: ${moves} bien`;

                if (totalTime < minTime || moves < minMoves) { 

                    puntos=80;

                 } else if (totalTime < madTime || moves < madMoves) {
                    
                    puntos=60; 

                } else if  (totalTime < medTime || moves < medMoves) { 
                    
                    puntos=40; 

                } else if (totalTime < maxTime || moves < madMoves) { 

                    puntos=20; 

                } else {

                    puntos = 0;
                }
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