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
        Schema::create('clinic_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string("clinic")->nullable();
            $table->string("other")->nullable();
            $table->string("genetic_institute")->nullable();
            $table->boolean('pk')->nullable();
            $table->boolean('alz')->nullable();
            $table->boolean('control')->nullable();
            $table->boolean('blood_sample')->nullable();
            $table->boolean('dentistry_sample')->nullable();

            $table->string("city")->nullable();
            $table->date("date")->nullable();

            #scholarships table
            $table->uuid('scholarship_id')->nullable();
            $table->foreign('scholarship_id')->references('id')->on('scholarships')->onDelete('cascade');

            $table->string("attendant_name")->nullable();
            $table->string("relationship")->nullable();
            $table->string("attendant_phone")->nullable();

            $table->text("reason")->nullable();
            $table->text("current_illness")->nullable();
            
            # records
            $table->uuid('record_id')->nullable();
            $table->foreign('record_id')->references('id')->on('records')->onDelete('cascade');

            $table->text("other_information")->nullable();
            
            ## llave foranea de users
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_histories');
    }
};
