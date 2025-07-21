<?php 

namespace App\Views\General;

class Heading{
    static function render($title,$description){
        Style::require('header-title');
        Script::require('particles.particles');
        Script::require('particles.app');
        Script::require('heading');
        return <<<HTML
<div id="header-title">
<div class="content">
    <div id="header-title-image" class="cover bg-image">
        <img 
        srcset="
        /asset/image/header/bg-400.jpg 400w,
        /asset/image/header/bg-640.jpg 640w,
        /asset/image/header/bg-720.jpg 720w,
        /asset/image/header/bg-1280.jpg 1280w,
        /asset/image/header/bg-1920.jpg 1920w"
        sizes="
        (max-width:400px) 400px,
        (max-width:640px) 640px,
        (max-width:720px) 720px,
        (max-width:1280px) 1280px,
        1920px"
        alt="$title" />
    </div>
    <div class="cover bg"></div>
    <div id="particles-js" class="cover"></div>
    <div class="cover content">
        <h1>$title</h1>
        <p>$description</p>
    </div>
    </div>
</div>
<div class="header-title-padding-layout"></div>
HTML;
    }
} 
?>