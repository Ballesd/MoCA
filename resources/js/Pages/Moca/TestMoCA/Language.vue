<template>
    <div class="flex items-center justify-center space-x-12 my-5">
        <div class="w-9/12 flex flex-col items-center gap-4">
            <div class="flex justify-start items-center space-x-3">
                <font-awesome-icon @click="speachIntroduction" :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" />
                <h2 class="text-primary text-3xl">7. Lenguaje</h2>
            </div>

            <!-- Primer Frase y audio -->

            <div class="border-2 border-gray-400 rounded-lg p-4 gap-6 flex flex-col sm:flex-row items-center justify-between w-full">
                <p class="text-base sm:text-lg text-justify">Presione el botón para reproducir el audio y de click en "Grabar Frase 1" para grabar la misma frase. Solo podrá hacerlo una vez.</p>
                <font-awesome-icon v-if = "!heard_audio1" @click="speachFirst" :icon="['fas', 'volume-up']" size="2x" class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-3 py-2" />
                
            </div>

            <ButtonCustom v-if="firstaudio" mode="button" @click="ToggleMic1">{{ isRecording1 ? 'DETENER' : 'GRABAR FRASE 1' }}</ButtonCustom>

            <div v-text="transcript1" class="flex justify-center text-base sm:text-lg mb-4"></div>
            
            <!-- Segunda Frase y audio -->

            <div class="border-2 border-gray-400 rounded-lg p-4 gap-6 flex flex-col sm:flex-row items-center justify-between w-full">
                <p class="text-base sm:text-lg">Presione nuevamente el botón para reproducir el audio y presione "Grabar Frase 2" para grabar la frase 2.</p>
                <font-awesome-icon v-if="stateSecondAudio && !heard_audio2" @click="speachSecond" :icon="['fas', 'volume-up']" size="2x" class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-3 py-2" />
            </div>

            <ButtonCustom  v-if="secondaudio" mode="button" @click="ToggleMic2">{{ isRecording2 ? 'DETENER' : 'GRABAR FRASE 2' }}</ButtonCustom>
            
            <div v-text="transcript2" class="flex justify-center text-base sm:text-lg  mb-4"></div>
            <ButtonCustom v-if="transcript1 && transcript2" class="w-full" mode="button" @click="evaluar">SIGUIENTE</ButtonCustom>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, defineProps } from 'vue';
import axios from 'axios';
import ButtonCustom from '@/Components/ButtonCustom.vue';

const { sendNumber } = defineProps(['sendNumber']);

const transcript1 = ref('');

const result = ref(0);
const phrase1 = ref(' El gato se esconde bajo el sofá cuando los perros entran en la sala.');
const phrase2 = ref('Espero que él le entregue el mensaje una vez que ella se lo pida.');
const transcript2 = ref('');
const isRecording1 = ref(false);
const isRecording2 = ref(false);
const firstaudio = ref(true);
const secondaudio = ref(false);
const a = ref(0);
const heard_audio1 = ref(false);
const heard_audio2 = ref(false);

const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const sr1 = new Recognition();
const sr2 = new Recognition();

const stateSecondAudio = ref(false);

onMounted(() => {
    sr1.lang = 'es-CO';
    sr2.lang = 'es-CO';

    sr1.continuous = true;
    sr1.interimResults = true;

    sr1.onstart = () => {
        console.log('SR1 Started');
        isRecording1.value = true;
    };

    sr1.onend = () => {
        console.log('SR1 Stopped');
        isRecording1.value = false;
    };

    sr1.onresult = (evt) => {
        for (let i = 0; i < evt.results.length; i++) {
            const result = evt.results[i];

            if (result.isFinal) {
                transcript1.value = result[0].transcript;
            }
        }
    };

    sr1.onerror = (event) => {
        console.error('Error en el reconocimiento de voz 1:', event.error);
    };

    // Configurar el segundo reconocimiento de voz
    sr2.continuous = true;
    sr2.interimResults = true;

    sr2.onstart = () => {
        console.log('SR2 Started');
        isRecording2.value = true;
    };

    sr2.onend = () => {
        console.log('SR2 Stopped');
        isRecording2.value = false;
    };

    sr2.onresult = (evt) => {
        for (let i = 0; i < evt.results.length; i++) {
            const result = evt.results[i];

            if (result.isFinal) {
                transcript2.value = result[0].transcript;
            }
        }
    };

    sr2.onerror = (event) => {
        console.error('Error en el reconocimiento de voz 2:', event.error);
    };
});

const speachIntroduction = () => {
    const text1 = 'En esta sección se evaluará su capacidad para escuchar y repetir frases. Por favor, dele clic al botón y escuche la instrucción.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6;
    utterance.lang = "es-CO" 
    synthesis.speak(utterance);
};

const speachFirst = () => {
    const text1 = 'Ahora le voy a leer una frase. Dele clic al botón y repítala. Cuando termine de repetirla, dele click al botón nuevamente para detener la grabación. La frase es: ';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6;
    utterance.lang = "es-CO" 
    synthesis.speak(utterance);

    const text2 = 'El gato se esconde bajo el sofá cuando los perros entran en la sala.';
    const synthesis1 = window.speechSynthesis;
    const utterance1 = new SpeechSynthesisUtterance(text2);
    utterance1.rate = 0.5;
    utterance1.lang = "es-CO" 
    synthesis1.speak(utterance1);
    heard_audio1.value = true;
};

const speachSecond = () => {
    const text1 = 'Ahora le voy a leer otra frase. Dele clic al botón y repítala. Cuando termine de repetirla, dele click al botón nuevamente para detener la grabación. La frase es: ';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6;
    utterance.lang = "es-CO" 
    synthesis.speak(utterance);

    const text2 = 'Espero que él le entregue el mensaje una vez que ella se lo pida.';
    const synthesis1 = window.speechSynthesis;
    const utterance1 = new SpeechSynthesisUtterance(text2);
    utterance1.rate = 0.5;
    utterance1.lang = "es-CO" 
    synthesis1.speak(utterance1);
    heard_audio2.value = true;
};

const evaluar = () => {
    const answer = {
        language_answer: 'Frase 1: ' + transcript1.value + ', ' + 'Frase 2: ' + transcript2.value
    };

    if (transcript1.value === phrase1.value) {
        result.value += 1;
    }
    if (transcript2.value === phrase2.value) {
        result.value += 1;
    }
    if (result.value > 2) {
        result.value = 2;
    }
    console.log('resultado total', result.value);
    //'/moca/uploadLanguage'
    axios.post('/moca/uploadLanguage', answer).catch((error) => {
        console.log(error);
    });
    sendNumber(result.value);
};

const ToggleMic1 = () => {
    if (isRecording1.value) {
        sr1.stop();
        firstaudio.value = false;
        stateSecondAudio.value = true;
        secondaudio.value = true;
    } else {
        setTimeout(() => {
            sr1.start();
        }, 500);
    }
};

const ToggleMic2 = () => {
    if (isRecording2.value) {
        sr2.stop();
        secondaudio.value = false;
    } else {
        setTimeout(() => {
            sr2.start();
        }, 500);
    }
};

onBeforeUnmount(() => {
    sr1.stop();
    sr1.onstart = null;
    sr1.onend = null;
    sr1.onresult = null;
    sr1.onerror = null;

    sr2.stop();
    sr2.onstart = null;
    sr2.onend = null;
    sr2.onresult = null;
    sr2.onerror = null;
});
</script>
