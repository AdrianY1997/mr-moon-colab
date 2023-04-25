const sendCodeBtn = document.querySelector("#send-code-btn");

const notify = (data, status) => {
    let text;
    const notify = document.createElement("div")
    notify.classList.add("red-msg")
    notify.classList.add("container")
    switch (data.code) {
        case 1:
            text = "Se ha enviado un código de recuperación a " + data.email + ": " + data.data;
            break;
        case 2: text = "El email ingresado no es valido";
            break;
        case 3: text = "Ha ocurrido un error, contacte con administración"
            break;
    }
    notify.innerHTML = `
        <div class="${status}">
            <p>
                ${text}
            </p>
            <p class="close"><i class="fa-solid fa-times"></i></p>
        </div>
        `
    document.body.appendChild(notify)
    setTimeout(() => { notify.remove() }, 5000)
}

sendCodeBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const form = sendCodeBtn.parentElement.parentElement;
    const email = sendCodeBtn.previousElementSibling.value

    const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!emailRegex.exec(email)) return notify({ code: 2 }, "error");

    $.ajax({
        url: form.getAttribute("action"),
        type: "post",
        data: {
            email: email
        },
        dataType: "text",
        success: function (data) {
            notify({ code: 1, data: data, email: email }, "success")
        },
        error: function (data) {
            notify({ code: 2 }, "error");
        }
    });
    return true;
})