<?php

use App\User;
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
        $superAdmin = User::create([
            'first_name' => 'Kev',
	        'last_name' => 'Chike',
	        'email' => 'kevchike@mail.com',
	        'username' => 'kevchike',
	        'uid' => uniqid(true),
	        'is_active' => true,
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Str::random(10),
        ]);
        $superAdmin->roles()->attach(1);

        $admin = User::create([
            'first_name' => 'Admin',
	        'last_name' => 'Joe',
	        'email' => 'admin@mail.com',
	        'username' => 'admin_joe',
	        'uid' => uniqid(true),
	        'is_active' => true,
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Str::random(10),
        ]);
        $admin->roles()->attach(2);

        $editor = User::create([
            'first_name' => 'Editor',
	        'last_name' => 'Peter',
	        'email' => 'editor@mail.com',
	        'username' => 'editor_peter',
	        'uid' => uniqid(true),
	        'is_active' => true,
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Str::random(10),
        ]);
        $editor->roles()->attach(3);

        $author = User::create([
            'first_name' => 'Author',
	        'last_name' => 'Jane',
	        'email' => 'author@mail.com',
	        'username' => 'author_jane',
	        'uid' => uniqid(true),
	        'is_active' => true,
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Str::random(10),
        ]);
        $author->roles()->attach(4);

        $contributor = User::create([
            'first_name' => 'Contributor',
	        'last_name' => 'Rita',
	        'email' => 'contributor@mail.com',
	        'username' => 'contributor_rita',
	        'uid' => uniqid(true),
	        'is_active' => true,
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Str::random(10),
        ]);
        $contributor->roles()->attach(5);
    }
}
