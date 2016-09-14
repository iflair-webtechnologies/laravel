<?php

namespace Villato\Http\Requests;

class CategoryRequest extends Request
{

    protected $rules = [
        'name' => 'required|max:64',
        'description' => 'string',        
        
    ];
    


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
    }
}
