<?php 

namespace App\CMS;

class Check{

    public $has_error;
    public $hasError;

    public $errors;

    public function __construct($has_error,$errors) {
        $this->has_error = $has_error;
        $this->hasError = $has_error;
        $this->errors = $errors;
    }

    public function hasError(){
        return $this->hasError;
    }

    public function getFirstError(){
        if(!$this->hasError){
            return null;
        }
        foreach($this->errors as $key=>$error){
            return $error[0];
        }
        return null;
    }
    
    static function validate($args){
        $errors = [];
        foreach($args as $key=>$arg){
            $checks = self::getChecksItems($arg);
            if(count($checks)<1){
                continue;
            }
            $value = Request::post($key,null);
            $errors[$key] = self::check($checks,$key,$value);
        }

        $finalErrors = [];
        foreach($errors as $key=>$error){
            if(count($error)>0){
                $finalErrors[$key] = $error; 
            }
        }
        if(count($finalErrors)>0){
            return new Check(true,$finalErrors);
        }
        return new Check(false,[]);

    }

    static function check($checks,$key,$value){
        
        $errors = [];
        foreach($checks as $check){
            if($check === 'required'){
                $errors = self::checkRequired($key,$value,$errors);
            }else if(preg_match("#^min\:[0-9]+$#",$check)){
                $errors = self::checkMin($key,$value,$check,$errors);
            }else if(preg_match("#^max\:[0-9]+$#",$check)){
                $errors = self::checkMax($key,$value,$check,$errors);
            }elseif( in_array($check,['mumeric','number','int']) ){
                $errors = self::checkIsNumber($key,$value,$errors);
            }
        }
        return $errors;
    }

    static function checkIsNumber($key,$value,$errors){
        if(!preg_match("#^[0-9]+(\.[0-9]+)?$#",$value)){
            $errors[] = "برای فیلد $key فقط مقدار عددی مجاز است.";
        }
        return $errors;
    }

    static function checkMax($key,$value,$check,$errors){
        $max = (int)explode(':',$check)[1];
        if($value && strlen($value)>$max){
            $errors[] = "حداکثر $max کاراکتر برای فیلد $key مجاز است.";
        }
        return $errors;
    }

    static function checkMin($key,$value,$check,$errors){
        $min = (int)explode(':',$check)[1];
        if($value && strlen($value)<$min){
            $errors[] = "وارد کردن حداقل $min کاراکتر برای فیلد $key اجباری است.";
        }
        return $errors;
        
    }

    static function checkRequired($key,$value,$errors){
        if(!$value){
            $errors[] = "وارد کردن مقدار برای فیلد $key اجباری است.";
        }
        return $errors;
    }

    static function getChecksItems($arg){
        $checks = explode('|',$arg);
        $finalChecks = [];
        foreach($checks as $check){
            $check = trim(strtolower($check));
            if($check!==''){
                $finalChecks[] = $check;
            }
        }
        return $finalChecks;
    }

}