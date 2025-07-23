function goto(id){
    const element = document.getElementById(id);
    var top = element.getBoundingClientRect().top;
    var header = document.getElementById('main-header');
    var headerHeight = header.getBoundingClientRect().height;
    setTimeout(function(){
        window.scrollTo({
            top: top-headerHeight,
            behavior: 'smooth'
          });
    },15);
}

function gotoSection(e){
    e.preventDefault();
    var href = e.target.href;
    var id = href.split('#')[1];
    goto(id);
}
