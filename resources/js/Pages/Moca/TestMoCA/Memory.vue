<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg">
    <div class="mb-8 text-center">
      <h2 class="text-2xl font-semibold">5. Fase de Memoria</h2>
      <p class="text-gray-600">“Esta es una prueba de memoria. Lea la siguiente
          lista de palabras que debe recordar. Lea con atención. Cuando acabe,
          escriba todas las palabras que pueda recordar (una por cada casilla). No importa el orden en el que las
          copie”.
      </p>
    </div>
    <div class="p-4">
      <!-- Mostrar palabras a recordar -->
      <div v-if="!showAttempt">
          <h2 class="text-2xl font-semibold mb-4">Palabras a recordar:</h2>
          <ul class="list-disc ml-4">
            <li v-for="word in words" :key="word">{{ word }}</li>
          </ul>
          <button
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
        maxAttempts: 3,
        rememberedWords: ["", "", "", "", ""],
        answer: ["ROSTRO", "SEDA", "TEMPLO", "CLAVEL", "ROJO"], // Respuesta predefinida
      };
    },
    methods: {
      startAttempt() {
        this.showAttempt = true;
        this.rememberedWords = ["", "", "", "", ""];
      },
      recordAttempt() {
        if(this.attempt == 2){
          this.$emit('answer-score', 0);
        }
        this.attempt++;
        this.startAttempt();
      },
      removeSpaces(index) {
        // Elimina espacios en blanco de la palabra recordada
        this.rememberedWords[index] = this.rememberedWords[index].trim();
      },
    },
  };
</script>
  
<style scoped>
  /* Estilos de Tailwind CSS aquí */
</style>
  