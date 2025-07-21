<?php

namespace App\Views\Home;

use App\Views\General\Style;

class SectionTitle{
    static function render($sectionTitle){
        Style::require('home.section-title');
        return <<<HTML
        <div class="section-title">
            <div class="line"></div>
            <div class="radius">
                <div class="inner-radius"></div>
            </div>
            <h2>$sectionTitle</h2>
        </div>
HTML;
    }
}
