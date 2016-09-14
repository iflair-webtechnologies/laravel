<?php

namespace Villato\Http\Controllers;

use Villato\Category;
use Villato\Company;
use Villato\News;
use Villato\Offer;
use Villato\Region;
use Villato\Vacancy;
use Villato\Advertisement;
use Villato\Categoryadvt;
use Illuminate\Support\Facades\Auth;


class RegionController extends Controller
{

    /**
     * Returns Region index for a given Region
     *
     * @param Region $region
     * @return \Illuminate\View\View
     */
    public function getRegionDetail(Region $region)
    {
        
        if (!empty(Auth::user()->email) && Auth::user()->type == 'admin') {
            return redirect('/admin');
        }else{
          //  return redirect('/mijn-villato');
        }
        //dd($region);
        $companies = Company::recentlyCreated($region)->take(7)->get();
       
        $categories = Category::all();
        $Categoryadvt = Categoryadvt::with('advertisement')->get();
       // dd($Categoryadvt[0]->advertisement->first());
        $vacancies = Vacancy::recentlyCreated($region)->with('company')->get();
        $offers = Offer::recentlyCreated($region)->with('company', 'images')->get();
        $news = News::recentlyCreated($region)->with('company', 'images')->get();
        $regions = Region::nearbyRegions($region)->get()->take(6);
        //echo "<pre>";print_r($categories);exit;
        return view('region.detail', [
            'region' => $region,
            'companies' => $companies->take(7),
            'categories' => $categories,
            'vacancies' => $vacancies->take(3),
            'totalVacancyCount' => $vacancies->count(),
            'offers' => $offers->take(5),
            'totalOfferCount' => $offers->count(),
            'news' => $news->take(5),
            'totalNewsCount' => $news->count(),
            'regions' => $regions,
            'categoryadvt' => $Categoryadvt
        ]);
    }

    /**
     * Returns all Regions paginated
     *
     * @return \Illuminate\View\View
     */
    public function getRegionIndex()
    {
        $regions = Region::all()->paginate(8);

        return view('region.index', [
            'regions' => $regions,
        ]);
    }

}
