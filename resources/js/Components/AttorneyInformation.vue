<template>
        <div class="card mt-3 ">
        <div class="card-header well">
            <h3 class="card-title">Attorney Information
            </h3>
        </div>
    <div class="p-2 row row-cards">
        
        <div class=" col-12 col-md-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">Defense Attorney Information</h3>
                </div>
                <div class="card-body row">
                   
                    <InputFieldComponent type="text" label="Attorney Name" placeholder="Enter Name" classes="col-12 mb-3" 
                        v-model="localDefenseAttorney.attorney_name" :error="errors['defenseAttorney.attorney_name'] ?? ''"/>

                    <InputFieldComponent label="Firm Name" placeholder="Enter Firm Name" type="text" classes="col-12 mb-3" 
                        v-model="localDefenseAttorney.firm_name" :error="errors['defenseAttorney.firm_name'] ?? ''"/>
                    
                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"
                        v-model="localDefenseAttorney.address1" :error="errors['defenseAttorney.address1'] ?? ''"/>

                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3" 
                        v-model="localDefenseAttorney.address2" :error="errors['defenseAttorney.address2'] ?? ''"/>

                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-6" 
                        v-model="localDefenseAttorney.city" :error="errors['defenseAttorney.city'] ?? ''"/>
                    
                    <div class="mb-3 col-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localDefenseAttorney.state">
                            <option selected="selected" value="U"></option>
                            <option v-for="state in states" :key="state.code" :value="state.code">
                                {{ state.code }}
                            </option>
                        </select>
                        <span v-if="errors['defenseAttorney.state']" class="text-danger">{{errors['defenseAttorney.state']}}</span>
                    </div>
                    
                    <div class="mb-3 col-3">
                        <label class="form-label">ZIP Code</label>
                        <input type="number" name="input-mask" class="form-control" placeholder="Zip Code" autocomplete="off" 
                            v-model="localDefenseAttorney.zip_code" >

                        <span v-if="errors['defenseAttorney.zip_code']" class="text-danger">{{errors['defenseAttorney.zip_code']}}</span>
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####"  autocomplete="off"
                             v-model="localDefenseAttorney.phone" >

                        <span v-if="errors['defenseAttorney.phone']" class="text-danger">{{errors['defenseAttorney.phone']}}</span>
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">Fax</label>
                        <input type="text" name="input-mask" class="form-control" v-mask="'### ### ####'"  placeholder="### ### ####"
                             autocomplete="off" v-model="localDefenseAttorney.fax">

                        <span v-if="errors['defenseAttorney.fax']" class="text-danger">{{errors['defenseAttorney.fax']}}</span>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contact for Input</label>
                        <select class="form-control form-select" >
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <span v-if="errors['defenseAttorney.contact_for_input']" class="text-danger">{{errors['defenseAttorney.contact_for_input']}}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class=" col-12 col-md-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">
                        Claimant Attorney Information
                    </h3>
                </div>
                <div class="card-body row">
                   
                    <InputFieldComponent type="text" label="Attorney Name" placeholder="Enter Name"  classes="col-12 mb-3" 
                    v-model="localClaimantAttorney.attorney_name"  :error="errors['claimantAttorney.attorney_name'] ?? ''"/>

                    <InputFieldComponent label="Firm Name" placeholder="Enter Firm Name" type="text" classes="col-12 mb-3" 
                        v-model="localClaimantAttorney.firm_name" :error="errors['claimantAttorney.firm_name'] ?? ''"/>

                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"  
                        v-model="localClaimantAttorney.address1" :error="errors['claimantAttorney.address1'] ?? ''"/>

                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3"   
                        v-model="localClaimantAttorney.address2" :error="errors['claimantAttorney.address2'] ?? ''"/>

                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-6"   
                        v-model="localClaimantAttorney.city" :error="errors['claimantAttorney.city'] ?? ''"/>

                    <div class="mb-3 col-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localClaimantAttorney.state"  >
                            <option selected="selected" value=""></option>
                            <option v-for="state in states" :key="state.code" :value="state.code">
                                {{ state.code }}
                            </option>
                        </select>
                        <span v-if="errors['claimantAttorney.state']" class="text-danger">{{errors['claimantAttorney.state']}}</span>
                    </div>

                    <InputFieldComponent label="Zip Code" placeholder="Zip Code" type="number" classes="mb-3 col-3"   
                        v-model="localClaimantAttorney.zip_code" :error="errors['claimantAttorney.zip_code'] ?? ''"/>

                    <div class="mb-3 col-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####"  
                            autocomplete="off" v-model="localClaimantAttorney.phone">

                        <span v-if="errors['claimantAttorney.phone']" class="text-danger">{{errors['claimantAttorney.phone']}}</span>
                    </div>

                    <div class="mb-3  col-6">
                        <label class="form-label">Fax</label>
                        <input type="text" name="input-mask" class="form-control" v-mask="'### ### ####'"  
                            placeholder="### ### ####" autocomplete="off" v-model="localClaimantAttorney.fax">

                        <span v-if="errors['claimantAttorney.fax']" class="text-danger">{{errors['claimantAttorney.fax']}}</span>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    </div>
</template>


<script setup>
  import { onMounted, reactive, watch } from 'vue';
  import InputFieldComponent from '@/Components/General/InputFieldComponent.vue';
  
  // Define props and emits for parent-child communication
  const props = defineProps({
    claimantAttorney: Object, 
    defenseAttorney: Object,
    states: Array,
    errors: Object 
  });
  const emit = defineEmits(['update:claimantAttorney']); 
  
  // Create a reactive local copy of ClaimantAttorney
  const localClaimantAttorney = reactive({ ...props.claimantAttorney });
  const localDefenseAttorney = reactive({ ...props.defenseAttorney });
  
  // Watch for changes in localClaimantAttorney and emit them to the parent
  watch(localClaimantAttorney, (newVal) => {
    emit('update:claimantAttorney', newVal);
  });

  watch(localDefenseAttorney, (newVal) => {
    emit('update:defenseAttorney', newVal);
  });
  
  // Watch for updates to ClaimantAttorney from the parent and sync with local copy
  watch(() => props.claimantAttorney, (newVal) => {
    Object.assign(localClaimantAttorney, newVal);
  });

  watch(() => props.defenseAttorney, (newVal) => {
    Object.assign(localDefenseAttorney, newVal);
  });


  onMounted(() => {
    localDefenseAttorney.type = 'defense';
    localClaimantAttorney.type = 'claimant';
  });
  </script>


<style scoped>
.sub-well {
    background-color: #7C7C7A !important;
    color: white !important;
}
</style>