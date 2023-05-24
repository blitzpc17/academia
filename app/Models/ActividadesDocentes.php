<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesDocentes extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'materias_actividades';
    protected $primaryKey = 'id';

    protected $fillable = [
        'docentesMateriasId',
        'tipoActividadesId',
        'titulo',
        'descripcion',
        'fechaInicio',
        'fechaEntrega',
        'materialAdjunto',
        'examen',
        'estado'
    ];

    public $timestamps = false;
}
