<template>
    <div class="m-4 p-4 bg-white shadow-md rounded-lg">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-semibold">11. Orientación</h2>
            <p class="text-gray-600">Se asigna un punto por cada una de las respuestas correctas. La fecha y el lugar
            (nombre del hospital, clínica, consulta) deben ser exactos. No se asignará ningún punto si el
            paciente se equivoca por un día en el día del mes y de la semana.
            </p>
        </div>
      <div class="mb-4">
        <label class="block text-sm font-semibold">Fecha (YYYY-MM-DD)</label>
        <input type="date" class="border rounded p-2 w-full" v-model="fecha">
      </div>
      <div class="mb-4">
        <label class="block text-sm font-semibold">Mes</label>
        <input type="text" class="border rounded p-2 w-full" v-model="mes">
      </div>
      <div class="mb-4">
        <label class="block text-sm font-semibold">Año</label>
        <input type="text" class="border rounded p-2 w-full" v-model="año">
      </div>
      <div class="mb-4">
        <label class="block text-sm font-semibold">Día de la semana</label>
        <input type="text" class="border rounded p-2 w-full" v-model="diaSemana">
      </div>
      <div class="mb-4">
        <label class="block text-sm font-semibold">Lugar</label>
        <input type="text" class="border rounded p-2 w-full" v-model="lugar" placeholder="Hogar, casa, domicilio, vivienda">
      </div>
      <div class="mb-4">
        <label class="block text-sm font-semibold">Localidad</label>
        <input type="text" class="border rounded p-2 w-full" v-model="localidad"  placeholder="Ciudad, pueblo, municipio, departamento" >
      </div>
      <div class="mb-4">
        <button @click="calcularPuntos" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
          Calcular Puntos
        </button>
      </div>
    </div>
</template>
  
<script>
  export default {
    data() {
      return {
        fecha: "",
        mes: "",
        año: "",
        diaSemana: "",
        lugar: "",
        localidad: "",
        puntosFecha: 0,
        puntosMes: 0,
        puntosAño: 0,
        puntosDiaSemana: 0,
        puntosLugar: 0,
        puntosLocalidad: 0,
        resultadoTotal: 0,
      };
    },
    methods: {
      calcularPuntos() {
        // Define las respuestas correctas para cada campo.
        const respuestaFecha = new Date().toISOString().slice(0, 10);  // Obtén la fecha actual en formato 2023-10-02
        const respuestaMes = new Date().getMonth(); // Obtén el mes actual como número (0-11).
        const respuestaAño = new Date().getFullYear(); // Obtén el año actual como número de 4 dígitos.
        const respuestaDiaSemana = new Date().getDay(); // Obtén el día de la semana actual como número (0-6).
        const respuestaLugar = ["hogar", "casa", "domicilio", "vivienda"] // Cambia por la respuesta correcta para el lugar.
        const respuestaLocalidad = ["ciudad", "pueblo", "municipio", "departamento"] // Cambia por la respuesta correcta para la localidad.
  
        // Convierte las respuestas correctas a minúsculas y quita los acentos.
        const respuestaMesSinAcentos = respuestaMes;
        const respuestaAñoSinAcentos = respuestaAño;
        const respuestaDiaSemanaSinAcentos = respuestaDiaSemana;
        const respuestaLugarSinAcentos = respuestaLugar.map((lugar) =>
          this.quitarAcentos(lugar.toLowerCase())
        );
        const respuestaLocalidadSinAcentos = respuestaLocalidad.map((localidad) =>
          this.quitarAcentos(localidad.toLowerCase())
        );

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
        const resultadoTotal =
          puntosFecha +
          puntosMes +
          puntosAño +
          puntosDiaSemana +
          puntosLugar +
          puntosLocalidad;
  
        // Actualiza los puntos en el estado del componente.
        this.puntosFecha = puntosFecha;
        this.puntosMes = puntosMes;
        this.puntosAño = puntosAño;
        this.puntosDiaSemana = puntosDiaSemana;
        this.puntosLugar = puntosLugar;
        this.puntosLocalidad = puntosLocalidad;
        this.resultadoTotal = resultadoTotal;

        this.$emit("answer-score", this.resultadoTotal);
  
        // Muestra los puntos en la consola.
        console.log("Puntos Fecha:", puntosFecha);
        console.log("Puntos Mes:", puntosMes);
        console.log("Puntos Año:", puntosAño);
        console.log("Puntos Día de la semana:", puntosDiaSemana);
        console.log("Puntos Lugar:", puntosLugar);
        console.log("Puntos Localidad:", puntosLocalidad);
        console.log("Resultado Total:", resultadoTotal);
      },
      obtenerNumeroMes(nombreMes) {
        const meses = [
          "enero", "febrero", "marzo", "abril", "mayo", "junio",
          "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
        ];
        return meses.indexOf(nombreMes);
      },
      obtenerNumeroDiaSemana(nombreDia) {
        const diasSemana = [
        "domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado"
        ];
        return diasSemana.indexOf(nombreDia);
      },
      quitarAcentos(texto) {
        return texto
          .normalize("NFD")
          .replace(/[\u0300-\u036f]/g, "");
      },
    },
  };
</script>
  