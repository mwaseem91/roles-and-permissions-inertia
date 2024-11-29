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
       
        // Base rules
        $rules = [
            'referralInfo'  => 'required',
            'billInfo'  => 'required',
            'claimants'  => 'required',
            'defenseAttorney' => 'required',
            'claimantAttorney' => 'required',
            'appointments' => 'required',
            'files' => 'nullable|array|max:10',
            // Referral information
            'referralInfo.referring_company' => 'required|string|max:255',
            'referralInfo.referring_source' => 'required|string|max:255',
            'referralInfo.phone' => 'required|regex:/^\d{3} \d{3} \d{4}$/',
            'referralInfo.email' => 'required|email',
            'referralInfo.address1' => 'nullable|string',
            'referralInfo.address2' => 'nullable|string',
            'referralInfo.city' => 'nullable|string',
            'referralInfo.state' => 'nullable|exists:states,code',
            'referralInfo.zip_code' => 'nullable|numeric',
            'referralInfo.fax' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',

            'claimants.first_name' => 'required|string|max:255',
            'claimants.last_name' => 'required|string|max:255',
            'claimants.address1' => 'nullable|string',
            'claimants.address2' => 'nullable|string',
            'claimants.city' => 'nullable|string',
            'claimants.state' => 'nullable|exists:states,code',
            'claimants.zip_code' => 'nullable|numeric',

            'claimants.gender' => 'nullable|in:male,female',
            'claimants.employer' => 'nullable|string|max:255',
            'claimants.occupation' => 'nullable|string|max:255',
            'claimants.language' => 'nullable|string|max:255',
            'claimants.other_language' => 'nullable|string|max:255',

            'claimants.home_phone' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'claimants.work_phone' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'claimants.ssn' => 'nullable|regex:/^\d{4}$/',

            'claimants.dob' => 'required|date',
            'claimants.language' => 'required',
            'claimants.claim_number' => 'required',
            'claimants.injury_description' => 'required',
            'claimants.jurisdiction' => 'required',
            'claimants.claim_type' => 'required',
            'claimants.service_type' => 'required',

            'appointments.specialty' => 'required',
            
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

       

        if ($this->input('billInfo.same_as_referral') == false) {
            $conditionalRules = array_merge($conditionalRules, [
                'billInfo.referring_company' => 'required|string|max:255',
                'billInfo.referring_source' => 'required|string|max:255',
                'billInfo.phone' => 'required||regex:/^\d{3} \d{3} \d{4}$/',
                'billInfo.email' => 'required|email',
                'billInfo.address1' => 'nullable|string',
                'billInfo.address2' => 'nullable|string',
                'billInfo.city' => 'nullable|string',
                'billInfo.state' => 'nullable|exists:states,code',
                'billInfo.zip_code' => 'nullable|numeric',
                'referralInfo.fax' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',

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
            'referralInfo.state.exists' => 'The selected state is invalid.',
            'referralInfo.phone.regex' => 'Please enter a valid phone number.',
            'referralInfo.email.required' => 'Email address is required.',
            'referralInfo.email.email' => 'Please enter a valid email address.',
            'referralInfo.city.string' => 'Please enter a valid city name.',

            // billInfo
            'billInfo.referring_company.required' => 'Billing Referring Company is required.',
            'billInfo.referring_source.required' => 'Billing Referring Source is required.',
            'billInfo.phone.required' => 'Billing Phone number is required.',
            'billInfo.email.required' => 'Billing Email address is required.',

            // claimants
            'claimants.first_name.required' => 'Claimant first name is required.',
            'claimants.last_name.required' => 'Claimant last name is required.',
            'claimants.dob.required' => 'Claimant date of birth is required.',
            'claimants.language.required' => 'Claimant language is required.',
            'claimants.claim_number.required' => 'Claimant claim number is required.',
            'claimants.injury_description.required' => 'Claimant injury description is required.',
            'claimants.jurisdiction.required' => 'Claimant jurisdiction is required.',
            'claimants.service_type.required' => 'Claimant service type is required.',
            'claimants.gender.in' => 'Claimant gender must be one of the following: Male, Female.',
            'claimants.address1.string' => 'Claimant address1 must be a valid string.',
            'claimants.address2.string' => 'Claimant address2 must be a valid string.',
            'claimants.city.string' => 'Claimant city must be a valid string.',
            'claimants.state.exists' => 'Claimant state must be a valid state code.',
            'claimants.zip_code.numeric' => 'Claimant zip code must be a numeric value.',
            'claimants.employer.string' => 'Claimant employer must be a valid string.',
            'claimants.occupation.string' => 'Claimant occupation must be a valid string.',
            'claimants.language.string' => 'Claimant language must be a valid string.',
            'claimants.other_language.string' => 'Claimant other language must be a valid string.',
            'claimants.home_phone.regex' => 'Claimant home phone must be a valid phone number.',
            'claimants.work_phone.regex' => 'Claimant work phone must be a valid phone number.',
            'claimants.ssn.regex' => 'Claimant SSN must be a valid 4-digit number.',

            // appointments
            'appointments.specialty.required' => 'Appointment specialty is required.',

            // claimants
            'claimants.other_language.required' => 'Please specify the other language.',
            'claimants.other_claim_type.required' => 'Please specify the other claim type.',
            'claimants.other_specialty.required' => 'Please specify the other specialty.',

        ];
    }
    
}
