<?php

namespace Tests\MockedData;

use App\Models\Role;

class MockedRoles
{
	public function __construct()
	{
		$this->run();
	}

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'description' => 'Somebody with access to the site network administration features and all other features. Also known as the Developer.',
            'permissions' => [
                'create-post' => true,
                'view-post' => true,
                'view-others-post' => true,
                'update-post' => true,
                'update-others-post' => true,
                'delete-post' => true,
                'delete-others-post' => true,
                'publish-post' => true,
                'create-category' => true,
                'view-category' => true,
                'update-category' => true,
                'delete-category' => true,
                'create-user' => true,
                'view-user' => true,
                'update-user' => true,
                'delete-user' => true,
                'promote-user' => true,
                'deactivate-user' => true,
                'manage-site-info' => true,
            ]
        ]);

        $administrator = Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'description' => 'Somebody who has access to all the administration features.',
            'permissions' => [
                'create-post' => true,
                'view-post' => true,
                'view-others-post' => true,
                'update-post' => true,
                'update-others-post' => true,
                'delete-post' => true,
                'delete-others-post' => true,
                'publish-post' => true,
                'create-category' => true,
                'view-category' => true,
                'update-category' => true,
                'delete-category' => true,
                'create-user' => true,
                'view-user' => true,
                'update-user' => true,
                'delete-user' => true,
                'promote-user' => true,
                'deactivate-user' => true,
                'manage-site-info' => true,
            ]
        ]);

        $editor = Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'description' => 'Somebody who can publish and manage posts including the posts of other users.',
            'permissions' => [
                'create-post' => true,
                'view-post' => true,
                'view-others-post' => true,
                'update-post' => true,
                'update-others-post' => true,
                'delete-post' => true,
                'delete-others-post' => true,
                'publish-post' => true,
                'create-category' => true,
                'view-category' => true,
                'update-category' => true,
                'delete-category' => true,
                'create-user' => false,
                'view-user' => false,
                'update-user' => false,
                'delete-user' => false,
                'promote-user' => false,
                'deactivate-user' => false,
                'manage-site-info' => false,
            ]
        ]);

        $author = Role::create([
            'name' => 'Author',
            'slug' => 'author',
            'description' => 'Somebody who can publish and manage only their own posts.',
            'permissions' => [
                'create-post' => true,
                'view-post' => true,
                'view-others-post' => false,
                'update-post' => true,
                'update-others-post' => false,
                'delete-post' => true,
                'delete-others-post' => false,
                'publish-post' => true,
                'create-category' => false,
                'view-category' => false,
                'update-category' => false,
                'delete-category' => false,
                'create-user' => false,
                'view-user' => false,
                'update-user' => false,
                'delete-user' => false,
                'promote-user' => false,
                'deactivate-user' => false,
                'manage-site-info' => false,
            ]
        ]);

        $contributor = Role::create([
            'name' => 'Contributor',
            'slug' => 'contributor',
            'description' => 'Somebody who can write and manage their own posts but cannot publish them.',
            'permissions' => [
                'create-post' => true,
                'view-post' => true,
                'view-others-post' => false,
                'update-post' => true,
                'update-others-post' => false,
                'delete-post' => true,
                'delete-others-post' => false,
                'publish-post' => false,
                'create-category' => false,
                'view-category' => false,
                'update-category' => false,
                'delete-category' => false,
                'create-user' => false,
                'view-user' => false,
                'update-user' => false,
                'delete-user' => false,
                'promote-user' => false,
                'deactivate-user' => false,
                'manage-site-info' => false,
            ]
        ]);
    }
}