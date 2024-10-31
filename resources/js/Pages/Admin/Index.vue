<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Administrador</h2>
        </template>
        <div v-if="errorPoint" class="flex justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error: </strong>
            <span class="block sm:inline">{{ errorMessage }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="closeError">
                <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <title>Close</title>
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </span>
        </div>
        <div class="my-12">
            <div class="flex gap-4 w-8/12 mx-auto">
                <TextInput placeholder="Digite el número de cédula de la persona que desea buscar" id="search" type="text" v-model="identification" @keyup.enter="search" required autofocus class="block w-full" />
                <div class="w-1/3">
                    <ButtonCustom class="w-full" mode="button" @click="search">BUSCAR</ButtonCustom>
                </div>
            </div>
            <div class="rounded-lg">
                <div v-if="values.length > 0" class="mt-5">
                    <table class="table-auto w-full rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="px-4 py-4 bg-secondary text-white rounded-tl-lg rounded-bl-lg">Nombre</th>
                                <th class="px-4 py-4 bg-secondary text-white">Email</th>
                                <th class="px-4 py-4 bg-secondary text-white">Rol</th>
                                <th class="px-4 py-4 bg-secondary text-white">Cédula</th>
                                <th class="px-4 py-4 bg-secondary text-white rounded-tr-lg rounded-br-lg">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in values" :key="user.id">
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary rounded-tl-lg rounded-bl-lg">{{ user.name }} {{ user.lastname }}</td>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ user.email }}</td>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ user.rol }}</td>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ user.identification }}</td>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary rounded-tr-lg rounded-br-lg">
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
                <div v-if="updateState" class="flex justify-around border border-gray-400 rounded-lg bg-quinary p-6">
                    <h3 class="text-left self-end text-gray-700">El usuario que se editará es {{ data.name }} {{ data.lastname }}</h3>
                    <div class="flex flex-col gap-4 text-gray-700">
                        <div class="flex gap-4 items-center">
                            <input id="medic" type="radio" value="medic" v-model="data.rol" />
                            <label for="medic">Médico</label>
                        </div>
                        <div class="flex gap-4 items-center">
                            <input id="admin" type="radio" value="admin" v-model="data.rol" />
                            <label for="admin">Administrador</label>
                        </div>
                        <div class="flex gap-4 items-center">
                            <input id="user" type="radio" value="user" v-model="data.rol" />
                            <label for="user">Usuario - Paciente</label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center w-1/5 items-center mx-auto mt-5">
                    <ButtonCustom class="w-full mx-auto" mode="button" @click="updateUser">GUARDAR</ButtonCustom>
                </div>
            </div>
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
        console.log(response.data);
        updateState.value = false;
        search();
    }
};

const closeError = () => {
    errorPoint.value = false;
};
</script>
