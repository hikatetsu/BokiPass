<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\User;

class PostTest extends TestCase
{
    //テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

        /**
     * 各テストメソッドの実行前に呼ばれる
     */
    public function setUp() :void
    {
        parent::setUp();

        // ユーザーログイン(ゲストだと投稿できないため)
        $user = \App\Models\User::factory()->create();

        $this->post('login', [
            'email'    => $user->email,
            'password' => 'test1111'
        ]);
            
    }

    /**
     * 合格体験談の文字数がオーバーしている場合はバリデーションエラー
     * @test
     */
    public function character_limit()
    {
        $response = $this->post('/timeline/post/create', [
            'user_id' => 1,
            'user_name' => 'テストユーザー',
            'pass_class' => str_random(21),
            'pass_date' => str_random(21),
            'test_style' => str_random(21),
            'study_period' => str_random(192),
            'study_method' => str_random(192),
            'books_used' => str_random(192),
            'advice' => str_random(192),
            'nunber_times' => str_random(21),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'pass_class' => '「何級に合格しましたか？」 は20文字までです。',
            'pass_date' => '「いつ合格しましたか？」 は20文字までです。',
            'test_style' => '「どの試験方式でしたか？」 は20文字までです。',
            'study_period' => '「勉強期間(時間)はどれくらいでしたか？」 は191文字までです。',
            'study_method' => '「どのような勉強法でしたか？」 は191文字までです。',
            'books_used' => '「使用した教材は何ですか？」 は191文字までです。',
            'advice' => '「合格の秘訣や受験生へアドバイスをお願いします。」 は191文字までです。',
            'nunber_times' => '「受験回数は何回ですか？」 は20文字までです。',
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
            'user_name' => 'テストユーザー',
            'pass_class' => '',
            'pass_date' => '',
            'test_style' => '',
            'study_period' => '',
            'study_method' => '',
            'books_used' => '',
            'advice' => '',
            'nunber_times' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'pass_class' => '「何級に合格しましたか？」 は必須入力です。',
            'pass_date' => '「いつ合格しましたか？」 は必須入力です。',
            'test_style' => '「どの試験方式でしたか？」 は必須入力です。',
            'study_period' => '「勉強期間(時間)はどれくらいでしたか？」 は必須入力です。',
            'study_method' => '「どのような勉強法でしたか？」 は必須入力です。',
            'books_used' => '「使用した教材は何ですか？」 は必須入力です。',
            'advice' => '「合格の秘訣や受験生へアドバイスをお願いします。」 は必須入力です。',
            'nunber_times' => '「受験回数は何回ですか？」 は必須入力です。',
        ]);
    }
}
