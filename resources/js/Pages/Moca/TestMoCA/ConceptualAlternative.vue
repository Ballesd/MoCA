<template>
    <div class="flex flex-col lg:flex-row items-center justify-center lg:space-x-12  lg:space-y-0">
        <!-- Contenedor de la Imagen -->
        <div class="p-4 h-96 w-full lg:w-auto">
            <img class="w-full h-full object-contain lg:object-cover rounded-lg max-w-xs sm:max-w-sm md:max-w-md lg:max-w-none"
                src="../../../../../public/images/grafo.gif" alt="Logo" />
        </div>

        <!-- Contenedor del Texto -->
        <div class="w-full lg:w-1/2 flex flex-col gap-4 px-4 pb-10">
            <div class="flex justify-center items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x"
                    class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
                <h2 class="text-primary text-xl sm:text-2xl md:text-3xl text-center lg:text-left">
                    1. Fase de Alternancia Conceptual
                </h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4">
                <p class="text-base sm:text-lg text-justify">
                    Una los círculos con una línea alternando entre número y letra siguiendo el orden numérico y del
                    abecedario. Comience en el número 1 y dibuje una línea desde el 1 hacia la letra A, a continuación,
                    de la A hacia el 2 y así sucesivamente.
                    Posteriormente, suba la imagen.
                </p>
            </div>
            <UploadFile v-model="clicked" :uploadedImage="uploadedImage" />
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import UploadFile from '@/Components/UploadFile.vue';

// Propiedad para recibir la función sendNumber del padre
const { sendNumber } = defineProps(['sendNumber']);

// Variables reactivas
const result = ref(null);
const clicked = ref(false); // Estado para v-model en UploadFile

// Reproduce el texto en voz
const speachIntroduction = () => {
    const text1 = 'Una los círculos con una línea alternando entre número y letra siguiendo el orden numérico y del abecedario. Comience en el numero 1 y dibuje una línea desde el 1 hacia la letra A , a continuación, de la A hacia el 2 y así sucesivamente. Posteriormente, suba la imagen.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO";
    synthesis.speak(utterance);
};

// Subir la imagen y manejar la respuesta del servidor
const uploadedImage = async (fileInfo) => {
    const formData = new FormData();
    formData.append('image_conceptual_alternative', fileInfo);
    const response = await axios.post('/moca/uploadConceptualAlternative', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });

    // console.log('Respuesta del servidor:', response.data);
    result.value = null;
    window.speechSynthesis.cancel();


};

// Depurar cambios en clicked
watch(clicked, (newValue) => {
    if (newValue) {
        sendNumber(result.value);
    }
});
</script>
