<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="flex justify-center font-semibold text-xl text-gray-800 leading-tight">
                DESARROLLO DEL PROTOCOLO PARA EL ESTUDIO DE PARTICIPANTES
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
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton @click="search">
                            Buscar
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="values" class="mt-4">
            <div class="overflow-x-auto">
                <table class="table-auto w-full my-4 px-4 py-2 rounded-lg overflow-hidden">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-blue-900 text-white rounded-tl-lg">Nombre</th>
                            <th class="px-4 py-2 bg-blue-900 text-white">Email</th>
                            <th class="px-4 py-2 bg-blue-900 text-white">Cédula</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">{{ users.name }} {{ users.lastname }}</td>
                            <td class="border px-4 py-2">{{ users.email }}</td>
                            <td class="border px-4 py-2">{{ users.identification }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div v-if="values" class="mt-4">
            <div class="overflow-x-auto">
                <div class="p-4">
                    <h2 class="flex justify-center text-xl font-semibold mb-4">Llenar formulario</h2>
                    <!--clinic_histories-->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownClinicHistoriesOpen == false ? isDropdownClinicHistoriesOpen = true : isDropdownClinicHistoriesOpen = false"
                        >
                            Historia Clínica
                            <span :class="{ 'rotate-180': isDropdownClinicHistoriesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownClinicHistoriesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Historia Clínica</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Clínica" />
                                    <input class="input-field rounded-lg" type="text" v-model="clinic_histories.clinic" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Otro" />
                                    <input class="input-field rounded-lg" type="text" v-model="clinic_histories.other" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Instituto de Genética:" />
                                    <input class="input-field rounded-lg" type="text" v-model="clinic_histories.genetic_institute" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="PK" />
                                    <select class="input-field rounded-lg" v-model="clinic_histories.pk">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="ALZ" />
                                    <select class="input-field rounded-lg" v-model="clinic_histories.alz">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Control" />
                                    <select class="input-field rounded-lg" v-model="clinic_histories.control">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Muestra sangre:" />
                                    <select class="input-field rounded-lg" v-model="clinic_histories.blood_sample">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Muestra odontología:" />
                                    <select class="input-field rounded-lg" v-model="clinic_histories.dentistry_sample">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Ciudad" />
                                    <input class="input-field rounded-lg" type="text" v-model="clinic_histories.city" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Fecha" />
                                    <input class="input-field rounded-lg" type="date" v-model="clinic_histories.date" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Nombre del acudiente" />
                                    <input class="input-field rounded-lg" type="text" v-model="clinic_histories.attendant_name" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Parentesco" />
                                    <input class="input-field rounded-lg" type="text" v-model="clinic_histories.relationship" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Teléfono del acudiente" />
                                    <input class="input-field rounded-lg" type="text" v-model="clinic_histories.attendant_phone" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="MOTIVO DE CONSULTA:" />
                                    <textarea class="input-field rounded-lg" type="text" v-model="clinic_histories.reason" ></textarea>
                                </div>
                                <div>
                                    <InputLabel for="text" value="ENFERMEDAD ACTUAL:" />
                                    <textarea class="input-field rounded-lg" type="text" v-model="clinic_histories.current_illness" ></textarea>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Otra información:" />
                                    <textarea class="input-field rounded-lg" type="text" v-model="clinic_histories.other_information" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--WORK ACTIVITIES-->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdowWorkActivitiesOpen == false ? isDropdowWorkActivitiesOpen = true : isDropdowWorkActivitiesOpen = false"
                        >
                            Actividades Laborales
                            <span :class="{ 'rotate-180': isDropdowWorkActivitiesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdowWorkActivitiesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Actividades Laborales</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Actividad" />
                                    <input class="input-field rounded-lg" type="text" v-model="work_activities.activity" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Lugar" />
                                    <input class="input-field rounded-lg" type="text" v-model="work_activities.place" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Cargo" />
                                    <input class="input-field rounded-lg" type="text" v-model="work_activities.position" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Situación Actual" />
                                    <input class="input-field rounded-lg" type="text" v-model="work_activities.actual_situation" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Escolaridad-->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownScholarshipsOpen == false ? isDropdownScholarshipsOpen = true : isDropdownScholarshipsOpen = false"
                        >
                            Escolaridad
                            <span :class="{ 'rotate-180': isDropdownScholarshipsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownScholarshipsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Escolaridad</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Primaria" />
                                    <select class="input-field rounded-lg" v-model="scholarships.primary">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div>
                                    <InputLabel for="text" value="Secundaria" />
                                    <select class="input-field rounded-lg" v-model="scholarships.secondary">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div>
                                    <InputLabel for="text" value="Técnico Superior" />
                                    <input class="input-field rounded-lg" type="text" v-model="scholarships.technical_superior" />
                                </div>

                                <div>
                                    <InputLabel for="text" value="Profesional" />
                                    <input class="input-field rounded-lg" type="text" v-model="scholarships.profesional" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Postgrado" />
                                    <input class="input-field rounded-lg" type="text" v-model="scholarships.postgraduate" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--EVENTOS CARDIO VASCUALARES-->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownOpen == false ? isDropdownOpen = true : isDropdownOpen = false"
                        >
                            Eventos cardiovasculares
                            <span :class="{ 'rotate-180': isDropdownOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Eventos Cardiovasculares</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Isquémicos Cardíacos" />
                                    <select class="input-field rounded-lg" v-model="cardiovascular_events.ischemic_cardiac">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Hemorrágicos Cardíacos" />
                                    <select class="input-field rounded-lg" v-model="cardiovascular_events.hemorrhagic_cardiac">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución Cardíaco" />
                                    <input class="input-field rounded-lg" type="text" v-model="cardiovascular_events.time_cardiac" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Isquémicos Cerebrales" />
                                    <select class="input-field rounded-lg" v-model="cardiovascular_events.ischemic_cerebral">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Hemorrágicos Cerebrales" />
                                    <select class="input-field rounded-lg" v-model="cardiovascular_events.hemorrhagic_cerebral">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución Cerebral" />
                                    <input class="input-field rounded-lg" type="text" v-model="cardiovascular_events.time_cerebral" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Isquémicos Otros" />
                                    <select class="input-field rounded-lg" v-model="cardiovascular_events.ischemic_others">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Hemorrágicos Otros" />
                                    <select class="input-field rounded-lg" v-model="cardiovascular_events.hemorrhagic_others">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución de Otros" />
                                    <textarea class="input-field rounded-lg" v-model="cardiovascular_events.time_others"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Antecedentes patológicos. -->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownPatologicalOpen == false ? isDropdownPatologicalOpen = true : isDropdownPatologicalOpen = false"
                        >
                            Antecedentes patológicos
                            <span :class="{ 'rotate-180': isDropdownPatologicalOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownPatologicalOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes de Eventos Patológicos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Neoplasia" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.neoplasia">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Neoplasia" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.neoplasia_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución de Neoplastia" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.evolution_time" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Hipertensión Arterial" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.arterial_hypertension">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Hipertensión Arterial" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.arterial_hypertension_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución de la Hipertensión Arterial" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.arterial_hypertension_time" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Hipotiroidismo" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.hypothyroidism">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Hipotiroidismo" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.hypothyroidism_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución del Hipotiroidismo" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.hypothyroidism_time" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Hiperlipidemia" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.hiperlipidemia">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Hiperlipidemia" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.hiperlipidemia_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución de la Hiperlipidemia" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.hiperlipidemia_time" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Neurológico" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.neurological">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Neurológico" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.neurological_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución Neurológico" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.neurological_time" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Psiquiátrico" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.psychiatric">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Psiquiátrico" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.psychiatric_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución Psiquiátrico" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.psychiatric_time" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Infección Crónica" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.chronic_infection">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Infección Crónica" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.chronic_infection_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución Crónica" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.chronic_infection_time" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Otros" />
                                    <select class="input-field rounded-lg" v-model="pathological_records.others">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tipo de Otros" />
                                    <input class="input-field rounded-lg" type="text" v-model="pathological_records.others_type" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de evolución de otros" />
                                    <textarea class="input-field rounded-lg" type="text" v-model="pathological_records.others_time" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--surgicals-->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownSurgicalsOpen == false ? isDropdownSurgicalsOpen = true : isDropdownSurgicalsOpen = false"
                        >
                            Antecedentes quirúrgicos
                            <span :class="{ 'rotate-180': isDropdownSurgicalsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownSurgicalsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Quirúrgicos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div>
                                        <InputLabel for="text" value="Tipo de Cirugía" />
                                        <textarea class="input-field rounded-lg" type="text" v-model="surgicals.type_surgery"></textarea>
                                    </div>
                                    <div>
                                        <InputLabel for="text" value="Tiempo transcurrido (Desde la cirugía)" />
                                        <textarea class="input-field rounded-lg" type="text" v-model="surgicals.elapsed_time"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Antecedentes traumáticos. -->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownTraumaticsOpen == false ? isDropdownTraumaticsOpen = true : isDropdownTraumaticsOpen = false"
                        >
                            Antecedentes traumáticos
                            <span :class="{ 'rotate-180': isDropdownTraumaticsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownTraumaticsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Traumáticos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Craneoencefálico Específico" />
                                    <input class="input-field rounded-lg" type="text" v-model="traumatics.specific_craniocerebral" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo transcurrido Craneoencefálico" />
                                    <input class="input-field rounded-lg" type="text" v-model="traumatics.elapsed_time" />
                                </div>  
                                <div>
                                    <InputLabel for="text" value="Otros eventos Traumáticos" />
                                    <select class="input-field rounded-lg" v-model="traumatics.other_traumatic">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo transcurrido en los otros eventos Traumáticos" />
                                    <textarea class="input-field rounded-lg" type="text" v-model="traumatics.other_traumatic_time" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Antecedentes toxicos. -->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownToxicsOpen == false ? isDropdownToxicsOpen = true : isDropdownToxicsOpen = false"
                        >
                            Antecedentes tóxicos
                            <span :class="{ 'rotate-180': isDropdownToxicsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownToxicsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Tóxicos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Fumador Activo" />
                                    <select class="input-field rounded-lg" v-model="toxics.active_tobacco">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consumo de tabaco previo" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.previus_active_tobacco" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Edad de Exposición al tabaco" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.age_tobacco_exposition" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="No. De Paquetes/año (Cigarrillo)" />
                                    <input class="input-field rounded-lg" type="number" v-model="toxics.packages_per_year" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Fumador Pasivo" />
                                    <select class="input-field rounded-lg" v-model="toxics.pasive_tobacco">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consumo de tabaco previo como pasivo" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.previus_pasive_tobacco" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Edad de Exposición al tabaco como pasivo" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.age_pasive_tobacco_exposition" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="No. De Paquetes/año (Cigarrillo) como pasivo" />
                                    <input class="input-field rounded-lg" type="number" v-model="toxics.packages_per_year_pasive" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Exposición a Humo de Leña" />
                                    <select class="input-field rounded-lg" v-model="toxics.wood_smoke">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Tiempo de exposición previo al Humo de Leña" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.previus_wood_smoke" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Edad de Exposición al Humo de Leña" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.age_wood_smoke_exposition" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consumo de Alcohol" />
                                    <select class="input-field rounded-lg" v-model="toxics.alcohol">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consumo de Alcohol previo" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.previus_alcohol" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Edad de Exposición al Alcohol" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.age_alcohol_exposition" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Frecuencia del consumo de Alcohol" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.frecuency_alcohol" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consumo de Drogas" />
                                    <select class="input-field rounded-lg" v-model="toxics.drugs">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                <InputLabel for="text" value="Consumo de Drogas previo" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.previus_drugs" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Edad de Exposición a las Drogas" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.age_drugs_exposition" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Frecuencia del consumo de Drogas" />
                                    <input class="input-field rounded-lg" type="text" v-model="toxics.frecuency_drugs" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Medicamentos:-->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownMedicinesOpen == false ? isDropdownMedicinesOpen = true : isDropdownMedicinesOpen = false"
                        >
                            Medicamentos
                            <span :class="{ 'rotate-180': isDropdownMedicinesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownMedicinesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Medicamentos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div>
                                        <InputLabel for="text" value="Aluminio:" />
                                        <input class="input-field rounded-lg" type="text" v-model="medicines.aluminum" />
                                    </div>
                                    <div>
                                        <InputLabel for="text" value="Otros" />
                                        <textarea class="input-field rounded-lg" type="text" v-model="medicines.others"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--paraclinicals. -->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownParaclinicalsOpen == false ? isDropdownParaclinicalsOpen = true : isDropdownParaclinicalsOpen = false"
                        >
                            Paraclínicos
                            <span :class="{ 'rotate-180': isDropdownParaclinicalsOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownParaclinicalsOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Paraclinicos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Fecha de Resonancia Magnética Nuclear" />
                                    <input class="input-field rounded-lg" type="date" v-model="paraclinicals.nuclear_magnetic_resonance_date" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Concepto de Resonancia Magnética Nuclear" />
                                    <input class="input-field rounded-lg" type="text" v-model="paraclinicals.nuclear_magnetic_resonance_concept" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Fecha de TAC" />
                                    <input class="input-field rounded-lg" type="date" v-model="paraclinicals.tac_date" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Concepto de TAC" />
                                    <input class="input-field rounded-lg" type="text" v-model="paraclinicals.tac_concept" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--relatives-->
                    <div class="mb-4">
                        <button
                            class="w-full h-full bg-blue-500 text-white py-4 px-8 rounded-md relative"
                            @click="isDropdownRelativesOpen == false ? isDropdownRelativesOpen = true : isDropdownRelativesOpen = false"
                        >
                            Antecedentes Familiares
                            <span :class="{ 'rotate-180': isDropdownRelativesOpen }" class="absolute right-0 top-0 bottom-0 flex items-center pr-4 transition-transform">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="mt-4" :class="{ 'hidden': !isDropdownRelativesOpen }">
                            <h3 class="flex justify-center text-lg font-bold mb-2">Antecedentes Familiares</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="text" value="Padres" />
                                    <select class="input-field rounded-lg" v-model="relatives.parents">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Parentesco" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_parents" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Padres" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_parents" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Diabetes" />
                                    <select class="input-field rounded-lg" v-model="relatives.diabetes">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div >
                                    <InputLabel for="text" value="Especificar Diabetes" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_diabetes" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Grado de consanguinidad en Diabetes" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_diabetes" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Cardiovasculares" />
                                    <select class="input-field rounded-lg" v-model="relatives.cardiovascular">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Cardiovasculares" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_cardiovascular" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Grado de consanguinidad Cardiovasculares" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_cardiovascular" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Hipertensión" />
                                    <select class="input-field rounded-lg" v-model="relatives.hypertension">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Hipertensión" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_hypertension" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Hipertensión" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_hypertension" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Neoplasias" />
                                    <select class="input-field rounded-lg" v-model="relatives.neoplasms">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Neoplasias" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_neoplasms" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Neoplasias" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_neoplasms" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Psiquiátricos" />
                                    <select class="input-field rounded-lg" v-model="relatives.psychiatric">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Psiquiátricos" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_psychiatric" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Psiquiátricos" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_psychiatric" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Neurológicos" />
                                    <select class="input-field rounded-lg" v-model="relatives.neurological">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Neurológicos" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_neurological" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Neurológicos" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_neurological" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Síndrome de Down" />
                                    <select class="input-field rounded-lg" v-model="relatives.down_syndrome">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Síndrome de Down" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_down_syndrome" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Síndrome de Down" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_down_syndrome" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Discapacidad Intelectual" />
                                    <select class="input-field rounded-lg" v-model="relatives.intellectual_disability">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Discapacidad Intelectual" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_intellectual_disability" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Discapacidad Intelectual" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_intellectual_disability" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Demencia" />
                                    <select class="input-field rounded-lg" v-model="relatives.dementia">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Demencia" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_dementia" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Consanguinidad Demencia" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_dementia" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Otros" />
                                    <select class="input-field rounded-lg" v-model="relatives.others">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div>
                                    <InputLabel for="text" value="Especificar Otros" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.specify_others" />
                                </div>
                                <div>
                                    <InputLabel for="text" value="Grado de consanguinidad en Otros" />
                                    <input class="input-field rounded-lg" type="text" v-model="relatives.consanguinity_others" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="values" class="flex justify-center">
            <button
            class="h-full bg-green-500 text-white py-4 px-8 rounded-md relative"
            @click="saveInformation"
        >
            Guardar historia clínica
        </button>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import axios from 'axios';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { ref } from 'vue';

    const isDropdownOpen = ref(false);
    const isDropdownPatologicalOpen = ref(false);
    const isDropdownParaclinicalsOpen = ref(false);
    const isDropdownRelativesOpen = ref(false);
    const isDropdowWorkActivitiesOpen = ref(false);
    const isDropdownScholarshipsOpen = ref(false);
    const isDropdownTraumaticsOpen = ref(false);
    const isDropdownToxicsOpen = ref(false);
    const isDropdownSurgicalsOpen = ref(false);
    const isDropdownClinicHistoriesOpen = ref(false);
    const isDropdownMedicinesOpen = ref(false);

    const identification = ref('');
    const users = ref();
    const values = ref(false);

    const clinic_histories = ref({
        clinic: '',
        other: '',
        genetic_institute: '',
        pk: 0,
        alz: 0,
        control: 0,
        blood_sample: 0,
        dentistry_sample: 0,
        city: '',
        date: '',
        attendant_name: '',
        relationship: '',
        attendant_phone: '',
        reason: '',
        current_illness: '',
        other_information: ''
    });

    const cardiovascular_events = ref({
        ischemic_cardiac: 0,
        hemorrhagic_cardiac: 0,
        time_cardiac: '',
        ischemic_cerebral: 0,
        hemorrhagic_cerebral: 0,
        time_cerebral: '',
        ischemic_others: 0,
        hemorrhagic_others: 0,
        time_others: ''
    });

    const pathological_records = ref({
        neoplasia: 0,
        neoplasia_type: '',
        evolution_time: '',
        arterial_hypertension: 0,
        arterial_hypertension_type: '',
        arterial_hypertension_time: '',
        hypothyroidism: 0,
        hypothyroidism_type: '',
        hypothyroidism_time: '',
        hiperlipidemia: 0,
        hiperlipidemia_type: '',
        hiperlipidemia_time: '',
        neurological: 0,
        neurological_type: '',
        neurological_time: '',
        psychiatric: 0,
        psychiatric_type: '',
        psychiatric_time: '',
        chronic_infection: 0,
        chronic_infection_type: '',
        chronic_infection_time: '',
        others: 0,
        others_type: '',
        others_time: ''
    });

    const paraclinicals = ref({
        nuclear_magnetic_resonance_date: '',
        nuclear_magnetic_resonance_concept: '',
        tac_date: '',
        tac_concept: ''
    });

    const medicines = ref({
        aluminum: '',
        others: ''
    });
    const relatives = ref({
        parents: 0,
        specify_parents: '',
        consanguinity_parents: '',
        diabetes: 0,
        specify_diabetes: '',
        consanguinity_diabetes: '',
        cardiovascular: 0,
        specify_cardiovascular: '',
        consanguinity_cardiovascular: '',
        hypertension: 0,
        specify_hypertension: '',
        consanguinity_hypertension: '',
        neoplasms: 0,
        specify_neoplasms: '',
        consanguinity_neoplasms: '',
        psychiatric: 0,
        specify_psychiatric: '',
        consanguinity_psychiatric: '',
        neurological: 0,
        specify_neurological: '',
        consanguinity_neurological: '',
        down_syndrome: 0,
        specify_down_syndrome: '',
        consanguinity_down_syndrome: '',
        intellectual_disability: 0,
        specify_intellectual_disability: '',
        consanguinity_intellectual_disability: '',
        dementia: 0,
        specify_dementia: '',
        consanguinity_dementia: '',
        others: 0,
        specify_others: '',
        consanguinity_others: ''
    });

    const work_activities = ref({
        activity: '',
        place: '',
        position: '',
        actual_situation: ''
    });

    const scholarships = ref({
        primary: 0,
        secondary: 0,
        technical_superior: '',
        profesional: '',
        postgraduate: ''
    });

    const traumatics = ref({
        specific_craniocerebral: '',
        elapsed_time: '',
        other_traumatic: 0,
        other_traumatic_time: ''
    });

    const toxics = ref({
        active_tobacco: 0,
        previus_active_tobacco: '',
        age_tobacco_exposition: '',
        packages_per_year: '',
        pasive_tobacco: 0,
        previus_pasive_tobacco: '',
        age_pasive_tobacco_exposition: '',
        packages_per_year_pasive: '',
        wood_smoke: 0,
        previus_wood_smoke: '',
        age_wood_smoke_exposition: '',
        alcohol: 0,
        previus_alcohol: '',
        age_alcohol_exposition: '',
        frecuency_alcohol: '',
        drugs: 0,
        previus_drugs: '',
        age_drugs_exposition: '',
        frecuency_drugs: ''
    });

    const surgicals = ref({
        type_surgery: '',
        elapsed_time: ''
    });    
    const search = async () => {
        const response = await axios.post('/medic/getUser', {
            identification: identification.value,
        });

        users.value = response.data;
        values.value = true;

    };

    const saveInformation = async () =>{
        console.log("clinic_histories", clinic_histories.value);
        console.log("cardiovascular_events", cardiovascular_events.value);
        console.log("pathological_records", pathological_records.value);
        console.log("paraclinicals", paraclinicals.value);
        console.log("medicines", medicines.value);
        console.log("relatives", relatives.value);
        console.log("work_activities", work_activities.value);
        console.log("scholarships", scholarships.value);
        console.log("traumatics", traumatics.value);
        console.log("toxics", toxics.value);
        console.log("surgicals", surgicals.value);

        const response = await axios.post('/medic/makeHistiryCLinic', {
            clinic_histories: clinic_histories.value,
            cardiovascular_events: cardiovascular_events.value,
            pathological_records: pathological_records.value,
            paraclinicals: paraclinicals.value,
            medicines: medicines.value,
            relatives: relatives.value,
            work_activities: work_activities.value,
            scholarships: scholarships.value,
            traumatics: traumatics.value,
            toxics: toxics.value,
            surgicals: surgicals.value,
            user_id: users.value.id
        });

        console.log("respuesta",response.data);
        

    }
</script>
