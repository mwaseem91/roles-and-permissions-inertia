<script setup>
import { defineProps ,onMounted ,nextTick ,ref} from 'vue'; 
import { router , Head ,Link} from '@inertiajs/vue3'; 

import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';

const props = defineProps({
  users: Array
});

const idToDelete = ref(null);
const ConfirmationModal = ref(null);

function editRole(id) {
  router.get(route('users.edit', id));
}

const showDeleteModal = (id) => {
  idToDelete.value = id;
  ConfirmationModal.value.show(); 
};

const confirmDelete = () => {
  if (idToDelete.value) {
    router.delete(route('users.destroy', idToDelete.value));
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
            <Head title="User" />
            <div class="col-lg-11">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="page-wrapper">
                            <!-- Page body -->
                            <div class="page-header d-print-none">
                                <div class="container-xl">
                                    <div class="row g-2 align-items-center">
                                    <div class="col">
                                        <h2 class="page-title">
                                          Users
                                        </h2>
                                    </div>
                                    <!-- Page title actions -->
                                    <div v-if="hasPermission('user-create')" class="col-auto ms-auto d-print-none">
                                        <div class="btn-list">
                                            <Link  :href="route('users.create')" class="btn btn-primary "> 
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                Create User
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
                                            <th><button class="table-sort" data-sort="">Sr</button></th>
                                            <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                            <th><button class="table-sort desc" data-sort="sort-city">Email</button></th>
                                            <th><button class="table-sort" data-sort="sort-type">Role</button></th>
                                            
                                            <th><button class="table-sort" >Action</button></th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                            <tr v-for="(user, index) in props.users" :key="user.id">
                                                <td >{{ index + 1 }}</td>
                                                <td class="sort-name">{{ user.name }}</td>
                                               
                                                <td class="sort-date" data-date="1568819813">{{ user.email }}</td>
                                                <td class="sort-quantity">
                                                    <span v-for="(role, roleIndex) in user.roles" :key="role.id">
                                                        {{ role.name }}
                                                        <span v-if="roleIndex < user.roles.length - 1">, </span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" v-if="hasPermission('user-edit')" class="me-3" @click.prevent="editRole(user.id)">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#"  v-if="hasPermission('user-delete')"  @click.prevent="showDeleteModal(user.id)" >
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