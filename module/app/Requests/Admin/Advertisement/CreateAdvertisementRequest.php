<?php

namespace Villato\Http\Requests\Admin\Advertisement;

use Villato\Http\Requests\AdvertisementRequest;

class CreateAdvertisementRequest extends AdvertisementRequest
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
