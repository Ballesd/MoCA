<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ButtonMain from "@/Components/ButtonMain.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />
    <div class="bg-slate-200">
        <!-- component -->
        <div x-data="{ open: false }">
            <nav
                class="flex justify-between items-center bg-white px-6 py-4 sm:px-10 lg:px-20"
            >
                <h1 class="text-xl font-bold text-gray-800">MoCA</h1>
                <button
                    @click="open = !open"
                    class="text-gray-800 focus:outline-none sm:hidden"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"
                        ></path>
                    </svg>
                </button>
                <div class="hidden sm:flex items-center space-x-6">
                    <Link
                        :href="route('login')"
                       class=" text ' text-gray-500 hover:text-gray-600 rounded-md focus:outline-none"
                        >Inicio de sesión</Link
                    >

                </div>
                <!-- Mobile menu -->
                <div
                    class="absolute top-0 left-0 w-full bg-white sm:hidden"
                    x-show="open"
                    @click.away="open = false"
                >
                    <ul class="flex flex-col items-center space-y-4 p-6">
                        <li>
                            <Link
                                :href="route('dashboard')"
                                class="font-semibold text-gray-600 hover:text-gray-900"
                                >Dashboard</Link
                            >
                        </li>
                        <li>
                            <Link
                                :href="route('login')"
                                class="font-semibold text-gray-800 hover:text-gray-900"
                                >Inicio de sesión</Link
                            >
                        </li>
                        <li x-show="canRegister">
                            <Link
                                :href="route('register')"
                                class="font-semibold text-gray-800 hover:text-gray-900"
                                >Registrarse</Link
                            >
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <AuthenticationCard>
            <template #logo>
                <AuthenticationCardLogo />
            </template>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Correo:" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Contraseña:" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-400 hover:text-gray-600 rounded-md focus:outline-none"
                    >
                        Olvidé mi contraseña
                    </Link>
                </div>
            </form>
        </AuthenticationCard>
        <div class="flex items-center justify-center mt-5">
            <div
                class="flex items-center justify-center space-x-2 text-gray-400"
            >
                <p>¿No tienes una cuenta?</p>
                <Link
                    v-if="canResetPassword"
                    :href="route('register')"
                    class="underline text-sm text-gray-400 hover:text-gray-600 rounded-md focus:outline-none"
                >
                    REGISTRATE AQUÍ
                </Link>
            </div>
        </div>
        <ButtonMain
            class="ms-4 mt-14"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
            INICIAR SESION
        </ButtonMain>
    </div>
</template>
