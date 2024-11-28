<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    pagination: Object
})
</script>

<template>
    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">Showing <span>{{ pagination.from }}</span> to <span>{{ pagination.to }}</span> of
            <span>{{ pagination.total }}</span> entries</p>
        <ul class="pagination m-0 ms-auto">

            <li class="page-item" :class="{ 'active': link.active }" v-for="link in pagination.links" :key="link.label">

                <Link class="page-link" :href="link.url ?? ''" v-html="link.label">
                </Link>
            </li>
        </ul>
    </div>
</template>