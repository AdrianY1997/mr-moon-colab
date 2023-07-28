const modalAdd = document.querySelector("#modal-add");
const modalView = document.querySelector("#modal-view")
const modalEdit = document.querySelector("#modal-edit")
const addItemBtn = document.querySelector("#add-item");

const closeModalBtn = document.querySelectorAll(".close-modal");

const viewItemBtns = document.querySelectorAll(".view-item");
const items = document.querySelectorAll(".item[data-href]");

let request;

document.querySelectorAll(".form-label-group>input[type='number']").forEach(e => {
    e.addEventListener("keyup", () => {
        if (e.value < 1)
            e.value = "";
    })
})

addItemBtn.addEventListener("click", async () => {
    modalAdd.classList.add("show");
    const selectInput = document.querySelector("[data-get-prov]");
    if (selectInput.children.length > 1)
        return;

    request = await fetch(selectInput.getAttribute("data-get-prov"));
    response = await request.json();

    let selectOptions = "<option selected disabled>Seleccione una opción...</option>";
    response.forEach(e => {
        selectOptions += `<option value="${e.prov_id}">${e.prov_nit}: ${e.prov_name}</option>`;
    })

    selectInput.innerHTML = selectOptions;
});

items.forEach(item => {
    const viewItemBtn = item.querySelector(".view-item");
    const editItemBtn = item.querySelector(".edit-item");

    viewItemBtn.addEventListener("click", async () => {
        const response = await fetch(item.getAttribute("data-href"));

        if (response.status != 200) {
            return notify({
                text: response.statusText,
                status: "error",
                bg: "bg-danger"
            });
        }

        data = await response.json();

        modalView.querySelector("[data-prov-nit]").innerHTML = data.provider.prov_nit;
        modalView.querySelector("[data-prov-name]").innerHTML = data.provider.prov_name;
        modalView.querySelector("[data-prov-email]").innerHTML = data.provider.prov_email;
        modalView.querySelector("[data-prov-phone]").innerHTML = data.provider.prov_phone;

        modalView.classList.add("show");
    })

    editItemBtn.addEventListener("click", async () => {
        request = await fetch(item.getAttribute("data-href"));
        data = await request.json();

        modalEdit.querySelector("#prov-edit-nit").value = data.provider.prov_nit
        modalEdit.querySelector("#prov-edit-name").value = data.provider.prov_name
        modalEdit.querySelector("#prov-edit-email").value = data.provider.prov_email
        modalEdit.querySelector("#prov-edit-phone").value = data.provider.prov_phone
        modalEdit.querySelector("#prov-edit-id").value = data.provider.prov_id

        modalEdit.querySelector("form").setAttribute("action", modalEdit.querySelector("form").getAttribute("action").replace("{id}", data.prov_id))
        modalEdit.classList.add("show");
    });
});

closeModalBtn.forEach(e => {
    e.addEventListener("click", () => {
        document.querySelectorAll(".modal").forEach(e => {
            e.classList.remove("show");
        })
    })
})