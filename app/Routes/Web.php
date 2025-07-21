<?php

namespace App\Routes;

use App\CMS\Router;
use App\Controllers\BlogController;
use App\Controllers\ErrorController;
use App\Controllers\HomeController;
use App\Controllers\SiteMapController;
use App\Controllers\ToolsController;
use App\Controllers\WorkSamplesController;

class Web{
    function router(){

        Router::get('/',[HomeController::class,'index']);
        Router::get('/resume',[HomeController::class,'resume']);
        Router::get('/contact',[HomeController::class,'contact']);

        Router::get('/blog',[BlogController::class,'list'],['page'=>1]);
        Router::get('/blog/page/{page:number}',[BlogController::class,'list']);
        Router::get('/p/{id:number}',[BlogController::class,'single']);
        Router::get('/blog/{id:number}',[BlogController::class,'single']);
        Router::get('/blog/{id:number}/{slug}',[BlogController::class,'single']);
        Router::get('/amp/blog/{id:number}/{slug}',[BlogController::class,'amp']);

        Router::get('/work-samples',[WorkSamplesController::class,'list'],['page'=>1]);
        Router::get('/project',[WorkSamplesController::class,'list'],['page'=>1]);
        Router::get('/work-samples/page/{page:number}',[WorkSamplesController::class,'list'],['page'=>1]);
        Router::get('/project/page/{page:number}',[WorkSamplesController::class,'list'],['page'=>1]);

        Router::get('/work-samples/{id:number}',[WorkSamplesController::class,'single']);
        Router::get('/work-samples/{id:number}/{slug}',[WorkSamplesController::class,'single']);
        Router::get('/project/{id:number}',[WorkSamplesController::class,'single']);
        Router::get('/project/{id:number}/{slug}',[WorkSamplesController::class,'single']);
        Router::get('/w/{id:number}',[WorkSamplesController::class,'single']);

        /** tools */
        Router::get('/css-rounded-shape',[ToolsController::class,'cssRoundedShape']);
        Router::get('/css-rounded-shape/*',[ToolsController::class,'cssRoundedShape']);
        Router::get('/metatag-generator',[ToolsController::class,'tagGenerator']);
        Router::get('/use-callback-hook',[ToolsController::class,'react'],['app'=>'use-callback-hook']);
        Router::get('/use-callback-hook/*',[ToolsController::class,'react'],['app'=>'use-callback-hook']);
        Router::get('/use-deferred-value-hook',[ToolsController::class,'react'],['app'=>'use-deferred-value-hook']);
        Router::get('/use-deferred-value-hook/*',[ToolsController::class,'react'],['app'=>'use-deferred-value-hook']);
        Router::get('/use-memo-hook',[ToolsController::class,'react'],['app'=>'use-memo-hook']);
        Router::get('/use-memo-hook/*',[ToolsController::class,'react'],['app'=>'use-memo-hook']);
        Router::get('/use-reducer-todo-example',[ToolsController::class,'react'],['app'=>'use-reducer-todo-example']);
        Router::get('/use-reducer-todo-example/*',[ToolsController::class,'react'],['app'=>'use-reducer-todo-example']);
        Router::get('/use-state-todo-example',[ToolsController::class,'react'],['app'=>'use-state-todo-example']);
        Router::get('/use-state-todo-example/*',[ToolsController::class,'react'],['app'=>'use-state-todo-example']);
        Router::get('/use-transition-hook',[ToolsController::class,'react'],['app'=>'use-transition-hook']);
        Router::get('/use-transition-hook/*',[ToolsController::class,'react'],['app'=>'use-transition-hook']);


        Router::get('/admin',[HomeController::class,'admin']);
        Router::get('/admin/*',[HomeController::class,'admin']);
        
        /** rss,xml */
        Router::get('/rss',[SiteMapController::class,'rss']);
        Router::get('/sitemap.xml',[SiteMapController::class,'xml']);
        Router::get('/sitemap.json',[SiteMapController::class,'json']);


    }

    function e404(){
        Router::get('*',[ErrorController::class,'e404']);
    }

    function e500($e=[]){
        Router::get('*',[ErrorController::class,'e500'],['e'=>$e]);
    }

}

