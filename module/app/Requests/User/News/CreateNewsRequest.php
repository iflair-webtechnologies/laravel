<?php

namespace Villato\Http\Requests\User\News;

use Villato\Http\Requests\NewsRequest;

class CreateNewsRequest extends NewsRequest
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
            'company' => ''
        ]);
    }

}
