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
        Schema::create('toxics', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->boolean("active_tobacco")->nullable();
            $table->string("previus_active_tobacco")->nullable();
            $table->string("age_tobacco_exposition")->nullable();
            $table->integer("packages_per_year")->nullable();

            $table->boolean("pasive_tobacco")->nullable();
            $table->string("previus_pasive_tobacco")->nullable();
            $table->string("age_pasive_tobacco_exposition")->nullable();
            $table->integer("packages_per_year_pasive")->nullable();

            $table->boolean("wood_smoke")->nullable();
            $table->string("previus_wood_smoke")->nullable();
            $table->string("age_wood_smoke_exposition")->nullable();

            $table->boolean("alcohol")->nullable();
            $table->string("previus_alcohol")->nullable();
            $table->string("age_alcohol_exposition")->nullable();
            $table->string("frecuency_alcohol")->nullable();

            $table->boolean("drugs")->nullable();
            $table->string("previus_drugs")->nullable();
            $table->string("age_drugs_exposition")->nullable();
            $table->string("frecuency_drugs")->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toxics');
    }
};
