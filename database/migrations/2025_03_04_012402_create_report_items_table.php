<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_items', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade'); // Reporte al que pertenece
            $table->foreignId('item_id')->constrained('subdomains')->onDelete('cascade'); // Item dinámico (subdominio)
            $table->text('value')->nullable(false); // Valor del item dinámico
            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_items');
    }
}