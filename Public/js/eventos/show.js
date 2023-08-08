const showEventModal = new bootstrap.Modal('#show-event-modal', {
    keyboard: true
})

const eventos = document.querySelectorAll("[data-event-href]");
const eventModalClose = document.querySelector("#event-modal-close");

const eventImage = document.querySelector("[data-event-image]");
const eventTitle = document.querySelector("[data-event-title]");
const eventDetails = document.querySelector("[data-event-details]");
const eventDate = document.querySelector("[data-event-date]");
const eventTime = document.querySelector("[data-event-time]");
const eventDescription = document.querySelector("[data-event-description]");

let response, data;

eventModalClose.addEventListener("click", () => {
    showEventModal.hide();
})

eventos.forEach(evento => {
    const url = evento.getAttribute("data-event-href");

    evento.addEventListener("click", async () => {
        response = await fetch(url);

        if (await checkFetchError(response)) {
            return;
        }

        data = (await response.json())[0];
        
        const [date, time] = data.even_fech.split(" ");

        eventImage.setAttribute("src", "Public/" + data.even_path);
        eventTitle.innerHTML = data.even_name;
        eventDate.innerHTML = new Date(date).toLocaleString("default", { dateStyle: "long" });

        eventTime.innerHTML = time;
        eventDescription.innerHTML = data.even_text;
        showEventModal.show();
    });
})