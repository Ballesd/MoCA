<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permisos
            </h2>
        </template>

        <!---Make a table-->
        <div class="">
            <div class="flex justify-end">
                <button @click="createPermission" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Crear
                </button>
            </div>
            <table class="table-fixed w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="permission in permissions.data" :key="permission.id" class="" >
                        <td class="border px-4 py-2">{{ permission.name }}</td> 
                        <td class="border px-4 py-2">
                            <button @click="editPermission(permission.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Editar
                            </button>
                            <button @click="deletePermission(permission.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!---End table-->
    </AppLayout>
</template>


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { defineProps, ref } from 'vue';
    //import { Inertia } from '@inertiajs/inertia';
    import Form from '@/Components/FormSection.vue';

    const props = defineProps({
        permissions: Object
    });
    console.log("-----",props.permissions);
    const permissions = ref(props.permissions);

</script>