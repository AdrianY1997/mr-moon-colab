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