const email = document.querySelector("#recovery-email").value;
const code = document.querySelector("#recovery-code").value;

const sendCodeBtn = document.querySelector("#send-code-btn");
const sendCode = document.querySelector('#btn-recovery');
const sendCodeConfirm = document.querySelector('#btn-confirm');

var recovery = document.querySelector('#recovery');
var recovery2 = document.querySelector('#recovery2');
var recovery3 = document.querySelector('#recovery3');

sendCodeConfirm.addEventListener("click", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    const form = sendCodeConfirm.parentElement.parentElement;
    const url = form.getAttribute("action");

    let response = await fetch(url, {
        method: "POST",
        headers: {
            'content-type': 'application/json'
        },
        body: JSON.stringify({ email: email, code: code }),
    });

    response = await response.text();
    console.log(JSON.parse(response));
})

sendCode.addEventListener("click", (e) => {
    recovery.classList.add("d-none");
    recovery2.classList.remove("d-none");
});

sendCodeBtn.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();

    const form = sendCodeBtn.parentElement.parentElement;

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
                    text: response.error,
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