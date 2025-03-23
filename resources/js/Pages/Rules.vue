<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LinkCustom from '@/Components/LinkCustom.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="my-7 flex justify-center">
            <div class="flex flex-col gap-5 w-4/5 justify-end items-center pb-6">
                <h1 class="text-4xl text-primary">Para realizar el test, tenga en cuenta:</h1>
                <div class="bg-secondary rounded-xl shadow-lg p-6">
                    <div class="flex flex-col">
                        <ol class="list-decimal pl-5">
                            <li><strong>Ambiente tranquilo:</strong> Sin ruidos ni interrupciones.</li>
                            <li>
                                <strong>Buena iluminación:</strong>
                                Preferiblemente luz natural o blanca.
                            </li>
                            <li>
                                <strong>Conexión a internet estable:</strong>
                                Rápida y confiable.
                            </li>
                            <li><strong>Equipo adecuado:</strong> Dispositivo con cámara y micrófono funcionales.</li>
                            <li>
                                <strong>Software instalado:</strong>
                                Aplicaciones como Zoom, Microsoft Teams, Google Meet, etc.
                            </li>
                            <li><strong>Espacio ordenado:</strong> Solo los materiales necesarios presentes.</li>
                            <li><strong>Comodidad:</strong> Silla y mesa adecuadas, temperatura confortable.</li>
                            <li><strong>Privacidad:</strong> Sin interrupciones ni observadores.</li>
                            <li>
                                <strong>Materiales de escritura:</strong>
                                Lápiz, hoja, borrador y sacapuntas.
                            </li>
                            <li>
                                <strong>Escucha de instrucciones:</strong>
                                Al lado de cada pregunta habrá un botón de audio para escuchar las instrucciones.
                            </li>
                            <li>
                                <strong>Ejercicios con escucha de audio:</strong>
                                Representan situaciones que solo se reproducirán una vez, por lo que deben ser atendidos con atención.
                            </li>
                        </ol>
                    </div>
                </div>
                <div>
                    <LinkCustom :href="route('audio-mic-test')">COMENZAR</LinkCustom>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
