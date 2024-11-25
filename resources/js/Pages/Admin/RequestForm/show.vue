<script setup>
import { ref } from 'vue';
import { Link, router, Head } from '@inertiajs/vue3'
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';


const props = defineProps({
    referral: Object
});

const claimTypeId = ref(props.referral?.claimant_information?.claim_type);

function openFileInNewTab(filename) {
  const fileUrl = `/storage/${filename}`;
  window.open(fileUrl, '_blank');
}

</script>

<template>
    <MasterLayout>
        <template #content> 
            <Head title="Request Form" />
            <div class="m-3 col-lg-11">
                <div class="card"> 
                    <div class="card-header well">
                        <h3 class="card-title">Referrer and Billing Information </h3>
                    </div>
                    <div class="p-3">
                        <div class="card-header sub-well">
                            <h3 class="card-title">Referral Party Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Referring Company:</span>
                                        {{ referral?.referring_company }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Referring Source:</span>
                                        {{ referral?.referring_source }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ referral?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ referral?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ referral?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ referral?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ referral?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Phone:</span> {{ referral?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax:</span> {{ referral?.fax }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Email:</span> {{ referral?.email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-header sub-well">
                            <h3 class="card-title">Bill To Information</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Referring Company:</span>
                                        {{ referral?.bill_to_information?.referring_company }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Referring Source:</span>
                                        {{ referral?.bill_to_information?.referring_source }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ referral?.bill_to_information?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ referral?.bill_to_information?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ referral?.bill_to_information?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ referral?.bill_to_information?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ referral?.bill_to_information?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Phone:</span> {{ referral?.bill_to_information?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax:</span> {{ referral?.bill_to_information?.fax }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Email:</span> {{ referral?.bill_to_information?.email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- secttion 2 -->
                    <div class="card-header well">
                        <h3 class="card-title">Claimant and Physician Information</h3>
                    </div>
                    <div class="p-3">
                        <div class="card-header sub-well">
                            <h3 class="card-title">Claimant Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Last Name:</span>
                                        {{ referral?.claimant_information?.last_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>First Name:</span>
                                        {{ referral?.claimant_information?.first_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ referral?.claimant_information?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ referral?.claimant_information?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ referral?.claimant_information?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ referral?.claimant_information?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ referral?.claimant_information?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Home Phone:</span> {{ referral?.claimant_information?.home_phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Work Phone:</span> {{ referral?.claimant_information?.work_phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Social Security Number:</span> {{ referral?.claimant_information?.ssn }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Date Of Birth:</span> {{ referral?.claimant_information?.dob }}</p>
                                </div>
                               
                                <div class="col-md-4">
                                    <p><span>Gender:</span> {{ referral?.claimant_information?.gender }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Employer:</span> {{ referral?.claimant_information?.employer }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Occupation:</span> {{ referral?.claimant_information?.occupation }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Language:</span> {{ referral?.claimant_information?.language }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Other Language:</span> {{ referral?.claimant_information?.other_language }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Claim Number:</span> {{ referral?.claimant_information?.claim_number }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Date of Accident/ Injury:</span> {{ referral?.claimant_information?.accident_date }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Injury Description:</span> {{ referral?.claimant_information?.injury_description }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Background of Injury:</span> {{ referral?.claimant_information?.injury_background }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Currently Working:</span> {{ referral?.claimant_information?.currently_working ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Claim Accepted:</span> {{ referral?.claimant_information?.claim_accepted ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Jurisdiction:</span> {{ referral?.claimant_information?.jurisdiction }}</p>
                                </div>
                                
                                <div class="col-md-4">
                                    <p><span>Type of Claim:</span> {{ referral?.claimant_information?.claim?.name }}</p>
                                </div>
                               
                                <div class="col-md-4">
                                    <p><span>Type of Service:</span> {{ referral?.claimant_information?.service?.name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Other,Service:</span> {{ referral?.claimant_information?.other_claim_type }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Insured/Carrier:</span> {{ referral?.claimant_information?.insured_carrier }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>AMA 4th Edition:</span> {{ referral?.claimant_information?.ama_4th ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>AMA 5th Edition:</span> {{ referral?.claimant_information?.ama_5th ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>AMA 6th Edition:</span> {{ referral?.claimant_information?.ama_6th  ===1? 'Yes':'No'}}</p>
                                </div>
                                
                               
                            </div>
                        </div>
                        <div class="card-header sub-well">
                            <h3 class="card-title">Treating Physician(s)</h3>
                        </div>
                        <div class="card-body">
                            <div class="row" v-for="(item ,index) in referral?.physician_information" :key="item.id">
                                <div class="col-md-1">
                                    
                                        {{index+1 }}
                                </div>
                                <div class="col-md-4">
                                    <p><span>First Name:</span>
                                        {{item.first_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Last Name:</span>
                                        {{item.Last_name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-header sub-well">
                            <h3 class="card-title">Other Needs</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Transportation:</span> {{ referral?.claimant_information?.transportation ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Translation:</span> {{ referral?.claimant_information?.translation ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Conference Call:</span> {{ referral?.claimant_information?.conference_call===1? 'Yes':'No' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- secttion 3  Issues and Items to Address-->
                    <div class="card-header well">
                        <h3 class="card-title">Issues and Items to Address</h3>
                    </div>
                    <div class="p-3">
                        <div class="card-header sub-well">
                            <h3 class="card-title">Issues to Be Addressed </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6"  v-if="claimTypeId == 1 || claimTypeId == 2  || claimTypeId == 7">
                                    <p><span class="fw-bold">Causal relationship between injury and current
                                        complaints :</span>
                                        {{ referral?.issues_and_items_to_address?.injury_causal_relationship  === 1 ? 'Yes':'No' }}</p>
                                </div>

                                <div class="col-md-6"  v-if="claimTypeId == 2 || claimTypeId == 7">
                                    <p><span class="fw-bold">Please explain how the accident would have caused the patient's
                                        complaints :</span>
                                        {{ referral?.issues_and_items_to_address?.explain_cause_of_complaints  ===1? 'Yes':'No' }}</p>
                                </div>

                                <div class="col-md-6" v-if="claimTypeId == 2">
                                    <p><span class="fw-bold">Does the claimant have any activity restrictions :</span>
                                        {{ referral?.issues_and_items_to_address?.activity_restrictions ===1? 'Yes':'No' }}</p>
                                </div>
                                
                                <div class="col-md-6"  v-if="claimTypeId == 1  || claimTypeId == 2  || claimTypeId == 7 || claimTypeId == 8">
                                    <p><span class="fw-bold">Is current treatment reasonable and necessary :</span>
                                        {{referral?.issues_and_items_to_address?.is_current_treatment_necessary ===1? 'Yes':'No' }}</p>
                                </div>

                                <div class="col-md-6"  v-if="claimTypeId == 1 || claimTypeId == 2 || claimTypeId == 7 || claimTypeId == 8">
                                    <p><span class="fw-bold">Is further treatment needed? If so, what kind, for what length,
                                        and at what frequency:</span>
                                        {{referral?.issues_and_items_to_address?.further_treatment_needed  ===1? 'Yes':'No' }}</p>
                                </div>

                                <div class="col-md-6"  v-if="claimTypeId == 1 || claimTypeId == 2 || claimTypeId == 7 || claimTypeId == 8">
                                    <p><span class="fw-bold">Causal relationship between injury and current complaints? 
                                        Please explain how the accident would have caused the patients' complaints:</span>
                                        {{ referral?.issues_and_items_to_address?.is_causal_relationship_explained  ===1? 'Yes':'No'  }}</p>
                                </div>

                                <!-- General Liability -->
                                <div class="col-md-6"  v-if="claimTypeId == 1 || claimTypeId == 6 || claimTypeId == 8">
                                    <p><span class="fw-bold">Did the claimant sustain any permanent injury as a result of
                                        this accident? If not, please indicate this in your report:</span>
                                        {{ referral?.issues_and_items_to_address?.sustained_permanent_injury  ===1? 'Yes':'No' }}</p>
                                </div>

                                <!-- Work Compensation -->
                                <div class="col-md-6"  v-if="claimTypeId == 1 || claimTypeId == 6 || claimTypeId == 8">
                                    <p><span class="fw-bold">Can claimant return to work at this time with no
                                        restrictions :</span>
                                        {{ referral?.issues_and_items_to_address?.return_to_work_no_restrictions  ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-6"  v-if=" claimTypeId == 7">
                                    <p><span class="fw-bold">What are claimant's physical capabilities? :</span>
                                        {{ referral?.issues_and_items_to_address?.physical_capabilities  ===1? 'Yes':'No' }}</p>
                                </div>
                                
                                <div class="col-md-6">
                                    <p><span class="fw-bold">Cover Letter Provided By:</span>
                                        {{ referral?.issues_and_items_to_address?.cover_letter }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="fw-bold">Additional Information:</span>
                                        {{ referral?.issues_and_items_to_address?.additional_information }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- secttion 4  Attorney Information-->
                    <div class="card-header well">
                        <h3 class="card-title"> Attorney Information</h3>
                    </div>
                    <div class="p-3">
                        <div class="card-header sub-well">
                            <h3 class="card-title">Defense Attorney Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Attorney Name:</span>
                                        {{ referral?.defense_attorney?.attorney_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Firm Name:</span>
                                        {{ referral?.defense_attorney?.firm_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ referral?.defense_attorney?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ referral?.defense_attorney?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ referral?.defense_attorney?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ referral?.defense_attorney?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ referral?.defense_attorney?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Phone Number:</span> {{ referral?.defense_attorney?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax Number:</span> {{ referral?.defense_attorney?.fax }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Contact for Input:</span> {{ referral?.defense_attorney?.contact_for_input ===1? 'Yes':'No' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-header sub-well">
                            <h3 class="card-title">Claimant Attorney Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Attorney Name:</span>
                                        {{ referral?.claimant_attorney?.attorney_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Firm Name:</span>
                                        {{ referral?.claimant_attorney?.firm_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ referral?.claimant_attorney?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ referral?.claimant_attorney?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ referral?.claimant_attorney?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ referral?.claimant_attorney?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ referral?.claimant_attorney?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>PhoneNumber:</span> {{ referral?.claimant_attorney?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax Number:</span> {{ referral?.claimant_attorney?.fax }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end secttion 4  Attorney Information-->

                    <!-- secttion 5  Appointment Information-->
                    <div class="card-header well">
                        <h3 class="card-title">Appointment Information</h3>
                    </div>
                    <div class="p-3">
                        <div class="card-header sub-well">
                            <h3 class="card-title">Appointment Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Specialty :</span>
                                        {{ referral?.appointment_information?.specialty?.name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Other Specify:</span>
                                        {{ referral?.appointment_information?.other_specialty }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Provider:</span> {{ referral?.appointment_information?.provider}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Location:</span> {{ referral?.appointment_information?.location }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Appointment Date:</span> {{ referral?.appointment_information?.appointment_date }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Time:</span> {{ referral?.appointment_information?.appointment_time }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Report Completed By:</span> {{ referral?.appointment_information?.report_completed_by }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Reason For Report Rush Date:</span> {{ referral?.appointment_information?.	reason_report_rush_date }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>X-Rays Approved:</span> {{ referral?.appointment_information?.x_rays_approved ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Special Instructions / Price Restrictions:</span> {{ referral?.appointment_information?.special_instructions }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-header sub-well">
                            <h3 class="card-title">Notification of Appointment</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span> Copy to Claimant's Attorney:</span>
                                        {{ referral?.appointment_information?.copy_to_claimant_attorney ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Copy to Defense Attorney:</span>
                                        {{ referral?.appointment_information?.copy_to_defense_attorney ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Copy to Referring Party:</span>{{ referral?.appointment_information?.copy_to_referring_party ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Copy to Billing Party:</span> {{ referral?.appointment_information?.copy_to_billing_party ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Do Not Send Notifications:</span> {{ referral?.appointment_information?.do_not_send_notifications ===1? 'Yes':'No' }}</p>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- secttion 5  Appointment Information-->
                    <div class="card-header well">
                        <h3 class="card-title">Uploaded Files </h3>
                    </div>
                    <div class="p-3">
                        <div class="card-body">
                            <div class="row" v-for="(item ,index) in referral?.attachments" :key="item.id">
                                <div class="col-md-1">
                                    <p><span>{{index +1}}</span> </p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>File Name :  </span> {{ item.file_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="pointer" @click="openFileInNewTab(item.file_path)">
                                        view
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </template>
    </MasterLayout>
</template>


<style scoped>
.alert-info {
    background-color: #e2e3e5 !important;
    border-color: #e2e3e5 !important;
    color: black !important;
}

.well {
    background-color: #901588 !important;
    color: white !important;
}

.row .col-md-4 p span {
    font-weight: bold;
}

.sub-well {
    background: #dfe6e9 !important;
    border-color: #dfe6e9 !important;
    color: #0d0c0c !important;
    font-weight: bold;
}
.pointer {
    cursor: pointer;
}
</style>