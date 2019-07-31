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
     * @return mixed
     */
    public function getRecords()
    {
        return $this->categoryRepository->all();
    }

   
}