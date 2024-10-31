<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonCustom from '@/Components/ButtonCustom.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    canResetPassword: Boolean,
    status: String
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? 'on' : ''
    })).post(route('login'), {
        onFinish: () => form.reset('password')
    });
};
</script>

<template>
    <AppLayout title="Log In">
        <div class="h-full flex flex-col justify-center items-center">
            <AuthenticationCard>
                <template #logo>
                    <AuthenticationCardLogo />
                </template>
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>
                <div>
                    <InputLabel for="email" value="Correo:" />
                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="mt-4">
                    <InputLabel for="password" value="Contraseña:" />
                    <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="current-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="flex items-center justify-center mt-4">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-400 hover:text-gray-600 rounded-md focus:outline-none"> Olvidé mi contraseña </Link>
                </div>
            </AuthenticationCard>
            <div class="flex items-center justify-center mt-5">
                <div class="flex items-center justify-center space-x-2 text-gray-400">
                    <p>¿No tienes una cuenta?</p>
                    <Link v-if="canResetPassword" :href="route('register')" class="underline text-sm text-gray-400 hover:text-gray-600 rounded-md focus:outline-none"> REGISTRATE AQUÍ </Link>
                </div>
            </div>
            <ButtonCustom class="ms-4 mt-14" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" :onclick="submit"> INICIAR SESION </ButtonCustom>
        </div>
    </AppLayout>
</template>
