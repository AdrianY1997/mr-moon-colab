const main = document.querySelector('main');
const footer = document.querySelector('footer');

const notifyClose = document.querySelectorAll('.notify-close');
const notifyElement = document.querySelector('.notify');

function notifyFade() {
    const fadeFrames = [
        { opacity: 1 },
        { opacity: 0 }
    ];

    const fadeTiming = {
        duration: 500,
        iterations: 1,
    }

    notifyElement.animate(fadeFrames, fadeTiming);

    setTimeout(() => {
        notifyElement.remove()
    }, 500);
}

notifyClose.forEach(element => {
    element.addEventListener('click', () => {
        notifyFade()
    })
})

setTimeout(() => {
    notifyFade()
}, 5000);

window.addEventListener("load", () => {
    main.style.paddingBottom = footer.offsetHeight + "px";
});

window.addEventListener("resize", () => {
    main.style.paddingBottom = footer.offsetHeight + "px";
});