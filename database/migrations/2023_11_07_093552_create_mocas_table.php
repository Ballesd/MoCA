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
        Schema::create('mocas', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('ConceptualAlternative')->nullable();
            $table->integer('cube')->nullable();
            $table->integer('clock')->nullable();
            $table->integer('identification')->nullable();
            $table->integer('memory')->nullable();
            $table->integer('attention')->nullable();
            $table->integer('language')->nullable();
            $table->integer('verbal_fluency')->nullable();
            $table->integer('abstraction')->nullable();
            $table->integer('deferred_recall')->nullable();
            $table->integer('orientation')->nullable();

            # user table id normal
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mocas');
    }
};
