<template>
    <div class="flex items-center justify-center space-x-12 mb-4">
        <div class=" w-4/5 sm:w-8/12  flex flex-col items-center justify-center gap-4">
            <div class="flex justify-start items-center space-x-3 self-start">
                <font-awesome-icon @click="speachIntroduction" :icon="['fas', 'volume-up']" size="2x"
                    class="text-secondary cursor-pointer hover:text-primary" />
                <h2 class="text-primary text-2xl sm:text-3xl">9. Abstracción</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                <p class="text-base sm:text-lg text-justify hiphens-auto sm:hyphens-none">
                    En cada uno de los cuadros de texto ingrese el concepto que tienen en común
                    cada pareja de palabras. Por ejemplo, si la pareja de palabras es "Manzana - Naranja", el concepto en común es "Frutas".
                </p>
            </div>

            
            
            <div class="w-full sm:w-1/2 px-2">
                <InputLabel class="text-xl" for="2" value="Tren - Bicicleta" />
                <TextInput id="2" v-model="respuestaPregunta1" @input="calificarPregunta1" class="mt-1 block w-full" />
            </div>
            <div class="w-full sm:w-1/2 px-2">
                <InputLabel class="text-xl" for="3" value="Reloj - Regla" />
                <TextInput id="3" v-model="respuestaPregunta2" @input="calificarPregunta2" class="mt-1 block w-full" />
            </div>

            <ButtonCustom class="w-full sm:w-1/2 mt-4 px-2" mode="button" @click="calcularPuntuacion">
                Siguiente
            </ButtonCustom>

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
const puntuacionPregunta1 = ref(null);
const puntuacionPregunta2 = ref(null);
const puntuacionTotal = ref(null);

const emit = defineEmits(['answer-score']);

// Función para normalizar strings
const normalizeString = (str) => {
    return str
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase();
};

const speachIntroduction = () => {
    const text1 = 'En cada uno de los cuadros de texto ingrese el concepto que tienen en común cada pareja de palabras.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);

};


const calificarPregunta1 = () => {
    if (normalizeString(respuestaPregunta1.value) === normalizeString('medios de transporte')) {
        puntuacionPregunta1.value = 'Correcto';
    } else {
        puntuacionPregunta1.value = 'Incorrecto';
    }
};

const calificarPregunta2 = () => {
    if (normalizeString(respuestaPregunta2.value) === normalizeString('instrumentos de medición')) {
        puntuacionPregunta2.value = 'Correcto';
    } else {
        puntuacionPregunta2.value = 'Incorrecto';
    }
};

// Función para calcular la puntuación total
const calcularPuntuacion = () => {
    let total = 0;

    if (puntuacionPregunta1.value === 'Correcto') {
        total++;
    }

    if (puntuacionPregunta2.value === 'Correcto') {
        total++;
    }

    puntuacionTotal.value = total;

    const answer = {
        abstraction_answer: 'tren/bicicleta: ' + respuestaPregunta1.value + ', -regla/reloj: ' + respuestaPregunta2.value
    };

    axios.post('/moca/uploadAbstraction', answer).catch((error) => {
        console.log(error);
    });
    // Emitir el resultado usando el composable emit
    emit('answer-score', puntuacionTotal.value);
};
</script>
