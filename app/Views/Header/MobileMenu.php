<?php 

namespace App\Views\Header;

use App\Views\General\Icon;
use App\Views\General\Script;

class MobileMenu{

    static function render(){
        Script::add('mobile-menu');
        $iconMenu = Icon::render('menu');
        return <<<HTML
        <button id="mobile-menu-button" title="باز کردن منو">
            $iconMenu
        </button>
HTML;
    }
}
