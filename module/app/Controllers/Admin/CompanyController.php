<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Company;
use Villato\Http\Requests\Admin\Company\CreateCompanyRequest;
use Villato\Http\Requests\Admin\Company\UpdateCompanyRequest;
use Villato\Region;
use Villato\General;
use Villato\Traits\ImageTrait;

class CompanyController extends CrudController
{

    use ImageTrait;

    /**
     * Display a listing of the companies.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.company.index');
    }

    /**
     * Returns the datatables data of companies
     *
     * @return Datatables
     */
    public function data()
    {
        //$companies = Company::leftJoin('region', 'company.region_id', '=', 'region.id')
            $companies = Company::select([
                'company.id',
                'company.name',
                'company.slug',
                'company.email',
                'company.phone',
                'company.mobile',
                'company.street',
                'company.postal_code',
                'company.website',
                'company.facebook',
                'company.newsletter',
                'company.created_at',
                'company.updated_at',                
            ]);

        return $this->createCrudDataTable($companies, 'admin.company.destroy', 'admin.company.edit')
            ->editColumn('newsletter', '
                @if($newsletter)
                    <i class="fa fa-check text-green"></i>
                @else
                    <i class="fa fa-times text-red"></i>
                @endif'
            )->make(true);
    }

    /**
     * Show the form for creating a new company.
     *
     * @return Response
     */
    public function create()
    {
        $regions = Region::all();

        return view('admin.company.create', [
            'regions' => $regions
        ]);
    }

    /**
     * Store a newly created company in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $company = new Company;

        $company->fill($request->except(['region', 'image']));
            // $region = Region::find($request->input('region'));
            // $company->region()->associate($region);
        $company->save();

        foreach ($company->region as $region) {
            $company->region()->detach($region->id);
        }

         foreach ($request->input('region') as $k => $region) {

            if($k >= 1){
                $company->regions()->attach($region, ['region_id' => $region,'serviceflag' => 'paid']);    
            }else
            {
                $company->regions()->attach($region, ['region_id' => $region,'serviceflag' => 'free']);
            }
            
        }
        $company->save();

        if ($request->hasFile('image')) {
            $this->saveMultipleImages($company, $request->file('image'));
        }

        return $this->redirectSuccess('admin.company.index', 'Successfully created company');
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company)
    {
       // $regions = Region::all();
        //echo $company->id;exit;
        $comregions = array();
         $general = new General();
        $con['company_id ='] = $company->id;
        $regions = Region::where('active','1')->get();
        $general->set_table('company_region');
        $result = $general->get('region_id',1,$con);
        foreach ($result as $key => $value) {
            $comregions[] = $value['region_id'];
        }   
          
        return view('admin.company.edit', [
            'regions' => $regions,
            'company' => $company,
            'comregions'=>$comregions
        ]);
    }

    /**
     * Update the specified company in storage.
     *
     * @param Company $company
     * @param Request $request
     * @return Response
     */
    public function update(Company $company, UpdateCompanyRequest $request)
    {
        $company->fill($request->except(['region']));
        // $region = Region::find($request->input('region'));
        // $company->region()->associate($region);
        $company->save();
        //dd($request->input('region'));
         foreach ($company->regions as $region) {
            $company->regions()->detach($region->id);
        }

        foreach ($request->input('region') as $k => $region) {

            if($k >= 1){
                $company->regions()->attach($region, ['region_id' => $region,'serviceflag' => 'paid']);    
            }else
            {
                $company->regions()->attach($region, ['region_id' => $region,'serviceflag' => 'free']);
            }
            
        }
        $company->save();

        if ($request->hasFile('image')) {
            $this->saveMultipleImages($company, $request->file('image'));
        }

        return $this->redirectSuccess('admin.company.index', 'Successfully updated company!');
    }

    /**
     * Remove the specified company from storage.
     *
     * @param Company $company
     * @return Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return $this->redirectSuccess('admin.company.index', 'Successfully removed company!');
    }

}
