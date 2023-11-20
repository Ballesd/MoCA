<template>
  <div class="m-4 bg-white p-4 shadow-md rounded-lg">
    <div class="mb-8 text-center">
      <h2 class="text-2xl font-semibold">2. Fase de Alternancia Conceptual</h2>
      <p class="text-gray-600">Por favor, copia el dibujo de la manera más precisa posible.</p>
    </div>
    <div class="flex flex-col lg:flex-row items-center">
      <!-- Ejemplo del cubo -->
      <div class="w-48 md:w-64 lg:w-80 mx-auto">
        <div class="bg-blue-200 rounded-lg overflow-hidden shadow-lg aspect-ratio-1">
          <!-- Imagen de ejemplo del cubo -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-white">
            <path d="M51.7 17.8 37 32.5V131h95.6l15.2-15.2 15.2-15.3V3H66.5L51.7 17.8zM157 6.8c0 .4-5.8 6.5-12.9 13.5L131.3 33l-30.9-.2-30.9-.3-.3-13.3L68.9 6H113c24.2 0 44 .4 44 .8zM65.8 20.7l-.3 11.8-11.3.3c-7 .2-11.3-.1-11-.7C43.7 30.6 64.4 9 65.3 9c.4 0 .6 5.3.5 11.7zM160 54v44h-26V34.8l12.2-12.4c6.7-6.8 12.5-12.4 13-12.4.4 0 .8 19.8.8 44zM66 67.2v31.3l-12.7 12.7c-7 7.1-13.1 12.8-13.5 12.8-1 0-1.1-86.4-.1-87.3.3-.4 6.4-.7 13.5-.7H66v31.2zm64.8-.5-.3 30.8-30.7.3L69 98V36h62l-.2 30.7zm0 47.5.3 12.8H87c-35.4 0-43.9-.3-43.3-1.3.4-.7 6-6.5 12.3-12.9l11.5-11.7 31.5.2 31.5.2.3 12.7zm26.2-12.5c0 1-21.3 22.3-22.2 22.3-.5 0-.8-5.2-.8-11.5V101h11.5c6.3 0 11.5.3 11.5.7z" />
          </svg>
        </div>
      </div>

      <!-- Área de dibujo -->
      <div class="w-full lg:w-1/2">
        <input type="file" accept="image/*" @change="handleImageUpload" class="mt-4" />
        <button @click="checkDrawing" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Evaluar Dibujo</button>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue';

  const handleImageUpload = (event) => {
    const file = event.target.files[0];
    // Handle the uploaded image file
  };

  const checkDrawing = () => {
    // Perform drawing evaluation logic
  };
</script>

<style scoped>
/* Estilos CSS para el componente */
.example-cube {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  padding: 20px;
  height: 100%;
}

.drawing-canvas {
  cursor: crosshair;
}
</style>
  