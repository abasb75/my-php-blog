<?php 

namespace App\Views;

use App\CMS\Build\Build;
use App\CMS\Env;

class Template extends View{

    static function render($args){
        if(Env::get('DEVELOPMENT',0)){
            Build::build();
        }
        $meta = $args['meta'];
        $v = Env::appVersion();
        $style = '<link rel="stylesheet" href="/styles/app.min.css?v='.$v.'" />';
        $scripts = '<script src="/js/app.min.js?v='.$v.'" defer ></script>';
        $header = $args['header'];
        $footer = $args['footer'];
        $page = $args['page'];
        $spiner = $args['spiner'];

        return <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            $meta
            $style
        </head>
        <body class="dark">
            $spiner
            $header
            <div id="page">
                $page
            </div>
            $footer
        </body>
        $scripts
        </html>
HTML;
    }
}
