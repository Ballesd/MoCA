<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
    <div class="flex justify-center items-center space-x-2">
      <h2 class="text-lg font-semibold flex items-center">8. Fluidez verbal</h2>
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
    <button v-if="resultState" :class="`mic bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md`" @click="startRecording" :disabled="isRecording || timeLeft === 0">{{ isRecording ? `${timeLeft} s` : 'Comenzar' }}</button>
    <div v-if="resultState" class="mt-4" v-text="transcript"></div>
      <button v-if="timeLeft === 0" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md mt-4" @click="evaluar">Evaluar</button>
    <div v-if="!resultState" class="mt-4" v-text="`Puntuación: ${score}`"></div>
  </div>
</template>
  
<script setup>

import { ref, onMounted, onBeforeUnmount, defineProps } from 'vue'
import axios from 'axios';

const { sendNumber } = defineProps(['sendNumber']); 

const transcript = ref('')
const wordsVec = ref([])
const result = ref(0)
const resultState = ref(true)
const isRecording = ref(false)
const timeLeft = ref(60)
const score = ref(0)

const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition
const sr = new Recognition()

let timerId 

  const startRecording = () => {
    if (!isRecording.value && timeLeft.value > 0) {
      isRecording.value = true
      sr.start()
      countDown()
    } else {
      stopRecording()
    }
  }
  
  const stopRecording = () => {
    isRecording.value = false
    sr.stop()
    clearTimeout(timerId)
  }
  
  const countDown = () => {
    if (timeLeft.value > 0) {
      timeLeft.value--
      timerId = setTimeout(countDown, 1000)
    } else {
      stopRecording()
    }
  }

  const speachIntroduction = () => {
    const text1 = "Para la prueba de fluidez verbal, necesitaremos que diga el mayor número de palabras posibles que comiencen por la letra P. No se permiten nombres, números y las formas conjugadas de un verbo. ¿Está preparado? Cuando se sienta preparado, pulse el botón de comenzar."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6;
    synthesis.speak(utterance);
}
  
  onMounted(() => {
    sr.lang = 'es-CO'
    sr.continuous = true
    sr.interimResults = true
  
    sr.onstart = () => {
      console.log('Recognition Started')
    }
  
    sr.onend = () => {
      console.log('Recognition Stopped')
    }
  
    sr.onresult = (evt) => {
      for (let i = 0; i < evt.results.length; i++) {
        const result = evt.results[i]
        transcript.value = result[0].transcript
        if (result.isFinal){
            const words = result[0].transcript.split(' ')
            for (const word of words) {
                if (word.toLowerCase().startsWith('p')) {
                    wordsVec.value.push(word)
                }
            }
        }
      }
    }
  
    sr.onerror = (event) => {
      console.error('Error en el reconocimiento de voz:', event.error)
    }
  })
  const evaluar = () => {
    const words = wordsVec.value.filter((item, index) => wordsVec.value.indexOf(item) === index)
    console.log("words",words)
    result.value = words.length
    resultState.value = false
    if(result.value >= 11){
        score.value = 1
    }


    //recorremos el array de palabras y las guardamos en un string
    const wordsString = words.join(', ')

    const answer = {
      verbal_fluency_answer: wordsString
    }
    axios.post('/moca/uploadVerbalFluency', answer)
    .catch(error => {
      console.log(error)
    })
    sendNumber(score.value);
  }
  
  onBeforeUnmount(() => {
    sr.stop()
    sr.onstart = null
    sr.onend = null
    sr.onresult = null
    sr.onerror = null
  })
</script>