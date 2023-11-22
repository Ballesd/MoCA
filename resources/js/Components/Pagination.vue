<template>
    
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        links: Array,
        total: Number,
        to: Number,
        from: Number,
    });

    const Components = {
        Link,
    };


</script>