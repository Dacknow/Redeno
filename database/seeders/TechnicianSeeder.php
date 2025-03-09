<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technician; // Importar el modelo Technician
use Illuminate\Support\Facades\Hash; // Para hashear la contraseña

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un técnico de prueba
        Technician::create([
            'name' => 'Juan Pérez', // Nombre del técnico
            'username' => 'Jupe', // Usuario del técnico
            'identification' => '123456789', // Identificación única
            'email' => 'juan.perez@example.com', // Correo electrónico
            'celphone' => '3001234567', // Número de teléfono
            'password' => Hash::make('password'), // Contraseña hasheada
            'state' => 1, // Estado (1 para activo, 0 para inactivo)
        ]);

        // Mensaje de confirmación
        $this->command->info('Técnico creado exitosamente.');
    }
}
