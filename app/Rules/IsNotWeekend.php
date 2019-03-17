<?php

namespace App\Rules;

use App\Services\CustomClasses\AppCarbon;
use Illuminate\Contracts\Validation\Rule;

class IsNotWeekend implements Rule
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
        return AppCarbon::isNotWeekend($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The absence can not start or end on weekend.';
    }
}
