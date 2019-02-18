<?php

namespace App\Rules;

use App\Appointment;
use App\Services\CustomClasses\AppCarbon;
use Illuminate\Contracts\Validation\Rule;

class IsNotBooked implements Rule
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
     * The appointment id.
     *
     * @var string
     */
    public $start_at;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($doctor, $app_date, $start_at)
    {
        $this->doctor = $doctor;
        $this->app_date = $app_date;
        $this->start_at = $start_at;
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
        $date = $this->app_date . ' ' . $value;

        $start_at = AppCarbon::createDate($date);

        return $this->doctor->hasNoAppointmentOnDateTime($this->app_date, $value)
            || ( ! $this->doctor->hasNoAppointmentOnDateTime($this->app_date, $value)
                && $this->start_at == $start_at );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Duplicate appointment.';
    }
}
