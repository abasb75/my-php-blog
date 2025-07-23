<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'contact-way' => 'required|min:11|max:255',
            'message' => 'required|min:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            Message::create([
                'name' => $request->input('name'),
                'contact_way' => $request->input('contact-way'),
                'message' => $request->input('message'),
            ]);

            return response()->json([
                'result' => true,
                'message' => 'پیام شما ذخیره شد، بزودی پاسخ داده خواهد شد',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'اروری در حین ثبت پیام رخ داد',
            ], 500);
        }
    }
}
