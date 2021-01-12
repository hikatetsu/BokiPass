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
            'user_name' => '炭治郎',
            'pass_class' => '１',
            'pass_date' => '2020年11月',
            'test_style' => '筆記試験（統一試験方式）',
            'study_period' => '約1年',
            'study_method' => '専門学校に通って学びました。',
            'books_used' => '専門学校の教材です。',
            'advice' => '頑張れ!!',
            'free_column' => '嬉しいです。',
        ];
    }
}
