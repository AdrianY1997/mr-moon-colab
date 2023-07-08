function initTogglers() {
    const togglers = document.querySelectorAll("[data-dropdown-toggle]");
    
    togglers.forEach(t => {
        t.addEventListener("click", () => {
            let target = t.getAttribute("data-dropdown-toggle");
            target = document.querySelector(`#${target}`);
            let animDir = target.getAttribute("data-animation-direction");

            if (target.classList.contains("hidden")) {
                target.classList.remove("hidden");
                setTimeout(() => {
                    switch (animDir) {
                        case "from-top":
                            target.classList.remove("max-h-0");
                            target.classList.add("max-h-10");
                            break;
                    }
                }, 10);
            } else {
                switch (animDir) {
                    case "from-top":
                        target.classList.add("max-h-0");
                        target.classList.remove("max-h-10");
                        break;
                }
                setTimeout(() => target.classList.add("hidden"), 200)
            }
        })
    });
}

function resizeMain() {
    let main = document.querySelector('main');
    let header = document.querySelector('header');
    let footer = document.querySelector('footer');

    let size = header.clientHeight + footer.clientHeight;

    main.style.minHeight = 'calc(100vh - ' + size + 'px)';
}

function errorResize() {
    let errorPageContent = document.querySelector('[data-foxy-element="error-page-content"]');
    let errorPageSvg = document.querySelector('[data-foxy-element="error-page-svg"]')
    let media = window.matchMedia('(max-width: 700px)');
    if (!errorPageContent) return

    console.log(media)

    if (media.matches) {
        errorPageContent.classList.remove('is-flex');
        errorPageSvg.classList.add('is-absolute');
        errorPageSvg.classList.add('is-full-width');
        errorPageSvg.classList.add('is-full-height');
        errorPageSvg.classList.add('overflow-hidden');
        errorPageSvg.classList.add('z-index-1n');
        errorPageSvg.classList.add('opacity-quarter')
    } else {
        errorPageContent.classList.add('is-flex');
        errorPageSvg.classList.remove('is-absolute');
        errorPageSvg.classList.remove('is-full-width');
        errorPageSvg.classList.remove('is-full-height');
        errorPageSvg.classList.remove('overflow-hidden');
        errorPageSvg.classList.remove('z-index-1n');
        errorPageSvg.classList.remove('opacity-quarter')
    }
}

window.addEventListener('resize', () => {
    resizeMain();
    errorResize();
});

(() => {
    initTogglers();
    resizeMain();
})()
