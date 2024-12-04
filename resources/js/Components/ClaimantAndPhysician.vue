<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">Claimant and Physician Information</h3>
        </div>
        <div class="p-2 row row-cards">

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Claimant Information</h3>
                    </div>
                    <div class="card-body row">
                        
                        <InputFieldComponent label="First Name" placeholder="Enter First Name" type="text"
                            v-model="localClaimant.first_name" :error="errors['claimants.first_name'] ?? ''"
                             classes="mb-3  col-12 col-md-6" labelClasses="required" />

                        <InputFieldComponent label="Last Name" placeholder="Enter Last Name" type="text"
                            v-model="localClaimant.last_name" :error="errors['claimants.last_name'] ?? ''"
                            classes="mb-3 col-12 col-md-6" labelClasses="required"  />
                            <div class="mb-3  col-12 col-md-6">
                            <label class="form-label">Home Phone Number</label>
                            <input type="text" v-model="localClaimant.home_phone" class="form-control" v-mask="'### ### ####'"
                                placeholder="### ### ####" autocomplete="off" />

                                <span v-if="errors['claimants.home_phone']" class="text-danger">{{errors['claimants.home_phone']}}</span>
                        </div>
                        <div class="mb-3  col-12 col-md-6">
                            <label class="form-label">Work Phone Number</label>
                            <input type="text" v-model="localClaimant.work_phone" class="form-control" v-mask="'### ### ####'"
                                placeholder="### ### ####" autocomplete="off" />

                                <span v-if="errors['claimants.work_phone']" class="text-danger">{{errors['claimants.work_phone']}}</span>
                        </div>
                        <div class="mb-3  col-12 col-md-6">
                            <label class="form-label">Social Security Number</label>
                            <input type="text" v-model="localClaimant.ssn" class="form-control" v-mask="'####'"
                                placeholder="####" autocomplete="off" />

                                <span v-if="errors['claimants.ssn']" class="text-danger">{{errors['claimants.ssn']}}</span>
                        </div>
                        <div class="mb-3  col-12 col-md-6">
                            <label class="form-label required">Date of Birth</label>
                            <input type="date" v-model="localClaimant.dob"
                                class="form-control" autocomplete="off" />
                            <span v-if="errors['claimants.dob']" class="text-danger">{{errors['claimants.dob']}}</span>
                        </div>

                        <InputFieldComponent label="City" placeholder="Enter City" type="text" v-model="localClaimant.city"
                            classes="mb-3  col-12 col-md-6" :error="errors['claimants.city'] ?? ''"/>

                        <div class="mb-3  col-12 col-md-3">
                            <label class="form-label">State</label>
                            <select v-model="localClaimant.state" class="form-control form-select">
                                <option selected="selected" value=""></option>
                                <option v-for="state in states" :key="state.code" :value="state.code">
                                    {{ state.code }}
                                </option>
                            </select>
                            <span v-if="errors['claimants.state']" class="text-danger">{{errors['claimants.state']}}</span>
                        </div>
                        
                        <InputFieldComponent label="ZIP Code" placeholder="ZIP Code" type="text"
                            v-model="localClaimant.zip_code" classes="mb-3  col-12 col-md-3"  :error="errors['claimants.zip_code'] ?? ''"/>

                            <InputFieldComponent label="Address" placeholder="Address 1" type="text"
                            v-model="localClaimant.address1" classes="col-12" 
                            :error="errors['claimants.address1'] ?? ''"/>

                        <InputFieldComponent placeholder="Address 2" type="text" v-model="localClaimant.address2"
                            classes="col-12 mb-3" :error="errors['claimants.address2'] ?? ''"/>
                        <div class="mb-3 col-12">
                            <label class="form-label">Gender</label>
                            <select v-model="localClaimant.gender" class="form-control form-select">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <span v-if="errors['claimants.gender']" class="text-danger">{{ errors['claimants.gender'] }}</span>
                        </div>
                        <InputFieldComponent label="Employer" placeholder="Employer" type="text"
                            v-model="localClaimant.employer" classes="mb-3 col-12"  :error="errors['claimants.employer'] ?? ''"/>

                        <InputFieldComponent label="Occupation" placeholder="Occupation" type="text"
                            v-model="localClaimant.occupation" classes="mb-3 col-12" :error="errors['claimants.occupation'] ?? ''"/>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label required">Language</label>
                            <select v-model="localClaimant.language" class="form-control form-select" >
                                <option value="english">English</option>
                                <option value="spanish">Spanish</option>
                                <option value="cambodian">Cambodian</option>
                                <option value="other">Other</option>
                            </select>
                            <span v-if="errors['claimants.language']" class="text-danger">{{errors['claimants.language']}}</span>
                        </div>

                        <InputFieldComponent label="Other Language"
                            :disabled="localClaimant.language === 'other' ? false : true" v-model="localClaimant.other_language"
                            type="text" classes="mb-3 col-12 col-md-6" :error="errors['claimants.other_language'] ?? ''"/>
                        
                        <InputFieldComponent label="Claim Number" placeholder="Claim Number" type="text" labelClasses="required" 
                            v-model="localClaimant.claim_number" classes="mb-3 col-12"  :error="errors['claimants.claim_number'] ?? ''"/>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body row mt-4">
                        
                       
                        <InputFieldComponent label="Date of Accident/ Injury" type="date" v-model="localClaimant.accident_date" 
                            classes="mb-3 col-12"   :error="errors['claimants.accident_date'] ?? ''"/>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Currently Working</label>
                                <select v-model="localClaimant.currently_working" class="form-control form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span v-if="errors['claimants.currently_working']" class="text-danger">{{errors['claimants.currently_working']}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Claim Accepted</label>
                                <select v-model="localClaimant.claim_accepted" class="form-control form-select">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span v-if="errors['claimants.claim_accepted']" class="text-danger">{{errors['claimants.claim_accepted']}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label class="form-label required">Injury Description / Nature of Injury</label>
                                <textarea rows="5" class="form-control" v-model="localClaimant.injury_description"
                                    placeholder="Here can be your description"></textarea>

                                <span v-if="errors['claimants.injury_description']" class="text-danger">{{errors['claimants.injury_description']}}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label class="form-label">Background of Injury</label>
                                <textarea rows="5" class="form-control" v-model="localClaimant.injury_background"
                                    placeholder="Here can be your description"></textarea>
                                <span v-if="errors['claimants.injury_background']" class="text-danger">{{errors['claimants.injury_background']}}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Jurisdiction</label>
                                <select v-model="localClaimant.jurisdiction" class="form-control form-select">
                                    <option selected="selected" value=""></option>
                                    <option value="AB">AB</option>
                                    <option value="VI">VI</option>
                                    <option value="AL">AL</option>
                                    <option value="AK">AK</option>
                                    <option value="AZ">AZ</option>
                                    <option value="AR">AR</option>
                                    <option value="CA">CA</option>
                                    <option value="CO">CO</option>
                                    <option value="CT">CT</option>
                                    <option value="DE">DE</option>
                                    <option value="DC">DC</option>
                                    <option value="FL">FL</option>
                                    <option value="GA">GA</option>
                                    <option value="HI">HI</option>
                                    <option value="ID">ID</option>
                                    <option value="IL">IL</option>
                                    <option value="KS">KS</option>
                                    <option value="KY">KY</option>
                                    <option value="LA">LA</option>
                                    <option value="ME">ME</option>
                                    <option value="MD">MD</option>
                                    <option value="MA">MA</option>
                                    <option value="MI">MI</option>
                                    <option value="MN">MN</option>
                                    <option value="MS">MS</option>
                                    <option value="MO">MO</option>
                                    <option value="MT">MT</option>
                                    <option value="NE">NE</option>
                                    <option value="NV">NV</option>
                                    <option value="NH">NH</option>
                                    <option value="NJ">NJ</option>
                                    <option value="NM">NM</option>
                                    <option value="NY">NY</option>
                                    <option value="NC">NC</option>
                                    <option value="ND">ND</option>
                                    <option value="OH">OH</option>
                                    <option value="OK">OK</option>
                                    <option value="OR">OR</option>
                                    <option value="PA">PA</option>
                                    <option value="PR">PR</option>
                                    <option value="RI">RI</option>
                                    <option value="SC">SC</option>
                                    <option value="SD">SD</option>
                                    <option value="TN">TN</option>
                                    <option value="TX">TX</option>
                                    <option value="UT">UT</option>
                                    <option value="VT">VT</option>
                                    <option value="VA">VA</option>
                                    <option value="WA">WA</option>
                                    <option value="WV">WV</option>
                                    <option value="WI">WI</option>
                                    <option value="WY">WY</option>
                                    <option value="BC">BC</option>
                                    <option value="MB">MB</option>
                                    <option value="NB">NB</option>
                                    <option value="NF">NF</option>
                                    <option value="NWT">NWT</option>
                                    <option value="NS">NS</option>
                                    <option value="ON">ON</option>
                                    <option value="PEI">PEI</option>
                                    <option value="PQ">PQ</option>
                                    <option value="SK">SK</option>
                                    <option value="YUK">YUK</option>
                                    <option value="FLS">FLS</option>
                                    <option value="FED">FED</option>

                                </select>
                                <span v-if="errors['claimants.jurisdiction']" class="text-danger">{{errors['claimants.jurisdiction']}}</span>
                            </div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Type of Claim</label>
                            <select v-model="localClaimant.claim_type" class="form-control form-select" @change="claimType($event.target.value)">
                                <option selected="selected" value=""></option>
                               <option v-for="claimType in claimTypes" :key="claimType.id" :value="claimType.id">{{claimType.name}}</option>
                            </select>
                            <span v-if="errors['claimants.claim_type']" class="text-danger">{{errors['claimants.claim_type']}}</span>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label class="form-label required">Type of Service</label>
                            <select v-model="localClaimant.service_type" class="form-control form-select">
                                <option selected="selected" value=""></option>
                                <option v-for="serviceType in serviceTypes" :key="serviceType.id" :value="serviceType.id">
                                {{ serviceType.name }}
                            </option>
                            </select>
                            <span v-if="errors['claimants.service_type']" class="text-danger">{{errors['claimants.service_type']}}</span>
                        </div>

                        <InputFieldComponent label="If Other, please specify"
                            :disabled="localClaimant.service_type == '9' ? false : true"
                            v-model="localClaimant.other_claim_type" type="text" classes="mb-3 col-12" 
                            :error="errors['claimants.other_claim_type'] ?? ''"/>

                        <InputFieldComponent label="Insured/Carrier" v-model="localClaimant.insured_carrier" type="text"
                            classes="mb-3 col-12" :error="errors['claimants.insured_carrier'] ?? ''"/>
                            
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
                            <span v-if="errors['claimants.ama_4th']" class="text-danger">{{errors['claimants.ama_4th']}}</span>
                            <span v-if="errors['claimants.ama_5th']" class="text-danger">{{errors['claimants.ama_5th']}}</span>
                            <span v-if="errors['claimants.ama_6th']" class="text-danger">{{errors['claimants.ama_6th']}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Treating Physician -->
            <div class=" col-12 col-md-6">
                <div class="card">
                    <div class="card-header sub-well d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Treating Physician(s) Information</h3>
                        <button class="btn btn-primary float-start" type="button" @click="addClaimant"
                            :disabled="physicianDetails.length == 10">
                            <i class="fas fa-plus me-2"></i> Add More
                        </button>
                    </div>

                    <div class="card-body row">
                        <div v-for="(localphysician, index) in physicianDetails" :key="index" class="col-12 mb-3">
                            <div class="row">
                                <InputFieldComponent label="First Name" placeholder="Enter First Name" type="text"
                                    v-model="localphysician.first_name" classes="mb-3 col-6" />
                                <InputFieldComponent label="Last Name" placeholder="Enter Last Name" type="text"
                                    v-model="localphysician.last_name" classes="mb-3 col-6" />
                            </div>
                        </div>
                        <span v-if="errors['physicians']" class="text-danger">{{errors['physicians']}}</span>
                    </div>

                </div>
            </div>
            <!--End Treating Physician -->

            <!-- Other Needs -->
            <div class=" col-12 col-md-6">
                <div class="card ">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Check If Other Needs</h3>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-12">

                            <label class="form-check me-3">
                                <input class="form-check-input" type="checkbox" v-model="localClaimant.translation">
                                <span class="form-label">Translation</span>
                            </label>
                            <label class="form-check me-3">
                                <input class="form-check-input" type="checkbox" v-model="localClaimant.transportation">
                                <span class="form-label">Transportation </span>
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
import { useClaimStore } from "@/Stores/ClaimStore"; 
import { error } from 'toastr';


const claimStore = useClaimStore();

const props = defineProps({
    claimants: Object,
    physician: Array,
    errors: Object,
    claimTypes: Array,
    states: Array,
    serviceTypes: Array
});

const emit = defineEmits(['update:claimants']);


const localClaimant = reactive({ ...props.claimants });

function claimType(id) {
    claimStore.setClaimTypeId(id);
    
}

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

</style>
