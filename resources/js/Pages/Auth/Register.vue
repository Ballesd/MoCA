<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    lastname: '',
    identification: '',
    birthdate: '',
    schooling: '',
    birthday_place: '',
    sex: '',
    address: '',
    phone: '',
    civil_status: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <div class="bg-slate-200">
        <!-- component -->
        <div x-data="{ open: false }">
            <nav class="flex justify-between items-center bg-white px-6 py-4 sm:px-10 lg:px-20">
                <h1 class="text-xl font-bold text-gray-800">MoCA</h1>
                <button @click="open = !open" class="text-gray-800 focus:outline-none sm:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
                <div class="hidden sm:flex items-center space-x-6">
                    <Link :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>
                    <Link :href="route('login')" class="font-semibold text-white bg-blue-500 hover:bg-blue-600 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-md px-4 py-2">Inicio de sesión</Link>
                    <Link :href="route('register')" class="font-semibold text-white bg-green-500 hover:bg-green-600 dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 rounded-md px-4 py-2" x-show="canRegister">Registrarse</Link>
                </div>
                <!-- Mobile menu -->
                <div class="absolute top-0 left-0 w-full bg-white sm:hidden" x-show="open" @click.away="open = false">
                    <ul class="flex flex-col items-center space-y-4 p-6">
                        <li><Link :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</Link></li>
                        <li><Link :href="route('login')" class="font-semibold text-gray-800 hover:text-gray-900">Inicio de sesión</Link></li>
                        <li x-show="canRegister"><Link :href="route('register')" class="font-semibold text-gray-800 hover:text-gray-900">Registrarse</Link></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <InputLabel for="name" value="Nombre:" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                
                <div>
                    <InputLabel for="lastname" value="Apellidos:" />
                    <TextInput
                        id="lastname"
                        v-model="form.lastname"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Correo electrónico (puede ser de un familiar en caso de no tener uno propio)" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="identification" value="Cédula de ciudadanía:" />
                <TextInput
                    id="identification"
                    v-model="form.identification"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.identification" />
            </div>

            <div class="mt-4">
                <InputLabel for="birthdate" value="Fecha de nacimiento:" />
                <TextInput
                    id="birthdate"
                    v-model="form.birthdate"
                    type="date"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.birthdate" />
            </div>

            <!--schooling-->
            <div class="mt-4">
                <InputLabel for="schooling" value="¿Su nivel de escolaridad es menor o igual a 12 años?:" />
                <select id="schooling" v-model="form.schooling" class="mt-1 block
                w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="0">No, tengo más de 12 años de estudio.</option>
                    <option value="1">Sí, tengo menos de 12 años o igual.</option>
                </select>
                <InputError class="mt-2" :message="form.errors.schooling" />
            </div>

            <div class="mt-4">
                <InputLabel for="birthday_place" value="Lugar de nacimiento:" />
                <TextInput
                    id="birthday_place"
                    v-model="form.birthday_place"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.birthday_place" />
            </div>

            <!--Con el input de punticos seleccionamos M y F-->
            <div class="mt-4">
                <InputLabel for="sex" value="Seleccione sexo:" />
                <div class="flex items-center mb-4">
                    <input id="sex-female"
                    v-model="form.sex"
                    type="radio" value="F" name="sex-female" class="w-4 h-4 text-blue-600 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-1">Femenino</label>
                </div>
                <div class="flex items-center">
                    <input id="sex-masculine" type="radio" 
                    v-model="form.sex"
                    value="M" name="sex-masculine" class="w-4 h-4 text-blue-600 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2">Masculino</label>
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="address" value="Dirección de residencia:" />
                <TextInput
                    id="address"
                    v-model="form.address"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Teléfono:" />
                <TextInput
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="mt-4">
                <InputLabel for="civil_status" value="Estado civil:" />
                <div class="flex items-center">
                    <input id="civil_status_soltero" type="radio" 
                    v-model="form.civil_status"
                    value="soltero" name="civil_status_soltero" class="w-4 h-4 text-blue-600 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2">Soltero</label>
                </div>
                <div class="flex items-center mb-4">
                    <input id="civil_status_casado"
                    v-model="form.civil_status"
                    type="radio" value="casado" name="civil_status_casado" class="w-4 h-4 text-blue-600 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-1">Casado</label>
                </div>
                <div class="flex items-center mb-4">
                    <input id="civil_status_separado"
                    v-model="form.civil_status"
                    type="radio" value="separado" name="civil_status_separado" class="w-4 h-4 text-blue-600 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-1">Separado</label>
                </div>
                <div class="flex items-center">
                    <input id="civil_status_union_libre" type="radio" 
                    v-model="form.civil_status"
                    value="union_libre" name="civil_status_union_libre" class="w-4 h-4 text-blue-600 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2">Unión libre</label>
                </div>
                <div class="flex items-center">
                    <input id="civil_status_viudo" type="radio" 
                    v-model="form.civil_status"
                    value="viudo" name="civil_status_viudo" class="w-4 h-4 text-blue-600 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2">Viudo</label>
                </div>
                <InputError class="mt-2" :message="form.errors.civil_status" />
            </div>
            
            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ms-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                </Link>

                <PrimaryButton class="ms-0 md:ms-4 mt-4 md:mt-0" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
