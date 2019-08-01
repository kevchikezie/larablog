<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService 
{
	/**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
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
   
}