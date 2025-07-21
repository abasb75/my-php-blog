<?php 

namespace App\Views\General;

class Script{

    static $minifierExeption = [

        '/js/blog/post/highlight.js',
    ];

    static $list = [
        '/js/spa/init.js',
    ];
    static function add($name){
        if(preg_match("#^\@#",$name)){
            $name = str_replace('@','/',$name);
        }else if(preg_match("#^\/#",$name)){

        }else{
            $base = '/js';
            $name = "$base/$name";
        }
        $name = str_replace('.','/',$name);
        $name = "$name.js";

        if(!in_array($name,self::$list)){
            self::$list[] = $name;
        }

    }

    static function require($name){
        self::add($name);
    }

    static function render(){
        $scripts = "";
        foreach(self::$list as $js){
            $scripts .= "<script src=\"$js\" ></script>";
        }
        return $scripts;
    }

}