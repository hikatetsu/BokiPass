<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'user_name' => 'テストユーザー',
            'pass_class' => '１',
            'pass_date' => '2020年11月',
            'test_style' => '筆記試験',
            'study_period' => '１年ちょっとです。平日は約３時間、休日は約７時間ほど勉強していました。',
            'study_method' => '専門学校の社会人コースに通って学びました。専門学校の合格カリキュラムを信じて勉強に集中しました。自習室が使えて、基礎から本試験予想問題までサポートしてくれるので私は満足でした。',
            'books_used' => '基本は専門学校の教材です。プラスアルファで市販の○○という問題集も解いていました。あと、理論を覚えるために市販の□□という本も使っていました。',
            'advice' => '合格の秘訣はひたすら問題を解くことだと思います。最初は間違えても次回は間違えないように心がけて復習していました。１級合格を目指すなら勉強漬けになると思いますが、休むことも大切です。頑張りすぎて心が折れないように気をつけてください。',
            'nunber_times' => '２回',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('posts')->insert($param);
    }
}
