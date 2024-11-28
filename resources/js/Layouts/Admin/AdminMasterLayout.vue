<script setup>
import { computed, watch } from 'vue';
import AdminSideBar from '@/Layouts/Admin/Includes/Sidebar.vue';
import AdminNavBar from '@/Layouts/Admin/Includes/Navbar.vue';
import AdminFooter from '@/Layouts/Admin/Includes/Footer.vue';

import '../../../admin_scripts/css/tabler.min.css';
import '../../../admin_scripts/css/tabler-flags.min.css';
import '../../../admin_scripts/css/tabler-payments.min.css';
import '../../../admin_scripts/css/tabler-vendors.min.css';
import '../../../admin_scripts/css/demo.min.css';

import { usePage } from '@inertiajs/vue3';
import { useToastr } from '@/toaster';
import { Head } from '@inertiajs/vue3';

// Get page and toastr instances
const page = usePage();
const toastr = useToastr();

// Define a computed property for flash messages
const flash = computed(() => page.props.flash);

// Watch for flash message changes
watch(
  () => flash.value,
  (newFlash) => {
    if (newFlash.success) {
      toastr.success(newFlash.success);
    }
    if (newFlash.error) {
      toastr.error(newFlash.error);
    }
    if (newFlash.message) {
      toastr.info(newFlash.message);
    }
  },
  { immediate: true } 
);


defineProps({
  title: String,
});
</script>

<template>
  <Head>
    <title>{{ title || 'Admin' }}</title>
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">
  </Head>

  <div class="page">
    <AdminSideBar />
    <slot name="sidebar" />

    <div class="page-wrapper">
      <AdminNavBar />
      <slot name="nav" />
      <slot name="content" />
      <AdminFooter />
    </div>
  </div>
</template>
<style>

</style>
