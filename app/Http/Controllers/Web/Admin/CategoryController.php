<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest; 
use App\Http\Services\Version1\CategoryService;

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
        $this->authorize('view-category');

    	$categories = $this->categoryService->getallRecords();

    	return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-category');

        return 'Place the create category page here';
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

        $this->categoryService->createRecord($request);

        return 'Created successful!';
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

        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $this->authorize('update-category');

        $category = $this->categoryService->findRecord($uid);

        return $category;
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

        $this->categoryService->updateRecord($uid, $request);

        return 'Updated successfully';
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

        return 'Deleted successfully!';
    }
}
