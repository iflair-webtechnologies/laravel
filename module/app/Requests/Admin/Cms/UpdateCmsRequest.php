<?php

namespace Villato\Http\Requests\Admin\Cms;

use Villato\Http\Requests\CmsRequest;

class UpdateCmsRequest extends CmsRequest
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
