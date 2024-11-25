<script setup>
import { ref } from 'vue';
import { Link, router, Head } from '@inertiajs/vue3'
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';
import { usePermissions } from '@/Composables/permissions';

const { hasPermission } = usePermissions();

const props = defineProps({
    referrals: Array
});

const idToDelete = ref(null);
const ConfirmationModal = ref(null);

const showDeleteModal = (id) => {
    idToDelete.value = id;
    ConfirmationModal.value.show();
};

const confirmDelete = () => {
    if (idToDelete.value) {
        router.delete(route('form-requests.destroy', idToDelete.value));
        idToDelete.value = null;
    }
};

const cancelDelete = () => {
    idToDelete.value = null;
};
const changeStatus = (id, status) => {
    router.post(route('form-requests.change-status', { id: id, status: status }));
};

</script>

<template>
    <MasterLayout>
        <template #content>

            <Head title="Form Requests" />
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
                                                Form Requests
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
                                            <div id="table-default">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th><button class="table-sort">Sr #</button></th>
                                                            <th><button class="table-sort"
                                                                    data-sort="sort-name">Company</button></th>
                                                            <th><button class="table-sort desc"
                                                                    data-sort="sort-city">Source</button></th>
                                                            <th><button class="table-sort desc"
                                                                    data-sort="sort-city">Email</button></th>
                                                            <th><button class="table-sort desc"
                                                                    data-sort="sort-city">Phone</button></th>
                                                            <th><button class="table-sort desc"
                                                                    data-sort="sort-city">fax</button></th>
                                                            <th><button class="table-sort desc"
                                                                    data-sort="sort-city">City</button></th>
                                                            <th><button class="table-sort desc"
                                                                    data-sort="sort-city">Status</button></th>
                                                            <th><button class="table-sort"
                                                                    data-sort="sort-score">Action</button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-tbody">
                                                        <tr v-for="(referral, index) in props.referrals"
                                                            :key="referral.id">
                                                            <td class="sort-name">{{ index + 1 }}</td>
                                                            <td class="sort-name">{{ referral?.referring_company }}</td>
                                                            <td class="sort-city">{{ referral.referring_source }}</td>
                                                            <td class="sort-city">{{ referral.email }}</td>
                                                            <td class="sort-city">{{ referral.phone }}</td>
                                                            <td class="sort-city">{{ referral.fax }}</td>
                                                            <td class="sort-city">{{ referral.city }}</td>
                                                            <td class="">
                                                                <span class="dropdown">
                                                                    <button class="btn dropdown-toggle align-text-top " style="width: 120px !important;" 
                                                                        data-bs-boundary="viewport"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false">{{ referral.status }}</button>
                                                                    <div class="dropdown-menu dropdown-menu-end"
                                                                        style="">
                                                                        <a class="dropdown-item" href="#"
                                                                            @click.prevent="changeStatus(referral.id, 'Pending')">
                                                                            Pending
                                                                        </a>
                                                                        <a class="dropdown-item" href="#"
                                                                            @click.prevent="changeStatus(referral.id, 'In Progress')">
                                                                            IN Progress
                                                                        </a>
                                                                        <a class="dropdown-item" href="#"
                                                                            @click.prevent="changeStatus(referral.id, 'Rejected')">
                                                                            Rejected
                                                                        </a>
                                                                        <a class="dropdown-item" href="#"
                                                                            @click.prevent="changeStatus(referral.id, 'Completed')">
                                                                            Completed
                                                                        </a>
                                                                    </div>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <Link :href="route('request-forms.show', referral.id)"
                                                                    class="me-3">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </Link>

                                                                <a href="#"
                                                                    @click.prevent="showDeleteModal(referral.id)">
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
            <DeleteConfirmationModal ref="ConfirmationModal" @confirm="confirmDelete" @cancel="cancelDelete" />
        </template>
    </MasterLayout>
</template>


<style scoped>
.alert-info {
    background-color: #e2e3e5 !important;
    border-color: #e2e3e5 !important;
    color: black !important;
}

.well {
    background-color: #901588 !important;
    color: white !important;
}

.row .col-md-4 p span {
    font-weight: bold;
}

.sub-well {
    background: #dfe6e9 !important;
    border-color: #dfe6e9 !important;
    color: #0d0c0c !important;
    font-weight: bold;
}

width-120{
    width: 100px !important;
}
.pointer {
    cursor: pointer;
}
</style>