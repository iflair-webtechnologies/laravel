<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Company;
use Villato\Http\Requests\Admin\Vacancy\CreateVacancyRequest;
use Villato\Http\Requests\Admin\Vacancy\UpdateVacancyRequest;
use Villato\Vacancy;
use yajra\Datatables\Datatables;

class VacancyController extends CrudController
{

    /**
     * Display a listing of the vacancies.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.vacancy.index');
    }

    /**
     * Returns the datatables data of vacancies
     *
     * @return Datatables
     */
    public function data()
    {
        $vacancies = Vacancy::leftJoin('company', 'vacancy.company_id', '=', 'company.id')
            ->select([
                'vacancy.id',
                'vacancy.title',
                'vacancy.description',
                'vacancy.education',
                'vacancy.function_description',
                'vacancy.email',
                'vacancy.education',
                'vacancy.duration',
                'vacancy.hours',
                'vacancy.created_at',
                'vacancy.updated_at',
                'company.name as companyname'
            ]);

        return $this->createCrudDataTable($vacancies, 'admin.vacancy.destroy', 'admin.vacancy.edit')->make(true);
    }

    /**
     * Show the form for creating a new vacancy.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('admin.vacancy.create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created vacancy in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateVacancyRequest $request)
    {
        $vacancy = new Vacancy;

        $vacancy->fill($request->except(['company']));
        $company = Company::find($request->input('company'));
        $vacancy->company()->associate($company);

        $vacancy->save();

        return $this->redirectSuccess('admin.vacancy.index', 'Successfully created vacancy!');
    }

    /**
     * Show the form for editing the specified vacancy.
     *
     * @param Vacancy $vacancy
     * @return Response
     */
    public function edit(Vacancy $vacancy)
    {
        $companies = Company::all();

        return view('admin.vacancy.edit', [
            'companies' => $companies,
            'vacancy' => $vacancy
        ]);
    }

    /**
     * Update the specified vacancy in storage.
     *
     * @param Vacancy $vacancy
     * @param Request $request
     * @return Response
     */
    public function update(Vacancy $vacancy, UpdateVacancyRequest $request)
    {
        $vacancy->fill($request->except(['company']));
        $company = Company::find($request->input('company'));
        $vacancy->company()->associate($company);
        $vacancy->save();

        return $this->redirectSuccess('admin.vacancy.index', 'Successfully updated vacancy!');
    }

    /**
     * Remove the specified vacancy from storage.
     *
     * @param Vacancy $vacancy
     * @return Response
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();

        return $this->redirectSuccess('admin.vacancy.index', 'Successfully deleted vacancy!');
    }

}
