<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateComment; 

class CommentController extends Controller
{
    public function create(CreateComment $request,int $post_id)
    {
        //Commentインスタンス作成し、入力値を代入
        $comment = new Comment([
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
            'body' => $request->body,
        ]);
        
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //取得した投稿と紐づくコメントを保存
        $post->comments()->save($comment);

        // 多重コメント防止(JavaScript無効の場合)
        $request->session()->regenerateToken();

        return redirect()->route('show',[
            'post_id' => $post->id,
        ])->with('status', __('コメントしました。'));
    }

    public function delete(Request $request,int $post_id)
    {
        //該当するコメントを取得して削除
        Comment::findOrFail($request->comment_id)->delete();

        return redirect()->route('show',[
            'post_id' => $post_id,
        ]);
    }
}
