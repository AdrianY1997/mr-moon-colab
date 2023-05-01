const contenedores = document.querySelectorAll(".auth.recovery .container")
const sendCode = document.querySelector (".auth.recovery .send-code")

sendCode.addEventListener("click", (e) => {
    contenedores.forEach((contenedor)=>{
        contenedor.classList.add("d-none")
    })
    contenedores[1].classList.remove("d-none")
})