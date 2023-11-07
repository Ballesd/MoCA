<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pathological_records', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->boolean("neoplasia")->nullable();
            $table->string("neoplasia_type")->nullable();
            $table->string("evolution_time")->nullable();

            $table->boolean("arterial_hypertension")->nullable();
            $table->string("arterial_hypertension_type")->nullable();
            $table->string("arterial_hypertension_time")->nullable();

            $table->boolean("hypothyroidism")->nullable();
            $table->string("hypothyroidism_type")->nullable();
            $table->string("hypothyroidism_time")->nullable();

            $table->boolean("hiperlipidemia")->nullable();
            $table->string("hiperlipidemia_type")->nullable();
            $table->string("hiperlipidemia_time")->nullable();

            $table->string("neurological")->nullable();
            $table->string("neurological_type")->nullable();
            $table->string("neurological_time")->nullable();

            $table->boolean("psychiatric")->nullable();
            $table->string("psychiatric_type")->nullable();
            $table->string("psychiatric_time")->nullable();

            $table->boolean("chronic_infection")->nullable();
            $table->string("chronic_infection_type")->nullable();
            $table->string("chronic_infection_time")->nullable();

            $table->boolean("others")->nullable();
            $table->string("others_type")->nullable();
            $table->string("others_time")->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathological_records');
    }
};
