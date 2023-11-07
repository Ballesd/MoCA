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
        Schema::create('cardiovascular_events', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->boolean("ischemic_cardiac")->nullable();
            $table->boolean("hemorrhagic_cardiac")->nullable();
            $table->string("time_cardiac")->nullable()->nullable();
            $table->boolean("ischemic_cerebral")->nullable();
            $table->boolean("hemorrhagic_cerebral")->nullable();
            $table->string("time_cerebral")->nullable();
            $table->boolean("ischemic_others");
            $table->boolean("hemorrhagic_others");
            $table->string("time_others")->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardiovascular_events');
    }
};
