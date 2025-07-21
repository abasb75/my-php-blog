<?php

namespace App\Controllers;

use App\CMS\Response;

class ErrorController{

    function e404(){
        header("HTTP/1.0 404 Not Found");
        return Response::view('Error.Error',[
            'code'=>404,
            'message'=>'صفحه مورد نظر شما یافت نشد',
            'title'=>'صفحه مورد نظر شما یافت نشد',
        ]);
    }

    function apiE404(){
        header("HTTP/1.0 404 Not Found");
        return Response::json([
            'result'=>false,
            'message'=>'route not found',
        ],404);
    }

    

    function e500(){
        header("Status: 500 Server Error");
        return Response::view('Error.Error',[
            'code'=>500,
            'message'=>'متاسفانه مشکلی در اجرای برنامه رخ داد',
            'title'=>'خطا',
        ]);
    }


}