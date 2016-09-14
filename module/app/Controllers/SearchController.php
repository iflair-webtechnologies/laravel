<?php

namespace Villato\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Villato\Company;
use Villato\Http\Requests\SearchRequest;
use Villato\Region;

class SearchController extends Controller
{

    /**
     * Get basic search results for query
     *
     * @param Region $region
     * @param SearchRequest $request
     * @return \Illuminate\View\View
     */
    public function getBasicSearch(Region $region, SearchRequest $request)
    {
       // dd($region);
        $companies = Company::search($request->input('q'), [
            'name' => 30,
            'products.name' => 10,
            'products.category.name' => 5,
        ])->get();

        // $companies = Company::search($request->input('q'), [
        //     'name' => 30,
        //     'products.name' => 10,
        //     'products.category.name' => 5,
        // ])->inPrimaryOrSecondaryRegion($region)->with(['region', 'images'])->get();
        /*print_r($companies);
        exit;*/
        $results = new LengthAwarePaginator($companies->forPage(Paginator::resolveCurrentPage(), 10),
            $companies->count(), 10, Paginator::resolveCurrentPage(), [
                'path' => Paginator::resolveCurrentPath(''),
                'query' => $request->query(),
            ]);

        return view('search.basic', [
            'title' => $request->input('q'),
            'region' => $region,
            'results' => $results,
            'query' => $request->input('q')
        ]);
    }

    /**
     * Process realtime search results
     *
     * @param Region $region
     * @param SearchRequest $request
     * @return mixed
     */
    public function postAjaxSearch(Region $region, SearchRequest $request)
    {
        $companies = Company::search($request->input('q'), [
            'name' => 30,
            'products.name' => 10,
            'products.category.name' => 5,
        ])->inPrimaryOrSecondaryRegion($region)->with(['region'])->get()->each(function ($row) {
            $row->setAppends(['url']);
            $row->setVisible(['name', 'id', 'url']);
        });

        return response()->ajax($companies);
    }

}