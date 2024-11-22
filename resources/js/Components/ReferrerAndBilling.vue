<template>
    <div class="p-2 row row-cards">

        <div class=" col-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">Referral Party Information</h3>
                </div>
                <div class="card-body row">
                    <InputFieldComponent type="text" label="Referring Company" placeholder="Enter Name"
                        classes="col-12 mb-3" v-model="localReferralInfo.referring_company" :error="errors['referralInfo.referring_company'] ?? ''" />

                    <InputFieldComponent label="Referring Source" placeholder="Enter Referring Source" type="text"
                        classes="col-12 mb-3" v-model="localReferralInfo.referring_source" 
                        :error="errors['referralInfo.referring_source'] ?? ''" />

                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"
                        v-model="localReferralInfo.address1" />
                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3"
                        v-model="localReferralInfo.address2" />
                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-6"
                        v-model="localReferralInfo.city" />

                    <div class="mb-3 col-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localReferralInfo.state">
                            <option selected="selected" value="U"></option>
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
                            <option value="IN">IN</option>
                            <option value="IA">IA</option>
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
                            <option value="AB">AB</option>
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
                            <option value="VI">VI</option>
                            <option value="FED">FED</option>
                            <option value="AE">AE</option>
                        </select>
                    </div>

                    <div class="mb-3 col-3">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" name="input-mask" class="form-control"
                            placeholder="Zip Code" autocomplete="off" v-model="localReferralInfo.zip_code">
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####"
                            autocomplete="off" v-model="localReferralInfo.phone">
                        <span v-if="errors['referralInfo.phone']" class="text-danger">{{ errors['referralInfo.phone'] }}</span>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Fax</label>
                        <input type="text" name="input-mask" class="form-control" v-mask="'### ### ####'"
                            placeholder="### ### ####" autocomplete="off" v-model="localReferralInfo.fax">
                    </div>

                    <InputFieldComponent label="Email" placeholder="abc@gmail.co" type="email" classes="col-12 mb-3"
                        v-model="localReferralInfo.email" :error="errors['referralInfo.email'] ?? ''" />
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">Bill To Information</h3>
                </div>
                <div class="card-body row">
                    <div class="mb-3 col-12">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" value="0"
                                v-model="localBillInfo.same_as_referral">
                            <span class="form-label">Check here if same as Referral Party</span>
                        </label>
                    </div>

                    <InputFieldComponent type="text" label="Referring Company" placeholder="Enter Name"
                        :disabled="localBillInfo.same_as_referral" classes="col-12 mb-3"
                        v-model="localBillInfo.referring_company" :error="errors['billInfo.referring_company'] ?? ''"/>

                    <InputFieldComponent label="Referring Source" placeholder="Enter Referring Source" type="text"
                        :disabled="localBillInfo.same_as_referral" classes="col-12 mb-3"
                        :error="errors['billInfo.referring_source'] ?? ''"
                        v-model="localBillInfo.referring_source" />

                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.address1" />
                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.address2" />
                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-6"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.city" />

                    <div class="mb-3 col-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localBillInfo.state"
                            :disabled="localBillInfo.same_as_referral">
                            <option selected="selected" value="U"></option>
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
                            <option value="IN">IN</option>
                            <option value="IA">IA</option>
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
                            <option value="AB">AB</option>
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
                            <option value="VI">VI</option>
                            <option value="FED">FED</option>
                            <option value="AE">AE</option>
                        </select>
                    </div>

                    <InputFieldComponent label="Zip Code" placeholder="Zip Code" type="text" classes="mb-3 col-3"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.zip_code" />

                    <div class="mb-3 col-12">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####"
                            :disabled="localBillInfo.same_as_referral" autocomplete="off" v-model="localBillInfo.phone">
                        <span v-if="errors['billInfo.phone']" class="text-danger">{{errors['billInfo.phone']}}</span>
                    </div>

                    <div class="mb-3  col-12">
                        <label class="form-label">Fax</label>
                        <input type="text" name="input-mask" class="form-control" v-mask="'### ### ####'"
                            :disabled="localBillInfo.same_as_referral" placeholder="### ### ####" autocomplete="off"
                            v-model="localBillInfo.fax">
                    </div>

                    <InputFieldComponent label="Email" placeholder="abc@gmail.co" type="email" classes="col-12 mb-3"
                        :disabled="localBillInfo.same_as_referral" v-model="localBillInfo.email" 
                        :error="errors['billInfo.email'] ?? ''"/>
                </div>
            </div>
        </div>

    </div>
</template>


<script setup>
import { reactive, watch } from 'vue';
import InputFieldComponent from '@/Components/General/InputFieldComponent.vue';
import { error } from 'toastr';

// Define props and emits for parent-child communication
const props = defineProps({
    billInfo: Object, // Parent data
    referralInfo: Object,
    errors: Object // Validation errors
});
const emit = defineEmits(['update:billInfo']); // Emit updates to parent

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
.well{
    background-color: #901588 !important;
    color: white !important;
}
.sub-well {
    background-color: #7C7C7A !important;
    color: white !important;
}

</style>