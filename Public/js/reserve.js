const reserveTimeBtn = document.querySelector("#reserve-time-btn");
const reserveTimeContainer = document.querySelector("#reserve-time-container");
const timeCells = document.querySelectorAll(".time-cell");
const timeClean = document.querySelector("#time-clean");
const timeConfirm = document.querySelector("#time-confirm");
const timeInput = document.querySelector("#time");
const timeLabel = document.querySelector("#time-label")

let isSave = false;
let reserveTimeIsShow = false;

reserveTimeBtn.addEventListener("click", () => {
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
        if (timeCell.classList.contains("disabled") || document.querySelectorAll(".time-cell.active").length >= 2) return;

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
    let horasText;
    let daySection = actives[0].parentElement.getAttribute("data-day-section");
    let horasInput = daySection + ": " + horas;
    timeInput.value = horasInput;

    switch (daySection) {
        case "morning":
            horasText = "Mañana: " + horas + " am"
            break;
        case "afternoon":
            horasText = "Tarde: " + horas + " pm"
            break;
        case "night":
            horasText = "Noche: " + horas + " pm"
            break;
    }

    reserveTimeBtn.innerHTML = horasText;
    reserveTimeBtn.classList.add("form-control")
    timeLabel.classList.add("label-active")
    reserveTimeBtn.click();
})