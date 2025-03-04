<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('cascade'); // Admin que recibe o genera la notificación
            $table->foreignId('technician_id')->nullable()->constrained('technicians')->onDelete('cascade'); // Técnico que recibe o genera la notificación
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade'); // Reporte asociado
            $table->string('message', 255); // Mensaje de la notificación
            $table->boolean('is_read')->default(false); // Estado de la notificación (leída o no)
            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
}
