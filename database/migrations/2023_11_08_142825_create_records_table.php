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
        Schema::create('records', function (Blueprint $table) {
            $table->uuid('id')->primary();

            ## pathological_records
            $table->uuid('pathological_record_id')->nullable();
            $table->foreign('pathological_record_id')->references('id')->on('pathological_records')->onDelete('cascade');

            #cardiovascular_events
            $table->uuid('cardiovascular_event_id')->nullable();
            $table->foreign('cardiovascular_event_id')->references('id')->on('cardiovascular_events')->onDelete('cascade');

            #traumatics
            $table->uuid('traumatic_id')->nullable();
            $table->foreign('traumatic_id')->references('id')->on('traumatics')->onDelete('cascade');

            # toxics
            $table->uuid('toxic_id')->nullable();
            $table->foreign('toxic_id')->references('id')->on('toxics')->onDelete('cascade');

            # paraclinicals
            $table->uuid('paraclinical_id')->nullable();
            $table->foreign('paraclinical_id')->references('id')->on('paraclinicals')->onDelete('cascade');

            #relatives
            $table->uuid('relative_id')->nullable();
            $table->foreign('relative_id')->references('id')->on('relatives')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
