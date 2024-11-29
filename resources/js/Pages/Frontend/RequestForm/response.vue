<script setup>
import { Link} from '@inertiajs/vue3'
import MasterLayout from '@/Layouts/Frontend/MasterLayout.vue'; 
</script>
<template>
    <MasterLayout>
        <template #content>
        <div class="page page-center">
            <div class="container-tight py-4">
            <div class="empty">
                <div class="empty-header">Thank You</div>
                
                <p class="empty-subtitle">
                    Your refferral has been submitted to Quantum Core.<br>
                    It will be verified and initialized as a active case shortly.
                </p>
                <div class="empty-action">
                <Link :href="route('request-forms.create')" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l14 0"></path><path d="M5 12l6 6"></path><path d="M5 12l6 -6"></path></svg>
                    Take me home
                </Link>
                </div>
            </div>
            </div>
        </div>
        </template>
    </MasterLayout>
</template>

<style>
.empty {
    border-radius: 10px;
    border: 1px solid #ccc;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    background-color: white;
    padding: 30px;
    text-align: center;
}

</style>