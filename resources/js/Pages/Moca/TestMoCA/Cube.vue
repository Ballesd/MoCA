<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
    <div class="flex justify-center items-center space-x-2">
      <h2 class="text-lg font-semibold flex items-center">2. Fase de Alternancia Conceptual</h2>
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
    <p class="text-gray-600">Por favor, copia el dibujo de la manera más precisa posible y sube la imagen.</p>
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

  const speachIntroduction = () => {
    const text1 = "Me gustaría que copiara el dibujo de un cube tal cual como está en la pantalla de la manera más precisa posible, posteriormente suba la imagen."
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6; 
    synthesis.speak(utterance);
  }


  const uploadedImage = async () => {
    const formData = new FormData();
    formData.append('image_cube', image.value);
    const response = await axios.post('/moca/uploadcube', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    console.log("respuesta:",response);
    result.value = null;
    sendNumber(result.value);
  };
</script>

<style scoped>
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
  