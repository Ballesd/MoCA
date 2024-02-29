<template>
    <div class="m-6 p-6 bg-white shadow-md rounded-lg">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-semibold">8. Fluidez verbal</h2>
        </div>
        <!-- Contenido de tu componente -->
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
const timeLeft = ref(60) // Inicializar el tiempo en 60 segundos
const score = ref(0)

const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition
const sr = new Recognition()

let timerId // Variable para el contador regresivo

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
      timerId = setTimeout(countDown, 1000) // Actualizar el contador cada segundo
    } else {
      stopRecording()
    }
  }

  const speachIntroduction = () => {
    const text1 = "Para la prueba de fluidez verbal, necesitaremos que diga el mayor número de palabras posibles que comiencen por la letra F. No se permiten nombres, números y las formas conjugadas de un verbo. ¿Está preparado? Cuando se sienta preparado, pulse el botón de comenzar."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6; // Ajusta este valor para cambiar la velocidad
    synthesis.speak(utterance);
}
  
  onMounted(() => {
    speachIntroduction();
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
                if (word.toLowerCase().startsWith('f')) {
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
    //Borramos las palabras que se encuentran repetidas
    const words = wordsVec.value.filter((item, index) => wordsVec.value.indexOf(item) === index)
    console.log("words",words)
    //Contamos las palabras que comienzan con F
    result.value = words.length
    resultState.value = false
    if(result.value >= 11){
        score.value = 1
    }
    const answer = {
      verbal_fluency_answer: wordsVec.value,
    }
    //'/moca/uploadVerbalFluency'
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