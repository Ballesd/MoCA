<template>
  <div class="m-4 bg-white p-4 shadow-md rounded-lg">
    <div class="mb-8 text-center">
      <h2 class="text-2xl font-semibold">7. Repetición de frases</h2>
      <p class="text-gray-600">Por favor, “Ahora le voy a leer una frase. Repítala exactamente cuando yo termine: Solo sé que le toca a Juan ayudar hoy". Después de la respuesta, diga: "Ahora voy a leerle otra frase. Repítala exactamente cuando yo termine: El gato siempre se esconde debajo del sofá cuando hay perros en la habitación".</p>
    </div>
    <!-- Contenido de tu componente -->
    <button :class="`mic bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md`" @click="ToggleMic1">{{ isRecording1 ? 'Detener' : '1° Frase' }}</button>
    <div class="mt-4" v-text="transcript1"></div>

    <!-- Segundo área para el resultado de voz -->
    <button :class="`mic bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md`" @click="ToggleMic2">{{ isRecording2 ? 'Detener' : '2° Frase' }}</button>
    <div class="mt-4" v-text="transcript2"></div>
    <!--Si transcript1 y transcript2 tienen valores mostramos el botón de evaluar resuktados-->
    <button v-if="transcript1 && transcript2" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md mt-4" @click="evaluar">Evaluar</button>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, defineProps } from 'vue';

const { sendNumber } = defineProps(['sendNumber']); 

const transcript1 = ref('');
const result = ref(0);
const phrase1 = ref('Solo sé que le toca a Juan ayudar hoy.');
const phrase2 = ref('El gato siempre se esconde debajo del sofá cuando hay perros en la habitación.');
const transcript2 = ref('');
const isRecording1 = ref(false);
const isRecording2 = ref(false);

const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition
const sr1 = new Recognition()
const sr2 = new Recognition()

onMounted(() => {
  // Configurar el idioma a español de Colombia
  sr1.lang = 'es-CO'
  sr2.lang = 'es-CO'
  
  sr1.continuous = true
  sr1.interimResults = true

  sr1.onstart = () => {
    console.log('SR1 Started')
    isRecording1.value = true
  }

  sr1.onend = () => {
    console.log('SR1 Stopped')
    isRecording1.value = false
  }

  sr1.onresult = (evt) => {
    for (let i = 0; i < evt.results.length; i++) {
      const result = evt.results[i]

      if (result.isFinal) {
        transcript1.value = result[0].transcript
      }
    }
  }

  sr1.onerror = (event) => {
    console.error('Error en el reconocimiento de voz 1:', event.error)
  }

  // Configurar el segundo reconocimiento de voz
  sr2.continuous = true
  sr2.interimResults = true

  sr2.onstart = () => {
    console.log('SR2 Started')
    isRecording2.value = true
  }

  sr2.onend = () => {
    console.log('SR2 Stopped')
    isRecording2.value = false
  }

  sr2.onresult = (evt) => {
    for (let i = 0; i < evt.results.length; i++) {
      const result = evt.results[i]

      if (result.isFinal) {
        transcript2.value = result[0].transcript
      }
    }
  }

  sr2.onerror = (event) => {
    console.error('Error en el reconocimiento de voz 2:', event.error)
  }
})

const evaluar = () => {
  // Aquí va la lógica para evaluar las respuestas
  if(transcript1.value === phrase1.value){
    result.value += 1
  }
  if(transcript2.value === phrase2.value){
    result.value += 1
  }
  if(result.value > 2){
    result.value = 2
  }
  console.log("resultado total",result.value);
  sendNumber(result.value);
}

const ToggleMic1 = () => {
  if (isRecording1.value) {
    sr1.stop()
  } else {
    setTimeout(() => {
      sr1.start()
    }, 500); // Espera 500 milisegundos antes de iniciar la grabación
  }
}

const ToggleMic2 = () => {
  if (isRecording2.value) {
    sr2.stop()
  } else {
    setTimeout(() => {
      sr2.start()
    }, 500); // Espera 500 milisegundos antes de iniciar la grabación
  }
}

onBeforeUnmount(() => {
  sr1.stop()
  sr1.onstart = null
  sr1.onend = null
  sr1.onresult = null
  sr1.onerror = null

  sr2.stop()
  sr2.onstart = null
  sr2.onend = null
  sr2.onresult = null
  sr2.onerror = null
})
</script>

<style>
/* Estilos de Tailwind CSS aquí, si es necesario */
</style>
