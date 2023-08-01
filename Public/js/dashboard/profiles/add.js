const container = document.querySelector(".dash-usuarios");

const addUserModal = document.querySelector("#add-user-modal")
const addUserBtn = container.querySelector("#add-user-btn");

const formAddUser = document.querySelector("#add-profile-form");
const formPrivInputs = addUserModal.querySelectorAll(".form-check>input");

formAddUser.addEventListener("submit", (e) => {
    e.preventDefault()
    e.stopPropagation()

    const data = new FormData(formAddUser)
    console.log(data)
})
