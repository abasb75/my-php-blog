<?php 

namespace App\Controllers;

use App\CMS\Check;
use App\CMS\Request;
use App\CMS\Response;
use App\Models\Message;

class HomeController{

    function index(){
        return Response::view('Home.Home',[
            'title'=>'وب سایت شخصی عباس باقری',
        ]);
    }

    function resume(){
        return Response::view('Home.ResumePage',[
            'title'=>'رزومه عباس باقری',
            'description'=>'رزومه کاری عباس باقری در زمینه برنامه نویسی وب و مهندس نرم افزار',
        ]);
    }

    function contact(){
        return Response::view('Home.ContactPage',[
            'title'=>'ارتباط با عباس باقری',
            'description'=>'ارتباط کاری با عباس باقری در زمینه برنامه نویسی وب و مهندس نرم افزار',
        ]);
    }

    function addMessage(){
        $name = Request::post('name');
        $contactWay = Request::post('contact-way');
        $message = Request::post('message');

        $check = Check::validate([
            'name'=>'required|min:3|max:255',
            'contact-way'=>'required|min:11|max:255',
            'message'=>'required|min:11'
        ]);

        if($check->hasError){
            return Response::json([
                'result'=>false,
                'message'=>$check->getFirstError(),
            ]);
        }

        $r = Message::add([
            'name'=>$name,
            'contact_way'=>$contactWay,
            'message'=>$message,
        ]);

        if(!$r){
            return Response::json([
                'result'=>false,
                'message'=>'اروری در حین ثبت پیام رخ داد',
            ],500);
        }
        return Response::json([
            'result'=>true,
            'message'=>'پیام شما ذخیره شد، بزودی پاسخ داده خواهد شد'
        ],201);
    }

    function admin(){
        $adminFolder = __DIR__."/../../admin";
        echo exec("cd $adminFolder && npm run build");
        $html = "$adminFolder/build/index.html";
        return Response::html($html);
    }

}