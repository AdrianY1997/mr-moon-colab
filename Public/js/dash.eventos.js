const itemsContainers = document.querySelectorAll(".event.add");



itemsContainers.forEach(ic => {

    const imgContainer = ic.querySelector("img");
    const imgField = ic.querySelector(".item-path");

    imgField.addEventListener("change", () => {
        const reader = new FileReader();
        reader.addEventListener("load", (event) => {
            imgContainer.src = event.target.result;
        });
        reader.readAsDataURL(imgField.files[0]);
    });

});
