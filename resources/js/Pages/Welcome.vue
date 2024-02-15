<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const isNavOpen = ref(false);

const toggleNav = () => {
    isNavOpen.value = !isNavOpen.value;
}

</script>

<template>
    <Head title="Moca" />

    <div class="bg-slate-200">
        <!-- component -->
        <div x-data="{ open: false }">
            <nav class="flex justify-between items-center bg-white px-6 py-4 sm:px-10 lg:px-20">
                <h1 class="text-xl font-bold text-gray-800">MoCA</h1>
                <button @click="open = !open" class="text-gray-800 focus:outline-none sm:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
                <div class="hidden sm:flex items-center space-x-6">
                    <Link :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>
                    <Link :href="route('login')" class="font-semibold text-white bg-blue-500 hover:bg-blue-600 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-md px-4 py-2">Inicio de sesión</Link>
                    <Link :href="route('register')" class="font-semibold text-white bg-green-500 hover:bg-green-600 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-md px-4 py-2" x-show="canRegister">Registrarse</Link>
                </div>
                <!-- Mobile menu -->
                <div class="absolute top-0 left-0 w-full bg-white sm:hidden" x-show="open" @click.away="open = false">
                    <ul class="flex flex-col items-center space-y-4 p-6">
                        <li><Link :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</Link></li>
                        <li><Link :href="route('login')" class="font-semibold text-gray-800 hover:text-gray-900">Inicio de sesión</Link></li>
                        <li x-show="canRegister"><Link :href="route('register')" class="font-semibold text-gray-800 hover:text-gray-900">Registrarse</Link></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <h1 class="text-4xl font-bold text-sky-300">Test de Moca</h1>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

                </div>
            </div>
        </div>
    </div>

    <transition name="slide">
        <div class="fixed top-0 right-0 p-6 text-right z-10" v-show="isNavOpen">
            <ul class="flex flex-col space-y-4">
                <li v-if="$page.props.auth.user">
                    <Link :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>
                </li>
                <li v-else>
                    <Link :href="route('login')" class="font-semibold text-white bg-blue-500 hover:bg-blue-600 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-md px-4 py-2">Inicio de sesión </Link>
                </li>
                <li v-if="canRegister">
                    <Link :href="route('register')" class="font-semibold text-white bg-green-500 hover:bg-green-600 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-md px-4 py-2">Registrarse</Link>
                </li>
            </ul>
        </div>
    </transition>
    
</template>


<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
