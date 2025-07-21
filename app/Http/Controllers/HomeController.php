<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(){
        $posts = Post::where('publish_status', 1)
            ->latest()
            ->take(3)
            ->get();
        return view('home',compact('posts'));
    }

    public function resume(){
        return view('resume');
    }

    public function contact(){
        return view('contact');
    }
}
