const dGalleryModalContainer = document.querySelector("#dash-gallery-show-modal")
const photos = document.querySelectorAll(".gali-img");

photos.forEach(p => {
    p.addEventListener("click", () => {
        const src = p.getAttribute("src")
        const img = dGalleryModalContainer.querySelector("img");
        img.setAttribute("src", src);
    })
})