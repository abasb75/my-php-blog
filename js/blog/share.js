function sharePost(){
    showShareModal();
}

function showShareModal(){
    var shareModal = document.getElementById('share-post');
    shareModal.style.display = 'block';
    setTimeout(function(){
        shareModal.classList.add('show');
    },1);
}

function closeShareModal(){
    var shareModal = document.getElementById('share-post');
    shareModal.classList.remove('show');
    setTimeout(function(){
        shareModal.style.display = 'none';
    },300);
}

function copyLink(){

    var copyButton = document.getElementById('share-copy-btn');
    var textForCopy = document.getElementById('shore-copy-text').innerText;
   
    if (navigator.clipboard != undefined) {//Chrome
        navigator.clipboard.writeText(textForCopy);
    }
    else if(window.clipboardData) { // Internet Explorer
        window.clipboardData.setData("Text", textForCopy);
    }

    copyButton.setAttribute("class","icon-check");
    setTimeout(()=>{
        copyButton.setAttribute("class","icon-copy");
    },3000);
}