<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block font-medium  sm:text-base text-gray-500">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
