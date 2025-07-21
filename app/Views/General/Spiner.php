<?php 

namespace App\Views\General;

use App\Views\View;

class Spiner extends View{
    static function render(){
        Style::add('spiner');
        Script::add('spiner');
        return <<<HTML
            <div id="big-spiner" class="initial show">
                <div class="image-holder">
                    <img 
                    src="/asset/loading/main-loading.svg" 
                    alt="وب سایت عباس باقری" 
                    width="200" height="200"
                    />
                </div>
            </div>
HTML;
        
    }
}

