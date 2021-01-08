<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class TimelineController extends Controller
{
    public function index()
    {
        //postsテーブルから全て取得
        $posts = Post::all();

        return view('timeline.index',['posts' => $posts]);
    }

    public function showCreateForm()
    {
        return view('timeline.create');
    }

    public function create()
    {
        return view('timeline.index');
    }

    public function show(int $post_id)
    {
        return view('timeline.show');
    }
}
