const reserveTimeBtn = document.querySelector("#reserve-time-btn");
const reserveTimeContainer = document.querySelector("#reserve-time-container");
const timeCells = document.querySelectorAll(".time-cell");
const timeClean = document.querySelector("#time-clean");
const timeConfirm = document.querySelector("#time-confirm");
const timeInput = document.querySelector("#time");
const timeLabel = document.querySelector("#time-label");

const reserveDayInput = document.querySelector("#day");

const searchReservationBtn = document.querySelector("#search-reservation");
const uridInput = document.querySelector("#urid");

searchReservationBtn.addEventListener("click", () => {
    let action = searchReservationBtn.getAttribute("data-href").replace(":urid", uridInput.value);
    location.href = action;
})

reserveDayInput.addEventListener("change", async () => {
    reserveTimeBtn.setAttribute("data-bs-toggle", "collapse")
    let request = await fetch(reserveDayInput.getAttribute("data-href"), {
        method: "post",
        headers: {
            'content-type': 'application/json'
        },
        body: JSON.stringify({ day: reserveDayInput.value }),
    });

    let response = await request.text();
    response = JSON.parse(response);

    if (response.error) {
        notify({
            text: response.error,
            status: "error",
            bg: "bg-danger"
        })
    }

    response.result.forEach(e => {
        let [sec, time] = e.rese_time.split("-").map(e => e.trim());
        time = time.split(", ");
        const hours = document.querySelectorAll(`[data-day-section='${sec}']>div`);
        hours.forEach(h => {
            time.forEach(t => {
                if (t == h.innerHTML && e.rese_status == "RESERVADO") {
                    h.classList.add("reserved");
                }

                if (t == h.innerHTML && e.rese_status == "PENDIENTE") {
                    h.classList.add("pending");
                }
            })
        })
    })
})

let isSave = false;
let reserveTimeIsShow = false;

reserveTimeBtn.addEventListener("click", () => {
    if (!reserveDayInput.value) {
        notify({
            bg: "bg-primary",
            status: "Información",
            text: "Primero debe seleccionar un dia"
        })
        return;
    }
    reserveTimeIsShow = !reserveTimeIsShow;
    if (!reserveTimeIsShow) timeClean.click();
})

timeCells.forEach((timeCell, index) => {
    timeCell.addEventListener("click", () => {
        if (timeCell.classList.contains("active")) {
            timeCell.classList.remove("active");
            if (document.querySelectorAll(".time-cell.active").length == 0) {
                timeCells.forEach(e => {
                    e.classList.remove("active")
                    e.classList.remove("disabled")
                })
            }
            if (timeCells[index + 1] && timeCells[index + 1].classList.contains("active")) {
                timeCell.classList.add("disabled")
                if (timeCells[index + 2]) {
                    timeCells[index + 2].classList.remove("disabled")
                }
            }
            return
        }

        if (timeCell.classList.contains("disabled") || timeCell.classList.contains("reserved") || timeCell.classList.contains("pending") || document.querySelectorAll(".time-cell.active").length >= 2) return;

        timeCells.forEach(e => {
            if (!e.classList.contains("active")) e.classList.add("disabled")
        })

        timeCell.classList.remove("disabled");
        timeCell.classList.add("active");

        if (timeCells[index + 1] && document.querySelectorAll(".time-cell.active").length < 2 && timeCell.nextElementSibling) {
            timeCells[index + 1].classList.remove("disabled");
        }
    })
})

timeClean.addEventListener("click", () => {
    if (timeInput.value != "" && !reserveTimeIsShow) return;
    timeCells.forEach(e => {
        e.classList.remove("disabled");
        e.classList.remove("active");
    })
})

timeConfirm.addEventListener("click", () => {
    const actives = document.querySelectorAll(".time-cell.active");
    if (actives.length == 0) {
        timeInput.value = "";
        reserveTimeBtn.click();
        return;
    }

    let horas = [];
    actives.forEach(e => horas.push(e.innerHTML));
    horas = horas.join(", ");
    let daySection = actives[0].parentElement.getAttribute("data-day-section");
    let horasInput = daySection + ": " + horas;
    timeInput.value = horasInput;

    let timeText = {
        "morning": "Mañana",
        "afternoon": "Tarde",
        "night": "Noche",
    };

    reserveTimeBtn.innerHTML = `${timeText[daySection]} - ${horas}`;
    reserveTimeBtn.classList.add("form-control")
    timeLabel.classList.add("label-active")
    reserveTimeBtn.click();
})