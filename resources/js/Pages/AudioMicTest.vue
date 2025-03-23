<template>
    <AppLayout title="Dashboard">
        <div class=" flex justify-center">
            <div class="flex flex-col gap-4 justify-center items-center pb-10 px-6">
                <h1 class="text-4xl text-primary text-center">Prueba de Audio y Micrófono</h1>

                <div class="flex flex-col text-xl gap-4 mt-2 text-justify">
                    <p>Antes de realizar el test, necesitamos verificar si el sonido y el micrófono de su dispositivo
                        funcionan correctamente.</p>
                </div>
                <div class="flex flex-col items-center justify-center text-xl gap-8 w-full ">
                    <!-- Botón de audio -->

                    <div class="flex flex-col items-center text-justify gap-4 font-semibold ">

                        <p>Oprima el botón para escuchar el audio</p>
                        <div class="flex justify-center items-center space-x-8 ps-5">

                            <button @click="audioTest">
                                <img src="../../../public/images/audio.png" alt="audio" class="h-36">
                            </button>
                            <font-awesome-icon v-if="!heard_audio" :icon="['far', 'circle']" size="2x"
                                class="text-primary" />
                            <font-awesome-icon v-if="heard_audio && is_audio_output" :icon="['fas', 'check-circle']" size="2x"
                                class="text-primary" />

                        </div>

                    </div>



                    <!-- Botón de micrófono -->
                    <div class="flex flex-col items-center text-justify  gap-4 font-semibold ">

                        <p>Oprima el botón para probar el micrófono y diga "Probando micrófono"</p>

                        <div class="flex justify-center items-center space-x-8 ps-5">
                            <button v-if="!is_recording" @click="toggleMic">
                                <img src="../../../public/images/microfono.png" alt="microfono" class="h-36">
                            </button>
                            <button v-if="is_recording" @click="toggleMic">
                                <img src="../../../public/images/grabando.gif" alt="microfono" class="h-44">
                            </button>
                            <font-awesome-icon v-if="!used_microphone" :icon="['far', 'circle']" size="2x"
                                class="text-primary" />
                            <font-awesome-icon v-if="used_microphone && is_audio_input" :icon="['fas', 'check-circle']" size="2x"
                                class="text-primary" />
                        </div>

                        <div v-text="transcript" class="flex justify-center text-base sm:text-lg mb-4 font-normal">
                        </div>
                    </div>


                </div>



                <div>
                    <LinkCustom v-if="heard_audio && used_microphone && is_audio_input && is_audio_output" :href="route('Moca.Index')">COMENZAR</LinkCustom>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import LinkCustom from '@/Components/LinkCustom.vue';
import { onMounted, ref } from "vue";

const audio_devices = ref([]);
const is_audio_output = ref(false);
const is_audio_input = ref(false);
const heard_audio = ref(false);
const used_microphone = ref(false);
const is_recording = ref(false);
const transcript = ref('');

const Recognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const sr = new Recognition();

onMounted(() => {
    
    sr.lang = "es-CO";
    sr.continuous = true;
    sr.interimResults = true;

    sr.onstart = () => {
        console.log('SR1 Started');
        is_recording.value = true;

        // Detener el reconocimiento automáticamente después de 4 segundos
        setTimeout(() => {
            sr.stop();
            console.log('SR1 Stopped automatically after 4 seconds');
        }, 4000);
    };

    sr.onend = () => {
        console.log('SR1 Stopped');
        is_recording.value = false;
        used_microphone.value = true;
    };

    sr.onresult = (evt) => {
        for (let i = 0; i < evt.results.length; i++) {
            const result = evt.results[i];

            if (result.isFinal) {
                transcript.value = result[0].transcript;
            }
        }
    };

    sr.onerror = (event) => {
        console.error('Error en el reconocimiento de voz 1:', event.error);
    };
});

const audioTest = () => {
    const synthesis = window.speechSynthesis;
    const utterance = new SpeechSynthesisUtterance("Esto es una prueba de audio, si escucha este mensaje, su audio funciona correctamente");
    utterance.rate = 0.7;
    utterance.lang = "es-CO"
    synthesis.speak(utterance);
    checkAudioDevices();
    utterance.onend = () => {
        heard_audio.value = true;
    };
};

const checkAudioDevices = async () => {
    try {
        const devices = await navigator.mediaDevices.enumerateDevices();
        audio_devices.value = devices.filter(device => device.kind === 'audiooutput');
        if (audio_devices.value.length === 0) {
            alert("No se encontraron dispositivos de salida de audio. Por favor, conecte un dispositivo de audio.");
        } else {
            console.log("Dispositivos de audio encontrados:", audio_devices.value);
            is_audio_output.value = true;
        }
    } catch (error) {
        console.error("Error al verificar los dispositivos de audio:", error);
        alert("Hubo un error al verificar los dispositivos de audio.");
    }
};

const checkMicrophone = async () => {
    try {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const microphones = devices.filter(device => device.kind === 'audioinput');
        if (microphones.length === 0) {
            alert("No se encontraron micrófonos. Por favor, conecte un micrófono.");
        } else {
            console.log("Micrófonos encontrados:", microphones);
            is_audio_input.value = true;
        }
    } catch (error) {
        console.error("Error al verificar los micrófonos:", error);
        alert("Hubo un error al verificar los micrófonos.");
    }
};

const toggleMic = () => {
    checkMicrophone();
    setTimeout(() => {
        sr.start();
    }, 500);

};



</script>
