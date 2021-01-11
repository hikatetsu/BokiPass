<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatePost; 

class PostController extends Controller
{
    public function index()
    {
        //postsテーブルから降順で取得
        $posts = Post::latest()->get();

        //ログインユーザー情報を取得
        $user = Auth::user();

        return view('timeline.index',[
            'posts' => $posts,
            'user' => $user,
            ]);
    }

    public function showCreateForm()
    {
        return view('timeline.create');
    }

    public function create(CreatePost $request)
    {
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

        //データベースに保存
        $post->save();

        return redirect()->route('timeline');
    }

    public function showDetails(int $post_id)
    {
        //該当する合格体験談を取得
        $post = Post::find($post_id);

        //紐づくコメントを取得
        $comments = Comment::where('post_id',$post_id)->get();

        return view('timeline.show',[
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function showEditForm(int $post_id)
    {
        //該当する合格体験談を取得
        $post = Post::find($post_id);

        return view('timeline.edit',[
            'post' => $post,
        ]);
    }

    public function edit(CreatePost $request,int $post_id)
    {
        //該当する合格体験談を取得
        $post = Post::find($post_id);

        //入力値を代入
        $post->pass_class = $request->pass_class;
        $post->pass_date = $request->pass_date;
        $post->test_style = $request->test_style;
        $post->study_period = $request->study_period;
        $post->study_method = $request->study_method;
        $post->books_used = $request->books_used;
        $post->advice = $request->advice;
        $post->free_column = $request->free_column;

        //データベースを更新
        $post->update();

        return redirect()->route('show',[
            'post_id' => $post->id,
        ]);
    }
}
