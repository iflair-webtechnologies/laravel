<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Http\Requests\Admin\Cms\CreateCmsRequest;
use Villato\Http\Requests\Admin\Cms\UpdateCmsRequest;
use Villato\Cms;
use yajra\Datatables\Datatables;

class CmsController extends CrudController
{
	public function index()
    {
    	return view('admin.cms.index');
    }

    /**
     * Returns the datatables data of newss
     *
     * @return Datatables
     */
    public function data()
    {
        $cms = Cms::select([
                'id',
                'title',
                'content',
                'created_at',
                'updated_at',                
            ]);
        //echo "<pre>";print_r($cms);exit;
        return $this->createCrudDataTable($cms, 'admin.cms.destroy', 'admin.cms.edit')->make(true);
    }

    /**
     * Show the form for creating a new news.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.cms.create');
    }

    /**
     * Store a newly created news in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateCmsRequest $request)
    {
    	$cms = new Cms;
    	$cms->fill($request->except(['image', 'company']));
        $cms->save();
        return $this->redirectSuccess('admin.cms.index', 'Successfully created cms!');
    }

    /**
     * Show the form for editing the specified news.
     *
     * @param News $news
     * @return Response
     */
    public function edit(Cms $cms)
    {      
    	//echo "<pre>";print_r($cms);exit;
        return view('admin.cms.edit', [
            'news' => $cms
        ]);
    }

    /**
     * Update the specified news in storage.
     *
     * @param News $news
     * @param Request $request
     * @return Response
     */
    public function update(Cms $cms, UpdateCmsRequest $request)
    {
    	//dd($request->except(['image', 'company']));exit;
        $cms->fill($request->except(['image', 'company']));
        $cms->save();
        return $this->redirectSuccess('admin.cms.index', 'Successfully updated cms!');
    }

    /**
     * Remove the specified news from storage.
     *
     * @param News $news
     * @return Response
     */
    public function destroy(Cms $cms)
    {
        $cms->delete();

        return $this->redirectSuccess('admin.cms.index', 'Successfully deleted news!');
    }

}
