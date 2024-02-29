<template>
    <div class="m-4 bg-white p-4 shadow-md rounded-lg">
      <div class="mb-8 text-center">
        <h2 class="text-2xl font-semibold">9. Test de Abstracción</h2>
        <p class="text-gray-600">Explique qué tienen en común
          cada pareja de palabras.
        </p>
      </div>
      <!-- Pregunta 1 -->
      <div class="mb-4">
        <label class="block text-lg font-medium mb-2">1. "naranja/plátano"</label>
        <input
          v-model="respuestaPregunta1"
          @input="calificarPregunta1"
          class="border border-gray-300 rounded-md p-2 w-full"
          placeholder="Ingrese su respuesta"
        />
        <p class="text-sm text-gray-500 mt-1">Escriba la respuesta y presione Enter para calificar.</p>
      </div>
  
      <!-- Pregunta 2 -->
      <div class="mb-4">
        <label class="block text-lg font-medium mb-2">2. "tren/bicicleta"</label>
        <input
          v-model="respuestaPregunta2"
          @input="calificarPregunta2"
          class="border border-gray-300 rounded-md p-2 w-full"
          placeholder="Ingrese su respuesta 'pista: medios'"
        />
        <p class="text-sm text-gray-500 mt-1">Escriba la respuesta y presione Enter para calificar.</p>
      </div>
  
      <!-- Pregunta 3 -->
      <div class="mb-4">
        <label class="block text-lg font-medium mb-2">3. "regla/reloj"</label>
        <input
          v-model="respuestaPregunta3"
          @input="calificarPregunta3"
          class="border border-gray-300 rounded-md p-2 w-full"
          placeholder="Ingrese su respuesta 'pista: instrumentos'"
        />
        <p class="text-sm text-gray-500 mt-1">Escriba la respuesta y presione Enter para calificar.</p>
      </div>
  
      <!-- Botón para enviar respuestas -->
      <button @click="calcularPuntuacion" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md mt-4">
        Enviar Respuestas
      </button>
  
      <!-- Resultados -->
      <div class="mt-4" v-if="puntuacionPregunta1 !== null && puntuacionPregunta2 !== null && puntuacionPregunta3 !== null">
        <h2 class="text-lg font-semibold mb-2">Resultados:</h2>
        <p>Pregunta 1: {{ puntuacionPregunta1 }}</p>
        <p>Pregunta 2: {{ puntuacionPregunta2 }}</p>
        <p>Pregunta 3: {{ puntuacionPregunta3 }}</p>
        <p class="text-xl font-bold mt-2">Puntuación Total: {{ puntuacionTotal }}</p>
      </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      respuestaPregunta1: "",
      respuestaPregunta2: "",
      respuestaPregunta3: "",
      puntuacionPregunta1: null,
      puntuacionPregunta2: null,
      puntuacionPregunta3: null,
      puntuacionTotal: null,
    };
  },
  methods: {
    calificarPregunta1() {
      // Comparar la respuesta de la pregunta 1 con la respuesta esperada (sin distinguir tildes ni mayúsculas)
      if (this.normalizeString(this.respuestaPregunta1) === this.normalizeString("frutas")) {
        this.puntuacionPregunta1 = "Correcto";
      } else {
        this.puntuacionPregunta1 = "Incorrecto";
      }
    },
    calificarPregunta2() {
      // Comparar la respuesta de la pregunta 2 con la respuesta esperada (sin distinguir tildes ni mayúsculas)
      if (this.normalizeString(this.respuestaPregunta2) === this.normalizeString("medios de transporte")) {
        this.puntuacionPregunta2 = "Correcto";
      } else {
        this.puntuacionPregunta2 = "Incorrecto";
      }
    },
    calificarPregunta3() {
      // Comparar la respuesta de la pregunta 3 con la respuesta esperada (sin distinguir tildes ni mayúsculas)
      if (this.normalizeString(this.respuestaPregunta3) === this.normalizeString("instrumentos de medición")) {
        this.puntuacionPregunta3 = "Correcto";
      } else {
        this.puntuacionPregunta3 = "Incorrecto";
      }
    },
    calcularPuntuacion() {
      // Calcular la puntuación total
      let puntuacionTotal = 0;

      if (this.puntuacionPregunta2 === "Correcto") {
        puntuacionTotal++;
      }

      if (this.puntuacionPregunta3 === "Correcto") {
        puntuacionTotal++;
      }

      this.puntuacionTotal = puntuacionTotal;

      const answer = {
        abstraction_answer: this.respuestaPregunta1 + ", " + this.respuestaPregunta2 + ", " + this.respuestaPregunta3,
      };
      //'/moca/uploadAbstraction'
      axios.post('/moca/uploadAbstraction', answer)
        .catch(error => {
          console.log(error);
        });
      

      console.log("Puntuación Total:", this.puntuacionTotal);
      this.$emit("answer-score", this.puntuacionTotal);
    },
    normalizeString(str) {
      // Función para normalizar una cadena eliminando tildes y convirtiendo a minúsculas
      return str
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .toLowerCase();
    },
  },
};
</script>