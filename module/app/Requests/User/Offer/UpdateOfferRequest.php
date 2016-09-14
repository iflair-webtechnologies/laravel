<?php

namespace Villato\Http\Requests\User\Offer;

use Villato\Http\Requests\OfferRequest;

class UpdateOfferRequest extends OfferRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        parent::rules();

        return array_merge($this->rules, [
            'company' => ''
        ]);
    }

}
