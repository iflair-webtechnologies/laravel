<?php

namespace Villato\Http\Requests\User\Advertisement;

use Villato\Http\Requests\AdvertisementRequest;

class UpdateAdvertisementRequest extends AdvertisementRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        parent::rules();
        return $this->rules;
    }
    
}
