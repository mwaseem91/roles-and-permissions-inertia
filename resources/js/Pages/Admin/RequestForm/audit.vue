<script setup>
    import { defineProps ,computed ,ref ,nextTick} from 'vue'; 
    import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
    import { router ,Link, Head } from '@inertiajs/vue3';  
    import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';

    const props = defineProps({
        auditlogs: Array
    });


    const moduleIdToDelete = ref(null);

    const deleteModal = ref(null);

    const showDeleteModal = (id) => {
        moduleIdToDelete.value = id;
        deleteModal.value.show(); 
    };

    const confirmDelete = () => {
    if (moduleIdToDelete.value) {
        router.delete(route('modules.destroy', moduleIdToDelete.value));
        moduleIdToDelete.value = null; 
    }
    };

    const cancelDelete = () => {
        moduleIdToDelete.value = null; 
    };

 
    const getBadgeClass = computed(() => {
      return (action) => {
        if (action === 'updated') {
          return 'badge bg-green';
        } else if (action === 'created') {
          return 'badge bg-blue';
        } else if (action === 'deleted') {
          return 'badge bg-red';
        }
        return ''; 
      };
    });


</script>

<template>
    <Head title="Module" />
    <MasterLayout>
        <template #content>
            <div class=" col-lg-11">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="page-wrapper">
                            <!-- Page header -->
                            <div class="page-header d-print-none">
                                <div class="container-xl">
                                    <div class="row g-2 align-items-center">
                                        <div class="col">
                                            <h2 class="page-title">
                                                Audit Requests Form
                                            </h2>
                                        </div>
                                        <!-- Page title actions -->
                                        <div class="col-auto ms-auto d-print-none">
                                            <div class="btn-list">
                                                
                                                <!-- <Link :href="route('request-forms.create')" class="btn btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 -2h12l1 2" />
                                                        <path d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2v-12h-12v12" />
                                                    </svg>
                                                    Turncate 
                                                </Link> -->
                                                <Link :href="route('request-forms.index')" class="btn btn-primary"> 
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
                                            <th><button class="table-sort" data-sort="">User</button></th>
                                            <th><button class="table-sort" data-sort="sort-name">action</button></th> 
                                            <th><button class="table-sort" data-sort="sort-name">info</button></th> 
                                        </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                            <tr v-for="(item ,index) in props.auditlogs.data" :key="item.id">
                                                <td >{{ index + 1 }}</td>
                                                <td class="sort-name">{{ item?.user?.name }}</td> 
                                                <td class="sort-name"><span :class="getBadgeClass(item.action)">{{ item.action }}</span> </td> 
                                                <td class="sort-name">{{ item?.user?.name }} {{ item.action }} the {{ item?.name }} referral.</td> 
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
                ref="deleteModal"
                @confirm="confirmDelete"
                @cancel="cancelDelete"
                />
        </template>
    </MasterLayout>
</template>