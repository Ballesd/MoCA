<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        default: '#'
    }
});
</script>

<template>
    <Link
        :href="href"
        class="justify-center text-white inline-flex items-center px-5 py-2 bg-secondary border border-transparent rounded-md font-normal uppercase tracking-widest hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </Link>
</template>
