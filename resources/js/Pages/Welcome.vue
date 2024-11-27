<script setup>
import LinkCustom from '@/Components/LinkCustom.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
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
        <div class="h-full flex justify-center gap-10">
            <div class="w-1/2 flex flex-col justify-end items-center pb-24 gap-10">
                <h1 class="text-4xl sm:text-4xl md:text-5xl font-normal text-secondary text-center">Evaluación Cognitiva Montreal</h1>
                <div class = text-black>
                    <LinkCustom  :href="route('register')">REGISTRARME</LinkCustom>
                </div>
            </div>
            <div class="w-1/2">
                <div class="flex flex-col w-full bg-main bg-opacity-40 bg-no-repeat bg-cover bg-center rounded-t-3xl p-6 sm:p-16 md:p-20 text-xl gap-8">
                    <h1 class="text-senary font-normal text-2xl sm:text-3xl md:text-4xl   ">¿De qué se trata?</h1>
                    <div class="max-w-md md:max-w-lg lg:max-w-xl mx-auto ">
                        <p class="text-black leading-relaxed font-thin text-base sm:text-lg md:text-xl">
                            El aplicativo MoCA es una herramienta de tamizaje que realiza un escaneo de las funciones cognitivas a través de pruebas estandarizadas. Su versión digital se ha desarrollado para facilitar el acceso a la población interesada
                            en conocer sus procesos cognitivos, logrando un mayor alcance en la identificación temprana de cambios cognitivos para la generación de estrategias de intervención en la prevención del declive cognitivo y demencias. 
                        </p>
                    </div>
                    <div class="max-w-md md:max-w-lg lg:max-w-xl mx-auto ">

                        <p class="text-black leading-relaxed font-thin text-base sm:text-lg md:text-xl">
                            La ejecución de este test de tamizaje puede tomar de 10 a 20 minutos aproximadamente y sus resultados también contribuirán en las investigaciones sobre los procesos neurodegenerativos.</p>
                        <!-- <p class="text-black leading-relaxed font-normal">El tiempo de ejecución de este test puede tomar  de 10 a 15 minutos aproximadamente .</p> -->
                    </div>
                    <div class="flex flex-col items-end">
                        <a :href="route('knowmore')" class="border-2 px-6 border-black text-black rounded font-normal text-base sm:text-lg md:text-xl"> SABER MÁS </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
