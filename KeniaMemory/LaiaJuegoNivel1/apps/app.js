let tarjeta1 = null;
let tarjeta2 = null;
let primerResultado = null;
let segundoResultado = null;
let moves = 0;
let aciertos = 0;
let temp = false;
let timer = 100;
let timerRegre = null;
let timeIni = timer;

let showMove = document.getElementById('move');
let showAciertos = document.getElementById('aciertos');
let showTime = document.getElementById('time');

let tarjetaDestapada = 0;
let puntos;
let totalTime;

showTime.innerHTML = `Tiempo: ${timer} segundos`;

document.querySelectorAll('button').forEach(button => {
    let dataId = button.getAttribute('data-id');
    numeros.push(dataId);
});

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

    }, 1000)


}

function blockCard() {


    for (let i = 0; i <= 15; i++) {
        let block = document.getElementById(i)
        block.innerHTML =`<img src="./img/${numeros[i]}.png" alt=""></img>` ;
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

        tarjeta1 = document.getElementById(id);
        primerResultado = numeros[id];
        console.log(primerResultado);

        tarjeta1.innerHTML = `<img src="./img/${primerResultado}.png" alt=""></img>` ;

        
        tarjeta1.disabled = true;
    } else if (tarjetaDestapada == 2) {

        tarjeta2 = document.getElementById(id);
        segundoResultado = numeros[id];
        console.log(segundoResultado);

        tarjeta2.innerHTML = `<img src="./img/${segundoResultado}.png" alt=""></img>`;

        tarjeta2.disabled = true;

        moves++;

        showMove.innerHTML = `Movimientos: ${moves}`;

        if (primerResultado == segundoResultado) {

            tarjetaDestapada = 0;


            aciertos++;
            showAciertos.innerHTML = `Aciertos: ${aciertos}`;


            if (aciertos == 8) {
                clearInterval(timerRegre);

                showAciertos.innerHTML = `Aciertos: ${aciertos} bien`;
                showTime.innerHTML = `Acabaste en : ${timeIni - timer} segundos`;
                showMove.innerHTML = `Movimientos: ${moves} bien`;

                if (totalTime < 20 || moves < 12) { 
                    puntos=80;

                 } else if (totalTime < 25 || moves < 16) {
                    
                    puntos=60; 
                } else if  (totalTime < 30 || moves < 20) { 
                    
                    puntos=40; 
                } else if (totalTime < 35 || moves < 25) { 
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


            }, 800);



        }

    }



}