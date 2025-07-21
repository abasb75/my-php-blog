<?php 
namespace App\Views\Header;

use App\Views\General\Icon;
use App\Views\General\Script;

class DarkMode{
    static function render(){
        Script::add('darkmode');
        $icon = Icon::render('moon-o');
        return <<<HTML
        <div id="dark-mode" title="انتخاب تم">
            $icon
        </div>
HTML;
    }

}
