<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function create(Request $request)
    {
        //Likeインスタンス作成し、ログインユーザーIDを代入
        $like = new Like([
            'user_id' => Auth::user()->id,
        ]);
        
        //該当する合格体験談を取得
        $post = Post::findOrFail($request->post_id);

        //取得した合格体験談と紐づくいいねを保存
        $post->likes()->save($like);

        return redirect()->route('timeline');
    }

    public function delete(Request $request)
    {
        //該当するいいねを取得して削除
        Like::findOrFail($request->like_id)->delete();

        return redirect()->route('timeline');
    }
}
