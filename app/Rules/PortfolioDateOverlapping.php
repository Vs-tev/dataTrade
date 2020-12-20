<?php

namespace App\Rules;
use App\Models\Portfolio;
use Illuminate\Contracts\Validation\Rule;

class PortfolioDateOverlapping implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {  
      
        return Portfolio::where('id', request('portfolio_id'))->where('action_date', '>', $value)->count() == 0;
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Date must be grater than portfolio start date ('.Portfolio::portfolioDate(request('portfolio_id')).') ';
    }
}
