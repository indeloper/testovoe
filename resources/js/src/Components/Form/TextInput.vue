<script setup>
import {ref} from "vue";
import {vMaska} from "maska"

const props = defineProps({
    label: String,
    type: String,
    modelValue: String,
    placeholder: String,
    name: String,
    mask: String,
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
    <!--TODO: make dynamic mask-->
    <input
        :required="required"
        :type="type"
        :name="name"
        :value="modelValue"
        class="py-2 px-4 block border border-gray-200 rounded-lg w-full"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        :placeholder="placeholder"
        v-maska
        :data-maska="mask"
    >
</template>

<style scoped>

</style>
