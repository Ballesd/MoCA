<template>
    <div class="flex items-center justify-center space-x-12">
        <div class="p-4 h-96">
            <img class="w-full h-full" src="../../../../../public/images/grafo.gif" alt="Logo" />
        </div>
        <div class="w-1/2 flex flex-col gap-4">
            <div class="flex justify-center items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
                <h2 class="text-primary text-3xl">1. Fase de Alternancia Conceptual</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4">
                <p class="text-gray-500">Una los círculos con una línea alternando entre número y letra siguiendo el orden numérico y del abecedario.</p>
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
    const text1 =
        'Me gustaría que dibujara una línea alternando entre cifras y letras, respetando el orden numérico y el orden alfabético. Comience en el numero 1 y dibuje una línea desde el 1 hacia la letra A , a continuación, de la A hacia el 2 y así sucesivamente. Termine en la letra E.';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = "es-CO" 
    synthesis.speak(utterance);
    
};

const uploadedImage = async (fileInfo) => {
    const formData = new FormData();
    formData.append('image_conceptual_alternative', fileInfo);
    const response = await axios.post('/moca/uploadConceptualAlternative', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
    result.value = null;
    sendNumber(result.value);
    window.speechSynthesis.cancel();
    
};
</script>
