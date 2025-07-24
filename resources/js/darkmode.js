var darkMode = null;
var DARK_MODE_STORAGE_KEY = 'DARK_MODE';

window.addEventListener('load', () => {
    darkMode = document.getElementById('dark-mode');
    if (!darkMode) {
        return;
    }
    var initialValue = readDarkModeValueFromCookie();
    if (initialValue) {
        setDarkModeOn();
    } else {
        setDarkModeOff();
    }
    darkMode.addEventListener('click', toggleDarkMode);
});

function toggleDarkMode() {
    if (readDarkModeValueFromCookie()) {
        setDarkModeOff();
    } else {
        setDarkModeOn();
    }
}

function setDarkModeOn() {
    darkMode.innerHTML = `<i class="icon-sun"></i>`;
    document.body.classList.add('dark');
    setCookie(DARK_MODE_STORAGE_KEY, 'dark', 5*365);
}

function setDarkModeOff() {
    darkMode.innerHTML = `<i class="icon-moon-o"></i>`;
    document.body.classList.remove('dark');
    setCookie(DARK_MODE_STORAGE_KEY, 'light', 5*365);
}

function readDarkModeValueFromCookie() {
    var value = getCookie(DARK_MODE_STORAGE_KEY);
    return value === null || value === 'dark';
}

function setCookie(name, value, days) {
    var expires = '';
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + value + expires + '; path=/';
}

function getCookie(name) {
    var nameEQ = name + '=';
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}