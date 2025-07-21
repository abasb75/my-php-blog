<?php

namespace App\CMS;

use App\Controllers\ErrorController;

class Handler{

    static function e404(){
        $controller = new ErrorController();
        return $controller->e404();
    }

}