let tarjeta = null;
let tarjeta1 = null;
let tarjeta2 = null;
let primerResultado = null;
let segundoResultado = null;
let moves = 0;
let aciertos = 0;
let temp = false;
let timer = 60;
let timerRegre = null;
let timeIni = timer;

let showMove = document.getElementById('move');
let showAciertos = document.getElementById('aciertos');
let showTime = document.getElementById('time');

let tarjetaDestapada = 0;

let cartasNoEncontradas = [];

let puntos;
let totalTime;

//Medidor de puntos, movimientos, Aciertos

const seconsTrans = 1000;
const tiempoVolteo = 800;
const cartaEspecial = 9;

const maxAciertos = 10;

const minTime = 35;
const minMoves = 20;

const madTime = 40;
const madMoves = 25;

const medTime = 45;
const medMoves = 30;

const midTime = 50;
const midMoves = 35;

const maxTime = 55;
const maxMoves = 40;

showTime.innerHTML = `Tiempo: ${timer} segundos`;
showAciertos.innerHTML = `Aciertos: ${aciertos} bien`;
showMove.innerHTML = `Movimientos: ${moves} bien`;

    // Número de filas y columnas en tu juego de memoria
    let rows = 4;
    let cols = 5;

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
            let id = i * cols + j;
            button.id = id; // Asigna un ID único al botón
            button.dataset.found = "false"; // Añade el atributo data-found
            button.onclick = function() {
                voltear(this.id); // Asigna la función de voltear al evento click
            };

            // Añade el botón a la celda
            cell.appendChild(button);
        }
    }

let numeros = [ 0, 0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9];

numeros = numeros.sort(() => { return Math.random() - 0.5 });


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

    for (let i = 0; i <= 19; i++) {
        let block = document.getElementById(i)
        block.innerHTML =`<img src="./../img/${numeros[i]}.png" alt=""></img>` ;
        block.disabled = true;


    }

}

let mezclaRealizada;


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
         

            if (primerResultado == cartaEspecial || segundoResultado == cartaEspecial) {
                
                cambiarCartasDeLugar();
                }

                

            if (aciertos == maxAciertos) {
                clearInterval(timerRegre);

                totalTime = timeIni - timer;

                showAciertos.innerHTML = `Aciertos: ${aciertos} bien`;
                showTime.innerHTML = `Acabaste en : ${totalTime} segundos`;
                showMove.innerHTML = `Movimientos: ${moves} bien`;

                if (totalTime < minTime || moves < minMoves) { 
                    puntos=100;

                 } else if (totalTime < madTime || moves < madMoves) {
                    
                    puntos=80; 
                } else if  (totalTime < medTime || moves < medMoves) { 
                    
                    puntos=60; 
                } else if (totalTime < midTime || moves < midMoves) { 
                    puntos=40; 
                } else if (totalTime < maxTime || moves < maxMoves) { 
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

        tarjeta1.setAttribute('data-found', 'false');
        tarjeta2.setAttribute('data-found', 'false');

        }, tiempoVolteo);

        }
    }

    }

function mostrarImagen(id,resultado) {
    tarjeta = document.getElementById(id);
       
    tarjeta.innerHTML = `<img src="./../img/${resultado}.png" alt=""></img>`;

    tarjeta.disabled = true;

    tarjeta.setAttribute('data-found', 'true');

    return tarjeta;
}




    function cambiarCartasDeLugar() {    
        
        for (let i = 0; i <= 19; i++) {
            let carta = document.getElementById(i);
            carta.style.position = 'absolute';
            if (carta.getAttribute('data-found') == 'true') {
                numeros[i] = ""; // Limpiar la posición de la carta encontrada en 'numeros'
            } else {
                cartasNoEncontradas.push(numeros[i]);
            }
        }
        
        setTimeout(() => {
            for (let i = 0; i <= 19; i++) {
                let carta = document.getElementById(i);
                carta.style.position = 'relative'; // Restaurar la posición a relative para todos
            }
        }, 2000); 

        // Mezclar cartas no encontradas
        cartasNoEncontradas = cartasNoEncontradas.sort(() => Math.random() - 0.5);
        
        for (let i = 0; i <= 19; i++) {
            let carta = document.getElementById(i);
            if (carta.getAttribute('data-found') !== 'true' && cartasNoEncontradas.length > 0) {
                numeros[i] = cartasNoEncontradas.pop(); // Poner las cartas mezcladas en posiciones vacías
            }
        }
        

    }
    

    


    
 





