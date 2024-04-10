<template>
    <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
        <div class="flex justify-center items-center space-x-2">
            <h2 class="text-lg font-semibold flex items-center">6. Atención</h2>
            <div v-if="!countAleter && !sevenMinusSeven">
                <button class="flex items-center" @click="speachIntroduction">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 512 512" fill="none" stroke="currentColor">
                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                            <path d="M3834 4426 c-86 -38 -154 -139 -154 -230 0 -77 19 -122 82 -194 145 -167 187 -220 251 -315 132 -198 250 -480 296 -712 131 -657 -51 -1310 -501 -1802 -105 -115 -122 -149 -123 -238 0 -59 5 -78 29 -123 52 -93 140 -139 247 -129 80 7 131 39 222 139 310 343 525 753 621 1189 75 338 75 760 0 1098 -63 287 -202 614 -362 856 -144 218 -316 414 -396 451 -59 27 -161 32 -212 10z"/>
                            <path d="M2219 4336 c-20 -7 -49 -22 -65 -34 -16 -11 -243 -235 -504 -496 l-475 -476 -345 0 c-204 0 -360 -4 -382 -10 -65 -18 -130 -70 -160 -129 l-28 -53 0 -574 c0 -621 -1 -606 54 -679 13 -17 48 -44 77 -60 l54 -30 365 -3 365 -3 490 -488 c270 -269 505 -497 524 -506 52 -26 139 -31 199 -11 58 20 119 73 147 131 20 39 20 70 20 1645 0 1575 0 1606 -20 1645 -57 115 -197 174 -316 131z"/>
                            <path d="M3105 3697 c-66 -32 -120 -93 -139 -158 -32 -106 -13 -165 93 -289 154 -180 238 -366 262 -582 16 -146 1 -284 -48 -431 -44 -132 -109 -245 -214 -367 -106 -124 -125 -183 -93 -289 33 -111 144 -188 259 -179 99 8 160 52 282 203 145 179 266 446 310 685 24 131 24 409 0 540 -35 188 -120 403 -225 565 -85 133 -203 264 -267 297 -63 33 -158 35 -220 5z"/>
                        </g>
                    </svg>
                </button>
            </div>
            <div v-if="countAleter && !sevenMinusSeven">
                <button class="flex items-center" @click="countAleterSpeach">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 512 512" fill="none" stroke="currentColor">
                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                            <path d="M3834 4426 c-86 -38 -154 -139 -154 -230 0 -77 19 -122 82 -194 145 -167 187 -220 251 -315 132 -198 250 -480 296 -712 131 -657 -51 -1310 -501 -1802 -105 -115 -122 -149 -123 -238 0 -59 5 -78 29 -123 52 -93 140 -139 247 -129 80 7 131 39 222 139 310 343 525 753 621 1189 75 338 75 760 0 1098 -63 287 -202 614 -362 856 -144 218 -316 414 -396 451 -59 27 -161 32 -212 10z"/>
                            <path d="M2219 4336 c-20 -7 -49 -22 -65 -34 -16 -11 -243 -235 -504 -496 l-475 -476 -345 0 c-204 0 -360 -4 -382 -10 -65 -18 -130 -70 -160 -129 l-28 -53 0 -574 c0 -621 -1 -606 54 -679 13 -17 48 -44 77 -60 l54 -30 365 -3 365 -3 490 -488 c270 -269 505 -497 524 -506 52 -26 139 -31 199 -11 58 20 119 73 147 131 20 39 20 70 20 1645 0 1575 0 1606 -20 1645 -57 115 -197 174 -316 131z"/>
                            <path d="M3105 3697 c-66 -32 -120 -93 -139 -158 -32 -106 -13 -165 93 -289 154 -180 238 -366 262 -582 16 -146 1 -284 -48 -431 -44 -132 -109 -245 -214 -367 -106 -124 -125 -183 -93 -289 33 -111 144 -188 259 -179 99 8 160 52 282 203 145 179 266 446 310 685 24 131 24 409 0 540 -35 188 -120 403 -225 565 -85 133 -203 264 -267 297 -63 33 -158 35 -220 5z"/>
                        </g>
                    </svg>
                </button>
            </div>
            <div v-if="countAleter && sevenMinusSeven">
                <button class="flex items-center" @click="audioSevenMinus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 512 512" fill="none" stroke="currentColor">
                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                            <path d="M3834 4426 c-86 -38 -154 -139 -154 -230 0 -77 19 -122 82 -194 145 -167 187 -220 251 -315 132 -198 250 -480 296 -712 131 -657 -51 -1310 -501 -1802 -105 -115 -122 -149 -123 -238 0 -59 5 -78 29 -123 52 -93 140 -139 247 -129 80 7 131 39 222 139 310 343 525 753 621 1189 75 338 75 760 0 1098 -63 287 -202 614 -362 856 -144 218 -316 414 -396 451 -59 27 -161 32 -212 10z"/>
                            <path d="M2219 4336 c-20 -7 -49 -22 -65 -34 -16 -11 -243 -235 -504 -496 l-475 -476 -345 0 c-204 0 -360 -4 -382 -10 -65 -18 -130 -70 -160 -129 l-28 -53 0 -574 c0 -621 -1 -606 54 -679 13 -17 48 -44 77 -60 l54 -30 365 -3 365 -3 490 -488 c270 -269 505 -497 524 -506 52 -26 139 -31 199 -11 58 20 119 73 147 131 20 39 20 70 20 1645 0 1575 0 1606 -20 1645 -57 115 -197 174 -316 131z"/>
                            <path d="M3105 3697 c-66 -32 -120 -93 -139 -158 -32 -106 -13 -165 93 -289 154 -180 238 -366 262 -582 16 -146 1 -284 -48 -431 -44 -132 -109 -245 -214 -367 -106 -124 -125 -183 -93 -289 33 -111 144 -188 259 -179 99 8 160 52 282 203 145 179 266 446 310 685 24 131 24 409 0 540 -35 188 -120 403 -225 565 -85 133 -203 264 -267 297 -63 33 -158 35 -220 5z"/>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        <p class="text-gray-600">Lectura de números - Golpe por la letra A - Resta de 7 en 7.</p>
        <div v-if="repeatNumeber">
            <div v-if="!orderNumber" class="flex justify-center mt-4">
                <button
                    :disabled="buttonState"
                    @click="startNumberTest"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Iniciar las pruebas de números
                </button>
            </div>
            <!--Orden de numeros-->
            <div v-if="orderNumber && !inverseNumber" class="mt-8">
                <p class="flex justify-center text-gray-800">Ingrese la primera serie de numeros en el mismo orden:</p>
                <div class="flex justify-center">
                    <div class="grid grid-cols-5 gap-4">
                        <div v-for="(number, index) in orderNumbers" :key="index">
                            <input
                                v-model="answerOrder[index]"
                                ref="inputField"
                                maxlength="1"
                                class="h-16 w-12 border mx-2 rounded-lg text-center font-thin text-3xl text-gray-800"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="recordAttemptOrder">
                        Registrar Intento
                    </button>
                </div>
            </div>
            <!--Orden de numeros al inverso-->
            <div v-if="inverseNumber && orderNumber" class="mt-8">
                <p class="flex justify-center text-gray-800">Ingrese la segunda serie de numeros en orden inverso:</p>
                <div class="flex justify-center">
                    <div class="grid grid-cols-5 gap-4">
                        <div v-for="(number, index) in InverseNumbers" :key="index">
                            <input
                                v-model="answerInverse[index]"
                                ref="inputField"
                                maxlength="1"
                                class="h-16 w-12 border mx-2 rounded-lg text-center font-thin text-3xl text-gray-800"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="recordAttemptOrderInve">
                        Registrar Intento
                    </button>
                </div>
            </div>
        </div>
        <!--Golpear por cada letra A-->
        <div>
            <div v-if="strikestate" class="mt-4 p-4 border rounded shadow-md">
                <p class="flex justify-center text-gray-800">Ingrese la cantidad de toques finales por la letra A:</p>
                <div class="flex justify-center items-center space-x-4">
                    <input type="number" v-model="word" class="border rounded p-2 w-">
                    <div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="letterACount">Responder final</button>
                    </div>
                </div>
            </div>
        </div>

        <!--desde 100 restado de 7 en 7-->
        <div v-if="sevenMinSeven" class="mt-4 p-4 border rounded shadow-md">
            <p class="text-lg font-semibold mb-2">Restar de 7 en 7 empezando desde 100.</p>
            <div class="flex items-center space-x-4">
                <input type="number" v-model="valuRest" class="border rounded p-2 w-">
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="restNumber">Responder</button>
                </div>
            </div>
        </div>

        <div v-if="totalscoreState">
            <p>
                Score: {{ totalScore }}
            </p>
        </div>
    </div>
</template>
  

<script setup>
import { ref, defineProps  } from 'vue';
import axios from 'axios';

const { sendNumber } = defineProps(['sendNumber']); 

const buttonState = ref(false);

const repeatNumeber = ref(true);
const orderNumber = ref(false);
const orderNumbers = ref([2, 1, 8, 5, 4]);
const answerOrder = ref([]);
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

const speachIntroduction = () => {
    const text1 = "Le voy a leer una serie de números y, cuando haya terminado, deberá escribirlos en el mismo orden en el que yo los he dicho. La primera serie es: 2,  1,  8,  5,  4."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    synthesis.speak(utterance);

    const text2 = "Ahora le voy a leer otra serie de números y, cuando haya terminado, deberá escribirlos en orden inverso al que yo los he dicho. La segunda serie es: 7,  4,  2."
    const synthesis1 = window.speechSynthesis;
    const utterance1 = new SpeechSynthesisUtterance(text2);
    utterance1.rate = 0.7; // Ajusta este valor para cambiar la velocidad
    synthesis1.speak(utterance1);
}

const countAleterSpeach = () => {
    const text1 = "Ingrese la cantidad de golpes por la letra A elavorada por el paciente."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    synthesis.speak(utterance);
}

const startNumberTest = () => {
    buttonState.value = true;

    orderNumber.value = true;
}

const recordAttemptOrder = () => {
    if (answerOrder.value.toString() == orderNumbers.value.toString()) {
        scoreNumbers.value = 1;
    } else {
        scoreNumbers.value = 0;
    }
    inverseNumber.value = true;
}

const recordAttemptOrderInve = () => {
    if (answerInverse.value.toString() == InverseNumbers.value.toString()) {
        scoreInverse.value = 1;
    } else {
        scoreInverse.value = 0;
    }
    repeatNumeber.value = false;
    strikestate.value = true;
    countAleter.value = true;
}
const audioSevenMinus = () => {
    const text1 = "Ahora reste de 7 en 7 empezando desde 100, ponga el resultado en el input y oprima responder."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    synthesis.speak(utterance);
}

const letterACount = () => {
    sevenMinusSeven.value = true;
    sevenMinSeven.value = true;
    strikestate.value = false;
}

const restNumber = () => {
    valueRestLog.value = valueRestLog.value + ', ' + valuRest.value;
    console.log("valueRestLog", valueRestLog.value)
    let diference = valueStart.value - valuRest.value;
    console.log("diference", diference);
    if(diference === 7){
        if(valueStart.value <= 2){
            sevenMinSeven.value = false;
            totalscoreState.value = true;
        }
        countCorrect.value += 1;
        valueStart.value -= 7;
    }
    else if(incorrectRest.value < 1 && diference != 7){
        incorrectRest.value += 1;
        console.log("incorrectRest", incorrectRest.value);
    }
    else if(diference != 7 || valueStart.value <= 2){
        sevenMinSeven.value = false;
        totalscoreState.value = true;
        if (countCorrect.value >= 4){
            totalScore.value += 3 + scoreNumbers.value + scoreInverse.value + scoreStrike.value;
        }
        else if (countCorrect.value >= 2){
            totalScore.value += 2 + scoreNumbers.value + scoreInverse.value + scoreStrike.value;
        }
        else if (countCorrect.value >= 1){
            totalScore.value += 1 + scoreNumbers.value + scoreInverse.value + scoreStrike.value;
        }
        const answer = {
            attention_answer: 'Respuesta números: ' + answerOrder.value + '.' + ' - Respuesta inversa: ' + answerInverse.value + '.' + ' - Golpes por A: ' + word.value + '.' + ' - Resta de 7 en 7: ' + valueRestLog.value
        }

        const response = axios.post('/moca/uploadAttention', answer);
        console.log("respuesta:",response);

        sendNumber(totalScore.value);
    }
    else{
        incorrectRest.value += 1;
    }
    valuRest.value = "";
}
</script>