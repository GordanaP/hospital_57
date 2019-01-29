<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumSpace;
use App\Rules\MustNotBePresentWithAnotherField;
use App\Services\Utilities\AppSlot;
use App\Services\Utilities\Color;
use App\Services\Utilities\Specialty;
use App\Services\Utilities\Title;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
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
            'image' => [
                'nullable', 'image'
            ],
            'deleteImage' => [
                'sometimes', 'nullable', new MustNotBePresentWithAnotherField('image'),
            ],
            'title' => [
                'required','in:'.Title::namesArray()
            ],
            'first_name' => [
                'required','string', new AlphaNumSpace,'max:100'
            ],
            'last_name' => [
                'required','string', new AlphaNumSpace,'max:100'
            ],
            'specialty' => [
                'required','in:'.Specialty::namesArray()
            ],
            'license' => [
                'nullable', 'integer', 'min:1',
                Rule::unique('doctors')->ignore(optional($this->doctor)->id)
            ],
            'biography' => [
                'nullable'
            ],
            'color' => [
                'nullable','in:'.Color::namesArray()
            ],
            'app_slot' => [
                'nullable','in:'.AppSlot::namesArray()
            ],
        ];
    }
}
