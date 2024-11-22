<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
        $rules = [
            'referralInfo.referring_company' => 'required',
            'referralInfo.referring_source' => 'required',
            'referralInfo.phone' => 'required',
            'referralInfo.email' => 'required|email',

            'claimants.first_name' => 'required',
            'claimants.last_name' => 'required',
            'claimants.dob' => 'required',
            'claimants.language' => 'required',
            'claimants.claim_number' => 'required',
            'claimants.injury_description' => 'required',
            'claimants.jurisdiction' => 'required',
            'claimants.service_type' => 'required',
            'appointments.specialty' => 'required',
            'files' => 'nullable|array|max:10',
        ];

        // Conditional rules
        $conditionalRules = $this->getConditionalRules();
        return array_merge($rules, $conditionalRules);
    }

    /**
     * Define additional conditional validation rules.
     */
    private function getConditionalRules(): array
    {
        $conditionalRules = [];

        if ($this->input('claimants.language') === 'other') {
            $conditionalRules['claimants.other_language'] = 'required|string';
        }

        if ($this->input('claimants.service_type') === 'other') {
            $conditionalRules['claimants.other_claim_type'] = 'required|string';
        }

        if ($this->input('claimants.specialty') === 'other') {
            $conditionalRules['claimants.other_specialty'] = 'required|string';
        }

        if ($this->input('billInfo.same_as_referral') == false) {
            $conditionalRules = array_merge($conditionalRules, [
                'billInfo.referring_company' => 'required|string|max:255',
                'billInfo.referring_source' => 'required|string|max:255',
                'billInfo.phone' => 'required',
                'billInfo.email' => 'required|email',
            ]);
        }

        return $conditionalRules;
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            // Referral Info
            'referralInfo.referring_company.required' => 'Referring Company is required.',
            'referralInfo.referring_source.required' => 'Referring Source is required.',
            'referralInfo.phone.required' => 'Phone number is required.',
            'referralInfo.email.required' => 'Email address is required.',
            
    
            // Billing Info
            'billInfo.referring_company.required' => 'Billing Referring Company is required.',
            'billInfo.referring_source.required' => 'Billing Referring Source is required.',
            'billInfo.phone.required' => 'Billing Phone number is required.',
            'billInfo.email.required' => 'Billing Email address is required.',
    
            // Claimants
            'claimants.first_name.required' => 'Claimant first name is required.',
            'claimants.last_name.required' => 'Claimant last name is required.',
            'claimants.dob.required' => 'Claimant date of birth is required.',
            'claimants.language.required' => 'Claimant language is required.',
            'claimants.claim_number.required' => 'Claimant claim number is required.',
            'claimants.injury_description.required' => 'Claimant injury description is required.',
            'claimants.jurisdiction.required' => 'Claimant jurisdiction is required.',
            'claimants.service_type.required' => 'Claimant service type is required.',
    
            // Appointments
            'appointments.specialty.required' => 'Appointment specialty is required.',
    
            // Conditional Fields
            'claimants.other_language.required' => 'Please specify the other language.',
            'claimants.other_claim_type.required' => 'Please specify the other claim type.',
            'claimants.other_specialty.required' => 'Please specify the other specialty.',
        ];
    }
    
}
