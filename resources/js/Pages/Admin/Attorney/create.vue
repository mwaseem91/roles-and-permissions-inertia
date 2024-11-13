<script setup>
import { defineProps, reactive, onMounted, ref } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router, Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    attorney: Object,

});

const errors = ref({});

const form = reactive({
    name: props.attorney?.name || null,
    firm_name: props.attorney?.name || null,
    address1: props.attorney?.address1 || null,
    address2: props.attorney?.address2 || null,
    type: props.attorney?.type || 'Defence',
    city: props.attorney?.city || null,
    zip_code: props.attorney?.zip_code || null,
    phone_number: props.attorney?.phone_number || null,
    fax_number: props.attorney?.fax_number || null,
});

function submit(event) {
    event.preventDefault();
    errors.value = {};

    if (props.attorney) {
        router.put(`/attorneys/${props.attorney.id}`, form, {
            onError: (err) => {
                errors.value = err;
            }
        });

    } else {
        router.post('/attorneys', form, {
            onError: (err) => {
                errors.value = err;
            }
        });
    }
}

</script>

<template>
    <MasterLayout>
        <template #content>

            <Head title="Attorney" />
            <div class="m-3 col-lg-11">
                <div class="row row-cards">
                    <!-- Page header -->
                    <div class="page-header d-print-none">
                        <div class="container-xl">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <h2 class="page-title">
                                        {{ props.attorney ? 'Edit Attorney' : 'Create Attorney' }}
                                    </h2>
                                </div>
                                <!-- Page title actions -->
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <Link href="/attorneys" class="btn btn-primary">
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
                                <h3 class="card-title">{{ props.attorney ? 'Edit Attorney' : 'Create Attorney' }}</h3>
                                <div class="row row-cards">
                                    
                                    <!-- Attorney Type Input -->
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Select Type</label>
                                            <select class="form-control form-select" v-model="form.type">
                                                <option value="Defence">Defence </option>
                                                <option value="Claimant">Claimant </option>
                                            </select>
                                            <span v-if="errors.type" class="text-danger">{{ errors.type }}</span>
                                        </div>
                                    </div>
                                    <!-- Attorney Name Input -->
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Attorney name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name" 
                                                v-model="form.name" />
                                            <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
                                        </div>
                                    </div>
                                    <!-- Attorney Name Input -->
                                    <div class="col-sm-6 col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Firm Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name"
                                                v-model="form.firm_name" />
                                            <span v-if="errors.firm_name" class="text-danger">{{ errors.firm_name
                                                }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Attorney Address 1 Input -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address 1</label>
                                            <input type="text" class="form-control" placeholder="Enter Address 1"
                                                v-model="form.address1" />
                                            <span v-if="errors.address1" class="text-danger">{{ errors.address1
                                                }}</span>
                                        </div>
                                    </div>

                                    <!-- Attorney Address 2 Input -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address 2</label>
                                            <input type="text" class="form-control" placeholder="Enter Address 2"
                                                v-model="form.address2" />
                                            <span v-if="errors.address2" class="text-danger">{{ errors.address2
                                                }}</span>
                                        </div>
                                    </div>

                                     <!-- Attorney City Input -->
                                     <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" placeholder="Enter City"
                                                v-model="form.city" />
                                            <span v-if="errors.city" class="text-danger">{{ errors.city }}</span>
                                        </div>
                                    </div>

                                    <!-- Zip Code Input  -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Zip Code</label>
                                            <input type="number" class="form-control" placeholder="Enter Zip Code"
                                                v-model="form.zip_code">
                                            <span v-if="errors.zip_code" class="text-danger">{{ errors.zip_code
                                                }}</span>
                                        </div>
                                    </div>

                                    <!-- Zip Phone Number Input  -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="number" class="form-control" placeholder="### ### ###"
                                                v-model="form.phone_number">
                                            <span v-if="errors.phone_number" class="text-danger">{{ errors.phone_number
                                                }}</span>
                                        </div>
                                    </div>
                                    <!-- Zip Fax Number Input  -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Fax Number</label>
                                            <input type="number" class="form-control" placeholder="### ### ###"
                                                v-model="form.fax_number">
                                            <span v-if="errors.fax_number" class="text-danger">{{ errors.fax_number
                                                }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ props.attorney ? 'Update Attorney' : 'Create Attorney' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </MasterLayout>
</template>
