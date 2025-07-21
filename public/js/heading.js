var headingTitle = null;
var headingTitleImage = null;

window.addEventListener('scroll',function(e){
    var scrollY = window.scrollY;
    if(scrollY<230){
        headingTitle = document.getElementById('header-title');
        headingTitleImage = this.document.getElementById('header-title-image');
        if(headingTitle){
            headingTitle.style.filter = "blur("+(scrollY/30)+"px)";
            headingTitleImage.style.transform = "scale("+(1+(scrollY/1000))+")";
        }
        
    }
});

window.addEventListener('load',function(){
    
});