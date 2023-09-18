const container = document.querySelector(".dash-usuarios");

const addUserModal = document.querySelector("#add-user-modal")
const addUserBtn = container.querySelector("#add-user-btn");

const formAddUser = document.querySelector("#add-profile-form");
const formPrivInputs = addUserModal.querySelectorAll(".form-check>input");

formAddUser.addEventListener("submit", async (e) => {
    e.preventDefault()
    e.stopPropagation()

    const data = new FormData(formAddUser)
    const tmpData = {}
    for (const e of data.entries()) {
        tmpData[e[0]] = e[1];
    }
    
    let response, responseData;

    response = await fetch(formAddUser.getAttribute("data-url"), {
        method: "post",
        body: JSON.stringify({ user: tmpData.nick, email: tmpData.email})
    });

    if (await checkFetchError(response, "No se pudo obtener la lista de usuarios")) return

    responseData = await response.json();
    
    if (responseData.isStored) {
        return notify({
            text: "El nombre o el correo del usuario ingresado ya se encuentra en la base de datos",
            status: "Alerta",
            bg: "bg-warning"
        });
    }
    
    console.log(tmpData);

    if (!tmpData.pass.match(/^(?=.*[A-Z])(?=.*\d).{8,16}$/)) {
        return notify({
            text: "La contraseña debe ser de entre 8 a 16 caracteres y tener mínimo 1 letra mayúscula",
            status: "Alerta",
            bg: "bg-warning"
        });
    }

    formAddUser.submit();
})
