function enableZoomOnPostImage(){
    var images1 = document.querySelectorAll('.post_image');
    var images2 = document.querySelectorAll('.post-image');

    for(var i=0;i<images1.length;i++){
        var image = images1[i];
        image.addEventListener('click',function(e){
            var element = e.target;
            while(!element.classList.contains('post_image')){
                element = element.parentElement;
            }
            console.log(element);
            element.classList.toggle('zoom');
        });
    }
}

window.addEventListener('load',enableZoomOnPostImage);