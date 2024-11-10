<script setup>
import { ref } from 'vue';
import AdminSideBar from '@/Layouts/Admin/Includes/Sidebar.vue';
import AdminNavBar from '@/Layouts/Admin/Includes/Navbar.vue';
import AdminFooter from '@/Layouts/Admin/Includes/Footer.vue';

// Admin Css
import '../../../admin_scripts/css/tabler.min.css';
import '../../../admin_scripts/css/tabler-flags.min.css';
import '../../../admin_scripts/css/tabler-payments.min.css';
import '../../../admin_scripts/css/tabler-vendors.min.css';
import '../../../admin_scripts/css/demo.min.css';
// Admin Css
defineProps({
  title: String,
});
</script>

<template>

  <Head>
    <title> admint</title>
    <!-- Google Fonts -->
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

    </div>
   
  </div>
</template>
