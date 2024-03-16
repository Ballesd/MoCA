<template>
  <div class="m-4 bg-white p-4 shadow-md rounded-lg">
    <div class="mb-8 text-center">
      <h2 class="text-2xl font-semibold">7. Repetición de frases</h2>
    </div>

    <div v-if="firstaudio">
      <button :class="`mic bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md`" @click="ToggleMic1">{{ isRecording1 ? 'Detener' : '1° Frase' }}</button>
    </div>
    <div class="mt-4" v-text="transcript1"></div>

    <div v-if="secondaudio">
      <button :class="`mic bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md`" @click="ToggleMic2">{{ isRecording2 ? 'Detener' : '2° Frase' }}</button>
    </div>
    <div class="mt-4" v-text="transcript2"></div>
    <button v-if="transcript1 && transcript2" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md mt-4" @click="evaluar">Evaluar</button>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, defineProps } from 'vue';
import axios from 'axios';

const { sendNumber } = defineProps(['sendNumber']); 

const transcript1 = ref('');
//Solo sé que le toca a Juan ayudar hoy
//El gato siempre se esconde debajo del sofá cuando hay perros en la habitación
const result = ref(0);
const phrase1 = ref(' El gato se esconde bajo el sofá cuando los perros entran en la sala.');
const phrase2 = ref('Espero que él le entregue el mensaje una vez que ella se lo pida.');
const transcript2 = ref('');
const isRecording1 = ref(false);
const isRecording2 = ref(false);
const firstaudio = ref(false);
const secondaudio = ref(false);

const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition
const sr1 = new Recognition()
const sr2 = new Recognition()

onMounted(() => {
    speachIntroduction();
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
  });

const speachIntroduction = () => {
  const text1 = "Ahora le voy a leer una frase. Dele clic al botón y repítala. Cuando termine de repetirla, dele click al botón nuevamente para detener la grabación. La frase es: "
  const synthesis = window.speechSynthesis;
  const utterance = new SpeechSynthesisUtterance(text1);
  utterance.rate = 0.6;
  synthesis.speak(utterance);

  const text2 = "El gato se esconde bajo el sofá cuando los perros entran en la sala.";
  const synthesis1 = window.speechSynthesis;
  const utterance1 = new SpeechSynthesisUtterance(text2);
  utterance1.rate = 0.5;
  synthesis1.speak(utterance1);

  utterance1.onend = () => {
    firstaudio.value = true;
  }
}

const speachSecond = () => {
  const text1 = "Ahora le voy a leer otra frase. Dele clic al botón y repítala. Cuando termine de repetirla, dele click al botón nuevamente para detener la grabación. La frase es: "
  const synthesis = window.speechSynthesis;
  const utterance = new SpeechSynthesisUtterance(text1);
  utterance.rate = 0.6; 
  synthesis.speak(utterance);

  const text2 = "Espero que él le entregue el mensaje una vez que ella se lo pida.";
  const synthesis1 = window.speechSynthesis;
  const utterance1 = new SpeechSynthesisUtterance(text2);
  utterance1.rate = 0.5; 
  synthesis1.speak(utterance1);

  utterance1.onend = () => {
    secondaudio.value = true;
  }
}

const evaluar = () => {
  const answer = {
    language_answer : 'Frase 1: ' + transcript1.value + ", " + 'Frase 2: ' + transcript2.value
  }

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
  //'/moca/uploadLanguage'
  axios.post('/moca/uploadLanguage', answer)
  .catch(error => {
    console.log(error);
  });
  sendNumber(result.value);
}

const ToggleMic1 = () => {
  if (isRecording1.value) {
    sr1.stop()
    firstaudio.value = false;
    speachSecond();
  } else {
    setTimeout(() => {
      sr1.start()
    }, 500);
  }
}

const ToggleMic2 = () => {
  if (isRecording2.value) {
    sr2.stop()
    secondaudio.value = false;
  } else {
    setTimeout(() => {
      sr2.start()
    }, 500);
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

