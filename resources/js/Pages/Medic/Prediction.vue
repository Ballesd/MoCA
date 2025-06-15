<template>

    <AppLayout title="Predicción de MoCA">

        <div class="h-full flex justify-center items-center p-10">
            <div class="w-full h-full p-10 bg-quinary shadow-md rounded-3xl border border-gray-400 overflow-y-scroll">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <InputLabel for="age" value="Edad: " />
                        <TextInput id="age" v-model="form.age" type="number" min="50" max="90"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.age" class="mt-2" />

                    </div>
                    <div>
                        <InputLabel for="gender" value="Género: " />
                        <select id="gender" v-model="form.gender"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">Masculino</option>
                            <option value="1">Femenino</option>
                        </select>
                        <InputError :message="form.errors.gender" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="ethnicity" value="Etnicidad: " />
                        <select id="ethnicity" v-model="form.ethnicity"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">Caucásico</option>
                            <option value="1">Afroamericano</option>
                            <option value="2">Asiático</option>
                            <option value="3">Otro</option>
                        </select>
                        <InputError :message="form.errors.ethnicity" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="educationLevel" value="Nivel educativo: " />
                        <select id="educationLevel" v-model="form.educationLevel"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">Ninguno</option>
                            <option value="1">Secundaria</option>
                            <option value="2">Licenciatura</option>
                            <option value="3">Superior</option>
                        </select>
                        <InputError :message="form.errors.educationLevel" class="mt-2" />
                    </div>
                    <!-- Lifestyle Factors -->
                    <div>
                        <InputLabel for="bmi" value="IMC: " />
                        <TextInput id="bmi" v-model="form.bmi" type="number" min="15" max="40" step="0.1"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.bmi" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="smoking" value="Fuma: " />
                        <select id="smoking" v-model="form.smoking"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.smoking" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="alcoholConsumption" value="Consumo de alcohol (unidades/semana): " />
                        <TextInput id="alcoholConsumption" v-model="form.alcoholConsumption" type="number" min="0"
                            max="20" class="mt-1 block w-full" />
                        <InputError :message="form.errors.alcoholConsumption" class="mt-2" />
                        <p class="text-sm font-light">Consumo de alcohol semanal en unidades entre 0 - 20.</p>
                    </div>
                    <div>
                        <InputLabel for="physicalActivity" value="Actividad física (horas/semana): " />
                        <TextInput id="physicalActivity" v-model="form.physicalActivity" type="number" min="0" max="10"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.physicalActivity" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 0 - 10.</p>

                    </div>
                    <div>
                        <InputLabel for="dietQuality" value="Calidad de dieta: " />
                        <TextInput id="dietQuality" v-model="form.dietQuality" type="number" min="0" max="10"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.dietQuality" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 4 y 10</p>

                    </div>
                    <div>
                        <InputLabel for="sleepQuality" value="Calidad de sueño: " />
                        <TextInput id="sleepQuality" v-model="form.sleepQuality" type="number" min="4" max="10"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.sleepQuality" class="mt-2" />
                    </div>
                    <!-- Medical History -->
                    <div>
                        <InputLabel for="familyHistoryParkinsons" value="Antecedentes familiares de Parkinson: " />
                        <select id="familyHistoryParkinsons" v-model="form.familyHistoryParkinsons"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.familyHistoryParkinsons" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="traumaticBrainInjury" value="Traumatismo craneoencefálico: " />
                        <select id="traumaticBrainInjury" v-model="form.traumaticBrainInjury"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.traumaticBrainInjury" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="hypertension" value="Hipertensión: " />
                        <select id="hypertension" v-model="form.hypertension"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.hypertension" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="diabetes" value="Diabetes: " />
                        <select id="diabetes" v-model="form.diabetes"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.diabetes" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="depression" value="Depresión: " />
                        <select id="depression" v-model="form.depression"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.depression" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="stroke" value="Accidente cerebrovascular: " />
                        <select id="stroke" v-model="form.stroke"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.stroke" class="mt-2" />
                    </div>
                    <!-- Clinical Measurements -->
                    <div>
                        <InputLabel for="systolicBP" value="Presión sistólica (mmHg): " />
                        <TextInput id="systolicBP" v-model="form.systolicBP" type="number" min="90" max="180"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.systolicBP" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 90 - 180 mmHg</p>

                    </div>
                    <div>
                        <InputLabel for="diastolicBP" value="Presión diastólica (mmHg): " />
                        <TextInput id="diastolicBP" v-model="form.diastolicBP" type="number" min="60" max="120"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.diastolicBP" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 60 - 120 mmHg</p>
                    </div>
                    <div>
                        <InputLabel for="cholesterolTotal" value="Colesterol total (mg/dL): " />
                        <TextInput id="cholesterolTotal" v-model="form.cholesterolTotal" type="number" min="150"
                            max="300" class="mt-1 block w-full" />
                        <InputError :message="form.errors.cholesterolTotal" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 150 - 300 mg/dL</p>
                    </div>
                    <div>
                        <InputLabel for="cholesterolLDL" value="Colesterol LDL (mg/dL): " />
                        <TextInput id="cholesterolLDL" v-model="form.cholesterolLDL" type="number" min="50" max="200"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.cholesterolLDL" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 50 - 200 mg/dL</p>
                    </div>
                    <div>
                        <InputLabel for="cholesterolHDL" value="Colesterol HDL (mg/dL): " />
                        <TextInput id="cholesterolHDL" v-model="form.cholesterolHDL" type="number" min="20" max="100"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.cholesterolHDL" class="mt-2" />
                        <p class="text-sm font-light">Rango entre 20 - 100 mg/dL</p>
                    </div>
                    <div>
                        <InputLabel for="cholesterolTriglycerides" value="Triglicéridos (mg/dL): " />
                        <TextInput id="cholesterolTriglycerides" v-model="form.cholesterolTriglycerides" type="number"
                            min="50" max="400" class="mt-1 block w-full" />
                        <InputError :message="form.errors.cholesterolTriglycerides" class="mt-2" />
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
                        <InputLabel for="tremor" value="Temblor: " />
                        <select id="tremor" v-model="form.tremor"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.tremor" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="rigidity" value="Rigidez: " />
                        <select id="rigidity" v-model="form.rigidity"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.rigidity" class="mt-2" />
                        <p class="text-sm font-light">¿Presencia de rígidez muscular?</p>

                    </div>
                    <div>
                        <InputLabel for="bradykinesia" value="Bradicinesia: " />
                        <select id="bradykinesia" v-model="form.bradykinesia"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.bradykinesia" class="mt-2" />
                        <p class="text-sm font-light">¿Presencia de lentitud al moverse?</p>
                    </div>
                    <div>
                        <InputLabel for="posturalInstability" value="Inestabilidad postural: " />
                        <select id="posturalInstability" v-model="form.posturalInstability"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.posturalInstability" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="speechProblems" value="Problemas del habla: " />
                        <select id="speechProblems" v-model="form.speechProblems"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.speechProblems" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="sleepDisorders" value="Trastornos del sueño: " />
                        <select id="sleepDisorders" v-model="form.sleepDisorders"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.sleepDisorders" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="constipation" value="Estreñimiento: " />
                        <select id="constipation" v-model="form.constipation"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.constipation" class="mt-2" />
                    </div>
                    <!-- Diagnosis Information -->
                    <div>
                        <InputLabel for="diagnosis" value="Diagnóstico de Parkinson: " />
                        <select id="diagnosis" v-model="form.diagnosis"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                        <InputError :message="form.errors.diagnosis" class="mt-2" />
                    </div>
                    <!-- Confidential Information -->
                    <div>
                        <InputLabel for="doctorInCharge" value="Médico a cargo: " />
                        <TextInput id="doctorInCharge" v-model="form.doctorInCharge" type="text"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.doctorInCharge" class="mt-2" />
                    </div>






                </div>




            </div>
        </div>
    </AppLayout>

</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    age: '',
    gender: '',
    ethnicity: '',
    educationLevel: '',
    bmi: '',
    smoking: '',
    alcoholConsumption: '',
    physicalActivity: '',
    dietQuality: '',
    sleepQuality: '',
    familyHistoryParkinsons: '',
    traumaticBrainInjury: '',
    hypertension: '',
    diabetes: '',
    depression: '',
    stroke: '',
    systolicBP: '',
    diastolicBP: '',
    cholesterolTotal: '',
    cholesterolLDL: '',
    cholesterolHDL: '',
    cholesterolTriglycerides: '',
    moca: '',
    tremor: '',
    rigidity: '',
    bradykinesia: '',
    posturalInstability: '',
    speechProblems: '',
    sleepDisorders: '',
    constipation: '',
    diagnosis: '',
    doctorInCharge: '',

})
const age = ref(false);
const gender = ref(false);
const ethnicity = ref(false);
const educationLevel = ref(false);
const bmi = ref(false);
const smoking = ref(false);
const alcoholConsumption = ref(false);
const physicalActivity = ref(false);
const dietQuality = ref(false);
const sleepQuality = ref(false);
const familyHistoryParkinsons = ref(false);
const traumaticBrainInjury = ref(false);
const hypertension = ref(false);
const diabetes = ref(false);
const depression = ref(false);
const stroke = ref(false);
const systolicBP = ref(false);
const diastolicBP = ref(false);
const cholesterolTotal = ref(false);
const cholesterolLDL = ref(false);
const cholesterolHDL = ref(false);
const cholesterolTriglycerides = ref(false);
const moca = ref(false);
const tremor = ref(false);
const rigidity = ref(false);
const bradykinesia = ref(false);
const posturalInstability = ref(false);
const speechProblems = ref(false);
const sleepDisorders = ref(false);
const constipation = ref(false);
const diagnosis = ref(false);
const doctorInCharge = ref(false);


</script>