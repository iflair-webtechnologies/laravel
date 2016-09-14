<?php

namespace Villato\Http\Requests;

class OfferRequest extends Request
{

    protected $rules = [
        'title' => 'required|max:64',
        'company' => 'required|integer|exists:company,id',
        'image' => 'sometimes|image',
        'description' => 'required',
        'content' => 'required'
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
