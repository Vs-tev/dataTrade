<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StorePortfolioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => [Rule::unique('portfolios')->where('user_id', auth()->id())->ignore($this->id),
            'required', 'min:2', 'max:80'],
            'currency' => Rule::in(["EUR", "USD", "AUD", "CAD", "CHF"]),
        ];

         if ($this->getMethod() == 'POST') {
             $rules += [
                'start_equity' => ['required','numeric','max:99999999999'],
                'started_at' => ['required','date', 'before_or_equal: '.date("Y/m/d h:i:sa").''],
             ];
         }

         return $rules;
    }

    public function messages(){
        return [
            'started_at.before_or_equal' => 'The start date cannot be in the future',
        ];
    }
}
