<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Detalles Demográficos
            $table->integer('edad'); // 50 a 90 años
            $table->tinyInteger('genero'); // 0: Masculino, 1: Femenino
            $table->tinyInteger('etnicidad'); // 0: Caucásico, 1: Afroamericano, 2: Asiático, 3: Otro
            $table->tinyInteger('nivel_educativo'); // 0: Ninguno, 1: Secundaria, 2: Licenciatura, 3: Superior

            // Factores de Estilo de Vida
            $table->decimal('imc', 4, 1); // IMC 15 a 40
            $table->tinyInteger('fumar'); // 0: No, 1: Sí
            $table->integer('consumo_alcohol'); // 0 a 20 unidades por semana
            $table->integer('actividad_fisica'); // 0 a 10 horas por semana
            $table->integer('calidad_dieta'); // 0 a 10 puntuación
            $table->integer('calidad_sueno'); // 4 a 10 puntuación

            // Historial Médico
            $table->tinyInteger('antecedentes_familiares_parkinson'); // 0: No, 1: Sí
            $table->tinyInteger('traumatismo_craneoencefalico'); // 0: No, 1: Sí
            $table->tinyInteger('hipertension'); // 0: No, 1: Sí
            $table->tinyInteger('diabetes'); // 0: No, 1: Sí
            $table->tinyInteger('depresion'); // 0: No, 1: Sí
            $table->tinyInteger('accidente_cerebrovascular'); // 0: No, 1: Sí

            // Mediciones Clínicas
            $table->integer('presion_sistolica'); // 90 a 180 mmHg
            $table->integer('presion_diastolica'); // 60 a 120 mmHg
            $table->integer('colesterol_total'); // 150 a 300 mg/dL
            $table->integer('colesterol_ldl'); // 50 a 200 mg/dL
            $table->integer('colesterol_hdl'); // 20 a 100 mg/dL
            $table->integer('trigliceridos'); // 50 a 400 mg/dL

            // Evaluaciones Cognitivas y Funcionales
            $table->integer('moca'); // 0 a 30 puntuación de Evaluación Cognitiva de Montreal

            // Síntomas
            $table->tinyInteger('temblor'); // 0: No, 1: Sí
            $table->tinyInteger('rigidez'); // 0: No, 1: Sí
            $table->tinyInteger('bradicinesia'); // 0: No, 1: Sí
            $table->tinyInteger('inestabilidad_postural'); // 0: No, 1: Sí
            $table->tinyInteger('problemas_habla'); // 0: No, 1: Sí
            $table->tinyInteger('trastornos_sueno'); // 0: No, 1: Sí
            $table->tinyInteger('estrenimiento'); // 0: No, 1: Sí

            // Información de Diagnóstico
            $table->tinyInteger('diagnostico'); // 0: No, 1: Sí (Enfermedad Neurodegenerativa)

            // Información Confidencial
            $table->string('medico_encargado')->nullable(); // Información del médico

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
