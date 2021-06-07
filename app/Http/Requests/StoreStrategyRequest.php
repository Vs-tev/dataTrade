<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStrategyRequest extends FormRequest
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
            'name' => [Rule::unique('strategies')->where('user_id', auth()->id())->ignore($this->id),
            'required', 'string', 'min:2', 'max:40'],
            'description' => 'required',
        ];

        if($this->create){
            $rules += [
                'img_strategy' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'img_strategy.image' => 'Allowed file types: peg, png, jpg, gif',
        ];
    }
}
