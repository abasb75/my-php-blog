<?php 

namespace App\Controllers;

use App\CMS\Handler;
use App\CMS\Request;
use App\CMS\Response;
use App\Models\Post;
use App\Views\Blog\Amp;

class BlogController{

    function list($params){
        $page = $params['page'];
        if(!$page || $page==1){
            $page = Request::get('page',1);
            if(!preg_match("#^[0-9]+$#",$page)){
                $page=1;
            }
        }
        $posts = Post::getByPage($page);
        $lastPage = $posts['lastPage'];
        $posts = $posts['posts'];
        if(!$posts || count($posts)<1){
            return Handler::e404();
        }
        return Response::view('Blog.BlogList',[
            'page'=>$page,
            'lastPage'=>$lastPage,
            'posts'=>$posts,
            'title'=>'نوشته‌های عباس باقری'.($page>1?" - صفحه $page":""),
            'description'=>'نوشته‌های عباس باقری برنامه نویس و مهندس نرم‌افزار که برای برنامه نویسان مفید خواهد بود'
        ]);
    }

    function single($params){
        $id = $params['id'];

        $post = Post::getById($id);
        if(!$post){
            return Handler::e404();
        }

        return Response::view('Blog.Single',[
            'title'=>$post['title'] . " - نوشته عباس باقری",
            'description'=>$post['description'],
            'post'=>$post,
            'amp'=>"/amp/blog/$id/".$post['slug'],
        ]);
    }

    function amp($params){
        $id = $params['id'];

        $post = Post::getById($id);
        if(!$post){
            return Handler::e404();
        }
        return Amp::render($post);
    }
}