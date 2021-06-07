<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PortfolioDateOverlapping;
use Illuminate\Validation\Rule;


class StoreTradeRequest extends FormRequest
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
            'type_side' => ['required', Rule::in(['buy', 'sell'])],
            'quantity' => ['required', 'numeric','min:0','max:99999999999'],
            'symbol' => ['required'],
            'entry_price' => ['required', 'numeric','min:0','max:99999999999'],
            'exit_price' => ['required', 'numeric','min:0','max:99999999999'],
            'stop_loss_price' => ['required', 'numeric','min:0','max:99999999999'],
            'time_frame' => Rule::in(['1 min', '5 min', '15 min', '30 min', '1 hour', '2 hours', '4 hours', '1 day', '1 week', '1 month']),
            'exit_reason_id' => 'exists:App\Models\ExitReason,id',
            'strategy_id' => 'exists:App\Models\Strategy,id',
            'trade_notes' => ['nullable','max:10000'],
        ];

        if($this->create){
            $rules += [
                'entry_date' => ['required', 'date',  new PortfolioDateOverlapping, 'before_or_equal: '.date("Y/m/d h:i:sa").''],
                'exit_date' => ['required', 'date', 'after_or_equal: entry_date'],
                'pl_currency' => ['required', 'numeric','min:-99999999999','max:99999999999'],
                'pl_pips' => ['required', 'numeric','min:-99999999','max:99999999'],
                'fees' => ['nullable', 'numeric','min:-99999999','max:99999999'],
                'trade_img' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'before_or_equal' => 'Entry date cannot be in the future',
        ];
    }
}
