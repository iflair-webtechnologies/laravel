<?php

namespace Villato\Http\Controllers;

use Villato\Category;
use Villato\Company;
use Villato\News;
use Villato\Offer;
use Villato\Region;
use Villato\Vacancy;

class CategoryController extends Controller
{

    /**
     * Returns Category in with Company list
     *
     * @return \Illuminate\View\View
     */
    public function getCategoryDetail(Region $region, Category $category)
    {
        // @todo Optimization of queries and checks getRegionCategoryDetail()
        $companies = Company::with([
            'region',
            'images',
        ])->inCategory($category, $region)->paginate(9);

        $vacancies = Vacancy::inCategory($category, $region)->RecentlyCreated($region)->get();
        $offers = Offer::inCategory($category, $region)->RecentlyCreated($region)->get();
        $news = News::inCategory($category, $region)->RecentlyCreated($region)->get();

        $otherCategories = Category::where('slug', '!=', $category->slug);

        return view('category.detail', [
            'title' => $category->name,
            'region' => $region,
            'category' => $category,
            'companies' => $companies,
            'vacancies' => $vacancies->take(3),
            'totalVacancyCount' => $vacancies->count(),
            'offers' => $offers->take(5),
            'totalOfferCount' => $offers->count(),
            'news' => $news->take(5),
            'totalNewsCount' => $news->count(),
            'otherCategories' => $otherCategories,
        ]);
    }

}
