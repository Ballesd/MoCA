<template>
    <div class="flex flex-col lg:flex-row items-center justify-center lg:space-x-12 space-y-6 lg:space-y-0 mt-16 mb-10 px-4">
        <!-- Contenedor Principal -->
        <div class="w-full lg:w-7/12 flex flex-col gap-5">
            <div class="flex items-center space-x-3">
                <font-awesome-icon
                    :icon="['fas', 'volume-up']"
                    size="2x"
                    class="text-secondary cursor-pointer hover:text-primary"
                    @click="speachIntroduction1"
                />
                <h2 class="text-primary text-xl sm:text-2xl md:text-3xl text-center lg:text-left">
                    5. Memoria
                </h2>
            </div>

            <div v-if="attempt==0"  class="border-2 border-gray-400 rounded-lg p-4 flex flex-col sm:flex-row items-center gap-6">
                <p class="text-base sm:text-lg text-justify hyphens-auto sm:hyphens-none">Esta es una prueba de memoria. Presione el botón para escuchar atentamente las palabras y, luego, escríbalas en los recuadros inferiores según las que recuerde, sin importar el orden. Solo tendrá una oportunidad de escucha.</p>
                <font-awesome-icon v-if="!heard_audio" :icon="['fas', 'volume-up']" size="2x" class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-4 py-2" @click="speachIntroduction2" />
            </div>
            <div v-if="attempt==1"  class="border-2 border-gray-400 rounded-lg p-4 flex flex-col sm:flex-row items-center gap-6">
                <p class="text-base sm:text-lg text-justify hyphens-auto sm:hyphens-none">Este es un segundo intento. Presione nuevamente el botón para repetir las palabras e ingréselas en las entradas de texto. Recuerde que el orden no importa.</p>
                <font-awesome-icon v-if="!heard_audio" :icon="['fas', 'volume-up']" size="2x" class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-4 py-2" @click="speachIntroduction3" />

            </div>

            <!-- Entradas de Texto -->
            <div
                v-if="!button_band && attempt < maxAttempts"
                class="bg-quinary rounded-md shadow-lg p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
            >
                <div v-for="(word, index) in words" :key="index">
                    <TextInput
                        v-model="rememberedWords[index]"
                        @input="removeSpaces(index)"
                        type="text"
                        class="block w-full"
                    />
                </div>
                <div class="sm:col-span-2 lg:col-span-3 flex justify-center">
                    <ButtonCustom mode="button" @click="recordAttempt">REGISTRAR INTENTO</ButtonCustom>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ButtonCustom from '@/Components/ButtonCustom.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, reactive } from 'vue';

// Variables reactivas
const words = ['ROSTRO', 'SEDA', 'IGLESIA', 'CLAVEL', 'ROJO'];
const showAttempt = ref(false);
const attempt = ref(0);
const heard_audio = ref(false);
const button_band = ref(true);
const maxAttempts = ref(3);
const rememberedWords = reactive(['', '', '', '', '']);

const emit = defineEmits(['answer-score']);

const speachIntroduction1 = () => {
    const synthesis = window.speechSynthesis;
    const text1 =
        'Esta es una prueba de memoria. Le voy a leer una lista de palabras que debe recordar. Escuche con atención. Cuando acabe, escriba en los espacios todas las palabras que pueda recordar. No importa el orden en el que las escriba';
    const utterance1 = new SpeechSynthesisUtterance(text1);
    utterance1.rate = 0.7;
    utterance1.lang = 'es-CO';
    synthesis.speak(utterance1);
};

const speachIntroduction2 = () => {
    const synthesis = window.speechSynthesis;
    const text1 = 'Las palabras son: ROSTRO, Seda, Iglesia, Clavel, Rojo';
    const utterance1 = new SpeechSynthesisUtterance(text1);
    utterance1.rate = 0.6;
    utterance1.lang = 'es-CO';
    synthesis.speak(utterance1);
    heard_audio.value = true;
    utterance1.onend = () => {
        startAttempt();
    };
};

const speachIntroduction3 = () => {
    const synthesis = window.speechSynthesis;
    const text1 = 'Este es un segundo intento. Las palabras son: ROSTRO, Seda, Iglesia, Clavel, Rojo';
    const utterance1 = new SpeechSynthesisUtterance(text1);
    utterance1.rate = 0.6;
    utterance1.lang = "es-CO" 
    synthesis.speak(utterance1);
    heard_audio.value = true;
    utterance1.onend = () => {
        startAttempt();
    };

};

const startAttempt = () => {
    button_band.value = false;
    showAttempt.value = true;
};

const recordAttempt = () => {
    attempt.value++;
    if (attempt.value == 1) {
        heard_audio.value = false;
        removeAttempt();
    } else if (attempt.value == 2) {
        emit('answer-score', 0);
    }
};

const removeSpaces = (index) => {
    rememberedWords[index] = rememberedWords[index].trim();
};

const removeAttempt = () => {
    button_band.value = true;
    rememberedWords.forEach((word, index) => {
        rememberedWords[index] = '';
    });
    showAttempt.value = false;
    attempt.value = 1;
};
</script>
