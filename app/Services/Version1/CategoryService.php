<?php

namespace App\Services\Version1;

use App\Services\CloudinaryService;
use App\Repositories\CategoryRepository;

class CategoryService 
{
	/**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(
        CloudinaryService $cloudinaryService,
        CategoryRepository $categoryRepository
    ) {
        $this->cloudinaryService = $cloudinaryService;
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
     * Create new record
     *
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($data)
    {
        if (! empty($data['photo'])) {
            $image = $this->cloudinaryService->upload($data['photo']);
        }

        return $this->categoryRepository->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'slug' => $data['name'],
            'is_enabled' => $data['is_enabled'],
            'created_by' => auth()->user()->uid,
            'uid' => uniqid(true),
            'image_url' => $image['secure_url'] ?? null,
            'image_name' => $image['public_id'] ?? null,
        ]);
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
        $category = $this->findRecord($uid, ['image_url', 'image_name']);

        if (! empty($data['photo'])) {
            $image = $this->cloudinaryService->update($data['photo'], $category->image_name);
        }

        return $this->categoryRepository->update($uid, [
            'name' => $data['name'],
            'description' => $data['description'],
            'slug' => $data['name'],
            'is_enabled' => $data['is_enabled'],
            'modified_by' => auth()->user()->uid,
            'image_url' => $image['secure_url'] ?? $category->image_url,
            'image_name' => $image['public_id'] ?? $category->image_name,
        ]);
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
       return $this->categoryRepository->delete($uid, $attribute);
    }
   
}