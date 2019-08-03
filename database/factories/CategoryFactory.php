<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
	$name = $faker->unique()->sentence(3);

    return [
        'name' => $name,
        'description' => $faker->paragraph(5),
        'slug' => str_slug($name),
        'uid' => uniqid(true),
        'created_by' => factory(\App\User::class)->create()->uid,
    ];
});
