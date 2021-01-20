<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatePost; 

class PostController extends Controller
{
    public function timeline()
    {
        //postsテーブルから降順で取得(ページネーション使用)
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        //全てのいいねを取得
        $likes= Like::all(); 

        return view('hello.timeline',[
            'posts' => $posts,
            'likes' => $likes, 
            ]);
    }

    public function showCreateForm()
    {
        return view('hello.create');
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
        $post->nunber_times = $request->nunber_times;

        //データベースに保存
        $post->save();

        // 多重投稿防止(JavaScript無効の場合)
        $request->session()->regenerateToken();

        return redirect()->route('timeline')->with('status', __('投稿しました。'));
    }

    public function show(int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //紐づくコメントを取得
        $comments = Comment::where('post_id',$post_id)->paginate(10);

        return view('hello.show',[
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function showEditForm(int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //もし投稿者と更新者が異なる場合はエラーを返す
        if (Auth::id() != $post->user_id) {
            abort(403);
        }

        return view('hello.edit',[
            'post' => $post,
        ]);
    }

    public function edit(CreatePost $request,int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //入力値を代入
        $post->pass_class = $request->pass_class;
        $post->pass_date = $request->pass_date;
        $post->test_style = $request->test_style;
        $post->study_period = $request->study_period;
        $post->study_method = $request->study_method;
        $post->books_used = $request->books_used;
        $post->advice = $request->advice;
        $post->nunber_times = $request->nunber_times;

        //データベースを更新
        $post->save();

        return redirect()->route('show',[
            'post_id' => $post->id,
        ])->with('status', __('更新しました。'));
    }

    public function delete(int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //紐づくコメントを削除
        $post->comments()->delete();

        //紐づくコメントを削除
        $post->likes()->delete();

        //投稿を削除
        $post->delete();

        return redirect()->route('timeline')->with('status', __('削除しました。'));
    }

    public function squeeze(Request $request)
    {
        //postsテーブルから該当するデータを検索して、降順で取得(ページネーション使用)
        $posts = Post::where('pass_class',$request->pass_class)->orderBy('created_at', 'desc')->paginate(10);

        //全てのいいねを取得
        $likes= Like::all(); 

        return  view('hello.timeline',[
            'posts' => $posts,
            'likes' => $likes, 
        ]);
    }
}
