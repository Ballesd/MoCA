<template>
    <div class="flex items-center justify-center space-x-12 my-12">
        <div class="w-7/12 flex flex-col items-center justify-center gap-4">
            <div class="flex justify-start items-center space-x-3 self-start">
                <font-awesome-icon @click="speachIntroduction" :icon="['fas', 'volume-up']" size="2x"
                    class="text-secondary cursor-pointer hover:text-primary" />
                <h2 class="text-primary text-3xl">8. Fluidez verbal</h2>
            </div>
            <div v-if="showLetter"
                class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                <p class="text-base sm:text-lg">Diga todas las palabras que se le ocurran, sin incluir nombres propios, de
                    personas o lugares que empiecen con la letra P.</p>
            </div>
            <div v-if="!showLetter"
                class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                <p class="text-base sm:text-lg">Diga todas las palabras que se le ocurran, sin incluir nombres propios, de
                    personas o lugares que empiecen con la letra dicha anteriormente.</p>
            </div>
            <p v-if ="isRemembering" class="flex justify-center text-3xl">La letra es la P</p>


            <ButtonCustom v-if="resultState && timeLeft > 0" mode="button" @click="startRecording"
                :disabled="isRecording">{{ isRecording ? `${timeLeft} s` : 'COMENZAR' }}
            </ButtonCustom>
            <div v-if="resultState" v-text="transcript" class="flex justify-center text-gray-500"></div>
            <ButtonCustom v-if="rememberButton" mode="button" @click="rememberLetter">¿Olvidó la letra?
            </ButtonCustom>
            <ButtonCustom v-if="timeLeft === 0" mode="button" @click="evaluar">SIGUIENTE</ButtonCustom>
            <div v-if="!resultState" v-text="`Puntuación: ${score}`" class="flex justify-center text-gray-500"></div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, defineProps } from 'vue';
import axios from 'axios';
import ButtonCustom from '@/Components/ButtonCustom.vue';

const { sendNumber } = defineProps(['sendNumber']);

const transcript = ref('');
const wordsVec = ref([]);
const wordsWithP = ref([]);
const result = ref(0);
const resultState = ref(true);
const isRecording = ref(false);
const timeLeft = ref(60);
const score = ref(0);
const showLetter = ref(true);
const isRemembering = ref(false);
const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const sr = new Recognition();
const a = ref(0);
const rememberButton = ref(false);

let timerId;

const startRecording = () => {
    showLetter.value = false;
    rememberButton.value = true;
    if (!isRecording.value && timeLeft.value > 0) {
        isRecording.value = true;
        sr.start();
        countDown();
    } else {
        stopRecording();
    }
};

const stopRecording = () => {
    isRecording.value = false;
    sr.stop();
    clearTimeout(timerId);
};

const countDown = () => {
    if (timeLeft.value > 0) {
        timeLeft.value--;
        timerId = setTimeout(countDown, 1000);
    } else {
        stopRecording();
    }
};

const speachIntroduction = () => {
    const text1 =
        'Para la prueba de fluidez verbal, necesitaremos que diga el mayor número de palabras posibles que comiencen por la letra P. No se permiten nombres, números y las formas conjugadas de un verbo. ¿Está preparado? Cuando se sienta preparado, pulse el botón de comenzar.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
};

const rememberLetter = () => {
    
    isRemembering.value = true;

    setTimeout(() => {
        isRemembering.value = false;
        rememberButton.value = false;
    }, 3000);
};

onMounted(() => {
    sr.lang = 'es-CO';
    sr.continuous = true;
    sr.interimResults = true;

    sr.onstart = () => {
        console.log('Recognition Started');
    };

    sr.onend = () => {
        console.log('Recognition Stopped');
    };

    sr.onresult = (evt) => {
        for (let i = 0; i < evt.results.length; i++) {
            const result = evt.results[i];
            transcript.value = result[0].transcript;
            if (result.isFinal) {
                const words = result[0].transcript.split(' ');
                for (const word of words) {
                    wordsVec.value.push(word);
                    if (word.toLowerCase().startsWith('p')) {
                        wordsWithP.value.push(word);
                    }
                }
            }
        }
    };

    sr.onerror = (event) => {
        console.error('Error en el reconocimiento de voz:', event.error);
    };
});
const evaluar = () => {
    const words = wordsVec.value.filter((item, index) => wordsVec.value.indexOf(item) === index);
    console.log(words);
    const wordsWithPFilt = wordsWithP.value.filter((item, index) => wordsWithP.value.indexOf(item) === index);
    result.value = wordsWithPFilt.length;
    resultState.value = false;

    
    if (result.value >= 11) {
        score.value = 1;
    }

    //recorremos el array de palabras y las guardamos en un string
    const wordsString = words.join(', ');

    const answer = {
        verbal_fluency_answer: wordsString
    };
    axios.post('/moca/uploadVerbalFluency', answer).catch((error) => {
        console.log(error);
    });
    sendNumber(score.value);
};

onBeforeUnmount(() => {
    sr.stop();
    sr.onstart = null;
    sr.onend = null;
    sr.onresult = null;
    sr.onerror = null;
});
</script>
