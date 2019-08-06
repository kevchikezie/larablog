<?php

namespace Tests\Feature\Web\Admin;

use Tests\TestCase;
use Tests\MockedData\MockedRoles;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

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
        $this->actingAs($user);

        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $user->first()->roles()->attach($roleId);

        // Check if authenticated user has permission to view category listing
        $persmission = auth()->user()->hasAccess([$permission]);
    }

    /** @test */
    public function authorized_user_can_view_category_list()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'view-category');
        // There is category in the database
        $category = factory(\App\Models\Category::class)->create();
        // When an authorized user visits the categories page
        $response = $this->get(route('admin.categories.index'));
        // The Http response should be 200
        $response->assertStatus(200);
        // The user should be able to read (see) the name of the category
        $response->assertSee($category->name);
    }

    /** @test */
    public function unauthorized_user_cannot_view_category_list()
    {
        $this->withExceptionHandling();

        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'view-category');

        // There is category in the database
        $category = factory(\App\Models\Category::class)->create();

        // When an authorized user visits the categories page
        $response = $this->get(route('admin.categories.index'));
        
        // The Http response should be 403 (Forbidden)
        $response->assertForbidden();
    }

    /** @test */
    public function unauthenticated_user_cannot_view_category_list()
    {
        $this->withExceptionHandling();

        // Given there is category in the database
        $category = factory(\App\Models\Category::class)->create();

        // When an unauthorized user visits the categories page
        $response = $this->get(route('admin.categories.index'));

        // Redirect the user to the login page
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authorized_user_can_create_category()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'create-category');

        // Create a category and attempt to submit
        $category = factory(\App\Models\Category::class)->make();
        $response = $this->post(route('admin.categories.store'), $category->toArray());

        // The Http response should be 200
        $response->assertStatus(200);

        // Check if it gets stored in the database
        $this->assertEquals(1, \App\Models\Category::all()->count());
    }

    /** @test */
    public function unauthorized_user_cannot_create_category()
    {
        $this->withExceptionHandling();

        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'create-category');

        // Create a category and attempt to submit
        $category = factory(\App\Models\Category::class)->make();
        $response = $this->post(route('admin.categories.store'), $category->toArray());
        
        // The Http response should be 403 (Forbidden)
        $response->assertForbidden();
    }

    /** @test */
    public function unauthenticated_user_cannot_view_create_category_page()
    {
        $this->withExceptionHandling();

        // When an unauthorized user visits the categories page
        $response = $this->get(route('admin.categories.create'));

        // Redirect the user to the login page
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authorized_user_can_view_single_category()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'view-category');
        // There is category in the database
        $category = factory(\App\Models\Category::class)->create();
        // When an authorized user visits the categories page
        $response = $this->get(route('admin.categories.show', $category->uid));
        // The Http response should be 200
        $response->assertStatus(200);
        // The user should be able to read (see) the name of the category
        $response->assertSee($category->name);
        $response->assertSee($category->createdBy->first_name);
        $response->assertSee($category->createdBy->last_name);
        $response->assertSee($category->createdBy->uid);
    }

    /** @test */
    public function unauthorized_user_cannot_view_single_category()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'view-category');
        // There is category in the database
        $category = factory(\App\Models\Category::class)->create();
        // When an authorized user visits the categories page
        $response = $this->get(route('admin.categories.show', $category->uid));
        // The Http response should be 403 (Forbidden)
        $response->assertForbidden();
    }

    /** @test */
    public function authorized_user_can_update_category()
    {
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'update-category');
        // Create a category
        $category = factory(\App\Models\Category::class)->create();
        // Update the name
        $category->name = 'Updated name';
        // Hit the update endpoint to update the category
        $response = $this->put(route('admin.categories.update', $category->uid), $category->toArray());
        // The Http response should be 200
        $response->assertStatus(200);
        // The category should be updated on the database
        $this->assertDatabaseHas('categories', [
            'uid' => $category->uid, 'name' => 'Updated name'
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_update_category()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(5, 'update-category');
        // Create a category
        $category = factory(\App\Models\Category::class)->create();
        // Update the name
        $category->name = 'Updated name';
        // Hit the update endpoint to update the category
        $response = $this->put(route('admin.categories.update', $category->uid), $category->toArray());
        // The Http response should be 403 (Forbidden)
        $response->assertForbidden();
    }

    /** @test */
    public function unauthorized_user_cannot_view_edit_category_page()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(4, 'update-category');
        // There is category in the database
        $category = factory(\App\Models\Category::class)->create();
        // When an authorized user visits the categories page
        $response = $this->get(route('admin.categories.edit', $category->uid));
        // The Http response should be 403 (Forbidden)
        $response->assertForbidden();
    }

    /** @test */
    public function authorized_user_can_delete_category()
    {
        $this->withExceptionHandling();
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'delete-category');
        // Create a category
        $category = factory(\App\Models\Category::class)->create();
        // Hit the delete endpoint to delete the category
        $response = $this->delete(route('admin.categories.destroy', $category->uid));
        // The Http response should be 200
        $response->assertStatus(200);
        // The category should be deleted on the database
        $this->assertDatabaseMissing('categories', [
            'uid' => $category->uid
        ]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_category()
    {
        $this->withExceptionHandling();
        // The user has (author=4 or contributor=5) role assigned
        $this->checkUserPermission(5, 'delete-category');
        // Create a category
        $category = factory(\App\Models\Category::class)->create();
        // Hit the delete endpoint to delete the category
        $response = $this->delete(route('admin.categories.destroy', $category->uid));
        // The Http response should be 403 (Forbidden)
        $response->assertForbidden();
    }

    /** @test */
    public function a_category_must_have_name_filed_when_creating()
    {
        $this->withExceptionHandling();
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'create-category');
        $category = factory(\App\Models\Category::class)->make([
            'name' => null,
        ]);
        
        $response = $this->post(route('admin.categories.store'), $category->toArray())
                        ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_category_must_have_name_filed_when_updating()
    {
        $this->withExceptionHandling();
        // The user has (super-admin=1, admin=2 or editor=3) role assigned
        $this->checkUserPermission(1, 'update-category');
        // Create a category
        $category = factory(\App\Models\Category::class)->create();
        // Update the name
        $category->name = null;

        // Hit the update endpoint to update the category
        $response = $this->put(route('admin.categories.update', $category->uid), $category->toArray())
                         ->assertSessionHasErrors('name');
    }

}
