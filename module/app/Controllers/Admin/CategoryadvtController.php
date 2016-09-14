<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Categoryadvt;
use Villato\Http\Requests\Admin\Categoryadvt\CreateCategoryadvtRequest;
use Villato\Http\Requests\Admin\Categoryadvt\UpdateCategoryadvtRequest;

class CategoryadvtController extends CrudController
{

    /**
     * Display a listing of the categories.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.categoryadvt.index');
    }

    public function data()
    {
        $categories = Categoryadvt::select([
            'id',
            'name',            
            'created_at',
            'updated_at'
        ]);
        //echo "<pre>";print_r($categories);exit;
        return $this->createCrudDataTable($categories, 'admin.categoryadvt.destroy', 'admin.categoryadvt.edit')->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categoryadvt.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateCategoryadvtRequest $request)
    {
        $category = new Categoryadvt;
        $post = $request->all();
        //echo "<pre>";print_r($post);exit;
        $category->fill($post);
        $category->save();

        return $this->redirectSuccess('admin.categoryadvt.index', 'Successfully created category!');
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Categoryadvt $category)
    {   
       // echo "<pre>";print_r($category);exit;
        return view('admin.categoryadvt.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param Categort $category
     * @param Request $request
     * @return Response
     */
    public function update(Categoryadvt $category, UpdateCategoryadvtRequest $request)
    {
        $post = $request->all();        
        $category->fill($post);
        $category->save();
        return $this->redirectSuccess('admin.categoryadvt.index', 'Successfully updated category!');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Categoryadvt $category)
    {
        $category->delete();

        return $this->redirectSuccess('admin.categoryadvt.index', 'Successfully deleted category!');
    }

}
