<template>
    <div class="flex items-center justify-center space-x-12 mb-4">
        <div class="w-11/12 flex flex-col gap-4">
            <div class="flex justify-start items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x" class="text-secondary cursor-pointer hover:text-primary" @click="" />
                <h2 class="text-primary text-3xl">11. Orientación</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center">
                <p class="text-gray-500">Ingrese la información que solicita en cada uno de los 6 cuadros de texto.</p>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-col gap-5 mt-3">
        <div class="">
            <InputLabel value="Fecha (YYYY-MM-DD)" />
            <TextInput v-model="fecha" type="date" class="block w-full no-calendar-icon" />
        </div>
        <div class="w-full flex gap-5">
            <div class="w-full">
                <InputLabel value="Día de la semana" />
                <TextInput v-model="diaSemana" type="text" class="block w-full" />
            </div>
            <div class="w-full">
                <InputLabel value="Lugar" />
                <TextInput v-model="lugar" type="text" class="block w-full" />
            </div>
            <div class="w-full">
                <InputLabel value="Localidad" />
                <TextInput v-model="localidad" type="text" class="block w-full" />
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-8">
        <ButtonCustom mode="button" @click="calcularPuntos">CALCULAR PUNTOS</ButtonCustom>
    </div>
    <!-- <div class="m-4 p-4 bg-white shadow-md rounded-lg">
        <div class="mb-4">
            <label class="block text-sm font-semibold">Fecha (YYYY-MM-DD)</label>
            <input type="date" class="border rounded p-2 w-full" v-model="fecha" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold">Mes</label>
            <input type="text" class="border rounded p-2 w-full" v-model="mes" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold">Año</label>
            <input type="text" class="border rounded p-2 w-full" v-model="año" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold">Día de la semana</label>
            <input type="text" class="border rounded p-2 w-full" v-model="diaSemana" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold">Lugar</label>
            <input type="text" class="border rounded p-2 w-full" v-model="lugar" placeholder="Hogar, casa, domicilio, vivienda" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold">Localidad</label>
            <input type="text" class="border rounded p-2 w-full" v-model="localidad" placeholder="Ciudad, pueblo, municipio, departamento" />
        </div>
        <div class="mb-4">
            <button @click="calcularPuntos" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Calcular Puntos</button>
        </div>
    </div> -->
</template>

<script>
import ButtonCustom from '@/Components/ButtonCustom.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import axios from 'axios';
export default {
    components: {
        ButtonCustom,
        TextInput,
        InputLabel
    },
    data() {
        return {
            fecha: '',
            mes: '',
            año: '',
            diaSemana: '',
            lugar: '',
            localidad: '',
            puntosFecha: 0,
            puntosMes: 0,
            puntosAño: 0,
            puntosDiaSemana: 0,
            puntosLugar: 0,
            puntosLocalidad: 0,
            resultadoTotal: 0
        };
    },
    methods: {
        calcularPuntos() {
            // Define las respuestas correctas para cada campo.
            const respuestaFecha = new Date().toISOString().slice(0, 10); // Obtén la fecha actual en formato 2023-10-02
            const respuestaMes = new Date().getMonth(); // Obtén el mes actual como número (0-11).
            const respuestaAño = new Date().getFullYear(); // Obtén el año actual como número de 4 dígitos.
            const respuestaDiaSemana = new Date().getDay(); // Obtén el día de la semana actual como número (0-6).
            const respuestaLugar = ['hogar', 'casa', 'domicilio', 'vivienda']; // Cambia por la respuesta correcta para el lugar.
            const respuestaLocalidad = ['ciudad', 'pueblo', 'municipio', 'departamento']; // Cambia por la respuesta correcta para la localidad.

            // Convierte las respuestas correctas a minúsculas y quita los acentos.
            const respuestaMesSinAcentos = respuestaMes;
            const respuestaAñoSinAcentos = respuestaAño;
            const respuestaDiaSemanaSinAcentos = respuestaDiaSemana;
            const respuestaLugarSinAcentos = respuestaLugar.map((lugar) => this.quitarAcentos(lugar.toLowerCase()));
            const respuestaLocalidadSinAcentos = respuestaLocalidad.map((localidad) => this.quitarAcentos(localidad.toLowerCase()));

            // Convierte las entradas del usuario a minúsculas y quita los acentos.
            const mesUsuarioSinAcentos = this.quitarAcentos(this.mes.toLowerCase());
            const añoUsuarioSinAcentos = this.año.toLowerCase();
            const diaSemanaUsuarioSinAcentos = this.quitarAcentos(this.diaSemana.toLowerCase());
            const lugarUsuarioSinAcentos = this.quitarAcentos(this.lugar.toLowerCase());
            const localidadUsuarioSinAcentos = this.quitarAcentos(this.localidad.toLowerCase());

            // Inicializa los puntos para cada campo en 0.
            let puntosFecha = 0;
            let puntosMes = 0;
            let puntosAño = 0;
            let puntosDiaSemana = 0;
            let puntosLugar = 0;
            let puntosLocalidad = 0;

            // Compara las respuestas ingresadas con las respuestas correctas y asigna puntos.
            if (this.fecha === String(respuestaFecha)) puntosFecha++;
            if (this.obtenerNumeroMes(mesUsuarioSinAcentos) === respuestaMesSinAcentos) puntosMes++;
            if (parseInt(añoUsuarioSinAcentos) === respuestaAñoSinAcentos) puntosAño++;
            if (this.obtenerNumeroDiaSemana(diaSemanaUsuarioSinAcentos) === respuestaDiaSemanaSinAcentos) puntosDiaSemana++;
            if (respuestaLugarSinAcentos.includes(lugarUsuarioSinAcentos)) puntosLugar++;
            if (respuestaLocalidadSinAcentos.includes(localidadUsuarioSinAcentos)) puntosLocalidad++;

            // Calcula el resultado total de puntos.
            const resultadoTotal = puntosFecha + puntosMes + puntosAño + puntosDiaSemana + puntosLugar + puntosLocalidad;

            // Actualiza los puntos en el estado del componente.
            this.puntosFecha = puntosFecha;
            this.puntosMes = puntosMes;
            this.puntosAño = puntosAño;
            this.puntosDiaSemana = puntosDiaSemana;
            this.puntosLugar = puntosLugar;
            this.puntosLocalidad = puntosLocalidad;
            this.resultadoTotal = resultadoTotal;

            const answer = {
                orientation_answer: this.fecha + ', ' + this.mes + ', ' + this.año + ', ' + this.diaSemana + ', ' + this.lugar + ', ' + this.localidad
            };
            //'/moca/uploadOrientation'
            axios.post('/moca/uploadOrientation', answer).catch((error) => {
                console.log(error);
            });
            this.$emit('answer-score', this.resultadoTotal);

        },
        obtenerNumeroMes(nombreMes) {
            const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
            return meses.indexOf(nombreMes);
        },
        obtenerNumeroDiaSemana(nombreDia) {
            const diasSemana = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
            return diasSemana.indexOf(nombreDia);
        },
        quitarAcentos(texto) {
            return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        }
    }
};
</script>
