<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = factory(\App\User::class, 5)->create(); // Iteration should not exceed the number of available roles

    	foreach ($users as $key => $user) {
	    	$user->roles()->attach($key+1); // Array key starts from 0 but role_id starts from 1
    	}
    }
}
