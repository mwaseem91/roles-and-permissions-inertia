<script setup>
import { defineProps ,onMounted ,nextTick} from 'vue';
import { Link } from '@inertiajs/vue3'
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import { router } from '@inertiajs/vue3'; 

const props = defineProps({
  roles: Array
});

function editRole(roleId) {
  router.get(route('roles.edit', roleId));
}

function deleteRole(roleId) {
  router.delete(route('roles.edit', roleId));
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
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Module</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    <tr v-for="(role, index) in props.roles" :key="role.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ role.name }}</td>
                                        <td>
                                            <a href="#"  @click.prevent="editRole(role.id)">Edit</a>
                                            <a href="#"  @click.prevent="deleteRole(role.id)">Delete</a>
                                        </td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="page-wrapper">
                            <!-- Page header -->
                            <div class="page-header d-print-none">
                            <div class="container-xl">
                                <div class="row g-2 align-items-center">
                                <div class="col">
                                    <h2 class="page-title">
                                    Datatables
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
                                            <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                            <th><button class="table-sort desc" data-sort="sort-city">City</button></th>
                                            <th><button class="table-sort" data-sort="sort-type">Type</button></th>
                                            <th><button class="table-sort" data-sort="sort-score">Score</button></th>
                                            <th><button class="table-sort" data-sort="sort-date">Date</button></th>
                                            <th><button class="table-sort" data-sort="sort-quantity">Quantity</button></th>
                                            <th><button class="table-sort" data-sort="sort-progress">Progress</button></th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                            <tr>
                                                <td class="sort-name">Wicked Cyclone</td>
                                                <td class="sort-city">Six Flags New England, United States</td>
                                                <td class="sort-type">RMC Hybrid</td>
                                                <td class="sort-score">98,2%</td>
                                                <td class="sort-date" data-date="1568819813">September 18, 2019</td>
                                                <td class="sort-quantity">174</td>
                                                <td class="sort-progress" data-progress="3">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-lg-auto">3%</div>
                                                    <div class="col">
                                                    <div class="progress" style="width: 5rem">
                                                        <div class="progress-bar" style="width: 3%" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100" aria-label="3% Complete">
                                                        <span class="visually-hidden">3% Complete</span>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="sort-name">qqq</td>
                                                <td class="sort-city">Flags New England, United States</td>
                                                <td class="sort-type"> Hybrid</td>
                                                <td class="sort-score">90,2%</td>
                                                <td class="sort-date" data-date="1568819813">September 18, 2019</td>
                                                <td class="sort-quantity">174</td>
                                                <td class="sort-progress" data-progress="3">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-lg-auto">3%</div>
                                                    <div class="col">
                                                    <div class="progress" style="width: 5rem">
                                                        <div class="progress-bar" style="width: 3%" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100" aria-label="3% Complete">
                                                        <span class="visually-hidden">3% Complete</span>
                                                        </div>
                                                    </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </template>
    </MasterLayout>
</template>