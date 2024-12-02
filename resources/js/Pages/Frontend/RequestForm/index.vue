<script setup>
import { ref } from 'vue';
import { Link, router, Head } from '@inertiajs/vue3'
import MasterLayout from '@/Layouts/Admin/AdminMasterLayout.vue';
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';
import Pagination from '@/Components/General/Pagination.vue';
import { usePermissions } from '@/Composables/permissions';
import moment from 'moment';
const { hasPermission } = usePermissions();

const props = defineProps({
    referrals: Object
});

const idToDelete = ref(null);
const ConfirmationModal = ref(null);
const turnTime = ref('');

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

const turnaroundTime = (createdAt, updatedAt) => { 
    const duration = moment.duration(moment(updatedAt).diff(moment(createdAt)));

    // Extract the years, months, days, hours, and minutes from the duration
    const years = duration.years();
    const months = duration.months();
    const days = duration.days();
    const hours = duration.hours();
    const minutes = duration.minutes();

    let timeString = '';

    if (years > 0) timeString += `${years} years `;
    if (months > 0) timeString += `${months} months `;
    if (days > 0) timeString += `${days} days `;
    if (hours > 0) timeString += `${hours} hours `;
    if (minutes > 0) timeString += `${minutes} minutes`;

    return timeString.trim() || 'Just now';
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
                                        <!-- Page title actions -->
                                        <div class="col-auto ms-auto d-print-none">
                                            <div class="btn-list">
                                                <Link :href="route('request-form.audit')" class="btn btn-primary "> 
                                                    <i class="fa fa-eye me-2" aria-hidden="true"></i>
                                                    View Audits
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
                                            <div id="table-default">
                                                <div class="table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
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
                                                                    data-sort="sort-city">turnaround Time</button></th>
                                                            <th><button class="table-sort desc"
                                                                    data-sort="sort-city">Status</button></th>
                                                            <th><button class="table-sort"
                                                                    data-sort="sort-score">Action</button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-tbody">
                                                        <tr v-for="(referral, index) in props.referrals.data"
                                                            :key="referral.id">
                                                            <td class="sort-name">{{ index + 1 }}</td>
                                                            <td class="sort-name">{{ referral?.referring_company }}</td>
                                                            <td class="sort-city">{{ referral.referring_source }}</td>
                                                            <td class="sort-city">{{ referral.email }}</td>
                                                            <td class="sort-city">{{ referral.phone }}</td>
                                                            <td class="sort-city">{{ referral.fax }}</td>
                                                            <td class="sort-city">{{ referral.status === 'Completed' ? turnaroundTime(referral.created_at, referral.updated_at) : '  -- ' }}</td>
                                                            
                                                            <td class="">
                                                                <span class="dropdown">
                                                                    <button class="btn dropdown-toggle align-text-top " style="width: 120px !important;" 
                                                                        data-bs-boundary="viewport"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false">{{ referral.status }}</button>
                                                                    <div v-if="hasPermission('request-form-edit')"  class="dropdown-menu dropdown-menu-end" 
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
                                                                <Link v-if="hasPermission('request-form-show')" :href="route('request-forms.show', referral.id)"
                                                                    class="me-3">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </Link>

                                                                <a v-if="hasPermission('request-form-delete')" href="#" 
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
                                        <Pagination :pagination="referrals" />
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


.table-wrapper {
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
}

.table {
    width: 100%;
    min-width: 1200px;  
}

th, td {
    white-space: nowrap; 
}

</style>