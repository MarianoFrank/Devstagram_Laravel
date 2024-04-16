import Dropzone from "dropzone";

window.addEventListener("DOMContentLoaded", function () {
    const inputImagenes = document.querySelector("[name='imagenes']");
    let arrayResponses = [];

    const myDropzone = new Dropzone(".dropzone", {
        init: function () {
            if (inputImagenes.value) {
                arrayResponses = JSON.parse(inputImagenes.value);
                arrayResponses.forEach((imagenName) => {
                    const imagen = {
                        size: 1234,
                        name: imagenName,
                    };
                    this.options.addedfile.call(this, imagen);
                    this.options.thumbnail.call(
                        this,
                        imagen,
                        `/uploads/${imagen.name}`
                    );
                });
            }

            this.on("success", (file, response) => {
                arrayResponses.push(response);
                inputImagenes.value = JSON.stringify(arrayResponses);
            });
        },
    });
});
