<?php

namespace Villato\Http\Requests\Admin\Region;

use Villato\Http\Requests\RegionRequest;

class UpdateRegionRequest extends RegionRequest
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
