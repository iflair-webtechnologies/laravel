<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Category;
use Villato\Region;
use Villato\General;
use Villato\Http\Requests\Admin\Category\CreateCategoryRequest;
use Villato\Http\Requests\Admin\Category\UpdateCategoryRequest;
use DB;

class CategoryController extends CrudController
{

    /**
     * Display a listing of the categories.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    public function data()
    {
        $categories = Category::select([
            'id',
            'name',
            'slug',           
            'created_at',
            'updated_at'
        ]);
        //echo "<pre>";print_r($categories);exit;
        return $this->createCrudDataTable($categories, 'admin.category.destroy', 'admin.category.edit')->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $regions = Region::where('active','1')->get();
       // dd($regions);
        return view('admin.category.create',['regions'=>$regions]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
             
         if(empty($request->input('regions'))){
            return redirect('/admin/category/create')
            ->withErrors([
                'regions' => 'regions is verplicht.',
            ]);
         }
           //dd($request->input('regions'));  
        $category = new Category;
        $post = $request->except(['regions']);       
        $category->fill($post);
        $category->save();
        $lastID = DB::getPdo()->lastInsertId();

        foreach ($request->input('regions') as $region) {
            $category->regions()->attach($region , ['category_id' => $lastID]);
        }


        return $this->redirectSuccess('admin.category.index', 'Successfully created category!');
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {   
        $general = new General();
		$catregions = array();
        $con['category_id ='] = $category->id;
        $regions = Region::where('active','1')->get();
        $general->set_table('category_region_relation');
        $result = $general->get('region_id',1,$con);
        foreach ($result as $key => $value) {
            $catregions[] = $value['region_id'];
        }        
        return view('admin.category.edit', [
            'category' => $category,'regions'=>$regions,'catregions'=>$catregions
        ]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param Categort $category
     * @param Request $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        if(empty($request->input('regions'))){
            return redirect('/admin/category/'.$category->id.'/edit')
            ->withErrors([
                'regions' => 'regions is verplicht.',
            ]);
         }
        $post = $request->except(['regions']);       
        $category->fill($post);
        $category->save();  
        foreach ($category->regions as $region) {
            $category->regions()->detach($region->id);
        }

        foreach ($request->input('regions') as $region) {
            $category->regions()->attach($region , ['category_id' => $category->id]);
        }
        return $this->redirectSuccess('admin.category.index', 'Successfully updated category!');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->redirectSuccess('admin.category.index', 'Successfully deleted category!');
    }

}
