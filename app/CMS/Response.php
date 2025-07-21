<?php 

namespace App\CMS;

use App\CMS\Build\Minify;
use App\CMS\Optimize\ViewCache;
use App\CMS\View;
use App\Views\Footer;
use App\Views\General\Script;
use App\Views\General\Spiner;
use App\Views\General\Style;
use App\Views\Header\Header;
use App\Views\Template;

class Response{

    static function view($name,$args){

        $defaultMetaData = [
            'title'=>'وب سایت شخصی عباس باقری',
            'description'=>'وب سایت شخصی عباس باقری، مهندس نرم افزار و برنامه نویس ارشد وب سایت',
            'link'=> (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
            'image'=>'/asset/image/logo-ba8.svg',
            'amp'=>null,
        ];

        $page = View::render($name,$args);
        
        $metaParams = [];
        $metaParams['meta'] = isset($args['metadata'])?$args['metadata']:[];
        foreach($defaultMetaData as $k=>$v){
            $metaParams[$k] = isset($args[$k])?$args[$k]:$v;
        }

        $meta = View::render('Meta',$metaParams);
        

        if(Request::isAjax()){
            return self::json([
                'result'=>true,
                'page'=>$page,
                'title'=>isset($args['title'])?$args['title']:$defaultMetaData['title'],
            ]);
        }
        
        $header = ViewCache::get("Header.Header");
        $footer = ViewCache::get("Footer");
        $spiner = ViewCache::get("General.Spiner");

        return Template::render([
            'page'=>$page,
            'meta'=>$meta,
            'footer'=>$footer,
            'header'=>$header,
            'spiner'=>$spiner
        ]);
    }

    static function json($args,$code=200){
        header('Content-type: Application/json');
        return json_encode($args);
    }

    static function xml($xml){
        header('Content-Type: application/xml; charset=utf-8');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . $xml;
        exit($xml); 
    }

    static function html($html){
        return file_get_contents($html);
    }

}
