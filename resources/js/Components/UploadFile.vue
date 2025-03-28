<template>
    <div v-if="!image">
        <button
            @click="triggerFileUpload"
            class="w-full justify-center text-white inline-flex items-center px-5 py-2 bg-secondary border border-transparent rounded-md font-thin uppercase tracking-widest hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer"
        >
            Subir archivo
        </button>
        <input
            ref="fileInputRef"
            type="file"
            class="hidden"
            accept="image/*"
            @change="handleImageUpload"
        />
    </div>
    <div v-else class="bg-tertiary rounded-md shadow-lg p-5 flex gap-4 relative">
        <div class="h-36 w-2/5 bg-quinary rounded-md">
            <img :src="image" class="h-full w-full object-cover" alt="Vista previa de imagen" />
        </div>
        <div class="flex flex-col w-3/5 justify-between">
            <p class="text-center text-sm">IMAGEN SUBIDA CON ÉXITO</p>
            <div class="flex flex-col gap-4">
                <p class=" text-center text-sm">
                    Si desea cambiarla, Por favor haga click en subir otra imagen
                </p>
                <p @click="removeImage" class="text-center underline text-sm cursor-pointer">
                    SUBIR OTRA IMAGEN
                </p>
            </div>
            <ButtonCustom class="w-full mt-4" mode="button" @click="handleNext">
                SIGUIENTE
            </ButtonCustom>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';

// Props y eventos
const props = defineProps({
    modelValue: Boolean,
    uploadedImage: Function
});
const emit = defineEmits(['update:modelValue']);

// Variables locales
const image = ref(null);
const fileInfo = ref(null);
const fileInputRef = ref(null); // Referencia al input de archivos

// Función para abrir manualmente el explorador de archivos
const triggerFileUpload = () => {
    fileInputRef.value.click(); // Simula el clic en el input de archivos
};

// Manejar subida de imagen
const handleImageUpload = (event) => {
    const file = event.target.files[0];
    fileInfo.value = file;
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            image.value = e.target.result; // Mostrar vista previa de la imagen
            props.uploadedImage(fileInfo.value); // Llamar a la función de subida
        };
        reader.readAsDataURL(file); // Leer archivo como URL de datos
    }
};

// Eliminar la imagen cargada
const removeImage = () => {
    image.value = null;
    fileInfo.value = null;
};

// Emitir evento para cambiar el estado de modelValue
const handleNext = () => {
    console.log('Botón SIGUIENTE presionado');
    emit('update:modelValue', true); // Cambia el valor de clicked en el componente padre
};
</script>