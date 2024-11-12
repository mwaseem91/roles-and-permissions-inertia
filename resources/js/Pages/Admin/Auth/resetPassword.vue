<template>
    <!-- <div>
        <h1>Reset Your Password</h1>
        <form @submit.prevent="submit">
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" v-model="email" required />
                <span v-if="errors.email">{{ errors.email }}</span>
            </div>
            <div>
                <label for="password">New Password</label>
                <input type="password" id="password" v-model="password" required />
                <span v-if="errors.password">{{ errors.password }}</span>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" v-model="password_confirmation" required />
                <span v-if="errors.password_confirmation">{{ errors.password_confirmation }}</span>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div> -->
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
              <h2 class="h2 text-center mb-3">Reset Your Password</h2>
             
              <form @submit.prevent="submitForgotPassword" autocomplete="off" novalidate>
                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input type="password" id="password" v-model="password"  class="form-control" placeholder="***********" autocomplete="off"
                     :class="{ 'is-invalid': errors.email }">
                    <span v-if="errors.password">{{ errors.password }}</span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" id="password_confirmation" v-model="password"  class="form-control" placeholder="***********" autocomplete="off"
                     :class="{ 'is-invalid': errors.email }">
                    <span v-if="errors.password_confirmation">{{ errors.password_confirmation }}</span>
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

<script>
   import '../../../../admin_scripts/css/tabler.min.css';
   import '../../../../admin_scripts/css/demo.min.css';
    export default {
        props: {
            token: String,
            email: String,
        },
        
        data() {
            return {
                email: this.email,
                token: this.token,
                password: '',
                password_confirmation: '',
                errors: {},
            };
        },
        methods: {
            async submit() {
                try {
                    await this.$inertia.post(route('password.update'), {
                        email: this.email,
                        token: this.token,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                    });
                } catch (error) {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                }
            },
        },
    };

</script>

