<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class AdminFormRequest extends FormRequest
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
        if(request()->admin) {
            $rules =  [
                'name' => 'required|string',
                'email' => 'required|email|unique:admins,id,'.request()->admin->id,
                'password' => 'required_with:confirm_password|string|min:8|nullable',
                'confirm_password' => 'required_with:password|string|same:password|nullable',
            ];
        }else {
            $rules =  [
                'name' => 'required|string',
                'email' => 'required|email|unique:admins',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password',
            ]; 
        }
        return $rules;
    }
}
