<?php

namespace Villato\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Villato\Category;
use Villato\Company;
use Villato\News;
use Villato\Categoryadvt;
use Villato\Offer;
use Villato\Product;
use Villato\Region;
use Villato\Vacancy;
use Villato\Cms;
use Villato\Advertisement;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Villato\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->bind('region', function ($value, $route) {
            //@TODO Optional further optimization of Region binding. Warning: Core Logic!

            if ($route->getPrefix() == '/admin' && $region = Region::where('id', '=',
                    $value)->withInactive()->first()
            ) {
                return $region;
            }

            //Find Region by slug
            if ($region = Region::findBySlugOrId($value)) {
                return $region;
            }

            //Region is Global return empty Region
            if ($value == 'www') {
                $globalRegion = new Region();
                $globalRegion->slug = 'www';

                return $globalRegion;
            }

            //If region is invalid return 404
            abort(404);
        });

        $router->bind('category', function ($value) {
            //@TODO Optional further optimization of Category binding. Warning: Core Logic!

            if ($category = Category::findBySlugOrId($value)) {
                return $category;
            }

            abort(404);
        });

        $router->bind('product', function ($value) {
            //@TODO Optional further optimization of Category binding. Warning: Core Logic!

            if ($product = Product::findBySlugOrId($value)) {
                return $product;
            }

            abort(404);
        });

        $router->bind('company', function ($value, $route) {
            //@TODO Optional further optimization of Company binding. Warning: Core Logic!
            //$region = $route->getParameter('region');
            // dd($value);
            // echo "hi";exit;
            $company = Company::where(function ($query) use ($value) {
                if (is_numeric($value)) {
                    $query->where('id', '=', $value);
                } else {
                    $query->where('slug', '=', $value);
                }
            });

            //dd($company->first());

            // if ($region instanceof Region) {
            //     $company->inPrimaryOrSecondaryRegion($region);
            // }
            if ($company = $company->first()) {
                return $company;
            }
            

            // $company = Company::where('id', '=', $value);
            // //dd($company);
            // if ($company = $company->first()) {
            //     return $company;
            // }

            abort(404);
        });

        $router->bind('vacancy', function ($value, $route) {
            $company = $route->getParameter('company');
            $vacancy = Vacancy::where('id', '=', $value);

            if ($company instanceof Company) {
                $vacancy->inCompany($company);
            }

            if ($vacancy = $vacancy->first()) {
                return $vacancy;
            }

            abort(404);
        });

        $router->bind('offer', function ($value, $route) {
            $company = $route->getParameter('company');
            $offer = Offer::where('id', '=', $value);

            if ($company instanceof Company) {
                $offer->inCompany($company);
            }

            if ($offer = $offer->first()) {
                return $offer;
            }

            abort(404);
        });

        $router->bind('news', function ($value, $route) {
            
            $company = $route->getParameter('company');
            $news = News::where('id', '=', $value);

            if ($company instanceof Company) {
                $news->inCompany($company);
            }

            if ($news = $news->first()) {
                return $news;
            }

            abort(404);
        });

        $router->bind('cms', function ($value, $route) {
           
            $news = Cms::where('id', '=', $value);
            if ($news = $news->first()) {
                return $news;
            }
            abort(404);
        });
        $router->bind('categoryadvt', function ($value, $route) {
           
            $news = Categoryadvt::where('id', '=', $value);
            if ($news = $news->first()) {
                return $news;
            }
            abort(404);
        });
          $router->bind('advertisement', function ($value, $route) {
           
            $advertisement = Advertisement::where('id', '=', $value);
            if ($advertisement = $advertisement->first()) {
                return $advertisement;
            }
            abort(404);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }

}
