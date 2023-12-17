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







function checkCompletion() {
    
   let panelsolar =document.getElementById('panelsolar');
   let connector= document.getElementById('connector');
   let turbina = document.getElementById('turbina');
    if (getCookie('WarcelonaGameCompleted') === 'true') {
        connector.style.display = "block";
    
                
    }  
    else {       
        imageSprite2.visible = false;
    }       
    
    
    if (getCookie('brasilGameCompleted') === 'true') {
       turbina.style.display = "block";
        
              
    }  
    else {       
        imageSprite3.visible = false;
    }
    
    if (getCookie('KenyaGameCompleted') === 'true') {
        panelsolar.style.display = "block";

                 
    }  
    else {       
        imageSprite4.visible = false;
    }     

    if (getCookie('IndiaGameCompleted') === 'true') {
        
                  
    }     
}


function borrarCookie(cookie) {
    document.cookie = cookie + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}


function logout() {
    borrarCookie("WarcelonaGameCompleted");
    borrarCookie("brasilGameCompleted");
    borrarCookie("KenyaGameCompleted");
    borrarCookie("IndiaGameCompleted");
    borrarCookie("yaVisitado");

    window.location.href = '../laiaGame/php_partials/logout.php';
    
}


  

  