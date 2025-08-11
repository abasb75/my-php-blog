import { contactFormSubmit } from "../home/contact-form";
import iziToast from "izitoast";

var xmlHttp;

window.init = () => {
    const anchors = document.querySelectorAll('a[ajax]');
    for(var i=0;i<anchors.length;i++){
        anchors[i].addEventListener('click',anchorClick)
    }
}

window.anchorClick = (e) => {
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
    internalLink(href);
}

window.statementLinks = (href) => {
    
}

window.internalLink = (href) => {
    var response = doAjax(href);
}

window.doAjax = (href) => {
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
                    setTimeout(()=>{
                        hideSpiner();
                    },1000)
                },1);
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


window.externalLink = (href) => {
    window.open(href,"_blank");
}

window.popstate = (e)=>{
    var href = location.href;
    var regex = /^https?\:\/\/(abasbagheri\.ir|abasbagheri|localhost|\/)/;
    if(/\/rss$/.exec(href)){
        externalLink(href);
    }else if(regex.exec(href)){
        internalLink(href)
    }else{
        externalLink(href);
    }
}

window.getDomainName = () => {
    var protocol = window.location.protocol;
    var hostname = window.location.host;
    return protocol+"//"+hostname;
}

window.windowLoadEvents = () => {
    console.log('xxx');
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
