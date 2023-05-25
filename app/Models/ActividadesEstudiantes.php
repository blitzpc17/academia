<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ActividadesEstudiantes extends Model
{
    use HasFactory;

    protected $table = 'estudiantes_actividades';
    protected $primaryKey = 'id';

    protected $fillable = [
        'estudiantesId',
        'materiasActividadesId',
        'estado',
        'materialAdjunto',
        'productoEstudiante',
        'calificacion',
        'fechaEntrega',
        'ultimaModificacion',
        'vecesModificado'
    ];

    public $timestamps = false;
}
