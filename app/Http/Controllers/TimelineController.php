<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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

    public function create(Request $request)
    {
        //バリデーション実行
        $request->validate([
            'pass_class' => 'required|max:20',
            'pass_date' => 'required|max:20',
            'test_style' => 'required|max:20',
            'study_period' => 'required|max:191',
            'study_method' => 'required|max:191',
            'books_used' => 'required|max:191',
            'advice' => 'required|max:191',
            'free_column' => 'max:191',
        ]);

        //Postインスタンス作成
        $post = new Post;

        //入力値を代入
        $post->user_id = Auth::user()->id;
        $post->user_name= Auth::user()->name;
        $post->pass_class = $request->pass_class;
        $post->pass_date = $request->pass_date;
        $post->test_style = $request->test_style;
        $post->study_period = $request->study_period;
        $post->study_method = $request->study_method;
        $post->books_used = $request->books_used;
        $post->advice = $request->advice;
        $post->free_column = $request->free_column;

        //データベースに書き込み
        $post->save();

        return redirect()->route('timeline');
    }

    public function show(int $post_id)
    {
        return view('timeline.show');
    }
}
