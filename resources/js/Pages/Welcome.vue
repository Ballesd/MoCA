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
                <h1 class="text-5xl font-normal text-secondary text-center">Evaluación Cognitiva Montreal</h1>
                <div>
                    <LinkCustom :href="route('register')">REGISTRARME</LinkCustom>
                </div>
            </div>
            <div class="w-1/2">
                <div class="flex flex-col w-full h-full bg-main bg-no-repeat bg-cover bg-center rounded-t-3xl p-20 text-xl gap-10">
                    <h1 class="text-senary font-thin text-4xl">¿De qué se trata?</h1>
                    <p class="text-black leading-relaxed font-light">
                        El aplicativo MoCA es una herramienta de tamizaje que realiza un escaneo de las funciones cognitivas a través de pruebas estandarizadas. Su versión digital se ha desarrollado para facilitar el acceso a la población interesada
                        en conocer sus procesos cognitivos, logrando un mayor alcance en la identificación temprana de cambios cognitivos para la generación de estrategias de intervención en la prevención del declive cognitivo y demencias. La
                        ejecución de este test de tamizaje puede tomar de 10 a 20 minutos aproximadamente y sus resultados también contribuirán en las investigaciones sobre los procesos neurodegenerativos.
                    </p>
                    <p class="text-black leading-relaxed font-light">El tiempo de ejecución de este test puede tomar 10 a 15 minutos aproximadamente.</p>
                    <div class="flex flex-col items-end">
                        <a :href="route('knowmore')" class="border-2 px-6 border-black text-black rounded"> SABER MÁS </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
