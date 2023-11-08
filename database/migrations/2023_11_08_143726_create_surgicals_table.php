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
        Schema::create('surgicals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->text("type_surgery")->nullable();
            $table->text("elapsed_time")->nullable();

            #record
            $table->uuid('record_id')->nullable();
            $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surgicals');
    }
};
