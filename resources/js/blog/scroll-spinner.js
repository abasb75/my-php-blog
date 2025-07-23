window.initialScrollSpinner = () => {
    var scrollSpinner = document.getElementById("scroll-spinner")
      , scrollSpinnerPrecent = document.getElementById("scroll-spinner-precent");
    if (scrollSpinner) {
        var scrolledTop = window.scrollY
          , totalScroll = document.body.scrollHeight;
        window.addEventListener("scroll", (function(e) {
            scrolledTop = window.scrollY,
            totalScroll = document.body.scrollHeight - window.innerHeight;
            var precent = scrolledTop / totalScroll * 100;
            scrollSpinnerPrecent.setAttribute("style", `width:${precent}%;`)
        }
        ))
    }
}

window.addEventListener('load',function(){
  initialScrollSpinner();
});
