<template>
    <div class="center-wrapper">
        <div class="login-container">
            <h1>Admin Login</h1><br>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" v-model="form.email" :class="{ 'is-invalid': errors.email }"
                        class="form-control" />
                    <span v-if="errors.email" class="invalid-feedback">{{ errors.email }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" v-model="form.password"
                        :class="{ 'is-invalid': errors.password }" class="form-control" />
                    <span v-if="errors.password" class="invalid-feedback">{{ errors.password }}</span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>


<script>
import { router } from '@inertiajs/vue3'

export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            errors: {},
        };
    },
    methods: {
        submitForm() {
            this.errors = {};
            router.post("/login", this.form, {
                onError: (errors) => {
                    this.errors = errors;
                },
            });
        },
    },
};
</script>

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