<script setup>
import { defineProps ,onMounted ,nextTick} from 'vue'; 
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router } from '@inertiajs/vue3'; 


const props = defineProps({
  users: Array
});

function editRole(id) {
  router.get(route('users.edit', id));
}

function deleteRole(id) {
  router.delete(route('users.edit', id));
}

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
            <div class="m-3 col-lg-11">
                <div class="row row-cards">
                    <div class="col-12">
                        <!-- <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th> Email </th>
                                        <th>Role</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    <tr v-for="(user, index) in props.users" :key="user.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>
                                            <span v-for="(role, roleIndex) in user.roles" :key="role.id">
                                                {{ role.name }}
                                                <span v-if="roleIndex < user.roles.length - 1">, </span>
                                            </span>
                                        </td>
                                        <td class="text-secondary">{{ user.title }}</td> 
                                        <td><a href="#">Edit</a></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div> -->
                        
                        <div class="page-wrapper">
                            <!-- Page header -->
                            <div class="page-header d-print-none">
                            <div class="container-xl">
                                <div class="row g-2 align-items-center">
                                <div class="col">
                                    <h2 class="page-title">
                                    Users
                                    </h2>
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
                                            <th><button class="table-sort" data-sort="">Sr</button></th>
                                            <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                            <th><button class="table-sort desc" data-sort="sort-city">Email</button></th>
                                            <th><button class="table-sort" data-sort="sort-type">Role</button></th>
                                            
                                            <th><button class="table-sort" data-sort="sort-progress">Action</button></th>
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
                                                    <a href="#"  @click.prevent="editRole(user.id)">Edit</a>
                                                    <a href="#"  @click.prevent="deleteRole(user.id)">Delete</a>
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

        </template>
    </MasterLayout>
</template>