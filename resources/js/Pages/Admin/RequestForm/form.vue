
<script setup>
import { ref , computed } from 'vue';
import { Link ,router , Head} from '@inertiajs/vue3'  
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import ReferrerAndBilling from '@/Components/ReferrerAndBilling.vue';
import ClaimantAndPhysician from '@/Components/ClaimantAndPhysician.vue';
import IssuesAndItems from '@/Components/IssuesAndItems.vue';
import AttorneyInformation from '@/Components/AttorneyInformation.vue';
import AppointmentInformation from '@/Components/AppointmentInformation.vue';
import FileUpload from '@/Components/FileUpload.vue'; 
import InvalidFieldModal from '@/Components/Modal/InvalidFieldModal.vue';
import { useToastr } from '@/toaster';

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
const uploadFile = ref(null);
const invalidFieldModal = ref(null);
const loader = ref(false);


async function formSubmit() {
    loader.value = true; 
    try {
        await router.post(
            route('request-forms.store'),
            { 
                billInfo: billInfo.value, referralInfo: referralInfo.value,
                claimants: claimants.value, physicians: physicians.value,
                issue: issue.value, defenseAttorney: defenseAttorney.value,
                claimantAttorney: claimantAttorney.value, appointments: appointments.value
            },
        );

        // If there's a file to upload, handle it
        if (uploadFile.value) {
            await uploadFile.value.uploadFiles();
        }
    } catch (error) {
        console.error('Submission Error:', error);
    } finally {
        loader.value = false;
    }
}


 // Field mappings
 // Computed property for fieldMappings
    const fieldMappings = computed(() => ({
        "Referring Company": referralInfo.value.referring_company,
        "Referring Source": referralInfo.value.referring_source, 
        "Referring Phone": referralInfo.value.phone,
        "Referring Email": referralInfo.value.email,
        "Bill To Company Name": billInfo.value.referring_company,
        "Bill To Referring Source": billInfo.value.referring_source,
        "Bill To Phone": billInfo.value.phone,
        "Bill To Email": billInfo.value.email,
        "Claimant Last Name": claimants.value.first_name,
        "Claimant First Name": claimants.value.first_name,
        "Date of Birth": claimants.value.dob,
        "Language": claimants.value.language,
        "Claim Number": issue.value.claim_number,
        "Injury Description": issue.value.injury_description,
        "Jurisdiction": issue.value.jurisdiction,
        "Claim Type": issue.value.service_type,
        "Other Service": issue.value.other_service,
        "Specialty or Other Specialty": issue.value.specialty,
    }));

    // Computed property to get invalid fields
    const invalidFields = computed(() => {
    return Object.entries(fieldMappings.value)
        .filter(([_, value]) => !value) 
        .map(([fieldName]) => fieldName); 
    });

    // Method to handle button click and show invalid fields
    const showInvalidFieldModal = () => {
        console.log(referralInfo.value);
        
        console.log(invalidFields.value);
        
        if (invalidFieldModal.value) {
            invalidFieldModal.value.show();
        }
    };
  
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
                    
                    <ReferrerAndBilling v-model:billInfo="billInfo" v-model:referralInfo="referralInfo" :errors="errors" />
                    <ClaimantAndPhysician v-model:claimants="claimants" v-model:physicians ="physicians" :errors="errors" />
                    <IssuesAndItems  v-model:issue="issue" :errors="errors"/>
                    <AttorneyInformation v-model:defenseAttorney="defenseAttorney" v-model:claimantAttorney="claimantAttorney" :errors="errors" />
                    <AppointmentInformation v-model:appointments="appointments" :errors="errors" />
                    <FileUpload ref="uploadFile"  :fieldMappings="fieldMappings"/> 
                    <InvalidFieldModal ref="invalidFieldModal" :invalidFields="invalidFields"/> 

                    
                     <div class="alert alert-info referralFormSSL">
                        <img src="/images/lock.gif" alt="Lock Icon" style="width: 19px; height: 19px;">
                        <span>This electronic Request Form utilizes state of the art security and data encryption. By activating the browser's "LOCK" icon, the Leidos QTC Portal's Security
                        Certificate employs 256-bit data encryption TLS (Transport Layer Security) and assures online visitors that confidential information cannot be viewed, intercepted
                        or altered in any way.</span>
                    </div>
                    

                    <div class="card-footer text-end">
                        <button type="button" @click.prevent="formSubmit" class="btn btn-primary me-3">
                            <span v-if="loader" class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Submit
                        </button>
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

.well{
    background-color: #901588 !important;
    color: white !important;
}
</style>