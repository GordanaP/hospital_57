<?php

namespace App\Rules;

use App\Services\CustomClasses\AppCarbon;
use App\Services\CustomClasses\Holiday;
use Illuminate\Contracts\Validation\Rule;

class IsNotHoliday implements Rule
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
        return AppCarbon::isNotHoliday($value);
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
