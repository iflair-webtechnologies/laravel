<?php

namespace Villato\Http\Requests;


class RegionRequest extends Request
{

    protected $rules = [
        'name' => 'required|max:64',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'population' => 'required|numeric',
        'active' => 'boolean'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->merge(['active' => $this->input('active', 0)]);

    }

}
