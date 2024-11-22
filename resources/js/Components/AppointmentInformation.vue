<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">Appointment Information
            </h3>
        </div>
        <div class="p-2 row row-cards">

            <div class="col-6">
                <div class="card">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Appointment Information
                        </h3>
                    </div>
                    <div class="card-body row">

                        <div class="mb-3 col-12">
                            <label class="form-label">Specialty</label>
                            <select class="form-control form-select" v-model="localappointments.specialty">
                                <option selected="selected" value=""></option>
                                <option value="1">Acupuncture</option>
                                <option value="134">Aerospace Medicine</option>
                                <option value="2">Allergy and Immunology</option>
                                <option value="3">Anesthesiology</option>
                                <option value="5">Chiropractic</option>
                                <option value="143">Clinical Biochemical Genetics</option>
                                <option value="144">Clinical Cytogenics</option>
                                <option value="145">Clinical Genetics MD</option>
                                <option value="146">Clinical Molecular Genetics</option>
                                <option value="95">Clinical Psychologist</option>
                                <option value="142">Colon and Rectal Surgery</option>
                                <option value="6">Dentistry</option>
                                <option value="7">Dermatology</option>
                                <option value="44">Diagnostic Radiology</option>
                                <option value="9">Emergency Medicine</option>
                                <option value="11">Family Medicine</option>
                                <option value="156">Industrial Hygienist</option>
                                <option value="97">Internal Medicine</option>
                                <option value="153">Legal</option>
                                <option value="28">Neurological Surgery</option>
                                <option value="23">Neurology</option>
                                <option value="150">Neurology w Special Qual in Child Neuro</option>
                                <option value="26">Neuropsychology</option>
                                <option value="113">None indicated</option>
                                <option value="56">Nuclear Medicine</option>
                                <option value="55">Nurse Practitioner</option>
                                <option value="29">Obstetrics and Gynecology</option>
                                <option value="20">Occupational Medicine</option>
                                <option value="31">Occupational Therapy</option>
                                <option value="32">Ophthalmology</option>
                                <option value="93">Optometrist</option>
                                <option value="33">Oral and Maxillofacial Surgery</option>
                                <option value="112">Orthodontist</option>
                                <option value="34">Orthopaedic Surgery</option>
                                <option value="10">Otolaryngology ENT</option>
                                <option value="157">Pain Medicine</option>
                                <option value="147">Pathology Anatomic</option>
                                <option value="148">Pathology Clinical</option>
                                <option value="116">Pathology-Anatomic/Pathology-Clinical</option>
                                <option value="130">Pediatrics</option>
                                <option value="36">Periodontics</option>
                                <option value="37">Pharmacology</option>
                                <option value="94">Physical Medicine and Rehabilitation</option>
                                <option value="38">Physical Therapy</option>
                                <option value="123">Physical Therapy Assistant</option>
                                <option value="58">Plastic Surgery</option>
                                <option value="40">Podiatry</option>
                                <option value="106">Preventative Medicine</option>
                                <option value="159">Prosthetist</option>
                                <option value="54">Psychiatry</option>
                                <option value="41">Psychology</option>
                                <option value="149">Public Health &amp; General Preventative Med</option>
                                <option value="152">Pulmonology</option>
                                <option value="133">Radiation Oncology</option>
                                <option value="151">Radiological Physics</option>
                                <option value="117">Registered Nurse</option>
                                <option value="82">Social Worker</option>
                                <option value="47">Speech Language Pathologist</option>
                                <option value="16">Surgery</option>
                                <option value="114">Thoracic Surgery</option>
                                <option value="81">Translation</option>
                                <option value="60">Transportation</option>
                                <option value="154">Urogynecology</option>
                                <option value="51">Urology</option>
                                <option value="53">Vascular Surgery</option>
                                <option value="85">Vocational Counselor</option>
                                <option value="other">Other</option>
                            </select>
                            <span v-if="errors['appointments.specialty']" class="text-danger">{{errors['appointments.specialty']}}</span>
                        </div>

                        <InputFieldComponent type="text" label="If other, please specify" placeholder="Enter Name"
                            classes="col-12 mb-3" v-model="localappointments.other_specialty" required="true"
                            :error="errors['claimants.other_specialty'] ?? ''" />

                        <InputFieldComponent label="Provider" placeholder="Enter Provider" type="text"
                            classes="col-12 mb-3" v-model="localappointments.provider" />

                        <InputFieldComponent label="Location" placeholder="Location " type="text" classes="col-12 mb-3"
                            v-model="localappointments.location" />

                        <InputFieldComponent label="Appointment Date to Take Place By" type="date" classes="col-7 mb-3"
                            v-model="localappointments.appointment_date" />
                        <InputFieldComponent label="Time" type="time" classes="col-5 mb-3"
                            v-model="localappointments.appointment_time" />

                        <InputFieldComponent label="Report Completed By" type="date" classes="col-12 mb-3"
                            v-model="localappointments.report_completed_by" />
                        <div class="col-md-12" v-show="localappointments.report_completed_by != null">
                            <div class="mb-3 mb-0">
                                <label class="form-label">Reason For Report Rush Date</label>
                                <textarea rows="5" class="form-control"  v-model="localappointments.reason_report_rush_date"
                                    placeholder="Here can be your description"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">X-Rays Approved</label>
                            <select class="form-control form-select" v-model="localappointments.x_rays_approved">
                                <option selected="selected" value=""></option>
                                <option  value="1">Yes</option>
                                <option value="0"> No</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <label class="form-label">Special Instructions / Price Restrictions</label>
                                <textarea rows="5" class="form-control"  v-model="localappointments.special_instructions"
                                    placeholder="Here can be your description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Notification of Appointment</h3>
                    </div>
                    <div class="card-body row">

                        <div class="mb-3 col-md-12">
                            <div class="display-flex">
                                <label class="form-check me-3">
                                    <input class="form-check-input" type="checkbox"  
                                        v-model="localappointments.copy_to_claimant_attorney"/>
                                    <span class="form-label"> Copy to Claimant's Attorney</span>
                                </label>
                                <label class="form-check me-3">
                                    <input class="form-check-input" type="checkbox"  v-model="localappointments.copy_to_defense_attorney"/>
                                    <span class="form-label"> Copy to Defense Attorney</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox"  v-model="localappointments.copy_to_referring_party"/>
                                    <span class="form-label"> Copy to Referring Party</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox"  v-model="localappointments.copy_to_billing_party"/>
                                    <span class="form-label"> Copy to Billing Party</span>
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


<style scoped>  
.sub-well {
    background-color: #7C7C7A !important;
    color: white !important;
}
</style>
