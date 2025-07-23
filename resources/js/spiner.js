window.bigSpiner = null;
window.addEventListener('DOMContentLoaded',function(){
    bigSpiner = document.getElementById('big-spiner');
    this.setTimeout(()=>{
        window.bigSpiner.classList.remove('show');
        bigSpiner.classList.remove('initial');
    },1000);
});

window.showSpiner = () => {
    bigSpiner.classList.add('show');
}

window.hideSpiner = () => {
    bigSpiner.classList.remove('show');
}