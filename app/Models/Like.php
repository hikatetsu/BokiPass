<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    // テーブル間のリレーションの設定
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    //いいねが既にされているかを確認
    public static function getLikeExist($user_id, $post_id)
    {
        //Likesテーブルのレコードにユーザーidと投稿idが一致するものを取得
        $exist = Like::where('user_id', $user_id)->where('post_id', $post_id)->get();

        // レコード（$exist）が存在するならtrue
        if (!$exist->isEmpty()) {
            return true;
        } else {
        // レコード（$exist）が存在しないならfalse
            return false;
        }
    }
}
