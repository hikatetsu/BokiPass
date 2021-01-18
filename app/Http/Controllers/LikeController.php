<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function create(Request $request)
    {
        //Likeインスタンス作成し、ログインユーザーIDを代入
        $like = new Like([
            'user_id' => Auth::user()->id,
        ]);
        
        //該当する投稿を取得
        $post = Post::findOrFail($request->post_id);

        // 多重いいね防止①（JavaScript無効の場合）既にその投稿にログインユーザーがいいね済ならばDBからデータを取得
        $judge = DB::select('select * from likes where post_id = ? and user_id = ?', [$request->post_id, Auth::user()->id]);

        //多重いいね防止②（JavaScript無効の場合）もしDBにデータがなければ保存を実行
        if(!$judge){
            //取得した投稿と紐づくイイネを保存
            $post->likes()->save($like);
        }

        return redirect()->route('timeline');
    }

    public function delete(Request $request)
    {
        //該当するいいねを取得して削除
        Like::findOrFail($request->like_id)->delete();

        return redirect()->route('timeline');
    }
}
