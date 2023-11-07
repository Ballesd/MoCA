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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->boolean("primary")->nullable();
            $table->boolean("secondary")->nullable();
            $table->string("technical_superior")->nullable();
            $table->string("profesional")->nullable();
            $table->string("postgraduate")->nullable();

            ## llave foranea de work_activities
            $table->uuid('work_activity_id')->nullable();
            $table->foreign('work_activity_id')->references('id')->on('work_activities')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
