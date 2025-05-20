<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryReport extends Model
{
    use HasFactory;

    protected $table = 'history_reports';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'report_id',
        'admin_id',
        'action',
    ];

    
    public static function logAction($reportId, $adminId, $action)
    {
        self::create([
            'report_id' => $reportId,
            'admin_id' => $adminId,
            'action' => $action,
        ]);
    }
    /**
     * Relación con el reporte original.
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Relación con el administrador que realizó la acción.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
