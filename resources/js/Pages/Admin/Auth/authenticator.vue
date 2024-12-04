<script setup>
import { ref } from 'vue';
import { router ,Head} from '@inertiajs/vue3';

import '../../../../admin_scripts/css/tabler.min.css';
import '../../../../admin_scripts/css/demo.min.css';

const emailCode = ref('');
const twoFactorCode = ref('');

const errors = ref({});

const fetch2faSecret = async () => {
    const { data } = await axios.get('/2fa/generate-secret');
    qrCode.value = data.qr_url; 
};


function submit() {
    errors.value = {};
    router.post('/2fa/verify-email', { code: emailCode.value }, {
        onSuccess: () => {
            message.value = 'If the email is registered, you will receive password reset instructions shortly.';
        },
        onError: (err) => {
            errors.value = err;
        },
    });
}

</script>

<template>
    <Head title="Admin Login" />
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
                        <h2 class="h2 text-center mb-4">Login to Quantum Core</h2>
                        <form  @submit.prevent="submit" >
                            <!-- @submit.prevent="verifyEmail2fa -->
                            <div class="mb-3">
                                <label class="form-label" for="2fa-code">Enter Google Authenticator Code</label>
                                <input type="text" class="form-control" autocomplete="off"
                                    id="2fa-code" v-model="twoFactorCode" :class="{ 'is-invalid': errors.email }">
                                <span v-if="errors.email" class="invalid-feedback">{{ errors.email }}</span>

                            </div>
                            <!-- Password input -->
                            <div class="mb-2">
                                <label class="form-label"  for="email-code">
                                    Enter Email Code
                                </label>
                                <div class="input-group input-group-flat">
                                    <input  type="text" id="email-code" class="form-control" v-model="emailCode"
                                        :class="{ 'is-invalid': errors.emailCode }" autocomplete="off">
                                    <span v-if="errors.emailCode" class="invalid-feedback">{{ errors.emailCode }}</span>
                                </div>
                            </div>
                            
                            <div class="form-footer mb-4">
                                <button type="submit" class="btn btn-primary w-100">Verify</button>
                            </div>
                        </form>
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

.center-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8f9fa;
}

.login-container {
    max-width: 600px;
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    background-color: white;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.is-invalid {
    border-color: red;
}

.invalid-feedback {
    color: red;
    font-size: 0.875em;
}
</style>
