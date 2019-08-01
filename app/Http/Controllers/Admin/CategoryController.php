<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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

    	$categories = $this->categoryService->getEnabledRecords();

    	return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('create-category'), 403);

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
        abort_unless(Gate::allows('create-category'), 403);

        /*
        // DELETE THIS AFTER CONNECTING TO FRONTEND
        $request = [
            'name' => 'Sports',
            'description' => '',
            'is_enabled' => true,
            'slug' => 'Sports',
        ];
        */

        DB::beginTransaction();
        $this->categoryService->createRecord($request);
        DB::commit();

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
        abort_unless(Gate::allows('update-category'), 403);

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
        abort_unless(Gate::allows('update-category'), 403);

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
        abort_unless(Gate::allows('update-category'), 403);

        /*
        // DELETE THIS AFTER CONNECTING TO FRONTEND
        $request = [
            'name' => 'Foreign Sports',
            'description' => '',
            'is_enabled' => true,
            'slug' => 'Foreign Sports',
        ];
        */

        DB::beginTransaction();
        $this->categoryService->updateRecord($uid, $request);
        DB::commit();

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
        abort_unless(Gate::allows('delete-category'), 403);

        DB::beginTransaction();
        $this->categoryService->deleteRecord($uid);
        DB::commit();

        return 'Deleted successfully!';
    }
}
