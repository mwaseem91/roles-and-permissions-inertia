<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id|integer',
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
