<?php 

namespace App\CMS\Optimize;

use App\CMS\Env;

class Cache{

    static function getDirectory(){
        $dir = __DIR__."/../Cache";
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $v = Env::get('APP_VERSION');
        $dir = $dir."/$v";
        if(!is_dir($dir)){
            mkdir($dir);
        }
        return $dir;
    }

}