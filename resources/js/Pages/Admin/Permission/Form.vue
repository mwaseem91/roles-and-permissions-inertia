<script setup>
import { defineProps, reactive, onMounted ,ref } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router ,Link , Head} from '@inertiajs/vue3'; 

const props = defineProps({
  modules: Array,
  detail: Object,
});

const form = reactive({
  module_id: null,
  name: null,
});

const errors = ref({});


onMounted(() => {
  if (props.detail) {
    form.module_id = props.detail.module_id;
    form.name = props.detail.name;
  }
});

function submit(event) {
  event.preventDefault();

  if (props.detail) {
    router.put(`/permissions/${props.detail.id}`, form, {
            onError: (err) => {
                errors.value = err;
            }
        });
  } else {
    router.post('/permissions', form, {
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
      <Head title="Permission" />
      <div class="m-3 col-lg-11">
        <div class="row row-cards">
          <!-- Page header -->
          <div class="page-header d-print-none">
            <div class="container-xl">
              <div class="row g-2 align-items-center">
                <div class="col">
                  <h2 class="page-title">
                    {{ props.role ? 'Update Permission' : 'Create Permission' }}
                  </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                  <div class="btn-list">
                    <Link href="/permissions" class="btn btn-primary"> 
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
                <h3 class="card-title">{{ props.detail ? 'Update Permission' : 'Create Permission' }}</h3>
                <div class="row row-cards">
                  <!-- Module Selection -->
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Select Module</label>
                      <select class="form-control form-select" v-model="form.module_id" :class="{ 'is-invalid': errors.module_id }">
                        <option value="">Select Module</option>
                        <option v-for="module in props.modules" :key="module.id" :value="module.id">
                          {{ module.name }}
                        </option>
                      </select>
                      
                      <span v-if="errors.name" class="invalid-feedback">{{ errors.module_id }}</span>
                    </div>
                  </div>

                  <!-- Name Input -->
                  <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control" placeholder="Enter Permission Name" v-model="form.name"
                      :class="{ 'is-invalid': errors.name }"  />
                        <span v-if="errors.name" class="invalid-feedback">{{ errors.name }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                  {{ props.detail ? 'Update Permission' : 'Create Permission' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </template>
  </MasterLayout>
</template>
