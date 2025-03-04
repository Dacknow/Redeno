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
    Schema::create('admins', function (Blueprint $table) {
        $table->id(); // Clave primaria autoincremental
        $table->string('name', 45)->nullable(false); // Nombre del administrador
        $table->string('username', 45)->unique()->nullable(false); // Nombre de usuario único (obligatorio)
        $table->string('email', 150)->unique()->nullable(false); // Correo electrónico único (obligatorio)
        $table->string('password', 255)->nullable(false); // Contraseña (obligatoria)
        $table->string('picture', 255)->nullable(); // URL o ruta de la imagen de perfil
        $table->boolean('state')->default(false); // Estado (activo/inactivo)
        $table->boolean('is_available')->default(false); // Disponibilidad (disponible/no disponible)
        $table->timestamps(); // Fecha de creación y actualización
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
