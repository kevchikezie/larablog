<?php

use App\Models\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(3);

    return [
        'title' => $title,
        'content' => $faker->paragraph(5),
        'uid' => uniqid(true),
        'user_id' => User::inRandomOrder()->first('id')->id,
        'slug' => str_slug($title),
    ];
});
