import Dropzone from "dropzone";
import axios from "axios";
window.addEventListener("DOMContentLoaded", function () {
    const inputImagenes = document.querySelector("[name='imagenes']");
    let arrayImagenes = [];

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

    function recuperarImagenesServidor() {
        arrayImagenes = JSON.parse(inputImagenes.value);
        arrayImagenes.forEach(async function (imagenName) {
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

    const myDropzone = new Dropzone(".dropzone", {
        addRemoveLinks: true,
        maxFiles: 5,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        dictDefaultMessage: "Arrastra las imagenes aqui",
        dictInvalidFileType: "No se admiten archivos de este tipo",
        dictFileTooBig: "El archivo es demasiado grande",
        dictRemoveFile: "Borrar 🗑",
    });

    myDropzone.on("success", function (file, response) {
        arrayImagenes.push(response);
        file.upload.nameImageOnServer = response;
        inputImagenes.value = JSON.stringify(arrayImagenes);
    });

    myDropzone.on("removedfile", function (file) {
        arrayImagenes = arrayImagenes.filter(
            (fileName) => fileName !== file.upload.nameImageOnServer
        );
        inputImagenes.value = JSON.stringify(arrayImagenes);
        //eliminamos la imagen de la carpeta tmp para no acumular tantas
        axios.delete(`/post/imagen-tmp/${file.upload.nameImageOnServer}`);
    });

    if (inputImagenes.value) {
        recuperarImagenesServidor();
    }
});
