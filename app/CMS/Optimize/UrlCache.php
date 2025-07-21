<?php 

namespace App\CMS\Optimize;

use App\CMS\Env;
use App\CMS\Request;

class UrlCache extends Cache{

    static function getUrlCacheDirectory(){
        $dir = self::getDirectory();
        if(Request::isAjax()){
            $dir = $dir."/AJAX";
        }else{
            $dir = $dir."/URLS";
        }
        
        if(!is_dir($dir)){
            mkdir($dir);
        }
        return $dir;
    }
    
    static function url($uri,$class,$method,$params){
        
        $obj = new $class();
        $content = $obj->$method($params);
        
        return $content;
    }
}