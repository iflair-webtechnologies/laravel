<?php

namespace Villato\Http\Controllers;

use Villato\Company;
use Villato\News;
use Villato\Region;

class NewsController extends Controller
{

    /**
     * Returns detail for a specific newsitem
     *
     * @param Region $region
     * @param Company $company
     * @param News $news
     * @return \Illuminate\View\View
     */
     public function testChecking()
    {
        echo "hi";exit;
    }

    public function getNewsDetail(Region $region, Company $company, News $news)
    {

        $moreNews = News::inCompany($company)->where('id', '!=', $news->id)->get();
        return view('news.detail', [
            'title' => $news->title,
            'region' => $region,
            'company' => $company,
            'news' => $news,
            'moreNews' => $moreNews->take(4),
            'totalNewsCount' => $moreNews->count(),
        ]);
    }

    /**
     * Returns all news for a specific company
     *
     * @param Region $region
     * @param Company $company
     * @return \Illuminate\View\View
     */
    public function getCompanyNewsIndex(Region $region, Company $company)
    {

        $news = News::inCompany($company)->paginate(8);

        return view('news.index')->with([
            'title' => 'Nieuws',
            'pageTitle' => $company->name,
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
        //echo "hi";exit;
        $news = News::with('company')->InPrimaryOrSecondaryRegion($region)->paginate(8);

        return view('news.index')->with([
            'title' => 'Nieuws',
            'pageTitle' => ($region->name ? $region->name : 'Globaal'),
            'region' => $region,
            'news' => $news,
        ]);
    }

}
