var mobileMenuButton = null;
var nav = null;
var navList = null;
window.addEventListener('load',function(){
    mobileMenuButton = document.getElementById('mobile-menu-button');
    nav = document.getElementById('nav-menu');
    navList = document.getElementById('nav-menu-list');

    mobileMenuButton.addEventListener('click',toggleMenu);
    nav.children[0].addEventListener('click',exitMenu);
});

function exitMenu(e){
    navList.classList.remove('show');
    setTimeout(()=>{
        nav.classList.remove('show');
    },300);
}

function toggleMenu(e){
    nav.classList.toggle('show');
    setTimeout(()=>{
        navList.classList.toggle('show');
    },1);
}