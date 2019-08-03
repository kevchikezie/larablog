<?php

namespace Tests\Feature;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_cannot_access_view_category_list_route()
    {
        $this->withExceptionHandling();
        $response = $this->get(route('admin.categories.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthenticated_user_cannot_access_single_category_route()
    {
        $this->withExceptionHandling();
        $category = factory(\App\Models\Category::class)->create();
        $response = $this->get(route('admin.categories.show', $category->uid));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthenticated_user_cannot_access_create_category_route()
    {
        $this->withExceptionHandling();

        $response = $this->get(route('admin.categories.create'));
        $category = factory(\App\Models\Category::class)->make();
        $response2 = $this->post(route('admin.categories.store'), $category->toArray());
        
        $response->assertRedirect(route('login'));
        $response2->assertRedirect(route('login'));
    }
    
}
