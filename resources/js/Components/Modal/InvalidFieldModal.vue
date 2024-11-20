<template>
  <div class="modal  fade" :class="{ show: isVisible }" style="display: block" v-if="isVisible" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="modal-title"> WARNING: There are missing/malformed values! Please correct the fields listed below and try again.</div>
             
            <div>
              <ul>
            <li v-for="(field, index) in props.invalidFields" :key="index">
              {{ field }}
            </li>
          </ul>
            </div>
          </div>
          <div class="modal-footer"> 
            <button type="button" class="btn btn-info"  @click="closeModal">Ok</button> 
          </div>
        </div>
      </div>
    </div>
</template>


<script setup>

  import { ref, defineEmits, defineExpose } from 'vue';
import { object } from 'yup';

  const isVisible = ref(false);
  const emits = defineEmits(['confirm', 'cancel']);

 const props = defineProps({
    invalidFields: object
  })

  const show = () => {
    isVisible.value = true;
  };

  const closeModal = () => {
    isVisible.value = false;
  };

  defineExpose({ show, closeModal });

</script>
