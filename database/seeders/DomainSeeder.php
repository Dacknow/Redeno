<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
    // Creación de dominios report_type y report_item

    $domains = [
        ['domain' => 'report_type'], // Primer dominio
        ['domain' => 'report_item'] // Segundo dominio        
    ];

    DB::table('domains')->insert($domains);

    // Mensaje de confirmación
    $this->command->info('Dominios creados exitosamente.');
    }
}
