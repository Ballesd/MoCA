<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { defineProps } from 'vue';
import NavLinkLogout from '@/Components/NavLinkLogout.vue';

defineProps({
    title: String,
    bgNetwork: {
        type: Boolean,
        default: true
    }
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <Head :title="title" />
    <Banner />
    <div class="min-h-screen h-screen bg-white relative flex flex-col">
        <nav class="bg-white">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto px-8">
                <div class="flex justify-between h-24">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
                            <img class="w-auto h-16" src="../../../public/images/logo.png" alt="Logo" />
                        </Link>
                    </div>
                    <div class="flex items-center">
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <NavLink v-if="$page?.props?.auth?.user?.rol === 'user' || $page?.props?.auth?.user?.rol === 'admin' || $page?.props?.auth?.user?.rol === 'medic'" :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </NavLink>
                            <NavLink v-if="$page?.props?.auth?.user?.rol === 'user'" :href="route('Moca.Index')" :active="route().current('Moca.Index')"> MoCA </NavLink>
                            <NavLink v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.Show')" :active="route().current('Medic.Show')"> Resultados MoCA </NavLink>
                            <NavLink v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.History')" :active="route().current('Medic.History')"> Buscar Historial Clínico </NavLink>
                            <NavLink v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.clinicHistory')" :active="route().current('Medic.clinicHistory')"> Realizar Historia Clínica </NavLink>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Show "Iniciar sesión" and "Registro" when not authenticated -->
                            <NavLink v-if="!$page?.props?.auth?.user" :href="route('login')" :active="route().current('login')" class="text-blue-500 hover:text-blue-700"> Iniciar sesión </NavLink>
                            <NavLink v-if="!$page?.props?.auth?.user" :href="route('register')" :active="route().current('register')" class="text-blue-500 hover:text-blue-700"> Registro </NavLink>
                            <!-- Show "Cerrar sesión" when authenticated -->
                            <NavLinkLogout v-if="$page?.props?.auth?.user" :active="route().current('logout')" class="text-red-500 hover:text-red-700 font-bold"> Cerrar sesión </NavLinkLogout>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown
                }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink v-if="$page?.props?.auth?.user?.rol === 'user'" :href="route('dashboard')" :active="route().current('dashboard')"> Dashboard </ResponsiveNavLink>
                    <ResponsiveNavLink v-if="$page?.props?.auth?.user?.rol === 'user'" :href="route('Moca.Index')" :active="route().current('Moca.Index')"> MoCA </ResponsiveNavLink>
                    <ResponsiveNavLink v-if="$page?.props?.auth?.user?.rol === 'admin'" :href="route('Admin.Index')" :active="route().current('Admin.Index')"> Administrador </ResponsiveNavLink>
                    <ResponsiveNavLink v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.Index')" :active="route().current('Medic.Index')"> Médico </ResponsiveNavLink>
                    <ResponsiveNavLink v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.Show')" :active="route().current('Medic.Show')"> Resultados MoCA </ResponsiveNavLink>
                    <ResponsiveNavLink v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.History')" :active="route().current('Medic.History')"> Buscar Historial Clínico </ResponsiveNavLink>
                    <ResponsiveNavLink v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.clinicHistory')" :active="route().current('Medic.clinicHistory')"> Realizar Historia Clínica </ResponsiveNavLink>
                </div>

                <!-- Responsive Authentication Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                            <img class="h-10 w-10 rounded-full object-cover" :src="$page?.props?.auth.user?.profile_photo_url" :alt="$page?.props?.auth?.user?.name" />
                        </div>

                        <div>
                            <div class="font-medium text-base text-gray-800">
                                {{ $page?.props?.auth?.user?.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page?.props?.auth?.user?.email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')"> Perfil </ResponsiveNavLink>
                        <ResponsiveNavLink v-if="$page?.props?.jetstream?.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')"> API Tokens </ResponsiveNavLink>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <ResponsiveNavLink as="button"> Cerrar sesión </ResponsiveNavLink>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <main class="flex-1 relative z-10 container px-8 mx-auto h-full">
            <slot />
        </main>
        <div v-if="bgNetwork" class="absolute z-0 m-5 bottom-0 right-0 w-full h-full bg-network bg-no-repeat opacity-10 bg-right-bottom pointer-events-none" style="background-size: 47%"></div>
    </div>
</template>
