const modalAdd = document.querySelector("#modal-add");
const addItemBtn = document.querySelector("#add-item");
const closeModalBtn = document.querySelectorAll(".close-modal");

addItemBtn.addEventListener("click", async () => {
    modalAdd.classList.add("show");
});

closeModalBtn.forEach(e => {
    e.addEventListener("click", () => {
        document.querySelectorAll(".modal").forEach(e => {
            e.classList.remove("show");
        })
    })
})