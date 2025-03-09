<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin; // Importar el modelo Admin
use Illuminate\Support\Facades\Hash; // Para hashear la contraseña

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un administrador de prueba
        Admin::create([
            'name' => 'SuperAdmin', // Nombre del administrador
            'username' => 'admin', // Nombre de usuario
            'email' => 'admin@admin.com', // Correo electrónico
            'password' => Hash::make('password'), // Contraseña hasheada
            'picture' => null, // Imagen de perfil (opcional)
            'state' => 1, // Estado (1 para activo, 0 para inactivo)
            'is_available' => true, // Disponibilidad (true para disponible)
        ]);

        // Mensaje de confirmación
        $this->command->info('Administradores creados exitosamente.');
    }
}
