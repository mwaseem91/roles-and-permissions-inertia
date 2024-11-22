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
                        <strong>Jurisdiction</strong> and <strong>ClaimType</strong> must be selected in order to view Issues
                    </div>
                    <div class="card-body row">
                        <div class="mb-3">
                            <label class="form-label">Cover Letter Provided By</label>
                            <select  class="form-control form-select" v-model="localIssue.cover_letter">
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
  import { reactive, watch } from 'vue';
  
  // Define props and emits for parent-child communication
  const props = defineProps({
    issue: Object, // Parent data
    errors: Object // Validation errors
  });
  const emit = defineEmits(['update:issue']); // Emit updates to parent
  
  // Create a reactive local copy of issue
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
.well{
    background-color: #901588 !important;
    color: white !important;
}
.sub-well {
    background-color: #7C7C7A !important;
    color: white !important;
}
</style>