<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
    <div class="flex justify-center items-center space-x-2">
      <h2 class="text-lg font-semibold flex items-center">7. Repetición de frases</h2>
      <div v-if="!stateSecondAudio">
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
      <div v-if="stateSecondAudio">
        <button class="flex items-center" @click="speachSecond">
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

const result = ref(0);
const phrase1 = ref(' El gato se esconde bajo el sofá cuando los perros entran en la sala.');
const phrase2 = ref('Espero que él le entregue el mensaje una vez que ella se lo pida.');
const transcript2 = ref('');
const isRecording1 = ref(false);
const isRecording2 = ref(false);
const firstaudio = ref(true);
const secondaudio = ref(false);

const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition
const sr1 = new Recognition()
const sr2 = new Recognition()

const stateSecondAudio = ref(false);

onMounted(() => {
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
    stateSecondAudio.value = true;
    secondaudio.value = true;
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

