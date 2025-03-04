<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'technician_id', // ID del técnico que reporta
        'manager_id',    // ID del gestor que gestiona el reporte
        'novelty_type_id', // ID del tipo de novedad
        'description',   // Descripción del reporte
        'state_id',      // ID del estado del reporte
    ];

    /**
     * Obtener el técnico que creó el reporte.
     */
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }

    /**
     * Obtener el gestor que gestiona el reporte.
     */
    public function manager()
    {
        return $this->belongsTo(Admin::class, 'manager_id');
    }

    /**
     * Obtener el tipo de novedad del reporte.
     */
    public function noveltyType()
    {
        return $this->belongsTo(Subdomain::class, 'novelty_type_id');
    }

    /**
     * Obtener el estado del reporte.
     */
    public function state()
    {
        return $this->belongsTo(Subdomain::class, 'state_id');
    }

    /**
     * Obtener los items del reporte.
     */
    public function items()
    {
        return $this->hasMany(ReportItem::class);
    }
}
