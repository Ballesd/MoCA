<template>
    <div class="flex items-center justify-center space-x-12 mt-16 mb-10 w-full">
        <div class="w-7/12 flex flex-col gap-4">
            <!-- Intro -->
            <div class="flex justify-start items-center space-x-3">
                <h2 class="text-primary text-3xl">6. Atención</h2>
                <font-awesome-icon v-if="!orderNumber && !inverseNumber && !countAleter && !sevenMinusSeven"
                    :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary"
                    @click="speachIntroduction" />
                <font-awesome-icon v-if="!heard_audio1 && countAleter && !sevenMinusSeven" :icon="['fas', 'volume-up']"
                    size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="countAleterSpeach" />
                <font-awesome-icon v-if="!heard_audio2 && countAleter && sevenMinusSeven" :icon="['fas', 'volume-up']"
                    size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="audioSevenMinus" />
            </div>
            <div v-if="!orderNumber">
                <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center">
                    <p class="text-gray-500 text-center">A continuación deberá completar 3 tareas, las cuales tendrán
                        audio incorporado. Recuerde que solo tendrá una oportunidad para reproducirlos.</p>
                </div>
                <div class="w-full mt-4">
                    <ButtonCustom class="w-full" mode="button" :disabled="buttonState" @click="startNumberTest">INICIAR
                        LAS PRUEBAS DE NÚMEROS</ButtonCustom>
                </div>
            </div>
            <!-- / Intro -->
            <div v-if="repeatNumeber">
                <!-- Orden de numeros -->
                <div v-if="orderNumber && !inverseNumber" class="flex flex-col items-center gap-4 w-full">
                    <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                        <p class="text-gray-500">Oprima el botón para reproducir el primer audio.</p>
                        <font-awesome-icon v-if="!heard_audio1" :icon="['fas', 'volume-up']" size="2x"
                            class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-3 py-2"
                            @click="speachFirstSeries" />
                    </div>
                    <p class="flex justify-center text-gray-500">Ingrese la primera serie de numeros en el mismo orden
                    </p>
                    <div class="flex justify-center">
                        <div class="grid grid-cols-5 gap-7">
                            <div v-for="(number, index) in orderNumbers" :key="index">
                                <TextInput v-model="answerOrder[index]" :ref="el => inputFields[index] = el"
                                    maxlength="1" class="h-12 w-12 text-center text-xl text-gray-600"
                                    @input="handleInput(index)" />
                            </div>
                        </div>
                    </div>
                    <ButtonCustom class="w-1/3 mt-4" mode="button" @click="recordAttemptOrder">SIGUIENTE</ButtonCustom>
                </div>
                <!-- /Orden de numeros -->
                <!-- Orden de numeros al inverso -->
                <div v-if="inverseNumber && orderNumber" class="flex flex-col items-center gap-4 w-full">
                    <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                        <p class="text-gray-500">Oprima el botón para reproducir el segundo audio.</p>
                        <font-awesome-icon v-if="!heard_audio3" :icon="['fas', 'volume-up']" size="2x"
                            class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-3 py-2"
                            @click="speachSecondSeries" />
                    </div>
                    <p class="flex justify-center text-gray-500">Ingrese la segunda serie de numeros en orden inverso
                    </p>
                    <div class="flex justify-center">
                        <div class="grid grid-cols-3 gap-7">
                            <div v-for="(number, index) in InverseNumbers" :key="index">
                                <TextInput 
                                    v-model="answerInverse[index]" :ref="el => inputFields[index] = el"
                                    maxlength="1"
                                    class="h-12 w-12 text-center text-xl text-gray-600" 
                                    @input="handleInputInverse(index)"
                                    />
                                </div>
                        </div>
                    </div>
                    <ButtonCustom class="w-1/3 mt-4" mode="button" @click="recordAttemptOrderInve">SIGUIENTE
                    </ButtonCustom>
                </div>
                <!-- /Orden de numeros al inverso -->
            </div>
            <!-- Golpear por cada letra A -->
            <div v-if="strikestate" class="flex flex-col items-center gap-4 w-full">
                <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-center w-full">
                    <p class="text-gray-500 text-justify">Ingrese la cantidad de toques finales por la letra A:</p>
                    <font-awesome-icon v-if="!heard_audio2" :icon="['fas', 'volume-up']" size="2x"
                        class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-3 py-2"
                        @click="countAleterSpeach" />
                </div>
                <TextInput v-model="word" type="number" class="w-24" />
                <ButtonCustom class="w-1/3 mt-4" mode="button" @click="letterACount">SIGUIENTE</ButtonCustom>
            </div>
            <!-- / Golpear por cada letra A -->
            <!-- Desde 100 restado de 7 en 7 -->
            <div v-if="sevenMinSeven" class="flex flex-col items-center gap-4 w-full">
                <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                    <p class="text-gray-500">Va a restar de 7 en 7 desde 100. Por ejemplo, ¿cuánto es 100 menos 7?</p>
                </div>
                <TextInput type="number" v-model="valuRest" class="w-24" />
                <p class="flex justify-center text-gray-500 text-center">Digite el número en el cuadro de texto y oprima
                    la flecha de abajo para escribir el siguiente número.</p>
                <ButtonCustom class="w-1/3 mt-4" mode="button" @click="restNumber">SIGUIENTE</ButtonCustom>
            </div>
            <!-- / Desde 100 restado de 7 en 7 -->
            <div v-if="totalscoreState">
                <p class="text-gray-500 text-center text-xl">Puntaje: {{ totalScore }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import ButtonCustom from '@/Components/ButtonCustom.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps, nextTick } from 'vue';
import axios from 'axios';

const { sendNumber } = defineProps(['sendNumber']);

const buttonState = ref(false);
const heard_audio1 = ref(false);
const heard_audio2 = ref(false);
const heard_audio3 = ref(false);
const repeatNumeber = ref(true);
const orderNumber = ref(false);
const orderNumbers = ref([2, 1, 8, 5, 4]);
const answerOrder = ref([]);
const inputFields = ref([]); // Array to hold references to input fields
const scoreNumbers = ref(0);

const inverseNumber = ref(false);
const InverseNumbers = ref([2, 4, 7]);
const answerInverse = ref([]);
const scoreInverse = ref(0);

const strikestate = ref(false);
const word = ref(0);
const countCorrectStrake = ref(0);
const scoreStrike = ref(0);
const valueRestLog = ref('');

const sevenMinSeven = ref(false);
const valueStart = ref(100);
const valuRest = ref();
const countCorrect = ref(0);
const incorrectRest = ref(0);

const totalScore = ref(0);
const totalscoreState = ref(false);


const countAleter = ref(false);
const sevenMinusSeven = ref(false);

const speachIntroduction = () => {  //Audio introducción
    const text1 = 'A continuación deberá completar 3 tareas, las cuales tendrán audio incorporado. Recuerde que solo tendrá una oportunidad para reproducirlos';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);

};
const speachFirstSeriesInstruction = () => {  //Instrucción Primer ejercicio Sección 6
    const text1 = 'Le voy a leer una serie de números y, cuando haya terminado, deberá escribirlos en el mismo orden en el que yo los he dicho. La primera serie es: 2,  1,  8,  5,  4.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
    heard_audio1.value = true;

};
const speachFirstSeries = () => {  //Audio del Primer ejercicio Sección 6
    const text1 = 'Le voy a leer una serie de números y, cuando haya terminado, deberá escribirlos en el mismo orden en el que yo los he dicho. La primera serie es: 2,  1,  8,  5,  4.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
    heard_audio1.value = true;

};

const speachSecondSeriesInstruction = () => {  //Instrucción Segundo ejercicio Sección 6
    const text1 = 'Le voy a leer una serie de números y, cuando haya terminado, deberá escribirlos en el mismo orden en el que yo los he dicho. La primera serie es: 2,  1,  8,  5,  4.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
    heard_audio1.value = true;

};
const speachSecondSeries = () => {  //Audio del segundo ejercicio Sección 6

    const text2 = 'Ahora le voy a leer otra serie de números y, cuando haya terminado, deberá escribirlos en orden inverso al que yo los he dicho. La segunda serie es: 7,  4,  2.';
    const synthesis1 = window.speechSynthesis;
    const utterance1 = new SpeechSynthesisUtterance(text2);
    utterance1.rate = 0.7; // Ajusta este valor para cambiar la velocidad
    utterance1.lang = "es-CO"
    synthesis1.speak(utterance1);
    heard_audio3.value = true;

}

const countAleterSpeach = () => {
    const text1 = 'Ingrese la cantidad de golpes por la letra A elaborada por el paciente.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
    heard_audio2.value = true;
};

const startNumberTest = () => {
    buttonState.value = true;
    orderNumber.value = true;
};

const recordAttemptOrder = () => {
    if (answerOrder.value.toString() == orderNumbers.value.toString()) {
        scoreNumbers.value = 1;
    } else {
        scoreNumbers.value = 0;
    }
    inverseNumber.value = true;
};

const recordAttemptOrderInve = () => {
    if (answerInverse.value.toString() == InverseNumbers.value.toString()) {
        scoreInverse.value = 1;
    } else {
        scoreInverse.value = 0;
    }
    repeatNumeber.value = false;
    strikestate.value = true;
    countAleter.value = true;
};
const audioSevenMinus = () => {
    const text1 = 'Ahora reste de 7 en 7 empezando desde 100, ponga el resultado en el input y oprima siguiente.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
};

const letterACount = () => {
    sevenMinusSeven.value = true;
    sevenMinSeven.value = true;
    strikestate.value = false;
};

const restNumber = () => {
    valueRestLog.value = valueRestLog.value + ', ' + valuRest.value;
    let diference = valueStart.value - valuRest.value;
    if (diference === 7) {
        if (valueStart.value <= 2) {
            sevenMinSeven.value = false;
            totalscoreState.value = true;
        }
        countCorrect.value += 1;
        valueStart.value -= 7;
    } else if (incorrectRest.value < 1 && diference != 7) {
        incorrectRest.value += 1;
    } else if (diference != 7 || valueStart.value <= 2) {
        sevenMinSeven.value = false;
        totalscoreState.value = true;
        if (countCorrect.value >= 4) {
            totalScore.value += 3 + scoreNumbers.value + scoreInverse.value + scoreStrike.value;
        } else if (countCorrect.value >= 2) {
            totalScore.value += 2 + scoreNumbers.value + scoreInverse.value + scoreStrike.value;
        } else if (countCorrect.value >= 1) {
            totalScore.value += 1 + scoreNumbers.value + scoreInverse.value + scoreStrike.value;
        }
        const answer = {
            attention_answer: 'Respuesta números: ' + answerOrder.value + '.' + ' - Respuesta inversa: ' + answerInverse.value + '.' + ' - Golpes por A: ' + word.value + '.' + ' - Resta de 7 en 7: ' + valueRestLog.value
        };

        const response = axios.post('/moca/uploadAttention', answer);

        sendNumber(totalScore.value);
    } else {
        incorrectRest.value += 1;
    }
    valuRest.value = '';
};

const handleInput = (index) => {
    if (answerOrder.value[index].length === 1) {
        nextTick(() => {
            const nextIndex = index + 1;
            if (nextIndex < orderNumbers.value.length) {
                const nextInput = inputFields.value[nextIndex];
                if (nextInput) {
                    nextInput.focus();
                }
            }
        });
    }
};

const handleInputInverse = (index) => {
    if (answerInverse.value[index].length === 1) {
        nextTick(() => {
            const nextIndex = index + 1;
            if (nextIndex < InverseNumbers.value.length) {
                const nextInput = inputFields.value[nextIndex];
                if (nextInput) {
                    nextInput.focus();
                }
            }
        });
    }
};  
</script>
