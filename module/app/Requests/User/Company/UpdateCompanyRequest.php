<?php

namespace Villato\Http\Requests\User\Company;

use Villato\Http\Requests\CompanyNewRequest;

class UpdateCompanyRequest extends CompanyNewRequest
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
            'email' => '',
            'password' => '',
        ]);

    }

}
