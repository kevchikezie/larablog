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
            $table->string('category_id');
            $table->datetime('post_date');
            $table->string('posted_by');
            $table->string('modified_by')->nullable();
            $table->string('published_by')->nullable();
            $table->datetime('published_on')->nullable();
            $table->string('uid')->unique();
            $table->string('image_url')->nullable();
            $table->string('image_name')->nullable();
            $table->timestamps();

            $table->foreign('posted_by')
                    ->references('uid')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('modified_by')
                    ->references('uid')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('published_by')
                    ->references('uid')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('category_id')
                    ->references('uid')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
