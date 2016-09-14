<?php

namespace Villato\Http\Requests;

class AdvertisementRequest extends Request
{

    protected $rules = [
        'name' => 'required|max:64',
        'category' => 'required|integer|exists:categoryadvt,id',
        'image' => 'sometimes|image',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //
    }
}
