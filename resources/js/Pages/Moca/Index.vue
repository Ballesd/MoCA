<template>
    <AppLayout title="Dashboard">
        <div v-if="!showEndTest" class="flex flex-col items-center justify-center my-5">
            <transition name="slide-fade" mode="out-in">
                <component :sendNumber="receive_number" @answer-score="receive_number" :is="currentComponent" :key="componentKey" />
            </transition>
        </div>
        <div v-else class="flex justify-center items-center mt-16">
            
            <div class="flex flex-col gap-12 w-4/5 sm:w-2/3">
                <h2 class="text-primary text-3xl sm:text-5xl font-thin text-center">Usted ha finalizado el test MoCA</h2>
                <p class=" flex flex-col text-2xl gap-4 text-justify hyphens-auto sm:hyphens-none">
                    Ha finalizado. Los resultados serán analizados por el profesional tratante y posteriormente recibirá las recomendaciones derivadas de sus desempeños. ¡Gracias por su participación!.
                </p>
                <!-- <div class="flex justify-end">
                    <LinkCustom :href="route('dashboard')">VOLVER AL INICIO</LinkCustom>
                </div> -->
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

import ConceptualAlternative from '@/Pages/Moca/TestMoCA/ConceptualAlternative.vue';
import Cube from '@/Pages/Moca/TestMoCA/Cube.vue';
import Clock from '@/Pages/Moca/TestMoCA/Clock.vue';
import Identification from '@/Pages/Moca/TestMoCA/Identification.vue';
import Memory from '@/Pages/Moca/TestMoCA/Memory.vue';
import Attention from '@/Pages/Moca/TestMoCA/Attention.vue';
import Lemgua from '@/Pages/Moca/TestMoCA/Language.vue';
import VerbalFluency from '@/Pages/Moca/TestMoCA/Verbalfluency.vue';
import Abstraction from '@/Pages/Moca/TestMoCA/Abstraction.vue';
import DeferredRecall from '@/Pages/Moca/TestMoCA/DeferredRecall.vue';
import Orientation from '@/Pages/Moca/TestMoCA/Orientation.vue';
import EndTest from '@/Pages/Moca/TestMoCA/EndTest.vue';
import LinkCustom from '@/Components/LinkCustom.vue';

// Definir un array con los componentes
const components = [ConceptualAlternative, Cube, Clock, Identification, Memory, Attention, Lemgua, VerbalFluency, Abstraction, DeferredRecall, Orientation, EndTest];
const componentCalification = ref({
    ConceptualAlternative: 0,
    Cube: 0,
    Clock: 0,
    Identification: 0,
    Memory: 0,
    Attention: 0,
    Lemgua: 0,
    VerbalFluency: 0,
    Abstraction: 0,
    DeferredRecall: 0,
    Orientation: 0,
    total: 0
});

const componentVector = ref(['ConceptualAlternative', 'Cube', 'Clock', 'Identification', 'Memory', 'Attention', 'Lemgua', 'VerbalFluency', 'Abstraction', 'DeferredRecall', 'Orientation', 'EndTest']);

const total = ref(0);

const showEndTest = ref(false);

const receive_number = (number) => {

    componentCalification.value[componentVector.value[currentComponentIndex.value]] = number;

    //Sumamos todas las calificaciones
    if (number != null) {
        total.value += number;
    }
    //SI ya ha recorrido todos los componentes
    if (currentComponentIndex.value == components.length - 2) {
        sendCalification();
    }
    showNext();
};

const sendCalification = async () => {
    componentCalification.value.total = total.value;
    const response = await axios.post('/moca/calification', componentCalification.value);

};

const currentComponentIndex = ref(0);

const componentKey = ref(0);

const currentComponent = computed(() => components[currentComponentIndex.value]);

const showNext = () => {
    if (currentComponentIndex.value < components.length - 1) {
        currentComponentIndex.value++;
        componentKey.value++;
    }
    if (currentComponentIndex.value == 11) {
        showEndTest.value = true;
    }
};
</script>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: opacity 0.5s;
}
.slide-fade-enter,
.slide-fade-leave-to {
    opacity: 0;
}
</style>
