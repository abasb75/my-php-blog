<?php

namespace App\Routes;

use App\CMS\Router;
use App\Controllers\ErrorController;
use App\Controllers\HomeController;

class Api{
    function router(){
        Router::post('/message/add',[HomeController::class,'addMessage']);
    }

    function e404(){
        Router::all('*',[ErrorController::class,'apiE404']);
    }

}
