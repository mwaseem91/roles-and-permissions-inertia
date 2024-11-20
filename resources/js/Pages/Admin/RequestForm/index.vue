<script setup>
import { ref } from 'vue';
import { Link, router, Head } from '@inertiajs/vue3'
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { object } from 'yup';

const props = defineProps({
    userData: object
});


</script>

<template>
    <MasterLayout>
        <template #content>

            <Head title="Request Form" />
            <div class="m-3 col-lg-11">
                <div class="card"> 
                    <div class="card-header well">
                        <h3 class="card-title">Referrer and Billing Information</h3>
                    </div>
                    <div class="p-3">
                        <div class="card-header sub-well">
                            <h3 class="card-title">Referral Party Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span>Referring Company:</span>
                                        {{ userData?.referral_information?.referring_company }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Referring Source:</span>
                                        {{ userData?.referral_information?.referring_source }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ userData?.referral_information?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ userData?.referral_information?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ userData?.referral_information?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ userData?.referral_information?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ userData?.referral_information?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Phone:</span> {{ userData?.referral_information?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax:</span> {{ userData?.referral_information?.fax }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Email:</span> {{ userData?.referral_information?.email }}</p>
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
                                        {{ userData?.bill_to_information?.referring_company }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Referring Source:</span>
                                        {{ userData?.bill_to_information?.referring_source }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ userData?.bill_to_information?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ userData?.bill_to_information?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ userData?.bill_to_information?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ userData?.bill_to_information?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ userData?.bill_to_information?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Phone:</span> {{ userData?.bill_to_information?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax:</span> {{ userData?.bill_to_information?.fax }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Email:</span> {{ userData?.bill_to_information?.email }}</p>
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
                                        {{ userData?.claimant_information?.last_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>First Name:</span>
                                        {{ userData?.claimant_information?.first_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ userData?.claimant_information?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ userData?.claimant_information?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ userData?.claimant_information?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ userData?.claimant_information?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ userData?.claimant_information?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Home Phone:</span> {{ userData?.claimant_information?.home_phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Work Phone:</span> {{ userData?.claimant_information?.work_phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Social Security Number:</span> {{ userData?.claimant_information?.ssn }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Date Of Birth:</span> {{ userData?.claimant_information?.dob }}</p>
                                </div>
                               
                                <div class="col-md-4">
                                    <p><span>Gender:</span> {{ userData?.claimant_information?.gender }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Employer:</span> {{ userData?.claimant_information?.employer }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Occupation:</span> {{ userData?.claimant_information?.occupation }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Language:</span> {{ userData?.claimant_information?.language }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Other Language:</span> {{ userData?.claimant_information?.other_language }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Claim Number:</span> {{ userData?.claimant_information?.claim_number }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Date of Accident/ Injury:</span> {{ userData?.claimant_information?.accident_date }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Injury Description:</span> {{ userData?.claimant_information?.injury_description }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Background of Injury:</span> {{ userData?.claimant_information?.injury_background }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Currently Working:</span> {{ userData?.claimant_information?.currently_working ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Claim Accepted:</span> {{ userData?.claimant_information?.claim_accepted ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Jurisdiction:</span> {{ userData?.claimant_information?.jurisdiction }}</p>
                                </div>
                                
                                <div class="col-md-4">
                                    <p><span>Type of Claim:</span> {{ userData?.claimant_information?.claim_type }}</p>
                                </div>
                               
                                <div class="col-md-4">
                                    <p><span>Type of Service:</span> {{ userData?.claimant_information?.service_type }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Other,Service:</span> {{ userData?.claimant_information?.other_claim_type }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Insured/Carrier:</span> {{ userData?.claimant_information?.insured_carrier }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>AMA 4th Edition:</span> {{ userData?.claimant_information?.ama_4th ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>AMA 5th Edition:</span> {{ userData?.claimant_information?.ama_5th ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>AMA 6th Edition:</span> {{ userData?.claimant_information?.ama_6th  ===1? 'Yes':'No'}}</p>
                                </div>
                                
                               
                            </div>
                        </div>
                        <div class="card-header sub-well">
                            <h3 class="card-title">Treating Physician(s)</h3>
                        </div>
                        <div class="card-body">
                            <div class="row" v-for="(item ,index) in userData?.physician_information" :key="item.id">
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
                                    <p><span>Transportation:</span> {{ userData?.claimant_information?.transportation ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Translation:</span> {{ userData?.claimant_information?.translation ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Conference Call:</span> {{ userData?.claimant_information?.conference_call===1? 'Yes':'No' }}</p>
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
                                <div class="col-md-4">
                                    <p><span>Cover Letter Provided By:</span>
                                        {{ userData?.issues_and_items_to_address?.cover_letter }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Additional Information:</span>
                                        {{ userData?.issues_and_items_to_address?.additional_information }}</p>
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
                                        {{ userData?.defense_attorney?.attorney_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Firm Name:</span>
                                        {{ userData?.defense_attorney?.firm_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ userData?.defense_attorney?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ userData?.defense_attorney?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ userData?.defense_attorney?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ userData?.defense_attorney?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ userData?.defense_attorney?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Phone Number:</span> {{ userData?.defense_attorney?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax Number:</span> {{ userData?.defense_attorney?.fax }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Contact for Input:</span> {{ userData?.defense_attorney?.contact_for_input ===1? 'Yes':'No' }}</p>
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
                                        {{ userData?.claimant_attorney?.attorney_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Firm Name:</span>
                                        {{ userData?.claimant_attorney?.firm_name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 1:</span> {{ userData?.claimant_attorney?.address1 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Address 2:</span> {{ userData?.claimant_attorney?.address2 }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>City:</span> {{ userData?.claimant_attorney?.city }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>State:</span> {{ userData?.claimant_attorney?.state }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>ZIP Code:</span> {{ userData?.claimant_attorney?.zip_code }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>PhoneNumber:</span> {{ userData?.claimant_attorney?.phone }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Fax Number:</span> {{ userData?.claimant_attorney?.fax }}</p>
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
                                        {{ userData?.appointment?.specialty }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Other Specify:</span>
                                        {{ userData?.appointment?.other_specialty }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Provider:</span> {{ userData?.appointment?.provider}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Location:</span> {{ userData?.appointment?.location }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Appointment Date to Take Place By:</span> {{ userData?.appointment?.appointment_date }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Time:</span> {{ userData?.appointment?.appointment_time }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Report Completed By:</span> {{ userData?.appointment?.report_completed_by }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Reason For Report Rush Date:</span> {{ userData?.appointment?.	reason_report_rush_date }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>X-Rays Approved:</span> {{ userData?.appointment?.x_rays_approved ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span>Special Instructions / Price Restrictions:</span> {{ userData?.appointment?.special_instructions }}</p>
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
                                        {{ userData?.appointment?.copy_to_claimant_attorney ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Copy to Defense Attorney:</span>
                                        {{ userData?.appointment?.copy_to_defense_attorney ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Copy to Referring Party:</span>{{ userData?.appointment?.copy_to_referring_party ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Copy to Billing Party:</span> {{ userData?.appointment?.copy_to_billing_party ===1? 'Yes':'No' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><span> Do Not Send Notifications:</span> {{ userData?.appointment?.do_not_send_notifications ===1? 'Yes':'No' }}</p>
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
</style>