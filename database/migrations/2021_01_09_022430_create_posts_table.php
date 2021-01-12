<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('user_name',191);
            $table->string('pass_class',20);
            $table->string('pass_date',20);
            $table->string('test_style',20);
            $table->string('study_period',191);
            $table->string('study_method',191);
            $table->string('books_used',191);
            $table->string('advice',191);
            $table->string('nunber_times',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
