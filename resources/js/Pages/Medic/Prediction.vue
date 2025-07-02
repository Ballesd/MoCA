<template>

    <AppLayout title="Predicción de MoCA">

        <div class="h-full flex-row justify-center items-center p-10 pb-20 ">
            <div class="w-full h-full p-10 bg-quinary shadow-md rounded-3xl border border-gray-400 overflow-y-scroll">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <InputLabel for="edad" value="Edad: " />
                        <TextInput id="edad" v-model="form.edad" type="number" min="50" max="90"
                            class="mt-1 block w-full" />
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
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.imc" class="mt-2" />
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
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.consumo_alcohol" class="mt-2" />
                        <p class="text-sm font-light">Consumo de alcohol semanal en unidades entre 0 - 20.</p>
                    </div>
                    <div>
                        <InputLabel for="actividad_fisica" value="Actividad física (horas/semana): " />
                        <TextInput id="actividad_fisica" v-model="form.actividad_fisica" type="number" min="0" max="10"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.actividad_fisica" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 0 - 10.</p>

                    </div>
                    <div>
                        <InputLabel for="calidad_dieta" value="Calidad de dieta: " />
                        <TextInput id="calidad_dieta" v-model="form.calidad_dieta" type="number" min="0" max="10"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.calidad_dieta" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 4 y 10</p>

                    </div>
                    <div>
                        <InputLabel for="calidad_sueno" value="Calidad de sueño: " />
                        <TextInput id="calidad_sueno" v-model="form.calidad_sueno" type="number" min="4" max="10"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.calidad_sueno" class="mt-2" />
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
                            max="180" class="mt-1 block w-full" />
                        <InputError :message="form.errors.presion_sistolica" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 90 - 180 mmHg</p>

                    </div>
                    <div>
                        <InputLabel for="presion_diastolica" value="Presión diastólica (mmHg): " />
                        <TextInput id="presion_diastolica" v-model="form.presion_diastolica" type="number" min="60"
                            max="120" class="mt-1 block w-full" />
                        <InputError :message="form.errors.presion_diastolica" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 60 - 120 mmHg</p>
                    </div>
                    <div>
                        <InputLabel for="colesterol_total" value="Colesterol total (mg/dL): " />
                        <TextInput id="colesterol_total" v-model="form.colesterol_total" type="number" min="150"
                            max="300" class="mt-1 block w-full" />
                        <InputError :message="form.errors.colesterol_total" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 150 - 300 mg/dL</p>
                    </div>
                    <div>
                        <InputLabel for="colesterol_ldl" value="Colesterol LDL (mg/dL): " />
                        <TextInput id="colesterol_ldl" v-model="form.colesterol_ldl" type="number" min="50" max="200"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.colesterol_ldl" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 50 - 200 mg/dL</p>
                    </div>
                    <div>
                        <InputLabel for="colesterol_hdl" value="Colesterol HDL (mg/dL): " />
                        <TextInput id="colesterol_hdl" v-model="form.colesterol_hdl" type="number" min="20" max="100"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.colesterol_hdl" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 20 - 100 mg/dL</p>
                    </div>
                    <div>
                        <InputLabel for="trigliceridos" value="Triglicéridos (mg/dL): " />
                        <TextInput id="trigliceridos" v-model="form.trigliceridos" type="number" min="50" max="400"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.trigliceridos" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 50 - 400 mg/dL</p>
                    </div>
                    <!-- Cognitive and Functional Assessments -->
                    <div>
                        <InputLabel for="moca" value="MoCA: " />
                        <TextInput id="moca" v-model="form.moca" type="number" min="0" max="30"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.moca" class="mt-2" />
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
            <ButtonCustom class="w-full mt-4" mode="button" @click="makePrediction">
                Realizar Predicción
            </ButtonCustom>

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
import { ref } from 'vue';
import  axios  from 'axios';

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

const makePrediction = async () => {
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

        const apiUrl = 'http://172.23.177.23:3000/predict';

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
const storePrediction = ( ) => {
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