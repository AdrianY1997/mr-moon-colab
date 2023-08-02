const eventos = document.querySelectorAll("[data-event-href]");

let response, data;

eventos.forEach(evento => {
    const url = evento.getAttribute("data-event-href");

    evento.addEventListener("click", async () => {
        response = await fetch(url);

        if (await checkFetchError(response)) {
            return;
        }

        data = (await response.json())[0];
        console.log(data)
    });
})