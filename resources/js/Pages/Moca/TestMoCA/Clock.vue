<template>
    <div class="flex items-center justify-center space-x-12 mt-16 mb-10 ">
        <div class="w-full sm:w-7/12 flex flex-col gap-5 px-5">
            <div class="flex items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
                <h2 class="text-primary text-xl sm:text-2xl md:text-3xl">3. Capacidades visoconstructivas</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 ">
                <p class="text-base sm:text-lg text-justify hyphens-auto sm:hyphens-none">Dibuje un reloj colocando los números en las posiciones correctas y ajustando las manecillas para marcar la hora de 11:10, posteriormente suba la imagen.</p>
            </div>

            <UploadFile  v-model="clicked" :uploadedImage="uploadedImage" />
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import UploadFile from '@/Components/UploadFile.vue';

const { sendNumber } = defineProps(['sendNumber']);

const result = ref(null);
const clicked = ref(false); // Estado para v-model en UploadFile

const speachIntroduction = () => {
    const text1 = 'Dibuje un reloj. Incluya todos los números y dibújelo señalando las 11 y 10 minutos. Recalco  11 y 10 minutos. Posteriormente suba la imagen.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO" 
    synthesis.speak(utterance);
};

const uploadedImage = async (fileInfo) => {
    const formData = new FormData();
    formData.append('image_clock', fileInfo);
    const response = await axios.post('/moca/uploadclock', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
    console.log(response.data);
    result.value = null;
    window.speechSynthesis.cancel();

    
};

watch(clicked, (newValue) => {
    if (newValue){ 
        sendNumber(result.value);
    }
});
</script>
