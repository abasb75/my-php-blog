<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['cache.pages','ajax-response'])
    ->group(function(){
        Route::get('/', [HomeController::class,'index'])->name('home');
        Route::get('/resume', [HomeController::class,'resume'])->name('resume');
        Route::get('/contact', [HomeController::class,'contact'])->name('contact');

        Route::get('blog',[BlogController::class,'index'])->name('blog');
        Route::get('posts',[BlogController::class,'index'])->name('posts');
        Route::get('blog/pages/{page}',[BlogController::class,'index'])->name('blog.paginated');
        Route::get('posts/pages/{page}',[BlogController::class,'index'])->name('posts.paginated');

        Route::get('/blog/{id}',[BlogController::class,'single'])->name('blog.single');
        Route::get('/blog/{id}/{slug}',[BlogController::class,'single'])->name('blog.slug');
        Route::get('/posts/{id}',[BlogController::class,'single'])->name('posts.single');
        Route::get('/posts/{id}/{slug}',[BlogController::class,'single'])->name('posts.slug');
        Route::get('/post/{id}',[BlogController::class,'single'])->name('post');
        Route::get('/post/{id}/{slug}',[BlogController::class,'single'])->name('post.slug');
        Route::get('/p/{id}',[BlogController::class,'single'])->name('post.short');
        
    });



Route::get('/frames/{post}/{slug}',[BlogController::class,'frame'])->name('frame');
