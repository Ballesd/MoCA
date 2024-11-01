<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="flex justify-center font-semibold text-xl text-gray-800 leading-tight">Buscar Historial Clinico de Paciente</h2>
        </template>

        <div v-if="errorPoint" class="flex justify-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error: </strong>
            <span class="block sm:inline">{{ errorMessage }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="closeError">
                <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <title>Close</title>
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </span>
        </div>

        <div class="py-8">
            <div class="flex gap-4 w-8/12 mx-auto">
                <TextInput placeholder="Digite el número de cédula de la persona que desea buscar" id="search" type="text" v-model="identification" @keyup.enter="search" required autofocus class="block w-full" />
                <div class="w-1/3">
                    <ButtonCustom class="w-full" mode="button" @click="search">BUSCAR</ButtonCustom>
                </div>
            </div>
            <div v-if="values" class="mt-8 w-full h-full p-8 bg-quinary shadow-md sm:rounded-lg border border-gray-400">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-4 rounded-md">
                        <label class="text-gray-800 font-bold">Nombre: </label>
                        <label class="text-gray-900">{{ users.name }} {{ users.lastname }}</label>
                    </div>
                    <div class="bg-white p-4 rounded-md">
                        <label class="text-gray-800 font-bold">Cédula: </label>
                        <label class="text-gray-900">{{ users.identification }}</label>
                    </div>
                    <div class="bg-white p-4 rounded-md">
                        <label class="text-gray-800 font-bold">Fecha de nacimiento: </label>
                        <label class="text-gray-900">{{ users.birthdate }} en {{ users.birthday_place }}</label>
                    </div>
                    <div class="bg-white p-4 rounded-md">
                        <label class="text-gray-800 font-bold">Sexo: </label>
                        <label class="text-gray-900">{{ users.sex }}</label>
                    </div>
                    <div class="bg-white p-4 rounded-md">
                        <label class="text-gray-800 font-bold">Dirección: </label>
                        <label class="text-gray-900">{{ users.address }}</label>
                    </div>
                    <div class="bg-white p-4 rounded-md">
                        <label class="text-gray-800 font-bold">Teléfono: </label>
                        <label class="text-gray-900">{{ users.phone }}</label>
                    </div>
                    <div class="bg-white p-4 rounded-md">
                        <label class="text-gray-800 font-bold">Estado Civil: </label>
                        <label class="text-gray-900">{{ users.civil_status }}</label>
                    </div>
                </div>
            </div>
            <div v-if="values" class="mt-8">
                <div class="overflow-x-auto">
                    <div class="p-2">
                        <div class="mb-2">
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownClinicHistoriesOpen = !isDropdownClinicHistoriesOpen">Historia Clínica</ButtonCustom>
                            <div class="mt-8" :class="{ hidden: !isDropdownClinicHistoriesOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownClinicHistoriesOpen }">
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
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdowWorkActivitiesOpen = !isDropdowWorkActivitiesOpen">Actividades Laborales</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdowWorkActivitiesOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdowWorkActivitiesOpen }">
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
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownScholarshipsOpen = !isDropdownScholarshipsOpen">Escolaridad</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownScholarshipsOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownScholarshipsOpen }">
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
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownCardiovascularEventsOpen = !isDropdownCardiovascularEventsOpen">Eventos Cardiovasculares</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownCardiovascularEventsOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownCardiovascularEventsOpen }">
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
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownPathologicalRecordsOpen = !isDropdownPathologicalRecordsOpen">Antecedentes Patológicos</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownPathologicalRecordsOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownPathologicalRecordsOpen }">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Neoplasia:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.neoplasia ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Neoplasia:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.neoplasia_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Neoplasia:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.evolution_time }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hipertensión Arterial:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.arterial_hypertension ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Hipertensión Arterial:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.arterial_hypertension_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Hipertensión Arterial:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.arterial_hypertension_time }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hipotiroidismo:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.hypothyroidism ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Hipotiroidismo:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.hypothyroidism_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Hipotiroidismo:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.hypothyroidism_time }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Hiperlipidemia:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.hiperlipidemia ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Hiperlipidemia:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.hiperlipidemia_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Hiperlipidemia:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.hiperlipidemia_time }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Neurológico:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.neurological ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Neurológico:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.neurological_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Neurológico:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.neurological_time }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Psiquiátrico:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.psychiatric ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Psiquiátrico:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.psychiatric_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Psiquiátrico:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.psychiatric_time }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Infección Crónica:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.chronic_infection ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Infección Crónica:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.chronic_infection_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Infección Crónica:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.chronic_infection_time }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Otro:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.others ? 'Si' : 'No' }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tipo de Otro:</p>
                                            <p class="flex justify-center text-gray-900">{{ pathological_records.others_type }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Tiempo de Evolución Otro:</p>
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
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownSurgicalsOpen = !isDropdownSurgicalsOpen">Antecedentes Quirúrgicos</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownSurgicalsOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownSurgicalsOpen }">
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
                <div class="overflow-x-auto">
                    <div class="p-2">
                        <div class="mb-2">
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownTraumaticsOpen = !isDropdownTraumaticsOpen">Antecedentes Traumáticos</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownTraumaticsOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownTraumaticsOpen }">
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
                                            <p class="flex justify-center text-gray-900">{{ traumatics.other_traumatic ? 'Si' : 'No' }}</p>
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
                <div class="overflow-x-auto">
                    <div class="p-2">
                        <div class="mb-2">
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownToxicsOpen = !isDropdownToxicsOpen">Antecedentes Tóxicos</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownToxicsOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownToxicsOpen }">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold">Tabaco Activo:</p>
                                            <p class="flex justify-center text-gray-900">{{ toxics.active_tobacco ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ toxics.pasive_tobacco ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ toxics.wood_smoke ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ toxics.alcohol ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ toxics.drugs ? 'Si' : 'No' }}</p>
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
                <div class="overflow-x-auto">
                    <div class="p-2">
                        <div class="mb-2">
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownMedicinesOpen = !isDropdownMedicinesOpen">Medicamentos</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownMedicinesOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownMedicinesOpen }">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold">Aluminio:</p>
                                            <p class="flex justify-center text-gray-900">{{ medicines.Aluminum ? 'Si' : 'No' }}</p>
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
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownParaclinicalsOpen = !isDropdownParaclinicalsOpen">Paraclinicos</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownParaclinicalsOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownParaclinicalsOpen }">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">Resonancia Magnética Nuclear:</p>
                                            <p class="flex justify-center text-gray-900">{{ paraclinicals.nuclear_magnetic_resonance_date }}</p>
                                            <p class="flex justify-center text-gray-900">{{ paraclinicals.nuclear_magnetic_resonance_concept }}</p>
                                        </div>
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold mb-2">TAC:</p>
                                            <p class="flex justify-center text-gray-900">{{ paraclinicals.tac_date }}</p>
                                            <p class="flex justify-center text-gray-900">{{ paraclinicals.tac_concept }}</p>
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
                            <ButtonCustom class="w-full h-full" mode="button" @click="isDropdownRelativesOpen = !isDropdownRelativesOpen">Antecedentes Familiares</ButtonCustom>
                            <div class="mt-4" :class="{ hidden: !isDropdownRelativesOpen }">
                                <div class="mt-4" :class="{ hidden: !isDropdownRelativesOpen }">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <div class="bg-white p-4 shadow-md rounded-lg">
                                            <p class="flex justify-center text-gray-800 text-sm font-bold">Padres:</p>
                                            <p class="flex justify-center text-gray-900">{{ relatives.parents ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.diabetes ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.cardiovascular ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.hypertension ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.neoplasms ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.psychiatric ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.neurological ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.down_syndrome ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.intellectual_disability ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.dementia ? 'Si' : 'No' }}</p>
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
                                            <p class="flex justify-center text-gray-900">{{ relatives.others ? 'Si' : 'No' }}</p>
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
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';
import InputError from '@/Components/InputError.vue';

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
const errorPoint = ref(false);
const errorMessage = ref('');

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
    if (identification.value == '') {
        errorPoint.value = true;
        errorMessage.value = 'El campo de identificación no puede estar vacío';
        return;
    } else {
        const response = await axios.post('/medic/getUser', {
            identification: identification.value
        });
        if (response.data == 'No se encontro el usuario') {
            errorPoint.value = true;
            errorMessage.value = 'El usuario no existe o no se ha registrado';
            return;
        } else {
            users.value = response.data;
            values.value = true;

            const responseClinicHistories = await axios.post('/medic/getHistoryClinic', {
                user_id: users.value.id
            });

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
        }
    }
};

const closeError = () => {
    errorPoint.value = false;
};
</script>
