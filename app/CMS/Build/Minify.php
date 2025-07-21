<?php 

namespace App\CMS\Build;

use App\Views\General\Script;

class Minify{
    static function css($file){
        $base = Build::getBaseDir();
        $path = preg_replace("#^$base#","",dirname($file));
        $cssContent = file_get_contents($file);
        $css="";
        
        $_TEXT = 'text';
        $_OPEN = 'open';
        $_COMMENT = 'comment';

        $openChar = "";
        $state=$_OPEN;
        for($i=0;$i<strlen($cssContent);$i++){
            $char = $cssContent[$i];
            $nextChar = isset($cssContent[$i+1])?$cssContent[$i+1]:"";
            $prevChar = isset($cssContent[$i-1])?$cssContent[$i-1]:"";
            switch($state){
                case $_OPEN:
                    if(in_array("$char",["\"","'"])){
                        $openChar="$char";
                        $state=$_TEXT;
                        $css .= "$char";
                    }elseif($char==" "){
                        if(
                            isset($css[strlen($css)-1])
                            && preg_match("#[a-zA-Z0-9\)\]\*\!\%]#",$css[strlen($css)-1])
                            && preg_match("#[a-zA-Z0-9.\&\#\:\*\!\(]#",$nextChar)
                        ){
                            $css .= "$char";
                        }else {

                        }
                    }elseif(preg_match("#\s#","$char")){
                        if(
                            isset($css[strlen($css)-1])
                            && preg_match("#[a-zA-Z0-9\)\]\*\!\%]#",$css[strlen($css)-1])
                            && preg_match("#[a-zA-Z0-9.\&\#\:\*\!\(]#",$nextChar)
                        ){
                            $css .= " ";
                        } else {
                            
                        }
                    }elseif($char=="}" && isset($css[strlen($css)-1]) && $css[strlen($css)-1]==";"){
                        $css[strlen($css)-1]="}";
                    }else if("$char"=="/" && $nextChar==""){
                        $state = $_COMMENT;
                        $i++;
                    }else{
                        $css .= "$char";
                    }
                    break;
                case $_TEXT:
                    $css .= "$char";
                    if("$char"==$openChar && $prevChar!="\\"){
                        $openChar="";
                        $state=$_OPEN;
                    }
                    break;
                case $_COMMENT:
                    if($char=="" && $nextChar=="/"){
                        $state = $_OPEN;
                        $i++;
                    }
                    break;
                default:

                    break;
            }
        }
        $css = preg_replace_callback("#url\(\s*[\'\"](?!\/|data\:)#",function($r) use($path){
            $res = $r[0];
            $res = preg_replace("#url\(\s*[\']#","url('$path/",$res);
            $res = preg_replace("#url\(\s*[\"]#","url(\"$path/",$res);
            return $res;
        },$css);

        $css = preg_replace_callback("#calc\([a-zA-Z0-9%]+\s*[\+\-\/\*]\s*[a-zA-Z0-9\%]+\)#",function ($r){
            $r = $r[0];
            $r = preg_replace("#\-#"," - ",$r);
            $r = preg_replace("#\+#"," - ",$r);
            $r = preg_replace("#\/#"," - ",$r);
            $r = preg_replace("#\*#"," - ",$r);
            return $r;
        },$css);

        return $css;

    }

    static function js($file){
        $base = Build::getBaseDir();
        $path = preg_replace("#^$base#","",dirname($file));
        $fileName = preg_replace("#^$base#","",$file);
        $exeptions = Script::$minifierExeption;
        $jsContent = file_get_contents($file);
        

        if(in_array($fileName,$exeptions)){
            return $jsContent.";";
        }

        return JSMinifier::minify($jsContent).";";
    }

    static function html($html){
        $search = array(
            '/(\n|^)(\x20+|\t)/',
            '/(\n|^)\/\/(.*?)(\n|$)/',
            '/\n/',
            '/\<\!--.*?-->/',
            '/(\x20+|\t)/', # Delete multispace (Without \n)
            '/\>\s+\</', # strip whitespaces between tags
            '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
            '/=\s+(\"|\')/'); # strip whitespaces between = "'
        
           $replace = array(
            "\n",
            "\n",
            " ",
            "",
            " ",
            "><",
            "$1>",
            "=$1");
        
            $html = preg_replace($search,$replace,$html);
            return $html;
    }

}