// elements.js

// Define los elementos del juego
export const generator = '<img src="img/generator.png">'
export const house1 = '<img src="img/house1.png">'
export const house2 = '<img src="img/house2.png">'
export const house3 = '<img src="img/house3.png">'
export const house4 = '<img src="img/house4.png">'
// const solarPanel = '<img src="img/solarPanel/solarPanel.png">'
// const wire = '<img src="img/wire/wire.png">'
// const windTurbine = '<img src="img/windTurbine/windTurbine.png">'
// const connector = '<img src="img/connector/connector.png">'
export let dragElement


// funcion para hacer el drag and drop con los elementos del div elementsBoard
export function initializeElements() {
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

