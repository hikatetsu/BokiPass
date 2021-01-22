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

        return redirect()->route('timeline')->with('status', __('いいねしました。'));
    }

    public function delete(Request $request)
    {
        //該当するいいねを取得して削除
        Like::findOrFail($request->like_id)->delete();

        return redirect()->route('timeline')->with('status', __('いいねを取り消しました。'));
    }


    public function ajaxlike(Request $request)
    {
        //既にログインユーザーがクリックした投稿にいいね済か否かを判定
        if(Like::getLikeExist(Auth::user()->id,$request->post_id)){
        //いいね済ならそのまま同じ条件のいいねを削除
            Like::where('post_id', $request->post_id)
                ->where('user_id', Auth::user()->id)
                ->delete();
        }else{
        //いいねしていないなら新しく保存
            //Likeインスタンス作成し、ログインユーザーIDを代入
            $like = new Like([
                'user_id' => Auth::user()->id,
            ]);
            
            // 該当する投稿を取得
            $post = Post::findOrFail($request->post_id);

            // 取得した投稿と紐づくいいねを保存
            $post->likes()->save($like);
        }

        //withCountとすればリレーションの数を○○_countという形で取得できる（今回はいいねの件数）
        $postLikesCount = Post::withCount('likes')->findOrFail($request->post_id)->likes_count;

        //ajaxに引数の値を返す
        return response()->json($postLikesCount);

    } 

}
