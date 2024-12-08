<script setup>
import LinkCustom from '@/Components/LinkCustom.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, ref } from 'vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String
});

const isNavOpen = ref(false);

const toggleNav = () => {
    isNavOpen.value = !isNavOpen.value;
};
</script>

<template>
    <AppLayout title="Inicio" :bgNetwork="false">
        <div class="h-full flex flex-col lg:flex-row justify-center items-center gap-10 px-6 sm:px-10 md:px-20 py-10">
            <!-- Sección Izquierda -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center gap-6 pb-10 lg:pb-24 text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-semibold text-secondary leading-tight">
                    Evaluación Cognitiva Montreal
                </h1>
                <div class="text-black mt-4">
                    <LinkCustom :href="route('register')" class="px-6 py-3 border-2 border-black rounded text-base sm:text-lg hover:bg-black hover:text-white transition">
                        REGISTRARME
                    </LinkCustom>
                </div>
            </div>

            <!-- Sección Derecha -->
            <div class="w-full lg:w-1/2 bg-main bg-opacity-40 bg-no-repeat bg-cover bg-center rounded-3xl p-6 sm:p-8 md:p-12 lg:p-16 space-y-6">
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-800">
                    ¿De qué se trata?
                </h2>
                <div class="text-gray-700 leading-relaxed space-y-4">
                    <p class="text-base sm:text-lg md:text-xl">
                        El aplicativo <strong>MoCA</strong> es una herramienta de tamizaje que realiza un escaneo de las funciones cognitivas a través de pruebas estandarizadas. Su versión digital se ha desarrollado para facilitar el acceso a la población interesada en conocer sus procesos cognitivos, logrando un mayor alcance en la identificación temprana de cambios cognitivos para la generación de estrategias de intervención en la prevención del declive cognitivo y demencias.
                    </p>
                    <p class="text-base sm:text-lg md:text-xl">
                        La ejecución de este test de tamizaje puede tomar de <strong>10 a 20 minutos</strong> aproximadamente, y sus resultados también contribuirán en las investigaciones sobre los procesos neurodegenerativos.
                    </p>
                </div>
                <div class="flex justify-end">
                    <a :href="route('knowmore')" 
                       class="border-2 px-6 py-3 border-black text-black rounded font-normal text-base sm:text-lg md:text-xl hover:bg-black hover:text-white transition">
                        SABER MÁS
                    </a>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
