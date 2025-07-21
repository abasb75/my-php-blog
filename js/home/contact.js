function copytoclip(el){
    var text_copy = el.parentElement.children[1].children[0].getAttribute('href');
    text_copy = text_copy.replace('tel:','');
    text_copy = text_copy.replace('mailto:','');
    if (navigator.clipboard != undefined) {//Chrome
        navigator.clipboard.writeText(text_copy);
    }
    else if(window.clipboardData) { // Internet Explorer
        window.clipboardData.setData("Text", text_copy);
    }
    console.log(text_copy);
    iziToast.success({
        theme: 'dark',
        position:'topCenter',
        title: 'کپی شد',
        backgroundColor:'#2e7d32',
        message: text_copy
    });

}