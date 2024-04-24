import Swiper from "swiper/bundle";

import "swiper/css/bundle";
window.addEventListener("DOMContentLoaded", function () {
    console.log("hola");
    const swiper = new Swiper(".swiper", {
        loop: true,
      
        grabCursor: true,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});
