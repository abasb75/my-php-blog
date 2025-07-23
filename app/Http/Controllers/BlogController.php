<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // بررسی وجود پارامتر post در درخواست
        if ($request->has('post')) {
            return $this->single($request, $request->query('post'));
        }

        $perPage = 21;

        $posts = Post::where('publish_status', 1)
            ->latest()
            ->paginate($perPage);

        $pagination = [
            'current_page' => $posts->currentPage(),
            'total_page' => $posts->lastPage(),
        ];

        return view('blog', compact('posts', 'pagination'));
    }

    public function single(Request $request, $id, $slug=null)
    {
        // dd($id);
        $post = Post::where('id', $id)
            ->where('publish_status', 1)
            ->firstOrFail();

        return view('blog.single', compact('post'));
    }

    public function frame($post, $slug)
    {
        // مسیر فایل بلید رو می‌سازیم
        $viewPath = "posts.{$post}.{$slug}";

        // بررسی می‌کنیم که آیا فایل بلید وجود داره
        if (!view()->exists($viewPath)) {
            abort(404, 'صفحه مورد نظر یافت نشد');
        }

        // رندر کردن فایل بلید
        return view($viewPath);
    }

}