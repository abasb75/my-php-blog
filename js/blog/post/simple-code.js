window.addEventListener('load',highlightCodes);

function highlightCodes(){
    hljs.highlightAll();
    var simpleCodes = document.querySelectorAll("textarea.code");
    console.log(simpleCodes);
    for(var i=0;i<simpleCodes.length;i++){
        var code = simpleCodes[i];
        code.style.height = (code.scrollHeight+20)+'px';
    }
}