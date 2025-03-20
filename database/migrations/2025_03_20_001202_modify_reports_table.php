<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            // Eliminar las foreign keys incorrectas
            $table->dropForeign(['technician_id']);
            $table->dropForeign(['manager_id']);

            // Agregar las foreign keys correctas
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            // Revertir los cambios si es necesario
            $table->dropForeign(['technician_id']);
            $table->dropForeign(['manager_id']);

            // Volver a las relaciones anteriores
            $table->foreign('technician_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

};
