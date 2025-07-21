<?php 

namespace App\CMS;

use App\Models\Model;

class View{

    private static $styles = [];

    private static $scripts = [];

    static function getClass($name){
        $name = str_replace(".","\\",$name);
        return "App\\Views\\$name";
    }


    static function render($name,$params){
        $class = self::getClass($name);
        return $class::render($params);
    }

}