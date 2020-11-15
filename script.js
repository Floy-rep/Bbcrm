'use strict';

// VAR

let isopen = false;
let fixed = document.getElementById('fixed');
let fixed_wrapper = document.getElementById("fixed-wrapper");
let burger = document.getElementById("burger");
let header = document.getElementById("header");
let burger__menu = document.getElementById("burger__menu");
let header_img = document.getElementById("header_img");

burger.classList.toggle("burger__open");
let burger_height = burger__menu.clientHeight;
burger.classList.toggle("burger__open");

// BURGER

burger.addEventListener("click", Burger);
function Burger() {
  if (burger_height < header.clientHeight)
    burger__menu.style.height = header.clientHeight + "px";
  burger.classList.toggle("burger__open");
  if (isopen == false)
  {
    isopen = true;
    header_img.style.display = 'none';
  }
  else
  {
    isopen = false;
    header_img.style.display = 'inline';
  }
}

// FIXED MENU

window.addEventListener('scroll', function() {
  if (pageYOffset != 0)
  {
    fixed.classList.add("header__fixed-active");
    fixed_wrapper.classList.add("fixed-wrapper");
  }
  else
  {
    fixed.classList.remove("header__fixed-active");
    fixed_wrapper.classList.remove("fixed-wrapper");
  } 
});



// SMOOTH SCROLL

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