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
                            @click="isDropdowWorkActivitiesOpen = !isDropdowWorkActivitiesOpen"
                        >
                            Actividades Laborales
                            <span :class="{ 'rotate-180': isDropdowWorkActivitiesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdowWorkActivitiesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Actividades Laborales</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdowWorkActivitiesOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Actividad:</p>
                                        <p class="flex justify-center text-gray-900">{{ work_activities.activity }} en {{ work_activities.place }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Cargo:</p>
                                        <p class="flex justify-center text-gray-900">{{ work_activities.position }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Situación Actual:</p>
                                        <p class="flex justify-center text-gray-900">{{ work_activities.actual_situation }}</p>
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
                            @click="isDropdownScholarshipsOpen = !isDropdownScholarshipsOpen"
                        >
                            Escolaridad
                            <span :class="{ 'rotate-180': isDropdownScholarshipsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownScholarshipsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Escolaridad</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownScholarshipsOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Primaria:</p>
                                        <p class="flex justify-center text-gray-900">{{ scholarships.primary ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Secundaria:</p>
                                        <p class="flex justify-center text-gray-900">{{ scholarships.secondary ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Técnico Superior:</p>
                                        <p class="flex justify-center text-gray-900">{{ scholarships.technical_superior ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Profesional:</p>
                                        <p class="flex justify-center text-gray-900">{{ scholarships.profesional ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Postgrado:</p>
                                        <p class="flex justify-center text-gray-900">{{ scholarships.postgraduate ? 'Si' : 'No' }}</p>
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
            <div class="overflow-x-auto">
                <div class="p-2">
                    <div class="mb-2">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownPathologicalRecordsOpen = !isDropdownPathologicalRecordsOpen"
                        >
                            Antecedentes Patológicos
                            <span :class="{ 'rotate-180': isDropdownPathologicalRecordsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownPathologicalRecordsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Patológicos</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownPathologicalRecordsOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Neoplasia: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.neoplasia  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Neoplasia: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.neoplasia_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Neoplasia: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.evolution_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hipertensión Arterial: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.arterial_hypertension  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Hipertensión Arterial: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.arterial_hypertension_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Hipertensión Arterial: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.arterial_hypertension_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hipotiroidismo: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.hypothyroidism  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Hipotiroidismo: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.hypothyroidism_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Hipotiroidismo: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.hypothyroidism_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hiperlipidemia: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.hiperlipidemia  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Hiperlipidemia: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.hiperlipidemia_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Hiperlipidemia: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.hiperlipidemia_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Neurológico: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.neurological  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Neurológico: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.neurological_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Neurológico: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.neurological_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Psiquiátrico: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.psychiatric  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Psiquiátrico: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.psychiatric_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Psiquiátrico: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.psychiatric_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Infección Crónica: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.chronic_infection  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Infección Crónica: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.chronic_infection_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Infección Crónica: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.chronic_infection_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Otro: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.others  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Otro: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.others_type }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Otro: </p>
                                        <p class="flex justify-center text-gray-900">{{ pathological_records.others_time }}</p>
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
                            @click="isDropdownSurgicalsOpen = !isDropdownSurgicalsOpen"
                        >
                            Antecedentes Quirúrgicos
                            <span :class="{ 'rotate-180': isDropdownSurgicalsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownSurgicalsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Quirúrgicos</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownSurgicalsOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Cirugía</p>
                                        <p class="flex justify-center text-gray-900">{{ surgicals.type_surgery }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución</p>
                                        <p class="flex justify-center text-gray-900">{{ surgicals.elapsed_time }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <!--Traumaticos
                            $table->string("specific_craniocerebral")->nullable();
            $table->text("elapsed_time")->nullable();

            $table->string("other_traumatic")->nullable();
            $table->text("other_traumatic_time")->nullable();-->
            <div class="overflow-x-auto">
                <div class="p-2">
                    <div class="mb-2">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownTraumaticsOpen = !isDropdownTraumaticsOpen"
                        >
                            Antecedentes Traumáticos
                            <span :class="{ 'rotate-180': isDropdownTraumaticsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> 
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownTraumaticsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Traumáticos</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownTraumaticsOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Craneoencefálico Específico:</p>
                                        <p class="flex justify-center text-gray-900">{{ traumatics.specific_craniocerebral }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tiempo de Evolución Craneoencefálico:</p>
                                        <p class="flex justify-center text-gray-900">{{ traumatics.elapsed_time }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Otro:</p>
                                        <p class="flex justify-center text-gray-900">{{ traumatics.other_traumatic  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tiempo de Evolución de otros:</p>
                                        <p class="flex justify-center text-gray-900">{{ traumatics.other_traumatic_time }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--toxics
                        $table->boolean("active_tobacco")->nullable();
            $table->string("previus_active_tobacco")->nullable();
            $table->string("age_tobacco_exposition")->nullable();
            $table->integer("packages_per_year")->nullable();

            $table->boolean("pasive_tobacco")->nullable();
            $table->string("previus_pasive_tobacco")->nullable();
            $table->string("age_pasive_tobacco_exposition")->nullable();
            $table->integer("packages_per_year_pasive")->nullable();

            $table->boolean("wood_smoke")->nullable();
            $table->string("previus_wood_smoke")->nullable();
            $table->string("age_wood_smoke_exposition")->nullable();

            $table->boolean("alcohol")->nullable();
            $table->string("previus_alcohol")->nullable();
            $table->string("age_alcohol_exposition")->nullable();
            $table->string("frecuency_alcohol")->nullable();

            $table->boolean("drugs")->nullable();
            $table->string("previus_drugs")->nullable();
            $table->string("age_drugs_exposition")->nullable();
            $table->string("frecuency_drugs")->nullable();-->
            <div class="overflow-x-auto">
                <div class="p-2">
                    <div class="mb-2">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownToxicsOpen = !isDropdownToxicsOpen"
                        >
                            Antecedentes Tóxicos
                            <span :class="{ 'rotate-180': isDropdownToxicsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> 
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownToxicsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Tóxicos</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownToxicsOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tabaco Activo:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.active_tobacco  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tabaco Previo:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.previus_active_tobacco }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tiempo de Exposición al Tabacco:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.age_tobacco_exposition }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Paquetes por Año:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.packages_per_year }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tabaco Pasivo:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.pasive_tobacco  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tabaco Previo como pasivo:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.previus_pasive_tobacco }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tiempo de Exposición al Tabacco como pasivo:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.age_pasive_tobacco_exposition }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Paquetes por Año:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.packages_per_year_pasive }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Humo de Leña:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.wood_smoke  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Humo de leña previo</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.previus_wood_smoke }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tiempo de Exposición al humo de leña:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.age_wood_smoke_exposition }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Alcohol:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.alcohol  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Alcohol previo:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.previus_alcohol }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tiempo de Exposición al Alcohol:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.age_alcohol_exposition }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Frecuencia de consumo (Alcohol):</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.frecuency_alcohol }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Drogas:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.drugs  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Drogas previo:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.previus_drugs }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Tiempo de Exposición a las Drogas:</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.age_drugs_exposition }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Frecuencia de consumo (Drogas):</p>
                                        <p class="flex justify-center text-gray-900">{{ toxics.frecuency_drugs }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--Medicines
            $table->string("Aluminum")->nullable();
            $table->text("others")->nullable();
-->
            <div class="overflow-x-auto">
                <div class="p-2">
                    <div class="mb-2">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownMedicinesOpen = !isDropdownMedicinesOpen"
                        >
                            Medicamentos
                            <span :class="{ 'rotate-180': isDropdownMedicinesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> 
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownMedicinesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Medicamentosos</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownMedicinesOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Aluminio:</p>
                                        <p class="flex justify-center text-gray-900">{{ medicines.Aluminum  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Otros:</p>
                                        <p class="flex justify-center text-gray-900">{{ medicines.others }}</p>
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
                            @click="isDropdownParaclinicalsOpen = !isDropdownParaclinicalsOpen"
                        >
                            Paraclinicos
                            <span :class="{ 'rotate-180': isDropdownParaclinicalsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownParaclinicalsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Paraclinicos</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownParaclinicalsOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Resonancia Magnética Nuclear: </p>
                                        <p class="flex justify-center text-gray-900">{{ paraclinicals.nuclear_magnetic_resonance_date }}</p>
                                        <p class="flex justify-center text-gray-900">{{ paraclinicals.nuclear_magnetic_resonance_concept }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">TAC: </p>
                                        <p class="flex justify-center text-gray-900">{{ paraclinicals.tac_date }}</p>
                                        <p class="flex justify-center text-gray-900">{{ paraclinicals.tac_concept }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Antecendentes familiares
                        $table->boolean("parents")->nullable();
            $table->string("specify_parents")->nullable();
            $table->string("consanguinity_parents")->nullable();

            $table->boolean("diabetes")->nullable();
            $table->string("specify_diabetes")->nullable();
            $table->string("consanguinity_diabetes")->nullable();

            $table->boolean("cardiovascular")->nullable();
            $table->string("specify_cardiovascular")->nullable();
            $table->string("consanguinity_cardiovascular")->nullable();

            $table->boolean("hypertension")->nullable();
            $table->string("specify_hypertension")->nullable();
            $table->string("consanguinity_hypertension")->nullable();

            $table->boolean("neoplasms")->nullable();
            $table->string("specify_neoplasms")->nullable();
            $table->string("consanguinity_neoplasms")->nullable();

            $table->boolean("psychiatric")->nullable();
            $table->string("specify_psychiatric")->nullable();
            $table->string("consanguinity_psychiatric")->nullable();

            $table->boolean("neurological")->nullable();
            $table->string("specify_neurological")->nullable();
            $table->string("consanguinity_neurological")->nullable();
            
            $table->boolean("down_syndrome")->nullable();
            $table->string("specify_down_syndrome")->nullable();
            $table->string("consanguinity_down_syndrome")->nullable();

            $table->boolean("intellectual_disability")->nullable();
            $table->string("specify_intellectual_disability")->nullable();
            $table->string("consanguinity_intellectual_disability")->nullable();

            $table->boolean("dementia")->nullable();
            $table->string("specify_dementia")->nullable();
            $table->string("consanguinity_dementia")->nullable();

            $table->boolean("others")->nullable();
            $table->string("specify_others")->nullable();
            $table->string("consanguinity_others")->nullable();-->
            <div class="overflow-x-auto">
                <div class="p-2">
                    <div class="mb-2">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownRelativesOpen = !isDropdownRelativesOpen"
                        >
                            Antecedentes Familiares
                            <span :class="{ 'rotate-180': isDropdownRelativesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> 
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownRelativesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Familiares</h3>
                            <div class="mt-4" :class="{ 'hidden': !isDropdownRelativesOpen }">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Padres:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.parents  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">específico:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_parents }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Parentesco:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_parents }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Diabetes:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.diabetes  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Diabetes específica</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_diabetes }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Parentesco con diabetes:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_diabetes }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Cardiovascular:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.cardiovascular  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Cardiovascular específica</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_cardiovascular }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Parentesco con Cardiovascular:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_cardiovascular }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Hipertensión:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.hypertension  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hipertensión específica</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_hypertension }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Parentesco con Hipertensión:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_hypertension }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Neoplasias:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.neoplasms  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Neoplasias específica</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_neoplasms }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Parentesco con Neoplasias:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_neoplasms }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Psiquiátricas:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.psychiatric  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Psiquiátricas específica</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_psychiatric }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Parentesco con Psiquiátricas:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_psychiatric }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Neurológicas:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.neurological  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Neurológicas específica</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_neurological }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Parentesco con Neurológicas:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_neurological }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Síndrome de Down:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.down_syndrome  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Síndrome de Down específico</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_down_syndrome }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Parentesco con Síndrome de Down:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_down_syndrome }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Discapacidad Intelectual:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.intellectual_disability  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Discapacidad Intelectual específico</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_intellectual_disability }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Parentesco con Discapacidad Intelectual:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_intellectual_disability }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Demencia:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.dementia  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Demencia específico</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_dementia }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Parentesco con Demencia:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_dementia }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg"> 
                                        <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Otros:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.others  ? 'Si' : 'No' }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Otros específico</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.specify_others }}</p>
                                    </div>
                                    <div class="bg-white p-4 shadow-md rounded-lg">
                                        <p class="flex justify-center text-gray-800 text-sm font-bold">Parentesco con Otros:</p>
                                        <p class="flex justify-center text-gray-900">{{ relatives.consanguinity_others }}</p>
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
    const isDropdownPathologicalRecordsOpen = ref(false);
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