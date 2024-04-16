import Dropzone from "dropzone";
import fs from "fs";
window.addEventListener("DOMContentLoaded", function () {
    const inputImagenes = document.querySelector("[name='imagenes']");
    let arrayResponses = [];

    async function existeArchivo(rutaArchivo) {
        try {
            const response = await fetch(rutaArchivo);
            if (response.ok) {
                return true;
            } else {
                return false;
            }
        } catch (error) {
            return false;
        }
    }

    new Dropzone(".dropzone", {
        init: function () {
            const myDropzone = this;

            if (inputImagenes.value) {
                //imagenes del servidor
                arrayResponses = JSON.parse(inputImagenes.value);
                arrayResponses.forEach(async function (imagenName) {
                    const mockFile = { name: imagenName, size: 12345 };

                    let pathFile = `/uploads/`;
                    if (await existeArchivo(`/uploads/tmp/${imagenName}`)) {
                        pathFile = `/uploads/tmp/`;
                    }

                    myDropzone.displayExistingFile(
                        mockFile,
                        `${pathFile}${mockFile.name}`
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
