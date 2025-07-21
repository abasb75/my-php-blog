<?php

namespace App\CMS;

use App\CMS\Optimize\UrlCache;

class Router{
    
    static function get($uri,$controller,$params=[]){
        if(Request::method()!='GET'){
            return;
        }
        return self::checkUri($uri,$controller,$params);
    }

    static function post($uri,$controller,$params=[]){
        if(Request::method()!='POST'){
            return;
        }
        return self::checkUri($uri,$controller,$params);
    }

    static function all($uri,$controller,$params=[]){
        return self::checkUri($uri,$controller,$params);
    }

    static private function checkUri($uri,$controller,$params){
        $requestUri = Request::uri();
        $requestUri = preg_replace("#^\/api#","",$requestUri);
        
        if($uri==="*"){
            return self::acceptUri($controller,$params);
        }
        if($uri==$requestUri){
            return self::acceptUri($controller,$params);
        }

        $uriArray = explode('/',$uri);
        $requestUriArray = explode('/',$requestUri);
        if(substr($uri,-1)!="*" and count($uriArray)!=count($requestUriArray)){
            return;
        }else if(substr($uri,-1)=="*" and count($uriArray)>count($requestUriArray)){
            return;
        }

        for($i=0;$i<count($uriArray);$i++){
            $uriItem = $uriArray[$i];
            $requestUriItem = $requestUriArray[$i];
            if(preg_match("#^\{[a-zA-Z0-9]+\}$#",$uriItem)){
                $key = substr($uriItem, 1, -1);
                $params[$key] = $requestUriItem;
            }elseif(preg_match("#^\{[a-zA-Z0-9]+\:(number|int|string|str)\}$#",$uriItem)){
                $key = explode(':',substr($uriItem, 1, -1));
                switch($key[1]){
                    case 'number':
                    case 'int':
                        if(!preg_match('#^[0-9]+$#',$requestUriItem)){
                            return;
                        }
                        break;
                    case 'string':
                    case 'str':
                        if(!preg_match('#^[a-zA-Z0-9\-\_]+$#',$requestUriItem)){
                            return;
                        }
                        break;
                    default:
                        break;
                }
                $params[$key[0]] = $requestUriItem;
            }elseif($uriItem=='*'){
                continue;
            }elseif($uriItem!=$requestUriItem){
                return;
            }
        }

        return self::acceptUri($controller,$params);
    }

    static function acceptUri($controller,$params){
        return self::accept($controller,$params);
    }

    static function accept($controller,$params){
        $class = $controller[0];
        $method = $controller[1];

        // TODO: middlewere
        $controller = new $class();
        $result = UrlCache::url(
            Request::uri(),
            $class,
            $method,
            $params
        );
        
        if(Request::isApi()){
            exit("$result");
        }
        exit("$result");

    }

}