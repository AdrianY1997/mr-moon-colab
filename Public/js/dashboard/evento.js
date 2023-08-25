const itemsContainers = document.querySelectorAll(".dash-eventos-item-container");

const modals = {
    add: document.querySelector("#modal-add"),
    view: document.querySelector("#modal-view"),
    edit: document.querySelector("#modal-edit")
  };
  
  const addItemBtn = document.querySelector("#add-item");
  const closeModalBtns = document.querySelectorAll(".close-modal");
  const viewItemBtns = document.querySelectorAll(".view-item");
  const items = document.querySelectorAll(".item[data-href]");
  
  document.querySelectorAll(".form-label-group>input[type='number']").forEach(input => {
    input.addEventListener("keyup", () => {
      if (input.value < 1) {
        input.value = "";
      }
    });
  });
  
  addItemBtn.addEventListener("click", () => {
    modals.add.classList.add("show");
  });
  
  function updateViewModal(data) {
    const modalView = modals.view;
    modalView.querySelector("[data-even-name]").innerHTML = data.even_name;
    modalView.querySelector("[data-even-text]").innerHTML = data.even_text;
    modalView.querySelector("[data-even-fech]").innerHTML = data.even_fech;
    modalView.querySelector("[data-even-path]").innerHTML = data.even_path;
  }
  
  function updateEditModal(data)
  {
    const modalEdit = modals.edit;
    modalEdit.querySelector("#even-edit-name").value = data.even_name;
    modalEdit.querySelector("#even-edit-text").value = data.even_text;
    modalEdit.querySelector("#even-edit-fech").value = data.even_fech;
    modalEdit.querySelector("#even-edit-id").value = data.even_id;
  
    const editForm = modalEdit.querySelector("form");
    editForm.setAttribute("action", editForm.getAttribute("action").replace("{id}", data.even_id));
  }
  
  async function handleViewItemBtnClick(item) {
    const response = await fetch(item.getAttribute("data-href"));
  
    if (response.status !== 200) {
      console.error("Error fetching data:", response.statusText);
      return;
    }
  
    const data = await response.json();
    if (data && data.length > 0) {
      updateViewModal(data[0]);
      modals.view.classList.add("show");
    }
  }
  
  async function handleEditItemBtnClick(item) {
    const response = await fetch(item.getAttribute("data-href"));
  
    if (response.status !== 200) {
      console.error("Error fetching data:", response.statusInput);
      return;
    }
  
    const data = await response.json();
    if (data && data.length > 0) {
      updateEditModal(data[0]);
      modals.edit.classList.add("show");
    }
  }
  
  viewItemBtns.forEach(viewItemBtn => {
    viewItemBtn.addEventListener("click", () => handleViewItemBtnClick(viewItemBtn.parentElement.parentElement));
  });
  
  items.forEach(item => {
    const editItemBtn = item.querySelector(".edit-item");
    editItemBtn.addEventListener("click", () => handleEditItemBtnClick(editItemBtn.parentElement.parentElement));
  });
  
  closeModalBtns.forEach(closeModalBtn => {
    closeModalBtn.addEventListener("click", () => {
      for (const modal of Object.values(modals)) {
        modal.classList.remove("show");
      }
    });
  });
  
  

  itemsContainers.forEach(ic => {
      const form = ic.querySelector("form");
      const imgContainer = ic.querySelector("img");
      const imgField = ic.querySelector(".eventos-img")
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

