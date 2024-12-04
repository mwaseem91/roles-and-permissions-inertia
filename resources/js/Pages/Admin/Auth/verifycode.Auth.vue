<template>
    <div>
        <form @submit.prevent="verify2FA" autocomplete="off" novalidate>
            <h2>Verify Two-Factor Authentication</h2>
            <input v-model="code" placeholder="Enter code" />
            <button @click="verify2FA">Verify</button>
            <p v-if="message">{{ message }}</p>
        </form>
    </div>
   
  </template>
  
  <script setup>
 import { ref } from 'vue';
  import { router } from '@inertiajs/vue3';
  import '../../../../admin_scripts/css/tabler.min.css';
  import '../../../../admin_scripts/css/demo.min.css';
  
  const code = ref('');
  const message = ref('');
  

  function verify2FA() {
    router.post('/verify-2fa', { code: this.code });
  }


  </script>
  