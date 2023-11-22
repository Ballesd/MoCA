<template>
    <AppLayout title="Dashboard">
        <div class="bg-green-200  min-h-screen flex items-center justify-center">
            <div class="bg-neutral-300 max-w-xl mx-4 bg-white shadow-lg rounded-lg overflow-hidden sm:rounded-xl sm:shadow-2xl md:max-w-2xl lg:max-w-4xl xl:max-w-5xl sm:mx-auto">
                <div class="relative">
                    <transition name="slide-fade" mode="out-in">
                        <component :sendNumber="receive_number"  @answer-score="receive_number" :is="currentComponent" :key="componentKey" />
                    </transition>
                </div>
                <div class="text-center mt-4">
                    <button @click="showNext" type="button" class="relative group bg-gradient-to-r from-blue-500 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center inline-flex items-center dark:bg-gradient-to-r dark:from-blue-600 dark:to-blue-800 dark:hover:from-blue-700 dark:hover:to-blue-900 dark:focus:ring-blue-800 transition-transform transform-gpu duration-300 ease-in-out">
                        <svg class="w-6 h-6 ml-2 transition-transform transform-gpu group-hover:translate-x-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                </div>
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
    
    // Definir un array con los componentes
    const components = [
        ConceptualAlternative,
        Cube,
        Clock,
        Identification,
        Memory,
        Attention,
        Lemgua,
        VerbalFluency,
        Abstraction,
        DeferredRecall,
        Orientation
    ];
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
        Orientation: 0
    });

    const componentVector = ref([
        "ConceptualAlternative",
        "Cube",
        "Clock",
        "Identification",
        "Memory",
        "Attention",
        "Lemgua",
        "VerbalFluency",
        "Abstraction",
        "DeferredRecall",
        "Orientation"
    ]);

    const enteroRecibido = ref(null);

    const receive_number = (number) => {
        console.log("index",currentComponentIndex.value);
        console.log("vector",componentVector.value[currentComponentIndex.value]);

        componentCalification.value[componentVector.value[currentComponentIndex.value]] = number;

        console.log("calificacion",componentCalification.value);
        // Call the showNext function to display the next component
        showNext();

    };
    // Estado para rastrear el índice del componente actual
    const currentComponentIndex = ref(0);
    
    // Estado para rastrear el valor de componentKey
    const componentKey = ref(0);
    
    // Función para obtener el componente actual
    const currentComponent = computed(() => components[currentComponentIndex.value]);
    
    // Función para mostrar el componente siguiente
    const showNext = () => {
        if (currentComponentIndex.value < components.length - 1) {
        currentComponentIndex.value++;
        componentKey.value++; // Actualiza el valor de componentKey
        }
    };
</script>
  
  <style scoped>
  .slide-fade-enter-active, .slide-fade-leave-active {
    transition: opacity 0.5s;
  }
  .slide-fade-enter, .slide-fade-leave-to {
    opacity: 0;
  }
  </style>
  