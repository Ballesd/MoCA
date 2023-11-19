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

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
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

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
