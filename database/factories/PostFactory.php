<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(3);

    return [
        'title' => $title,
        'content' => $faker->paragraph(5),
        'slug' => str_slug($title),
        'is_published' => true,
        'category_id' => \App\Models\Category::inRandomOrder()->first('uid')->uid,
        'post_date' => now(),
        'posted_by' => \App\User::inRandomOrder()->first('uid')->uid,
        'uid' => uniqid(true),
    ];
});
