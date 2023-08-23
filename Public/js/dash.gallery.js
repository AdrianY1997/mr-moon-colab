const itemsContainers = document.querySelectorAll(".dash-gallery-item-container");

itemsContainers.forEach(ic => {
    const form = ic.querySelector("form");
    const imgContainer = ic.querySelector("img");
    const imgField = ic.querySelector(".gallery-img")
    const uploadImg = ic.querySelector(".upload-img");
    const saveImg = ic.querySelector(".save-img");

    imgField.addEventListener("change", () => {
        if (imgField.value) saveImg.removeAttribute("disabled");
        const reader = new FileReader();
        reader.addEventListener("load", (event) => {
            imgContainer.src = event.target.result;
        });
        reader.readAsDataURL(imgField.files[0]);
    });

    uploadImg.addEventListener("click", () => imgField.click());
    saveImg.addEventListener("click", () => form.submit());
});