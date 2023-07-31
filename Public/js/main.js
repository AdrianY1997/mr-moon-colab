const header = document.querySelector("header");
const navBtn = document.querySelectorAll("[data-group='nav']");
const fotBtn = document.querySelector("[data-function='toggle-footer']");
const footer = document.querySelector(".complete-footer");
const crBtn = document.querySelectorAll("[data-function='carousel-btn']");
const dots = document.querySelectorAll(".dots>*");
const images = document.querySelectorAll(".carousel .image");
const carousel = document.querySelector(".menu .carousel");

const dshMenuContent = document.querySelector(".dash-menu");
const dshMenuItems = document.querySelector(".dash-menu .items");
const dshMenuBtn = document.querySelector(".dash-menu .icon")
const dshMenuIcons = document.querySelectorAll(".dash-menu .icon span");

const closemsg = document.querySelectorAll(".red-msg .close");

let carouselInterval
let footerIsShow = false

document.addEventListener("scroll", e => {
    if (scrollY > 0)
        header.style.background = "black"
    else
        header.style.background = "";
})

navBtn.forEach(e => {
    if (e.getAttribute("data-type") === "button")
        e.onclick = () => toggleNav();
})

fotBtn.addEventListener("click", (e) => {
    footer.classList.toggle("hide")

    if (footerIsShow)
        fotBtn.firstChild.style.transform = "rotate(0deg)"
    else
        fotBtn.firstChild.style.transform = "rotate(180deg)"

    footerIsShow = !footerIsShow
    return null;
})

crBtn.forEach((btn) => {
    return btn.addEventListener("click", event => {
        toggleCarouselItem(btn);
    })
})

if (dshMenuBtn) {
    dshMenuBtn.addEventListener("click", e => {
        dshMenuIcons.forEach(i => {
            i.classList.toggle("d-none")
        })

        dshMenuContent.classList.toggle("hide")
        dshMenuContent.classList.toggle("show")

        dshMenuItems.classList.toggle("hide")
        dshMenuItems.classList.toggle("show")
    })
}

if (closemsg) {
    closemsg.forEach(e => {
        e.addEventListener("click", event => { closeMessages(e) })
        setTimeout(() => { closeMessages(e) }, 5000);
    })
}

// functions

function toggleNav() {
    navBtn.forEach(e => e.classList.toggle("d-none"))

    return 0;
}

function toggleCarouselItem(element) {
    let type = element.getAttribute("data-type")
    let param = element.getAttribute("data-param")

    switch (type) {
        case "slider": return carouselToRight()
        case "ebtn": return carouseTogleActive(param);
    }

    return null;
}

function carouseTogleActive(pos) {
    for (let i = 0; i < 3; i++) {
        dots[i].classList.remove("active")
        images[i].classList.remove("active")
    }
    dots[pos].classList.add("active")
    images[pos].classList.add("active")

    return null
}

function carouselToRight() {
    let pos;
    dots.forEach((dot) => {
        if (dot.classList.contains("active"))
            return pos = dot.getAttribute("data-param")
    })
    pos = pos == 2 ? 0 : parseInt(pos) + 1;

    return carouseTogleActive(pos);
}

function initCarouselInterval() {
    carouselInterval = setInterval(() => {
        carouselToRight();
        console.log("tick")
    }, 5000);
}

function pauseCarouselInterval() {
    return clearInterval(carouselInterval);
}

function closeMessages(e) {
    const container = e.parentElement.parentElement

    container.style.opacity = 0
    setTimeout(() => {
        container.remove()
    }, 500);

    document.cookie = "messages=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

if (carousel)
    initCarouselInterval();