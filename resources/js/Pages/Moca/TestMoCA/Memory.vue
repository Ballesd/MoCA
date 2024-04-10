<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
    <div class="flex justify-center items-center space-x-2">
      <h2 class="text-lg font-semibold flex items-center">5. Fase de Memoria</h2>
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
    <div class="p-4">
      <!-- Mostrar palabras a recordar -->
      <div v-if="!showAttempt">
          <h2 class="text-2xl font-semibold mb-4">Palabras a recordar</h2>
          <ul class="list-disc ml-4">
            
          </ul>
          <button v-if="button_band"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded"
          @click="startAttempt"
          >
          Iniciar Intento
          </button>
      </div>
      <!-- Realizar el intento -->
      <div v-else-if="attempt < maxAttempts">
          <h2 class="text-2xl font-semibold mb-4">Intento {{ attempt }}</h2>
          <div class="grid grid-cols-2 gap-4">
            <div v-for="(word, index) in words" :key="index">
                <input
                v-model="rememberedWords[index]"
                @input="removeSpaces(index)"
                class="border rounded p-2 w-full"
                />
            </div>
          </div>
          <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded"
          @click="recordAttempt"
          >
          Registrar Intento
          </button>
      </div>
    </div>
  </div>
</template>
  
<script>
  export default {
    data() {
      return {
        words: ["ROSTRO", "SEDA", "IGLESIA", "CLAVEL", "ROJO"],
        showAttempt: false,
        attempt: 1,
        button_band: true,
        maxAttempts: 3,
        rememberedWords: ["", "", "", "", ""],
        answer: ["ROSTRO", "SEDA", "IGLESIA", "CLAVEL", "ROJO"], 
      };
    },
    methods: {
       wordsbyone() {
        const palabras = this.words;
        const synthesis = window.speechSynthesis; // Asegúrate de que synthesis esté definido aquí
        for (let i = 0; i < palabras.length; i++) {
          const utterance = new SpeechSynthesisUtterance(palabras[i]);
          utterance.rate = 0.7;
          synthesis.speak(utterance);
        }
      },
      speachIntroduction(){
        const synthesis = window.speechSynthesis;
        const text1 = "Esta es una prueba de memoria. Le voy a leer una lista de palabras que debe recordar. Escuche con atención. Cuando acabe, dígame todas las palabras que pueda recordar. No importa el orden en el que las escriba";
        const utterance1 = new SpeechSynthesisUtterance(text1);
        utterance1.rate = 0.7;
        synthesis.speak(utterance1);

        this.wordsbyone();
      },
      startAttempt() {
        this.button_band = false;
        this.showAttempt = true;
      },
      recordAttempt() {
        //Desactivamos los campos de texto
        this.showAttempt = false;
        this.attempt++;

        if(this.attempt == 2){
          this.$emit('answer-score', 0);
        }
      },
      removeSpaces(index) {
        this.rememberedWords[index] = this.rememberedWords[index].trim();
      },
    },
  };
</script>
  
  