<?php

namespace Villato\Http\Requests\Admin\Categoryadvt;

use Villato\Http\Requests\CategoryadvtRequest;

class CreateCategoryadvtRequest extends CategoryadvtRequest
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
