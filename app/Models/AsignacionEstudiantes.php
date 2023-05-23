<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionEstudiantes extends Model
{
    use HasFactory;

    protected $table = 'estudiantes_materias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'estudiantesId',
        'docentesMateriasId'
    ];

    public $timestamps = false;
}
