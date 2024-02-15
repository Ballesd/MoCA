<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
    <div class="">
      <p class="text-lg font-semibold">1. Fase de Alternancia Conceptual</p>
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
    <div class="mb-4">
      <ConceptualAleLogo class="w-full max-w-2xl mx-auto rounded" />
    </div>
  </div>
</template>
  
<script setup>
  import { onMounted, ref } from 'vue';
  import ConceptualAleLogo from '@/Components/ConceptualAleLogo.vue';
  import axios from 'axios';

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
    const text1 = "Me gustaría que dibujara una línea alternando entre cifras y letras, respetando el orden numérico y el orden alfabético. Comience en el numero 1 y dibuje una línea desde el 1 hacia la letra A y, a continuación, de la A hacia el 2 y así sucesivamente. Termine en la letra E."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6; // Ajusta este valor para cambiar la velocidad
    synthesis.speak(utterance);
  }


  const uploadedImage = async () => {
    const formData = new FormData();
    formData.append('image_conceptual_alternative', image.value);
    const response = await axios.post('/moca/uploadConceptualAlternative', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    console.log("respuesta:",response);
    result.value = null;
    sendNumber(result.value);
  };
</script>