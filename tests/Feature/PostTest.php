<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\CreateFolder;
use Carbon\Carbon;
// use PostsTableSeeder;

class PostTest extends TestCase
{
    //テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /**
     * 合格体験談の文字数がオーバーしている場合はバリデーションエラー
     * @test
     */
    public function character_limit()
    {
        $response = $this->post('/timeline/post/create', [
            'user_id' => 1,
            'user_name' => '炭治郎',
            'pass_class' => 1,
            'pass_date' => '2021-01',
            'test_style' => '筆記試験（統一試験方式）',
            'study_period' => str_random(192),
            'study_method' => str_random(192),
            'books_used' => str_random(192),
            'advice' => str_random(192),
            'free_column' => str_random(192),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'study_period' => '「勉強期間(時間)はどれくらいでしたか？」 は 191 文字までです。',
            'study_method' => '「どのような勉強法でしたか？」 は 191 文字までです。',
            'books_used' => '「使用した教材は何ですか？」 は 191 文字までです。',
            'advice' => '「合格の秘訣や受験生へアドバイスをお願いします。」 は 191 文字までです。',
            'free_column' => '「最後に一言お願いします。」 は 191 文字までです。',
        ]);
    }
    
    /**
     * 合格体験談に入力忘れがある場合はバリデーションエラー
     * @test
     */
    public function forgot_to_write()
    {
        $response = $this->post('/timeline/post/create', [
            'user_id' => 1,
            'user_name' => '炭治郎',
            'pass_class' => 1,
            'pass_date' => '',
            'test_style' => '筆記試験（統一試験方式）',
            'study_period' => '',
            'study_method' => '',
            'books_used' => '',
            'advice' => '',
            'free_column' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'pass_date' => '「いつ合格しましたか？」 は必須入力です。',
            'study_period' => '「勉強期間(時間)はどれくらいでしたか？」 は必須入力です。',
            'study_method' => '「どのような勉強法でしたか？」 は必須入力です。',
            'books_used' => '「使用した教材は何ですか？」 は必須入力です。',
            'advice' => '「合格の秘訣や受験生へアドバイスをお願いします。」 は必須入力です。',
            'free_column' => '「最後に一言お願いします。」 は必須入力です。',
        ]);
    }
}
