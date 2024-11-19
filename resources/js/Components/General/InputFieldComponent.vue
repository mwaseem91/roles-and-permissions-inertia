<template>
    <div
        :class = "classes"
    >
        <label
            :for="label"
            class="form-label"
            :class="labelClasses"
        >{{ label }}</label>
        <input
            class="form-control"
            :name="label"
            :value="modelValue"
            :disabled = "disabled"
            :placeholder="placeholder"
            @input="$emit('update:model-value', $event.target.value)"
            :type="type"
        />
        <span v-if="error" class="text-danger">{{error}}</span>
    </div>
</template>

<script setup>
import { computed } from 'vue'

    const emit = defineEmits(['update:model-value'])

    const { label, type, modelValue } = defineProps({
        label: String,
        type: {
            type: String,
            required: true,
        },
        placeholder : {
            type : String,
            required : false,
            default : null
        },
        modelValue: String,
        classes : {
            type : String,
            required : false
        },
        disabled : {
            type : Boolean,
            default : false
        },
        labelClasses : {
            type : String,
            required : false,
            // default :'required'
        },
        error: {
            type: String,
        },
        
    });




</script>
