<?php

namespace App\Rules;

use App\Models\Portfolio;
use Illuminate\Contracts\Validation\Rule;

class PortfolioDateOverlapping implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (in_array($attribute, array('entry_date', 'action_date'))) {
            $date = $value;
        } else {
            $value = (array) \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
            $date = $value['date'];
        }

        if (request('portfolio_id')) {
            return Portfolio::where('id', request('portfolio_id'))->where('started_at', '>', $date)->count() == 0;
        } else {
            return Portfolio::where('id', Portfolio::isactive()->first())->where('started_at', '>', $date)->count() == 0;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return 'The date must be grater than portfolio start date (' . Portfolio::portfolioDate(request('portfolio_id') ?? Portfolio::isactive()->first()) . ') ';
    }
}
