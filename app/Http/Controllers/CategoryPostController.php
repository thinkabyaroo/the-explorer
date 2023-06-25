<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Http\Requests\StoreCategoryPostRequest;
use App\Http\Requests\UpdateCategoryPostRequest;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryPostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryPost $categoryPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryPost $categoryPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryPostRequest  $request
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryPostRequest $request, CategoryPost $categoryPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryPost $categoryPost)
    {
        //
    }
}
