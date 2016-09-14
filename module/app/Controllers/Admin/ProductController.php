<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Category;
use Villato\Http\Requests\Admin\Product\CreateProductRequest;
use Villato\Http\Requests\Admin\Product\UpdateProductRequest;
use Villato\Product;
use Villato\General;
use yajra\Datatables\Datatables;
use DB;

class ProductController extends CrudController
{

    /**
     * Display a listing of the products.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Returns the datatables data of products
     *
     * @return Datatables
     */
    public function data()
    {
       // $products = Product::leftJoin('product_cateogry_relation', 'product.id', '=', 'product_cateogry_relation.product_id')->
             $products = Product::select([
                'product.id',
                'product.name',
                'product.slug',               
                'product.created_at',
                'product.updated_at'               
            ]);

        return $this->createCrudDataTable($products, 'admin.product.destroy', 'admin.product.edit')->make(true);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        if(empty($request->input('category'))){
            return redirect('/admin/product/create')
            ->withErrors([
                'category' => 'category is verplicht.',
            ]);
         }

        $product = new Product;
        $post = $request->except(['category']);        
        $product->fill($post);        
        $product->save();
        $lastID = DB::getPdo()->lastInsertId();

        foreach ($request->input('category') as $category) {
            $product->category()->attach($category , ['product_id' => $lastID]);
        }


        return $this->redirectSuccess('admin.product.index', 'Successfully created product!');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $general = new General();
		$procategory = array();
        $con['product_id ='] = $product->id;
        $general->set_table('product_category_relation');
        $result = $general->get('category_id',1,$con);
        foreach ($result as $key => $value) {
            $procategory[] = $value['category_id'];
        }   
        $categories = Category::all();
        //echo "<pre>";print_r($procategory);exit;
        return view('admin.product.edit', [
            'categories' => $categories,
            'product' => $product,
            'procategory' => $procategory,
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
         if(empty($request->input('category'))){
            return redirect('/admin/product/'.$product->id.'/edit')
            ->withErrors([
                'category' => 'category is verplicht.',
            ]);
         }

        $post = $request->except(['category']);
        $product->fill($post);
        $product->save();

        foreach ($product->category as $category) {
            $product->category()->detach($category->id);
        }

        foreach ($request->input('category') as $category) {
            $product->category()->attach($category , ['product_id' => $product->id]);
        }

        return $this->redirectSuccess('admin.product.index', 'Successfully updated product!');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->redirectSuccess('admin.product.index', 'Successfully deleted product!');
    }

}
