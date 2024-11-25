<template>
        <div class="card mt-3 ">
        <div class="card-header well">
            <h3 class="card-title">Attorney Information
            </h3>
        </div>
    <div class="p-2 row row-cards">
        
        <div class="col-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">Defense Attorney Information</h3>
                </div>
                <div class="card-body row">
                   
                    <InputFieldComponent type="text" label="Attorney Name" placeholder="Enter Name"
                        classes="col-12 mb-3" v-model="localDefenseAttorney.attorney_name" />

                    <InputFieldComponent label="Firm Name" placeholder="Enter Firm Name" type="text"
                        classes="col-12 mb-3" v-model="localDefenseAttorney.firm_name" />
                    
                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"
                        v-model="localDefenseAttorney.address1" />

                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3" 
                        v-model="localDefenseAttorney.address2" />

                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-6" 
                        v-model="localDefenseAttorney.city" />
                    
                    <div class="mb-3 col-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localDefenseAttorney.state">
                            <option selected="selected" value="U"></option>
                            <option v-for="state in states" :key="state.code" :value="state.code">
                                {{ state.code }}
                            </option>
                        </select>
                    </div>
                    
                    <div class="mb-3 col-3">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" name="input-mask" class="form-control" 
                            placeholder="Zip Code" autocomplete="off" v-model="localDefenseAttorney.zip_code">
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####" 
                            autocomplete="off" v-model="localDefenseAttorney.phone">
                    </div>

                    <div class="mb-3 col-6">
                        <label class="form-label">Fax</label>
                        <input type="text" name="input-mask" class="form-control" v-mask="'### ### ####'"
                            placeholder="### ### ####" autocomplete="off" v-model="localDefenseAttorney.fax">
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contact for Input</label>
                        <select class="form-control form-select" >
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6">
            <div class="card">
                <div class="card-header sub-well">
                    <h3 class="card-title">
                        Claimant Attorney Information
                    </h3>
                </div>
                <div class="card-body row">
                   
                    <InputFieldComponent type="text" label="Attorney Name" placeholder="Enter Name"  
                        classes="col-12 mb-3" v-model="localClaimantAttorney.attorney_name" />

                    <InputFieldComponent label="Firm Name" placeholder="Enter Firm Name" type="text"  
                        classes="col-12 mb-3" v-model="localClaimantAttorney.firm_name" />

                    <InputFieldComponent label="Address" placeholder="Address 1" type="text" classes="col-12"  
                        v-model="localClaimantAttorney.address1" />

                    <InputFieldComponent placeholder="Address 2" type="text" classes="col-12 mb-3"   
                        v-model="localClaimantAttorney.address2" />

                    <InputFieldComponent label="City" placeholder="Enter City" type="text" classes="col-6"   
                        v-model="localClaimantAttorney.city" />

                    <div class="mb-3 col-3">
                        <label class="form-label">State</label>
                        <select class="form-control form-select" v-model="localClaimantAttorney.state"  >
                            <option selected="selected" value=""></option>
                            <option v-for="state in states" :key="state.code" :value="state.code">
                                {{ state.code }}
                            </option>
                        </select>
                    </div>

                    <InputFieldComponent label="Zip Code" placeholder="Zip Code" type="text" classes="mb-3 col-3"   
                        v-model="localClaimantAttorney.zip_code" />

                    <div class="mb-3 col-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" v-mask="'### ### ####'" placeholder="### ### ####"  
                            autocomplete="off" v-model="localClaimantAttorney.phone">
                    </div>

                    <div class="mb-3  col-6">
                        <label class="form-label">Fax</label>
                        <input type="text" name="input-mask" class="form-control" v-mask="'### ### ####'"  
                            placeholder="### ### ####" autocomplete="off" v-model="localClaimantAttorney.fax">
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
    errors: Object // Validation errors
  });
  const emit = defineEmits(['update:claimantAttorney']); // Emit updates to parent
  
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

// by default set attorney type
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