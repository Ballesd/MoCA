<template>
    <div class="flex items-center justify-center space-x-12 mb-4">
        <div class="w-11/12 flex flex-col gap-4">
            <div class="flex justify-start items-center space-x-3">
                <font-awesome-icon :icon="['fas', 'volume-up']" size="2x"
                    class="text-secondary cursor-pointer hover:text-primary" @click="speachIntroduction" />
                <h2 class="text-primary text-2xl sm:text-3xl">11. Orientación</h2>
            </div>
            <div class="border-2 border-gray-400 rounded-lg p-4 flex items-center">
                <p class="text-lg sm:text-xl text-justify hyphens-auto sm:hyphens-none">Ingrese la información que solicita en cada uno de los 6 cuadros de texto referido al momento actual.</p>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-col gap-5 mt-3">
        <div class="w-4/5 mx-auto flex gap-3">
            <div class="w-1/3 space-y-1">
                <InputLabel class="text-xl" value="Año" />
                <select v-model="año" class="block w-full border rounded p-2">
                    <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                </select>
            </div>
            <div class="w-1/3 space-y-1">
                <InputLabel class="text-xl"  value="Mes" />
                <select v-model="mes" class="block w-full border rounded p-2">
                    <option v-for="(month, index) in months" :key="index" :value="index">{{ month }}</option>
                </select>
            </div>
            <div class="w-1/3 space-y-1">
                <InputLabel class="text-xl" value="Día" />
                <select v-model="dia" class="block w-full border rounded p-2">
                    <option v-for="day in daysInMonth" :key="day" :value="day">{{ day }}</option>
                </select>
            </div>
        </div>
        <div class="w-4/5 mx-auto flex flex-col sm:flex-row gap-5 ">
            <div class="w-full space-y-1">
                <InputLabel class="text-xl"  value="Día de la semana" />
                <select v-model="diaSemana" class="block w-full border rounded p-2">
                    <option v-for="(day, index) in weekDays" :key="day" :value="day">{{ day }}</option> 
                </select>
            </div>
            <div class="w-full space-y-1">
                <InputLabel class="text-xl" value="Lugar (Ubicación actual)" />
                <TextInput v-model="lugar" type="text" class="block w-full" />
            </div>
            <div class="w-full space-y-1">
                <InputLabel class="text-xl" value="Ciudad" />
                <TextInput v-model="ciudad" type="text" class="block w-full" />
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-8 mb-8">
        <ButtonCustom mode="button" @click="calcularPuntos">finalizar test</ButtonCustom>
    </div>
    
</template>

<script>
import ButtonCustom from '@/Components/ButtonCustom.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import axios from 'axios';
export default {

    emits: ['answer-score'],

    components: {
        ButtonCustom,
        TextInput,
        InputLabel
    },
    data() {
        return {

            years: Array.from({ length: 80 }, (_, i) => new Date().getFullYear() +20 - i),
            months: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre',
            ],
            weekDays:[
                'Domingo',
                'Lunes',
                'Martes',
                'Miercoles',
                'Jueves',
                'Viernes',
                'Sabado'
            ],
            mes: '',
            año: '',
            dia: 0,
            diaSemana: '',
            lugar: '',
            ciudad: '',
            puntosAño: 0,
            puntosMes: 0,
            puntosDia: 0,
            puntosDiaSemana: 0,
            puntosLugar: 0,
            puntosCiudad: 0,
            resultadoTotal: 0
        };
    },
    computed: {
        daysInMonth() {
            // Retorna la cantidad de días según el año y mes seleccionado
            return Array.from(
                { length: new Date(this.año, this.mes + 1, 0).getDate() },
                (_, i) => i + 1
            );
        },
    },
    methods: {
        speachIntroduction() {
            const text1 = 'Ingrese la información que solicita en cada uno de los 6 cuadros de texto.';
            const synthesis = window.speechSynthesis;
            const utterance = new SpeechSynthesisUtterance(text1);
            utterance.rate = 0.6;
            utterance.lang = "es-CO" 
            synthesis.speak(utterance);
        },
        calcularPuntos() {
            // Define las respuestas correctas para cada campo.
            const respuestaAño = new Date().getFullYear(); // Obtén el año actual como número de 4 dígitos.
            const respuestaMes = new Date().getMonth(); // Obtén el mes actual como número (0-11).
            const respuestaDia = new Date().getDate(); // Obtén el día del mes actual como número (1-31).
            const respuestaDiaSemana = new Date().getDay(); // Obtén el día de la semana actual como número (0-6).
            const respuestaLugar = ['hogar', 'casa', 'domicilio', 'vivienda', 'hogar', 'mi casa', 'mi domicilio', 'mi vivienda']; // Cambia por la respuesta correcta para el lugar.
            const respuestaCiudad = ['ciudad', 'pueblo', 'municipio', 'departamento']; // Cambia por la respuesta correcta para la ciudad.

            // Convierte las respuestas correctas a minúsculas y quita los acentos.
            const respuestaAñoSinAcentos = respuestaAño;
            const respuestaMesSinAcentos = respuestaMes;
            const respuestaDiaSinAcentos = respuestaDia;
            const respuestaDiaSemanaSinAcentos = respuestaDiaSemana;
            const respuestaLugarSinAcentos = respuestaLugar.map((lugar) => this.quitarAcentos(lugar.toLowerCase()));
            const respuestaCiudadSinAcentos = respuestaCiudad.map((ciudad) => this.quitarAcentos(ciudad.toLowerCase()));

            // Convierte las entradas del usuario a minúsculas y quita los acentos.
            const añoUsuarioSinAcentos = this.año;
            const mesUsuarioSinAcentos = this.mes;
            const diaUsuarioSinAcentos = this.dia;
            const diaSemanaUsuarioSinAcentos = this.diaSemana.toLowerCase();
            //const lugarUsuarioSinAcentos = this.quitarAcentos(this.lugar.toLowerCase());
            const lugarUsuarioSinAcentos = this.lugar;
            const ciudadUsuarioSinAcentos = this.ciudad;    

            // Inicializa los puntos para cada campo en 0.
            let puntosAño = 0;
            let puntosMes = 0;
            let puntosDia = 0;
            let puntosDiaSemana = 0;
            let puntosLugar = 0;
            let puntosCiudad = 0;


            
            
            // Compara las respuestas ingresadas con las respuestas correctas y asigna puntos.
            if (parseInt(añoUsuarioSinAcentos) === respuestaAñoSinAcentos) puntosAño++;
            if (parseInt(mesUsuarioSinAcentos) === respuestaMesSinAcentos) puntosMes++;
            if (parseInt(diaUsuarioSinAcentos) === respuestaDiaSinAcentos) puntosDia++;
            if (this.obtenerNumeroDiaSemana(diaSemanaUsuarioSinAcentos) === respuestaDiaSemanaSinAcentos) puntosDiaSemana++;
            if (respuestaLugarSinAcentos.includes(lugarUsuarioSinAcentos)) puntosLugar++;
            if (respuestaCiudadSinAcentos.includes(ciudadUsuarioSinAcentos)) puntosCiudad++;


            console.log(puntosAño, puntosMes, puntosDia, puntosDiaSemana, puntosLugar, puntosCiudad);
            // Calcula el resultado total de puntos.
            const resultadoTotal =  puntosAño + puntosMes + puntosDia + puntosDiaSemana + puntosLugar + puntosCiudad;

            // Actualiza los puntos en el estado del componente.
            this.puntosAño = puntosAño;
            this.puntosMes = puntosMes;
            this.puntosDia = puntosDia;
            this.puntosDiaSemana = puntosDiaSemana;
            this.puntosLugar = puntosLugar;
            this.puntosCiudad = puntosCiudad;
            this.resultadoTotal = resultadoTotal;

            const answer = {
                orientation_answer: this.año + ', '+ this.mes + ', ' + this.dia + ', ' + this.diaSemana + ', ' + this.lugar + ', ' + this.ciudad
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
