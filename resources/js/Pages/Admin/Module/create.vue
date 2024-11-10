<script setup>
import { defineProps, reactive, onMounted, ref } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router } from '@inertiajs/vue3'; 

const props = defineProps({
    roles: Array,
    user: Object, 
});

const form = reactive({
    name: props.user?.name || '',
    email: props.user?.email || '',
    password: '',  
    role: props.user?.role || '', 
});

const role = ref(form.role); 

onMounted(() => {
    role.value = form.role;
});

function submit(event) {
    event.preventDefault();

    const data = { ...form, role: role.value }; 

    if (props.user) {
        router.put(`/users/${props.user.id}`, data);
    } else {
        router.post('/users', data);
    }
}
</script>

<template>
    <MasterLayout>
        <template #content>
            <div class="m-3 col-lg-11">
                <div class="row row-cards">
                    <div class="col-12">
                        <form @submit="submit" class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ props.user ? 'Edit User' : 'Create User' }}</h3>
                                <div class="row row-cards">
                                    <!-- User Name Input -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name"
                                                v-model="form.name" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email.."
                                                v-model="form.email" required />
                                        </div>
                                    </div>
                                    <!-- Role Selection -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select class="form-control form-select" v-model="role" required>
                                                <option value="">Select Role</option>
                                                <option v-for="role in props.roles" :key="role.id" :value="role.id">
                                                    {{ role.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Password Input (only for new user or when updating password) -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Password"
                                                v-model="form.password" :required="!props.user" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ props.user ? 'Update User' : 'Create User' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </MasterLayout>
</template>
