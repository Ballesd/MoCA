<template>
    <div class="flex items-center justify-center space-x-12 mb-10">
        <div class="flex flex-col items-center justify-center gap-4">
            <div class="flex justify-center items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
                <h2 class="text-primary text-3xl">4. Identificación de animales</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 w-full">
                <p class="text-gray-500">Ingrese dentro de cada uno de los cuadros de texto el nombre que corresponde a cada animal.</p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="bg-tertiary rounded-xl shadow-lg p-5 flex gap-4 relative w-full">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                            <img class="w-36 h-full object-contain object-center" src="../../../../../public/images/lion.png" alt="Logo" />
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                            <img class="w-48 h-full object-contain object-center" src="../../../../../public/images/rhino.png" alt="Logo" />
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md text-center flex flex-col justify-center items-center">
                            <img class="w-36 h-full object-contain object-center" src="../../../../../public/images/camel.png" alt="Logo" />
                        </div>
                    </div>
                </div>
                <div class="bg-quinary rounded-xl shadow-lg p-5 flex gap-4 relative w-full justify-between items-center">
                    <input type="text" v-model="respuestas.leon" @input="verificarRespuestas" class="border-gray-300 focus:border-secondary focus:ring-secondary rounded-md shadow-sm w-full" />
                    <input type="text" v-model="respuestas.rinoceronte" @input="verificarRespuestas" class="border-gray-300 focus:border-secondary focus:ring-secondary rounded-md shadow-sm w-full" />
                    <input type="text" v-model="respuestas.camello" @input="verificarRespuestas" class="border-gray-300 focus:border-secondary focus:ring-secondary rounded-md shadow-sm w-full" />
                </div>
            </div>
        </div>
        <div class="w-48">
            <ButtonCustom class="w-full" v-if="puntuacion" mode="button" @click="deletePuntaje"
                >Resultado: <br />
                {{ puntuacion }}</ButtonCustom
            >
            <ButtonCustom class="w-full" v-else mode="button" @click="calcularPuntuacion">Calcular Puntaje</ButtonCustom>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
import ButtonCustom from '@/Components/ButtonCustom.vue';

// Variables reactivas
const respuestas = reactive({
    leon: '',
    rinoceronte: '',
    camello: ''
});

const puntuacion = ref(0);

// Métodos
const verificarRespuestas = () => {
    // Validaciones adicionales si lo deseas
};

const deletePuntaje = () => {
    puntuacion.value = 0;
};

const speachIntroduction = () => {
    const text1 = 'Escriba el nombre de estos animales en los inputs correspondientes comenzando de izquierda a derecha';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
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
        identification_answer: leonRespuesta + ', ' + rinoceronteRespuesta + ', ' + camelloRespuesta
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

    // Enviar datos a '/moca/uploadIdentification'
    axios.post('/moca/uploadIdentification', answers).catch((error) => {
        console.log('error: ', error);
    });

    puntuacion.value = score;
    // Emitir el evento
    // Esto asume que tienes un componente padre escuchando este evento
    emit('answer-score', puntuacion.value);
};

// Para emitir eventos
const emit = defineEmits(['answer-score']);
</script>
