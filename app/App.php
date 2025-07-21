<?php 

namespace App;

use App\CMS\Request;
use App\Routes\Api;
use App\Routes\Web;

class App{

    function show(){

        if(Request::isApi()){
            return $this->api();
        }
        return $this->web();

    }

    function web(){
        $web = new Web();
        $web->router();

        /** 404 eror if this code run */
        $web->e404();
        
        
    }

    function api(){
        $api = new Api();
        $api->router();

        $api->e404();
    }

    

}