<?php

namespace App\Http\Requests;

use App\Rules\AlphaDashSpace;
use App\Rules\AlphaNumSpace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
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
            'first_name' => [
                'sometimes', 'required', new AlphaNumSpace,'max:100'
            ],
            'last_name' => [
                'sometimes', 'required', new AlphaNumSpace,'max:100'
            ],
            'gender' => [
                'nullable', Rule::in(['M', 'F'])
            ],
            'birthday' => [
                'sometimes', 'required', 'date:Y-m-d', 'before:yesterday',
            ],
            'address' => [
                'nullable', 'max:200'
            ],
            'postal_code' => [
                'nullable', new AlphaDashSpace, 'max:10'
            ],
            'city' => [
                'nullable', 'max:100'
            ],
            'phone' => [
                'nullable', 'phone:RS'
            ],
            'doctor_id' => [
                'nullable','exists:doctors,id'
            ],
        ];
    }
}