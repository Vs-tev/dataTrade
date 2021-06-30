<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckExcelDate implements Rule
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
        try {
            $value = (array) \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
            if (strtotime($value['date'])) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The dates fields must be in a date format.';
    }
}
