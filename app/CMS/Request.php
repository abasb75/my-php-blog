<?php

namespace App\CMS;

class Request {
    
    static function ip(){
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }
        else{
            $ip = $remote;
        }
        return $ip;
    }

    static function method(){
        $method = $_SERVER['REQUEST_METHOD'];
        if(!$method){
            return 'GET';
        }
        return $method;
    }

    static function uri(){
        $uri = $_SERVER['REQUEST_URI'];
        if(preg_match("#\?#",$uri)){
            $uri = explode('?',$uri)[0];
        }
        if(strlen($uri)>1 ){
            $uri = rtrim($uri, "/");
        }
        return $uri;
    }

    static function get($key,$default=''){
        if(!isset($_GET[$key])){
            return $default;
        }
        return $_GET[$key];
    }

    static function post($key,$default=''){
        if(!isset($_POST[$key])){
            return $default;
        }
        return $_POST[$key];
    }

    static function isApi(){
        if(preg_match('#^\/api#',self::uri())){
            return true;
        }
        return false;
    }

    static function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

}

