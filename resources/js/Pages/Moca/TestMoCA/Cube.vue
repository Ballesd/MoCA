<template>
    <div class="flex items-center justify-center space-x-12 my-12">
        <div class="w-8/12 flex flex-col gap-4">
            <div class="flex justify-center items-center space-x-3">
                <h2 class="text-primary text-3xl">2. Capacidades visuaconstructivas</h2>
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4">
                <p class="text-gray-500 text-center">Copie esta figura lo mejor posible.</p>
            </div>
            <UploadFile :uploadedImage="uploadedImage" />
        </div>
        <div class="p-4 h-64">
            <img class="w-full h-full" src="../../../../../public/storage/images/cube.png" alt="Logo" />
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
    const text1 = 'Me gustaría que copiara el dibujo de un cube tal cual como está en la pantalla de la manera más precisa posible, posteriormente suba la imagen.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.6;
    synthesis.speak(utterance);
};

const uploadedImage = async (fileInfo) => {
    const formData = new FormData();
    formData.append('image_cube', fileInfo);
    const response = await axios.post('/moca/uploadcube', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
    console.log('respuesta:', response);
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
