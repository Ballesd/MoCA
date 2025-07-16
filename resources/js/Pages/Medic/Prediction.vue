<template>

    <AppLayout title="Predicción de MoCA">

        <div class="h-full flex-row justify-center items-center p-10 pb-20 ">
            <div class="w-full h-full p-10 bg-quinary shadow-md rounded-3xl border border-gray-400 overflow-y-scroll">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <InputLabel for="edad" value="Edad: " />
                        <TextInput id="edad" v-model="form.edad" type="number" class="mt-1 block w-full" />
                        <InputError :message="form.errors.edad" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="genero" value="Género: " />
                        <select id="genero" v-model.number="form.genero"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">Masculino</option>
                            <option value="1">Femenino</option>
                        </select>
                        <InputError :message="form.errors.genero" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="etnicidad" value="Etnicidad: " />
                        <select id="etnicidad" v-model.number="form.etnicidad"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">Caucásico</option>
                            <option value="1">Afroamericano</option>
                            <option value="2">Asiático</option>
                            <option value="3">Otro</option>
                        </select>
                        <InputError :message="form.errors.etnicidad" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="nivel_educativo" value="Nivel educativo: " />
                        <select id="nivel_educativo" v-model.number="form.nivel_educativo"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">Ninguno</option>
                            <option value="1">Secundaria</option>
                            <option value="2">Licenciatura</option>
                            <option value="3">Superior</option>
                        </select>
                        <InputError :message="form.errors.nivel_educativo" class="mt-2" />
                    </div>
                    <!-- Lifestyle Factors -->
                    <div>
                        <InputLabel for="imc" value="IMC: " />
                        <TextInput id="imc" v-model="form.imc" type="number" min="15" max="40" step="0.1"
                            class="mt-1 block w-full" :class="{ 'border-red-500': imcWarning }" />
                        <InputError :message="form.errors.imc" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 15.0 y 40.0</p>

                        <p v-if="imcWarning" class="text-sm text-orange-600 mt-1">{{ imcWarning }}</p>
                    </div>
                    <div>
                        <InputLabel for="fumar" value="Fuma: " />
                        <select id="fumar" v-model.number="form.fumar"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.fumar" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="consumo_alcohol" value="Consumo de alcohol (unidades/semana): " />
                        <TextInput id="consumo_alcohol" v-model="form.consumo_alcohol" type="number" min="0" max="20"
                            class="mt-1 block w-full" :class="{ 'border-red-500': alcoholWarning }" />
                        <InputError :message="form.errors.consumo_alcohol" class="mt-2" />
                        <p class="text-sm font-light">Consumo de alcohol semanal en unidades entre 0 - 20.</p>
                        <p v-if="alcoholWarning" class="text-sm text-orange-600 mt-1">{{ alcoholWarning }}</p>
                    </div>
                    <div>
                        <InputLabel for="actividad_fisica" value="Actividad física (horas/semana): " />
                        <TextInput id="actividad_fisica" v-model="form.actividad_fisica" type="number" min="0" max="10"
                            class="mt-1 block w-full" :class="{ 'border-red-500': actividadFisicaWarning }" />
                        <InputError :message="form.errors.actividad_fisica" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 0 - 10.</p>
                        <p v-if="actividadFisicaWarning" class="text-sm text-orange-600 mt-1">{{ actividadFisicaWarning
                            }}</p>
                    </div>
                    <div>
                        <InputLabel for="calidad_dieta" value="Calidad de dieta: " />
                        <TextInput id="calidad_dieta" v-model="form.calidad_dieta" type="number" min="4" max="10"
                            class="mt-1 block w-full" :class="{ 'border-red-500': dietaWarning }" />
                        <InputError :message="form.errors.calidad_dieta" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 4 y 10</p>
                        <p v-if="dietaWarning" class="text-sm text-orange-600 mt-1">{{ dietaWarning }}</p>
                    </div>
                    <div>
                        <InputLabel for="calidad_sueno" value="Calidad de sueño: " />
                        <TextInput id="calidad_sueno" v-model="form.calidad_sueno" type="number" min="4" max="10"
                            class="mt-1 block w-full" :class="{ 'border-red-500': suenoWarning }" />
                        <InputError :message="form.errors.calidad_sueno" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 4 y 10</p>

                        <p v-if="suenoWarning" class="text-sm text-orange-600 mt-1">{{ suenoWarning }}</p>
                    </div>
                    <!-- Medical History -->
                    <div>
                        <InputLabel for="antecedentes_familiares_parkinson"
                            value="Antecedentes familiares de Parkinson: " />
                        <select id="antecedentes_familiares_parkinson"
                            v-model.number="form.antecedentes_familiares_parkinson"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.antecedentes_familiares_parkinson" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="traumatismo_craneoencefalico" value="Traumatismo craneoencefálico: " />
                        <select id="traumatismo_craneoencefalico" v-model.number="form.traumatismo_craneoencefalico"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.traumatismo_craneoencefalico" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="hipertension" value="Hipertensión: " />
                        <select id="hipertension" v-model.number="form.hipertension"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.hipertension" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="diabetes" value="Diabetes: " />
                        <select id="diabetes" v-model.number="form.diabetes"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.diabetes" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="depresion" value="Depresión: " />
                        <select id="depresion" v-model.number="form.depresion"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.depresion" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="accidente_cerebrovascular" value="Accidente cerebrovascular: " />
                        <select id="accidente_cerebrovascular" v-model.number="form.accidente_cerebrovascular"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.accidente_cerebrovascular" class="mt-2" />
                    </div>
                    <!-- Clinical Measurements -->
                    <div>
                        <InputLabel for="presion_sistolica" value="Presión sistólica (mmHg): " />
                        <TextInput id="presion_sistolica" v-model="form.presion_sistolica" type="number" min="90"
                            max="180" class="mt-1 block w-full" :class="{ 'border-red-500': presionSistolicaWarning }" />
                        <InputError :message="form.errors.presion_sistolica" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 90 - 180 mmHg</p>
                        <p v-if="presionSistolicaWarning" class="text-sm text-orange-600 mt-1">{{ presionSistolicaWarning }}</p>
                    </div>
                    <div>
                        <InputLabel for="presion_diastolica" value="Presión diastólica (mmHg): " />
                        <TextInput id="presion_diastolica" v-model="form.presion_diastolica" type="number" min="60"
                            max="120" class="mt-1 block w-full" :class="{ 'border-red-500': presionDiastolicaWarning }" />
                        <InputError :message="form.errors.presion_diastolica" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 60 - 120 mmHg</p>
                        <p v-if="presionDiastolicaWarning" class="text-sm text-orange-600 mt-1">{{ presionDiastolicaWarning }}</p>
                    </div>
                    <div>
                        <InputLabel for="colesterol_total" value="Colesterol total (mg/dL): " />
                        <TextInput id="colesterol_total" v-model="form.colesterol_total" type="number" min="150"
                            max="300" class="mt-1 block w-full" :class="{ 'border-red-500': colesterolTotalWarning }" />
                        <InputError :message="form.errors.colesterol_total" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 150 - 300 mg/dL</p>
                        <p v-if="colesterolTotalWarning" class="text-sm text-orange-600 mt-1">{{ colesterolTotalWarning
                            }}</p>
                    </div>
                    <div>
                        <InputLabel for="colesterol_ldl" value="Colesterol LDL (mg/dL): " />
                        <TextInput id="colesterol_ldl" v-model="form.colesterol_ldl" type="number" min="50" max="200"
                            class="mt-1 block w-full" :class="{ 'border-red-500': colesterolLdlWarning }" />
                        <InputError :message="form.errors.colesterol_ldl" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 50 - 200 mg/dL</p>
                        <p v-if="colesterolLdlWarning" class="text-sm text-orange-600 mt-1">{{ colesterolLdlWarning }}
                        </p>
                    </div>
                    <div>
                        <InputLabel for="colesterol_hdl" value="Colesterol HDL (mg/dL): " />
                        <TextInput id="colesterol_hdl" v-model="form.colesterol_hdl" type="number" min="20" max="100"
                            class="mt-1 block w-full" :class="{ 'border-red-500': colesterolHdlWarning }" />
                        <InputError :message="form.errors.colesterol_hdl" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 20 - 100 mg/dL</p>
                        <p v-if="colesterolHdlWarning" class="text-sm text-orange-600 mt-1">{{ colesterolHdlWarning }}
                        </p>
                    </div>
                    <div>
                        <InputLabel for="trigliceridos" value="Triglicéridos (mg/dL): " />
                        <TextInput id="trigliceridos" v-model="form.trigliceridos" type="number" min="50" max="400"
                            class="mt-1 block w-full" :class="{ 'border-red-500': trigliceridosWarning }" />
                        <InputError :message="form.errors.trigliceridos" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 50 - 400 mg/dL</p>
                        <p v-if="trigliceridosWarning" class="text-sm text-orange-600 mt-1">{{ trigliceridosWarning }}
                        </p>
                    </div>
                    <!-- Cognitive and Functional Assessments -->
                    <div>
                        <InputLabel for="moca" value="MoCA: " />
                        <TextInput id="moca" v-model="form.moca" type="number" min="0" max="30"
                            class="mt-1 block w-full" :class="{ 'border-red-500': mocaWarning }" />
                        <InputError :message="form.errors.moca" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 0 y 30</p>

                        <p v-if="mocaWarning" class="text-sm text-orange-600 mt-1">{{ mocaWarning }}</p>
                    </div>
                    <!-- Symptoms -->
                    <div>
                        <InputLabel for="temblor" value="Temblor: " />
                        <select id="temblor" v-model.number="form.temblor"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.temblor" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="rigidez" value="Rigidez: " />
                        <select id="rigidez" v-model.number="form.rigidez"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.rigidez" class="mt-2" />
                        <p class="text-sm font-light">¿Presencia de rígidez muscular?</p>

                    </div>
                    <div>
                        <InputLabel for="bradicinesia" value="Bradicinesia: " />
                        <select id="bradicinesia" v-model.number="form.bradicinesia"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.bradicinesia" class="mt-2" />
                        <p class="text-sm font-light">¿Presencia de lentitud al moverse?</p>
                    </div>
                    <div>
                        <InputLabel for="inestabilidad_postural" value="Inestabilidad postural: " />
                        <select id="inestabilidad_postural" v-model.number="form.inestabilidad_postural"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.inestabilidad_postural" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="problemas_habla" value="Problemas del habla: " />
                        <select id="problemas_habla" v-model.number="form.problemas_habla"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.problemas_habla" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="trastornos_sueno" value="Trastornos del sueño: " />
                        <select id="trastornos_sueno" v-model.number="form.trastornos_sueno"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.trastornos_sueno" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="estrenimiento" value="Estreñimiento: " />
                        <select id="estrenimiento" v-model.number="form.estrenimiento"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.estrenimiento" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="medico_encargado" value="Médico a cargo: " />
                        <TextInput id="medico_encargado" v-model="form.medico_encargado" type="text"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.medico_encargado" class="mt-2" />
                    </div>
                </div>

            </div>
            <ButtonCustom class="w-full mt-4" mode="button" @click="makePrediction"
                :disabled="!isFormValid || isLoading"
                :class="{ 'opacity-50 cursor-not-allowed': !isFormValid || isLoading }">
                <span v-if="isLoading">Procesando...</span>
                <span v-else>Realizar Predicción</span>
            </ButtonCustom>

            <!-- Prediction Result Display -->
            <div v-if="predictionResult !== null" class="mt-4 p-4 bg-green-100 border border-green-400 rounded-lg">
                <h3 class="text-lg font-semibold text-green-800">Resultado de la Predicción</h3>
                <p class="text-green-700">
                    <span v-if="predictionResult === 1" class="text-red-600 font-bold">
                        ⚠️ Riesgo elevado de enfermedad de Parkinson detectado
                    </span>
                    <span v-else class="text-green-600 font-bold">
                        ✅ Bajo riesgo de enfermedad de Parkinson
                    </span>
                </p>
            </div>

            <!-- Prediction Error Display -->
            <div v-if="predictionError" class="mt-4 p-4 bg-red-100 border border-red-400 rounded-lg">
                <h3 class="text-lg font-semibold text-red-800">Error en la Predicción</h3>
                <p class="text-red-700">{{ predictionError }}</p>
            </div>

        </div>
    </AppLayout>

</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import axios from 'axios';

const isLoading = ref(false);
const predictionResult = ref(null);
const predictionError = ref(null);

const props = defineProps({
    id: {
        type: [Number, String],
        required: true
    }
});


const form = useForm({
    user_id: props.id, // integer - User ID
    edad: null,                            // integer (50-90) - Age
    genero: null,                          // tinyInteger (0=Male, 1=Female) - Gender
    etnicidad: null,                       // tinyInteger (0-3) - Ethnicity
    nivel_educativo: null,                 // tinyInteger (0-3) - Education Level
    imc: null,                             // decimal(4,1) (15.0-40.0) - BMI
    fumar: null,                           // tinyInteger (0=No, 1=Yes) - Smoking
    consumo_alcohol: null,                 // integer (0-20) - Alcohol Consumption
    actividad_fisica: null,                // integer (0-10) - Physical Activity
    calidad_dieta: null,                   // integer (4-10) - Diet Quality
    calidad_sueno: null,                   // integer (4-10) - Sleep Quality
    antecedentes_familiares_parkinson: null,  // tinyInteger (0=No, 1=Yes) - Family History Parkinsons
    traumatismo_craneoencefalico: null,    // tinyInteger (0=No, 1=Yes) - Traumatic Brain Injury
    hipertension: null,                    // tinyInteger (0=No, 1=Yes) - Hypertension
    diabetes: null,                        // tinyInteger (0=No, 1=Yes) - Diabetes
    depresion: null,                       // tinyInteger (0=No, 1=Yes) - Depression
    accidente_cerebrovascular: null,       // tinyInteger (0=No, 1=Yes) - Stroke
    presion_sistolica: null,               // integer (90-180) - Systolic BP
    presion_diastolica: null,              // integer (60-120) - Diastolic BP
    colesterol_total: null,                // integer (150-300) - Total Cholesterol
    colesterol_ldl: null,                  // integer (50-200) - LDL Cholesterol
    colesterol_hdl: null,                  // integer (20-100) - HDL Cholesterol
    trigliceridos: null,                   // integer (50-400) - Triglycerides
    moca: null,                            // integer (0-30) - MoCA Score
    temblor: null,                         // tinyInteger (0=No, 1=Yes) - Tremor
    rigidez: null,                         // tinyInteger (0=No, 1=Yes) - Rigidity
    bradicinesia: null,                    // tinyInteger (0=No, 1=Yes) - Bradykinesia
    inestabilidad_postural: null,          // tinyInteger (0=No, 1=Yes) - Postural Instability
    problemas_habla: null,                 // tinyInteger (0=No, 1=Yes) - Speech Problems
    trastornos_sueno: null,                // tinyInteger (0=No, 1=Yes) - Sleep Disorders
    estrenimiento: null,                   // tinyInteger (0=No, 1=Yes) - Constipation
    diagnostico: null,                     // tinyInteger (0=No, 1=Yes) - Diagnosis
    medico_encargado: null,                // string (nullable) - Doctor in Charge

})

// Real-time validation computed properties
const isFormValid = computed(() => {
    const errors = validateForm();
    return Object.keys(errors).length === 0;
});

const edadWarning = computed(() => {
    if (form.edad !== null) {
        if (form.edad < 50 || form.edad > 90) {
            return 'Edad fuera del rango válido (50-90 años)';
        }
    }
    return null;
});



const imcWarning = computed(() => {
    if (form.imc) {
        if (form.imc < 15 || form.imc > 40) {
            return 'IMC fuera del rango válido (15.0-40.0)';
        }

    }
    return null;
});

const presionSistolicaWarning = computed(() => {
    if (form.presion_sistolica !== null) {
        if (form.presion_sistolica < 90 || form.presion_sistolica > 180) {
            return 'Presión sistólica fuera del rango válido (90-180 mmHg)';
        }
    }
    return null;
});

const presionDiastolicaWarning = computed(() => {
    if (form.presion_diastolica !== null) {
        if (form.presion_diastolica < 60 || form.presion_diastolica > 120) {
            return 'Presión diastólica fuera del rango válido (60-120 mmHg)';
        }
    }
    return null;
});

const mocaWarning = computed(() => {
    if (form.moca !== null) {
        if (form.moca < 0 || form.moca > 30) {
            return 'Puntaje MoCA fuera del rango válido (0-30)';
        }
    }
    return null;
});

const alcoholWarning = computed(() => {
    if (form.consumo_alcohol !== null) {
        if (form.consumo_alcohol < 0 || form.consumo_alcohol > 20) {
            return 'Consumo de alcohol fuera del rango válido (0-20 unidades/semana)';
        }
        if (form.consumo_alcohol > 14) {
            return 'Consumo de alcohol elevado (>14 unidades/semana)';
        }
    }
    return null;
});

const actividadFisicaWarning = computed(() => {
    if (form.actividad_fisica !== null) {
        if (form.actividad_fisica < 0 || form.actividad_fisica > 10) {
            return 'Actividad física fuera del rango válido (0-10 horas/semana)';
        }

    }
    return null;
});

const dietaWarning = computed(() => {
    if (form.calidad_dieta !== null) {
        if (form.calidad_dieta < 4 || form.calidad_dieta > 10) {
            return 'Calidad de dieta fuera del rango válido (4-10)';
        }
    }
    return null;
});

const suenoWarning = computed(() => {
    if (form.calidad_sueno !== null) {
        if (form.calidad_sueno < 4 || form.calidad_sueno > 10) {
            return 'Calidad de sueño fuera del rango válido (4-10)';
        }
    }
    return null;
});

const colesterolTotalWarning = computed(() => {
    if (form.colesterol_total !== null) {
        if (form.colesterol_total < 150 || form.colesterol_total > 300) {
            return 'Colesterol total fuera del rango válido (150-300 mg/dL)';
        }
        if (form.colesterol_total > 240) {
            return 'Colesterol total elevado (>240 mg/dL)';
        }
    }
    return null;
});

const colesterolLdlWarning = computed(() => {
    if (form.colesterol_ldl !== null) {
        if (form.colesterol_ldl < 50 || form.colesterol_ldl > 200) {
            return 'Colesterol LDL fuera del rango válido (50-200 mg/dL)';
        }
        if (form.colesterol_ldl > 160) {
            return 'Colesterol LDL elevado (>160 mg/dL)';
        }
    }
    return null;
});

const colesterolHdlWarning = computed(() => {
    if (form.colesterol_hdl !== null) {
        if (form.colesterol_hdl < 20 || form.colesterol_hdl > 100) {
            return 'Colesterol HDL fuera del rango válido (20-100 mg/dL)';
        }
        if (form.colesterol_hdl < 40) {
            return 'Colesterol HDL bajo (<40 mg/dL)';
        }
    }
    return null;
});

const trigliceridosWarning = computed(() => {
    if (form.trigliceridos !== null) {
        if (form.trigliceridos < 50 || form.trigliceridos > 400) {
            return 'Triglicéridos fuera del rango válido (50-400 mg/dL)';
        }
        if (form.trigliceridos > 200) {
            return 'Triglicéridos elevados (>200 mg/dL)';
        }
    }
    return null;
});

// Validation function
const validateForm = () => {
    const errors = {};

    // Demographics validation
    if (!form.edad || form.edad < 50 || form.edad > 90) {
        errors.edad = 'La edad debe estar entre 50 y 90 años';
    }
    if (form.genero === null) {
        errors.genero = 'El género es requerido';
    }
    if (form.etnicidad === null) {
        errors.etnicidad = 'La etnicidad es requerida';
    }
    if (form.nivel_educativo === null) {
        errors.nivel_educativo = 'El nivel educativo es requerido';
    }

    // Lifestyle Factors validation
    if (!form.imc || form.imc < 15 || form.imc > 40) {
        errors.imc = 'El IMC debe estar entre 15.0 y 40.0';
    }
    if (form.fumar === null) {
        errors.fumar = 'Debe indicar si fuma o no';
    }
    if (form.consumo_alcohol === null || form.consumo_alcohol < 0 || form.consumo_alcohol > 20) {
        errors.consumo_alcohol = 'El consumo de alcohol debe estar entre 0 y 20 unidades/semana';
    }
    if (form.actividad_fisica === null || form.actividad_fisica < 0 || form.actividad_fisica > 10) {
        errors.actividad_fisica = 'La actividad física debe estar entre 0 y 10 horas/semana';
    }
    if (form.calidad_dieta === null || form.calidad_dieta < 4 || form.calidad_dieta > 10) {
        errors.calidad_dieta = 'La calidad de dieta debe estar entre 4 y 10';
    }
    if (form.calidad_sueno === null || form.calidad_sueno < 4 || form.calidad_sueno > 10) {
        errors.calidad_sueno = 'La calidad de sueño debe estar entre 4 y 10';
    }

    // Medical History validation
    if (form.antecedentes_familiares_parkinson === null) {
        errors.antecedentes_familiares_parkinson = 'Debe indicar los antecedentes familiares de Parkinson';
    }
    if (form.traumatismo_craneoencefalico === null) {
        errors.traumatismo_craneoencefalico = 'Debe indicar si tuvo traumatismo craneoencefálico';
    }
    if (form.hipertension === null) {
        errors.hipertension = 'Debe indicar si tiene hipertensión';
    }
    if (form.diabetes === null) {
        errors.diabetes = 'Debe indicar si tiene diabetes';
    }
    if (form.depresion === null) {
        errors.depresion = 'Debe indicar si tiene depresión';
    }
    if (form.accidente_cerebrovascular === null) {
        errors.accidente_cerebrovascular = 'Debe indicar si tuvo accidente cerebrovascular';
    }

    // Clinical Measurements validation
    if (!form.presion_sistolica || form.presion_sistolica < 90 || form.presion_sistolica > 180) {
        errors.presion_sistolica = 'La presión sistólica debe estar entre 90 y 180 mmHg';
    }
    if (!form.presion_diastolica || form.presion_diastolica < 60 || form.presion_diastolica > 120) {
        errors.presion_diastolica = 'La presión diastólica debe estar entre 60 y 120 mmHg';
    }
    if (!form.colesterol_total || form.colesterol_total < 150 || form.colesterol_total > 300) {
        errors.colesterol_total = 'El colesterol total debe estar entre 150 y 300 mg/dL';
    }
    if (!form.colesterol_ldl || form.colesterol_ldl < 50 || form.colesterol_ldl > 200) {
        errors.colesterol_ldl = 'El colesterol LDL debe estar entre 50 y 200 mg/dL';
    }
    if (!form.colesterol_hdl || form.colesterol_hdl < 20 || form.colesterol_hdl > 100) {
        errors.colesterol_hdl = 'El colesterol HDL debe estar entre 20 y 100 mg/dL';
    }
    if (!form.trigliceridos || form.trigliceridos < 50 || form.trigliceridos > 400) {
        errors.trigliceridos = 'Los triglicéridos deben estar entre 50 y 400 mg/dL';
    }

    // Cognitive Assessment validation
    if (form.moca === null || form.moca < 0 || form.moca > 30) {
        errors.moca = 'El puntaje MoCA debe estar entre 0 y 30';
    }

    // Symptoms validation
    if (form.temblor === null) {
        errors.temblor = 'Debe indicar si presenta temblor';
    }
    if (form.rigidez === null) {
        errors.rigidez = 'Debe indicar si presenta rigidez';
    }
    if (form.bradicinesia === null) {
        errors.bradicinesia = 'Debe indicar si presenta bradicinesia';
    }
    if (form.inestabilidad_postural === null) {
        errors.inestabilidad_postural = 'Debe indicar si presenta inestabilidad postural';
    }
    if (form.problemas_habla === null) {
        errors.problemas_habla = 'Debe indicar si presenta problemas del habla';
    }
    if (form.trastornos_sueno === null) {
        errors.trastornos_sueno = 'Debe indicar si presenta trastornos del sueño';
    }
    if (form.estrenimiento === null) {
        errors.estrenimiento = 'Debe indicar si presenta estreñimiento';
    }

    // Doctor field validation
    if (!form.medico_encargado || form.medico_encargado.trim() === '') {
        errors.medico_encargado = 'El médico encargado es requerido';
    }

    return errors;
};

const makePrediction = async () => {
    // Clear previous errors
    form.clearErrors();

    // Validate form
    const validationErrors = validateForm();
    if (Object.keys(validationErrors).length > 0) {
        // Set errors in form
        Object.keys(validationErrors).forEach(key => {
            form.setError(key, validationErrors[key]);
        });
        return;
    }

    const requestData = {
        // user_id: form.user_id,
        "Age": form.edad,
        "Gender": form.genero,
        "EducationLevel": form.nivel_educativo,

        // Lifestyle Factors
        "BMI": form.imc,
        "Smoking": form.fumar,
        "AlcoholConsumption": form.consumo_alcohol,
        "PhysicalActivity": form.actividad_fisica,
        "DietQuality": form.calidad_dieta,
        "SleepQuality": form.calidad_sueno,

        // Medical History
        "FamilyHistoryParkinsons": form.antecedentes_familiares_parkinson,
        "TraumaticBrainInjury": form.traumatismo_craneoencefalico,
        "Hypertension": form.hipertension,
        "Diabetes": form.diabetes,
        "Depression": form.depresion,
        "Stroke": form.accidente_cerebrovascular,

        // Clinical Measurements
        "SystolicBP": form.presion_sistolica,
        "DiastolicBP": form.presion_diastolica,
        "CholesterolTotal": form.colesterol_total,
        "CholesterolLDL": form.colesterol_ldl,
        "CholesterolHDL": form.colesterol_hdl,
        "CholesterolTriglycerides": form.trigliceridos,

        // Cognitive Assessment
        "MoCA": form.moca,

        // Symptoms
        "Tremor": form.temblor,
        "Rigidity": form.rigidez,
        "Bradykinesia": form.bradicinesia,
        "PosturalInstability": form.inestabilidad_postural,
        "SpeechProblems": form.problemas_habla,
        "SleepDisorders": form.trastornos_sueno,
        "Constipation": form.estrenimiento
    };

    try {
        isLoading.value = true;
        predictionError.value = null;

        // Prepare data (reuse the conversion logic from storePrediction)

        const apiUrl = '/proxy/predict';

        const { data } = await axios.post(apiUrl, requestData, {
            timeout: 30000, // 30 second timeout
            headers: {
                'Content-Type': 'application/json',
            }
        });

        predictionResult.value = data.prediction;
        storePrediction();

        console.log('✅ Predicción realizada:', data);
        // Optionally show success message to user
        // You could use a toast notification here
        return data;
    } catch (error) {
        console.error('❌ Error en predicción:', error);

        // Handle different types of errors
        if (error.response) {
            // Server responded with error status
            predictionError.value = `Error del servidor: ${error.response.data?.message || 'Error desconocido'}`;
        } else if (error.request) {
            // Request was made but no response received
            predictionError.value = 'No se pudo conectar con el servidor de predicción';
        } else {
            // Something else happened
            predictionError.value = 'Error inesperado al realizar la predicción';
        }

        throw error; // Re-throw if you want calling code to handle it
    } finally {
        isLoading.value = false;
    }





    console.log('Predicción realizada:', data);
}


const mostrar_datos = () => {
    console.log('Datos del formulario:', form.data());
};

// Function to store prediction data
const storePrediction = () => {
    console.log('Storing prediction data...');

    // Convert string values to numbers for numeric fields
    const convertedData = {
        ...form.data(),
        // Convert ALL numeric fields to ensure proper data types
        user_id: Number(form.user_id),

        // Demographics
        edad: form.edad ? Number(form.edad) : null,
        genero: form.genero !== null ? Number(form.genero) : null,
        etnicidad: form.etnicidad !== null ? Number(form.etnicidad) : null,
        nivel_educativo: form.nivel_educativo !== null ? Number(form.nivel_educativo) : null,

        // Lifestyle Factors
        imc: form.imc ? Number(form.imc) : null,
        fumar: form.fumar !== null ? Number(form.fumar) : null,
        consumo_alcohol: form.consumo_alcohol ? Number(form.consumo_alcohol) : null,
        actividad_fisica: form.actividad_fisica ? Number(form.actividad_fisica) : null,
        calidad_dieta: form.calidad_dieta ? Number(form.calidad_dieta) : null,
        calidad_sueno: form.calidad_sueno ? Number(form.calidad_sueno) : null,

        // Medical History
        antecedentes_familiares_parkinson: form.antecedentes_familiares_parkinson !== null ? Number(form.antecedentes_familiares_parkinson) : null,
        traumatismo_craneoencefalico: form.traumatismo_craneoencefalico !== null ? Number(form.traumatismo_craneoencefalico) : null,
        hipertension: form.hipertension !== null ? Number(form.hipertension) : null,
        diabetes: form.diabetes !== null ? Number(form.diabetes) : null,
        depresion: form.depresion !== null ? Number(form.depresion) : null,
        accidente_cerebrovascular: form.accidente_cerebrovascular !== null ? Number(form.accidente_cerebrovascular) : null,

        // Clinical Measurements
        presion_sistolica: form.presion_sistolica ? Number(form.presion_sistolica) : null,
        presion_diastolica: form.presion_diastolica ? Number(form.presion_diastolica) : null,
        colesterol_total: form.colesterol_total ? Number(form.colesterol_total) : null,
        colesterol_ldl: form.colesterol_ldl ? Number(form.colesterol_ldl) : null,
        colesterol_hdl: form.colesterol_hdl ? Number(form.colesterol_hdl) : null,
        trigliceridos: form.trigliceridos ? Number(form.trigliceridos) : null,

        // Cognitive Assessment
        moca: form.moca ? Number(form.moca) : null,

        // Symptoms
        temblor: form.temblor !== null ? Number(form.temblor) : null,
        rigidez: form.rigidez !== null ? Number(form.rigidez) : null,
        bradicinesia: form.bradicinesia !== null ? Number(form.bradicinesia) : null,
        inestabilidad_postural: form.inestabilidad_postural !== null ? Number(form.inestabilidad_postural) : null,
        problemas_habla: form.problemas_habla !== null ? Number(form.problemas_habla) : null,
        trastornos_sueno: form.trastornos_sueno !== null ? Number(form.trastornos_sueno) : null,
        estrenimiento: form.estrenimiento !== null ? Number(form.estrenimiento) : null,

        // Diagnosis
        diagnostico: predictionResult.value,

        // String field (no conversion needed)
        medico_encargado: form.medico_encargado
    };

    console.log('Converted data:', convertedData);

    // Send converted data directly without updating the form
    // This keeps the form fields as strings for the UI, but sends numbers to the backend

    // Create a temporary form with the converted data
    const tempForm = useForm(convertedData);

    tempForm.post(route('Medic.storePrediction'), {
        onSuccess: (response) => {
            console.log('✅ Success! Response:', response);
            // Optionally reset the original form or redirect
        },
        onError: (errors) => {
            console.error('❌ Error response:', errors);
            // Copy errors back to the original form for display
            form.errors = errors;
        },
        onFinish: () => {
            console.log('Request finished');
        }
    });
};





</script>