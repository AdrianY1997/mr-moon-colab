
const payMethods = document.querySelectorAll("#payment-choises>p");
const paySelected = document.querySelector("#pay-selected");
const payImage = document.querySelector("#pay-img")
const payLogo = document.querySelector("#pay-logo")

const strt = {
    "NEQU": {
        "subt": "Escanee este codigo QR con su aplicación Nequi"
    },
    "AALM": "",
    "DVPT": "",
    "TPSE": "",
}

payMethods.forEach(method => {
    method.addEventListener("click", () => {
        payMethods.forEach(e => e.classList.remove("active"));
        method.classList.add("active");

        const m = method.getAttribute("data-method");
        const i = method.getAttribute("data-img");
        const l = method.getAttribute("data-logo");

        paySelected.innerHTML = method.innerHTML;
        payImage.setAttribute("src", i);
        payLogo.setAttribute("src", l)
    })
});