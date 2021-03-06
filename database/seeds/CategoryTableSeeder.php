<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(\App\Models\Category::class, 3)->create();

        foreach($categories as $key => $category) {
        	$category->createdBy->roles()->attach(1);
        }
    }
}
