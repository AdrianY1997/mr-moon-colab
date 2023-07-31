const dshInfoBtn = document.querySelectorAll(".dash-info .sections p");
const dshInfoSec = document.querySelectorAll(".dash-info .get-info, .dash-info .set-info");

dshInfoBtn.forEach(e => {
    e.addEventListener("click", event => {
        const section = e.getAttribute("data-section");

        dshInfoBtn.forEach(element => { element.classList.remove("active") })
        e.classList.add("active")

        dshInfoSec.forEach(element => {
            element.classList.remove("show");
            element.classList.add("hide");
        })

        dshInfoSec[section].classList.remove("hide");
        dshInfoSec[section].classList.add("show");
    })
})