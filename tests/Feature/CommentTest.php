<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PostsTableSeeder;
use Carbon\Carbon;

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
        $this->seed('PostsTableSeeder');
    }

    /**
     * コメントの文字数がオーバーしている場合はバリデーションエラー
     * @test
     */
    public function character_limit()
    {
        $response = $this->post('/timeline/post/1/comment/create', [
            'user_id' => 1,
            'user_name' => '炭治郎',
            'body' => str_random(192),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'body' => 'コメント は 191 文字までです。',
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
            'user_name' => '炭治郎',
            'body' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $response->assertSessionHasErrors([
            'body' => 'コメント は必須入力です。',
        ]);
    }
}
