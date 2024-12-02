<?php

namespace App\Http\Requests;

use App\Models\AppointmentInformation;
use App\Models\AttorneyInformation;
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
        //BASE RULE
        $rules = [
            'referralInfo'  => 'required',
            'billInfo'  => 'required',
            'claimants'  => 'required',
            'defenseAttorney' => 'required',
            'claimantAttorney' => 'required',
            'appointments' => 'required',
           
            
            // REFERRAL INFORMATION
            'referralInfo.referring_company' => 'required|string|max:255',
            'referralInfo.referring_source' => 'required|string|max:255',
            'referralInfo.address1' => 'nullable|string',
            'referralInfo.address2' => 'nullable|string',
            'referralInfo.city' => 'nullable|string',
            'referralInfo.state' => 'nullable|exists:states,code',
            'referralInfo.zip_code' => 'nullable|numeric',
            'referralInfo.phone' => 'required|regex:/^\d{3} \d{3} \d{4}$/',
            'referralInfo.fax' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'referralInfo.email' => 'required|email|unique:referrals,email',


            // CLAIMANT INFORMATION
            'claimants.first_name' => 'required|string|max:255',
            'claimants.last_name' => 'required|string|max:255',
            'claimants.address1' => 'nullable|string',
            'claimants.address2' => 'nullable|string',
            'claimants.city' => 'nullable|string',
            'claimants.state' => 'nullable|exists:states,code',
            'claimants.zip_code' => 'nullable|numeric',
            'claimants.home_phone' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'claimants.work_phone' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'claimants.ssn' => 'nullable|regex:/^\d{4}$/',
            'claimants.dob' => 'required|date',
            'claimants.gender' => 'nullable|in:male,female',
            'claimants.employer' => 'nullable|string|max:255',
            'claimants.occupation' => 'nullable|string|max:255',
            'claimants.language' => 'required|string|max:255',
            'claimants.claim_number' => 'required|numeric',
            'claimants.accident_date' => 'nullable|date',
            'claimants.	injury_background' => 'nullable|string',
            'claimants.	currently_working' => 'nullable|boolean',
            'claimants.	claim_accepted' => 'nullable|boolean',
            'claimants.injury_description' => 'required|string',
            'claimants.jurisdiction' => 'required|string',
            'claimants.claim_type' => 'required|exists:claim_types,id',
            'claimants.service_type' => 'required |exists:service_types,id',
            'claimants.ama_4th' => 'nullable|boolean',
            'claimants.ama_5th' => 'nullable|boolean', 
            'claimants.ama_6th' => 'nullable|boolean',

            // OTHER NEEDS
            'claimants.transportation' => 'nullable|boolean',
            'claimants.translation' => 'nullable|boolean',
            'claimants.	conference_call' => 'nullable|boolean',

            // PHYSICIAN INFORMATION
            'physicians' => 'required|array', 
            'physicians.*.first_name' => 'required|string|max:255', 
            'physicians.*.last_name' => 'required|string|max:255', 

            // ISSUES AND ITEMS TO ADDRESS
            'issue.injury_causal_relationship' => 'nullable|boolean',
            'issue.explain_cause_of_complaints' => 'nullable|boolean',
            'issue.activity_restrictions' => 'nullable|boolean',
            'issue.is_current_treatment_necessary' => 'nullable|boolean',
            'issue.further_treatment_needed' => 'nullable|boolean',
            'issue.is_causal_relationship_explained' => 'nullable|boolean',
            'issue.sustained_permanent_injury' => 'nullable|boolean',
            'issue.return_to_work_no_restrictions' =>'nullable|boolean',
            'issue.physical_capabilities' => 'nullable|boolean',
            'issue.cover_letter' => 'nullable|in:Adjuster,Attorney,No Cover Letter',
            'issue.additional_information' => 'nullable|string',

            // DEFENSE ATTORNEY INFORMATION
          
            'defenseAttorney.type' => 'required|in:defense', 
            'defenseAttorney.attorney_name' => 'nullable|string|max:255',
            'defenseAttorney.firm_name' => 'nullable|string|max:255',
            'defenseAttorney.address1' => 'nullable|string',
            'defenseAttorney.address2' => 'nullable|string',
            'defenseAttorney.city' => 'nullable|string',
            'defenseAttorney.state' => 'nullable|exists:states,code', 
            'defenseAttorney.zip_code' => 'nullable|numeric',
            'defenseAttorney.phone' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'defenseAttorney.fax' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'defenseAttorney.contact_for_input' => 'nullable|boolean',

            // CLAIMANT ATTORNEY INFORMATION
            'claimantAttorney.type' => 'required|in:claimant',
            'claimantAttorney.attorney_name' => 'nullable|string|max:255',
            'claimantAttorney.firm_name' => 'nullable|string|max:255',
            'claimantAttorney.address1' => 'nullable|string',
            'claimantAttorney.address2' => 'nullable|string',
            'claimantAttorney.city' => 'nullable|string',
            'claimantAttorney.state' => 'nullable|exists:states,code', 
            'claimantAttorney.zip_code' => 'nullable|numeric',
            'claimantAttorney.phone' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
            'claimantAttorney.fax' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/', 
        

            // APPOINTMENTS INFORMATION
            'appointments.specialty' => 'required|exists:specialties,id',
            'appointments.other_specialty' => 'nullable|string|max:255',
            'appointments.provider' => 'required|string|max:255',
            'appointments.location' => 'required|string|max:255',
            'appointments.appointment_date' => 'required|date',
            'appointments.appointment_time' => 'required|date_format:H:i',
            'appointments.report_completed_by' => 'nullable|date',
            'appointments.reason_report_rush_date' => 'nullable|string|max:1000',
            'appointments.x_rays_approved' => 'required|boolean',
            'appointments.special_instructions' => 'nullable|string|max:1000',

            // NOTIFICATIONS OF APPOINTMENTS
            'appointments.copy_to_claimant_attorney' => 'nullable|boolean',
            'appointments.copy_to_defense_attorney' => 'nullable|boolean',
            'appointments.copy_to_referring_party' => 'nullable|boolean',
            'appointments.copy_to_billing_party' => 'nullable|boolean',
            'appointments.do_not_send_notifications' => 'nullable|boolean',

            // UPLOAD FILES
           'files' => 'nullable|array|max:10',
           'files.*' => 'file|mimes:doc,docx,xls,xlsx,txt,csv,pdf,jpg,tif,tiff,zip,mp3,msg,avi,mov,wmv,mp4|max:102400',

            
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

        if ($this->input('claimants.service_type') == 9) {
            $conditionalRules['claimants.other_claim_type'] = 'required|string';
        }

       

        if ($this->input('billInfo.same_as_referral') == false) {
            $conditionalRules = array_merge($conditionalRules, 
            [
                'billInfo.referring_company' => 'required|string|max:255',
                'billInfo.referring_source' => 'required|string|max:255',
                'billInfo.address1' => 'nullable|string',
                'billInfo.address2' => 'nullable|string',
                'billInfo.city' => 'nullable|string',
                'billInfo.state' => 'nullable|exists:states,code',
                'billInfo.zip_code' => 'nullable|numeric',
                'billInfo.phone' => 'required|regex:/^\d{3} \d{3} \d{4}$/',
                'billInfo.fax' => 'nullable|regex:/^\d{3} \d{3} \d{4}$/',
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
            'referralInfo.phone.required' => 'Phone number is required.',
            'referralInfo.phone.regex' => 'Please enter a valid phone number.',
            'referralInfo.email.required' => 'Email address is required.',
            'referralInfo.email.email' => 'Please enter a valid email address.',
            'referralInfo.email.unique' => 'The email has already been taken',
            'referralInfo.city.string' => 'Please enter a valid city name.',
            'referralInfo.referring_company.required' => 'Referring Company is required.',
            'referralInfo.referring_company.string' => 'The referring company must be a string.',
            'referralInfo.referring_source.required' => 'The referring source field is required.',
            'referralInfo.referring_source.string' => 'The referring source must be a string.',
            'referralInfo.address1.string' => 'The address1 must be a string.',
            'referralInfo.address2.string' => 'The address2 must be a string.',
            'referralInfo.city.string' => 'The city must be a string.',
            'referralInfo.state.exists' => 'Please choose a valid state code.',
            'referralInfo.zip_code.numeric' => 'The zip code must be a number.',
            'referralInfo.fax.regex' => 'The fax number must be in the format XXX XXX XXXX.',
            
             // billInfo
            'billInfo.phone.required' => 'Phone number is required.',
            'billInfo.phone.regex' => 'Please enter a valid phone number.',
            'billInfo.email.required' => 'Email address is required.',
            'billInfo.email.email' => 'Please enter a valid email address.',
            'billInfo.email.unique' => 'The email has already been taken',
            'billInfo.city.string' => 'Please enter a valid city name.',
            'billInfo.referring_company.required' => 'Referring Company is required.',
            'billInfo.referring_company.string' => 'The referring company must be a string.',
            'billInfo.referring_source.required' => 'The referring source field is required.',
            'billInfo.referring_source.string' => 'The referring source must be a string.',
            'billInfo.address1.string' => 'The address1 must be a string.',
            'billInfo.address2.string' => 'The address2 must be a string.',
            'billInfo.city.string' => 'The city must be a string.',
            'billInfo.state.exists' => 'Please choose a valid state code.',
            'billInfo.zip_code.numeric' => 'The zip code must be a number.',
            'billInfo.fax.regex' => 'The fax number must be in the format XXX XXX XXXX.',

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

            // claimants
            'claimants.other_language.required' => 'Please specify the other language.',
            'claimants.other_claim_type.required' => 'Please specify the other claim type.',
            'claimants.other_specialty.required' => 'Please specify the other specialty.',

            // Defense Attorney  information message
            'defenseAttorney.type.required' => 'The type field is required.',
            'defenseAttorney.type.in' => 'The type must be either "defense" or "claimant".',
            'defenseAttorney.attorney_name.string' => 'The attorney name must be a valid string.',
            'defenseAttorney.attorney_name.max' => 'The attorney name must not exceed 255 characters.',
            'defenseAttorney.firm_name.string' => 'The firm name must be a valid string.',
            'defenseAttorney.firm_name.max' => 'The firm name must not exceed 255 characters.',
            'defenseAttorney.address1.string' => 'The address line 1 must be a valid string.',
            'defenseAttorney.address2.string' => 'The address line 2 must be a valid string.',
            'defenseAttorney.city.string' => 'The city must be a valid string.',
            'defenseAttorney.state.exists' => 'Please choose a valid state code.',
            'defenseAttorney.zip_code.numeric' => 'The ZIP code must be a valid number.', 
            'defenseAttorney.phone.regex' => 'The phone number must be in the format ### ### ####.',
            'defenseAttorney.fax.regex' => 'The fax number must be in the format ### ### ####.',
            'defenseAttorney.contact_for_input.nullable' => 'The contact for input is optional.',
            'defenseAttorney.contact_for_input.boolean' => 'The contact for input must be either Yes or No.',

             // claimant Attorney  information message
             'claimantAttorney.type.required' => 'The type field is required.',
             'claimantAttorney.type.in' => 'The type must be either "defense" or "claimant".',
             'claimantAttorney.attorney_name.string' => 'The attorney name must be a valid string.',
             'claimantAttorney.attorney_name.max' => 'The attorney name must not exceed 255 characters.',
             'claimantAttorney.firm_name.string' => 'The firm name must be a valid string.',
             'claimantAttorney.firm_name.max' => 'The firm name must not exceed 255 characters.',
             'claimantAttorney.address1.string' => 'The address line 1 must be a valid string.',
             'claimantAttorney.address2.string' => 'The address line 2 must be a valid string.',
             'claimantAttorney.city.string' => 'The city must be a valid string.',
             'claimantAttorney.state.exists' => 'Please choose a valid state code.',
             'claimantAttorney.zip_code.numeric' => 'The ZIP code must be a valid number.', 
             'claimantAttorney.phone.regex' => 'The phone number must be in the format ### ### ####.',
             'claimantAttorney.fax.regex' => 'The fax number must be in the format ### ### ####.',

             'issue.cover_letter.in' => 'The cover letter must be one of the following: Adjuster, Attorney, or No Cover Letter.',
             'issue.additional_information.string' => 'The additional information must be a valid string.', 

            // AppointmentInformation messages
            'appointments.specialty.required' => 'Please select a specialty.',
            'appointments.specialty.exists' => 'The selected specialty is invalid.',
            'appointments.other_specialty.max' => 'The "Other" specialty name may not be greater than 255 characters.',
            'appointments.provider.required' => 'Please enter a provider.',
            'appointments.provider.max' => 'The provider name may not be greater than 255 characters.',
            'appointments.location.required' => 'Please enter the appointment location.',
            'appointments.location.max' => 'The location name may not be greater than 255 characters.',
            'appointments.appointment_date.required' => 'Please specify an appointment date.',
            'appointments.appointment_time.required' => 'Please specify an appointment time.',
            'appointments.appointment_time.date_format' => 'Please provide a valid time in the format HH:MM.',
            'appointments.report_completed_by.date' => 'The report completed date must be a valid date.',
            'appointments.reason_report_rush_date.max' => 'The reason for rush report cannot exceed 1000 characters.',
            'appointments.x_rays_approved.required' => 'Please select if X-rays are approved.',
            'appointments.x_rays_approved.boolean' => 'X-rays approved field must be true or false.',
            'appointments.special_instructions.max' => 'Special instructions may not be greater than 1000 characters.',
            'appointments.copy_to_claimant_attorney.boolean' => 'Please select a valid option.',
            'appointments.copy_to_defense_attorney.boolean' => 'Please select a valid option.',
            'appointments.copy_to_referring_party.boolean' => 'Please select a valid option.',
            'appointments.copy_to_billing_party.boolean' => 'Please select a valid option.',
            'appointments.do_not_send_notifications.boolean' => 'Please select a valid option.',

            // Files
            'files.array' => 'The files must be an array.',
            'files.max' => 'You can upload a maximum of 10 files.',
            'files.*.file' => 'Each file must be a valid file.',
            'files.*.mimes' => 'Only the following file types are allowed: doc, docx, xls, xlsx, txt, csv, pdf, jpg, tif, tiff, zip, mp3, msg, avi, mov, wmv, mp4.',
            'files.*.max' => 'Each file must be less than 100MB.',

        ];
    }
    
}
