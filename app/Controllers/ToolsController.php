<?php 

namespace App\Controllers;

use App\CMS\Response;

class ToolsController{

    function getToolsDir(){
        return __DIR__ . "../../../tools";
         
    }
    
    function cssRoundedShape(){
        $htmlIndex = $this->getToolsDir()."/css-rounded-shape/index.html" ;
        return Response::html($htmlIndex);
    }

    function tagGenerator(){
        $htmlIndex = $this->getToolsDir()."/tag-generator/index.html" ;
        return Response::html($htmlIndex);
    }

    function react($params){
        $app = $params['app'];
        $htmlIndex = $this->getToolsDir()."/$app/index.html";
        return Response::html($htmlIndex);
    }


}