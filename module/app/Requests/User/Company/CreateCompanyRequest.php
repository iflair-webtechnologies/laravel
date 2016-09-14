<?php

namespace Villato\Http\Requests\User\Company;

use Villato\Http\Requests\CompanyRequest;

class CreateCompanyRequest extends CompanyRequest
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
