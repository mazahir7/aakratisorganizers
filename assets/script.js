"use strict";

const menuBtn = document.querySelector(".menu-btn");
const mobileNav = document.querySelector(".mobile-nav");

menuBtn.addEventListener("click", () => {
  menuBtn.classList.toggle("active");

  mobileNav.classList.toggle("active");
});
