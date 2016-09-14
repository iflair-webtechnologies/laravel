<?php

namespace Villato\Http\Requests;

class CategoryadvtRequest extends Request
{

    protected $rules = [
        'name' => 'required|max:64',
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
