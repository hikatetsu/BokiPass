<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'user_name' => 'テストユーザー',
            'pass_class' => '３',
            'pass_date' => '2019年11月',
            'test_style' => '筆記試験',
            'study_period' => '約３ヶ月。平日のみですが毎日約２時間を継続しました。',
            'study_method' => '独学です。インターネットや本で調べながら勉強しました。',
            'books_used' => '過去問と問題集は市販の□□と○○を買いましたが、あとはyoutube動画や簿記関連サイトで勉強しました。',
            'advice' => '独学は不安でしたが、殆どのことはネットで調べると解決できます。移動中や待ち時間などスキマ時間も大切にしたことが合格の秘訣だと思います。諦めずに続ければ合格できると思います。頑張ってください。',
            'nunber_times' => '１回',
        ];
    }
}
