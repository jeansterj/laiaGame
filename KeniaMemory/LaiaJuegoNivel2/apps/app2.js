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

let numeros = [];
let cartasNoEncontradas = [];

let puntos;
let totalTime;

showTime.innerHTML = `Tiempo: ${timer} segundos`;

document.querySelectorAll('button').forEach(button => {
    let dataId = button.getAttribute('data-id');
    numeros.push(dataId);
});

numeros = numeros.sort(() => { return Math.random() - 0.5 });


function contarTiempo() {

    timerRegre = setInterval(() => {

        timer--;
        showTime.innerHTML = `Tiempo: ${timer} segundos`;

        if (timer == 0) {
            clearInterval(timerRegre);

            blockCard();

        }

    }, 1000)


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
         

            if (primerResultado == 9 || segundoResultado == 9) {
                
                cambiarCartasDeLugar();
                }

                

            if (aciertos == 10) {
                clearInterval(timerRegre);

                totalTime = timeIni - timer;

                showAciertos.innerHTML = `Aciertos: ${aciertos} bien`;
                showTime.innerHTML = `Acabaste en : ${totalTime} segundos`;
                showMove.innerHTML = `Movimientos: ${moves} bien`;

                if (totalTime < 35 || moves < 20) { 
                    puntos=100;

                 } else if (totalTime < 40 || moves < 25) {
                    
                    puntos=80; 
                } else if  (totalTime < 45 || moves < 30) { 
                    
                    puntos=60; 
                } else if (totalTime < 50 || moves < 35) { 
                    puntos=40; 
                } else if (totalTime < 55 || moves < 40) { 
                    puntos=20; 
                } else {

                    puntos = 0;
                }
            }

            console.log(puntos);

        } else {

        setTimeout(() => {

        tarjeta1.innerHTML = ` `;
        tarjeta2.innerHTML = ` `;

        tarjeta1.disabled = false;
        tarjeta2.disabled = false;
        tarjetaDestapada = 0;

        tarjeta1.setAttribute('data-found', 'false');
        tarjeta2.setAttribute('data-found', 'false');

        }, 800);

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
    

    


    
 





