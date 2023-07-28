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

    const response = await fetch(selectInput.getAttribute("data-get-prov"));
    const data = await response.json();

    let selectOptions = "<option selected disabled>Seleccione una opción...</option>";
    data.providers.forEach(e => {
        selectOptions += `<option value="${e.prov_id}">${e.prov_nit}: ${e.prov_name}</option>`;
    })

    selectInput.innerHTML = selectOptions;
});

items.forEach(item => {
    const viewItemBtn = item.querySelector(".view-item");
    const editItemBtn = item.querySelector(".edit-item");

    viewItemBtn.addEventListener("click", async () => {
        request = await fetch(item.getAttribute("data-href"));

        data = await request.json();
        data = data[0]

        modalView.querySelector("[data-prod-ref]").innerHTML = data.prod_ref;
        modalView.querySelector("[data-prod-name]").innerHTML = data.prod_name;
        modalView.querySelector("[data-prod-desc]").innerHTML = data.prod_desc;
        modalView.querySelector("[data-prod-stock]").innerHTML = data.prod_stock;
        modalView.querySelector("[data-prod-val]").innerHTML = data.prod_value;
        modalView.querySelector("[data-prov-nit]").innerHTML = data.prov_nit;
        modalView.querySelector("[data-prov-name]").innerHTML = data.prov_name;
        modalView.querySelector("[data-prov-phone]").innerHTML = data.prov_phone;

        modalView.classList.add("show");

    })

    editItemBtn.addEventListener("click", async () => {
        request = await fetch(item.getAttribute("data-href"));
        data = await request.json();
        data = data[0]

        modalEdit.querySelector("#item-edit-ref").value = data.prod_ref
        modalEdit.querySelector("#item-edit-name").value = data.prod_name
        modalEdit.querySelector("#item-edit-desc").value = data.prod_desc
        modalEdit.querySelector("#item-edit-stock").value = data.prod_stock
        modalEdit.querySelector("#item-edit-value").value = data.prod_value
        modalEdit.querySelector("#item-edit-id").value = data.prod_id

        let prov = data.prov_id;

        modalEdit.querySelector("form").setAttribute("action", modalEdit.querySelector("form").getAttribute("action").replace("{id}", data.prod_id))
        modalEdit.classList.add("show");

        const selectInput = document.querySelector("[data-get-prov]");
        request = await fetch(selectInput.getAttribute("data-get-prov"));
        response = await request.json();

        let selectOptions = "<option disabled>Seleccione una opción...</option>";
        response.forEach(e => {
            selectOptions += `<option value="${e.prov_id}" ${prov == e.prov_id ? "selected" : ""}>${e.prov_nit}: ${e.prov_name}</option>`;
        })

        modalEdit.querySelector("#item-edit-prov").innerHTML = selectOptions;
    });
});

closeModalBtn.forEach(e => {
    e.addEventListener("click", () => {
        document.querySelectorAll(".modal").forEach(e => {
            e.classList.remove("show");
        })
    })
})