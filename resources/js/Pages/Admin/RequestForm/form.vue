
<script setup>
import { ref ,defineProps } from 'vue'; 
import {router , Head } from '@inertiajs/vue3'  
import MasterLayout from '@/Layouts/Frontend/MasterLayout.vue';
import ReferrerAndBilling from '@/Components/ReferrerAndBilling.vue';
import ClaimantAndPhysician from '@/Components/ClaimantAndPhysician.vue';
import IssuesAndItems from '@/Components/IssuesAndItems.vue';
import AttorneyInformation from '@/Components/AttorneyInformation.vue';
import AppointmentInformation from '@/Components/AppointmentInformation.vue';
import FileUpload from '@/Components/FileUpload.vue'; 
import InvalidFieldModal from '@/Components/Modal/InvalidFieldModal.vue';
import { useClaimStore } from "@/Stores/ClaimStore"; 


const props = defineProps({
    claimTypes: Array, 
});
const claimStore = useClaimStore();

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
const loader = ref(false);
const dropzoneRef = ref(null);


async function formSubmit() {
    loader.value = true; 
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
                  
                },
                onError: (err) => {
                    errors.value = err;
                }
            }
        );

    } catch (error) {
        console.error('Submission Error:', error);
    } finally {
        loader.value = false;
    }
}


</script>

<template>
    <MasterLayout>
        <template #content>
            <Head title="Request Form" />
            <div class="mb-5 col-lg-12">
                <div class="card m-7">
                    <div class="card-header well">
                        <h3 class="card-title">Referrer and Billing Information</h3>
                    </div>
                    <ReferrerAndBilling v-model:billInfo="billInfo" v-model:referralInfo="referralInfo" :errors="errors" />
                    <ClaimantAndPhysician v-model:claimants="claimants" v-model:physicians ="physicians" :claimTypes="claimTypes" :errors="errors" />
                    <IssuesAndItems  v-model:issue="issue" :errors="errors"/>
                    <AttorneyInformation v-model:defenseAttorney="defenseAttorney" v-model:claimantAttorney="claimantAttorney" :errors="errors" />
                    <AppointmentInformation v-model:appointments="appointments" :errors="errors" />
                    <FileUpload ref="dropzoneRef"  :fieldMappings="fieldMappings"/> 
                    <!-- <InvalidFieldModal ref="invalidFieldModal" :invalidFields="invalidFields"/>  -->

                    
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