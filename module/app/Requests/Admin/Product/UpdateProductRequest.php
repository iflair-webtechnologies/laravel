<?php

namespace Villato\Http\Requests\Admin\Product;

use Villato\Http\Requests\ProductRequest;

class UpdateProductRequest extends ProductRequest
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
