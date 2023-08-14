const email = document.querySelector("#recovery-email");
const code = document.querySelector("#recovery-code");

const sendCodeBtn = document.querySelector("#send-code-btn");
const sendCode = document.querySelector('#btn-recovery');
const sendCodeConfirm = document.querySelector('#btn-confirm');
const sendNewPass = document.querySelector('#btn-new-pass');

const newPass = document.querySelector('#new--pass');
const confirmPass = document.querySelector('#confirm-pass');

var recovery = document.querySelector('#recovery');
var recovery2 = document.querySelector('#recovery2');
var recovery3 = document.querySelector('#recovery3');

let response, data;

sendCodeBtn.addEventListener("click", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    const form = sendCodeBtn.parentElement.parentElement;

    response = await fetch(form.getAttribute("action"), {
        method: "POST",
        body: JSON.stringify({ email: email.value })
    })

    if (await checkFetchError(response)) return;

    data = await response.json();

    return notify({
        text: "Se ha enviado un correo con el código a " + email.value + ", codigo: " + data.code,
        status: "success",
        bg: "bg-success"
    })
})

sendCodeConfirm.addEventListener("click", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    const form = sendCodeConfirm.parentElement.parentElement;

    let response = await fetch(form.getAttribute("action"), {
        method: "POST",
        body: JSON.stringify({ email: email, code: code.value }),
    });

    if (await checkFetchError(response)) return;

    recovery2.classList.add("d-none");
    recovery3.classList.remove("d-none");
    
});

sendNewPass.addEventListener("click", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    const form = sendNewPass.parentElement.parentElement;

    let response = await fetch(form.getAttribute("action"), {
        method: "POST",
        body: JSON.stringify({ email: email, code: code.value }),
    });

    if (await checkFetchError(response)) return;

    // location.href = form.getAttribute('data-route');

});

sendCode.addEventListener("click", (e) => {
    recovery.classList.add("d-none");
    recovery2.classList.remove("d-none");
});
