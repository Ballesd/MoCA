<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-center mt-8 mb-4 font-semibold text-xl text-gray-800 leading-tight">Resultados del test de MoCA</h2>
        </template>
        <div v-if="errorPoint" class="mx-4 md:mx-0 flex justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
            <strong class="font-bold">Error: </strong>
            <span class="block sm:inline">{{ errorMessage }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="closeError">
                <svg class="fill-current h-6 w-6 text-red-500" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </span>
        </div>
        <div class="py-8">
            <div class="flex gap-4 w-8/12 mx-auto">
                <TextInput placeholder="Digite el número de cédula de la persona que desea buscar" id="search" type="text" v-model="identification" @keyup.enter="search" required autofocus class="block w-full" />
                <div class="w-1/3">
                    <ButtonCustom class="w-full" mode="button" @click="search">BUSCAR</ButtonCustom>
                </div>
            </div>
            <div class="rounded-lg">
                <div v-if="users" class="mt-5">
                    <table class="table-auto w-full rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="px-4 py-4 bg-secondary text-white rounded-tl-lg rounded-bl-lg">Nombre</th>
                                <th class="px-4 py-4 bg-secondary text-white">Email</th>
                                <th class="px-4 py-4 bg-secondary text-white">Cédula</th>
                                <th class="px-4 py-4 bg-secondary text-white rounded-tr-lg rounded-br-lg">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary rounded-tl-lg rounded-bl-lg">{{ users?.name }} {{ users?.lastname }}</td>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ users?.email }}</td>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary">{{ users?.identification }}</td>
                                <td class="px-4 py-1.5 text-gray-600 text-center bg-quinary rounded-tr-lg rounded-br-lg">
                                    <Button class="underline text-blue-500" @click="downloadExcel"> Descargar excel </Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="values">
                    <div class="border border-gray-400 rounded-lg bg-white p-6">
                        <!-- <h2 class="text-center text-2xl font-semibold">{{ resultMoca }}</h2> -->
                        <div class="grid grid-cols-4 gap-10">
                            <div class="flex flex-col col-span-2 text-lg font-semibold h-full">
                                <div class="flex-grow">
                                    <p>
                                        Inicio de prueba: <span class="font-normal">{{ date_start }}</span>
                                    </p>
                                    <p>
                                        Fin de la prueba: <span class="font-normal">{{ date_end }}</span>
                                    </p>
                                </div>
                                <div>
                                    <div v-if="users.schooling === 0">
                                        <p>No tiene punto extra sobre el nivel de escolaridad.</p>
                                    </div>
                                    <div v-else-if="users.schooling === 1">
                                        <p>Tiene un punto extra sobre el nivel de escolaridad +1.</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <label class="mr-2">Identificación:</label>
                                    <span>{{ moca.identification }}</span>
                                </div>
                                <div class="flex items-center">
                                    <label class="mr-2">Memoria:</label>
                                    <span>{{ moca.memory }}</span>
                                </div>
                                <div class="flex items-center">
                                    <label class="mr-2">Atención:</label>
                                    <span>{{ moca.attention }}</span>
                                </div>
                                <div class="flex items-center">
                                    <label class="mr-2">Lenguaje:</label>
                                    <span>{{ moca.language }}</span>
                                </div>
                                <div class="flex items-center">
                                    <label class="mr-2">Fluidez verbal:</label>
                                    <span>{{ moca.verbal_fluency }}</span>
                                </div>
                                <div class="flex items-center">
                                    <label class="mr-2">Abstracción:</label>
                                    <span>{{ moca.abstraction }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <label class="mr-2">Recuerdo referido:</label>
                                    <span>{{ moca.deferred_recall }}; MIS: {{ moca.mis }}</span>
                                </div>
                                <div class="flex items-center">
                                    <label class="mr-2">Orientación:</label>
                                    <span>{{ moca.orientation }}</span>
                                </div>
                                <div class="flex items-center">
                                    <label class="mr-2">Total:</label>
                                    <span>{{ moca.total }} + {{ users.schooling }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-7">
                        <h3 class="text-xl font-semibold">Imágenes para calificar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 mt-4 gap-10">
                            <div>
                                <label class="mr-2">Alternancia conceptual: {{ moca.ConceptualAlternative }}</label>
                                <img :src="url_conceptual_alternative" alt="" class="w-full h-auto" />
                            </div>
                            <div>
                                <label class="mr-2">Cubo: {{ moca.cube }}</label>
                                <img :src="url_cube" alt="" class="w-full h-auto" />
                            </div>
                            <div>
                                <label class="mr-2">Reloj: {{ moca.clock }}</label>
                                <img :src="url_clock" alt="" class="w-full h-auto" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5 items-center mx-auto mt-10">
                        <ButtonCustom class="w-full mx-auto" mode="button" @click="updateState = true">CALIFICAR</ButtonCustom>
                    </div>
                </div>
                <div v-if="updateState">
                    <div class="mt-8 bg-quinary rounded-lg p-10">
                        <h2 class="text-center text-2xl font-semibold mb-6">Respuestas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">Identificación</h3>
                                    <p>{{ moca.identification_answer }}</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">Atención</h3>
                                    <p>{{ moca.attention_answer }}</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">Lenguaje</h3>
                                    <p>{{ moca.language_answer }}</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">Fluidez verbal</h3>
                                    <p>{{ moca.verbal_fluency_answer }}</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">Abstracción</h3>
                                    <p>{{ moca.abstraction_answer }}</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">Recuerdo diferido</h3>
                                    <p class="break-words overflow-auto text-sm md:text-base">
                                        {{ moca.deferred_recall_answer }}
                                    </p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">Orientación</h3>
                                    <p>{{ moca.orientation_answer }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 bg-quinary rounded-lg p-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="conceptualalternative" value="Alternancia conceptual:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="ConceptualAlternative" v-model="data.ConceptualAlternative" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="cube" value="Cube:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="cube" v-model="data.cube" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="clock" value="Reloj:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="clock" v-model="data.clock" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="identification" value="Identificación:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="identification" v-model="data.identification" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="attention" value="Atención:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="attention" v-model="data.attention" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="language" value="Lenguaje:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="language" v-model="data.language" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="verbal_fluency" value="Fluidez verbal:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="verbal_fluency" v-model="data.verbal_fluency" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="abstraction" value="Abstracción:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="abstraction" v-model="data.abstraction" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="deferred_recall" value="Recuerdo diferido:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="deferred_recall" v-model="data.deferred_recall" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <InputLabel for="orientation" value="Orientación:" />
                                    <select class="ml-5 form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" id="orientation" v-model="data.orientation" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/5 items-center mx-auto mt-10">
                        <ButtonCustom class="w-full mx-auto" mode="button" @click="calificar">GUARDAR</ButtonCustom>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';

const moca = ref({
    identification: '',
    memory: '',
    attention: '',
    language: '',
    verbal_fluency: '',
    abstraction: '',
    deferred_recall: '',
    orientation: '',
    total: '',
    created_at: '',
    updated_at: '',
    image_conceptual_alternative: '',
    image_cube: '',
    image_clock: '',
    ConceptualAlternative: '',
    cube: '',
    clock: '',
    identification_answer: '',
    attention_answer: '',
    language_answer: '',
    verbal_fluency_answer: '',
    abstraction_answer: '',
    deferred_recall_answer: '',
    orientation_answer: '',
    mis: ''
});

const url_conceptual_alternative = ref('');
const url_cube = ref('');
const url_clock = ref('');
const identification = ref('');
const users = ref();
const date_start = ref('');
const date_end = ref('');
const updateState = ref(false);
const resultMoca = ref('');
const values = ref(false);
const errorMessage = ref('');
const errorPoint = ref(false);
const exportURL = ref('');

const data = useForm({
    user_id: '',
    ConceptualAlternative: '',
    cube: '',
    clock: '',
    identification: '',
    attention: '',
    language: '',
    verbal_fluency: '',
    abstraction: '',
    deferred_recall: '',
    orientation: ''
});

function downloadExcel() {
    const params = {
        user_id: users.value.id,
        moca_id: moca.value.id
    };
    console.log('exportURL', exportURL.value);
    exportURL.value = `/export?${new URLSearchParams(params).toString()}`;
    window.location.href = exportURL.value;
}

const search = async () => {
    if (identification.value === '') {
        errorPoint.value = true;
        errorMessage.value = 'Debe ingresar una cédula';
        return;
    } else {
        const response = await axios.post('/medic/getMoca', {
            identification: identification.value
        });
        if (response.data === 'No se encontro el usuario') {
            errorPoint.value = true;
            errorMessage.value = 'No se encontro el usuario';
            return;
        } else {
            if (response.data === 'El usuario no ha realizado el examen') {
                errorPoint.value = true;
                errorMessage.value = 'El usuario no ha realizado el examen';
            } else {
                moca.value = response.data.moca;

                //transromamos el datetime a un formato mas legible
                date_start.value = new Date(moca.value.created_at).toLocaleString();
                date_end.value = new Date(moca.value.updated_at).toLocaleString();

                users.value = response.data.user;
                console.log('users', users.value);
                values.value = true;

                //sacamos los la ruta del storage remplezando el primer tramo "public" por "storage" y añadimos al principio "/"
                url_conceptual_alternative.value = '/' + moca.value.image_conceptual_alternative.replace('public', 'storage');
                url_cube.value = '/' + moca.value.image_cube.replace('public', 'storage');
                url_clock.value = '/' + moca.value.image_clock.replace('public', 'storage');
            }
        }
    }
};
const calificar = async () => {
    data.user_id = users.value.id;

    if (data.ConceptualAlternative === '') {
        data.ConceptualAlternative = moca.value.ConceptualAlternative;
    }
    if (data.cube === '') {
        data.cube = moca.value.cube;
    }
    if (data.clock === '') {
        data.clock = moca.value.clock;
    }
    if (data.identification === '') {
        data.identification = moca.value.identification;
    }
    if (data.attention === '') {
        data.attention = moca.value.attention;
    }
    if (data.language === '') {
        data.language = moca.value.language;
    }
    if (data.verbal_fluency === '') {
        data.verbal_fluency = moca.value.verbal_fluency;
    }
    if (data.abstraction === '') {
        data.abstraction = moca.value.abstraction;
    }
    if (data.deferred_recall === '') {
        data.deferred_recall = moca.value.deferred_recall;
    }
    if (data.orientation === '') {
        data.orientation = moca.value.orientation;
    }
    console.log('data', data);

    const response = await axios.put(`/medic/editMoca`, {
        user_id: data.user_id,
        ConceptualAlternative: data.ConceptualAlternative,
        cube: data.cube,
        clock: data.clock,
        identification: data.identification,
        attention: data.attention,
        language: data.language,
        verbal_fluency: data.verbal_fluency,
        abstraction: data.abstraction,
        deferred_recall: data.deferred_recall,
        orientation: data.orientation
    });

    console.log('respuesta en calificar', response.data);
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
