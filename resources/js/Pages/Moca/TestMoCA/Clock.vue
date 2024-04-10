<template>
  <div class="m-4 p-4 bg-white shadow-md rounded-lg text-center">
    <div class="flex justify-center items-center space-x-2">
      <h2 class="text-lg font-semibold flex items-center">3. Reloj</h2>
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