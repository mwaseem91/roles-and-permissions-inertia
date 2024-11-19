<template>
    <MasterLayout>
        <template #content>
            <div class="m-3 col-lg-11">
                <div class="card">
                    <div class="card-header well">
                        <h3 class="card-title">Referrer and Billing Information</h3>
                    </div>
                    <!-- Bind billInfo with v-model -->
                    <ReferrerAndBilling v-model:billInfo="billInfo" v-model:referralInfo="referralInfo" :errors="errors" />
                    <ClaimantAndPhysician v-model:claimants="claimants" v-model:physicians ="physicians" :errors="errors" />
                    <IssuesAndItems  v-model:issue="issue" :errors="errors"/>
                    <AttorneyInformation v-model:defenseAttorney="defenseAttorney" v-model:claimantAttorney="claimantAttorney" :errors="errors" />
                    <AppointmentInformation v-model:appointments="appointments" :errors="errors" />
                    <FileUpload/> 

                     <!-- /////////////////////// -->
                     <div class="alert alert-info referralFormSSL">
                        <img src="images/lock.gif" alt="Lock Icon" style="width: 19px; height: 19px;">
                        <span>This electronic Request Form utilizes state of the art security and data encryption. By activating the browser's "LOCK" icon, the Leidos QTC Portal's Security
                        Certificate employs 256-bit data encryption TLS (Transport Layer Security) and assures online visitors that confidential information cannot be viewed, intercepted
                        or altered in any way.</span>
                    </div>
                    <!-- //////////////////////// -->

                    <div class="card-footer text-end">
                        <button type="button" @click="formSubmit" class="btn btn-primary">Submit</button>
                    </div>
                   

                   
                </div>
            </div>
        </template>
    </MasterLayout>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import ReferrerAndBilling from '@/Components/ReferrerAndBilling.vue';
import ClaimantAndPhysician from '@/Components/ClaimantAndPhysician.vue';
import IssuesAndItems from '@/Components/IssuesAndItems.vue';
import AttorneyInformation from '@/Components/AttorneyInformation.vue';
import AppointmentInformation from '@/Components/AppointmentInformation.vue';
import FileUpload from '@/Components/FileUpload.vue';
import test from '@/Components/test.vue';

// Reactive data
const billInfo = ref({}); 
const referralInfo = ref({}); 
const claimants = ref({}); 
const physicians = ref([]); 
const issue = ref([]); 
const defenseAttorney = ref([]); 
const claimantAttorney = ref([]); 
const appointments = ref([]); 
const errors = ref({}); 


// Form submission handler
function formSubmit() {

    router.post(
        route('request-forms.store'),
        { 
            billInfo: billInfo.value, referralInfo: referralInfo.value ,
            claimants: claimants.value , physicians: physicians.value , 
            issue: issue.value , defenseAttorney: defenseAttorney.value , 
            claimantAttorney: claimantAttorney.value ,appointments: appointments.value
        }, 
        {
            onError: (err) => {
                console.error('Error:', err);
                errors.value = err;
            }
        }
    );
}
</script>

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