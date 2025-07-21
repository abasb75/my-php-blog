<?php 

namespace App\Views\Error;

use App\Views\General\Script;
use App\Views\General\Style;

class Error{
    static function render($args){
        Style::add('error');
        Script::add('particles.particles');
        Script::add('particles.app');

        $code = $args['code'];
        $message = $args['message'];
        
        return <<<HTML
        <div id="error-container">
            <div id="particles-js"></div>
            <div class="content">
                <div>
                    <span>$code</span>
                    <h1>$message</h1>
                </div>
            </div>
        </div>
HTML;
    }
}
