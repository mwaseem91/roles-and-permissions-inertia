<script setup>
import { defineProps ,onMounted ,nextTick ,ref} from 'vue';
import { Link ,router , Head} from '@inertiajs/vue3'  
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';

const props = defineProps({
  permissions: Array
});

function editPermission(id) {
  router.get(route('permissions.edit', id));
}

const idToDelete = ref(null);

const ConfirmationModal = ref(null);

const showDeleteModal = (id) => {
  idToDelete.value = id;
  ConfirmationModal.value.show(); 
};

const confirmDelete = () => {
  if (idToDelete.value) {
    router.delete(route('permissions.destroy', idToDelete.value));
    idToDelete.value = null; 
  }
};

const cancelDelete = () => {
  idToDelete.value = null; 
};

</script>



<template>
    <MasterLayout>
        <template #content>
            <Head title="Permission" />
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
                                          Permissions
                                        </h2>
                                    </div>
                                    <!-- Page title actions -->
                                    <div class="col-auto ms-auto d-print-none">
                                        <div class="btn-list">
                                            <Link  :href="route('permissions.create')" class="btn btn-primary "> 
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                Create Permission
                                            </Link>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Page body -->
                            <div class="page-body">
                            <div class="container-xl">
                                <div class="card">
                                <div class="card-body">
                                    <div id="table-default" class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th><button class="table-sort">Sr #</button></th>
                                            <th><button class="table-sort" data-sort="sort-name">Module</button></th>
                                            <th><button class="table-sort desc" data-sort="sort-city">Name</button></th> 
                                            <th><button class="table-sort" data-sort="sort-score">Action</button></th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                            <tr  v-for="(permission, index) in props.permissions" :key="permission.id">
                                                <td class="sort-name">{{ index + 1 }}</td>
                                                <td class="sort-name">{{ permission?.module_name }}</td>
                                                <td class="sort-city">{{ permission.name }}</td> 
                                                <td >
                                                    <a href="#" class="me-3" @click.prevent="editPermission(permission.id)">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    
                                                    <a href="#" @click.prevent="showDeleteModal(permission.id)">
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