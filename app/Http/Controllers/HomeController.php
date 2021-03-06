<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myPage()
    {
        //postsテーブルから降順で取得
        $posts = Post::orderBy('created_at', 'desc')->get();

        return  view('home',[
            'posts' => $posts,
        ]);
    }
}
