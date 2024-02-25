"use strict";

const menuBtn = document.querySelector(".menu-btn");
const mobileNav = document.querySelector(".mobile-nav");

const sliderContainer = document.querySelector(".slider-container");
const sliderImagesCount = document.querySelectorAll(".slider-container > img").length;
let imageCount = 1;

menuBtn.addEventListener("click", () => {
  menuBtn.classList.toggle("active");

  mobileNav.classList.toggle("active");
});

function changeSliderImage() {
  if (imageCount >= 4) imageCount = 0;

  sliderContainer.style.transform = `translateX(-${imageCount * 100}%)`;
  imageCount++;
}

setInterval(() => {
  changeSliderImage();
}, 3000);
