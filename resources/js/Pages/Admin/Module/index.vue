<script setup>
    import { defineProps ,onMounted ,ref ,nextTick} from 'vue'; 
    import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
    import { router ,Link, Head } from '@inertiajs/vue3';  
    import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';

    const props = defineProps({
    modules: Array
    });


    function editModule(id) {
    router.get(route('modules.edit', id));
    }

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
                                            Module
                                        </h2>
                                    </div>
                                    <!-- Page title actions -->
                                    <div class="col-auto ms-auto d-print-none">
                                        <div class="btn-list">
                                            <Link :href="route('modules.create')" class="btn btn-primary "> 
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                                Create Module
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
                                            <th><button class="table-sort" data-sort="sort-name">Name</button></th> 
                                            <th><button class="table-sort" data-sort="sort-progress">Action</button></th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-tbody">
                                            <tr v-for="(module, index) in props.modules" :key="module.id">
                                                <td >{{ index + 1 }}</td>
                                                <td class="sort-name">{{ module.name }}</td> 
                                                <td>
                                                    <a href="#" class="me-3" @click.prevent="editModule(module.id)">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <!-- <a href="#"  @click.prevent="deleteModule(module.id)" >
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a> -->
                                                    <a href="#" @click.prevent="showDeleteModal(module.id)">
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
                ref="deleteModal"
                @confirm="confirmDelete"
                @cancel="cancelDelete"
                />
        </template>
    </MasterLayout>
</template>