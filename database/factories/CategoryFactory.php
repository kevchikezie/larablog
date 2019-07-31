<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
	$name = $faker->unique()->sentence(3);
	
    return [
        'name' => $faker->unique()->sentence(3),
        'description' => $faker->paragraph(5),
        'slug' => str_slug($name),
        'uid' => uniqid(true),
        'created_by' => \App\User::inRandomOrder()->first('uid')->uid,
    ];
});
