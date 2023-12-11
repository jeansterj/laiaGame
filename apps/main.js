addEventListener("DOMContentLoaded", (event) => {


    const wrapper = document.querySelector('.modal .modal-content');
    const loginLink = document.querySelector('.loginLink');
    const registerLink = document.querySelector('.registerLink');
    const btnPopup = document.querySelector('.btnLogin-popup');
    
    registerLink.addEventListener('click', ()=> {wrapper.classList.add('active');});
    
    loginLink.addEventListener('click', ()=> {wrapper.classList.remove('active');});
    
    btnPopup.addEventListener('click', ()=> {wrapper.classList.add('active-popup');});
    

});

function onMouseClick() {
    let myModal = new bootstrap.Modal(document.getElementById('miModal'));
    myModal.hide();
  }

  