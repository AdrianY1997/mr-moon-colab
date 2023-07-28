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
        body: JSON.stringify({ email: email, code: code }),
    });

    response = await response.text();
    console.log(JSON.parse(response));
})

sendCode.addEventListener("click", (e) => {
    recovery.classList.add("d-none");
    recovery2.classList.remove("d-none");
});

sendCodeBtn.addEventListener("click", async (e) => {
    e.preventDefault();
    e.stopPropagation();
    const form = sendCodeBtn.parentElement.parentElement;
    const email = form.querySelector("#recovery-email").value;

    const response = await fetch(form.getAttribute("action"), {
        method: "POST",
        body: JSON.stringify({ email: email })
    })

    if (response.status != 200) {
        return notify({
            text: await response.text(),
            status: "error",
            bg: "bg-danger"
        });
    }

    const data = await response.json();

    return notify({
        text: "Se ha enviado un correo con el código a " + email + ", codigo: " + data.code,
        status: "success",
        bg: "bg-success"
    })
})