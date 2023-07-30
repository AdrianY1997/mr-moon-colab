const TIME = 10000;

const notify = (data) => {
    const id = (new Date()).getMilliseconds();

    const notify = document.createElement("div")
    notify.classList.add("toast-container", "position-fixed", "bottom-0", "end-0", "p-3");
    notify.innerHTML = `
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header ${data.bg} text-white" style="margin-bottom: -3px;">
                <i class="fa-solid fa-check-circle"></i>
                <strong class="me-auto ms-2">${data.status}</strong>
                <small>now</small>
                <button type="button" class="btn p-0 m-0 ps-2" data-bs-dismiss="toast" aria-label="Close"><i class="fa-solid fa-times text-white"></i></button>
            </div>
            <div class="toast-loader bg-white notification-loader"></div>
            <div class="toast-body">
                ${data.text}
            </div>
        </div>
        `
    document.querySelector("#notifications").appendChild(notify)
    setTimeout(() => {
        document.querySelector("button[data-bs-dismiss='toast']").click()
    }, TIME + 1000);
}

const checkFetchError = async (response) => {
    if (response.status != 200) {
        notify({
            text: await response.text(),
            status: "error",
            bg: "bg-danger"
        });
        return true;
    }

    return false;
}

(() => {
    const toastLoader = document.querySelectorAll(".toast-loader")
    setTimeout(() => {
        const toastClose = document.querySelector("button[data-bs-dismiss='toast']")
        if (toastClose) {
            toastClose.click()
        }
    }, TIME);
})()