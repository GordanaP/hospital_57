<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsNotAwayFromWork implements Rule
{
    /**
     * The doctor.
     *
     * @var \App\Doctor
     */
    public $doctor;

    /**
     * The end date.
     *
     * @var string
     */
    public $endDate;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($doctor, $endDate)
    {
        $this->doctor = $doctor;
        $this->endDate = $endDate;
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
        if(request()->method() == 'PUT') {

            $absenceId = request()->route('absence')->id;

            return $this->doctor
                ->ignoreEditableAbsence($value, $this->endDate, $absenceId);
        }
        else {
            return $this->doctor->isNotAwayFromWork($value, $this->endDate);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Duplicate absences are not allowed.';
    }
}
