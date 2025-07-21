<?php 

namespace App\Views\General;

use App\CMS\Build\Build;

class Style{

    static $list = [
        "/styles/reset.css",
        "/styles/var/tailwind-colors.css",
        "/styles/var/brands-color.css",
        "/styles/var/var.css",
        "/asset/fonts/style.css",
        "/asset/icon-font/style.css",
    ];

    static function getStyles(){
        return self::$list;
    }

    static function add($name){
        if(preg_match("#^\@#",$name)){
            $name = str_replace('@','/',$name);
        }else if(preg_match("#^\/#",$name)){

        }else{
            $base = '/styles';
            $name = "$base/$name";
        }
        $name = str_replace('.','/',$name);
        $name = "$name.css";
        if(!in_array($name,self::$list)){
            self::$list[] = $name;
        }
    }

    static function require($name){
        self::add($name);
    }

    static function render(){
        $styles = "";
        foreach(self::$list as $css){
            $styles .= "<link rel=\"stylesheet\" href=\"$css\" />";
        }
        return <<<HTML
        $styles
        <noscript>
            <link rel="stylesheet" href="/styles/noscript.css" />
        </noscript>
HTML;
    }

}