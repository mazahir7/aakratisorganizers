"use strict";

// mobile menu variables
const mobileMenuOpenBtn = document.querySelectorAll("[data-mobile-menu-open-btn]");
const mobileMenu = document.querySelectorAll("[data-mobile-menu]");
const mobileMenuCloseBtn = document.querySelectorAll("[data-mobile-menu-close-btn]");
const overlay = document.querySelector("[data-overlay]");

for (let i = 0; i < mobileMenuOpenBtn.length; i++) {
  // Check if the current button is the one you want to remove
  if (mobileMenuOpenBtn[i].classList.contains("your-button-class")) {
    // Remove the event listener and related functionality for the button
    continue; // Skip the current iteration
  }

  // mobile menu function
  const mobileMenuCloseFunc = function () {
    mobileMenu[i].classList.remove("active");
    overlay.classList.remove("active");
  };

  mobileMenuOpenBtn[i].addEventListener("click", function () {
    mobileMenu[i].classList.add("active");
    overlay.classList.add("active");
  });

  mobileMenuCloseBtn[i].addEventListener("click", mobileMenuCloseFunc);
  overlay.addEventListener("click", mobileMenuCloseFunc);
}

// accordion variables
const accordionBtn = document.querySelectorAll("[data-accordion-btn]");
const accordion = document.querySelectorAll("[data-accordion]");

for (let i = 0; i < accordionBtn.length; i++) {
  accordionBtn[i].addEventListener("click", function () {
    const clickedBtn = this.nextElementSibling.classList.contains("active");

    for (let j = 0; j < accordion.length; j++) {
      if (clickedBtn) break;

      if (accordion[j].classList.contains("active")) {
        accordion[j].classList.remove("active");
        accordionBtn[j].classList.remove("active");
      }
    }

    this.nextElementSibling.classList.toggle("active");
    this.classList.toggle("active");
  });
}
