<template>
    <div class="m-4 bg-white p-4 shadow-md rounded-lg">
      <div class="mb-8 text-center">
        <h2 class="text-2xl font-semibold">3. Reloj </h2>
      </div>
      <div class="container mx-auto pt4">
        <div class="flex justify-center">
          <form action="" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Imagen
                </label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                  id="grid-password"
                  type="file"
                  accept="image/*"
                  @change="handleImageUpload"
                />
                <p class="text-gray-600 text-xs italic">Cargue la imagen de su dibujo</p>
              </div>
            </div>
            <div v-if="image" class="flex justify-center">
              <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button"
                @click="uploadedImage"
              >
                Cargar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
</template>

<script setup>

  import { ref } from 'vue';
  import axios from 'axios';
  import { onMounted } from 'vue';

  const { sendNumber } = defineProps(['sendNumber']); 

  const image = ref(null);
  const result = ref(null);

  const handleImageUpload = (event) => {
    image.value = event.target.files[0];
  };

  onMounted(() => {
    speachIntroduction();
  });

  const speachIntroduction = () => {
    const text1 = "Dibuje un reloj. Incluya todos los números y dibújelo señalando las 11 y 10 minutos. Recalco  11 y 10 minutos. Posteriormente suba la imagen."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6; // Ajusta este valor para cambiar la velocidad
    synthesis.speak(utterance);
  }

  const uploadedImage = async () => {
    const formData = new FormData();
    formData.append('image_clock', image.value);
    const response = await axios.post('/moca/uploadclock', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    console.log("respuesta:",response);
    result.value = null;
    sendNumber(result.value);
  };
</script>