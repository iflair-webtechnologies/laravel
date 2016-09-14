<?php

namespace Villato\Http\Requests;

class VacancyRequest extends Request
{
    protected $rules = [
        'title' => 'required|max:64',
        'company' => 'required|integer|exists:company,id',
        'description' => 'required',
        'function_description' => 'required',
        'email' => 'required|email',
        'education' => 'required',
        'duration' => 'required',
        'hours' => 'required',
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
