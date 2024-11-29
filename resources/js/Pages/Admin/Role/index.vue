<script setup>
import { defineProps ,onMounted ,nextTick ,ref} from 'vue';
import {router, Link,Head } from '@inertiajs/vue3'
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue'; 
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';


const props = defineProps({
  roles: Array
});

function editRole(roleId) {
  router.get(route('roles.edit', roleId));
}


const idToDelete = ref(null);

const ConfirmationModal = ref(null);

const showDeleteModal = (id) => {
  idToDelete.value = id;
  ConfirmationModal.value.show(); 
};

const confirmDelete = () => {
  if (idToDelete.value) {
    router.delete(route('roles.destroy', idToDelete.value));
    idToDelete.value = null; 
  }
};

const cancelDelete = () => {
  idToDelete.value = null; 
};


onMounted(() => {
  nextTick(() => {
    const table = document.getElementById('table-default');

    if (table) {
      const list = new List('table-default', {
        sortClass: 'table-sort',
        listClass: 'table-tbody',
        valueNames: [
          'sort-name', 'sort-type', 'sort-city', 'sort-score',
          { attr: 'data-date', name: 'sort-date' },
          { attr: 'data-progress', name: 'sort-progress' },
          'sort-quantity'
        ]
      });
    } else {
      console.warn("Element with id 'table-default' not found.");
    }
  });
});
</script>



<template>
    <MasterLayout>
        <template #content>
            <Head title="Role" />
            <div class="col-lg-11">
                <div class="row row-cards">
                    <div class="col-12">
                       
                        <div class="page-wrapper">
                                  <!-- Page header -->
                                  <div class="page-header d-print-none">
                                <div class="container-xl">
                                    <div class="row g-2 align-items-center">
                                    <div class="col">
                                        <h2 class="page-title">
                                            Roles
                                        </h2>
                                    </div>
                                    <!-- Page title actions -->
                                    <div v-if="hasPermission('user-create')"  class="col-auto ms-auto d-print-none">
                                        <div class="btn-list">
                                            <Link   :href="route('roles.create')" class="btn btn-primary "> 
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                Create Roles
                                            </Link>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page-body">
                            <div class="container-xl">
                                <div class="card">
                                <div class="card-body">
                                    <div id="table-default" class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                          <th>S No #</th>
                                            <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                            <th><button class="table-sort desc" data-sort="sort-city">Action</button></th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                              <tr v-for="(role, index) in props.roles" :key="role.id"> 
                                                <td class="sort-name">{{ index + 1 }}</td>
                                                <td class="sort-city">{{ role.name }}</td> 
                                                <td >
                                                    <a href="#" v-if="hasPermission('role-edit')" class="me-3"  @click.prevent="editRole(role.id)">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <!-- <a href="#"  @click.prevent="deleteRole(role.id)" >
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a> -->
                                                    <a href="#" v-if="hasPermission('role-delete')"  @click.prevent="showDeleteModal(role.id)">
                                                     <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <DeleteConfirmationModal
                ref="ConfirmationModal"
                @confirm="confirmDelete"
                @cancel="cancelDelete"
                />
        </template>
    </MasterLayout>
</template>