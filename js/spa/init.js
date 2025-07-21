var xmlHttp;

function init(){
    var anchors = document.querySelectorAll('a');
    for(var i=0;i<anchors.length;i++){
        anchors[i].addEventListener('click',anchorClick)
    }
}

function anchorClick(e){
    e.preventDefault();
    var targetAnchor = e.target;
    while(targetAnchor.tagName!="A"){
        targetAnchor = targetAnchor.parentElement;
    }
    var href = targetAnchor.href;
    if(href==location.href){
        return;
    }
    var url = getDomainName();
    var path = href.replace(url,"");
    var regex = /^https?\:\/\/(abasbagheri\.ir|abasbagheri|localhost)/;
    if(path=="/rss"){
        externalLink(href);
    }else if(/^\/#[a-zA-Z0-9_\-]+$/.exec(path)){
        statementLinks(path);
    }else if(/^\/asset\//.exec(path)){
        externalLink(href);
    }else if(regex.exec(href)){
        internalLink(href);
    }else{
        externalLink(href);
    }
}

function statementLinks(href){
    
}

function internalLink(href){
    var response = doAjax(href);
}

function doAjax(href){
    if(xmlHttp){
        xmlHttp.abort();
    }
    if(exitMenu){
        exitMenu();
    }
    showSpiner();
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open('GET',href,true);
    xmlHttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xmlHttp.addEventListener('load',function(e){
        try{
            var data = JSON.parse(this.responseText);
            if(data.result){
                document.getElementById('page').innerHTML = data.page;
                document.title = data.title;
                setTimeout(()=>{
                    hideSpiner();
                    init();
                    windowLoadEvents();
                    var url = getDomainName();
                    var path = href.replace(url,"");
                    if(href != location.href){
                        window.history.pushState({},'',path);
                        window.scroll({
                            behavior: "smooth",
                            top: 0
                        })
                    }
                },1000);
            }
        }catch{
            hideSpiner();
            iziToast && iziToast.error({
                theme: 'dark',
                position:'topCenter',
                title: 'مشکلی در اتصال رخ داد', 
                backgroundColor:'#ed4337',
            });
            window.location = href;
        }
    });
    xmlHttp.onerror = function(){
        hideSpiner();
        iziToast && iziToast.error({
            theme: 'dark',
            position:'topCenter',
            title: 'مشکلی در اتصال رخ داد', 
            backgroundColor:'#ed4337',
        });
        window.location = href;
    }

    xmlHttp.send();
}


function externalLink(href){
    window.open(href,"_blank");
}

function popstate(e){
    var href = location.href;
    var regex = /^https?\:\/\/(abasbagheri\.ir|abasbagheri|localhost)/;
    if(/\/rss$/.exec(href)){
        externalLink(href);
    }else if(regex.exec(href)){
        internalLink(href)
    }else{
        externalLink(href);
    }
}

function getDomainName(){
    var protocol = window.location.protocol;
    var hostname = window.location.hostname;
    return protocol+"//"+hostname;
}

function windowLoadEvents(){
    runParticleJS && runParticleJS();
    initialScrollSpinner && initialScrollSpinner();
    initialGoTop && initialGoTop();
    enableZoomOnPostImage && enableZoomOnPostImage();
    highlightCodes && highlightCodes();
    contactFormSubmit && contactFormSubmit();
}

if(window.addEventListener && window.history && window.history.pushState){
    window.addEventListener('load',init);
    window.addEventListener('popstate',popstate)
}
