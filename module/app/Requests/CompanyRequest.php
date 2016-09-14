<?php

namespace Villato\Http\Requests;

use Villato\Http\Requests;

class CompanyRequest extends Request
{
    protected $rules = [
        'name' => 'required|max:64',
        'region' => '',
        'email' => 'required|email|max:255|unique:company,email',
        'password' => 'required|min:8|confirmed',
        'info' => 'required|max:150',
        'extra_info' => '',
        'phone' => 'required_without:mobile|string',
        'mobile' => 'required_without:phone|string',
        'street' => 'required|string',
        'category' => '',
        'product' => '',
        'postal_code' => 'required|string',
        'website' => 'url|max:128',
        'facebook' => 'url|max:128',
        'newsletter' => 'boolean',
    ];

    protected function rules()
    {
        if ($this->has('image')) {
            foreach ($this->file('image') as $key => $val) {
                if ($this->hasFile('image.' . $key)) {
                    $this->rules['image.' . $key] = 'image|between:1,2000';
                }
            }
        }

        $this->merge(['newsletter' => $this->input('newsletter', 0)]);
    }
}
