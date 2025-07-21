<?php 

namespace App\Controllers;

use App\CMS\Handler;
use App\CMS\Request;
use App\CMS\Response;
use App\Models\WorkSample;

class WorkSamplesController{

    function list($params){
        $page = $params['page'];
        if(!$page || $page==1){
            $page = Request::get('page',1);
            if(!preg_match("#^[0-9]+$#",$page)){
                $page=1;
            }
        }
        $posts = WorkSample::getByPage($page);
        if(!$posts || count($posts)<1){
            return Handler::e404();
        }
        return Response::view('WorkSamples.WorkSampleList',[
            'title'=>'نمونه کارهای عباس باقری',
            'description'=>'نمونه کارهای عباس باقری در این صفحه قرار خواهد گرفت',
            'heading'=>[
                'title'=>'نمونه کارهای من',
                'description'=>'برخی از نمونه کارهای خودم را در این صفحه قرار خواهم داد'
            ],
            'posts'=>$posts['posts'],
            'page'=>$page,
            'lastPage'=>$posts['lastPage'],
        ]);
    }


    function single($params){
        $id = $params['id'];

        $post = WorkSample::getById($id);
        if(!$post){
            return Handler::e404();
        }

        return Response::view('Blog.Single',[
            'title'=>$post['title'] . " - نوشته عباس باقری",
            'description'=>$post['description'],
            'post'=>$post,
        ]);
    }

}