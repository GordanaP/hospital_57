<?php

namespace App\Rules;

use App\Services\CustomClasses\Holiday;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class IsNotHoliday implements Rule
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
        $year = Carbon::parse($value)->format('Y');

        return ! Holiday::getAll($year)->contains($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Holiday is not a business day';
    }
}
