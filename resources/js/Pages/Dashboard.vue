<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LinkCustom from '@/Components/LinkCustom.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="my-10 flex">
            <div class="flex flex-col gap-4 w-2/3">
                <h1 class="text-5xl text-primary">Bienvenido,</h1>
                <h2 v-if="$page?.props?.auth?.user?.rol === 'user'" class="text-quaternary italic text-5xl font-sans">Nombre del paciente</h2>
                <h2 v-if="$page?.props?.auth?.user?.rol === 'admin'" class="text-quaternary italic text-5xl font-sans">Nombre del administrador</h2>
                <h2 v-if="$page?.props?.auth?.user?.rol === 'medic'" class="text-quaternary italic text-5xl font-sans">Nombre del doctor</h2>
                <div v-if="$page?.props?.auth?.user?.rol === 'user'" class="flex flex-col text-2xl text-quaternary gap-4 mt-8">
                    <p>Usted se encuentra en la plataforma del Test MoCa.</p>
                    <p>Las siguientes tareas nos permitirán conocer de manera global el estado de su cognición. Los resultados serán de gran importancia para usted, como para nosotros.</p>
                    <p>Recuerde que no hay respuestas buenas ni malas.</p>
                </div>
                <div v-if="$page?.props?.auth?.user?.rol === 'admin'" class="flex flex-col text-2xl text-quaternary gap-4 mt-8">
                    <p>Usted se encuentra en la plataforma del Test MoCa.</p>
                </div>
                <div v-if="$page?.props?.auth?.user?.rol === 'medic'" class="flex flex-col text-2xl text-quaternary gap-4 mt-8">
                    <p>Usted se encuentra en la plataforma del Test MoCa.</p>
                </div>
            </div>
            <div class="flex flex-col w-1/3 justify-end items-center">
                <div>
                    <LinkCustom v-if="$page?.props?.auth?.user?.rol === 'user'" :href="route('rules')">REALIZAR TEST</LinkCustom>
                    <LinkCustom v-if="$page?.props?.auth?.user?.rol === 'admin'" :href="route('Admin.Index')">BUSCAR USUARIOS</LinkCustom>
                    <LinkCustom v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.Show')">VER RESULTADOS</LinkCustom>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
