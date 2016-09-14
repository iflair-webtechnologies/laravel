<?php

namespace Villato\Http\Requests\Admin\Category;

use Villato\Http\Requests\CategoryRequest;

class CreateCategoryRequest extends CategoryRequest
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
