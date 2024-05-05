window.addEventListener("DOMContentLoaded", () => {
    const btnUpload = document.getElementById("btnUploadAvatar");
    const inputFile = document.getElementById("avatarFile");
    const formAvatar = document.getElementById("formAvatar");
    console.log(formAvatar);
    btnUpload.addEventListener("click", () => {
        inputFile.click();
    });

    inputFile.addEventListener("change", () => {
        formAvatar.submit();
    });
});
