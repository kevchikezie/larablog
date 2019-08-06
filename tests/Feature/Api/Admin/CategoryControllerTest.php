<?php

namespace Tests\Feature\Api\Admin;

use Tests\TestCase;
use Tests\MockedData\MockedRoles;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Name of table
     *
     * @var string
     */
    protected $tableName = 'categories';
    
    /**
     * Check user's permission
     *
     * @param  int  roleId
     * @param  string  permission
     * @return void
     */
    protected function checkUserPermission(int $roleId, string $permission)
    {
        // Create all out expected roles
        new MockedRoles();

        // Given we have an authenticated user
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $user->first()->roles()->attach($roleId);

        // Check if authenticated user has permission to view category listing
        $persmission = auth()->user()->hasAccess([$permission]);
    }

    /** @test */
    public function authorized_user_can_access_list_category_api()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'view-category');
        $category = factory(\App\Models\Category::class, 3)->create();
        $response = $this->json('GET', route('api.admin.categories.index'));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'name' => $category->first()->name,
            'created_by' => $category->first()->createdBy->fullname,
            'modified_by' => $category->first()->modifiedBy->fullname,
            'description' => $category->first()->description,
            'uid' => $category->first()->uid,
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_access_list_category_api()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'view-category');
        $category = factory(\App\Models\Category::class, 3)->create();
        $response = $this->json('GET', route('api.admin.categories.index'));
        $response->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_access_create_category_api()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'create-category');
        $category = factory(\App\Models\Category::class)->make();
        $response = $this->json('POST', route('api.admin.categories.store'), $category->toArray());
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 201,
            'title' => 'Created',
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_access_create_category_api()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'view-category');
        $category = factory(\App\Models\Category::class)->make();
        $response = $this->json('POST', route('api.admin.categories.store'), $category->toArray());
        $response->assertStatus(403);
    }
    
    /** @test */
    public function authorized_user_can_access_view_single_category_api()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'view-category');
        $category = factory(\App\Models\Category::class)->create();
        $response = $this->json('GET', route('api.admin.categories.show', $category->uid));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'name' => $category->first()->name,
            'created_by' => $category->first()->createdBy->fullname,
            'modified_by' => $category->first()->modifiedBy->fullname,
            'description' => $category->first()->description,
            'uid' => $category->first()->uid,
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_access_view_single_category_api()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'view-category');
        $category = factory(\App\Models\Category::class)->make();
        $response = $this->json('GET', route('api.admin.categories.show', $category->uid));
        $response->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_access_update_category_api()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'update-category');
        // Create a category
        $category = factory(\App\Models\Category::class)->create();
        // Update the name and is_enabled fields
        $category->name = 'Updated name';
        $category->is_enabled = false;
        $this->assertArrayHasKey('uid', $category->toArray());
        $this->assertArrayHasKey('name', $category->toArray());
        $response = $this->json('PUT', route('api.admin.categories.update', $category->uid), $category->toArray());
        $this->assertDatabaseHas($this->tableName, [
            'name' => $category->name,
            'is_enabled' => $category->is_enabled
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_access_update_category_api()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'update-category');
        // Create a category
        $category = factory(\App\Models\Category::class)->create();
        // Update the name and is_enabled fields
        $category->name = 'Updated name';
        $category->is_enabled = false;
        $this->assertArrayHasKey('uid', $category->toArray());
        $this->assertArrayHasKey('name', $category->toArray());
        $response = $this->json('PUT', route('api.admin.categories.update', $category->uid), $category->toArray());
        $response->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_access_delete_category_api()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'delete-category');
        $category = factory(\App\Models\Category::class)->create();
        $response = $this->json('DELETE', route('api.admin.categories.destroy', $category->uid));
        $response->assertStatus(200);
        $this->assertDatabaseMissing($this->tableName, [
            'uid' => $category->uid
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_access_delete_category_api()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'delete-category');
        $category = factory(\App\Models\Category::class)->create();
        $response = $this->json('DELETE', route('api.admin.categories.destroy', $category->uid));
        $response->assertStatus(403);
        
    }
    
}
