<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubdomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // items del dominio report_item
        $items = [
            ['subdomain' => 'Escalera Demorada', 'domain_id' => 1],
            ['subdomain' => 'Sin Ruta', 'domain_id' => 1],
            ['subdomain' => 'Nivelar Ruta', 'domain_id' => 1],
            ['subdomain' => 'Visita fallida', 'domain_id' => 1],
            ['subdomain' => 'Visita sin información', 'domain_id' => 1],
            ['subdomain' => 'Token Geocerca', 'domain_id' => 1],
            ['subdomain' => 'Token Completo', 'domain_id' => 1],
            ['subdomain' => 'Token Imcompleto', 'domain_id' => 1],
            ['subdomain' => 'Moto Varada', 'domain_id' => 1],
            ['subdomain' => 'Cambio de zona', 'domain_id' => 1],
            ['subdomain' => 'Lluvia', 'domain_id' => 1],
            ['subdomain' => 'Cancelado en Ruta', 'domain_id' => 1],
            ['subdomain' => 'Apoyo Técnico Auxiliar', 'domain_id' => 1],
            ['subdomain' => 'Accidente Larobal', 'domain_id' => 1],
            ['subdomain' => 'Accidente de transito', 'domain_id' => 1],
            ['subdomain' => 'Conflicto con el Cliente', 'domain_id' => 1],
            ['subdomain' => 'Daño a un bien o propiedad privada', 'domain_id' => 1],
            ['subdomain' => 'Otro', 'domain_id' => 1],
            ['subdomain' => 'Tarea', 'domain_id' => 2],
            ['subdomain' => 'Pedido', 'domain_id' => 2],
            ['subdomain' => 'Dirección', 'domain_id' => 2],
            ['subdomain' => 'Nombre Usuario', 'domain_id' => 2],
            ['subdomain' => 'telefono Usuario', 'domain_id' => 2],
            ['subdomain' => 'Hora Inicio', 'domain_id' => 2],
            ['subdomain' => 'Hora Final', 'domain_id' => 2],
            ['subdomain' => 'Tiempo transcurrido', 'domain_id' => 2],
            ['subdomain' => 'Tiquete Técnico', 'domain_id' => 2],
            ['subdomain' => 'Impacto', 'domain_id' => 2],
            ['subdomain' => 'Avance', 'domain_id' => 2],
            ['subdomain' => 'Mac', 'domain_id' => 2],
            ['subdomain' => 'Serial', 'domain_id' => 2],
            ['subdomain' => 'Otro', 'domain_id' => 2],
        ];

        DB::table('subdomains')->insert($items);
    }
}
