<script setup>
import { defineProps, reactive, ref, onMounted } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router ,Link , Head} from '@inertiajs/vue3'; 

const props = defineProps({
  permissions: Array,
  role: Object,
  modules: Array
});

const form = reactive({
  name: null,
  permissions: [],
});


onMounted(() => {
  if (props.role) {
    form.name = props.role.name;
    form.permissions = props.role.permissions.map(permission => permission.id);
  }
});
const errors = ref({});

function submit(event) {
  event.preventDefault();

  if (props.role) {
    router.put(`/roles/${props.role.id}`, form, {
            onError: (err) => {
                errors.value = err;
            }
        });
  } else {
    router.post('/roles', form, {
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
      <Head title="Role" />
      <div class="m-3 col-lg-11">
        <div class="row row-cards">
          <!-- Page header -->
          <div class="page-header d-print-none">
            <div class="container-xl">
              <div class="row g-2 align-items-center">
                <div class="col">
                  <h2 class="page-title">
                    {{ props.role ? 'Update Role' : 'Create Role' }}
                  </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                  <div class="btn-list">
                    <Link href="/roles" class="btn btn-primary">
                        <!-- Back Arrow SVG Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M19 12H5" />
                            <path d="M12 19l-7-7 7-7"/>
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
                <h3 class="card-title">{{ props.role ? 'Update Role' : 'Create Role' }}</h3>
                <div class="row row-cards">
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <label class="form-label">Role Name</label>
                      <input type="text" class="form-control" placeholder="Role name" v-model="form.name" />
                      <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
                    </div>
                  </div>
                  <!-- Permission Select Dropdown -->
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <h3 class="card-title"><b> Select Permissions </b></h3>
                      <span v-if="errors.permissions" class="text-danger">{{ errors.permissions }}</span>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> <b>Module</b></th>
                            <th><b>Permissions</b></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="module in props.modules" :key="module.id">
                            <td>
                              {{ module.name }}
                            </td>
                            <td>
                              <div class="d-flex flex-wrap">
                                <div v-for="permission in module.permission" :key="permission.id"
                                  class="form-check me-2">
                                  <input class="form-check-input" type="checkbox" :value="permission.id"
                                    v-model="form.permissions" :id="permission.id" />
                                  <label class="form-check-label" :for="permission.id">
                                    {{ permission.name }}
                                  </label>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                  {{ props.role ? 'Update Role' : 'Create Role' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </template>
  </MasterLayout>
</template>
