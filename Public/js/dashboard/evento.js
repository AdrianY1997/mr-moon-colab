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
});

items.forEach(item => {
    const viewItemBtn = item.querySelector(".view-item");
    const editItemBtn = item.querySelector(".edit-item");

    viewItemBtn.addEventListener("click", async () => {
        const response = await fetch(item.getAttribute("data-href"));

        if (await checkFetchError(response)) return;

        const data = await response.json();

        modalView.querySelector("[data-even-name]").innerHTML = data.Event.even_name;
        modalView.querySelector("[data-even-text]").innerHTML = data.Event.even_text;
        modalView.querySelector("[data-even-fech]").innerHTML = data.Event.even_fech;
        modalView.querySelector("[data-even-path]").innerHTML = data.Event.even_path;

        modalView.classList.add("show");
    })

    editItemBtn.addEventListener("click", async () => {
        const response = await fetch(item.getAttribute("data-href"));

        if (await checkFetchError(response)) return

        const data = await response.json();

        modalEdit.querySelector("#even-edit-nit").value = data.Event.even_name
        modalEdit.querySelector("#even-edit-name").value = data.Event.even_text
        modalEdit.querySelector("#even-edit-email").value = data.Event.even_fech
        modalEdit.querySelector("#even-edit-phone").value = data.Event.even_path
        modalEdit.querySelector("#even-edit-id").value = data.Event.even_id

        modalEdit.querySelector("form").setAttribute("action", modalEdit.querySelector("form").getAttribute("action").replace("{id}", data.even_id))
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
























// const modalAdd = document.querySelector("#modal-add");
// const modalView = document.querySelector("#modal-view")
// const modalEdit = document.querySelector("#modal-edit")
// const addItemBtn = document.querySelector("#add-item");
// const deleteItemBtn = document.querySelector("#delete-item");


// const closeModalBtn = document.querySelectorAll(".close-modal");

// const viewItemBtns = document.querySelectorAll(".view-item");
// const items = document.querySelectorAll(".item[data-href]");

// let response, data;

// document.querySelectorAll(".form-label-group>input[type='number']").forEach(e => {
//     e.addEventListener("keyup", () => {
//         if (e.value < 1)
//             e.value = "";
//     })
// })

// addItemBtn.addEventListener("click", async () => {
//     modalAdd.classList.add("show");
//     const selectInput = document.querySelector("[data-get-even]");
//     if (selectInput.children.length > 1)
//         return;

//     response = await fetch(selectInput.getAttribute("data-get-even"));

//     if (await checkFetchError(response)) return;

//     data = await response.json();

//     let selectOptions;
//     if (data.evento.length == 0) {
//         selectOptions = "<option selected disabled>No hay Eeventos.</option>";
//     } else {
//         selectOptions = "<option selected disabled>Seleccione una opción...</option>";
//         data.evento.forEach(e => {
//             selectOptions += `<option value="${e.even_id}">${e.even_text}: ${e.even_name}</option>`;
//         })
//     }

//     selectInput.innerHTML = selectOptions;
// });

// items.forEach(item => {
//     const viewItemBtn = item.querySelector(".view-item");
//     const editItemBtn = item.querySelector(".edit-item");
//     const deleteItemBtn = item.querySelector(".delete-item");

//     viewItemBtn.addEventListener("click", async () => {
//         response = await fetch(item.getAttribute("data-href"));

//         if (await checkFetchError(response)) return;

//         data = await response.json();

//         modalView.querySelector("[data-even-name]").innerHTML = data.Event.even_name;
//         modalView.querySelector("[data-even-text]").innerHTML = data.Event.even_text;
//         modalView.querySelector("[data-even-fech]").innerHTML = data.Event.even_fech;
 

//         modalView.classList.add("show");
//     })

//     editItemBtn.addEventListener("click", async () => {
//         response = await fetch(item.getAttribute("data-href"));

//         if (await checkFetchError(response)) return;

//         data = await response.json();

//         modalEdit.querySelector("#item-edit-name").value = data.Event.even_name
//         modalEdit.querySelector("#item-edit-text").value = data.Event.even_text
//         modalEdit.querySelector("#item-edit-fech").value = data.Event.even_fech
    

//         let prov = data.Event.even_id;

//         modalEdit.querySelector("form").setAttribute("action", modalEdit.querySelector("form").getAttribute("action").replace("{id}", data.even_id))

//         const selectInput = document.querySelector("[data-get-even]");
//         response = await fetch(selectInput.getAttribute("data-get-even"));

//         if (await checkFetchError(response)) return;

//         data = await response.json();

//         let selectOptions;
//         if (data.evento.length == 0) {
//             selectOptions = "<option selected disabled>No hay Eventos.</option>";
//         } else {
//             selectOptions = "<option disabled>Seleccione una opción...</option>";
//             data.evento.forEach(e => {
//                 selectOptions += `<option ${even == e.even_id ? "selected" : ""} value="${e.even_id}">${e.even_text}: ${e.even_name}</option>`;
//             })
//         }

//         modalEdit.querySelector("#item-edit-even").innerHTML = selectOptions;
//         modalEdit.classList.add("show");
//     });
// });

