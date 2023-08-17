const modalAdd = document.querySelector("#modal-add");
const modalView = document.querySelector("#modal-view")
const modalEdit = document.querySelector("#modal-edit")
const addItemBtn = document.querySelector("#add-item");
const deleteItemBtn = document.querySelector("#delete-item");


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
    const selectInput = document.querySelector("[data-get-even]");
    if (selectInput.children.length > 1)
        return;

    response = await fetch(selectInput.getAttribute("data-get-even"));

    if (await checkFetchError(response)) return;

    data = await response.json();

    let selectOptions;
    if (data.providers.length == 0) {
        selectOptions = "<option selected disabled>No hay Eeventos.</option>";
    } else {
        selectOptions = "<option selected disabled>Seleccione una opción...</option>";
        data.providers.forEach(e => {
            selectOptions += `<option value="${e.even_id}">${e.even_text}: ${e.even_name}</option>`;
        })
    }

    selectInput.innerHTML = selectOptions;
});

items.forEach(item => {
    const viewItemBtn = item.querySelector(".view-item");
    const editItemBtn = item.querySelector(".edit-item");
    const deleteItemBtn = item.querySelector(".delete-item");

    viewItemBtn.addEventListener("click", async () => {
        response = await fetch(item.getAttribute("data-href"));

        if (await checkFetchError(response)) return;

        data = await response.json();

        modalView.querySelector("[data-even-name]").innerHTML = data.product.prod_ref;
        modalView.querySelector("[data-even-text]").innerHTML = data.product.prod_name;
        modalView.querySelector("[data-even-fech]").innerHTML = data.product.prod_desc;
 

        modalView.classList.add("show");
    })

    editItemBtn.addEventListener("click", async () => {
        response = await fetch(item.getAttribute("data-href"));

        if (await checkFetchError(response)) return;

        data = await response.json();

        modalEdit.querySelector("#item-edit-name").value = data.product.prod_ref
        modalEdit.querySelector("#item-edit-text").value = data.product.prod_name
        modalEdit.querySelector("#item-edit-fech").value = data.product.prod_desc
    

        let prov = data.product.prov_id;

        modalEdit.querySelector("form").setAttribute("action", modalEdit.querySelector("form").getAttribute("action").replace("{id}", data.even_id))

        const selectInput = document.querySelector("[data-get-even]");
        response = await fetch(selectInput.getAttribute("data-get-even"));

        if (await checkFetchError(response)) return;

        data = await response.json();

        let selectOptions;
        if (data.providers.length == 0) {
            selectOptions = "<option selected disabled>No hay Eventos.</option>";
        } else {
            selectOptions = "<option disabled>Seleccione una opción...</option>";
            data.providers.forEach(e => {
                selectOptions += `<option ${even == e.even_id ? "selected" : ""} value="${e.even_id}">${e.even_text}: ${e.even_name}</option>`;
            })
        }

        modalEdit.querySelector("#item-edit-even").innerHTML = selectOptions;
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