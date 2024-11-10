<script setup>
import { defineProps, reactive, onMounted } from 'vue';
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  permissions: Array,
  role: Object, 
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

function submit(event) {
  event.preventDefault();

  if (props.role) {
    router.put(`/roles/${props.role.id}`, form);
  } else {
    router.post('/roles', form);
  }
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
                <h3 class="card-title">{{ props.role ? 'Update Role' : 'Create Role' }}</h3>
                <div class="row row-cards">
                  <!-- Role Name Input -->
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Role Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Role name"
                        v-model="form.name"
                      />
                    </div>
                  </div>
                  <!-- Permission Select Dropdown -->
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Select Permissions</label>
                      
                      <div class="d-flex flex-wrap">
                        <div v-for="permission in props.permissions" :key="permission.id" class="form-check me-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            :value="permission.id"
                            v-model="form.permissions"  
                            :id="permission.id"
                          />
                          <label class="form-check-label" :for="permission.id">
                            {{ permission.name }}
                          </label>
                        </div>
                      </div>
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
