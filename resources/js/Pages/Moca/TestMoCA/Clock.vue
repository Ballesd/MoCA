<template>
    <div class="flex items-center justify-center space-x-12 mt-16 mb-10">
        <div class="w-7/12 flex flex-col gap-4">
            <div class="flex justify-center items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
                <h2 class="text-primary text-3xl">3. Capacidades visuoconstructivas</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4">
                <p class="text-gray-500">Dibuje un reloj colocando los números en las posiciones correctas y ajustando las manecillas para marcar la hora de 11:10.</p>
            </div>
            <UploadFile :uploadedImage="uploadedImage" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import UploadFile from '@/Components/UploadFile.vue';

const { sendNumber } = defineProps(['sendNumber']);

const result = ref(null);

const speachIntroduction = () => {
    const text1 = 'Dibuje un reloj. Incluya todos los números y dibújelo señalando las 11 y 10 minutos. Recalco  11 y 10 minutos. Posteriormente suba la imagen.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6; // Ajusta este valor para cambiar la velocidad
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
    console.log('respuesta:', response);
    result.value = null;
    sendNumber(result.value);
};
</script>
