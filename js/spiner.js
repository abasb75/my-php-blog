var bigSpiner = null;
window.addEventListener('DOMContentLoaded',function(){
    bigSpiner = document.getElementById('big-spiner');
    this.setTimeout(()=>{
        bigSpiner.classList.remove('show');
        bigSpiner.classList.remove('initial');
    },1000);
});

function showSpiner(){
    bigSpiner.classList.add('show');
}

function hideSpiner(){
    bigSpiner.classList.remove('show');
}