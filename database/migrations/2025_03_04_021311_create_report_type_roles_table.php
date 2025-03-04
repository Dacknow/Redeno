<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTypeRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_type_roles', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->foreignId('novelty_type_id')->constrained('subdomains')->onDelete('cascade'); // Tipo de novedad
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Rol que puede gestionar el tipo de novedad
            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_type_roles');
    }
}
