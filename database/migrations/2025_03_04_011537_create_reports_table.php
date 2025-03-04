<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->foreignId('technician_id')->constrained('users')->onDelete('cascade'); // Técnico que reporta
            $table->foreignId('manager_id')->constrained('users')->onDelete('cascade'); // Gestor que gestiona el reporte
            $table->foreignId('novelty_type_id')->constrained('subdomains')->onDelete('cascade'); // Tipo de novedad
            $table->text('description')->nullable(); // Descripción del reporte
            $table->foreignId('state_id')->constrained('subdomains')->onDelete('cascade'); // Estado del reporte
            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}
