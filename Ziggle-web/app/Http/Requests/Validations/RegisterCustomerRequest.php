<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;


class RegisterCustomerRequest extends Request
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
            'first_name' => 'required|min:3|max:255',
            'last_name'=> 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'mobile'=>  'required|max:255|unique:customers',
            'agree' => 'required',
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
            'email.unique' => trans('validation.register_email_unique'),
        ];
    }
}