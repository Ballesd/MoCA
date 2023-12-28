<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="flex justify-center font-semibold text-xl text-gray-800 leading-tight">
                Buscar Historial Clinico de Paciente
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-4">
                        <InputLabel for="text" value="Busca a la persona por la cédula" />
                        <input
                            class="input-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="search"
                            type="text"
                            v-model="identification"
                            @keyup.enter="search"
                            required
                            autofocus
                        />
                    </div>
                    <div class="flex justify-center items-center justify-end mt-4">
                        <PrimaryButton @click="search">
                            Buscar
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="values" class="mt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <label class="text-gray-800 font-bold">Nombre: </label>
                    <label class="text-gray-900">{{ users.name }} {{ users.lastname }}</label>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <label class="text-gray-800 font-bold">Cédula: </label>
                    <label class="text-gray-900">{{ users.identification }}</label>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <label class="text-gray-800 font-bold">Fecha de nacimiento: </label>
                    <label class="text-gray-900">{{ users.birthdate }} en {{ users.birthday_place }}</label>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <label class="text-gray-800 font-bold">Sexo: </label>
                    <label class="text-gray-900">{{ users.sex }}</label>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <label class="text-gray-800 font-bold">Dirección: </label>
                    <label class="text-gray-900">{{ users.address }}</label>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <label class="text-gray-800 font-bold">Teléfono: </label>
                    <label class="text-gray-900">{{ users.phone }}</label>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <label class="text-gray-800 font-bold">Estado Civil: </label>
                    <label class="text-gray-900">{{ users.civil_status }}</label>
                </div>
            </div>
        </div>

        <div v-if="values" class="mt-4">
            <div class="overflow-x-auto">
                <div class="p-2">
                    <div class="mb-2">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownClinicHistoriesOpen = !isDropdownClinicHistoriesOpen"
                        >
                            Historia Clínica
                            <span :class="{ 'rotate-180': isDropdownClinicHistoriesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownClinicHistoriesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Historia Clínica</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownClinicHistoriesOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Clínica:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.clinic }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Otra:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.other }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Instituto genético:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.genetic_institute }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">PK:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.pk ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Alzheimer:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.alz ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Control:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.control ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Muestra de sangre:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.blood_sample ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Muestra de odontología:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.dentistry_sample ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Ciudad:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.city }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Fecha:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.date }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Acudiente:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.attendant_name }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Parentesco del acudiente:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.relationship }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Teléfono de acudiente:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.attendant_phone }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Motivo de la consulta:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.reason }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Enfermedad actual:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.current_illness }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Otra información:</p>
                                        <p class="flex justify-center text-gray-900">{{ clinic_history.other_information }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <div class="p-2">
                    <div class="mb-2">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownCardiovascularEventsOpen = !isDropdownCardiovascularEventsOpen"
                        >
                            Eventos Cardiovasculares
                            <span :class="{ 'rotate-180': isDropdownCardiovascularEventsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownCardiovascularEventsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Eventos Cardiovasculares</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownCardiovascularEventsOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Isquémicos Cardíacos:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.ischemic_cardiac ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hemorrágicos Cardíacos:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.hemorrhagic_cardiac ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Cardíaco:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.time_cardiac }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Isquémicos Cerebrales:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.ischemic_cerebral ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hemorrágicos Cerebrales:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.hemorrhagic_cerebral ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Cerebral:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.time_cerebral }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Isquémicos Otros:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.ischemic_others ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hemorrágicos Otros:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.hemorrhagic_others ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Otros:</p>
                                        <p class="flex justify-center text-gray-900">{{ cardiovascular_events.time_others }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import axios from 'axios';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { ref } from 'vue';

    const isDropdownParaclinicalsOpen = ref(false);
    const isDropdownRelativesOpen = ref(false);
    const isDropdowWorkActivitiesOpen = ref(false);
    const isDropdownScholarshipsOpen = ref(false);
    const isDropdownTraumaticsOpen = ref(false);
    const isDropdownToxicsOpen = ref(false);
    const isDropdownSurgicalsOpen = ref(false);
    const isDropdownClinicHistoriesOpen = ref(false);
    const isDropdownMedicinesOpen = ref(false);
    const isDropdownCardiovascularEventsOpen = ref(false);

    const identification = ref('');
    const users = ref();
    const values = ref(false);

    const clinic_history = ref({});
    const cardiovascular_events = ref({});
    const pathological_records = ref({});
    const paraclinicals = ref({});
    const medicines = ref({});
    const relatives = ref({});
    const work_activities = ref({});
    const scholarships = ref({});
    const traumatics = ref({});
    const toxics = ref({});
    const surgicals = ref({});  

    const search = async () => {
        const response = await axios.post('/medic/getUser', {
            identification: identification.value,
        });

        users.value = response.data;
        values.value = true;

        console.log(response.data);

        const responseClinicHistories = await axios.post('/medic/getHistoryClinic', {
            user_id: users.value.id,
        });

        console.log("Historia clinica: ",responseClinicHistories.data);

        clinic_history.value = responseClinicHistories.data.clinic_history;
        cardiovascular_events.value = responseClinicHistories.data.cardiovascular_events;
        pathological_records.value = responseClinicHistories.data.pathological_records;
        paraclinicals.value = responseClinicHistories.data.paraclinicals;
        medicines.value = responseClinicHistories.data.medicines;
        relatives.value = responseClinicHistories.data.relatives;
        work_activities.value = responseClinicHistories.data.work_activities;
        scholarships.value = responseClinicHistories.data.scholarships;
        traumatics.value = responseClinicHistories.data.traumatics;
        toxics.value = responseClinicHistories.data.toxics;
        surgicals.value = responseClinicHistories.data.surgicals;
    };
    
</script>