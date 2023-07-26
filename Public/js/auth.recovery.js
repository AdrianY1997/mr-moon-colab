const sendCodeBtn = document.querySelector("#send-code-btn");
const sendCode = document.querySelector('#btn-recovery');
const sendCodeConfirm = document.querySelector('#btn-confirm');

var recovery = document.querySelector('#recovery');
var recovery2 = document.querySelector('#recovery2');
var recovery3 = document.querySelector('#recovery3');

sendCodeConfirm.addEventListener("click", (e) => {
    e.preventDefault();

})

sendCode.addEventListener("click", (e) => {

    recovery.classList.add("d-none");
    recovery2.classList.remove("d-none");

});

sendCodeBtn.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();

    const form = sendCodeBtn.parentElement.parentElement;
    const email = document.querySelector("#recovery-email").value;

    $.ajax({
        url: form.getAttribute("action"),
        type: "post",
        data: {
            email: email
        },
        dataType: "text",
        success: function (response) {
            response = JSON.parse(response);
            if (response.error) {
                notify({
                    text: "El email ingresado es invalido",
                    status: "error",
                    bg: "bg-danger"
                });
            } else {
                notify({
                    text: "Se ha enviado un correo con el código a " + email + ", codigo: " + response.code,
                    status: "success",
                    bg: "bg-success"
                })
            }
        },
        error: function () {
            notify({
                text: "Ha ocurrido un error al ejecutar esta acción, inténtelo de nuevo o contacte al administrador",
                status: "error",
                bg: "bg-danger"
            })
        }
    });
    return true;
})