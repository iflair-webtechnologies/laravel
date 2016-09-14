<?php

namespace Villato\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Villato\Company;
use Villato\Offer;
use Villato\Region;


class OfferController extends Controller
{

    /**
     * Returns detail for a specific offer
     *
     * @param Region $region
     * @param Company $company
     * @param Offer $offer
     * @return \Illuminate\View\View
     */
    public function getOfferDetail(Region $region, Company $company, Offer $offer)
    {
        $moreOffers = Offer::inCompany($company)->where('id', '!=', $offer->id)->get();

        return view('offer.detail', [
            'title' => $offer->title,
            'region' => $region,
            'company' => $company,
            'offer' => $offer,
            'moreOffers' => $moreOffers->take(4),
            'totalOfferCount' => $moreOffers->count(),
        ]);
    }

    /**
     * Returns all offers for a specific company
     *
     * @param Region $region
     * @param Company $company
     * @return \Illuminate\View\View
     */
    public function getCompanyOfferIndex(Region $region, Company $company)
    {
        $offers = Offer::inCompany($company)->paginate(8);

        return view('offer.index')->with([
            'title' => 'Aanbiedingen',
            'pageTitle' => $company->name,
            'region' => $region,
            'offers' => $offers,
        ]);
    }

    /**
     * Returns all offers for a specific region
     *
     * @param Region $region
     * @return \Illuminate\View\View
     */
    public function getRegionOfferIndex(Region $region)
    {
        $offers = Offer::with('company')->inPrimaryOrSecondaryRegion($region)->paginate(8);

        return view('offer.index')->with([
            'title' => 'Aanbiedingen',
            'pageTitle' => ($region->name ? $region->name : 'Globaal'),
            'region' => $region,
            'offers' => $offers,
        ]);
    }

}
