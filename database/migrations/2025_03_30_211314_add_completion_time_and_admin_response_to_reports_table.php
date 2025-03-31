<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->timestamp('completion_time')->nullable()->after('updated_at'); // Hora de finalización
            $table->text('admin_response')->nullable()->after('completion_time'); // Respuesta del administrador
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['completion_time', 'admin_response']);
        });
    }
};

