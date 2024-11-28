<template>
  <div class="modal  fade" :class="{ show: isVisible }" style="display: block" v-if="isVisible"  >
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="pb-1"> <strong> WARNING: </strong>
            There are missing/malformed values! Please correct the fields listed below and try again.
          </div>

          <div>
            <ul>
              <li class="errorFields list-unstyled" v-for="(field, index) in props.invalidFields" :key="index">
                {{ field }}
              </li>
            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" @click="closeModal">Ok</button>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>

import { ref, defineEmits, defineExpose } from 'vue';

const isVisible = ref(false);
const emits = defineEmits(['confirm', 'cancel']);

const props = defineProps({
  invalidFields: Array
})

const show = () => {
  isVisible.value = true;
};


const closeModal = () => {
    isVisible.value = false;

  };

defineExpose({ show, closeModal });

</script>


<style scoped>
.errorFields {
  color: red;
  font-weight: bold;
}

.list-unstyled {
  list-style: none;
  padding-bottom: 5px;
}

ul {
  padding: 0px;
  padding-bottom: 0px;
}

.modal-sm {
  --tblr-modal-width: 300px;
}
</style>