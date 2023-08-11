const reseStatus = new bootstrap.Collapse('#reserve-status', { toggle: false });
const showReservation = new bootstrap.Modal('#reservation-modal', { keyboard: true });

const table = document.querySelector("table#reserves-table");
const hashes = document.querySelectorAll("[data-hash]");
const statusTitle = document.querySelector("#status-title")
const confirmPayment = document.querySelector("#confirm-payment")
const cancelPayment = document.querySelector("#cancel-payment")

const modalImage = document.querySelector("[data-reservation-image]");
const modalStatus = document.querySelector("[data-reservation-status]");
const modalUrid = document.querySelector("[data-reservation-urid]");
const modalDate = document.querySelector("[data-reservation-date]");
const modalName = document.querySelector("[data-reservation-name]");
const modalEmail = document.querySelector("[data-reservation-email]");
const modalQuantity = document.querySelector("[data-reservation-quantity]");
const modalTable = document.querySelector("[data-reservation-table]");
const modalDay = document.querySelector("[data-reservation-day]");
const modalTime = document.querySelector("[data-reservation-time]");
const modalDesc = document.querySelector("[data-reservation-description]");

function resetModal () {
    modalImage.src = "";
    modalDate.innerHTML = "";
    modalStatus.innerHTML = "";
    modalUrid.innerHTML = "";
    modalName.innerHTML = "";
    modalEmail.innerHTML = "";
    modalQuantity.innerHTML = "";
    modalTable.innerHTML = "";
    modalDay.innerHTML = "";
    modalDesc.innerHTML = "";
    modalTime.innerHTML = "";
    modalDesc.innerHTML = "";
}

async function viewReservation(e) {
    let response = await fetch(table.getAttribute("data-ref"), {
        method: "POST",
        body: JSON.stringify({all: true, urid: e.getAttribute("data-urid")})
    });

    if (await checkFetchError(response)) {
        return;
    };
    
    let data = (await response.json())[0];

    modalImage.src = modalImage.getAttribute("data-root") + "/" + data.rese_pay_img;
    modalDate.innerHTML = new Date(data.created_at).toLocaleString("default", { dateStyle: "long" });
    modalStatus.innerHTML = data.rese_status
    modalUrid.innerHTML = data.rese_urid;
    modalName.innerHTML = data.rese_name + " " + data.rese_lastname
    modalEmail.innerHTML = data.rese_email
    modalQuantity.innerHTML = data.rese_quantity
    modalTable.innerHTML = data.rese_table
    modalDay.innerHTML = new Date(data.rese_time + " 00:00:00").toLocaleString("default", { dateStyle: "long" });

    let time = data.rese_time;
    let textTime = time.split(":")[0] == "morning" ? " am" : " pm";
    modalTime.innerHTML = time.split(":")[1] + textTime;
    modalDesc.innerHTML = data.rese_details === "" ? "Sin comentario" : data.rese_details

    console.log(data.rese_status.toLowerCase() != "esperando confirmación")
    console.log(data.rese_status.toLowerCase() != "esperando pago");

    if (data.rese_status.toLowerCase() == "esperando confirmación") { 
        confirmPayment.classList.remove("disabled")
        cancelPayment.classList.remove("disabled")
    } else if (data.rese_status.toLowerCase() == "esperando pago") {
        confirmPayment.classList.remove("disabled")
        cancelPayment.classList.remove("disabled")
    } else {
        confirmPayment.classList.add("disabled")
        cancelPayment.classList.add("disabled")
    }
}

function deleteReservation(e) {
    return notify({
        text: "Esta función no se ha implementado aun.",
        status: "error",
        bg: "bg-danger"
    });
}

const getHash = () => {
    let h = window.location.hash.substring(1);
    if (!h) {
        return {};
    }

    let body = {};
    let sec = h.split("&");

    sec.forEach(s => {
        body[s.split("=")[0]] = s.split("=")[1]
    });
    return body;
}

const getData = async (body) => {
    const response = await fetch(table.getAttribute("data-ref"), {
        method: "POST",
        body: JSON.stringify(body)
    });

    const data = await response.json();

    if (data.length == 0) {
        table.querySelector("tbody").innerHTML = `
            <tr>
                <td colspan="3">No hay reservas</td>
            </tr>
        `;
        return;
    }
    table.querySelector("tbody").innerHTML = ""

    data.forEach(d => {

        let viewElement = document.createElement("span");
        viewElement.setAttribute("data-bs-toggle", "modal")
        viewElement.setAttribute("data-bs-target", "#reservation-modal")
        viewElement.innerHTML = `<i class="fa-solid fa-eye"></i>`
        viewElement.classList.add("view-reservation", "btn", "p-0", "px-2");

        let editElement = document.createElement("span");
        editElement.innerHTML = `<i class="fa-solid fa-edit"></i>`
        editElement.classList.add("edit-reservation", "btn", "p-0", "px-2");

        let deleteElement = document.createElement("span");
        deleteElement.innerHTML = `<i class="fa-solid fa-trash"></i>`
        deleteElement.classList.add("delete-reservation", "btn", "p-0", "px-2");

        let row = document.createElement("tr");
        row.setAttribute("data-urid", d.rese_urid);

        let urid = document.createElement("td");
        urid.innerHTML = d.rese_urid

        let status = document.createElement("td")
        status.innerHTML = d.rese_status;

        let actions = document.createElement("td")

        let pA = document.createElement("p")
        pA.classList.add("m-0")
        pA.appendChild(viewElement)
        // pA.appendChild(editElement)
        pA.appendChild(deleteElement);

        actions.appendChild(pA);

        row.appendChild(urid)
        row.appendChild(status)
        row.appendChild(actions)

        table.querySelector("tbody").appendChild(row);

        viewElement.addEventListener("click", () => viewReservation(row))

        // editElement.addEventListener("click", () => editReservation(row))

        deleteElement.addEventListener("click", () => deleteReservation(row))
    })
}

hashes.forEach((element) => {
    element.addEventListener("click", () => {
        let [btnKey, btnValue] = element.getAttribute("data-hash").split("=");

        let hash = window.location.hash ? window.location.hash.substring(1) : false;

        if (!hash) {
            window.location.hash = [btnKey, btnValue].join("=");
            statusTitle.innerHTML = element.querySelector("span:last-child").innerHTML;
            reseStatus.toggle();
            return;
        }

        let sections = hash.split("&");
        let newSections = [];

        let isInHash = false;

        sections.forEach(sec => {
            let [secKey, secValue] = sec.split("=");

            if (btnKey == secKey) {
                isInHash = true;
                secValue = btnValue;
                secKey = btnValue ? btnKey : ""
            }

            if (secKey && secValue) {
                newSections.push([secKey, secValue].join("="));
            }
        })

        if (!isInHash) {
            newSections.push([btnKey, btnValue].join("="))
        }

        hash = newSections.join("&");
        window.location.hash = hash;

        statusTitle.innerHTML = element.querySelector("span:last-child").innerHTML;
        reseStatus.toggle();
    })
});

confirmPayment.addEventListener("click", async () => {
    if (!confirm("Estas seguro que desea confirmar el pago?")) {
        return;
    }

    const urid = modalUrid.innerHTML;

    let response = await fetch(confirmPayment.getAttribute("data-href"), {
        method: "POST",
        body: JSON.stringify({ urid: urid })
    });

    if (await checkFetchError(response)) {
        return;
    }

    let data = await response.json();

    notify({
        text: data.text,
        status: "Correcto!",
        bg: "bg-success"
    });

    resetModal();
    showReservation.hide();
    document.querySelector(`[data-urid='${urid}']`).children[1].innerHTML = data.status;
});

cancelPayment.addEventListener("click", async () => {
    let detalles = prompt("Escriba el motivo por el que se cancelara la reserva");

    if (!detalles) {
        return;
    }

    const urid = modalUrid.innerHTML;

    let response = await fetch(cancelPayment.getAttribute("data-href"), {
        method: "POST",
        body: JSON.stringify({ 
            urid: urid,
            details: detalles
         })
    });

    if (await checkFetchError(response)) {
        return;
    }

    let data = await response.json();

    notify({
        text: data.text,
        status: "Correcto!",
        bg: "bg-success"
    });

    resetModal();
    showReservation.hide();
    document.querySelector(`[data-urid='${urid}']`).children[1].innerHTML = data.status;
});

window.addEventListener("hashchange", () => {
    getData(getHash());
});

(() => {
    getData(getHash());
})()