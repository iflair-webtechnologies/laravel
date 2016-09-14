<?php

namespace Villato\Http\Requests\Admin\Vacancy;

use Villato\Http\Requests\VacancyRequest;

class UpdateVacancyRequest extends VacancyRequest
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
