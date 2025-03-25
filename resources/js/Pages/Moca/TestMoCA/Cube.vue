<template>
    <div class="flex flex-col lg:flex-row items-center justify-center lg:space-x-24 space-y-6 lg:space-y-0 my-12">
        <!-- Contenedor de Texto -->
        <div class="w-full lg:w-8/12 flex flex-col gap-4 px-4 pb-5">
            <div class="flex justify-center items-center space-x-6">
                <font-awesome-icon
                    :icon="['fas', 'volume-up']"
                    size="2x"
                    class="text-secondary cursor-pointer hover:text-primary"
                    @click="speachIntroduction"
                />
                <h2 class="text-primary text-xl sm:text-2xl md:text-3xl  lg:text-left">
                    2. Capacidades visoconstructivas
                </h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4">
                <p class="text-base sm:text-lg ">
                    Copie esta figura lo mejor posible, posteriormente suba la imagen.
                </p>
            </div>
            <UploadFile v-model="clicked" :uploadedImage="uploadedImage" />
        </div>

        <!-- Contenedor de Imagen -->
        <div class="p-4 h-56 w-full lg:w-auto">
            <img
                class="w-full h-full object-contain lg:object-cover rounded-lg max-w-xs sm:max-w-sm md:max-w-md lg:max-w-none"
                src="images/cube.png"
                alt="Logo"
            />
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
    const text1 =
        'Me gustaría que copiara esta figura de la manera más precisa posible, posteriormente suba la imagen';
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance(text1);
    utterance.rate = 0.7;
    utterance.lang = 'es-CO';
    synthesis.speak(utterance);
};

const uploadedImage = async (fileInfo) => {
    const formData = new FormData();
    formData.append('image_cube', fileInfo);
    const response = await axios.post('/moca/uploadcube', formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
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
