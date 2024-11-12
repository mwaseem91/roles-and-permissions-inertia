<script setup>
import { ref } from 'vue';
import { router ,Head} from '@inertiajs/vue3';

import '../../../../admin_scripts/css/tabler.min.css';
import '../../../../admin_scripts/css/demo.min.css';

const form = ref({
    email: '',
    password: '',
    remember: false, 
});

const errors = ref({});

const submitForm = () => {
    errors.value = {};
    router.post('/login', form.value, {
        onError: (err) => {
            errors.value = err;
        },
    });
};
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
                        <form @submit.prevent="submitForm" autocomplete="off" novalidate>
                            <!-- Email input -->
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" placeholder="your@email.com" autocomplete="off"
                                    id="email" v-model="form.email" :class="{ 'is-invalid': errors.email }">
                                <span v-if="errors.email" class="invalid-feedback">{{ errors.email }}</span>
                            </div>
                            <!-- Password input -->
                            <div class="mb-2">
                                <label class="form-label">
                                    Password
                                    <span class="form-label-description">
                                        <a href="#" @click.prevent="router.get('/forgot-password')">I forgot password</a>
                                    </span>
                                </label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control" placeholder="Your password" id="password" v-model="form.password"
                                        :class="{ 'is-invalid': errors.password }" autocomplete="off">
                                    <span v-if="errors.password" class="invalid-feedback">{{ errors.password }}</span>
                                </div>
                            </div>
                            <!-- Remember me checkbox -->
                            <div class="mb-2">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" v-model="form.remember" />
                                    <span class="form-check-label">Remember me on this device</span>
                                </label>
                            </div>
                            <div class="form-footer mb-4">
                                <button type="submit" class="btn btn-primary w-100">Sign in</button>
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
