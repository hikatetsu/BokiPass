<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::factory()->count(1)->create()
            ->each(function ($post){
                $comments = \App\Models\Comment::factory()->count(1)->make();
                $post->comments()->saveMany($comments);
            });
    }
}
