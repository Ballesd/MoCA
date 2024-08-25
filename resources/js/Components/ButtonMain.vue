<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="text-white inline-flex items-center px-4 py-2 bg-main border border-transparent rounded-md font-thin uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-midnight focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
