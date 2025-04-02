<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;

    protected $fillable = [
        'image_url',
        'report_id',
        'autor',
    ];
    public function report(){
        return $this->belongsTo(Report::class, 'report_id');
    }

    // funcion inversa de imagenes por reporte
    public function reportImages(){
        return $this->hasMany(Image::class, 'report_id');
    }
}
