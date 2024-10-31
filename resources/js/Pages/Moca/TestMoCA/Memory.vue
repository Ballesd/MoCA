<template>
    <div class="flex items-center justify-center space-x-12 mt-16 mb-10">
        <div class="w-7/12 flex flex-col gap-4">
            <div class="flex justify-center items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
                <h2 class="text-primary text-3xl">5. Memoria</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center">
                <p class="text-gray-500">Memorice estas palabras y repítalas al finalizar sin importar el orden. Solo tendrá una oportunidad de escucha.</p>
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-3 py-2" @click="" />
            </div>
            <div class="w-full">
                <ButtonCustom class="w-full" v-if="button_band" mode="button" @click="startAttempt">INICIAR INTENTO</ButtonCustom>
                <ButtonCustom class="w-full" v-else @click="removeAttempt">Intento {{ attempt }}</ButtonCustom>
            </div>
            <div v-if="!button_band && attempt < maxAttempts" class="bg-quinary rounded-md shadow-lg p-5 grid grid-cols-2 gap-4">
                <div v-for="(word, index) in words" :key="index">
                    <TextInput v-model="rememberedWords[index]" @input="removeSpaces(index)" type="text" class="block w-full" />
                </div>
                <ButtonCustom mode="button" @click="recordAttempt">REGISTRAR</ButtonCustom>
            </div>
        </div>
    </div>
</template>

<script setup>
import ButtonCustom from '@/Components/ButtonCustom.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, reactive, onMounted } from 'vue';

// Variables reactivas
const words = ['ROSTRO', 'SEDA', 'IGLESIA', 'CLAVEL', 'ROJO'];
const showAttempt = ref(false);
const attempt = ref(1);
const button_band = ref(true);
const maxAttempts = ref(3);
const rememberedWords = reactive(['', '', '', '', '']);
const answer = ['ROSTRO', 'SEDA', 'IGLESIA', 'CLAVEL', 'ROJO'];

// Para emitir eventos
const emit = defineEmits(['answer-score']);

// Métodos
const wordsbyone = () => {
    const synthesis = window.speechSynthesis;
    words.forEach((palabra) => {
        const utterance = new SpeechSynthesisUtterance(palabra);
        utterance.rate = 0.7;
        synthesis.speak(utterance);
    });
};

const speachIntroduction = () => {
    const synthesis = window.speechSynthesis;
    const text1 = 'Esta es una prueba de memoria. Le voy a leer una lista de palabras que debe recordar. Escuche con atención. Cuando acabe, dígame todas las palabras que pueda recordar. No importa el orden en el que las escriba';
    const utterance1 = new SpeechSynthesisUtterance(text1);
    utterance1.rate = 0.7;
    synthesis.speak(utterance1);

    wordsbyone();
};

const startAttempt = () => {
    button_band.value = false;
    showAttempt.value = true;
};

const recordAttempt = () => {
    // Desactivar los campos de texto
    showAttempt.value = false;
    attempt.value++;

    if (attempt.value == 2) {
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
