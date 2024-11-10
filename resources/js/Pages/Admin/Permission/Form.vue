<script setup>
import { defineProps, reactive, onMounted } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  modules: Array,
});

const form = reactive({
  module: null,
  type:null,
  name:null,
});

function submit(event) {
    event.preventDefault();

   
        router.post('/permissions', form);
    
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
                <h3 class="card-title">{{ props.role ? 'Update Permisson' : 'Create Permisson' }}</h3>
                <div class="row row-cards">
                  <!-- Role Name Input -->
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Module</label>
                      <select class="form-control form-select"  v-model="form.Module" required >
                        <option value="">Select Module</option>
                        <option v-for="module in props.modules" :key="module.id" :value="module.id">{{ module.name }} </option>
                        
                      </select>
                    </div>
                  </div>
                  <!-- Permission Select Dropdown -->
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Type</label>
                      <select class="form-control form-select"  v-model="form.type" required >
                        <option  value="">Select Type</option>
                        <option  value="Show"> Show  </option>
                        <option  value="Create"> Create  </option>
                        <option  value="Edit"> Edit  </option>
                        <option  value="View"> View  </option>
                        <option  value="Delete"> Delete  </option>
                        <option  value="Other"> Other  </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter Permission Name"
                        v-model="form.name" required 
                      />
                    </div>
                  </div>

                </div>
              </div>

              <!-- Submit Button -->
              <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                  {{ props.modules ? 'Update modules' : 'Create modules' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </template>
  </MasterLayout>
</template>
