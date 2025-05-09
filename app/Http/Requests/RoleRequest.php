<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $roleId = $this->route('role'); 

        return [
            'name' => [
                'required',
                'unique:roles,name,' . $roleId, 
            ],
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id', 
        ];
    }

   
    public function messages()
    {
        return [
            'permissions.required' => 'At least one permission must be selected.',
            'permissions.array' => 'Permissions should be an array of permission IDs.',
            'permissions.*.exists' => 'permissions do not exist.',
        ];
    }
}
