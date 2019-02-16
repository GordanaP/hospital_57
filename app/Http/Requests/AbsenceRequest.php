<?php

namespace App\Http\Requests;

use App\Services\Utilities\Absence;
use Illuminate\Foundation\Http\FormRequest;

class AbsenceRequest extends FormRequest
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
            'doctor_id' => [
                'required', 'exists:doctors,id'
            ],
            'description' => [
                'required', 'in:'.Absence::namesArray()
            ],
            'start_at' => [
                'required', 'date:Y-m-d', 'after_or_equal:today',
            ],
            'end_at' => [
                'nullable', 'date:Y-m-d', 'after_or_equal:start_at',
            ],
        ];
    }
}
