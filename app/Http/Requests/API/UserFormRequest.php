<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        if(request()->user) {
            $rules =  [
                'name' => 'required|string',
                'role' => 'required|string',
                'email' => 'required|email|unique:users,id,'.request()->user,
                'password' => 'required_with:confirm_password|string|min:8|nullable',
                'confirm_password' => 'required_with:password|string|same:password|nullable',
            ];
        }else {
            $rules =  [
                'name' => 'required|string',
                'role' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password',
            ]; 
        }
        return $rules;
    }
}
