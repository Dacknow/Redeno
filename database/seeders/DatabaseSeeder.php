<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        AdminSeeder::class, // Llama al seeder de administrador
    ]);

    $this->call([
        TechnicianSeeder::class, // Llama al seeder de técnicos
    ]);
    $this->call([
        DomainSeeder::class, // Llama al seeder de dominios
    ]);
    $this->call([
        SubdomainSeeder::class, // Llama al seeder de subdominios
    ]);
    
}
}
