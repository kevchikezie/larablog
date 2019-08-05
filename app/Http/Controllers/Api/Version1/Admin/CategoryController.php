<?php

namespace App\Http\Controllers\Api\Version1\Admin;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Version1\CategoryService;
use App\Http\Resources\Version1\CategoryCollection;

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
     * @return \App\Http\Resources\Version1\CategoryCollection
     */
    public function index()
    {
        $this->authorize('view-category');
        
    	$categories = $this->categoryService->getAllRecords();

        return new CategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('create-category');

        $category = $this->categoryService->createRecord($request);

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'title' => 'Created',
            'message' => 'Done successfully',
            'method' => request()->method(),
            'url' => request()->fullUrl(),
        ], 201);
    }
}
