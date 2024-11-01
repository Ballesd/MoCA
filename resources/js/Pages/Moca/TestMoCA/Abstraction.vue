<template>
    <div class="flex items-center justify-center space-x-12 mb-4">
        <div class="w-8/12 flex flex-col items-center justify-center gap-4">
            <div class="flex justify-start items-center space-x-3 self-start">
                <font-awesome-icon @click="" :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" />
                <h2 class="text-primary text-3xl">9. Abstracción</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                <p class="text-gray-500">En cada uno de los cuadros de texto ingrese el concepto que tienen en común cada pareja de palabras.</p>
            </div>
            <div class="w-1/2">
                <InputLabel for="1" value="Manzana - Naranja" />
                <TextInput id="1" v-model="respuestaPregunta1" @input="calificarPregunta1" class="mt-1 block w-full" />
            </div>
            <div class="w-1/2">
                <InputLabel for="1" value="Tren - Bicicleta" />
                <TextInput id="1" v-model="respuestaPregunta2" @input="calificarPregunta2" class="mt-1 block w-full" />
            </div>
            <div class="w-1/2">
                <InputLabel for="1" value="Reloj - Regla" />
                <TextInput id="1" v-model="respuestaPregunta3" @input="calificarPregunta3" class="mt-1 block w-full" />
            </div>
            <ButtonCustom class="w-1/2 mt-2" mode="button" @click="calcularPuntuacion">Enviar Respuestas</ButtonCustom>
            <div class="mt-2" v-if="puntuacionPregunta1 !== null && puntuacionPregunta2 !== null && puntuacionPregunta3 !== null">
                <h2 class="text-lg font-semibold mb-2">Resultados:</h2>
                <p>Pregunta 1: {{ puntuacionPregunta1 }}</p>
                <p>Pregunta 2: {{ puntuacionPregunta2 }}</p>
                <p>Pregunta 3: {{ puntuacionPregunta3 }}</p>
                <p class="text-xl font-bold mt-2">Puntuación Total: {{ puntuacionTotal }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import ButtonCustom from '@/Components/ButtonCustom.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

// Variables reactivas
const respuestaPregunta1 = ref('');
const respuestaPregunta2 = ref('');
const respuestaPregunta3 = ref('');
const puntuacionPregunta1 = ref(null);
const puntuacionPregunta2 = ref(null);
const puntuacionPregunta3 = ref(null);
const puntuacionTotal = ref(null);

const emit = defineEmits(['answer-score']);

// Función para normalizar strings
const normalizeString = (str) => {
    return str
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase();
};

// Funciones para calificar preguntas
const calificarPregunta1 = () => {
    if (normalizeString(respuestaPregunta1.value) === normalizeString('frutas')) {
        puntuacionPregunta1.value = 'Correcto';
    } else {
        puntuacionPregunta1.value = 'Incorrecto';
    }
};

const calificarPregunta2 = () => {
    if (normalizeString(respuestaPregunta2.value) === normalizeString('medios de transporte')) {
        puntuacionPregunta2.value = 'Correcto';
    } else {
        puntuacionPregunta2.value = 'Incorrecto';
    }
};

const calificarPregunta3 = () => {
    if (normalizeString(respuestaPregunta3.value) === normalizeString('instrumentos de medición')) {
        puntuacionPregunta3.value = 'Correcto';
    } else {
        puntuacionPregunta3.value = 'Incorrecto';
    }
};

// Función para calcular la puntuación total
const calcularPuntuacion = () => {
    let total = 0;

    if (puntuacionPregunta2.value === 'Correcto') {
        total++;
    }

    if (puntuacionPregunta3.value === 'Correcto') {
        total++;
    }

    puntuacionTotal.value = total;

    const answer = {
        abstraction_answer: 'naranja/plátano: ' + respuestaPregunta1.value + ', -tren/bicicleta: ' + respuestaPregunta2.value + ', -regla/reloj: ' + respuestaPregunta3.value
    };

    axios.post('/moca/uploadAbstraction', answer).catch((error) => {
        console.log(error);
    });
    // Emitir el resultado usando el composable emit
    emit('answer-score', puntuacionTotal.value);
};
</script>
