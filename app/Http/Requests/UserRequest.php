<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumSpace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'max:30', new AlphaNumSpace
            ],
            'email' => [
                'required', 'email', 'max:100',
                Rule::unique('users')->ignore(optional($this->user)->id)
            ],
            'password'=>[
                'required_if:handle-password,manual'
            ]
        ];
    }
}
