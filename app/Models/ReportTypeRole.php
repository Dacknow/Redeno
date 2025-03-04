<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ReportTypeRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'novelty_type_id', // ID del tipo de novedad
        'role_id',         // ID del rol
    ];

    /**
     * Obtener el tipo de novedad.
     */
    public function noveltyType()
    {
        return $this->belongsTo(Subdomain::class, 'novelty_type_id');
    }

    /**
     * Obtener el rol.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
