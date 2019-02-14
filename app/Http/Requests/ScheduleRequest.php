<?php

namespace App\Http\Requests;

use App\Rules\AtLeastOneValueRequired;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
        return [
            'days' => 'array|max:6',
            'days.*.day_id' => [
                'nullable',
                'required_with:days.*.start_at,days.*.end_at',
                'distinct',
                'exists:working_days,index',
            ],
            'days.0.day_id' => [
                new AtLeastOneValueRequired($this->days),
                'required_with:days.*.start_at,days.*.end_at',
                'distinct',
                'exists:working_days,index',
            ],
            'days.*.start_at' => [
                'nullable',
                'date_format:H:i',
                'required_with:days.*.end_at',
            ],
            'days.*.end_at' => [
                'nullable',
                'date_format:H:i',
                'required_with:days.*.start_at',
                'after:days.*.start_at',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'days.*.day_id.required_with' => 'Required when the start and/or end is scheduled',
            'days.*.day_id.distinct' => 'No duplicate days allowed',
            'days.*.day_id.exists' => 'Invalid day',
            'days.0.day_id.required_with' => 'Required when the time is scheduled',
            'days.0.day_id.distinct' => 'No duplicate days allowed',
            'days.0.day_id.exists' => 'Invalid day',
            'days.*.start_at.date_format' => 'Invalid time format',
            'days.*.start_at.required_with' => 'Required when the end is present',
            'days.*.end_at.date_format' => 'Invalid time format',
            'days.*.end_at.required_with' => 'Required when the start is present',
            'days.*.end_at.after' => 'Must be after the start',
        ];
    }
}
