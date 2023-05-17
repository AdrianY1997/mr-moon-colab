const notify = (data) => {
    const notify = document.createElement("div")

    notify.classList.add("red-msg")
    notify.classList.add("container")
    notify.innerHTML = `
        <div class="${data.status}">
            <p class="m-0">
                ${data.text}
            </p>
            <p class="close m-0"><i class="fa-solid fa-times"></i></p>
        </div>
        `
    document.querySelector("#notifications").appendChild(notify)
    setTimeout(() => { notify.remove() }, 5000)
}

(() => {
    const toastLoader = document.querySelectorAll(".toast-loader")
    toastLoader.forEach(e => {
        e.style.setProperty("width", "100%");
    })

    setTimeout(() => {
        document.querySelector("button[data-bs-dismiss='toast']").click()
    }, 10000);
})()