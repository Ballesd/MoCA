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
        Schema::create('work_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->string("activity")->nullable();
            $table->string("place")->nullable();
            $table->string("position")->nullable();
            $table->string("actual_situation")->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_activities');
    }
};
