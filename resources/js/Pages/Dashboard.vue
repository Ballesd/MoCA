<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LinkCustom from '@/Components/LinkCustom.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="my-10 mt-5 flex flex-col sm:flex-row items-center sm:items-end gap-4">
            <div class="flex flex-col gap-2 w-full sm:w-2/3 px-5">
                <h1 class=" text-4xl sm:text-5xl text-primary">Bienvenido,</h1>

                <h2 v-if="$page?.props?.auth?.user?.rol === 'user'" class=" italic text-4xl sm:text-5xl font-sans">
                    {{ $page.props.auth.user.name || 'Nombre del paciente' }} </h2>
                <h2 v-if="$page?.props?.auth?.user?.rol === 'admin'" class="italic text-4xl sm:text-5xl font-sans">
                    {{ $page.props.auth.user.name || 'Nombre del admin' }}
                </h2>
                <h2 v-if="$page?.props?.auth?.user?.rol === 'medic'" class="italic text-4xl sm:text-5xl font-sans">
                    {{ $page.props.auth.user.name || 'Nombre del paciente' }}
                </h2>
                <div v-if="$page?.props?.auth?.user?.rol === 'user' && !$page?.props?.auth?.user?.test_completed"
                    class="flex flex-col text-xl sm:text-2xl  gap-4 mt-8 text-justify hyphens-auto sm:hyphens-none">
                    <p>Usted se encuentra en la plataforma del Test MoCa.</p>
                    <p>Las siguientes tareas nos permitirán conocer de manera global el estado de su cognición. Los
                        resultados serán de gran importancia para usted, como para nosotros.</p>
                    <p>Recuerde que no hay respuestas buenas ni malas.</p>
                </div>

                <div v-if="$page?.props?.auth?.user?.rol === 'user' && $page?.props?.auth?.user?.test_completed"
                    class="flex flex-col text-xl sm:text-2xl  gap-4 mt-8 text-justify hyphens-auto sm:hyphens-none">
                    <p>Usted ya ha realizado este test anteriormente.
                        Los resultados serán analizados por el profesional tratante, quien le brindará posteriormente las recomendaciones correspondientes según su desempeño.</p>
                    <p>¡Gracias por su participación!</p>
                </div>
                <div v-if="$page?.props?.auth?.user?.rol === 'admin'"
                    class="flex flex-col text-2xl  gap-4 mt-8 test-justify">
                    <p>Usted se encuentra en la plataforma del Test MoCa.</p>
                </div>
                <div v-if="$page?.props?.auth?.user?.rol === 'medic'"
                    class="flex flex-col text-2xl  gap-4 mt-8 test-justify">
                    <p>Usted se encuentra en la plataforma del Test MoCa.</p>
                </div>
            </div>
            <div class="flex flex-col w-1/3 justify-end items-center text-base mt-3">
                <div>
                    <LinkCustom
                        v-if="$page?.props?.auth?.user?.rol === 'user' && !$page?.props?.auth?.user?.test_completed"
                        :href="route('rules')">
                        REALIZAR TEST
                    </LinkCustom>
                    <LinkCustom v-if="$page?.props?.auth?.user?.rol === 'admin'" :href="route('Admin.Index')">BUSCAR
                        USUARIOS</LinkCustom>
                    <LinkCustom v-if="$page?.props?.auth?.user?.rol === 'medic'" :href="route('Medic.Show')">VER
                        RESULTADOS</LinkCustom>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>


</script>
