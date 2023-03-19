let main = document.querySelector("main")
let header = document.querySelector("header")
let footer = document.querySelector("footer")


window.addEventListener("resize", resizeMain);
resizeMain();

function resizeMain() {
    let h = "calc(100vh - 3.25rem - " + footer.clientHeight + "px)"

    console.log(h)

    main.style.minHeight = h
}