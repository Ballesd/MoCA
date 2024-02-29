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
                        {{ moca.created_at }} and {{ moca.updated_at }}
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
                                    <span>{{ moca.total }}</span>
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
                                        <p>{{ moca.deferred_recall_answer }}</p>
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
                                    <div class="flex items-center">
                                        <InputLabel for="conceptualalternative" value="Alternancia conceptual:" />
                                        <select
                                            class="form-select mt-1 block w-full"
                                            id="ConceptualAlternative"
                                            v-model="data.ConceptualAlternative"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mt-4">
                                        <InputLabel for="cube" value="Cube:" />
                                        <select
                                            class="form-select mt-1 block w-full"
                                            id="cube"
                                            v-model="data.cube"
                                            required
                                        >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <InputLabel for="clock" value="Reloj:" />
                                        <select
                                            class="form-select mt-1 block w-full"
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
    const moca = ref();
    const url_conceptual_alternative = ref('');
    const url_cube = ref('');
    const url_clock = ref('');
    const identification = ref('');
    const users = ref();
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
                    users.value = response.data.user;
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
        console.log("data", data);
        
        const response = await axios.put(`/medic/editMoca`, {
            user_id: data.user_id,
            ConceptualAlternative: data.ConceptualAlternative,
            cube: data.cube,
            clock: data.clock,
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
