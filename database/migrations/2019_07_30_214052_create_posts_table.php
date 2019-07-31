<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->text('title');
            $table->longText('content');
            $table->string('slug')->unique()->length(500);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_comment_allowed')->default(true);
            $table->datetime('posted_on')->nullable();
            $table->string('uid')->unique();
            $table->unsignedInteger('user_id');
            $table->string('image_url')->nullable();
            $table->string('image_name')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
