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
    modalEdit.querySelector("#even-edit-path").value = data.even_path;
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

const itemsContainers = document.querySelectorAll(".dash-Events-item-container");


document.addEventListener("DOMContentLoaded", function() {
    const itemsContainers = document.querySelectorAll(".item-container");

    itemsContainers.forEach(ic => {
        const form = ic.querySelector("form");
        const imgContainer = ic.querySelector("img");
        const imgField = ic.querySelector(".Events-img");
        const uploadImg = ic.querySelector(".upload-img");
        const saveImg = ic.querySelector(".save-img");

        imgField.addEventListener("change", () => {
            if (imgField.value) saveImg.removeAttribute("disabled");
            const reader = new FileReader();
            reader.addEventListener("load", (events) => {
                imgContainer.src = events.target.result;
            });
            reader.readAsDataURL(imgField.files[0]);
        });

        uploadImg.addEventListener("click", () => imgField.click());
        saveImg.addEventListener("click", () => form.submit());
    });
});

