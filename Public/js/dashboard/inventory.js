const modalAdd = document.querySelector("#modal-add");
const modalView = document.querySelector("#modal-view")
const modalEdit = document.querySelector("#modal-edit")
const addItemBtn = document.querySelector("#add-item");

const closeModalBtn = document.querySelectorAll(".close-modal");

const viewItemBtns = document.querySelectorAll(".view-item");
const items = document.querySelectorAll(".item[data-href]");

let response, data;

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

    response = await fetch(selectInput.getAttribute("data-get-prov"));

    if (await checkFetchError(response)) return;

    data = await response.json();

    let selectOptions;
    if (data.providers.length == 0) {
        selectOptions = "<option selected disabled>No hay proveedores.</option>";
    } else {
        selectOptions = "<option selected disabled>Seleccione una opción...</option>";
        data.providers.forEach(e => {
            selectOptions += `<option value="${e.prov_id}">${e.prov_nit}: ${e.prov_name}</option>`;
        })
    }

    selectInput.innerHTML = selectOptions;
});

items.forEach(item => {
    const viewItemBtn = item.querySelector(".view-item");
    const editItemBtn = item.querySelector(".edit-item");

    viewItemBtn.addEventListener("click", async () => {
        response = await fetch(item.getAttribute("data-href"));

        if (await checkFetchError(response)) return;

        data = await response.json();

        modalView.querySelector("[data-prod-ref]").innerHTML = data.product.prod_ref;
        modalView.querySelector("[data-prod-name]").innerHTML = data.product.prod_name;
        modalView.querySelector("[data-prod-desc]").innerHTML = data.product.prod_desc;
        modalView.querySelector("[data-prod-stock]").innerHTML = data.product.prod_stock;
        modalView.querySelector("[data-prod-val]").innerHTML = data.product.prod_value;
        modalView.querySelector("[data-prov-nit]").innerHTML = data.product.prov_nit;
        modalView.querySelector("[data-prov-name]").innerHTML = data.product.prov_name;
        modalView.querySelector("[data-prov-phone]").innerHTML = data.product.prov_phone;

        modalView.classList.add("show");
    })

    editItemBtn.addEventListener("click", async () => {
        response = await fetch(item.getAttribute("data-href"));

        if (await checkFetchError(response)) return;

        data = await response.json();

        modalEdit.querySelector("#item-edit-ref").value = data.product.prod_ref
        modalEdit.querySelector("#item-edit-name").value = data.product.prod_name
        modalEdit.querySelector("#item-edit-desc").value = data.product.prod_desc
        modalEdit.querySelector("#item-edit-stock").value = data.product.prod_stock
        modalEdit.querySelector("#item-edit-value").value = data.product.prod_value
        modalEdit.querySelector("#item-edit-id").value = data.product.prod_id

        let prov = data.product.prov_id;

        modalEdit.querySelector("form").setAttribute("action", modalEdit.querySelector("form").getAttribute("action").replace("{id}", data.prod_id))

        const selectInput = document.querySelector("[data-get-prov]");
        response = await fetch(selectInput.getAttribute("data-get-prov"));

        if (await checkFetchError(response)) return;

        data = await response.json();

        let selectOptions;
        if (data.providers.length == 0) {
            selectOptions = "<option selected disabled>No hay proveedores.</option>";
        } else {
            selectOptions = "<option disabled>Seleccione una opción...</option>";
            data.providers.forEach(e => {
                selectOptions += `<option ${prov == e.prov_id ? "selected" : ""} value="${e.prov_id}">${e.prov_nit}: ${e.prov_name}</option>`;
            })
        }

        modalEdit.querySelector("#item-edit-prov").innerHTML = selectOptions;
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