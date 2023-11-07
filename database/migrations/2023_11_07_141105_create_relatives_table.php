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
        Schema::create('relatives', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->boolean("parents")->nullable();
            $table->string("specify_parents")->nullable();
            $table->string("consanguinity_parents")->nullable();

            $table->boolean("diabetes")->nullable();
            $table->string("specify_diabetes")->nullable();
            $table->string("consanguinity_diabetes")->nullable();

            $table->boolean("cardiovascular")->nullable();
            $table->string("specify_cardiovascular")->nullable();
            $table->string("consanguinity_cardiovascular")->nullable();

            $table->boolean("hypertension")->nullable();
            $table->string("specify_hypertension")->nullable();
            $table->string("consanguinity_hypertension")->nullable();

            $table->boolean("neoplasms")->nullable();
            $table->string("specify_neoplasms")->nullable();
            $table->string("consanguinity_neoplasms")->nullable();

            $table->boolean("psychiatric")->nullable();
            $table->string("specify_psychiatric")->nullable();
            $table->string("consanguinity_psychiatric")->nullable();

            $table->boolean("neurological")->nullable();
            $table->string("specify_neurological")->nullable();
            $table->string("consanguinity_neurological")->nullable();
            
            $table->boolean("down_syndrome")->nullable();
            $table->string("specify_down_syndrome")->nullable();
            $table->string("consanguinity_down_syndrome")->nullable();

            $table->boolean("intellectual_disability")->nullable();
            $table->string("specify_intellectual_disability")->nullable();
            $table->string("consanguinity_intellectual_disability")->nullable();

            $table->boolean("dementia")->nullable();
            $table->string("specify_dementia")->nullable();
            $table->string("consanguinity_dementia")->nullable();

            $table->boolean("others")->nullable();
            $table->string("specify_others")->nullable();
            $table->string("consanguinity_others")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatives');
    }
};
