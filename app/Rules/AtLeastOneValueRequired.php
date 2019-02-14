<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AtLeastOneValueRequired implements Rule
{
    /**
     * The working days.
     *
     * @var array
     */
    public $days;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($days)
    {
        $this->days = $days;
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
        $null = [];

        foreach ($this->days as $day) {
            if ($day['day_id'] == null) {
                array_push($null, $day['day_id']);
            }
        }

        return sizeof($null) !== sizeof($this->days);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'At least one working day is required.';
    }
}
