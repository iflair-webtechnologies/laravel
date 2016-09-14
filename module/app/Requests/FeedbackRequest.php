<?php

namespace Villato\Http\Requests;


class FeedbackRequest extends Request
{
    protected $rules = [
        'comment' => 'required',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!$this->user()) {
            return array_merge($this->rules, [
                'name' => 'required',
                'email' => 'required|email',
                'g-recaptcha-response' => 'required|recaptcha',
            ]);
        }

        return $this->rules;
    }
}