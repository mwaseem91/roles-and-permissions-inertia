<template>
    <div class="p-2 row row-cards">

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">Referral Information</h3>
                </div>
                <div class="card-body row">
                    <InputFieldComponent type="text" label="Referring Company Name" placeholder="Enter Company Name"
                        classes="col-12 mb-3 " labelClasses="required" v-model="localReferralInfo.referring_company" 
                        :error="errors['referralInfo.referring_company'] ?? ''" />

                    <InputFieldComponent label="Referring Source Name" placeholder="Enter Referring Source Name" type="text" labelClasses="required" 
                        classes="col-12 mb-3" v-model="localReferralInfo.referring_source" 
                        :error="errors['referralInfo.referring_source'] ?? ''" />

                    <InputFieldComponent label="Email" placeholder="abc@gmail.co" type="email" classes="col-12 mb-3" labelClasses="required" 
                        v-model="localReferralInfo.email" :error="errors['referralInfo.email'] ?? ''" />

                    <div class="mb-3 col-12">
                        <label class="form-label required">Phone Number</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####"
                            autocomplete="off" v-model="localReferralInfo.phone">
                        <span v-if="errors['referralInfo.phone']" class="text-danger">{{ errors['referralInfo.phone'] }}</span>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Fax Number</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'"
                            placeholder="### ### ####" autocomplete="off" v-model="localReferralInfo.fax">
                            <span v-if="errors['referralInfo.fax']" class="text-danger">{{ errors['referralInfo.fax'] }}</span>
                    </div>

                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-12 col-md-6"
                        v-model="localReferralInfo.city"  :error="errors['referralInfo.city'] ?? ''"/>

                    <div class="mb-3 col-12 col-md-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localReferralInfo.state">
                            <option selected="selected" value=""></option>
                            <option v-for="state in states" :key="state.code" :value="state.code">
                                {{ state.code }}
                            </option>
                        </select>
                        <span v-if="errors['referralInfo.state']" class="text-danger">{{ errors['referralInfo.state'] }}</span>
                    </div>

                    <div class="mb-3 col-12 col-md-3">
                        <label class="form-label">ZIP Code</label>
                        <input type="number" class="form-control" maxlength="10"
                            placeholder="Zip Code" autocomplete="off" v-model="localReferralInfo.zip_code" />

                        <span v-if="errors['referralInfo.zip_code']" class="text-danger">{{ errors['referralInfo.zip_code'] }}</span>
                    </div>

                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"
                        v-model="localReferralInfo.address1" 
                        :error="errors['referralInfo.address1'] ?? ''"/>

                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3"
                        v-model="localReferralInfo.address2"  :error="errors['referralInfo.address1'] ?? ''"/>

                    

                    

                   

                    
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">Bill Information</h3>
                </div>
                <div class="card-body row">
                    <div class="mb-3 col-12">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" value="0"
                                v-model="localBillInfo.same_as_referral">
                            <span class="form-label">Check here if same as Referral Party</span>
                        </label>
                    </div>

                    <InputFieldComponent label="Contact Name" placeholder="Enter Contact Name" type="text"
                        :disabled="localBillInfo.same_as_referral" classes="col-12 mb-3" labelClasses="required" 
                        :error="errors['billInfo.referring_source'] ?? ''"
                        v-model="localBillInfo.referring_source" />

                    <InputFieldComponent type="text" label="Company Name" placeholder="Enter Name"
                        :disabled="localBillInfo.same_as_referral" classes="col-12 mb-3" labelClasses="required" 
                        v-model="localBillInfo.referring_company" :error="errors['billInfo.referring_company'] ?? ''"/>

                    <InputFieldComponent label="Email" placeholder="abc@gmail.co" type="email" classes="col-12 mb-3"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.email"  labelClasses="required" 
                        :error="errors['billInfo.email'] ?? ''"/>

                    <div class="mb-3 col-12">
                        <label class="form-label required">Phone Number</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####"
                            :disabled="localBillInfo.same_as_referral" autocomplete="off" v-model="localBillInfo.phone">
                        <span v-if="errors['billInfo.phone']" class="text-danger">{{errors['billInfo.phone']}}</span>
                    </div>

                    <div class="mb-3  col-12">
                        <label class="form-label">Fax Number</label>
                        <input type="text" name="input-mask" class="form-control" v-mask="'### ### ####'"
                            :disabled="localBillInfo.same_as_referral" placeholder="### ### ####" autocomplete="off"
                            v-model="localBillInfo.fax">
                            
                        <span v-if="errors['billInfo.fax']" class="text-danger">{{errors['billInfo.fax']}}</span>
                    </div>

                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-12 col-md-6"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.city" 
                        :error="errors['billInfo.city'] ?? ''"/>

                    <div class="mb-3 col-12 col-md-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localBillInfo.state"
                            :disabled="localBillInfo.same_as_referral">
                            <option selected="selected" value=""></option>
                            <option v-for="state in states" :key="state.code" :value="state.code">
                                {{ state.code }}
                            </option>
                        </select>
                        <span v-if="errors['billInfo.state']" class="text-danger">{{errors['billInfo.state']}}</span>
                    </div>

                    <InputFieldComponent label="Zip Code" placeholder="Zip Code" type="text" classes="mb-3 col-12 col-md-3"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.zip_code" 
                        :error="errors['billInfo.zip_code'] ?? ''"/>


                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.address1" 
                        :error="errors['billInfo.address1'] ?? ''"/>

                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.address2" 
                        :error="errors['billInfo.address2'] ?? ''"/>
                </div>
            </div>
        </div>

    </div>
</template>


<script setup>
import { reactive, watch } from 'vue';
import InputFieldComponent from '@/Components/General/InputFieldComponent.vue';


const props = defineProps({
    billInfo: Object, 
    referralInfo: Object,
    states: Array,
    errors: Object 
});
const emit = defineEmits(['update:billInfo']); 

// Create a reactive local copy of billInfo
const localBillInfo = reactive({ ...props.billInfo });
const localReferralInfo = reactive({ ...props.referralInfo });

// Watch for changes in localBillInfo and emit them to the parent
watch(localBillInfo, (newVal) => {
    emit('update:billInfo', newVal);
});

watch(localReferralInfo, (newVal) => {
    emit('update:referralInfo', newVal);
});

// Watch for updates to billInfo from the parent and sync with local copy
watch(() => props.billInfo, (newVal) => {
    Object.assign(localBillInfo, newVal);
});

watch(() => props.referralInfo, (newVal) => {
    Object.assign(localReferralInfo, newVal);
});
</script>


<style scoped>
/* .well{
    background-color: #901588 !important;
    color: white !important;
}
.sub-well {
    background-color: #7C7C7A !important;
    color: white !important;
} */

</style>