<?php 

namespace App\CMS\Optimize;

use App\CMS\Build\Minify;
use App\CMS\Env;

class ViewCache extends Cache{

    static function getCachedViewDirectory(){
        $dir = self::getDirectory();
        $dir = $dir."/VIEWS";
        if(!is_dir($dir)){
            mkdir($dir);
        }
        return $dir;
    }

    static function get($view){
        $viewClass = str_replace('.',"\\",$view);
        $class = "App\\Views\\$viewClass";
        if(Env::get("DEVELOPMENT")){
            return $class::render();
        }
        $dir = self::getCachedViewDirectory();
        $fileName = "$dir/$view";
        if(file_exists($fileName)){
            $content = @file_get_contents($fileName);
            if($content){
                return $content;
            }
        }
        $content = Minify::html($class::render());
        @file_put_contents($fileName,$content);
        return $content;
    }
}
