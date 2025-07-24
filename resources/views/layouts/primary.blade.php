<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=5.0">
        <meta name="subject" content="Personal Web Developer">
        <meta name="copyright" content="Abas Bagheri">
        <meta name="language" content="FA">
        <meta name="Classification" content="Business">
        <meta name="author" content="Abbas Bagheri, abasbagheria@gmail.com">
        <meta name="url" content="https://abasbagheri.ir/">
        <meta name="subtitle" content="برنامه نویس و طراحی وب سایت">
        <meta name="target" content="all">
        <meta name="revised" content="Sunday, July 29th, 2022, 5:15 pm">
        <meta name="identifier-URL" content="https://abasbagheri.ir">
        <meta name="google-site-verification" content="WRx4dyxLMr0lZzfwVv_lNEimc6Q4cu5V12fKX0fubTo">
        <meta name="designer" content="عباس باقری">
        <meta name="reply-to" content="abasbagheria@gmail.com">
        <meta name="owner" content="عباس باقری">

        <meta name="pagename" content={{ $title ?? 'وب سایت شخصی عباس باقری' }}>

        <meta name="category" content="Web Developer">
        <meta name="coverage" content="Worldwide">
        <meta name="distribution" content="Global">
        <meta name="rating" content="General">
        <meta name="robots" content="follow, index">

        <meta name="title" content="{{ $title ?? 'وب سایت شخصی عباس باقری' }}">
        <meta name="description" content="{{ $description ?? 'وب سایت شخصی عباس باقری، مهندس نرم افزار و برنامه نویس ارشد وب سایت' }}">

        <meta name="apple-mobile-web-app-capable" content="yes">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://abasbagheri.ir/">
        <meta property="og:title" content="{{ $title ?? 'وب سایت شخصی عباس باقری' }}">
        <meta property="og:description" content="{{ $description ?? 'وب سایت شخصی عباس باقری، مهندس نرم افزار و برنامه نویس ارشد وب سایت' }}">
        <meta property="og:image" content="/asset/image/logo-ba8.svg">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://abasbagheri.ir/">
        <meta property="twitter:title" content="{{ $title ?? 'وب سایت شخصی عباس باقری' }}">
        <meta property="twitter:description" content="{{ $description ?? 'وب سایت شخصی عباس باقری، مهندس نرم افزار و برنامه نویس ارشد وب سایت' }}">
        <meta property="twitter:image" content="/asset/image/logo-ba8.svg">

        @yield('meta')
        <title>{{ $title ?? 'وب سایت شخصی عباس باقری' }}</title>
        @vite( ['resources/css/app.css'])
    </head>
    <body class="{{ $_COOKIE['DARK_MODE'] ?? 'dark' }}">
        @include('layouts.spinner')
        @include('layouts.header')
        <div id="page">
            @yield('content')
        </div>
        @include('layouts.footer')

        <script src="/js/particles/particles.js" ></script>
        <script src="/js/particles/app.js" ></script>
        @vite('resources/js/app.js')
        @yield('script')
    </body>
</html>