<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsNotDoctorAbsence implements Rule
{
    /**
     * The doctor.
     *
     * @var \App\Doctor
     */
    public $doctor;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($doctor)
    {
        $this->doctor = $doctor;
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
        return ! $this->doctor->isAbsentFromWorkOnDate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The doctor is absent from work this day.';
    }
}
