<template>
    <div class="flex items-center justify-center space-x-12 mt-16 mb-10 w-full">
        <div class="w-7/12 flex flex-col gap-4">
            <!-- Intro -->
            <div class="flex justify-center items-center space-x-3 pb-3">
                <font-awesome-icon v-if="!final && !orderNumber && !inverseNumber && !countAleter && !sevenMinSeven"
                    :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary"
                    @click="speachIntroduction" />
                <font-awesome-icon v-if="!final && orderNumber && !inverseNumber && !countAleter && !sevenMinSeven"
                    :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary"
                    @click="speachFirstSeriesInstruction" />
                <font-awesome-icon v-if="!final && orderNumber && inverseNumber && !countAleter && !sevenMinSeven"
                    :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary"
                    @click="speachSecondSeriesInstruction" />
                <font-awesome-icon v-if="!final && countAleter && !sevenMinSeven" :icon="['fas', 'volume-up']" size="2x"
                    class="text-secondary cursor-pointer hover:text-primary" @click="countAleterSpeachInstruction" />
                <font-awesome-icon v-if="!final && sevenMinSeven" :icon="['fas', 'volume-up']" size="2x"
                    class="text-secondary cursor-pointer hover:text-primary" @click="audioSevenMinus" />

                <h2 v-if="!final" class="text-primary text-2xl sm:text-3xl">6. Atención</h2>


            </div>
            <div v-if="!orderNumber">
                <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center">
                    <p class="text-base sm:text-lg text-justify">A continuación deberá completar 3 tareas, las cuales
                        tendrán audio incorporado. Recuerde que solo tendrá una oportunidad para reproducir cada audio.
                    </p>
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
                    <div
                        class="border-2 border-gray-400 rounded-lg p-4 gap-6 flex flex-col sm:flex-row items-center justify-between w-full ">
                        <p class="text-base sm:text-lg text-justify">
                            Le voy a leer una serie de números y, cuando haya terminado,
                            deberá escribirlos en el mismo orden en el que yo los he dicho.
                            Oprima el botón para reproducir la serie de números.
                        </p>
                        <font-awesome-icon v-if="!heard_audio1" :icon="['fas', 'volume-up']" size="2x"
                            class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-4 py-2"
                            @click="speachFirstSeries" />
                    </div>

                    <p v-if="first_series_field" class="flex justify-center text-base sm:text-lg font-semibold text-justify">
                        Ingrese la primera
                        serie de
                        numeros en el mismo orden.
                    </p>
                    <div v-if="first_series_field" class="flex justify-center">
                        <div class="grid grid-cols-5 gap-3">
                            <div v-for="(number, index) in orderNumbers" :key="index">
                                <TextInput v-model="answerOrder[index]" :ref="el => inputFields[index] = el"
                                    maxlength="1" class=" h-10 w-10  sm:h-12 sm:w-12 text-center text-xl" @input="handleInput(index)" />
                            </div>
                        </div>
                    </div>

                    <ButtonCustom v-if="first_series_field" class="w-full sm:w-1/2 md:w-1/3 mt-4" mode="button"
                        @click="recordAttemptOrder">SIGUIENTE</ButtonCustom>

                </div>
                <!-- /Orden de numeros -->
                <!-- Orden de numeros al inverso -->
                <div v-if="inverseNumber && orderNumber" class="flex flex-col items-center gap-4 w-full">
                    <div class="border-2 border-gray-400 rounded-lg p-4 gap-6 flex flex-col sm:flex-row items-center justify-between w-full">
                        <p class="text-base sm:text-lg text-justify">
                            Ahora ingrese la serie en el orden inverso en el que la escuche.
                            Oprima el botón para reproducir la segunda serie de números.
                        </p>
                        <font-awesome-icon v-if="!heard_audio3" :icon="['fas', 'volume-up']" size="2x"
                            class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-3 py-2"
                            @click="speachSecondSeries" />
                    </div>
                    <p v-if="second_series_field" class="flex justify-center  text-base sm:text-lg font-semibold text-justify">
                        Ingrese la segunda serie de números en orden inverso.
                    </p>
                    <div v-if="second_series_field" class="flex justify-center items-center">
                        <div class="grid grid-cols-3 gap-3">
                            <div v-for="(number, index) in InverseNumbers" :key="index">
                                <TextInput v-model="answerInverse[index]" :ref="el => inputFields[index] = el"
                                    maxlength="1" class="h-10 w-10  sm:h-12 sm:w-12 text-center text-xl text-gray-600"
                                    @input="handleInputInverse(index)" />
                            </div>


                        </div>
                    </div>
                    <ButtonCustom v-if="second_series_field" class="w-full sm:w-1/2 md:w-1/3 mt-4" mode="button"
                        @click="recordAttemptOrderInve">SIGUIENTE
                    </ButtonCustom>

                </div>
                <!-- /Orden de numeros al inverso -->
            </div>
            <!-- Golpear por cada letra A -->
            <div v-if="strikestate" class="flex flex-col items-center gap-4 w-full">
                <!-- Instrucciones -->
                <div class="border-2 border-gray-400 rounded-lg p-4 gap-6 flex flex-col sm:flex-row items-center justify-center w-full">
                    <p class="text-base sm:text-lg px-3 text-justify">
                        <span v-if="!isMobile">
                            Presione la barra espaciadora cada vez que escuche la letra "A" , únicamente cuando escuche
                            esta letra.
                        </span>
                        <span v-else>
                            Presione el botón cada vez que escuche la letra "A".
                        </span>
                        Para reproducir el audio, haga clic en el botón ubicado en este recuadro.
                    </p>
                    <font-awesome-icon v-if="!heard_audio2" :icon="['fas', 'volume-up']" size="2x"
                        class="bg-secondary text-white cursor-pointer hover:text-gray-100 rounded-lg px-4 py-2"
                        @click="countAleterSpeach" />
                </div>

                <!-- Contador -->
                <p class="flex justify-center text-7xl">{{ keyPressCount }}</p>

                <!-- Botón para móviles -->
                <button v-if="isMobile"
                    class="bg-secondary text-white font-semibold rounded-lg px-6 py-3 mt-4 sm:w-1/2 md:w-1/3 hover:bg-secondary-dark active:bg-secondary-darker"
                    @click="handleButtonPress">
                    Presione aquí
                </button>

                <!-- Botón "Siguiente" -->
                <ButtonCustom class="w-full sm:w-1/2 md:w-1/3 mt-4" mode="button" @click="letterACount">
                    SIGUIENTE
                </ButtonCustom>
            </div>
            <!-- / Golpear por cada letra A -->
            <!-- Desde 100 restado de 7 en 7 -->
            <div v-if="sevenMinSeven" class="flex flex-col items-center gap-4 w-full">
                <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center justify-between w-full">
                    <p class="text-base sm:text-lg text-justify">
                        En esta actividad va a restar de 7 en 7 comenzando desde 100. Inserte el
                        resultado en la casilla de texto y presione el botón "Siguiente resta" para seguir restando
                        desde el número que colocó anteriormente.</p>
                </div>


                <p v-if="!isInputFocused" class="flex justify-center text-black text-xl sm:text-2xl text-center font-bold">¿Cuánto
                    es {{ valueStart }} - 7?</p>
                <div class="flex flex-col items-center gap-4 justify-center">
                    <TextInput type="number" v-model="valueRest" class="w-24 text-base sm:text-lg"
                        @focus="isInputFocused = true" @unfocus="isInputFocused = false" />
                    <button v-if="restCount < 4" class="bg-secondary text-white px-4 py-2 rounded-lg ml-4"
                        @click="restNumber">
                        SIGUIENTE RESTA
                    </button>
                </div>


                <ButtonCustom v-if="restCount === 4" class="w-full sm:w-1/2 md:w-1/3 mt-4" mode="button"
                    @click="restNumber">
                    SIGUIENTE
                </ButtonCustom>
            </div>
        </div>
    </div>
</template>

<script setup>
import ButtonCustom from '@/Components/ButtonCustom.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps, nextTick, onMounted, onUnmounted } from 'vue';
import axios from 'axios';




// Detectar el tipo de dispositivo al montar el componente
onMounted(() => {
    const userAgent = navigator.userAgent || navigator.vendor || window.opera;
    isMobile.value = /android|iPad|iPhone|iPod/i.test(userAgent);

    if (!isMobile.value && strikestate) {
        // Agregar evento de teclado solo en web
        window.addEventListener('keydown', (event) => {
            if (event.code === 'Space') {
                handleKeyDown(event);
            }
        });
        window.addEventListener('keyup', (event) => {
            if (event.code === 'Space') {
                resetKeyPress(event);
            }
        });
    }
});

// Limpiar los eventos al desmontar
onUnmounted(() => {
    if (!isMobile.value) {
        window.removeEventListener('keydown', handleKeyDown);
        window.removeEventListener('keyup', resetKeyPress);
    }
});



const { sendNumber } = defineProps(['sendNumber']);
const isMobile = ref(false); // Estado para detectar si es móvil
let keyPressed = false; // Variable para evitar duplicados
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
const restCount = ref(0);
const final = ref(false);
const first_series_field = ref(false);
const second_series_field = ref(false);
const isInputFocused = ref(false);


const inverseNumber = ref(false);
const InverseNumbers = ref([2, 4, 7]);
const answerInverse = ref([]);
const scoreInverse = ref(0);

const a = ref('A');
const strikestate = ref(false);
const word = ref('');
const keyPressCount = ref(0);

const pressCountScore = ref(0);
const valueRestLog = ref('');

const sevenMinSeven = ref(false);
const valueStart = ref(100);
const valueRest = ref();
const countCorrect = ref(0);
const incorrectRest = ref(0);

const totalScore = ref(0);
const totalscoreState = ref(false);


const countAleter = ref(false);
const sevenMinusSeven = ref(false);

const speachIntroduction = () => {  //Audio introducción
    const text1 = 'En los siguientes pasos, se le presentarán tres tareas para completar. Cada una de estas incluirá un audio que deberá escuchar atentamente. Es importante tener en cuenta que solo podrá reproducir cada audio una vez, por lo que le recomendamos prestar mucha atención al escucharlos.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);

};
const speachFirstSeriesInstruction = () => {  //Instrucción Primer ejercicio Sección 6
    const text1 = 'Le voy a leer una serie de números y, cuando haya terminado, deberá escribirlos en el mismo orden en el que yo los he dicho.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);




};
const speachFirstSeries = () => {  //Audio del Primer ejercicio Sección 6
    const text1 = 'La serie es: ';
    const text2 = '2,  1,  8,  5,  4.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    const utterance2 = new SpeechSynthesisUtterance(text2);
    utterance.rate = 0.7;
    utterance2.rate = 0.6;
    utterance.lang = "es-CO"
    utterance2.lang = "es-CO"
    synthesis.speak(utterance);
    synthesis.speak(utterance2);
    heard_audio1.value = true;
    utterance2.onend = () => {
        first_series_field.value = true;
    };

};

const speachSecondSeriesInstruction = () => {  //Instrucción Segundo ejercicio Sección 6
    const text1 = 'Ahora le voy a leer otra serie de números y, cuando haya terminado, deberá escribirlos en orden inverso al que yo los he dicho.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
    heard_audio1.value = true;

};
const speachSecondSeries = () => {  //Audio del segundo ejercicio Sección 6

    const text1 = 'Ingrese la siguiente serie en orden inverso. La serie es: ';
    const text2 = '7,  4,  2.';
    const synthesis1 = window.speechSynthesis;
    const utterance1 = new SpeechSynthesisUtterance(text1);
    const utterance2 = new SpeechSynthesisUtterance(text2);
    utterance1.rate = 0.7; // Ajusta este valor para cambiar la velocidad
    utterance2.rate = 0.6; // Ajusta este valor para cambiar la velocidad
    utterance1.lang = "es-CO"
    utterance2.lang = "es-CO"
    synthesis1.speak(utterance1);
    synthesis1.speak(utterance2);
    heard_audio3.value = true;
    utterance2.onend = () => {
        second_series_field.value = true;
    };

}

const countAleterSpeachInstruction = () => {
    const text1 = 'Le voy a leer una serie de letras y, cada vez que se diga la letra A, debe oprimir la barra espaciadora de su teclado o cualquier tecla, únicamente cuando sea la letra A y no otras letras. Para escucharla, oprima el botón de audio a la derecha del recuadro de texto';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);

};

// Incrementar contador al presionar cualquier tecla (web)
const handleKeyDown = (event) => {
    if (!keyPressed) {
        keyPressCount.value++;
        keyPressed = true; // Marcar que la tecla fue presionada
    }
};

// Reiniciar la variable al soltar la tecla
const resetKeyPress = () => {
    keyPressed = false;
};

// Incrementar contador al presionar el botón (móvil)
const handleButtonPress = () => {
    keyPressCount.value++;
};

const countAleterSpeach = () => {
    const text1 = 'La serie de letras es: ';
    const text2 = 'F, B, A, C, M, N, A, A, J, K, L, B, A, F, A, K, D, E, A, A, A, J, A, M, O, F, A, A, B, .';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    const utterance2 = new SpeechSynthesisUtterance(text2);
    utterance.rate = 0.6;
    utterance2.rate = 0.4;
    utterance.lang = "es-CO"
    utterance2.lang = "es-CO"
    synthesis.speak(utterance);
    synthesis.speak(utterance2);
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
    const text1 = 'Ahora reste de 7 en 7 empezando desde 100, ponga el resultado en el input y oprima siguiente resta.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
};

const letterACount = () => {
    sevenMinSeven.value = true;
    strikestate.value = false;
    console.log('keyPressCount: ', keyPressCount.value);
    if (keyPressCount.value === 10 || keyPressCount.value === 11 || keyPressCount.value === 12) {
        pressCountScore.value = 1;
    }
};

const restNumber = async () => {
    if (valueRestLog.value === '') {
        valueRestLog.value = valueRest.value
    } else {
        valueRestLog.value = valueRestLog.value + ', ' + valueRest.value;
    }

    let difference = valueStart.value - valueRest.value;
    restCount.value += 1;
    isInputFocused.value = false;

    if (difference === 7) {
        countCorrect.value += 1;
        valueStart.value -= 7;
    } else {
        incorrectRest.value += 1;
        valueStart.value = valueRest.value;
    }


    if (restCount.value === 5) {
        sevenMinSeven.value = false;
        totalscoreState.value = true;
        final.value = true;

        if (countCorrect.value >= 4) {
            totalScore.value += 3 + scoreNumbers.value + scoreInverse.value + pressCountScore.value;
        } else if (countCorrect.value == 2 || countCorrect.value == 3) {
            totalScore.value += 2 + scoreNumbers.value + scoreInverse.value + pressCountScore.value;
        } else if (countCorrect.value == 1) {
            totalScore.value += 1 + scoreNumbers.value + scoreInverse.value + pressCountScore.value;
        }

        const answer = {
            attention_answer: 'Respuesta números: ' + answerOrder.value + '.' + ' - Respuesta inversa: ' + answerInverse.value + '.' + ' - Golpes por A: ' + keyPressCount.value + '.' + ' - Resta de 7 en 7: ' + valueRestLog.value
        };

        console.log('Respuesta: ', answer);
        console.log('Puntaje: ', totalScore.value);

        await axios.post('/moca/uploadAttention', answer);
        sendNumber(totalScore.value);
    }


    valueRest.value = '';
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