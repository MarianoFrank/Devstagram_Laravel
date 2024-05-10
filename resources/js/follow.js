import axios from "axios";
import toastr from "toastr";
window.addEventListener("DOMContentLoaded", function () {
    let url = window.location.href;
    let partesUrl = url.split("/");
    let userId = partesUrl[partesUrl.length - 1];

    const urlFollow = `/${userId}/follow`;
    const urlUnfollow = `/${userId}/unfollow`;

    const countFollowsElement = document.getElementById("countFollows");
    let countFollows = parseInt(countFollowsElement.textContent);

    function addCount() {
        countFollows++;
        countFollowsElement.textContent = countFollows.toString();
    }
    function lessCount() {
        countFollows--;
        countFollowsElement.textContent = countFollows.toString();
    }

    function createUnfollowBtn(typeBtn) {
        let btnFollow = document.getElementById("follow");
        let container = btnFollow.parentElement;
        btnFollow.remove();
        let btnUnfollow = document.createElement("button");
        btnUnfollow.setAttribute("type", "button");
        btnUnfollow.setAttribute("id", "unfollow");
        btnUnfollow.classList.add(
            "block",
            "rounded",
            "px-3",
            "py-1",
            "text-sm",
            "border",
            "border-slate-200"
        );
        btnUnfollow.textContent = "Dejar de seguir";
        container.appendChild(btnUnfollow);
        registrarEventos();
    }

    function createFollowBtn() {
        let btnUnfollow = document.getElementById("unfollow");
        let container = btnUnfollow.parentElement;
        btnUnfollow.remove();
        let btnFollow = document.createElement("button");
        btnFollow.setAttribute("type", "button");
        btnFollow.setAttribute("id", "follow");
        btnFollow.classList.add(
            "block",
            "rounded",
            "px-3",
            "py-1",
            "text-sm",
            "bg-primario-600",
            "text-zinc-50"
        );
        btnFollow.textContent = "Seguir";
        container.appendChild(btnFollow);
        registrarEventos();
    }

    async function addFollow() {
        await axios
            .post(urlFollow)
            .then(() => {
                createUnfollowBtn();
                addCount();
            })
            .catch(() => {
                toastr.error("Error en el servidor");
            });
    }

    async function removeFollow() {
        await axios
            .delete(urlUnfollow)
            .then(() => {
                createFollowBtn();
                lessCount();
            })
            .catch(() => {
                toastr.error("Error en el servidor");
            });
    }

    function registrarEventos() {
        let btnFollow = document.getElementById("follow");

        if (btnFollow) {
            btnFollow.onclick = addFollow;
        }

        let btnUnfollow = document.getElementById("unfollow");

        if (btnUnfollow) {
            btnUnfollow.onclick = removeFollow;
        }
    }

    registrarEventos();
});
