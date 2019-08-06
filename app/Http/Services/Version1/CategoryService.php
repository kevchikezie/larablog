<?php

namespace App\Http\Services\Version1;

use DB;
use App\Services\CloudinaryService;
use App\Contracts\Repositories\CategoryRepositoryInterface as CategoryRepository;

class CategoryService 
{
	/**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Fetch resource
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getEnabledRecords(int $perPage = 0, array $columns = array('*'))
    {
        return $this->categoryRepository->enabledRecords($perPage, $columns);
    }

    /**
     * Fetch resource
     *
     * @param  int    $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getAllRecords(int $perPage = 0, array $columns = array('*'))
    {
        return $this->categoryRepository->allRecords($perPage, $columns);
    }

    /**
     * Create new record
     *
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($data)
    {
        DB::beginTransaction();

        if (! empty($data['photo'])) {
            $cloudinary = new CloudinaryService;
            $image = $cloudinary->upload($data['photo']);
        }

        $category = $this->categoryRepository->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'slug' => $data['name'],
            'is_enabled' => $data['is_enabled'] ?? true,
            'created_by' => auth()->user()->uid,
            'uid' => uniqid(true),
            'image_url' => $image['secure_url'] ?? null,
            'image_name' => $image['public_id'] ?? null,
        ]);

        DB::commit();

        return $category;
    }

    /**
     * Find a record
     *
     * @param  string  $uid
     * @param  array  $columns
     * @return mixed
     */
    public function findRecord(string $uid, array $columns = array('*'))
    {
       return $this->categoryRepository->find($uid, $columns);
    }

    /**
     * Update record
     *
     * @param  string  $uid
     * @param  array  $data
     * @param  string  $attribute
     * @return mixed
     */
    public function updateRecord($uid, $data, string $attribute = '')
    {
        DB::beginTransaction();

        $category = $this->findRecord($uid, ['image_url', 'image_name', 'uid']);

        if (! empty($data['photo'])) {
            $cloudinary = new CloudinaryService;
            $image = $cloudinary->update($data['photo'], $category->image_name);
        }
        
        $category = $this->categoryRepository->update($uid, [
            'name' => $data['name'],
            'description' => $data['description'],
            'slug' => str_slug($data['name']),
            'is_enabled' => $data['is_enabled'],
            'modified_by' => auth()->user()->uid,
            'image_url' => $image['secure_url'] ?? $category->image_url,
            'image_name' => $image['public_id'] ?? $category->image_name,
        ]);

        DB::commit();

        return $category;
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  string  $uid
     * @param  string  $attribute
     * @return bool
     */
    public function deleteRecord($uid, string $attribute = '')
    {
        DB::beginTransaction();

        $category = $this->findRecord($uid, ['image_name']);
        if ($category->image_name != '' || ! is_null($category->image_name)) {
            $cloudinary = new CloudinaryService;
            $cloudinary->delete($category->image_name);
        }

        $category = $this->categoryRepository->delete($uid, $attribute);

        DB::commit();

        return $category;
    }
   
}