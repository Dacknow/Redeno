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
        Schema::create('data_novelty_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('novelty_type_id'); // FK a tipos de novedad
            $table->unsignedBigInteger('data_id'); // FK a datos
            
            // Claves foráneas
            $table->foreign('novelty_type_id')->references('id')->on('subdomains')->onDelete('cascade');
            $table->foreign('data_id')->references('id')->on('subdomains')->onDelete('cascade');

            $table->unique(['novelty_type_id', 'data_id']); // Evitar duplicados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_novelty_types');
    }
};
