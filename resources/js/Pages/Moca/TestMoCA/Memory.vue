<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg">
    <div class="mb-8 text-center">
      <h2 class="text-2xl font-semibold">5. Fase de Memoria</h2>
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
        words: ["ROSTRO", "SEDA", "TEMPLO", "CLAVEL", "ROJO"],
        showAttempt: false,
        attempt: 1,
        button_band: true,
        maxAttempts: 3,
        rememberedWords: ["", "", "", "", ""],
        answer: ["ROSTRO", "SEDA", "TEMPLO", "CLAVEL", "ROJO"], // Respuesta predefinida
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
      startAttempt() {
        this.button_band = false;
        const synthesis = window.speechSynthesis; // Asegúrate de que synthesis esté definido aquí

        const text1 = "Esta es una prueba de memoria. Le voy a leer una lista de palabras que debe recordar. Escuche con atención. Cuando acabe, dígame todas las palabras que pueda recordar. No importa el orden en el que las escriba";
        const utterance1 = new SpeechSynthesisUtterance(text1);
        utterance1.rate = 0.7;
        synthesis.speak(utterance1);

        this.wordsbyone();

        //ejecutams el metodo pero despues de que se digan los audios
        setTimeout(() => {
          this.showAttempt = true;
          this.rememberedWords = ["", "", "", "", ""];
        }, 25000);
      },
      recordAttempt() {
        //Desactivamos los campos de texto
        this.showAttempt = false;
        this.attempt++;
        const synthesis = window.speechSynthesis;
        const text2 = "Ahora le voy a leer la misma lista de palabras una vez más. Intente acordarse del mayor número posible de palabras, incluyendo las que repitió en la primera ronda";
        const utterance2 = new SpeechSynthesisUtterance(text2);
        utterance2.rate = 0.7;
        synthesis.speak(utterance2);
        this.wordsbyone();

        const text3 = "Le volveré a preguntar estas palabras al final de la prueba";
        const utterance3 = new SpeechSynthesisUtterance(text3);
        utterance3.rate = 0.7;
        synthesis.speak(utterance3);
        
        setTimeout(() => {
            if(this.attempt == 2){
            this.$emit('answer-score', 0);
          }
        }, 25000);
      },
      removeSpaces(index) {
        // Elimina espacios en blanco de la palabra recordada
        this.rememberedWords[index] = this.rememberedWords[index].trim();
      },
    },
  };
</script>
  
  