<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center sm:text-left">Administrador</h2>
        </template>

        <!-- Error Alert -->
        <div 
            v-if="errorPoint" 
            class="flex justify-between items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 sm:mx-auto sm:w-8/12" 
            role="alert"
        >
            <strong class="font-bold">Error: </strong>
            <span class="block sm:inline">{{ errorMessage }}</span>
            <button class="ml-2" @click="closeError">
                <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <title>Close</title>
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </div>

        <!-- Search Form -->
        <div class="my-6 mx-4 sm:mx-auto sm:w-8/12">
            <div class="flex flex-wrap gap-2">
                <TextInput 
                    placeholder="Digite el número de cédula de la persona que desea buscar" 
                    id="search" 
                    type="text" 
                    v-model="identification" 
                    @keyup.enter="search" 
                    required 
                    autofocus 
                    class="flex-grow block w-full sm:w-auto border-gray-300 rounded-md"
                />
                <ButtonCustom class="w-full sm:w-auto" mode="button" @click="search">BUSCAR</ButtonCustom>
            </div>
        </div>

        <!-- Results Table -->
        <div v-if="values.length > 0" class="rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-sm sm:text-base">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-secondary text-white">Nombre</th>
                            <th class="px-4 py-2 bg-secondary text-white">Email</th>
                            <th class="px-4 py-2 bg-secondary text-white">Rol</th>
                            <th class="px-4 py-2 bg-secondary text-white">Cédula</th>
                            <th class="px-4 py-2 bg-secondary text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in values" :key="user.id" class="border-b">
                            <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ user.name }} {{ user.lastname }}</td>
                            <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ user.email }}</td>
                            <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ user.rol }}</td>
                            <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ user.identification }}</td>
                            <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">
                                 <Button
                                        class="underline text-blue-500"
                                        @click="
                                            updateState = true;
                                            data.id = user.id;
                                            data.name = user.name;
                                            data.lastname = user.lastname;
                                            data.email = user.email;
                                            data.rol = user.rol;
                                            data.identification = user.identification;
                                        "
                                    >
                                        Editar
                                    </Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Form -->
        <div v-if="updateState" class="my-6 mx-4 sm:mx-auto sm:w-8/12 border border-gray-300 rounded-lg p-4 bg-gray-50 bg-quinary">
            <h3 class="text-gray-700 mb-4">El usuario que se editará es {{ data.name }} {{ data.lastname }}</h3>
            <div class="flex flex-col gap-2">
                <label>
                    <input type="radio" value="medic" v-model="data.rol" />
                    Médico
                </label>
                <label>
                    <input type="radio" value="admin" v-model="data.rol" />
                    Administrador
                </label>
                <label>
                    <input type="radio" value="user" v-model="data.rol" />
                    Usuario - Paciente
                </label>
            </div>
            <ButtonCustom class="mt-4 w-full" mode="button" @click="updateUser">GUARDAR</ButtonCustom>
        </div>
    </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { defineProps, ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';

const identification = ref('');
const { users } = defineProps(['users']);
const values = ref([]);
const updateState = ref(false);
const errorMessage = ref('');
const errorPoint = ref(false);

const data = useForm({
    id: '',
    rol: ''
});

const search = async () => {
    if (identification.value === '') {
        errorPoint.value = true;
        errorMessage.value = 'Debe ingresar una cédula';
        return;
    } else {
        const response = await axios.get('/admin/index', {
            params: {
                term: identification.value
            }
        });
        if (response.data.length === 0) {
            errorPoint.value = true;
            errorMessage.value = 'No se encontró el usuario';
            return;
        }

        values.value = response.data;
    }
};
const updateUser = async () => {
    const response = await axios.put(`/admin/update`, {
        id: data.id,
        rol: data.rol
    });
    if (response.status === 200) {
        updateState.value = false;
        search();
    }
};

const closeError = () => {
    errorPoint.value = false;
};
</script>
