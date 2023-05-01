function resizeMain() {
    const header = document.querySelector('header');
    const main = document.querySelector('main');
    const footer = document.querySelector('footer');

    let hnfHeight = header.clientHeight + footer.clientHeight;

    let minHeight = 'calc(100vh - ' + footer.clientHeight + 'px)';

    main.style.minHeight = minHeight;
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

resizeMain();