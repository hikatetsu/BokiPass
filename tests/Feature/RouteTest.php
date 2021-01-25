<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PostsTableSeeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RouteTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
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

        // テストケース実行前に合格体験談データを作成(/timeline表示のため)
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
     * ログイン認証が必要なページにゲストがアクセスするとエラー
     * @test
     */
    public function test_authentication()
    {
        // ログアウトする
        Auth::logout();

        //ゲストでもアクセスできるページ(200)
        $this->get('/timeline')->assertStatus(200);
        $this->get('/timeline/post/1')->assertStatus(200);
        $this->get('/timeline/squeeze')->assertStatus(200);

        // ゲストだとアクセスできないページ(302)
        $this->get('/timeline/post/create')->assertStatus(302);
        $this->post('/timeline/post/create')->assertStatus(302);

        $this->get('/timeline/post/1/edit')->assertStatus(302);
        $this->post('/timeline/post/1/edit')->assertStatus(302);

        $this->post('/timeline/post/1/delete')->assertStatus(302);

        $this->post('/timeline/post/1/comment/create')->assertStatus(302);

        $this->post('/timeline/post/1/comment/delete')->assertStatus(302);

        $this->post('/timeline/like/ajax')->assertStatus(302);

        $this->post('/timeline/user/delete')->assertStatus(302);
    }
}
