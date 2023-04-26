const sendCodeBtn = document.querySelector("#send-code-btn");

sendCodeBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const form = sendCodeBtn.parentElement.parentElement;
    const email = sendCodeBtn.previousElementSibling.value

    const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!emailRegex.exec(email)) return notify({
        text: "El email ingresado es invalido",
        status: "error"
    });

    $.ajax({
        url: form.getAttribute("action"),
        type: "post",
        data: {
            email: email
        },
        dataType: "text",
        success: function () {
            notify({
                text: "Se ha enviado un correo con el código a " + email,
                status: "success"
            })
        },
        error: function () {
            notify({
                text: "Ha ocurrido un error al ejecutar esta acción, inténtelo de nuevo o contacte al administrador",
                status: "error"
            })
        }
    });
    return true;
})