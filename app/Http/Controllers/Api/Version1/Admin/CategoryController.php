<?php

namespace App\Http\Controllers\Api\Version1\Admin;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Version1\CategoryService;
use App\Http\Resources\Version1\CategoryResource;
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

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function show($uid)
    {
        $this->authorize('view-category');
           
        $category = $this->categoryService->findRecord($uid);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $uid)
    {
        $this->authorize('update-category');

        $category = $this->categoryService->updateRecord($uid, $request);
        
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'message' => 'Updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        $this->authorize('delete-category');

        $this->categoryService->deleteRecord($uid);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'message' => 'Deleted successfully'
        ], 200);
    }
}
