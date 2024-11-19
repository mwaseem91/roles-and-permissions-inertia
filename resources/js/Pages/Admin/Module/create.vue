<script setup>
import { defineProps, reactive, onMounted ,ref} from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router ,Link , Head } from '@inertiajs/vue3'; 

const props = defineProps({
    module: Object,
});

const form = reactive({
    name: props.module?.name || '',
});

const errors = ref({});

function submit(event) {
    event.preventDefault();
    errors.value = {};

    if (props.module) {
        router.put(`/modules/${props.module.id}`, form, {
            onError: (err) => {
                errors.value = err;
            }
        });
        
    } else {
        router.post('/modules', form, {
            onError: (err) => {
                errors.value = err;
            }
        });
    }
}
</script>

<template>
    <Head title="Module" />
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
                                        {{ props.module ? 'Update Module' : 'Create Module' }}
                                    </h2>
                                </div>
                                <!-- Page title actions -->
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <Link href="/modules" class="btn btn-primary">
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
                                <h3 class="card-title">{{ props.module ? 'Edit Module' : 'Create Module' }}</h3>
                                <div class="row row-cards">
                                    <!-- Module Name Input -->
                                    <div class="col-sm-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name"
                                                v-model="form.name"  :class="{ 'is-invalid': errors.name }" />
                                                <span v-if="errors.name" class="invalid-feedback">{{ errors.name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ props.module ? 'Update Module' : 'Create Module' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </MasterLayout>
</template>

