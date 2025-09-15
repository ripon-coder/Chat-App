document
    .getElementById("file_input")
    .addEventListener("change", function (event) {
        let imageInfoDiv = document.querySelector(".image_info");
        if (imageInfoDiv) {
            imageInfoDiv.remove(); // remove all classes
        }

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("previewImage").src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });

