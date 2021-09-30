<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class RoleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admins')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->role) {
            return [
                'name' => 'required|string|unique:roles,name,'.request()->role->id,
                'permissions' => 'required|array',            
                'permissions.*' => 'required|string',            
            ];    
        }

        return [
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array',            
            'permissions.*' => 'required|string',            
        ];
    }
}
