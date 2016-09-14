<?php 
namespace Villato\Http\Controllers;

use Villato\Company;
use Villato\Region;

class CompanyController extends Controller
{
    /**
     * Returns Company profile
     *
     * @return \Illuminate\View\View
     */

    public function getCompanyDetail(Region $region, Company $company)
    {   
        return view('company.detail', [
            'title' => $company->name,
            'region' => $region,
            'company' => $company,
            'categories' => $company->categories()           
        ]);
    }
   
}
