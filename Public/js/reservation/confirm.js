const payMethods = document.querySelectorAll("#payment-choises>p");
const paySelected = document.querySelector("#pay-selected");
const payImage = document.querySelector("#pay-img");
const payLogo = document.querySelector("#pay-logo");
const payForm = document.querySelector("#pay-form")
const payInput = document.querySelector("#pay-input");
const payInputText = document.querySelector("#pay-input-text");
const paySub = document.querySelector("#pay-sub");

const strt = {
    "NEQU": {
        "subt": "Escanee este codigo QR<br>con su aplicación Nequi"
    },
    "AALM": {
        "subt": "Escanee este codigo QR<br>con su aplicación Ahorro a la mano"
    },
    "DVPT": {
        "subt": "Escanee este codigo QR<br>con su aplicación Daviplata"
    },
}

payMethods.forEach(method => {
    method.addEventListener("click", () => {
        const reseChoises = new bootstrap.Collapse('#payment-choises');

        payMethods.forEach(e => e.classList.remove("active"));
        method.classList.add("active");

        const m = method.getAttribute("data-method");
        const i = method.getAttribute("data-img");
        const l = method.getAttribute("data-logo");

        paySelected.innerHTML = method.innerHTML;

        payImage.animate([
            { opacity: "0" },
            { opacity: "1" }
        ], {
            duration: 200,
            iterations: 1
        })
        payImage.setAttribute("src", i);
        payLogo.setAttribute("src", l);
        paySub.innerHTML = strt[m].subt

        payForm.reset();
        payInputText.innerHTML = "Elejir archivo"
        reseChoises.hide();
    })
});

payInput.addEventListener("click", () => {
    payInput.querySelector("input").click();
})

payInput.querySelector("input").addEventListener("change", (e) => {
    payInputText.innerHTML = e.target.files[0].name
})

payForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    const url = payForm.getAttribute("action")
    const input = payInput.querySelector("input");

    if (input.files.length == 0) {
        notify({
            text: "Primero debes subir una imagen",
            status: "error",
            bg: "bg-danger"
        });
        return;
    }

    var str = input.files[0].name;
    var dotIndex = str.lastIndexOf('.');
    var ext = str.substring(dotIndex);

    if (![".jpeg", ".jpg", ".png"].includes(ext)) {
        notify({
            text: "La extensión de la imagen no esta soportada",
            status: "error",
            bg: "bg-danger"
        });
        return;
    }

    const data = new FormData();
    data.append("image", input.files[0])
    data.append("urid", document.querySelector("#pay-id-input").value)
    data.append("pay-selected", paySelected.innerHTML[0].toUpperCase() + paySelected.innerHTML.substring(1));
    
    const response = await fetch(url, {
        method: "POST",
        body: data
    })

    if (await checkFetchError(response)) {
        return;
    }
    location.reload();
})