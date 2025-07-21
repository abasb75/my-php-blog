function initialGoTop() {
    var goTopButton = document.getElementById("go-top");
    if (goTopButton) {
        var windowWidth = window.innerWidth
          , windowHeight = window.innerHeight
          , left = 10
          , bottom = 10;
        windowWidth > 1100 ? (left = (windowWidth - 900) / 2 - 100,
        bottom = 50) : windowWidth > 800 && (left = 50,
        bottom = 50),
        goTopButton.setAttribute("style", "left:" + left + "px;");
        var scrolledTop = window.scrollY;
        window.addEventListener("resize", (function(e) {
            windowHeight = window.innerHeight,
            windowWidth = window.innerWidth,
            left = 10,
            bottom = 10,
            windowWidth > 1100 ? (left = (windowWidth - 900) / 2 - 100,
            bottom = 50) : windowWidth > 800 && (left = 50,
            bottom = 50),
            (scrolledTop = window.scrollY) < 300 ? goTopButton.setAttribute("style", "left:" + left + "px;bottom:-100px;") : scrolledTop > 300 && goTopButton.setAttribute("style", "left:" + left + "px;bottom:" + bottom + "px;")
        }
        )),
        window.addEventListener("scroll", (function(e) {
            windowWidth = window.innerWidth,
            windowHeight = window.innerHeight,
            (scrolledTop = window.scrollY) < 300 ? goTopButton.setAttribute("style", "left:" + left + "px;bottom:-100px;") : scrolledTop > 300 && goTopButton.setAttribute("style", "left:" + left + "px;bottom:" + bottom + "px;")
        }
        )),
        goTopButton.addEventListener("click", (function(e) {
            e.preventDefault(),
            window.scroll({
                behavior: "smooth",
                top: 0
            })
        }
        ))
    }
}

window.addEventListener('load',initialGoTop); 