<?php

namespace Villato\Http\Controllers;

use Villato\Company;
use Villato\Region;
use Villato\Vacancy;

class VacancyController extends Controller
{

    /**
     * Returns detail for a specific vacancy
     *
     * @param Region $region
     * @param Company $company
     * @param Vacancy $vacancy
     * @return \Illuminate\View\View
     */
    public function getVacancyDetail(Region $region, Company $company, Vacancy $vacancy)
    {
        $moreVacancies = Vacancy::inCompany($company)->where('id', '!=', $vacancy->id)->get();

        return view('vacancy.detail', [
            'title' => $vacancy->title,
            'region' => $region,
            'company' => $company,
            'vacancy' => $vacancy,
            'moreVacancies' => $moreVacancies->take(4),
            'totalVacancyCount' => $moreVacancies->count(),
        ]);
    }

    /**
     * Returns all vacancies for a specific company
     *
     * @param Region $region
     * @param Company $company
     * @return \Illuminate\View\View
     */
    public function getCompanyVacancyIndex(Region $region, Company $company)
    {
        $vacancies = Vacancy::inCompany($company)->paginate(8);

        return view('vacancy.index')->with([
            'title' => 'Vacatures',
            'pageTitle' => $company->name,
            'region' => $region,
            'vacancies' => $vacancies,
        ]);
    }

    /**
     * Returns all vacancies for a specific region
     *
     * @param Region $region
     * @return \Illuminate\View\View
     */
    public function getRegionVacancyIndex(Region $region) {
        $vacancies = Vacancy::with('company.region')->inPrimaryOrSecondaryRegion($region)->paginate(8);

        return view('vacancy.index')->with([
            'title' => 'Vacatures',
            'pageTitle' => ($region->name ? $region->name : 'Globaal'),
            'region' => $region,
            'vacancies' => $vacancies,
        ]);
    }

}
