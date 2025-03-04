<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdomain extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'subdomain',          // Nombre del subdominio
        'domain_id',     // ID del dominio al que pertenece
        'parent_id',     // ID del subdominio padre (para jerarquías)
    ];

    /**
     * Obtener el dominio al que pertenece este subdominio.
     */
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    /**
     * Obtener el subdominio padre (si existe).
     */
    public function parent()
    {
        return $this->belongsTo(Subdomain::class, 'parent_id');
    }

    /**
     * Obtener los subdominios hijos (si existen).
     */
    public function children()
    {
        return $this->hasMany(Subdomain::class, 'parent_id');
    }
}
