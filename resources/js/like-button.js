import axios from "axios";
import toastr from "toastr";
import "toastr/build/toastr.css";
window.addEventListener("DOMContentLoaded", async function () {
    const btnLike = document.querySelector("a.like-button");
    const contadorLikes = document.getElementById("likeAccount");
    let cuentaLikes = parseInt(contadorLikes.textContent);
    let animationState = true; //true = activada false = desactivada, inicializa activada

    const url = window.location.href;
    const partesUrl = url.split("/");
    const postId = partesUrl[partesUrl.length - 1];
    const apiUrl = `/posts/${postId}/likes`;

    function setButton() {
        contadorLikes.textContent = cuentaLikes;
        if (flagUserLiked) {
            btnLike.classList.add("liked");
            if (!animationState) {
                //activamos la animacion
                corazoncitos.forEach((corazoncito) => {
                    corazoncito.style.display = "block";
                });
            }
        } else {
            btnLike.classList.remove("liked");
        }
    }

    let flagUserLiked = btnLike.classList.contains("liked");

    btnLike.addEventListener("click", async function (e) {
        e.preventDefault();

        if (btnLike.dataset.guest) {
            toastr.info('Inicia sesión para dar like, click aqui');
            return;
        }
        if (flagUserLiked) {
            cuentaLikes--;
            axios.delete(apiUrl);
        } else {
            cuentaLikes++;
            axios.post(apiUrl);
        }
        flagUserLiked = !flagUserLiked;
        setButton();
    });

    const corazoncitos = document.querySelectorAll(".like-icon div");
    //si el usuario dio like al post previamente desactivamos la animacion en un principio
    if (flagUserLiked) {
        animationState = false;
        corazoncitos.forEach((corazoncito) => {
            corazoncito.style.display = "none";
        });
    }
});
