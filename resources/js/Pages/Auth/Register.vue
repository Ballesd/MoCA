<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

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
    terms: false
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
};
</script>

<template>
    <AppLayout title="Register">
        <div class="h-full flex justify-center items-center p-4">
            <div class="w-full h-full p-10 bg-quinary shadow-md sm:rounded-3xl border border-gray-400 overflow-y-scroll">
                <!-- Formulario -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <InputLabel for="name" value="Nombre:" />
                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="lastname" value="Apellidos:" />
                        <TextInput id="lastname" v-model="form.lastname" type="text" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.lastname" />
                    </div>
                    <div>
                        <InputLabel for="email" value="Correo electrónico" />
                        <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                        <p class="text-xs text-gray-400">Puede ser de un familiar en caso de no tener uno propio</p>
                    </div>
                    <div>
                        <InputLabel for="identification" value="Cédula de ciudadanía:" />
                        <TextInput id="identification" v-model="form.identification" type="text" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.identification" />
                    </div>
                    <div>
                        <InputLabel for="birthdate" value="Fecha de nacimiento:" />
                        <TextInput id="birthdate" v-model="form.birthdate" type="date" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.birthdate" />
                    </div>
                    <div>
                        <InputLabel for="schooling" value="¿Su nivel de escolaridad es menor o igual a 12 años?:" />
                        <select id="schooling" v-model="form.schooling" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No, tengo más de 12 años de estudio.</option>
                            <option value="1">Sí, tengo menos de 12 años o igual.</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.schooling" />
                    </div>
                    <div>
                        <InputLabel for="birthday_place" value="Lugar de nacimiento:" />
                        <TextInput id="birthday_place" v-model="form.birthday_place" type="text" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.birthday_place" />
                    </div>
                    <div>
                        <InputLabel for="sex" value="Seleccione género:" />
                        <select id="sex" v-model="form.sex" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.sex" />
                    </div>
                    <div>
                        <InputLabel for="address" value="Dirección de residencia:" />
                        <TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>
                    <div>
                        <InputLabel for="phone" value="Teléfono:" />
                        <TextInput id="phone" v-model="form.phone" type="text" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                    <div>
                        <InputLabel for="civil_status" value="Estado civil:" />
                        <select id="civil_status" v-model="form.civil_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                            <option value="separado">Separado</option>
                            <option value="union_libre">Unión libre</option>
                            <option value="viudo">Viudo</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.civil_status" />
                    </div>
                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div>
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                </div>
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />
                            <div class="ml-2">
                                I agree to the
                                <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a>
                                and
                                <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                    </InputLabel>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </div>
                <div class="flex flex-col items-center justify-center mt-5 space-y-4">
                    <p class="text-gray-400">¿Ya tienes una cuenta? 
                        <Link :href="route('login')" class="underline text-sm text-gray-400 hover:text-gray-600">INICIA SESIÓN AQUÍ</Link>
                    </p>
                    <ButtonCustom :class="{ 'opacity-25': form.processing }" :disabled="form.processing" :onclick="submit">
                        REGISTRARME
                    </ButtonCustom>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
