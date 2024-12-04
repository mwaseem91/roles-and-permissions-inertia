<script setup>
import { ref, defineProps, computed } from 'vue';

import { router } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import MasterLayout from '@/Layouts/Frontend/MasterLayout.vue';
import ReferrerAndBilling from '@/Components/ReferrerAndBilling.vue';
import ClaimantAndPhysician from '@/Components/ClaimantAndPhysician.vue';
import IssuesAndItems from '@/Components/IssuesAndItems.vue';
import AttorneyInformation from '@/Components/AttorneyInformation.vue';
import AppointmentInformation from '@/Components/AppointmentInformation.vue';
import FileUpload from '@/Components/FileUpload.vue';
import InvalidFieldModal from '@/Components/Modal/InvalidFieldModal.vue';


const props = defineProps({
    states: Array,
    claimTypes: Array,
    specialties: Array,
    serviceTypes: Array,
});

// Reactive data
const billInfo = ref({});
const referralInfo = ref({});
const claimants = ref({});
const physicians = ref([]);
const issue = ref({});
const defenseAttorney = ref({});
const claimantAttorney = ref({});
const appointments = ref({});
const errors = ref({});
const invalidFieldModal = ref(null);
const isLoading = ref(false);
const dropzoneRef = ref(null);
const isChecked = ref(false);


async function formSubmit() {
    isLoading.value = true; 
    const files = dropzoneRef.value.dropzoneFiles;

    try {
        await router.post(
            route('request-forms.store'),
            {
                files: files,
                billInfo: billInfo.value, referralInfo: referralInfo.value,
                claimants: claimants.value, physicians: physicians.value,
                issue: issue.value, defenseAttorney: defenseAttorney.value,
                claimantAttorney: claimantAttorney.value, appointments: appointments.value
            },
            {
                onSuccess: () => {
                    isLoading.value = false;

                },
                onError: (err) => {
                    errors.value = err;
                    isLoading.value = false;
                }
            }
        );

    } catch (error) {
        console.error('Submission Error:', error);
    }
}



// Computed property for fieldMappings validation
const fieldMappings = computed(() => {
    const mappings = {
        "Referring Company": referralInfo.value.referring_company,
        "Referring Source": referralInfo.value.referring_source,
        "Referring Phone": referralInfo.value.phone,
        "Referring Email": referralInfo.value.email,
        "Claimant Last Name": claimants.value.first_name,
        "Claimant First Name": claimants.value.first_name,
        "Date of Birth": claimants.value.dob,
        "Language": claimants.value.language,
        "Claim Number": claimants.value.claim_number,
        "Injury Description": claimants.value.injury_description,
        "Jurisdiction": claimants.value.jurisdiction,
        "Claim Type": claimants.value.claim_type,
        "Service Type": claimants.value.service_type,
        "Specialty or Other Specialty": appointments.value.specialty,
    };

    if (claimants.value.language === 'other') {
        mappings["Other Language"] = claimants.value.other_language;
    }
    if (claimants.value.service_type == 9) {
        mappings["Specify Other Service"] = claimants.value.other_claim_type;
    }
    if (billInfo.value.same_as_referral == null || billInfo.value.same_as_referral == false) {
        mappings["Bill To Company Name"] = billInfo.value.referring_company;
        mappings[ "Bill To Contact Name"] = billInfo.value.referring_source;
        mappings["Bill To Phone"] = billInfo.value.phone;
        mappings["Bill To Email"] = billInfo.value.email;
    }

    return mappings;
});

// Computed property to get invalid fields
const invalidFields = computed(() => {
    return Object.entries(fieldMappings.value)
        .filter(([_, value]) => !value) // Check for missing values
        .map(([fieldName]) => fieldName);
});

const formValid = computed(() => {
    return invalidFields.value.length == 0; 
});

const showInvalidFieldModal = () => {
    if (!formValid.value) {
        isChecked.value = false;
        invalidFieldModal.value.show();
    }

};

</script>

<template>
    <MasterLayout>
        <template #content>

            <Head title="Request Form" />
            <div class="mb-5 col-lg-12">
                
                <div class="card m-7">
                    <div class="card-header">
                        <h1 class="card-title">Request Form</h1>

                    </div>

                    <div class="m-3">
                        Please fill out the online service request form below and click the "Submit" button to send the information
                        to the Quantum Core. After submission, you will receive an automated confirmation email containing all
                        the referral details you provided.

                    </div>

                    <div class="card-header well">
                        <h3 class="card-title">Referrer And Billing Information</h3>
                    </div>

                    <ReferrerAndBilling 
                        v-model:billInfo="billInfo" 
                        v-model:referralInfo="referralInfo" 
                        :errors="errors"
                        :states="states" />

                    <ClaimantAndPhysician 
                        v-model:claimants="claimants" 
                        v-model:physicians="physicians"
                        :claimTypes="claimTypes" 
                        :states="states" 
                        :serviceTypes="serviceTypes" 
                        :errors="errors" />

                    <IssuesAndItems 
                        v-model:issue="issue" 
                        :errors="errors" />

                    <AttorneyInformation 
                        v-model:defenseAttorney="defenseAttorney"
                        v-model:claimantAttorney="claimantAttorney" 
                        :states="states" 
                        :errors="errors" />

                    <AppointmentInformation 
                        v-model:appointments="appointments" 
                        :specialties="specialties"
                        :errors="errors" />

                    <FileUpload 
                        ref="dropzoneRef" 
                        :fieldMappings="fieldMappings" 
                        :errors="errors"/>
                    
                    <InvalidFieldModal 
                        ref="invalidFieldModal" 
                        :invalidFields="invalidFields" />


                    <div class="alert alert-info referralFormSSL">
                        <img src="/images/lock.gif" alt="Lock Icon" style="width: 19px; height: 19px;">
                        <span>This electronic Request Form utilizes state of the art security and data encryption. By
                            activating the browser's "LOCK" icon, the Leidos QTC Portal's Security
                            Certificate employs 256-bit data encryption TLS (Transport Layer Security) and assures
                            online visitors that confidential information cannot be viewed, intercepted
                            or altered in any way.</span>
                    </div>

                    <div class="card-footer text-end">
                        <div class="col-sm-12 mt-3 mb-3 text-center">
                            <h3>Form Information Confirmation</h3>
                            <div class="checkbox">
                                <span title="click the checkbox to enable submitting the form" style="color:Red;">
                                    <input type="checkbox" v-model="isChecked" @change="showInvalidFieldModal">
                                    <label for="ContentPlaceHolder1_uiIntakeFooter_chkConfirmed">&nbsp;
                                        Please check this box to confirm this form is complete and accurate.
                                    </label></span>
                                <span style="color:red;"></span>
                                <br>
                            </div>
                        </div>
                        <button type="button" @click.prevent="formSubmit" :disabled="!isChecked || isLoading" class="btn btn-primary me-3">
                            <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Submit
                        </button>
                    </div>
                    <div class="panel-footer CopyRightFooter">
                        <div class="CopyRightFooterLeft">
                            <a href="#" target="Privacy">Privacy Policy</a>
                        </div>
                        <div class="CopyRightFooterCenter">
                            © 2024 Quantum Core Services, QCS. All Rights Reserved.<br> Access restricted to employees and designated users.
                        </div>
                        <div class="CopyRightFooterRight">
                            <a href="#">Terms of Service</a>
                        </div>
                    </div>

                </div>

            </div>
        </template>
    </MasterLayout>
</template>


<style >
.alert-info {
    background-color: #e2e3e5 !important;
    border-color: #e2e3e5 !important;
    color: black !important;
}

.well {
    background-color: #3A226E!important;
    color: white !important;
}
.sub-well {
    background-color: #58B6A2 !important;
    color: white !important;
}

div.CopyRightFooter {
    position: relative;
    padding: 10px 15px;
    background-color: #f5f5f5;
    border-top: 1px solid #ddd;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    display: flex;
    justify-content: space-between;  
    align-items: center;  
}

.CopyRightFooterLeft,
.CopyRightFooterCenter,
.CopyRightFooterRight {
    flex: 1; 
    text-align: center;
}

.CopyRightFooterLeft {
    text-align: left;
    padding-right: 15px;  
}

.CopyRightFooterCenter {
    text-align: center;
    padding: 0 15px;  
}

.CopyRightFooterRight {
    text-align: right;
    padding-left: 15px;  
}

.panel-footer {
    padding: 10px 15px;
    background-color: #f5f5f5;
    border-top: 1px solid #ddd;
    border-radius: 3px;
}

.subTitle {
    color: #e74c3c;
    font-weight: 600;
}

div.IntakeHeader {
    padding: 5px;
}

div.col-sm-6.pull-left.text-left {
    margin-bottom: -21px;
    color: #3498db;
}

</style>
