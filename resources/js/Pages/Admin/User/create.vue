<script setup>
import { defineProps, reactive, onMounted, ref } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router, Link ,Head } from '@inertiajs/vue3';
import { usePermissions } from '@/Composables/permissions';
const { hasPermission } = usePermissions();

const props = defineProps({
    roles: Array,
    user: Object,
});

const form = reactive({
    name: props.user?.name || '',
    email: props.user?.email || '',
    password: '',
    role: props.user?.roles[0].id || '',
});

const errors = ref({});

function submit(event) {
    event.preventDefault();

    const data = { ...form };

    if (props.user) {
        // Update existing user
        router.put(`/admin/users/${props.user.id}`, data, {
            onError: (err) => {
                errors.value = err;
            },
        });
    } else {
        // Create new user
        router.post('/admin/users', data, {
            onError: (err) => {
                errors.value = err;
            },
        });
    }
}
</script>

<template>
    <MasterLayout>
        <template #content>
            <Head title="User" />
            <div class="m-3 col-lg-11">
                <div class="row row-cards">
                    <!-- Page header -->
                    <div class="page-header d-print-none">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <h2 class="page-title">
                                        {{ props.user ? 'Update User' : 'Create User' }}
                                    </h2>
                                </div>
                                <!-- Page title actions -->
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <Link href="/admin/users" class="btn btn-primary">
                                            <!-- Back Arrow SVG Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M19 12H5" />
                                                <path d="M12 19l-7-7 7-7" />
                                            </svg>
                                            Back
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                                v-model="form.name" />
                                            <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
                                        </div>
                                    </div>

                                    <!-- Email Input -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email"
                                                v-model="form.email" />
                                            <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                                        </div>
                                    </div>

                                    <!-- Role Selection -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select class="form-control form-select" v-model="form.role">
                                                <option value="">Select Role</option>
                                                <option v-for="role in props.roles" :key="role.id" :value="role.id">
                                                    {{ role.name }}
                                                </option>
                                            </select>
                                            <span v-if="errors.role" class="text-danger">{{ errors.role }}</span>
                                        </div>
                                    </div>

                                    <!-- Password Input (only for new user or when updating password) -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Password"
                                                v-model="form.password" :required="!props.user" />
                                            <span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="card-footer text-end" v-if="!props.user && hasPermission('user-create')">
                                <button type="submit" class="btn btn-primary">
                                   Create User
                                </button>
                            </div>
                            <div class="card-footer text-end"  v-if="props.user && hasPermission('user-update')" >
                                <button type="submit" class="btn btn-primary">
                                   Update User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </MasterLayout>
</template>
