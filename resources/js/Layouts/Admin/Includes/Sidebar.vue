<script setup>
  import { Link , usePage } from '@inertiajs/vue3';  
  const { url } = usePage();

</script>


<template>
  <!--begin::Aside-->
  <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
        aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="navbar-brand navbar-brand-autodark">
        <a href=".">
          <img src="static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
      </h1>
      <div class="navbar-nav flex-row d-lg-none">
        <div class="nav-item d-none d-lg-flex me-3">
          <div class="btn-list">
            <a href="https://github.com/tabler/tabler" class="btn" target="_blank" rel="noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                  d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
              </svg>
              Source code
            </a>
            <a href="https://github.com/sponsors/codecalm" class="btn" target="_blank" rel="noreferrer">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
              </svg>
              Sponsor
            </a>
          </div>
        </div>
        <div class="d-none d-lg-flex">
          <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
            data-bs-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
            </svg>
          </a>
          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
            data-bs-toggle="tooltip" data-bs-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
              <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
            </svg>
          </a>
          <div class="nav-item dropdown d-none d-md-flex me-3">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
              </svg>
              <span class="badge bg-red"></span>
            </a>

          </div>
        </div>

      </div>
      <div class="collapse navbar-collapse" id="sidebar-menu">
        <ul class="navbar-nav pt-lg-3">
          <li class="nav-item">
            <Link class="nav-link" href="admin/dashboard">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                  <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                  <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
              </span>
              <span class="nav-link-title">
                Home 
              </span>
            </Link>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false"
              role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                  <path d="M12 12l8 -4.5" />
                  <path d="M12 12l0 9" />
                  <path d="M12 12l-8 -4.5" />
                  <path d="M16 5.25l-8 4.5" />
                </svg>
              </span>
              <span class="nav-link-title">
                Module
              </span>
            </a>
            <div class="dropdown-menu" :class="{ show: url.startsWith('/modules') }">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <Link class="dropdown-item active" href="/modules">
                  Modules
                  </Link>
                  <Link class="dropdown-item" href="/modules/create">
                  Create
                  </Link>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false"
              role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                  <path d="M12 12l8 -4.5" />
                  <path d="M12 12l0 9" />
                  <path d="M12 12l-8 -4.5" />
                  <path d="M16 5.25l-8 4.5" />
                </svg>
              </span>
              <span class="nav-link-title">
                Permissions
              </span>
            </a>
            <div class="dropdown-menu" :class="{ show: url.startsWith('/permissions') }">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <Link class="dropdown-item" href="/permissions">
                    Permissions
                  </Link>
                  <Link class="dropdown-item" href="/permissions/create">
                    Create
                  </Link>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false"
              role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                  <path d="M12 12l8 -4.5" />
                  <path d="M12 12l0 9" />
                  <path d="M12 12l-8 -4.5" />
                  <path d="M16 5.25l-8 4.5" />
                </svg>
              </span>
              <span class="nav-link-title">
                Roles
              </span>
            </a>
            <div class="dropdown-menu" :class="{ show: url.startsWith('/roles') }">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <Link class="dropdown-item" href="/roles">
                  Roles
                  </Link>
                  <Link class="dropdown-item" href="/roles/create">
                  Create
                  </Link>
                </div>
              </div>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false"
              role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                  <path d="M12 12l8 -4.5" />
                  <path d="M12 12l0 9" />
                  <path d="M12 12l-8 -4.5" />
                  <path d="M16 5.25l-8 4.5" />
                </svg>
              </span>
              <span class="nav-link-title">
                User Management
              </span>
            </a>
            <div class="dropdown-menu" :class="{ show: url.startsWith('/users') }">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <Link class="dropdown-item" href="/users">
                  Users
                  </Link>
                  <Link class="dropdown-item" href="/users/create">
                  Create
                  </Link>
                </div>
              </div>
            </div>
          </li>
        
        </ul>
      </div>
    </div>
  </aside>
  <!--end::Aside-->
</template>