<template>
    <div v-if="!image">
        <label
            for="file-upload"
            class="w-full justify-center text-white inline-flex items-center px-5 py-2 bg-secondary border border-transparent rounded-md font-thin uppercase tracking-widest hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer"
        >
            Subir archivo
        </label>
        <input id="file-upload" type="file" class="hidden" accept="image/*" @change="handleImageUpload" />
    </div>
    <div v-else class="bg-tertiary rounded-md shadow-lg p-5 flex gap-4 relative">
        <div class="h-36 w-2/5 bg-quinary rounded-md">
            <img :src="image" class="h-full w-full object-cover" alt="Vista previa de imagen" />
        </div>
        <div class="flex flex-col w-3/5 justify-between">
            <p class="text-gray-500 text-center text-sm">IMAGEN SUBIDA CON ÉXITO</p>
            <!-- <div>
                <p class="text-gray-500 text-center text-sm">{{ fileInfo?.name }}</p>
                <p class="text-gray-500 text-center text-sm">{{ fileInfo?.size }} KB</p>
            </div> -->
            <div class="flex flex-col gap-4">
                <p class="text-gray-500 text-center text-xs">SI DESEA CAMBIARLA, POR FAVOR HAGA CLICK EN SUBIR OTRA IMAGEN</p>
                <p @click="removeImage" class="text-gray-500 text-center underline text-sm cursor-pointer">SUBIR OTRA IMAGEN</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';

const image = ref(null);
const fileInfo = ref(null);
const props = defineProps({
    uploadedImage: Function
});
const handleImageUpload = (event) => {
    const file = event.target.files[0];
    fileInfo.value = file;
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            image.value = e.target.result;
            props.uploadedImage(fileInfo.value);
        };
        reader.readAsDataURL(file); // Lee el archivo como una URL de datos
    }
};

// Función para eliminar la imagen cargada
const removeImage = () => {
    image.value = null;
    fileInfo.value = null;
};
</script>
