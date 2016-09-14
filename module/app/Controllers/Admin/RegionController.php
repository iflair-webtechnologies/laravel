<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Villato\Http\Requests\Admin\Region\CreateRegionRequest;
use Villato\Http\Requests\Admin\Region\UpdateRegionRequest;
use Villato\Region;

class RegionController extends CrudController
{

    /**
     * Display a listing of the regions.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.region.index');
    }

    public function data()
    {
        DB::enableQueryLog();
        $regions = Region::select([
            'id',
            'name',
            'slug',
            'population',
            'active',
            // 'priceflag',
            // 'catprice',
            'created_at',
            'updated_at'
        ])->withInactive();

        return $this->createCrudDataTable($regions, 'admin.region.destroy', 'admin.region.edit')
            ->editColumn('active', '
                @if($active)
                    <i class="fa fa-check text-green"></i>
                @else
                    <i class="fa fa-times text-red"></i>
                @endif')
            ->make(true);
    }

    /**
     * Show the form for creating a new region.
     *
     * @return Response
     */
    public function create()
    {
        
        return view('admin.region.create');
    }

    /**
     * Store a newly created region in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateRegionRequest $request)
    {
        $region = new Region;
        $post = $request->all();
        // if (isset($post['priceflag']) && !empty($post['priceflag'])) {
        //     $post['priceflag'] = 'Paid';
        // }else{
        //     $post['priceflag'] = 'Free';
        // }
        //echo "<pre>";print_r($post);exit;
        $region->fill($post);
        $region->save();

        return $this->redirectSuccess('admin.region.index', 'Successfully created region!');
    }

    /**
     * Show the form for editing the specified region.
     *
     * @param  Region $region
     * @return Response
     */
    public function edit(Region $region)
    {
        return view('admin.region.edit', [
            'region' => $region
        ]);
    }

    /**
     * Update the specified region in storage.
     *
     * @param Region $region
     * @param Request $request
     * @return Response
     */
    public function update(Region $region, UpdateRegionRequest $request)
    {
        $post = $request->all();
        // if (isset($post['priceflag']) && !empty($post['priceflag'])) {
        //     $post['priceflag'] = 'Paid';
        // }else{
        //     $post['priceflag'] = 'Free';
        // }
       // echo "<pre>";print_r($post);exit;
        $region->fill($post);
        $region->save();

        return $this->redirectSuccess('admin.region.index', 'Successfully updated region!');
    }

    /**
     * Remove the specified region from storage.
     *
     * @param Region $region
     * @return Response
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return $this->redirectSuccess('admin.region.index', 'Successfully deleted region!');
    }

}

