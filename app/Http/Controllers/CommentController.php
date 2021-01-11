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
        //Commentインスタンス作成し、値を代入
        $comment = new Comment([
            'user_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
            'body' => $request->body,
        ]);
        
        //該当する合格体験談を取得・見つからなければ例外を投げる
        $post = Post::findOrFail($post_id);

        //取得した合格体験談と紐づくコメントを保存
        $post->comments()->save($comment);

        return redirect()->route('show',[
            'post_id' => $post->id,
        ]);
    }
}
