// Definates houses and generator
const generator = '<img src="img/generator.png">'
const house1 = '<img src="img/house1.png">'
const house2 = '<img src="img/house2.png">'
const house3 = '<img src="img/house3.png">'
const house4 = '<img src="img/house4.png">'


//define potencia de cada casa
const house1Energy = 40
const house2Energy = 60
const house3Energy = 80
const house4Energy = 100

//definir potencia de cada pieza
const solarPanelValue = 10
const windTurbineValue = 5
const connectorValue = 2
const wireValue = 1

const firstHouseSquare = 42
const secondHouseSquare = 0
const thirdHouseSquare = 48
const foutrthHouseSquare = 6

let dragElement

//Map 
const startElements = [
    house2,"","","","","",house3,
    "","","","","","","",
    "","","","","","","",
    "","","",generator,"","","",
    "","","","","","","",
    "","","","","","","",
    house1,"","","","","",house4
];

let arraySquareDragged = [24]
let score = 0
let seconds = 0
let piecesDropped = []
let boton = document.getElementById('deleteLastElement');

setInterval(() => {
  timer()
}, 1000);

document.addEventListener('DOMContentLoaded', () => {
  initializeElements()
  createBoard(startElements, piecesDropped)
  boton.addEventListener('click', deletelastpiece)
});

function timer() {
  seconds = setTimeout(updateTimer(seconds), 1000);
}
function updateTimer(seconds) {
  seconds++;
  const minutos = Math.floor(seconds / 60);
  const segundosRestantes = seconds % 60;
  const formatoMinutos = minutos < 10 ? `0${minutos}` : minutos;
  const formatoSegundos = segundosRestantes < 10 ? `0${segundosRestantes}` : segundosRestantes;
  document.getElementById('contador').innerHTML = `${formatoMinutos}:${formatoSegundos}`;
  return seconds;
}


function initializeElements() {
  const gamePieces = document.querySelectorAll(".piece");

  gamePieces.forEach((piece) => {
    piece.addEventListener('dragstart', (e) => {
      e.dataTransfer.setData('text/plain', piece.id);
      dragElement = piece.id
      console.log('Adios ' + dragElement)
    });

    piece.addEventListener('dragend', (e) => {
    });
  });
}

export function createBoard(startElements, piecesDropped) {
  const gameBoard = document.querySelector("#gameBoard")

  startElements.forEach((startElement, i) => {
    const square = document.createElement('div')
    square.classList.add('square')
    square.setAttribute('squareid', i)
    square.innerHTML = startElement
    gameBoard.append(square)

    // Dragenter for each square
    square.addEventListener('dragenter', e => {
      console.log('Drag enter on square ' + i)
    });
    square.addEventListener('dragover', e => {
      e.preventDefault();
    });

    square.addEventListener('drop', e => {
      console.log('Drop on square ' + i);
      
      let elementCopy;
      if (dragElement === 'solarPanel' && checksquare(i, arraySquareDragged, score)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/solarPanel/solarpanel.png';
      } else if (dragElement === 'wire' && checksquare(i, arraySquareDragged, score)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/wire/horizontal.png';
      } else if (dragElement === 'windTurbine' && checksquare(i, arraySquareDragged, score)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/windTurbine/windturbine.png';
      } else if (dragElement === 'connector'  && checksquare(i, arraySquareDragged, score)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/connector/connector.png';
      }

      //Checks if penultimate piece and change the img
      if (!arraySquareDragged.includes(i)) {
        checkPenultimate(i, arraySquareDragged, piecesDropped);
      }
      
      if (elementCopy) {  
        arraySquareDragged.push(i);
        piecesDropped.push(dragElement);
        if (i !== 0 && i !== 6 && i !== 42 && i !== 48) {
          updateScore()
          square.appendChild(elementCopy);
        }
      }
    checkhouses()
    checkFinal()

    
    });
  });
}
function checkhouses() {
  let firsthouseFirstTime = true
  let secondHouseFirstTime = true
  let thirdHouseFirstTime = true
  let fourthHouseFirstTime = true


  //Pone las casas con luz
  if (arraySquareDragged.includes(firstHouseSquare) && firsthouseFirstTime){
    let housesquare = document.querySelector('[squareid="' + firstHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img')
    newImage.src = 'img/house1LightOn.png'
    housesquare.appendChild(newImage)

    firsthouseFirstTime = false

  }  if (arraySquareDragged.includes(secondHouseSquare) && secondHouseFirstTime){
    let housesquare = document.querySelector('[squareid="' + secondHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img')
    newImage.src = 'img/house2LightOn.png'
    housesquare.appendChild(newImage)

    secondHouseFirstTime = true
    
  }
  if (arraySquareDragged.includes(thirdHouseSquare) && thirdHouseFirstTime){
    let housesquare = document.querySelector('[squareid="' + thirdHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img');
    newImage.src = 'img/house3LightOn.png';
    housesquare.appendChild(newImage);

    secondHouseFirstTime = true
  }
  if (arraySquareDragged.includes(foutrthHouseSquare) && fourthHouseFirstTime){
    let housesquare = document.querySelector('[squareid="' + foutrthHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img');
    newImage.src = 'img/house4LightOn.png';
    housesquare.appendChild(newImage);


    secondHouseFirstTime = true
  }


  //vuelve las casas a la version original
  if (!arraySquareDragged.includes(firstHouseSquare)){
    let housesquare = document.querySelector('[squareid="' + firstHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img')
    newImage.src = 'img/house1.png'
    housesquare.appendChild(newImage)

    firsthouseFirstTime = false

  }  if (!arraySquareDragged.includes(secondHouseSquare)){
    let housesquare = document.querySelector('[squareid="' + secondHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img')
    newImage.src = 'img/house2.png'
    housesquare.appendChild(newImage)

    secondHouseFirstTime = false
    
  }
  if (!arraySquareDragged.includes(thirdHouseSquare) ){
    let housesquare = document.querySelector('[squareid="' + thirdHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img');
    newImage.src = 'img/house4.png';
    housesquare.appendChild(newImage);

    secondHouseFirstTime = false
  }
  if (!arraySquareDragged.includes(foutrthHouseSquare)){
    let housesquare = document.querySelector('[squareid="' + foutrthHouseSquare + '"]')
    housesquare.removeChild(housesquare.firstChild)
    let newImage = document.createElement('img');
    newImage.src = 'img/house3.png';
    housesquare.appendChild(newImage);


    secondHouseFirstTime = false
  }

}

function checkFinal() {
  if (arraySquareDragged.includes(0) && arraySquareDragged.includes(6) && arraySquareDragged.includes(42) && arraySquareDragged.includes(48)) {
    console.log("Has ganado");    
    setCookie('IndiaGameCompleted', 'true', 7);
    //Victoria
    endScreen()
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

function updateScore() {
  let pieceToSum = piecesDropped[piecesDropped.length -1]
  if (pieceToSum === 'solarPanel') {
    score = score + solarPanelValue 
  } else if (pieceToSum === 'wire') {
    score = score + wireValue
  } else if (pieceToSum === 'windTurbine') {
    score = score + windTurbineValue   
  } else if (pieceToSum === 'connector') {
    score = score + connectorValue  
  }
  
  
  var scoreHTML = document.getElementById("scoreHTML")
  scoreHTML.innerHTML = score
  updateProgressBar(score)
}

function checkPenultimate(i, arraySquareDragged, piecesDropped) {
  let lastDroppedPiece = piecesDropped[piecesDropped.length -1];
  let antepenultimate = arraySquareDragged[arraySquareDragged.length -2];
  let penultimate = arraySquareDragged[arraySquareDragged.length -1];
  let ultimate = i;

  let goesToLeft = false;
  let goesToRight = false;
  let goesToTop = false;
  let goesToBottom = false;

  let comesFromLeft = false;
  let comesFromRight = false;
  let comesFromTop = false;
  let comesFromBottom = false;

  if (penultimate !== 0 && penultimate !== 6 && penultimate !== 42 && penultimate !== 48) {   
    if (ultimate + 1 === penultimate) {
      goesToLeft = true;
    } else if(ultimate - 1 === penultimate){
      goesToRight = true;
    } else if(ultimate + 7 === penultimate){
      goesToTop = true;
    } else if(ultimate - 7 === penultimate){
      goesToBottom = true;
    }

    if (penultimate + 1 === antepenultimate) {
      comesFromRight = true;
    } else if(penultimate - 1 === antepenultimate){
      comesFromLeft = true;
    } else if(penultimate + 7 === antepenultimate){
      comesFromBottom = true;
    } else if(penultimate - 7 === antepenultimate){
      comesFromTop = true;
    }

    let newImage
    if (goesToTop && comesFromLeft || goesToLeft && comesFromTop) {
      var penultimateSquare = document.querySelector('[squareid="' + penultimate + '"]');
      penultimateSquare.removeChild(penultimateSquare.firstChild);

      if (lastDroppedPiece === 'solarPanel') {
        newImage = document.createElement('img');
        newImage.src = 'img/solarPanel/leftTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'wire') {
        newImage = document.createElement('img');
        newImage.src = 'img/wire/leftTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'windTurbine') {
        newImage = document.createElement('img');
        newImage.src = 'img/windTurbine/leftTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'connector') {
        newImage = document.createElement('img');
        newImage.src ='img/connector/leftTop.png';
        penultimateSquare.appendChild(newImage);
      }
    } else if (goesToTop && comesFromBottom || goesToBottom && comesFromTop || goesToBottom && comesFromBottom || goesToTop && comesFromTop) {
      var penultimateSquare = document.querySelector('[squareid="' + penultimate + '"]');
      penultimateSquare.removeChild(penultimateSquare.firstChild);

      if (lastDroppedPiece === 'solarPanel') {
        newImage = document.createElement('img');
        newImage.src = 'img/solarPanel/vertical.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'wire') {
        newImage = document.createElement('img');
        newImage.src = 'img/wire/vertical.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'windTurbine') {
        newImage = document.createElement('img');
        newImage.src = 'img/windTurbine/vertical.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'connector') {
        newImage = document.createElement('img');
        newImage.src = 'img/connector/vertical.png';
        penultimateSquare.appendChild(newImage);
      }
    } else if (goesToTop && comesFromLeft || comesFromTop && goesToLeft ) {
      var penultimateSquare = document.querySelector('[squareid="' + penultimate + '"]');
      penultimateSquare.removeChild(penultimateSquare.firstChild);

      if (lastDroppedPiece === 'solarPanel') {
        newImage = document.createElement('img');
        newImage.src = 'img/solarPanel/leftTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'wire') {
        newImage = document.createElement('img');
        newImage.src = 'img/wire/leftTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'windTurbine') {
        newImage = document.createElement('img');
        newImage.src = 'img/windTurbine/leftTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'connector') {
        newImage = document.createElement('img');
        newImage.src = 'img/connector/leftTop.png';
        penultimateSquare.appendChild(newImage);
      }
    } else if (goesToBottom && comesFromLeft|| goesToLeft && comesFromBottom){
      var penultimateSquare = document.querySelector('[squareid="' + penultimate + '"]');
      penultimateSquare.removeChild(penultimateSquare.firstChild);

      if (lastDroppedPiece === 'solarPanel') {
        newImage = document.createElement('img');
        newImage.src = 'img/solarPanel/leftBottom.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'wire') {
        newImage = document.createElement('img');
        newImage.src = 'img/wire/leftBottom.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'windTurbine') {
        newImage = document.createElement('img');
        newImage.src = 'img/windTurbine/leftBottom.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'connector') {
        newImage = document.createElement('img');
        newImage.src = 'img/connector/leftBottom.png';
        penultimateSquare.appendChild(newImage);
      }
    } else if (goesToBottom && comesFromRight || goesToRight && comesFromBottom ) {
      var penultimateSquare = document.querySelector('[squareid="' + penultimate + '"]');
      penultimateSquare.removeChild(penultimateSquare.firstChild);

      if (lastDroppedPiece === 'solarPanel') {
        newImage = document.createElement('img');
        newImage.src = 'img/solarPanel/rightBottom.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'wire') {
        newImage = document.createElement('img');
        newImage.src = 'img/wire/rightBottom.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'windTurbine') {
        newImage = document.createElement('img');
        newImage.src = 'img/windTurbine/rightBottom.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'connector') {
        newImage = document.createElement('img');
        newImage.src = 'img/connector/rightBottom.png';
        penultimateSquare.appendChild(newImage);
      }
    } else if (goesToRight && comesFromLeft || goesToLeft && comesFromRight || goesToRight && comesFromRight || goesToLeft && comesFromLeft) {
      var penultimateSquare = document.querySelector('[squareid="' + penultimate + '"]');
      penultimateSquare.removeChild(penultimateSquare.firstChild);

      if (lastDroppedPiece === 'solarPanel') {
        newImage = document.createElement('img');
        newImage.src = 'img/solarPanel/horizontal.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'wire') {
        newImage = document.createElement('img');
        newImage.src = 'img/wire/horizontal.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'windTurbine') {
        newImage = document.createElement('img');
        newImage.src = 'img/windTurbine/horizontal.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'connector') {
        newImage = document.createElement('img');
        newImage.src = 'img/connector/horizontal.png';
        penultimateSquare.appendChild(newImage);
      }
    } else if (goesToTop && comesFromRight || goesToRight && comesFromTop) {
      var penultimateSquare = document.querySelector('[squareid="' + penultimate + '"]');
      penultimateSquare.removeChild(penultimateSquare.firstChild);

      if (lastDroppedPiece === 'solarPanel') {
        newImage = document.createElement('img');
        newImage.src = 'img/solarPanel/rightTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'wire') {
        newImage = document.createElement('img');
        newImage.src = 'img/wire/rightTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'windTurbine') {
        newImage = document.createElement('img');
        newImage.src = 'img/windTurbine/rightTop.png';
        penultimateSquare.appendChild(newImage);
      } else if (lastDroppedPiece === 'connector') {
        newImage = document.createElement('img');
        newImage.src = 'img/connector/rightTop.png';
        penultimateSquare.appendChild(newImage);
      }
    }
  }
}

function checksquare(i, arraySquareDragged,score) {
  let checkedsquare = true;
  let lastDropSquare = arraySquareDragged[arraySquareDragged.length -1];

  const leftEdge = [7,14,21,28,35];
  const rightEdge = [13,20,27,34,41];
  const topEdge = [1, 2, 3, 4, 5];
  const bottomEdge = [43,44,45,46,47];

  let top = lastDropSquare - 7;
  let right = lastDropSquare + 1;
  let bottom = lastDropSquare + 7;
  let left = lastDropSquare - 1;
    
  if (leftEdge.includes(lastDropSquare)) { 
    let possibleOptions = [top, right, bottom];  
    console.log(possibleOptions);
    if (!possibleOptions.includes(i)) {
      checkedsquare = false;
    }
  } else if (rightEdge.includes(lastDropSquare)) {
    let possibleOptions = [top, left, bottom];
    if (!possibleOptions.includes(i)) {
      checkedsquare = false;
    }
  } else if (topEdge.includes(lastDropSquare)) {
    let possibleOptions = [bottom, right, left];
    if (!possibleOptions.includes(i)) {
      checkedsquare = false;
    }
  } else if (bottomEdge.includes(lastDropSquare)) {
    let possibleOptions = [top, right, left];
    if (!possibleOptions.includes(i)) {
      checkedsquare = false;
    }
  } else {
    let possibleOptions = [top, right, bottom, left];
    if (!possibleOptions.includes(i)) {
      checkedsquare = false;
    }
  }

  if (arraySquareDragged.includes(i)) {
    checkedsquare = false;
  }

  //checks that house energy is valid

  if (i === 42 && score != house1Energy) {
    checkedsquare = false
  }

  if (i === 0 && score != house2Energy) {
    checkedsquare = false
  }

  if (i === 48 && score != house3Energy) {
    checkedsquare = false
  }

  if (i === 6 && score != house4Energy) {
    checkedsquare = false
  }

  

  return checkedsquare;
}

function deletelastpiece(){
  let lastPiece = arraySquareDragged[arraySquareDragged.length -1]
  let penultimateSquare = document.querySelector('[squareid="' + lastPiece + '"]');
  
  if (lastPiece !== 24) {
    if (lastPiece !== 0 && lastPiece !== 6 && lastPiece !== 42 && lastPiece !== 48) {
      penultimateSquare.removeChild(penultimateSquare.firstChild)
      deleteScore(lastPiece)
    }
    arraySquareDragged.pop()
    piecesDropped.pop()
  }

  checkhouses()
}

function deleteScore() {
  let pieceToSubtract = piecesDropped[piecesDropped.length - 1];
  console.log(pieceToSubtract)
  if (pieceToSubtract === 'solarPanel') {
    score = score - solarPanelValue;
  } else if (pieceToSubtract === 'wire') {
    score = score - wireValue;
  } else if (pieceToSubtract === 'windTurbine') {
    score = score - windTurbineValue;
  } else if (pieceToSubtract === 'connector') {
    score = score - connectorValue;
  }

  var scoreHTML = document.getElementById("scoreHTML");
  scoreHTML.innerHTML = score;
  updateProgressBar(score)
}

function updateProgressBar(score) {

  if (score <= 100) {
    var progressBar = document.getElementById('currentProgress');
        progressBar.style.width = score + '%';
  }
}


function endScreen() {
  document.getElementById('hide').style.display = "none";
  document.getElementById('show').style.display = "block";

  var finalScoreInput = document.getElementById("finalScore");
  finalScoreInput.innerHTML = finalScore;
}

