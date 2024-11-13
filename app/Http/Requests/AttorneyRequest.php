<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttorneyRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string',
            'firm_name' => 'required|string',
            'type' => 'required|string', 
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'required|string',
            'zip_code' => 'required', 
            'phone_number' => 'required', 
            'fax_number' => 'required', 
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
            'name.required' => 'The name field is required.',
            'firm_name.required' => 'The firm name field is required.',
            'type.required' => 'The type field is required.',
            'address1.required' => 'The first address is required.',
            'city.required' => 'The city field is required.',
            'zip_code.required' => 'The zip code field is required.',
            'phone_number.required' => 'The phone number field is required.',
            'fax_number.required' => 'The fax number field is required.',
        ];
    }
}
