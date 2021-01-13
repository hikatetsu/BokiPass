<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PostsTableSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommentTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    /**
     * 各テストメソッドの実行前に呼ばれる
     */
    public function setUp() :void
    {
        parent::setUp();

        // テストケース実行前に合格体験談データを作成する
        $param = [
            'user_id' => 1,
            'user_name' => 'テストユーザー',
            'pass_class' => str_random(20),
            'pass_date' => str_random(20),
            'test_style' => str_random(20),
            'study_period' => str_random(191),
            'study_method' => str_random(191),
            'books_used' => str_random(191),
            'advice' => str_random(191),
            'nunber_times' => str_random(20),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('posts')->insert($param);
    }

    /**
     * コメントの文字数がオーバーしている場合はバリデーションエラー
     * @test
     */
    public function character_limit()
    {
        $response = $this->post('/timeline/post/1/comment/create', [
            'user_id' => 1,
            'user_name' => 'テストユーザー',
            'body' => str_random(192),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'body' => 'コメント は191文字までです。',
        ]);
    }

    /**
     * コメントに入力忘れがある場合はバリデーションエラー
     * @test
     */
    public function forgot_to_write()
    {
        $response = $this->post('/timeline/post/1/comment/create', [
            'user_id' => 1,
            'user_name' => 'テストユーザー',
            'body' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'body' => 'コメント は必須入力です。',
        ]);
    }
}
