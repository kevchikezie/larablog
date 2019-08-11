<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\MockedData\MokedRoles;
use Illuminate\Container\Container as App;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Services\Version1\CategoryService;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Name of table
     *
     * @var string
     */
    protected $tableName = 'categories';

    /**
     * Category service
     *
     * @var mixed 
     */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = $service = new CategoryService(new CategoryRepository(new App));
    }

    /** @test */
    public function can_fetch_only_enabled_categories()
    {
        // Given there is/are category/categories in the database
        factory(\App\Models\Category::class, 2)->create();
        // Fetch categories (assuming we are fetching only enabled records)
        $categories = $this->service->getEnabledRecords();
        // Loop through the returned result and get ONLY enabled records
        $enabledRecords = [];
        foreach ($categories as $category) {
            // Select ONLY enabled records
            if ($category['is_enabled'] == true) {
                $enabledRecords[] = $category;
            }
        }
        // Check if enabledRecords equals the number of fetched categories
        $this->assertEquals($categories->count(), count($enabledRecords));
    }

    /** @test */
    public function can_fetch_all_categories()
    {
        // Given there is/are category/categories in the database
        factory(\App\Models\Category::class, 2)->create();
        // Fetch all categories (enabled and disabled records)
        $categories = $this->service->getAllRecords();
        // Loop through the returned result
        $records = [];
        foreach ($categories as $category) {
            $this->assertArrayHasKey('name', $category->toArray());
            $this->assertArrayHasKey('uid', $category->toArray());
            $this->assertArrayHasKey('slug', $category->toArray());
            $this->assertArrayHasKey('is_enabled', $category->toArray());
            $this->assertArrayHasKey('id', $category->toArray());
            // Ensure that the "with createdBy" relationship fetches the required fields
            $this->assertArrayHasKey('first_name', $category->createdBy);
            $this->assertArrayHasKey('last_name', $category->createdBy);
            $this->assertArrayHasKey('uid', $category->createdBy);
            // Ensure that the "with modifiedBy" relationship fetches the required fields
            $this->assertArrayHasKey('modified_by', $category->toArray());

            $records[] = $category;
        }
        // Check if records equals the number of fetched categories
        $this->assertEquals($categories->count(), count($records));
    }

    /** @test */
    public function can_create_new_category()
    {
        // Given we have an authenticated user
        $this->actingAs(factory(\App\User::class)->create());
        // Create a new category
        $category = factory(\App\Models\Category::class)->make();
        $this->assertArrayHasKey('name', $category->toArray());
        $this->assertArrayHasKey('is_enabled', $category->toArray());
        // Pass category into the createRecord function
        $record = $this->service->createRecord($category->toArray());
        // Check if the returned record is same as the one sent to the database
        $this->assertEquals($category->name, $record->name);
        $this->assertDatabaseHas($this->tableName, [
            'name' => $category->name,
            'is_enabled' => $category->is_enabled
        ]);
    }

    /** @test */
    public function can_fetch_single_category()
    {
        $category = factory(\App\Models\Category::class)->create();
        $this->assertArrayHasKey('uid', $category->toArray());
        $record = $this->service->findRecord($category->first()->uid);
        $this->assertEquals($category->first()->uid, $record->uid);
        // Ensure that the "with createdBy" relationship fetches the required fields
        $this->assertArrayHasKey('first_name', $record->createdBy);
        $this->assertArrayHasKey('last_name', $record->createdBy);
        $this->assertArrayHasKey('uid', $record->createdBy);
        // Ensure that the "with modifiedBy" relationship fetches the required fields
        $this->assertArrayHasKey('modified_by', $record->toArray());
    }

    /** @test */
    public function can_update_category()
    {
        $this->actingAs(factory(\App\User::class)->create());  
        $category = factory(\App\Models\Category::class)->create();
        $category->name = 'New category name';
        // Check for some required fields
        $this->assertArrayHasKey('name', $category->toArray());
        $this->assertArrayHasKey('is_enabled', $category->toArray());
        $this->assertArrayHasKey('uid', $category->toArray());
        $record = $this->service->updateRecord($category->uid, $category->toArray()); 
        $this->assertDatabaseHas($this->tableName, [
            'name' => $category->name,
            'is_enabled' => $category->is_enabled
        ]);
        $this->assertTrue($record);
    }

    /** @test */
    public function can_delete_category()
    {
        $category = factory(\App\Models\Category::class)->create();
        $this->assertArrayHasKey('uid', $category->toArray());
        $record = $this->service->deleteRecord($category->uid); 
        $this->assertDatabaseMissing('categories', [
            'uid' => $category->uid
        ]);
        $this->assertTrue($record);
    }
}
