<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Administrador
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-4">
                        <InputLabel for="text" value="Busca a la persona por la cédula" />
                        <input
                            class="input-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="search"
                            type="text"
                            v-model="identification"
                            @keyup.enter="search"
                            required
                            autofocus
                        />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton @click="search">
                            Buscar
                        </PrimaryButton>
                    </div>

                    <div v-if="values.length > 0" class="mt-4">
                        <table class="table-auto w-full my-4 px-4 py-2 rounded-lg overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 bg-blue-900 text-white rounded-tl-lg">Nombre</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white">Email</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white">Rol</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white">Cédula</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white rounded-tr-lg">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in values" :key="user.id">
                                    <td class="border px-4 py-2">{{user.name}} {{ user.lastname }}</td>
                                    <td class="border px-4 py-2">{{ user.email }}</td>
                                    <td class="border px-4 py-2">{{ user.rol }}</td>
                                    <td class="border px-4 py-2">{{ user.identification }}</td>
                                    <td class="border px-4 py-2">   
                                        <PrimaryButton @click="updateState = true; data.id = user.id; data.name = user.name; data.lastname = user.lastname; data.email = user.email; data.rol = user.rol; data.identification = user.identification">
                                            Editar
                                        </PrimaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-if="updateState">
                        <h3>
                            Va a editar el usuario {{ data.name }} {{ data.lastname }}
                        </h3>

                        <div class="mt-4">
                            <InputLabel for="rol" value="Rol" />
                            <select
                                class="input-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="rol"
                                v-model="data.rol"
                                required
                            >
                                <option value="medic">medic</option>
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <PrimaryButton @click="updateUser">
                                Guardar
                            </PrimaryButton>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, Link, router,useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import { defineProps, ref } from 'vue';

    const identification = ref('');
    const { users } = defineProps(['users']);
    const values = ref([]);
    const updateState = ref(false);

    const data = useForm({
        id: '',
        rol: '',
    });

    const search = async () => {
        const response = await axios.get('/admin/index', {
            params: {
                term: identification.value,
            },
        });
        values.value = response.data;        
    };
    const updateUser = async () => {

        const response = await axios.put(`/admin/update`, {
            id: data.id,
            rol: data.rol,
        });
        if (response.status === 200) {
            console.log(response.data);
            updateState.value = false;
            search();
        }
    };
</script>
