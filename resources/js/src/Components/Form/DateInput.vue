<script setup>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import {ref} from "vue";
import {Russian} from "flatpickr/dist/l10n/ru.js";

const props = defineProps({
    label: String,
    modelValue: String,
    placeholder: String,
    name: String,
    required: {
        type: Boolean,
        default: false
    }
})

defineEmits(['update:modelValue']);

const input = ref(null);

const config = ref({
    dateFormat: 'd.m.Y',
    locale: Russian
})
</script>

<template>
    <label
        v-if="label"
        :for="name"
    >{{ label }}
    </label>

    <flat-pickr
        class="py-2 px-4 block border border-gray-200 rounded-lg w-full"
        :value="modelValue"
        :required="required"
        :placeholder="placeholder"
        @change="$emit('update:modelValue', $event.target.value)"
        :config="config"
        ref="input"
    />
</template>

<style scoped>

</style>
