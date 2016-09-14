<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Company;
use Villato\Http\Requests\Admin\News\CreateNewsRequest;
use Villato\Http\Requests\Admin\News\UpdateNewsRequest;
use Villato\Image as Image;
use Villato\News;
use Villato\Traits\ImageTrait;
use yajra\Datatables\Datatables;

class NewsController extends CrudController
{

    use ImageTrait;

    /**
     * Display a listing of the newss.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.news.index');
    }

    /**
     * Returns the datatables data of newss
     *
     * @return Datatables
     */
    public function data()
    {
        $news = News::leftJoin('company', 'news.company_id', '=', 'company.id')
            ->select([
                'news.id',
                'news.title',
                'news.description',
                'news.content',
                'news.created_at',
                'news.updated_at',
                'company.name as companyname'
            ]);

        return $this->createCrudDataTable($news, 'admin.news.destroy', 'admin.news.edit')->make(true);
    }

    /**
     * Show the form for creating a new news.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('admin.news.create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created news in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateNewsRequest $request)
    {
        
        $news = new News;
        $news->fill($request->except(['company', 'image']));
        $company = Company::find($request->input('company'));
        $news->company()->associate($company);
        $news->save();

        if($request->hasFile('image')) {
            $image = $this->saveImage(new Image, $request->file('image'));
            $news->images()->save($image);
        }

        return $this->redirectSuccess('admin.news.index', 'Successfully created news!');
    }

    /**
     * Show the form for editing the specified news.
     *
     * @param News $news
     * @return Response
     */
    public function edit(News $news)
    {
        $companies = Company::all();
       // echo "<pre>";print_r($news);exit;
        return view('admin.news.edit', [
            'companies' => $companies,
            'news' => $news
        ]);
    }

    /**
     * Update the specified news in storage.
     *
     * @param News $news
     * @param Request $request
     * @return Response
     */
    public function update(News $news, UpdateNewsRequest $request)
    {
        $news->fill($request->except(['image', 'company']));
        $company = Company::find($request->input('company'));
        $news->company()->associate($company);
        $news->save();

        if($request->hasFile('image')) {
            $image = $image = $this->saveImage($news->images->first(), $request->file('image'));
             dd($image);
            $news->images()->save($image);
        }

        return $this->redirectSuccess('admin.news.index', 'Successfully updated news!');
    }

    /**
     * Remove the specified news from storage.
     *
     * @param News $news
     * @return Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return $this->redirectSuccess('admin.news.index', 'Successfully deleted news!');
    }

}
