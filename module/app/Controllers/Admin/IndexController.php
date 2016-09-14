<?php

namespace Villato\Http\Controllers\Admin;

use Villato\Category;
use Villato\Company;
use Villato\Product;
use Villato\Region;

class IndexController extends CrudController
{

    /**
     * Returns the dashboard view with acording data
     *
     * @return Response
     */
    public function getIndex()
    {
        $companyCount = Company::count();
        $regionCount = Region::withInactive()->count();
        $categoryCount = Category::count();
        $productCount = Product::count();

        return view('admin.index', [
            'companyCount' => $companyCount,
            'regionCount' => $regionCount,
            'categoryCount' => $categoryCount,
            'productCount' => $productCount
        ]);
    }
    public function resetPassword()
    {
        return view('admin.auth.reset');
    }   
    public function paymentTransactions()
    {
        return view('admin.payment.transaction');
    }   


}
