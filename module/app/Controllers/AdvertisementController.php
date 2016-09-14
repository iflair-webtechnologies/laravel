<?php

namespace Villato\Http\Controllers;

use Villato\Company;
use Villato\News;
use Villato\Region;
use Villato\General;
use Villato\Advertisement;
use Request;
class AdvertisementController extends Controller
{

    /**
     * Returns detail for a specific newsitem
     *
     * @param Region $region
     * @param Company $company
     * @param News $news
     * @return \Illuminate\View\View
     */
    public function getAdvtDetail(Region $region,Company $company)
    {
        $segment =  Request::segment(3); 
        $advt = Advertisement::where('id', '=', $segment)->get();

        $moreadvt = Advertisement::where('company_id', '=', $company->id)
                    ->where('id', '!=', $segment)->where('deleted_at', '=', null)->get();
        
        return view('advt.detail', [
            'title' => $advt[0]->name,
            'region' => $region,
            'company' => $company,
            'news' => $advt[0],
            'moreNews' => $moreadvt->take(4),
            'totalNewsCount' => $moreadvt->count(),
        ]);
    }

    /**
     * Returns all news for a specific company
     *
     * @param Region $region
     * @param Company $company
     * @return \Illuminate\View\View
     */
    public function getCompanyAdvtIndex(Region $region,Company $company)
    {
        //echo $company->id;exit;

        $news = Advertisement::where('company_id', '=', $company->id)
                  ->where('deleted_at', '=', null)->paginate(4);

        return view('advt.index')->with([
            'title' => 'Advertisement',
            'pageTitle' => $company,
            'region' => $region,
            'news' => $news,
        ]);
    }

    /**
     * Returns all news for a specific region
     *
     * @param Region $region
     * @return \Illuminate\View\View
     */
    public function getRegionNewsIndex(Region $region) {
        $news = News::with('company')->InPrimaryOrSecondaryRegion($region)->paginate(8);

        return view('news.index')->with([
            'title' => 'Nieuws',
            'pageTitle' => ($region->name ? $region->name : 'Globaal'),
            'region' => $region,
            'news' => $news,
        ]);
    }

}
