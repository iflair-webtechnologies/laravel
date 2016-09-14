<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Villato\Company;
use Villato\Http\Requests\Admin\Offer\CreateOfferRequest;
use Villato\Http\Requests\Admin\Offer\UpdateOfferRequest;
use Villato\Image as Image;
use Villato\Offer;
use Villato\Traits\ImageTrait;
use yajra\Datatables\Datatables;

class OfferController extends CrudController
{

    use ImageTrait;

    /**
     * Display a listing of the offers.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.offer.index');
    }

    /**
     * Returns the datatables data of offers
     *
     * @return Datatables
     */
    public function data()
    {
        $offers = Offer::leftJoin('company', 'offer.company_id', '=', 'company.id')
            ->select([
                'offer.id',
                'offer.title',
                'offer.description',
                'offer.content',
                'offer.created_at',
                'offer.updated_at',
                'company.name as companyname'
            ]);

        return $this->createCrudDataTable($offers, 'admin.offer.destroy', 'admin.offer.edit')->make(true);
    }

    /**
     * Show the form for creating a new offer.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('admin.offer.create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created offer in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateOfferRequest $request)
    {
        $offer = new Offer;

        $offer->fill($request->except(['image', 'company']));
        $company = Company::find($request->input('company'));
        $offer->company()->associate($company);
        $offer->save();

        if($request->hasFile('image')) {
            $image = $this->saveImage(New Image(), $request->file('image'));
            $offer->images()->save($image);
        }

        return $this->redirectSuccess('admin.offer.index', 'Successfully created offer!');
    }

    /**
     * Show the form for editing the specified offer.
     *
     * @param Offer $offer
     * @return Response
     */
    public function edit(Offer $offer)
    {
        $companies = Company::all();

        return view('admin.offer.edit', [
            'companies' => $companies,
            'offer' => $offer
        ]);
    }

    /**
     * Update the specified offer in storage.
     *
     * @param Offer $offer
     * @param Request $request
     * @return Response
     */
    public function update(Offer $offer, UpdateOfferRequest $request)
    {
        $offer->fill($request->except(['company', 'image']));

        if($request->hasFile('image')) {
            $image = $this->saveImage($offer->images->first(), $request->file('image'));
            $offer->images()->save($image);
        }

        $company = Company::find($request->input('company'));
        $offer->company()->associate($company);

        $offer->save();

        return $this->redirectSuccess('admin.offer.index', 'Succesfully updated offer!');
    }

    /**
     * Remove the specified offer from storage.
     *
     * @param Offer $offer
     * @return Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return $this->redirectSuccess('admin.offer.index', 'Sucesfully deleted offer!');
    }

}
