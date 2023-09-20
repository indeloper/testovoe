<script setup>
import {ref} from "vue";

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
</script>

<template>
    <label
        v-if="label"
        :for="name"
    >{{ label }}</label>
    <textarea
        :required="required"
        :name="name"
        :value="modelValue"
        class="py-2 px-4 block border border-gray-200 rounded-lg w-full"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        :placeholder="placeholder"
    />
</template>

<style scoped>

</style>
