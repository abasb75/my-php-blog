<?php 

namespace App\CMS\Build;

class Build{
    static function build(){
        self::prepareCSS();
        self::prepareJs();
    }

    static function prepareCSS(){
        $cssDir = self::getBaseDir().'/styles';
        if(!is_dir($cssDir)){
            exit("can not find directory: $cssDir");
        }
        $file = self::getBaseDir() . '/styles/app.min.css';
        if(file_exists($file)){
            unlink($file);
        }
        $content = self::readCssFilesInDir($cssDir); 
        $content = "/**\nAuther: Abbas Bagheri, abasbagheria@gmail.com\n*/\n$content";
        file_put_contents($file,$content);
    }

    static function readCssFilesInDir($dir){
        $files = glob($dir.'/*');
        $css = "";
        foreach($files as $i=>$file){
            if(is_dir($file)){
                $css .= self::readCssFilesInDir($file);
            }else if(preg_match("#\.css$#",$file)){
                $css .= Minify::css($file);
            }
        }
        return $css;
    }

    static function prepareJs(){
        $jsDir = self::getBaseDir().'/js';
        if(!is_dir($jsDir)){
            exit("can not find directory: $jsDir");
        }
        $file = self::getBaseDir() . '/js/app.min.js';
        if(file_exists($file)){
            unlink($file);
        }
        $content = self::readJsFilesInDir($jsDir); 
        $content = "/**\nAuther: Abbas Bagheri, abasbagheria@gmail.com\n*/\n$content";
        file_put_contents($file,$content);
    }

    static function readJsFilesInDir($dir){
        $files = glob($dir.'/*');
        $js = "";
        foreach($files as $i=>$file){
            if(is_dir($file)){
                $js .= self::readJsFilesInDir($file);
            }else if(preg_match("#\.js#",$file)){
                $js .= Minify::js($file);
            }
        }
        return $js;
    }

    static function getBaseDir(){
        return __DIR__ . '/../../..';
    }

}