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
import { ref, watch } from 'vue';

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

const name = ref(false);
const lastname = ref(false);
const email = ref(false);
const identification = ref(false);
const birthdate = ref(false);
const schooling = ref(false);
const birthday_place = ref(false);
const sex = ref(false);
const address = ref(false);
const phone = ref(false);
const civil_status = ref(false);
const password = ref(false);
const password_confirmation = ref(false);




const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
};

const validateForm = () => {

};

const validateName = () => {
    if (form.name.length < 3) {
        form.errors.name = 'El nombre debe tener al menos 3 caracteres.';
        form.name = '';

    } else {
        form.errors.name = '';
        name.value = true;
    }
};
const validateLastname = () => {
    if (form.lastname.length < 3) {
        form.errors.lastname = 'El apellido debe tener al menos 3 caracteres.';
        form.lastname = '';
    } else {
        form.errors.lastname = '';
        lastname.value = true;
    }
};

const validateEmail = () => {
    if (!form.email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        form.errors.email = 'El correo electrónico no es válido.';
        form.email = '';
    } else {
        form.errors.email = '';
        email.value = true;
    }

}

const validateIdentification = () => {
    const id = Number(form.identification);
    if (!Number.isInteger(id)) {
        form.errors.identification = 'La cédula de ciudadanía debe ser un número.';
        form.identification = '';
    }
    else {
        form.errors.identification = '';
        identification.value = true;
    }
};

const validateBirthdate = () => {
    if (!form.birthdate) {
        form.errors.birthdate = 'La fecha de nacimiento es obligatoria.';
        form.birthdate = '';
    } else {
        form.errors.birthdate = '';
        birthdate.value = true;
    }
};
const validateSchooling = () => {
    if (form.schooling === '') {
        form.errors.schooling = 'El nivel de escolaridad es obligatorio.';
        form.schooling = '';
    } else {
        form.errors.schooling = '';
        schooling.value = true;
    }
};

const validateBirthdayPlace = () => {
    if (typeof form.birthday_place !== 'string' || form.birthday_place.trim() === '') {
        form.errors.birthday_place = 'El lugar de nacimiento debe ser una cadena de texto.';
        form.birthday_place = '';
    } 
    else if (form.birthday_place.trim().length < 3) {
        form.errors.birthday_place = 'El lugar de nacimiento debe tener al menos 3 caracteres.';
        form.birthday_place = '';
    } 
    else {
        form.errors.birthday_place = '';
        birthday_place.value = true;
    }
};

const validateSex = () => {
    if (form.sex === '') {
        form.errors.sex = 'El género es obligatorio.';
    } else {
        form.errors.sex = '';
        sex.value = true;
    }
}

const validateAddress = () => {
    if (form.address.length < 5) {
        form.errors.address = 'La dirección debe tener al menos 5 caracteres.';
        form.address = '';
    } else {
        form.errors.address = '';
        address.value = true;
    }
};


const validatePhone = () => {

    const phoneNumber = Number(form.phone);
    if (!Number.isInteger(phoneNumber)) {
        form.errors.phone = 'El teléfono debe ser un número.';
        form.phone = '';
    }
    else if (form.phone.length < 8) {
        form.errors.phone = 'El teléfono debe tener al menos 8 caracteres.';
        form.phone = '';
    }
    else {
        form.errors.phone = '';
        phone.value = true;
    }
};

const validateCivilStatus = () => {
    if (form.civil_status === '') {
        form.errors.civil_status = 'El estado civil es obligatorio.';
        form.civil_status = '';
    } else {
        form.errors.civil_status = '';
        civil_status.value = true;
    }
};

const validatePassword = () => {
    if (form.password.length < 8) {
        form.errors.password = 'La contraseña debe tener al menos 8 caracteres.';
        form.password = '';
    }
    else if (form.password === '') {
        form.errors.password = 'La contraseña es obligatoria.';
    } else {
        form.errors.password = '';
        password.value = true;
    }
};

const validatePasswordConfirmation = () => {
    if (form.password_confirmation !== form.password) {
        form.errors.password_confirmation = 'Las contraseñas no coinciden.';
        form.password_confirmation = '';

    }
    else if (form.password_confirmation === '') {
        form.errors.password_confirmation = 'La confirmación de la contraseña es obligatoria.';
    }

    else {
        form.errors.password_confirmation = '';
        password_confirmation.value = true;
    }
};



// watch(() => form.email, (newEmail) => {
//     if (!newEmail.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
//         form.errors.email = 'El correo electrónico no es válido.';
//     } else {
//         form.errors.email = '';
//     }
// })
</script>

<template>
    <AppLayout title="Register">
        <div class="h-full flex justify-center items-center p-4">
            <div class="w-full h-full p-10 bg-quinary shadow-md rounded-3xl border border-gray-400 overflow-y-scroll">
                <!-- Formulario -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <InputLabel for="name" value="Nombre:" />
                        <TextInput @blur="validateName" id="name" v-model="form.name" type="text"
                            class="mt-1 block w-full" required autofocus autocomplete="name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="lastname" value="Apellidos:" />
                        <TextInput @blur="validateLastname" id="lastname" v-model="form.lastname" type="text"
                            class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.lastname" />
                    </div>
                    <div>
                        <InputLabel for="email" value="Correo electrónico" />
                        <TextInput @blur="validateEmail" id="email" v-model="form.email" type="email"
                            class="mt-1 block w-full" required autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                        <p class="text-xs text-gray-400">Puede ser de un familiar en caso de no tener uno propio</p>
                    </div>
                    <div>
                        <InputLabel for="identification" value="Cédula de ciudadanía:" />
                        <TextInput @blur="validateIdentification" id="identification" v-model="form.identification"
                            type="text" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.identification" />
                    </div>
                    <div>
                        <InputLabel for="birthdate" value="Fecha de nacimiento:" />
                        <TextInput @blur="validateBirthdate" id="birthdate" v-model="form.birthdate" type="date"
                            class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.birthdate" />
                    </div>
                    <div>
                        <InputLabel for="schooling" value="¿Su nivel de escolaridad es menor o igual a 12 años?:" />
                        <select @blur="validateSchooling" id="schooling" v-model="form.schooling"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0">No, tengo más de 12 años de estudio.</option>
                            <option value="1">Sí, tengo menos de 12 años o igual.</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.schooling" />
                    </div>
                    <div>
                        <InputLabel for="birthday_place" value="Lugar de nacimiento:" />
                        <TextInput @blur="validateBirthdayPlace" id="birthday_place" v-model="form.birthday_place"
                            type="text" class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.birthday_place" />
                    </div>
                    <div>
                        <InputLabel for="sex" value="Seleccione género:" />
                        <select @blur="validateSex" id="sex" v-model="form.sex"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.sex" />
                    </div>
                    <div>
                        <InputLabel for="address" value="Dirección de residencia:" />
                        <TextInput @blur="validateAddress" id="address" v-model="form.address" type="text"
                            class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>
                    <div>
                        <InputLabel for="phone" value="Teléfono:" />
                        <TextInput @blur="validatePhone" id="phone" v-model="form.phone" type="text"
                            class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                    <div>
                        <InputLabel for="civil_status" value="Estado civil:" />
                        <select @blur="validateCivilStatus" id="civil_status" v-model="form.civil_status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                            <option value="separado">Separado</option>
                            <option value="union_libre">Unión libre</option>
                            <option value="viudo">Viudo</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.civil_status" />
                    </div>
                    <div>
                        <InputLabel for="password" value="Contraseña" />
                        <TextInput @blur="validatePassword" id="password" v-model="form.password" type="password"
                            class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div>
                        <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
                        <TextInput @blur="validatePasswordConfirmation" id="password_confirmation"
                            v-model="form.password_confirmation" type="password" class="mt-1 block w-full" required
                            autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                </div>
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />
                            <div class="ml-2">
                                I agree to the
                                <a target="_blank" :href="route('terms.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a>
                                and
                                <a target="_blank" :href="route('policy.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                    </InputLabel>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </div>
                <div class="flex flex-col items-center justify-center mt-5 space-y-4">
                    <p class="text-gray-600">¿Ya tienes una cuenta?
                        <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-blue-500">INICIA
                        SESIÓN AQUÍ</Link>
                    </p>
                    <ButtonCustom
                        v-if="name && lastname && email && identification && birthdate && schooling && birthday_place && sex && address && phone && civil_status && password && password_confirmation"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing" :onclick="submit">
                        REGISTRARME
                    </ButtonCustom>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
