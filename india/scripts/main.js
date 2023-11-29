
// main.js


// Define los elementos del juego
const generator = '<img src="img/generator.png">'
const house1 = '<img src="img/house1.png">'
const house2 = '<img src="img/house2.png">'
const house3 = '<img src="img/house3.png">'
const house4 = '<img src="img/house4.png">'
// const solarPanel = '<img src="img/solarPanel/solarPanel.png">'
// const wire = '<img src="img/wire/wire.png">'
// const windTurbine = '<img src="img/windTurbine/windTurbine.png">'
// const connector = '<img src="img/connector/connector.png">'

let dragElement

// funcion para hacer el drag and drop con los elementos del div elementsBoard


//Map 
const startElements = [
    house3,"","","","","",house4,
    "","","","","","","",
    "","","","","","","",
    "","","",generator,"","","",
    "","","","","","","",
    "","","","","","","",
    house1,"","","","","",house2
];

let arraySquareDragged = [24]
var score = 0
let piecesDropped = []
var boton = document.getElementById('deleteLastElement');

document.addEventListener('DOMContentLoaded', () => {
  initializeElements()
  createBoard(startElements, piecesDropped)
  boton.addEventListener('click', deletelastpiece)
});


function initializeElements() {
  const gamePieces = document.querySelectorAll(".piece");

  gamePieces.forEach((piece) => {
    piece.addEventListener('dragstart', (e) => {
      e.dataTransfer.setData('text/plain', piece.id);
      dragElement = piece.id
      console.log('Adios ' + dragElement)
    });

    piece.addEventListener('dragend', (e) => {
      // Aquí puedes agregar el código necesario después de soltar el elemento
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
      if (dragElement === 'solarPanel' && checksquare(i, arraySquareDragged)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/solarPanel/solarpanel.png';
      } else if (dragElement === 'wire' && checksquare(i, arraySquareDragged)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/wire/horizontal.png';
      } else if (dragElement === 'windTurbine' && checksquare(i, arraySquareDragged)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/windTurbine/windturbine.png';
      } else if (dragElement === 'connector'  && checksquare(i, arraySquareDragged)) {
        elementCopy = document.createElement('img');
        elementCopy.src = 'img/connector/connector.png';
      }

      //Checks de penultimate piece and change the img
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
    checkFinal()

    
    });
  });
}

function checkFinal() {
  if (arraySquareDragged.includes(0) && arraySquareDragged.includes(6) && arraySquareDragged.includes(42) && arraySquareDragged.includes(48)) {
    console.log("Has ganado");
    //poner que pasa cuando ganas
  }
}


function updateScore() {
  let pieceToSum = piecesDropped[piecesDropped.length -1]
  if (pieceToSum === 'solarPanel') {
    score = score + 10 
  } else if (pieceToSum === 'wire') {
    score = score + 3
  } else if (pieceToSum === 'windTurbine') {
    score = score + 7   
  } else if (pieceToSum === 'connector') {
    score = score + 1  
  }
  
  console.log(score)
  
  var scoreHTML = document.getElementById("scoreHTML")
  scoreHTML.innerHTML = score
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

function checksquare(i, arraySquareDragged) {
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

  return checkedsquare;
}

function deletelastpiece(){
  let lastPiece = arraySquareDragged[arraySquareDragged.length -1]
  let penultimateSquare = document.querySelector('[squareid="' + lastPiece + '"]');
  
  if (lastPiece !== 24) {
    arraySquareDragged.pop()
    piecesDropped.pop()
    if (lastPiece !== 0 && lastPiece !== 6 && lastPiece !== 42 && lastPiece !== 48) {
      penultimateSquare.removeChild(penultimateSquare.firstChild)
      deleteScore(lastPiece)
    }
  }
}

function deleteScore() {
  let pieceToSubtract = piecesDropped[piecesDropped.length - 1];
  console.log(pieceToSubtract)
  if (pieceToSubtract === 'solarPanel') {
    score = score - 10;
  } else if (pieceToSubtract === 'wire') {
    score = score - 3;
  } else if (pieceToSubtract === 'windTurbine') {
    score = score - 7;
  } else if (pieceToSubtract === 'connector') {
    score = score - 1;
  }

  var scoreHTML = document.getElementById("scoreHTML");
  scoreHTML.innerHTML = score;
}