<template>
  <div class="modal modal-blur fade" :class="{ show: isVisible }" style="display: block" v-if="isVisible" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
              d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
            <path d="M12 9v4" />
            <path d="M12 17h.01" />
          </svg>
          <h3>Are you sure?</h3>
          <div class="text-muted">Do you really want to delete this item? This action cannot be undone.</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button class="btn w-100" @click="closeModal">Cancel</button>
              </div>
              <div class="col">
                <button class="btn btn-danger w-100" @click="confirmDelete">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

  import { ref, defineEmits, defineExpose } from 'vue';

  const isVisible = ref(false);
  const emits = defineEmits(['confirm', 'cancel']);

  const show = () => {
    isVisible.value = true;
  };

  const closeModal = () => {
    isVisible.value = false;
    emits('cancel');
  };

  const confirmDelete = () => {
    emits('confirm');
    isVisible.value = false;
  };

  defineExpose({ show, closeModal });

</script>
