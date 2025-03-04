<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'admin_id',   // ID del admin que recibe o genera la notificación
        'technician_id',   // ID del tecnico que recibe o genera la notificación
        'report_id', // ID del reporte asociado
        'message',   // Mensaje de la notificación
        'is_read',   // Estado de la notificación (leída o no)
    ];

    /**
     * Obtener el usuario que recibe la notificación.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }

    /**
     * Obtener el reporte asociado a la notificación.
     */
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
}
