<script setup>
  import { ref } from 'vue';
  import { router } from '@inertiajs/vue3';

  import '../../../../admin_scripts/css/tabler.min.css';
  import '../../../../admin_scripts/css/demo.min.css';



  const email = ref('');
  const errors = ref({});
  const message = ref('');

  const submitForgotPassword = () => {
    errors.value = {};
    router.post('/submit-forgot-password', { email: email.value }, {
      onSuccess: () => {
        message.value = 'If the email is registered, you will receive password reset instructions shortly.';
      },
      onError: (err) => {
        errors.value = err;
      },
  });
};
</script>


<!-- Inside your LoginForm.vue -->
<template>
    <div class="d-flex flex-column">
      <div class="page page-center">
        <div class="container container-tight py-4">
          <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
              <img src="quantum.png" height="36" alt="">
            </a>
          </div>
          <div class="card card-md">
            <div class="card-body">
              <h2 class="h2 text-center mb-1">Forgot Password ?</h2>
              <h3 class="text-center mb-4 text-muted"> Enter your email to reset your password.</h3>
             
              <form @submit.prevent="submitForgotPassword" autocomplete="off" novalidate>
                <!-- Email input -->
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input type="email" class="form-control" placeholder="your@email.com" autocomplete="off"
                    id="email"  v-model="email" :class="{ 'is-invalid': errors.email }">
                  <span v-if="errors.email" class="invalid-feedback">{{ errors.email }}</span>
                </div>
              
                <div class="form-footer">
                  <button type="submit" class="btn btn-primary w-100 mb-5">Submit</button>
                </div>
              </form>
              <div v-if="message" class="mt-4 text-center text-success">{{ message }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  




<style scoped>

html,
body {
    height: 100%;
    margin: 0;
}


.is-invalid {
    border-color: red;
}

.invalid-feedback {
    color: red;
    font-size: 0.875em;
}
</style>


<!-- ForgotPassword.vue

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const email = ref('');
const errors = ref({});
const message = ref('');

const submitForgotPassword = () => {
  errors.value = {};
  router.post('/forgot-password', { email: email.value }, {
    onSuccess: () => {
      message.value = 'If the email is registered, you will receive password reset instructions shortly.';
    },
    onError: (err) => {
      errors.value = err;
    },
  });
};
</script>

<template>
  <div class="d-flex flex-column align-items-center justify-content-center">
    <div class="card card-md">
      <div class="card-body">
        <h2 class="h2 text-center mb-4">Forgot Password</h2>
        <form @submit.prevent="submitForgotPassword" autocomplete="off" novalidate>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input
              type="email"
              class="form-control"
              placeholder="your@email.com"
              v-model="email"
              :class="{ 'is-invalid': errors.email }"
            />
            <span v-if="errors.email" class="invalid-feedback">{{ errors.email }}</span>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
          </div>
        </form>
        <div v-if="message" class="mt-4 text-center text-success">{{ message }}</div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.invalid-feedback {
  color: red;
  font-size: 0.875em;
}
</style> -->
<style scoped>
.invalid-feedback {
  color: red;
  font-size: 0.875em;
}
</style>