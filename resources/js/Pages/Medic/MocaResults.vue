<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-center mt-8 mb-4 font-semibold text-xl text-gray-800 leading-tight">
                Resultados del test de MoCA
            </h2>
        </template>
        <div v-if="errorPoint" class="mx-4 md:mx-0 flex justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
            <strong class="font-bold">Error: </strong>
            <span class="block sm:inline">{{ errorMessage }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="closeError">
                <svg class="fill-current h-6 w-6 text-red-500" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </span>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 md:p-8">
                    <div class="mt-4">
                        <InputLabel for="text" value="Busca a la persona por la cédula" />
                        <input
                            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            id="search"
                            type="text"
                            v-model="identification"
                            @keyup.enter="search"
                            required
                            autofocus
                        />
                    </div>
                    <div class="flex justify-center items-center mt-6">
                        <PrimaryButton @click="search">
                            Buscar
                        </PrimaryButton>
                    </div>

                    <div v-if="values " class="mt-4">
                        <table class="table-auto w-full my-4 px-4 py-2 rounded-lg overflow-hidden">
                            <thead>
                                <tr >
                                    <th class="px-4 py-2 bg-blue-900 text-white rounded-tl-lg">Nombre</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white">Email</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white">Cédula</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ users.name }} {{ users.lastname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ users.email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ users.identification }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div v-if="values" class="mt-8">
                        <h2 class="text-center text-2xl font-semibold">{{ resultMoca }}</h2>
                        <div class="text-lg font-semibold p-4 bg-gray-100 rounded-lg shadow">
                            <p class="mb-2">
                                Inicio de prueba: <span class="font-normal">{{ date_start }}</span>
                            </p>
                            <p>
                                Fin de la prueba: <span class="font-normal">{{ date_end }}</span>
                            </p>

                            <div v-if= "users.schooling === 0" >
                                <p class="mt-4">
                                    No tiene punto extra sobre el nivel de escolaridad.
                                </p>
                            </div>
                            <div v-else-if= "users.schooling === 1" >
                                <p class="mt-4">
                                    Tiene un punto extra sobre el nivel de escolaridad +1.
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                <div class="mt-6">
                                    <h3 class="text-lg font-semibold">Imágenes para calificar</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                        <div>
                                            <label class="mr-2">Alternancia conceptual: {{ moca.ConceptualAlternative }}</label>
                                            <img :src="url_conceptual_alternative" alt="" class="w-full h-auto">
                                        </div>
                                        <div>
                                            <label class="mr-2">Cubo: {{ moca.cube }}</label>
                                            <img :src="url_cube" alt="" class="w-full h-auto">
                                        </div>
                                        <div>
                                            <label class="mr-2">Reloj: {{ moca.clock }}</label>
                                            <img :src="url_clock" alt="" class="w-full h-auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center mt-6">
                                    <PrimaryButton @click="updateState=true">
                                        Calificar
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>

                        <div v-if="updateState" class="mt-8 px-4 md:px-0">
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

                        <div v-if="updateState" class="mt-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="conceptualalternative" value="Alternancia conceptual:"  />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="ConceptualAlternative"
                                            v-model="data.ConceptualAlternative"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="cube" value="Cube:" />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="cube"
                                            v-model="data.cube"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="clock" value="Reloj:" />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="clock"
                                            v-model="data.clock"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="identification" value="Identificación:" />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="identification"
                                            v-model="data.identification"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="attention" value="Atención:" />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="attention"
                                            v-model="data.attention"
                                            required
                                        >
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
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="language"
                                            v-model="data.language"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="verbal_fluency" value="Fluidez verbal:" />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="verbal_fluency"
                                            v-model="data.verbal_fluency"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="abstraction" value="Abstracción:" />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="abstraction"
                                            v-model="data.abstraction"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <InputLabel for="deferred_recall" value="Recuerdo diferido:" />
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="deferred_recall"
                                            v-model="data.deferred_recall"
                                            required
                                        >
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
                                        <select
                                            class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            id="orientation"
                                            v-model="data.orientation"
                                            required
                                        >
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
                            <div class="flex justify-center mt-6">
                                <PrimaryButton @click="calificar">
                                    Guardar
                                </PrimaryButton>
                            </div>
                        </div>

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

    // Define a reactive variable to store the fetched data
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
        mis: '',
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

    const data = useForm({
        user_id: '',
        ConceptualAlternative: '',
        cube: '',
        clock: '',
        identification:  '',
        attention: '',
        language: '',
        verbal_fluency: '',
        abstraction: '',
        deferred_recall: '',
        orientation: '',
    });


    const search = async () => {
        if(identification.value === ''){
            errorPoint.value = true;
            errorMessage.value = "Debe ingresar una cédula";
            return;
        }else{
            const response = await axios.post('/medic/getMoca', {
            identification: identification.value,
        });
            if(response.data === 'No se encontro el usuario'){
                errorPoint.value = true;
                errorMessage.value = "No se encontro el usuario";
                return;
            }else{
                if(response.data === 'El usuario no ha realizado el examen'){
                    errorPoint.value = true;
                    errorMessage.value = "El usuario no ha realizado el examen";
                }
                else{
                    moca.value = response.data.moca;

                    //transromamos el datetime a un formato mas legible
                    date_start.value = new Date(moca.value.created_at).toLocaleString();
                    date_end.value = new Date(moca.value.updated_at).toLocaleString();

                    users.value = response.data.user;
                    console.log("users", users.value);
                    values.value = true;

                    //sacamos los la ruta del storage remplezando el primer tramo "public" por "storage" y añadimos al principio "/"
                    url_conceptual_alternative.value = "/"+moca.value.image_conceptual_alternative.replace("public","storage");
                    url_cube.value = "/"+moca.value.image_cube.replace("public","storage");
                    url_clock.value = "/"+moca.value.image_clock.replace("public","storage");
                }
            }
        }
 
    };
    const calificar = async () => {
        data.user_id = users.value.id;
        
        if(data.ConceptualAlternative === ''){
            data.ConceptualAlternative = moca.value.ConceptualAlternative;
        }
        if(data.cube === ''){
            data.cube = moca.value.cube;
        }
        if(data.clock === ''){
            data.clock = moca.value.clock;
        }
        if(data.identification === ''){
            data.identification = moca.value.identification;
        }
        if(data.attention === ''){
            data.attention = moca.value.attention;
        }
        if(data.language === ''){
            data.language = moca.value.language;
        }
        if(data.verbal_fluency === ''){
            data.verbal_fluency = moca.value.verbal_fluency;
        }
        if(data.abstraction === ''){
            data.abstraction = moca.value.abstraction;
        }
        if(data.deferred_recall === ''){
            data.deferred_recall = moca.value.deferred_recall;
        }
        if(data.orientation === ''){
            data.orientation = moca.value.orientation;
        }
        console.log("data", data);

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
            orientation: data.orientation,
        });

        console.log("respuesta en calificar", response.data);
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
