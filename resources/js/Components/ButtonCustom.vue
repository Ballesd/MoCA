<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit'
    },
    href: {
        type: String,
        default: '#'
    }
});
</script>

<template>
    <button
        :type="type"
        class="justify-center text-white inline-flex items-center px-5 py-2 bg-secondary border border-transparent rounded-md font-thin uppercase tracking-widest hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
