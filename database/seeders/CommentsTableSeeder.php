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
        \App\Models\Post::factory()->create()
            ->each(function ($post){
                $comments = \App\Models\Comment::factory()->make();
                $post->comments()->save($comments);
            });
    }
}
