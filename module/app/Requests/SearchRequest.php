<?php

namespace Villato\Http\Requests;


class SearchRequest extends Request
{
    protected $rules = [
        'q' => 'string|required',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }
}