<?php

namespace App\Http\Controllers\Api\Version1\Admin;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Version1\CategoryService;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('view-category'), 403);
        
    	return $this->categoryService->getEnabledRecords();
    }
}
