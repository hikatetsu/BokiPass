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
            'user_name' => '炭治郎',
            'pass_class' => '１',
            'pass_date' => '2020年11月',
            'test_style' => '筆記試験（統一試験方式）',
            'study_period' => '約１年',
            'study_method' => '専門学校に通って学びました。',
            'books_used' => '専門学校の教材です。',
            'advice' => '合格するまで勉強漬けですが、休息も大切です。',
            'free_column' => '頑張ってください。',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('posts')->insert($param);
    }
}
