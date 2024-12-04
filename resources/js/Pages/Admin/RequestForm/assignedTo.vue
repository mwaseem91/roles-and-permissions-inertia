<script setup>
import { defineProps, reactive, onMounted, ref } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router, Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    users: Array,
    referred_id: Number,
    user_id: Number
});

const form = reactive({
    user_id: props.user_id  || '',
    id: props.referred_id,
});

const errors = ref({});

function submit(event) {
    event.preventDefault();
    errors.value = {};

    router.post(route('form-requests.assigned-to'),  form, {
        onError: (err) => {
            errors.value = err;
        }
    });

}
</script>

<template>

    <Head title="Assign User" />
    <MasterLayout>
        <template #content>
            <div class="m-3 col-lg-11">
                <div class="row row-cards">
                    <!-- Page header -->
                    <div class="page-header d-print-none">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <h2 class="page-title">
                                        Assign Request Form
                                    </h2>
                                </div>
                                <!-- Page title actions -->
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <Link href="/admin/modules" class="btn btn-primary">
                                        <!-- Back Arrow SVG Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
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
                                <!-- <h3 class="card-title">Assign Request Form</h3> -->
                                <div class="row row-cards">
                                    <!-- Module Name Input -->
                                    <div class="col-sm-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <select class="form-control form-select" v-model="form.user_id">
                                                <option value="">Select</option>
                                                <option v-for="user in props.users" :key="user.id" :value="user.id">
                                                    {{ user.name }}
                                                </option>
                                            </select>
                                            <span v-if="errors.name" class="invalid-feedback">{{ errors.name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">
                                    Assign
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </MasterLayout>
</template>
