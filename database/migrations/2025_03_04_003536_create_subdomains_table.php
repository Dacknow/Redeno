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
        Schema::create('subdomains', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->string('subdomain', 100)->nullable(false); // Nombre del subdominio (obligatorio)
            $table->foreignId('domain_id')->constrained('domains')->onDelete('cascade'); // Relación con domains
            $table->foreignId('parent_id')->nullable()->constrained('subdomains')->onDelete('cascade'); // Relación jerárquica
            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdomains');
    }
};
