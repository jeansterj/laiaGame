const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.loginLink');
const registerLink = document.querySelector('.registerLink');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.iconClose');


registerLink.addEventListener('click', ()=> {wrapper.classList.add('active');});

loginLink.addEventListener('click', ()=> {wrapper.classList.remove('active');});

btnPopup.addEventListener('click', ()=> {wrapper.classList.add('active-popup');});

iconClose.addEventListener('click', ()=> {wrapper.classList.remove('active-popup');});

