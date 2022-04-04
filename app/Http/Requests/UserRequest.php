<?php

namespace App\Http\Requests;

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
        $rule = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => ['required', 'email', Rule::unique('personal_info')->whereNull('deleted_at')],
            'phone_number' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/|size:10|nullable',
            'address' => 'max:255|nullable',
            'department' => 'required',
            'dob' => 'required',
            'user_name' => ['required', Rule::unique('accounts')->whereNull('deleted_at')],
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'password_confirmation' => 'required|same:password',
            'role' => 'required'
        ];
        if ($this->getMethod() === "PUT"){
            unset($rule['password'], $rule['user_name'], $rule['password_confirmation'], $rule['role']);
            $rule['email'] = ['required', 'email', Rule::unique('personal_info')->ignore($this->id)->whereNull('deleted_at')];
        }
        return $rule;
    }
}
