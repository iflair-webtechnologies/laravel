<?php

namespace Villato\Http\Requests;

class CmsRequest extends Request
{

    protected $rules = [
        'title' => 'required|max:64',
        'content' => 'required',
        
        
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //
    }

}
