<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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


    public static function ListasMateriasXEstudiante($id){
        return DB::table('estudiantes_materias as es')
                        ->JOIN('docentes_materias as dm', 'es.docentesMateriasId', 'dm.id')
                        ->JOIN('personas as per', 'dm.docentesId', 'per.Id')
                        ->JOIN('docentes as doc','per.id','doc.id')
                        ->JOIN('materias as mat', 'dm.materiasId', 'mat.id')
                        ->WHERE('es.estudiantesId', $id)
                        ->select(DB::raw("CONCAT(mat.nombre, ' - ', per.nombres, ' ', per.apellidos) as nombre"), 'dm.id')
                        ->get();
    }
}
