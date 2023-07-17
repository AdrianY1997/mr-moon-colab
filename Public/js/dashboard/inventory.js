const modal = document.querySelector("#modal");
const closeModalBtn = document.querySelector("#close-modal");

const items = document.querySelectorAll(".item[data-href]");

let request;

items.forEach(item => {
    const viewItemBtn = item.querySelector(".view-item");
    viewItemBtn.addEventListener("click", async () => {
        request = await fetch(item.getAttribute("data-href"));
        data = await request.json();
        console.log(data)

        modal.classList.add("show");
    })
});

closeModalBtn.addEventListener("click", () => {
    modal.classList.remove("show");
})