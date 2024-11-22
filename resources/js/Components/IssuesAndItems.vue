<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">Issues and Items to Address</h3>
        </div>
        <div class="p-2 row row-cards">
            <!-- Additional Information -->
            <div class="col-6">
                <div class="card">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Issues to Be Addressed</h3>
                    </div>
                    <div class="alert alert-warning m-1 text-center" style="line-height:2">
                        <i class="fa fa-exclamation-triangle fa-2x pull-left me-2" aria-hidden="true"></i>
                        <strong>Jurisdiction</strong> and <strong>ClaimType</strong> must be selected in order to view
                        Issues
                    </div>

                    <div class="card-body row">
                        <div class="mb-3 col-md-12">

                            <label class="form-check me-3" v-if="claimTypeId == 1 || claimTypeId == 2  || claimTypeId == 7">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.injuryCausalRelationship">
                                <span class="form-label">Causal relationship between injury and current
                                    complaints?</span>
                            </label>

                            <label class="form-check me-3" v-if="claimTypeId == 2 || claimTypeId == 7">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.explainCauseOfComplaints">
                                <span class="form-label">Please explain how the accident would have caused the patient's
                                    complaints.</span>
                            </label>

                            <label class="form-check me-3" v-if="claimTypeId == 2">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.activityRestrictions">
                                <span class="form-label">Does the claimant have any activity restrictions?</span>
                            </label>

                            <label class="form-check me-3" v-if="claimTypeId == 1  || claimTypeId == 2  || claimTypeId == 7 || claimTypeId == 8">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.isCurrentTreatmentNecessary">
                                <span class="form-label">Is current treatment reasonable and necessary?</span>
                            </label>

                            <label class="form-check me-3" v-if="claimTypeId == 1 || claimTypeId == 2 || claimTypeId == 7 || claimTypeId == 8">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.furtherTreatmentNeeded">
                                <span class="form-label">Is further treatment needed? If so, what kind, for what length,
                                    and at what frequency?</span>
                            </label>
                            <label class="form-check me-3" v-if="claimTypeId == 6 || claimTypeId == 8">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.isCausalRelationshipExplained">
                                <span class="form-label">Causal relationship between injury and current complaints? Please explain how the accident would have caused the patients' complaints</span>
                            </label>

                            <!-- General Liability -->
                            <label class="form-check me-3" v-if="claimTypeId == 1 || claimTypeId == 6 || claimTypeId == 8">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.sustainedPermanentInjury">
                                <span class="form-label">Did the claimant sustain any permanent injury as a result of
                                    this accident? If not, please indicate this in your report.</span>
                            </label>
                            <!-- Work Compensation -->
                            <label class="form-check me-3" v-if="claimTypeId == 7">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.returnToWorkNoRestrictions">
                                <span class="form-label">Can claimant return to work at this time with no
                                    restrictions?</span>
                            </label>

                            <label class="form-check me-3"  v-if=" claimTypeId == 7">
                                <input class="form-check-input" type="checkbox"
                                    v-model="localIssue.physicalCapabilities">
                                <span class="form-label">What are claimant's physical capabilities?</span>
                            </label>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Cover Letter Provided By</label>
                            <select class="form-control form-select" v-model="localIssue.cover_letter">
                                <option selected="selected" value=""></option>
                                <option value="Adjuster">Adjuster</option>
                                <option value="Attorney">Attorney</option>
                                <option value="No Cover Letter">No Cover Letter</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <!--End Additional Information -->

            <!-- Additional Information -->
            <div class="col-6">
                <div class="card ">
                    <div class="card-header sub-well">
                        <h3 class="card-title">Additional Information</h3>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="mb-3 mb-0">
                                <textarea rows="7" class="form-control" v-model="localIssue.additional_information"
                                    placeholder="Here can be your description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Other Needs -->
        </div>
    </div>
</template>

<script setup>
import { useClaimStore } from "@/Stores/ClaimStore";
import { reactive, computed, watch} from 'vue';
const claimStore = useClaimStore();

const claimTypeId = computed({
  get: () => claimStore.claimTypeId, 
  set: (newValue) => {
    claimStore.claimTypeId = newValue; 
  },
});

const props = defineProps({
    issue: Object, 
    errors: Object 
});
const emit = defineEmits(['update:issue']); 


const localIssue = reactive({ ...props.issue });

// Watch for changes in localIssue and emit them to the parent
watch(localIssue, (newVal) => {
    emit('update:issue', newVal);
});

// Watch for updates to issue from the parent and sync with local copy
watch(() => props.issue, (newVal) => {
    Object.assign(localIssue, newVal);
});


</script>

<style>
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-warning {
    color: #8a6d3b;
    background-color: #fcf8e3;
    border-color: #faebcc;
}

.well {
    background-color: #901588 !important;
    color: white !important;
}

.sub-well {
    background-color: #7C7C7A !important;
    color: white !important;
}
</style>