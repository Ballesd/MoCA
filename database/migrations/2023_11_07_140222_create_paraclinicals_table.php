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
        Schema::create('paraclinicals', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->date("nuclear_magnetic_resonance_date")->nullable();
            $table->string("nuclear_magnetic_resonance_concept")->nullable();

            $table->date("tac_date")->nullable();
            $table->string("tac_concept")->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paraclinicals');
    }
};
