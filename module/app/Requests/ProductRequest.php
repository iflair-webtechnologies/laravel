<?php

namespace Villato\Http\Requests;

class ProductRequest extends Request
{

    protected $rules = [
        'name' => 'required|max:64',
        //'category' => 'required|integer|exists:category,id'
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
