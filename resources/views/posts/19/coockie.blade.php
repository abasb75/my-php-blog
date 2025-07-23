<!DOCTYPE html>
<html lang="en" data-theme="<?php echo  isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'device' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme with Cookie</title>
    <style>
        :root {
            /* متغیرهای پایه (پیش‌فرض برای تم روشن) */
            --backgroundColor: #F1F1F1;
            --textColor: #3A3A3A;
        }

        /* تم تیره: فقط متغیرهای تغییرکرده */
        [data-theme="dark"] {
            --backgroundColor: #2C2C2C;
            --textColor: #E622B5;
        }

        /* تم دستگاه: وقتی سیستم روی تیره باشه */
        @media (prefers-color-scheme: dark) {
            [data-theme="device"] {
                --backgroundColor: #2C2C2C;
                --textColor: #E622B5;
            }
        }

        /* اعمال متغیرها به المنت‌ها */
        h1 {
            text-align: center;
        }

        body {
            background-color: var(--backgroundColor);
            color: var(--textColor);
        }

        #flex-div {
            width: 100%;
            height: 100vh;
            background-color: var(--backgroundColor);
            color: var(--textColor);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        button {
            background: #0896af;
            color: wheat;
            border-radius: 5px;
            outline: none;
            border: none;
            font-size: 1.3rem;
            padding: 12px 16px;
            cursor: pointer;
            transition: .3s all;
        }

        button:hover {
            background: #05798d;
        }

        [data-theme="dark"] button#dark-btn {
           opacity: 0.3;
           pointer-events: none;
        }

        [data-theme="light"] button#light-btn {
           opacity: 0.3;
           pointer-events: none;
        }

        [data-theme="device"] button#device-btn {
           opacity: 0.3;
           pointer-events: none;
        }
    </style>
</head>
<body>
    <div id="flex-div">
        <h1>Theme Color</h1>
        <div>
            <button id="device-btn" onclick="setTheme('device')">Device</button>
            <button id="light-btn" onclick="setTheme('light')">Light</button>
            <button id="dark-btn" onclick="setTheme('dark')">Dark</button>
        </div>
    </div>
    <script>

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function setCookie(name, value) {
            let expires = "";
            const date = new Date();
            date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function setTheme(theme) {
            document.documentElement.dataset.theme = theme;
            setCookie('theme', theme, 30); // ذخیره تم در کوکی برای 30 روز
        }

    </script>
</body>
</html>