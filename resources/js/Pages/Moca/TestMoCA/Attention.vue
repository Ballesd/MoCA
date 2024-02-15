<template>
    <div class="m-6 p-6 bg-white shadow-md rounded-lg">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-semibold">6. Atención</h2>
            <p class="text-gray-600">Lectura de números - Golpe por la letra A - Resta de 7 en 7.</p>
        </div>
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
                    <!-- Cada que se digite un número tiene que pasar al siguiente input -->
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
                <div class="flex justify-center items-center space-x-4">
                    <p class="text-7xl"> {{ word }} </p>
                    <button @click="strickA" class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">Golpear</button>
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
const words = ref(["F", "B", "A", "C", "M", "N", "A", "A", "J", "K", "L", "B", "A", "F", "A", "K", "D", "E", "A", "A", "A", "J", "A", "M", "O", "F", "A", "A", "B"]);
const word = ref('');
const countCorrectStrake = ref(0);
const incorrectStrake = ref(0);
const scoreStrike = ref(0);

const sevenMinSeven = ref(false);
const valueStart = ref(100);
const valuRest = ref();
const countCorrect = ref(0);

const totalScore = ref(0);
const totalscoreState = ref(false);


const startNumberTest = () => {
    buttonState.value = true;
    //activamos la voz y decimos la seri de palabras
    const text1 = "Le voy a leer una serie de números y, cuando haya terminado, deberá escribirlos en el mismo orden en el que yo los he dicho. La primera serie es: 2,  1,  8,  5,  4."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7; // Ajusta este valor para cambiar la velocidad
    synthesis.speak(utterance);

    const text2 = "Ahora le voy a leer otra serie de números y, cuando haya terminado, deberá escribirlos en orden inverso al que yo los he dicho. La segunda serie es: 7,  4,  2."
    const synthesis1 = window.speechSynthesis;
    const utterance1 = new SpeechSynthesisUtterance(text2);
    utterance1.rate = 0.7; // Ajusta este valor para cambiar la velocidad
    synthesis1.speak(utterance1);

    //Ponemos un temporizador de 30 seg para poder cambiar el estado de orderNumber
    setTimeout(() => {
        orderNumber.value = true;
    }, 28000);
}

const recordAttemptOrder = () => {
    //Evaluamos si el orden de los numeros es correcto
    if (answerOrder.value.toString() == orderNumbers.value.toString()) {
        scoreNumbers.value = 1;
    } else {
        scoreNumbers.value = 0;
    }
    inverseNumber.value = true;
}

const recordAttemptOrderInve = () => {
    //Evaluamos si el orden de los numeros es correcto
    if (answerInverse.value.toString() == InverseNumbers.value.toString()) {
        scoreInverse.value = 1;
    } else {
        scoreInverse.value = 0;
    }
    repeatNumeber.value = false;
    strikestate.value = true;
    secuenceWord(); 
}   
const intervaliCount = () => {
    let i = 0;
    const interval = setInterval(() => {
        word.value = words.value[i];
        i++;
        if (i === words.value.length) {
            if(incorrectStrake.value >= 2){
                scoreStrike.value = 0;
            }
            else{
                scoreStrike.value = 1;
            }
            clearInterval(interval);
            strikestate.value = false;
            audioSevenMinus();
        }
    }, 1000);
}
const secuenceWord = () => {
    const text1 = "Leer los números que aparecen en la pantalla y golpear por cada letra A  que aparezca (Darle un solo click para disminuir el riesgo de error)."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.onend = () => {
        // Esta función se ejecutará cuando termine la reproducción del audio
        intervaliCount();
    };
    synthesis.speak(utterance);
}
const audioSevenMinus = () => {
    const text1 = "Ahora reste de 7 en 7 empezando desde 100, ponga el resultado en el input y oprima responder."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    synthesis.speak(utterance);
    setInterval(() => {
        sevenMinSeven.value = true;
    }, 5000);
}
const strickA = () => {

    if( word.value === "A"){
        countCorrectStrake.value += 1;
    }
    else{
        incorrectStrake.value += 1;
        console.log("incorrecto",incorrectStrake.value);
    }
    console.log(countCorrectStrake.value);

}

const restNumber = () => {
    let diference = valueStart.value - valuRest.value;
    if(diference === 7){
        if(valueStart.value <= 2){
            sevenMinSeven.value = false;
            totalscoreState.value = true;
        }
        countCorrect.value += 1;
        valueStart.value -= 7;
    }else if(diference != 7 || valueStart.value <= 2){
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
        sendNumber(totalScore.value);
    }
    valuRest.value = "";
}
</script>