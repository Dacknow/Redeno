<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'report_id', // ID del reporte al que pertenece
        'item_id',   // ID del item dinámico (subdominio)
        'value',     // Valor del item dinámico
    ];

    /**
     * Obtener el reporte al que pertenece este item.
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Obtener el item dinámico (subdominio).
     */
    public function item()
    {
        return $this->belongsTo(Subdomain::class, 'item_id');
    }
}
