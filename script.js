'use strict';

let burger = document.getElementById("burger");
let header = document.getElementById("header");
let burger__menu = document.getElementById("burger__menu");
burger.addEventListener("click", Burger);

burger.classList.toggle("burger__open");
let burger_height = burger__menu.clientHeight;
burger.classList.toggle("burger__open");

function Burger() {
  if (burger_height < header.clientHeight)
    burger__menu.style.height = header.clientHeight + "px";
  burger.classList.toggle("burger__open");
}

const anchors = document.querySelectorAll('a[href*="#"]')

for (let anchor of anchors) {
  anchor.addEventListener('click', function (e) {
    e.preventDefault()
    
    const blockID = anchor.getAttribute('href').substr(1)
    
    document.getElementById(blockID).scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    })
  })
}