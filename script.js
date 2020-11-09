'use strict';

let isopen = false;

let fixed = document.getElementById('fixed');
let fixed_wrapper = document.getElementById("fixed-wrapper");
let burger = document.getElementById("burger");
let header = document.getElementById("header");
let burger__menu = document.getElementById("burger__menu");
let header_img = document.getElementById("header_img");

burger.addEventListener("click", Burger);

burger.classList.toggle("burger__open");
let burger_height = burger__menu.clientHeight;
burger.classList.toggle("burger__open");

function Burger() {
  if (burger_height < header.clientHeight)
    burger__menu.style.height = header.clientHeight + "px";
  burger.classList.toggle("burger__open");
  // header_img.style.display = 'none';
  if (isopen == false)
  {
    isopen = true;
    header_img.style.display = 'none';
    console.log('1');
  }
  else
  {
    isopen = false;
    header_img.style.display = 'inline';
    console.log('2');
  }

}


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