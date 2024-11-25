
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
    states: Array,
    claimTypes: Array, 
    specialties: Array,
    serviceTypes: Array,


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
                    <div class="card-header">
                        <h1 class="card-title">Request Form</h1>
                        
                    </div>

                    <div class=" m-3">
                        Please complete the online service request below and click the “OK” button at the bottom to transmit the information to the appropriate party at Leidos QTC. 
                        Once submitted, you will receive an automated response which will include all the referral information provided.
                        
                    </div>
                    
                    <div class="card-header well">
                        <h3 class="card-title">Referrer and Billing Information</h3>
                    </div>

                    <ReferrerAndBilling v-model:billInfo="billInfo" v-model:referralInfo="referralInfo" :errors="errors" :states="states" />
                    <ClaimantAndPhysician v-model:claimants="claimants" v-model:physicians ="physicians" :claimTypes="claimTypes" :states="states" :serviceTypes="serviceTypes" :errors="errors" />
                    <IssuesAndItems  v-model:issue="issue" :errors="errors"/>
                    <AttorneyInformation v-model:defenseAttorney="defenseAttorney" v-model:claimantAttorney="claimantAttorney" :states="states"  :errors="errors" />
                    <AppointmentInformation v-model:appointments="appointments"  :specialties="specialties"  :errors="errors" />
                    <FileUpload ref="dropzoneRef"  :fieldMappings="fieldMappings"/> 
                    <InvalidFieldModal ref="invalidFieldModal" :invalidFields="invalidFields"/> 

                    
                     <div class="alert alert-info referralFormSSL">
                        <img src="/images/lock.gif" alt="Lock Icon" style="width: 19px; height: 19px;">
                        <span>This electronic Request Form utilizes state of the art security and data encryption. By activating the browser's "LOCK" icon, the Leidos QTC Portal's Security
                        Certificate employs 256-bit data encryption TLS (Transport Layer Security) and assures online visitors that confidential information cannot be viewed, intercepted
                        or altered in any way.</span>
                    </div>
                    
                    <div class="card-footer text-end">
                        <div class="col-sm-12 mt-3 text-center">
                            <h3>Form Information Confirmation</h3>
                                <div class="checkbox-">
                                    <span title="click the checkbox to enable submitting the form" style="color:Red;"><input id="ContentPlaceHolder1_uiIntakeFooter_chkConfirmed" type="checkbox" name="ctl00$ContentPlaceHolder1$uiIntakeFooter$chkConfirmed" onclick="ToggleSubmit('btnOK',this,true);"><label for="ContentPlaceHolder1_uiIntakeFooter_chkConfirmed">&nbsp; Please check this box to confirm this form is complete and accurate.</label></span><span style="color:red;" id="ContentPlaceHolder1_uiIntakeFooter_chkConfirmed_ValInfo"></span>
                                <br>
                            </div>
                        </div>
                        <button type="button" @click.prevent="formSubmit" class="btn btn-primary me-3">
                            <span v-if="loader" class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Submit
                        </button>
                    </div>
                    <div class="panel-footer CopyRightFooter">
                    <table class="CopyRightFooter">
                        <tbody>
                            <tr>
                                <td class="CopyRightFooterLeft"><a  href="#" target="Privacy">Privacy Policy</a></td>
                                <td class="CopyRightFooterCenter">© 2024 Quantum Core Services, QCS. All Rights Reserved.<br>
                                    Access restricted to employees and designated users.
                                </td>
                                <td class="CopyRightFooterRight">
                                    <a  href="#" >Terms of Service</a></td>
                            </tr>
                        </tbody>
                    </table>

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

div.CopyRightFooter {
    position: relative;
}
.panel-footer {
    padding: 10px 15px;
    background-color: #f5f5f5;
    border-top: 1px solid #ddd;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
}
td.CopyRightFooterLeft {
    text-align: left;
    vertical-align: bottom;
    width: 25%;
}
td.CopyRightFooterCenter {
    text-align: center;
    vertical-align: bottom;
    width: 30%;
}
td.CopyRightFooterRight {
    text-align: right;
    vertical-align: bottom;
    width: 25%;
}

div.IntakeHeader {
        padding: 5px;
      }
      div.col-sm-6.pull-left.text-left {
        margin-bottom: -21px;
        color: #3498db;
        
      }
      .subTitle {
        color:#e74c3c;
        font-weight:600;
      }
    
    
</style>




