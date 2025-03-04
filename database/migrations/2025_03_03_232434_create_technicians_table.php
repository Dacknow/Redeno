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
    Schema::create('technicians', function (Blueprint $table) {
        $table->id(); // Clave primaria autoincremental
        $table->string('name', 45)->nullable(false);
        $table->string('username', 45)->unique()->nullable(false); // usuario
        $table->string('identification', 20)->unique()->nullable(false); // Identificación única
        $table->string('email', 150)->unique()->nullable(false); // Correo electrónico único
        $table->string('celphone', 20)->nullable(false); // Número de teléfono
        $table->string('password', 255)->nullable(false); // Contraseña
        $table->integer('state')->default(1); // Estado (activo/inactivo)
        $table->timestamps(); // Fecha de creación y actualización
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};
