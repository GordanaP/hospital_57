<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsDoctorWorkHour implements Rule
{
    /**
     * The doctor.
     *
     * @var \App\Doctor
     */
    public $doctor;

    /**
     * The appointment date.
     *
     * @var string
     */
    public $app_date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($doctor, $app_date)
    {
        $this->doctor = $doctor;
        $this->app_date = $app_date;
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
        return $this->doctor->isWorkingOnDateHour($this->app_date, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value is outside the doctor\'s working hours.';
    }
}
