var darkMode = null;
var DARK_MODE_STORAGE_KEY = 'DARK_MODE';
window.addEventListener('load',()=>{
    darkMode = document.getElementById('dark-mode');
    if(!darkMode){
        return;
    }
    var initialValue = readDarkModeValueFromStorage();
    if(initialValue){
        setDarkModeOn();
    }else{
        setDarkModeOff();
    }
    darkMode.addEventListener('click',toggleDarkMode);
});

function toggleDarkMode(){
    if(readDarkModeValueFromStorage()){
        setDarkModeOff();
    }else{
        setDarkModeOn();
    }
}

function setDarkModeOn(){
    darkMode.innerHTML = `<i class="icon-sun"></i>`;
    document.body.classList.add('dark');
    window.localStorage.setItem(DARK_MODE_STORAGE_KEY,'TRUE');
}

function setDarkModeOff(){
    darkMode.innerHTML = `<i class="icon-moon-o"></i>`;
    document.body.classList.remove('dark');
    window.localStorage.setItem(DARK_MODE_STORAGE_KEY,'FALSE');
}

function readDarkModeValueFromStorage(){
    var value = window.localStorage.getItem(DARK_MODE_STORAGE_KEY);
    if(!value){
        return true;
    }else if(value=="TRUE"){
        return true;
    }else{
        return false;
    }
}