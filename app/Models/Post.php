<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'pass_class',
        'pass_date',
        'test_style',
        'study_period',
        'study_method',
        'books_used',
        'advice',
        'nunber_times',
    ];

    // テーブル間のリレーションの設定
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    // テーブル間のリレーションの設定
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }


    // pass_classの値に応じたclass名(HTML用)を定義　全角数字なので"１"
    const PASSCLASS = [
        '１' => [ 'class' => 'gold' ],
        '２' => [ 'class' => 'silver' ],
        '３' => [ 'class' => 'peru' ],
        '初' => [ 'class' => 'skyblue' ],
    ];

    // pass_classを表すHTMLクラス
    public function getStylePassClassAttribute()
    {
        // pass_classの値
        $pass_class = $this->attributes['pass_class'];

        // 定義されていなければ空文字を返す
        if (!isset(self::PASSCLASS[$pass_class])) {
            return '';
        }

        return self::PASSCLASS[$pass_class]['class'];
    }
}
