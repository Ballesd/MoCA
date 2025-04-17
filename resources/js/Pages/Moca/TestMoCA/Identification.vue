<template>
    <div class="flex flex-col lg:flex-row items-center justify-center lg:space-x-12 space-y-6 lg:space-y-0 mb-10 px-4">
        <!-- Contenedor de Texto e Imágenes -->
        <div class="flex flex-col justify-center gap-4 w-full lg:w-8/12">
            <div class="flex items-center space-x-3">
                <font-awesome-icon
                    :icon="['fas', 'volume-up']"
                    size="2x"
                    class="text-secondary cursor-pointer hover:text-primary"
                    @click="speachIntroduction"
                />
                <h2 class="text-primary text-xl sm:text-2xl md:text-3xl text-center lg:text-left">
                    4. Identificación
                </h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 w-full">
                <p class="text-base sm:text-lg text-justify hyphens-auto sm:hyphens-none">
                    Ingrese dentro de cada uno de los cuadros de texto el nombre que corresponde a cada animal.
                </p>
            </div>
            <div class="flex flex-col gap-4 w-full">
                <!-- Contenedor de Imágenes -->
                <div class="bg-tertiary rounded-xl shadow-lg p-5 flex flex-col gap-4 relative w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                            <!-- titulo animal 1 -->
                            <h3 class="text-primary text-lg font-bold">Animal 1</h3>

                            <img
                                class="w-36 h-36 object-contain object-center"
                                src="../../../../../public/images/lion.png"
                                alt="León"
                            />
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                            <!-- titulo animal 2 -->
                            <h3 class="text-primary text-lg font-bold">Animal 2</h3>
                            <img
                                class="w-48 h-36 object-contain object-center"
                                src="../../../../../public/images/rhino.png"
                                alt="Rinoceronte"
                            />
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                            <!-- titulo animal 3 -->
                            <h3 class="text-primary text-lg font-bold">Animal 3</h3>
                            <img
                                class="w-36 h-36 object-contain object-center"
                                src="../../../../../public/images/camel.png"
                                alt="Camello"
                            />
                        </div>
                    </div>
                </div>
                <!-- Contenedor de Inputs -->
                <div
                    class="bg-quinary rounded-xl shadow-lg p-5 flex flex-col sm:flex-row gap-4 relative w-full items-center"
                >
                    <input
                        type="text"
                        v-model="respuestas.leon"
                        @input="verificarRespuestas"
                        class="border-gray-300 focus:border-secondary focus:ring-secondary rounded-md shadow-sm w-full sm:w-1/3"
                        placeholder="Nombre Animal 1"
                    />
                    <input
                        type="text"
                        v-model="respuestas.rinoceronte"
                        @input="verificarRespuestas"
                        class="border-gray-300 focus:border-secondary focus:ring-secondary rounded-md shadow-sm w-full sm:w-1/3"
                        placeholder="Nombre Animal 2"
                    />
                    <input
                        type="text"
                        v-model="respuestas.camello"
                        @input="verificarRespuestas"
                        class="border-gray-300 focus:border-secondary focus:ring-secondary rounded-md shadow-sm w-full sm:w-1/3"
                        placeholder="Nombre Animal 3"
                    />
                </div>
            </div>
        </div>
        <!-- Contenedor del Botón -->
        <div class="w-full lg:w-48">
            <ButtonCustom
                class="w-full"
                v-if="puntuacion"
                mode="button"
                @click="deletePuntaje"
            >
                Resultado: <br />
                {{ puntuacion }}
            </ButtonCustom>
            <ButtonCustom
                class="w-full"
                v-else
                mode="button"
                @click="calcularPuntuacion"
            >
                Siguiente
            </ButtonCustom>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';
import ButtonCustom from '@/Components/ButtonCustom.vue';

// Variables reactivas
const respuestas = reactive({
    leon: '',
    rinoceronte: '',
    camello: ''
});

const puntuacion = ref(0);

const verificarRespuestas = () => {
    // Validaciones adicionales si lo deseas
};

const deletePuntaje = () => {
    puntuacion.value = 0;
};

const speachIntroduction = () => {
    const text1 =
        'Escriba el nombre de estos animales en los espacios ubicados debajo de cada imagen';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = 'es-CO';
    synthesis.speak(utterance);
};

const calcularPuntuacion = () => {
    const leonRespuesta = respuestas.leon
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');
    const rinoceronteRespuesta = respuestas.rinoceronte
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');
    const camelloRespuesta = respuestas.camello
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');

    const answers = {
        identification_answer:
            leonRespuesta + ', ' + rinoceronteRespuesta + ', ' + camelloRespuesta
    };

    let score = 0;
    if (leonRespuesta === 'leon') {
        score++;
    }
    if (rinoceronteRespuesta === 'rinoceronte') {
        score++;
    }
    if (camelloRespuesta === 'camello' || camelloRespuesta === 'dromedario') {
        score++;
    }

    axios.post('/moca/uploadIdentification', answers).catch((error) => {
        console.log('error: ', error);
    });

    puntuacion.value = score;
    emit('answer-score', puntuacion.value);
};

// Para emitir eventos
const emit = defineEmits(['answer-score']);
</script>
