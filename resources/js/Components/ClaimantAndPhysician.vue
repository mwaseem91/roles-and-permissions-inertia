<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">Claimant and Physician Information</h3>
        </div>
        <div class="p-2 row row-cards">

            <div class="col-6">
                <div class="card">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Claimant Details</h3>
                    </div>
                    <div class="card-body row">
                        <InputFieldComponent label="Last Name" placeholder="Enter Last Name" type="text"
                            v-model="localClaimant.last_name" classes="mb-3 col-6" />
                        <InputFieldComponent label="First Name" placeholder="Enter First Name" type="text"
                            v-model="localClaimant.first_name" classes="mb-3 col-6" />
                        <InputFieldComponent label="Address" placeholder="Address 1" type="text"
                            v-model="localClaimant.address1" classes="col-12" />
                        <InputFieldComponent placeholder="Address 2" type="text" v-model="localClaimant.address2"
                            classes="col-12 mb-3" />
                        <InputFieldComponent label="City" placeholder="Enter City" type="text" v-model="localClaimant.city"
                            classes="mb-3 col-6" />
                        <div class="mb-3 col-3">
                            <label class="form-label">State</label>
                            <select v-model="localClaimant.state" class="form-control form-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <InputFieldComponent label="ZIP Code" placeholder="ZIP Code" type="text"
                            v-model="localClaimant.zip_code" classes="mb-3 col-3" />
                        <div class="mb-3 col-6">
                            <label class="form-label">Home Phone Number</label>
                            <input type="text" v-model="localClaimant.home_phone" class="form-control" v-mask="'### ### ####'"
                                placeholder="### ### ####" autocomplete="off" />
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Work Phone Number</label>
                            <input type="text" v-model="localClaimant.work_phone" class="form-control" v-mask="'### ### ####'"
                                placeholder="### ### ####" autocomplete="off" />
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Social Security Number</label>
                            <input type="text" v-model="localClaimant.ssn" class="form-control" v-mask="'### ### ####'"
                                placeholder="### ### ####" autocomplete="off" />
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" v-model="localClaimant.dob" class="form-control" autocomplete="off" />
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Gender</label>
                            <select v-model="localClaimant.gender" class="form-control form-select">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <InputFieldComponent label="Employer" placeholder="Employer" type="text"
                            v-model="localClaimant.employer" classes="mb-3 col-12" />
                        <InputFieldComponent label="Occupation" placeholder="Occupation" type="text"
                            v-model="localClaimant.occupation" classes="mb-3 col-12" />
                        <div class="mb-3 col-6">
                            <label class="form-label">Language</label>
                            <select v-model="localClaimant.language" class="form-control form-select">
                                <option value="english">English</option>
                                <option value="spanish">Spanish</option>
                                <option value="cambodian">Cambodian</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <InputFieldComponent label="Other Language"
                            :disabled="localClaimant.language === 'other' ? false : true" v-model="localClaimant.other_language"
                            type="text" classes="mb-3 col-6" />
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body row mt-4">
                        <InputFieldComponent label="Claim Number" placeholder="Claim Number" type="text"
                            v-model="localClaimant.claim_number" classes="mb-3 col-12" />
                        <InputFieldComponent label="Date of Accident/ Injury" type="date"
                            v-model="localClaimant.accident_date" classes="mb-3 col-12" />
                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label class="form-label">Injury Description / Nature of Injury</label>
                                <textarea rows="5" class="form-control" v-model="localClaimant.injury_description"
                                    placeholder="Here can be your description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label class="form-label">Background of Injury</label>
                                <textarea rows="5" class="form-control" v-model="localClaimant.injury_background"
                                    placeholder="Here can be your description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Currently Working</label>
                                <select v-model="localClaimant.currently_working" class="form-control form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Claim Accepted</label>
                                <select v-model="localClaimant.claim_accepted" class="form-control form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Jurisdiction</label>
                                <select v-model="localClaimant.jurisdiction" class="form-control form-select">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Type of Claim</label>
                            <select v-model="localClaimant.claim_type" class="form-control form-select">
                                <option selected="selected" value=""></option>
                                <option value="1">Liability - Auto 3rd Party / Bodily Injury</option>
                                <option value="2">Auto 1st Party / Personal Injury Protection-No Fault</option>
                                <option value="3">Disability - Long Term</option>
                                <option value="4">Disability - Short Term</option>
                                <option value="5">Fit For Duty</option>
                                <option value="6">General Liability</option>
                                <option value="7">Workers Compensation</option>
                                <option value="8">Federal (Longshore)</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Type of Service</label>
                            <select v-model="localClaimant.service_type" class="form-control form-select">
                                <option selected="selected" value=""></option>
                                <option value="1">Independent Medical Evaluation (IME)</option>
                                <option value="2">Permanancy Evaluation</option>
                                <option value="3">Fit for Duty Evaluation</option>
                                <option value="4" disabled="disabled">Medical Evaluation (State of DE only)</option>
                                <option value="5">Impairment Rating Evaluation (IRE)</option>
                                <option value="6">Review Services</option>
                                <option value="9">Medical Records Prepping and Nurse Clinical Review</option>
                                <option value="7">Medical Records Prepping Only</option>
                                <option value="8">Other</option>
                            </select>
                        </div>
                        <InputFieldComponent label="If Other, please specify"
                            :disabled="localClaimant.service_type == 8 ? false : true"
                            v-model="localClaimant.other_claim_type" type="text" classes="mb-3 col-12" />
                        <InputFieldComponent label="Insured/Carrier" v-model="localClaimant.insured_carrier" type="text"
                            classes="mb-3 col-12" />
                        <div class="mb-3 col-md-12" v-if="localClaimant.service_type == 5">
                            <div class="display-flex">
                                <label class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" v-model="localClaimant.ama_4th" />
                                    <span class="form-label">AMA 4th Edition</span>
                                </label>
                                <label class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" v-model="localClaimant.ama_5th" />
                                    <span class="form-label">AMA 5th Edition</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" v-model="localClaimant.ama_6th" />
                                    <span class="form-label">AMA 6th Edition</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Treating Physician -->
            <div class="col-6">
                <div class="card">
                    <div class="card-header sub-well d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Treating Physician(s)</h3>
                        <button class="btn btn-primary float-start" type="button" @click="addClaimant"
                            :disabled="physicianDetails.length == 10">
                            <i class="fas fa-plus me-2"></i> Add Treating Physician
                        </button>
                    </div>
                    <div class="card-body row">
                        <div v-for="(localphysician, index) in physicianDetails" :key="index" class="col-12 mb-3">
                            <div class="row">
                                <InputFieldComponent label="Last Name" placeholder="Enter Last Name" type="text"
                                    v-model="localphysician.last_name" classes="mb-3 col-6" />
                                <InputFieldComponent label="First Name" placeholder="Enter First Name" type="text"
                                    v-model="localphysician.first_name" classes="mb-3 col-6" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Treating Physician -->

            <!-- Other Needs -->
            <div class="col-6">
                <div class="card ">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Other Needs</h3>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-12">

                            <label class="form-check me-3">
                                <input class="form-check-input" type="checkbox" v-model="localClaimant.transportation">
                                <span class="form-label">Transportation </span>
                            </label>
                            <label class="form-check me-3">
                                <input class="form-check-input" type="checkbox" v-model="localClaimant.translation">
                                <span class="form-label">Translation</span>
                            </label>
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="localClaimant.conference_call">
                                <span class="form-label">Conference Call</span>
                            </label>

                        </div>
                    </div>
                </div>
            </div>
            <!--End Other Needs -->
        </div>
    </div>
</template>

<script setup>
import { reactive, watch } from 'vue';
import InputFieldComponent from '@/Components/General/InputFieldComponent.vue';

const props = defineProps({
    claimants: Object,
    physician: Array,
    errors: Object
});

const emit = defineEmits(['update:claimants']);


const localClaimant = reactive({ ...props.claimants });



watch(localClaimant, (newVal) => {
    emit('update:claimants', newVal);
});

watch(() => props.claimants, (newVal) => {
    Object.assign(localClaimant, newVal);
});

// for physician
const localphysician = reactive({ ...props.physician });



watch(() => props.physicians, (newVal) => {
    Object.assign(localphysician, newVal);
});

const physicianDetails = reactive([
    { last_name: '', first_name: '' },
]);


// Function to add new physician (append new empty fields)
function addClaimant() {
    if (physicianDetails.length < 10) {
        physicianDetails.push({ last_name: '', first_name: '' });
    }
}

watch(physicianDetails, (newVal) => {
    emit('update:physicians', newVal);
});

</script>

<style scoped>
.display-flex {
    display: flex;
}
.sub-well {
    background: #dfe6e9 !important;
    border-color: #dfe6e9 !important;
    color: #0d0c0c !important;
    font-weight: bold;
}
</style>
