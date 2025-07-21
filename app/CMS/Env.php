<?php 

namespace App\CMS;

class Env{
    static $ENV = [];

    static function get($key,$default=""){
        if(count(self::$ENV)==0){
            $_ENV = parse_ini_file('.env');
            foreach ($_ENV as $k=>$v){
                self::$ENV[$k]=$v;
            }
        }
        return isset($_ENV[$key])?$_ENV[$key]:$default;
    }

    static function appVersion(){
        if(self::get('DEVELOPMENT',0)){
            return rand(100000,100000000000);
        }
        return self::get('APP_VERSION',1);
    }
}