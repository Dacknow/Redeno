<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'domain', // Nombre del dominio
    ];

    /**
     * Obtener los subdominios que pertenecen a este dominio.
     */
    public function subdomains()
    {
        return $this->hasMany(Subdomain::class);
    }
}
