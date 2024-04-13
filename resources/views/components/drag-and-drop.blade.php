<div id="dropArea">
    <p class="default-text"> Arrastra y suelta tus archivos aquí,
        <span id="uploadTrigger">o click aqui para subir.</span>
    </p>

    <div class="previews-container">
        {{-- Aqui van las vistas previas --}}

    </div>

</div>

@error('imagenes')
    <label class="text-red-600 mt-0">{{ $message }}</label>
@enderror
{{-- Input donde se inyectan las imagenes --}}
<input type="file" name="imagenes[]" id="imagenes" accept="image/*" multiple style="display: none" />


@push('scripts')
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            const inputFile = document.querySelector('#imagenes');
            const dropzoneArea = document.getElementById("dropArea");
            const uploadTrigger = document.querySelector("#uploadTrigger");
            const previewsContainer = document.querySelector(".previews-container");
            const defaultText = document.querySelector(".default-text");

            //remove file del input
            function removeFile(index) {
                const filesArray = Array.from(inputFile.files);

                filesArray.splice(index, 1);

                const dataTransfer = new DataTransfer();

                filesArray.forEach(file => {
                    dataTransfer.items.add(file);
                });

                inputFile.files = dataTransfer.files;
            }

            function removerImagen(e) {
                const previewContainer = e.currentTarget.parentNode
                const preview = previewContainer.querySelector(".preview");
                const index = preview.dataset.index;

                removeFile(index);

                previewContainer.remove();

                if (previewsContainer.children.length === 0) {
                    defaultText.style.display = 'block';
                }
            }

            function generateRemovePreviewBtn() {
                const container = document.createElement("DIV");
                container.classList.add("remove-imagen");
                const icon = document.createElement("SVG");
                icon.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/></svg>`
                container.appendChild(icon);
                return container;
            }

            function generatePreview(src, indexInArray) {
                const previewContainer = document.createElement("DIV");
                previewContainer.classList.add("preview-container");

                const preview = document.createElement('IMG');
                preview.classList.add('preview');
                preview.src = src;

                preview.dataset.index = indexInArray;

                const btnRemovePreview = generateRemovePreviewBtn();

                btnRemovePreview.addEventListener("click", removerImagen);

                previewContainer.appendChild(btnRemovePreview);

                previewContainer.appendChild(preview);
                previewsContainer.appendChild(previewContainer);
            }

            function addPreviews() {
                const files = inputFile.files;
                defaultText.style.display = 'none';
                Array.from(files).forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function() {

                        const src = reader.result;
                        generatePreview(src, index);
                    };

                    reader.readAsDataURL(file);

                });
            }

            //Drop area
            dropzoneArea.addEventListener("dragover", function(e) {
                e.preventDefault();
                dropzoneArea.classList.add("dragover");
            });

            dropzoneArea.addEventListener("dragleave", function(e) {
                e.preventDefault();
                dropzoneArea.classList.remove("dragover");
            });

            dropzoneArea.addEventListener("drop", function(e) {
                e.preventDefault();

                dropzoneArea.classList.remove("dragover");

                const archivos = e.dataTransfer.files;

                inputFile.files = archivos;

                addPreviews();
            });

            //Button por si no funciona el drop
            uploadTrigger.addEventListener("click", function() {
                inputFile.click();
            });

            inputFile.addEventListener("change", function() {
                addPreviews();
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        #dropArea {
            height: 20rem;
            width: 100%;
            border: 1px dashed #bababa;
            border-radius: .5rem;
            position: relative;
            color: #a8a6a8;

            @error('imagenes')
                border: 1px solid red;
            @enderror
        }


        .default-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        #dropArea.dragover {
            border-color: #90cdf4;
        }

        #uploadTrigger {
            color: blue;
            cursor: pointer;
        }

        #uploadTrigger:hover {
            color: #90cdf4;
        }

        .previews-container {
            width: 100%;
            height: 100%;
            padding: 2rem;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            overflow: auto;
        }


        .preview-container {
            position: relative;
        }

        .preview-container img {
            object-fit: cover;
            width: 8rem;
            height: 8rem;
            border-radius: .5rem;
        }

        .remove-imagen {
            position: absolute;
            top: -2.5rem;
            right: -2.5rem;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 2rem;
        }

        .remove-imagen:hover {
            color: firebrick;
        }
    </style>
@endpush
