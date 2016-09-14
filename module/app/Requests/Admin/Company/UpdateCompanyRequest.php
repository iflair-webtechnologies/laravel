<?php

namespace Villato\Http\Requests\Admin\Company;

use Villato\Http\Requests\CompanyRequest;

class UpdateCompanyRequest extends CompanyRequest
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
