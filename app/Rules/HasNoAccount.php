<?php

namespace App\Rules;

use App\Doctor;
use Illuminate\Contracts\Validation\Rule;

class HasNoAccount implements Rule
{
    public $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $doctor = Doctor::find($value);

        $doctorsWithoutAccount = Doctor::hasNoAccountCollection($this->user);

        return optional($doctorsWithoutAccount)->contains($doctor);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value is invalid.';
    }
}
