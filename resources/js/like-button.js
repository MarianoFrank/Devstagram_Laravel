window.addEventListener("DOMContentLoaded", function () {
    const btnLike = document.querySelector("a.like-button");
    btnLike.addEventListener("click", function (e) {
        btnLike.classList.toggle("liked");
    });
});
