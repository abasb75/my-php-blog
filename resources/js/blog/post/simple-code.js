window.highlightCodes = () => {
    // const codes = document.querySelectorAll('pre > code');
    // codes.forEach((code)=>{
    //     code.classList.add(code.parentElement.getAttribute('class'));
    // })
    hljs.highlightAll();
    console.log('highlightCodes');
    var simpleCodes = document.querySelectorAll("textarea.code");
    console.log(simpleCodes);
    for(var i=0;i<simpleCodes.length;i++){
        var code = simpleCodes[i];
        code.style.height = (code.scrollHeight+20)+'px';
    }
}

window.addEventListener('load',highlightCodes);