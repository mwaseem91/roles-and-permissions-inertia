<template>
    <div>
      <h3>Child Component</h3>
      <!-- Display validation error -->
      <p v-if="errors.referringCompany" class="text-danger">{{ errors.referringCompany }}</p>
      
      <!-- Input for Referring Company -->
      <InputFieldComponent
        type="text"
        label="Referring Company"
        placeholder="Enter Name"
        classes="col-12 mb-3"
        v-model="localBillInfo.referringCompany"
        :error="errors.referringCompany"
      />
      
      <!-- Input for Address -->
      <InputFieldComponent
        type="text"
        label="Address"
        placeholder="Enter Address"
        classes="col-12"
        v-model="localBillInfo.address1"
      />
    </div>
  </template>
  
  <script setup>
  import { reactive, watch } from 'vue';
  import InputFieldComponent from '@/Components/General/InputFieldComponent.vue';
  
  // Define props and emits for parent-child communication
  const props = defineProps({
    billInfo: Object, // Parent data
    errors: Object // Validation errors
  });
  const emit = defineEmits(['update:billInfo']); // Emit updates to parent
  
  // Create a reactive local copy of billInfo
  const localBillInfo = reactive({ ...props.billInfo });
  
  // Watch for changes in localBillInfo and emit them to the parent
  watch(localBillInfo, (newVal) => {
    emit('update:billInfo', newVal);
  });
  
  // Watch for updates to billInfo from the parent and sync with local copy
//   watch(() => props.billInfo, (newVal) => {
//     Object.assign(localBillInfo, newVal);
//   });
  </script>
  
  <style>
  .text-danger {
    color: red;
    font-size: 0.9em;
  }
  </style>
  