<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">Appointment Information
            </h3>
        </div>
        <div class="p-2 row row-cards">

            <div class=" col-12 col-md-6">
                <div class="card">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Appointment Information
                        </h3>
                    </div>
                    <div class="card-body row">

                        <div class="mb-3 col-12">
                            <label class="form-label required">Specialty</label>
                            <select class="form-control form-select" v-model="localappointments.specialty">
                                <option selected="selected" value=""></option>
                                <option v-for="specialty in specialties" :key="specialty.id" :value="specialty.id">{{specialty.name}}</option>
                                <option value="other">Other</option>
                            </select>
                            <span v-if="errors['appointments.specialty']" class="text-danger">{{errors['appointments.specialty']}}</span>
                        </div>

                        <InputFieldComponent type="text" label="If other, please specify" placeholder="Enter Name"
                            classes="col-12 mb-3" v-model="localappointments.other_specialty" required="true"
                            :error="errors['appointments.other_specialty'] ?? ''"  labelClasses="required" />
                        
                            <InputFieldComponent label="Appointment Date to Take Place By" type="date" classes="col-6 mb-3"
                            v-model="localappointments.appointment_date" :error="errors['appointments.appointment_date'] ?? ''" />

                        <InputFieldComponent label="Time" type="time" classes="col-6 mb-3"
                            v-model="localappointments.appointment_time" :error="errors['appointments.appointment_time'] ?? ''" />

                        <InputFieldComponent label="Report Completed By" type="date" classes="col-6 mb-3"
                            v-model="localappointments.report_completed_by" :error="errors['appointments.report_completed_by'] ?? ''"/>

                        <div class="mb-3 col-6">
                            <label class="form-label">X-Rays Approved</label>
                            <select class="form-control form-select" v-model="localappointments.x_rays_approved">
                                <option selected="selected" value=""></option>
                                <option  value="1">Yes</option>
                                <option value="0"> No</option>
                            </select>
                            <span v-if="errors['appointments.x_rays_approved']" class="text-danger">{{errors['appointments.x_rays_approved']}}</span>
                        </div>
                        
                        <div class="col-md-12" v-show="localappointments.report_completed_by != null">
                            <div class="mb-3 mb-0">
                                <label class="form-label">Reason For Report Rush Date</label>
                                <textarea rows="5" class="form-control"  v-model="localappointments.reason_report_rush_date"
                                    placeholder="Here can be your description"></textarea>
                                <span v-if="errors['appointments.reason_report_rush_date']" class="text-danger">{{errors['appointments.reason_report_rush_date']}}</span>
                            </div>
                        </div>

                        <InputFieldComponent label="Provider" placeholder="Enter Provider" type="text"
                            classes="col-12 mb-3" v-model="localappointments.provider"
                            :error="errors['appointments.provider'] ?? ''"  />

                        <InputFieldComponent label="Location" placeholder="Location " type="text" classes="col-12 mb-3"
                            v-model="localappointments.location" :error="errors['appointments.location'] ?? ''"  />

                        
                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label class="form-label">Special Instructions / Price Restrictions</label>
                                <textarea rows="5" class="form-control"  v-model="localappointments.special_instructions"
                                    placeholder="Here can be your description">
                                </textarea>
                                <span v-if="errors['appointments.special_instructions']" class="text-danger">{{errors['appointments.special_instructions']}}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class=" col-12 col-md-6">
                <div class="card">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Notification of Appointment</h3>
                    </div>
                    <div class="card-body row">
                        <div class="mb-3 col-md-12">
                            <div class="display-flex">

                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox"  v-model="localappointments.copy_to_referring_party"/>
                                    <span class="form-label"> Copy to Referring Party</span>
                                </label>

                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox"  v-model="localappointments.copy_to_billing_party"/>
                                    <span class="form-label"> Copy to Billing Party</span>
                                </label>

                                <label class="form-check me-3">
                                    <input class="form-check-input" type="checkbox"  v-model="localappointments.copy_to_defense_attorney"/>
                                    <span class="form-label"> Copy to Defense Attorney</span>
                                </label>
                                
                                <label class="form-check me-3">
                                    <input class="form-check-input" type="checkbox"  
                                        v-model="localappointments.copy_to_claimant_attorney"/>
                                    <span class="form-label"> Copy to Claimant's Attorney</span>
                                </label>
                               
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox"  v-model="localappointments.do_not_send_notifications"/>
                                    <span class="form-label"> Do Not Send Notifications</span>
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>


<script setup>
import { reactive, watch } from 'vue';
import InputFieldComponent from '@/Components/General/InputFieldComponent.vue';

// Define props and emits for parent-child communication
const props = defineProps({
    appointments: Object, 
    specialties: Array,
    errors: Object 
});
const emit = defineEmits(['update:appointments']); // Emit updates to parent

// Create a reactive local copy of appointments
const localappointments = reactive({ ...props.appointments });

// Watch for changes in localappointments and emit them to the parent
watch(localappointments, (newVal) => {
    emit('update:appointments', newVal);
});


// Watch for updates to appointments from the parent and sync with local copy
watch(() => props.appointments, (newVal) => {
    Object.assign(localappointments, newVal);
});

</script>



