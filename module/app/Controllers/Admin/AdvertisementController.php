<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Categoryadvt;
use Villato\Http\Requests\Admin\Advertisement\CreateAdvertisementRequest;
use Villato\Http\Requests\Admin\Advertisement\UpdateAdvertisementRequest;
use Villato\Advertisement;
use Villato\Image as Image;
use Villato\Traits\ImageTrait;
use yajra\Datatables\Datatables;

class AdvertisementController extends CrudController
{

    use ImageTrait;
    /**
     * Display a listing of the advertisement.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.advertisement.index');
    }

    /**
     * Returns the datatables data of advertisement
     *
     * @return Datatables
     */
    public function data()
    {
        $advertisement = Advertisement::leftJoin('categoryadvt', 'advertisement.categoryadvt_id', '=', 'categoryadvt.id')
            ->select([
                'advertisement.id',
                'advertisement.name',
                'advertisement.slug',
                'advertisement.content',               
                'advertisement.created_at',
                'advertisement.updated_at',
                'categoryadvt.name as categoryname',
                'company.name as companyname'
            ])->leftJoin('company','advertisement.company_id','=','company.id');

        return $this->createCrudDataTable($advertisement, 'admin.advertisement.destroy', 'admin.advertisement.edit')->make(true);
    }

    /**
     * Show the form for creating a new advertisement.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Categoryadvt::all();
        //echo "<pre>";print_r($categories);exit;
        return view('admin.advertisement.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateAdvertisementRequest $request)
    {
        $advertisement = new Advertisement;
        $post = $request->except(['']);
        $advertisement->fill($post);
        $category = Categoryadvt::find($request->input('category'));
        $advertisement->categoryadvt()->associate($category);
        $advertisement->save();

        if($request->hasFile('image')) {
            $image = $this->saveImage(new Image, $request->file('image'));
            $advertisement->images()->save($image);
        }
        return $this->redirectSuccess('admin.advertisement.index', 'Successfully created product!');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Advertisement $advertisement)
    {
      //  echo $advertisement->id;exit;
        $imgurl =  $_SERVER['DOCUMENT_ROOT'].'/mdv/public/image/large/';
        $imgsrc = url();
        $categories = Categoryadvt::all();
        $image = Image::where('imageable_id', '=', $advertisement->id)->where('imageable_type','=','Villato\Advertisement');
        
        if (!empty($image->first()->path)) {
            $imgurl  .= $image->first()->path;
            $imgsrc .= '/image/large/'.$image->first()->path;
        }else
        {
            $imgurl  =  "";
            $imgsrc = '';
        }
        //echo "<pre>";print_r($imgsrc);exit;
        return view('admin.advertisement.edit', [
            'categories' => $categories,
            'advertisement' => $advertisement,
            'imgurl'=>$imgurl,
            'imgsrc' => $imgsrc
        ]);
    }

    /**
     * Update the specified Advertisement in storage.
     *
     * @param Product $Advertisement
     * @param Request $request
     * @return Response
     */
    public function update(Advertisement $advertisement, UpdateAdvertisementRequest $request)
    {   

        $imgname = $request->input('imgstatus');
        if (!empty($imgname) && !$request->hasFile('image')) {
            $advertisement->updateimg($advertisement->id,'Villato\Advertisement');    
        }        
       
        $post = $request->except(['category','imgstatus']); 
        // dd($post);       
        $advertisement->fill($post);
        
        $category = Categoryadvt::find($request->input('category'));
        //dd($category);
        $advertisement->categoryadvt()->associate($category);
        $advertisement->save();

        if($request->hasFile('image')) {
            // echo $request->file('image')."\n";
            // echo "<pre>";print_r($advertisement->images->first());exit;
            $image = $this->saveImage($advertisement->images->first(), $request->file('image'));
           // echo "<pre>";print_r($image);exit;
            $advertisement->images()->save($image);
        }

        return $this->redirectSuccess('admin.advertisement.index', 'Successfully updated product!');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

        return $this->redirectSuccess('admin.advertisement.index', 'Successfully deleted product!');
    }

}
