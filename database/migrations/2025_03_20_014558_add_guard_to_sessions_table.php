<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('sessions', function (Blueprint $table) {
            $table->string('guard')->nullable()->after('user_id'); // Agrega el campo guard después de user_id
        });
    }

    public function down(): void {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropColumn('guard'); // Elimina el campo en caso de revertir la migración
        });
    }
};
