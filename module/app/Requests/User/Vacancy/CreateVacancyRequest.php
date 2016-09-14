<?php

namespace Villato\Http\Requests\User\Vacancy;

use Villato\Http\Requests\VacancyRequest;

class CreateVacancyRequest extends VacancyRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        parent::rules();

        return array_merge($this->rules, [
            'company' => ''
        ]);
    }

}
