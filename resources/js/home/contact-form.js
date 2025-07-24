const contactFormSubmit = () => {
    const contactFormSubmitBtn = document.getElementById('contact-form-submit');
    if(contactFormSubmitBtn){
        contactFormSubmitBtn.addEventListener('click',uploadMessage);
    }
}

window.addEventListener('load',window.contactFormSubmit);

const formReset = (e) => {
    document.getElementById('name-input').value = "";
    document.getElementById('contact-way-input').value = "";
    document.getElementById('message-input').value = "";
}

const uploadMessage = (e) => {
    e.preventDefault();
    var name = document.getElementById('name-input').value;
    var contactWay = document.getElementById('contact-way-input').value;
    var message = document.getElementById('message-input').value;
    if(!name || !contactWay || !message){
        iziToast.error({
            theme: 'dark',
            position:'topCenter',
            title: 'لطفا موارد خواسته شده را تکمیل فرمایید',
            backgroundColor:'#ed4337',
        });
        return;
    }
    showSpiner();
    var formData = new FormData();
    formData.append('name',name);
    formData.append('contact-way',contactWay);
    formData.append('message',message);

    var xhttp = new XMLHttpRequest();
    xhttp.onerror = function(e){
        hideSpiner()
        iziToast.error({
            theme: 'dark',
            position:'topCenter',
            title: 'ارسال درخواست با مشکل مواجه گردید',
            backgroundColor:'#ed4337',
        });
    }

    xhttp.onload = function(e){
        hideSpiner()
        try{
            var res = e.target.response;
            res = JSON.parse(res);
            if(res.result){
                formReset();
                iziToast.success({
                    theme: 'dark',
                    position:'topCenter',
                    title: res.message,
                    backgroundColor:'#2e7d32',
                });
            }else{
                iziToast.error({
                    theme: 'dark',
                    position:'topCenter',
                    title: res.message,
                    backgroundColor:'#ed4337',
                });
            }
        }catch{
            iziToast.error({
                theme: 'dark',
                position:'topCenter',
                title: 'ارسال درخواست با مشکل مواجه گردید',
                backgroundColor:'#ed4337',
            });
        }
    }

    xhttp.open('POST','/api/message/add',true);
    xhttp.send(formData);
}

export {
    contactFormSubmit,
    formReset,
    uploadMessage,
}