<script setup>
    import { Link, router } from '@inertiajs/vue3';
   

    const logout = () => {
          router.post('/admin/logout', {}, {
          onSuccess: () => {
            console.log('Logged out successfully!');
          },
          onError: (error) => {
            console.error('Logout failed:', error);
          }
        });
    };
</script>

<template>
  <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <Link :href="route('admin.dashboard')">
              Dashboard
            </Link>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            
          
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                <span class="avatar avatar-sm" style="background-image: url()"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{ $page.props.auth?.user?.name}}</div>
                  <!-- <div class="mt-1 small text-muted">UI Designer</div> -->
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"> 
                <button @click="logout"  class="dropdown-item">Logout</button>
              </div>
            </div>
          </div>
        </div>
      </header>
</template>