<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNoveltyType extends Model
{
    use HasFactory;

    protected $table = 'data_novelty_types';  // Nombre de la tabla

    protected $fillable = ['novelty_type_id', 'data_id'];

    public $timestamps = false; // Desactivamos timestamps si no los necesitas

    /**
     * Relación con la tabla de tipos de novedad (Subdomain)
     */
    public function noveltyType()
    {
        return $this->belongsTo(Subdomain::class, 'novelty_type_id');
    }

    /**
     * Relación con la tabla de datos (Subdomain)
     */
    public function data()
    {
        return $this->belongsTo(Subdomain::class, 'data_id');
    }

    
}

