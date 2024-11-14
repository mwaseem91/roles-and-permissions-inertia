<script setup>
import { defineProps, reactive, onMounted, ref } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router, Link, Head } from '@inertiajs/vue3';

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
        router.put(`/users/${props.user.id}`, data, {
            onError: (err) => {
                errors.value = err;
            },
        });
    } else {
        // Create new user
        router.post('/users', data, {
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

            <div class=" m-3 col-lg-11">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Referrer and Billing Information</h3>
                    </div>
                    <div class="p-2 row row-cards">

                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Referral Party Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label"> Referring Company</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>
                                    <!-- User Name Input -->

                                    <div class="mb-3">
                                        <label class="form-label"> Referring Source</label>
                                        <input type="text" class="form-control" placeholder="Enter Referring Source" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control mb-2" placeholder="Address 1" />
                                        <input type="text" class="form-control" placeholder="Address 2" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" placeholder="Enter City" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="input-mask" class="form-control" data-mask="00000-000"
                                            data-mask-visible="true" placeholder="00000-000" autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">ZIP Code</label>
                                        <input type="text" name="input-mask" class="form-control" data-mask="00000-000"
                                            data-mask-visible="true" placeholder="00000-000" autocomplete="off">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="input-mask" class="form-control"
                                            data-mask="### ### ####" data-mask-visible="true" placeholder="### ### ####"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fax</label>
                                        <input type="text" name="input-mask" class="form-control"
                                            data-mask="### ### ####" data-mask-visible="true" placeholder="### ### ####"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" data-mask="### ### ####"
                                            placeholder="abc@gmail.co," autocomplete="off">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Bill To Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">

                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-label">Check here if same as Referral Party</span>
                                        </label>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"> Referring Company</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>
                                    <!-- User Name Input -->

                                    <div class="mb-3">
                                        <label class="form-label"> Referring Source</label>
                                        <input type="text" class="form-control" placeholder="Enter Referring Source" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control mb-2" placeholder="Address 1" />
                                        <input type="text" class="form-control" placeholder="Address 2" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" placeholder="Enter City" />
                                        <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="input-mask" class="form-control" data-mask="00000-000"
                                            data-mask-visible="true" placeholder="00000-000" autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">ZIP Code</label>
                                        <input type="text" name="input-mask" class="form-control" data-mask="00000-000"
                                            data-mask-visible="true" placeholder="00000-000" autocomplete="off">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="input-mask" class="form-control"
                                            data-mask="### ### ####" data-mask-visible="true" placeholder="### ### ####"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fax</label>
                                        <input type="text" name="input-mask" class="form-control"
                                            data-mask="### ### ####" data-mask-visible="true" placeholder="### ### ####"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" data-mask="### ### ####"
                                            placeholder="abc@gmail.co," autocomplete="off">
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Claimant and Physician Information</h3>
                        </div>
                        <div class="p-2 row row-cards">

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Claimant Details</h3>
                                    </div>
                                    <div class="card-body row">
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Last Name" />
                                            <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                        </div>
                                        <!-- User Name Input -->

                                        <div class="mb-3 col-6">
                                            <label class="form-label"> First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter First Name" />
                                            <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control mb-2" placeholder="Address 1" />
                                            <input type="text" class="form-control" placeholder="Address 2" />
                                            <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                        </div>

                                        <div class="mb-3 col-7">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" placeholder="Enter City" />
                                            <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                        </div>
                                        <div class="mb-3 col-2">
                                            <label class="form-label">State</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="00000-000" data-mask-visible="true" placeholder="00000-000"
                                                autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">ZIP Code</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="00000-000" data-mask-visible="true" placeholder="00000-000"
                                                autocomplete="off">
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label">Home Phone Number</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="### ### ####" data-mask-visible="true"
                                                placeholder="### ### ####" autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Work Phone Number</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="### ### ####" data-mask-visible="true"
                                                placeholder="### ### ####" autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Social Security Number</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="### ### ####" data-mask-visible="true"
                                                placeholder="### ### ####" autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="### ### ####" data-mask-visible="true"
                                                placeholder="### ### ####" autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Gender</label>
                                            <input type="email" class="form-control" data-mask="### ### ####"
                                                placeholder="abc@gmail.co," autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Employer</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="### ### ####" data-mask-visible="true"
                                                placeholder="### ### ####" autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Occupation</label>
                                            <input type="email" class="form-control" data-mask="### ### ####"
                                                placeholder="abc@gmail.co," autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Language</label>
                                            <input type="text" name="input-mask" class="form-control"
                                                data-mask="### ### ####" data-mask-visible="true"
                                                placeholder="### ### ####" autocomplete="off">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Other Language</label>
                                            <input type="email" class="form-control" data-mask="### ### ####"
                                                placeholder="abc@gmail.co," autocomplete="off">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card ">
                                    <!-- <div class="card-header">
                                        <h3 class="card-title">Bill To Information</h3>
                                    </div> -->
                                    <div class="card-body row mt-4">

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Claim Number</label>
                                            <input type="number" class="form-control" placeholder="EnterClaim Number" />
                                            <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                        </div>
                                        <!-- User Name Input -->

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Date of Accident/ Injury</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Referring Source" />
                                            <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Injury Description / Nature of Injury</label>
                                            <input type="text" class="form-control mb-2" placeholder="Address 1" />
                                            <input type="text" class="form-control" placeholder="Address 2" />
                                            <!-- <span v-if="errors.name" class="text-danger">{{ errors.name }}</span> -->
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">Injury Description / Nature of Injury</label>
                                                <textarea rows="5" class="form-control"
                                                    placeholder="Here can be your description" value="Mike">
                                                    Oh so, your weak rhyme  You doubt I'll bother, reading into it
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">Background of Injury</label>
                                                <textarea rows="5" class="form-control"
                                                    placeholder="Here can be your description" value="Mike">
                                                    Oh so, your weak rhyme  You doubt I'll bother, reading into it
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Claim Accepted</label>
                                                <select class="form-control form-select">
                                                    <option value="">Yes</option>
                                                    <option value="">No</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" data-mask="### ### ####"
                                                placeholder="abc@gmail.co," autocomplete="off">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </template>
    </MasterLayout>
</template>