<?php

namespace App\Http\Requests;

use App\Doctor;
use App\Rules\AfterNow;
use App\Rules\AlphaNumSpace;
use App\Rules\IsDoctorAppSlot;
use App\Rules\IsDoctorWorkDay;
use App\Rules\IsDoctorWorkHour;
use App\Rules\IsNotBooked;
use App\Rules\IsNotHoliday;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $doctor = Doctor::find($this->doctor_id);

        $rules = [
            'doctor_id' => [
                'required','exists:doctors,id'
            ],
            'app_date' => [
                'required', 'date_format:Y-m-d', 'after_or_equal:today',
                new IsNotHoliday,
                new IsDoctorWorkDay($doctor),
            ],
            'app_start' => [
                'required', 'date_format:H:i',
            ],
            'first_name' => [
                'sometimes','required', new AlphaNumSpace,'max:100'
            ],
            'last_name' => [
                'sometimes','required', new AlphaNumSpace,'max:100'
            ],
            'birthday' => [
                'sometimes','required', 'date:Y-m-d', 'before:yesterday',
            ],
            'phone' => [
                'nullable', 'phone:RS'
            ],
        ];

        if($doctor->isWorkingOnDate($this->app_date))
        {
            $rules['app_start'] = [
                new IsDoctorWorkHour($doctor, $this->app_date),
                new AfterNow($this->app_date),
                new IsDoctorAppSlot($doctor, $this->app_date),
                new IsNotBooked($doctor, $this->app_date, optional($this->appointment)->start_at),
            ];
        }

        return $rules;
    }
}
