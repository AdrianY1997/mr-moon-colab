const notify = (data) => {
    const notify = document.createElement("div")

    notify.classList.add("red-msg")
    notify.classList.add("container")
    notify.innerHTML = `
        <div class="${data.status}">
            <p>
                ${data.text}
            </p>
            <p class="close"><i class="fa-solid fa-times"></i></p>
        </div>
        `
    document.body.appendChild(notify)
    setTimeout(() => { notify.remove() }, 5000)
}