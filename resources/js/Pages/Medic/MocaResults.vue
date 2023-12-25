<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="grid justify-items-center mt-4 font-semibold text-xl text-gray-800 leading-tight">
                Resultados del test de MoCA
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

                    <div v-if="values " class="mt-4">
                        <table class="table-auto w-full my-4 px-4 py-2 rounded-lg overflow-hidden">
                            <thead>
                                <tr >
                                    <th class="px-4 py-2 bg-blue-900 text-white rounded-tl-lg">Nombre</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white">Email</th>
                                    <th class="px-4 py-2 bg-blue-900 text-white">Cédula</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">{{ users.name }} {{ users.lastname }}</td>
                                    <td class="border px-4 py-2">{{ users.email }}</td>
                                    <td class="border px-4 py-2">{{ users.identification }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div v-if="values" class="mt-4">
                        <h2 class="grid justify-items-center mt-4 text-2xl font-semibold">{{ resultMoca }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
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
                                <div class="mt-4">
                                    <h3 class="text-lg font-semibold">Imágenes para calificar</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
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
                                <div class="grid justify-items-center mt-4">
                                    <PrimaryButton @click="updateState=true">
                                        Calificar
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                        <div v-if="updateState">
                            <div class="mt-4">
                                <InputLabel for="conceptualalternative" value="Alternancia conceptual:" />
                                <select
                                class="input-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="ConceptualAlternative"
                                v-model="data.ConceptualAlternative"
                                required
                            >
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <InputLabel for="cube" value="Cube:" />
                                <select
                                class="input-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="cube"
                                v-model="data.cube"
                                required
                            >
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <InputLabel for="cube" value="Reloj:" />
                                <select
                                class="input-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="clock"
                                v-model="data.clock"
                                required
                            >
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                </select>
                            </div>
                            <div class="mt-4">
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
    const moca = ref();
    const url_conceptual_alternative = ref('');
    const url_cube = ref('');
    const url_clock = ref('');
    const identification = ref('');
    const users = ref();
    const updateState = ref(false);
    const resultMoca = ref('');
    const values = ref(false);

    const data = useForm({
        user_id: '',
        ConceptualAlternative: '',
        cube: '',
        clock: '',
    });


    const search = async () => {
        console.log("identification antes de mandarlo ",identification.value);   
        const response = await axios.post('/medic/getMoca', {
            identification: identification.value,
        });
        moca.value = response.data.moca;
        users.value = response.data.user;
        values.value = true;
        if(moca.value === null){
            resultMoca.value = "Aún no ha realizado el test";
        }else{
            resultMoca.value = 'Resultados y puntajes del Test de MoCA';
        }

        //sacamos los la ruta del storage remplezando el primer tramo "public" por "storage" y añadimos al principio "/"
        url_conceptual_alternative.value = "/"+moca.value.image_conceptual_alternative.replace("public","storage");
        url_cube.value = "/"+moca.value.image_cube.replace("public","storage");
        url_clock.value = "/"+moca.value.image_clock.replace("public","storage");

        console.log("respuesta en moca", moca.value);
        console.log("respuesta en users", users.value);    
    };
    const calificar = async () => {
        data.user_id = users.value.id;
        console.log("user", data.user_id);
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
    
</script>
