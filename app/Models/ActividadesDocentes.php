<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ActividadesDocentes extends Model
{
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

    public static function ListarActividadesMateriasXEstudiante($id){
        return DB::table('materias_actividades as ma')
                    ->join('docentes_materias as dm', 'ma.docentesMateriasId', 'dm.id')                    
                    ->join('docentes as d', 'dm.docentesId', 'd.id')
                    ->join('materias as m', 'dm.materiasId','m.id')
                    ->join('personas as per', 'd.id', 'per.id')
                    ->join('estudiantes_materias as em', 'dm.id', 'em.docentesMateriasId')
                    ->leftjoin('estudiantes_actividades as ea', 'ma.id','ea.materiasActividadesId')
                    ->where('em.estudiantesId', $id)
                    ->select('ma.id', 'ma.titulo', 'ma.descripcion', 'ma.fechaEntrega', 'ma.fechaInicio', 'm.nombre as materia',
                    DB::raw("CASE WHEN ma.estado = '1' THEN 'NUEVA' ELSE (CASE WHEN ma.estado='2' THEN 'CERRADA' ELSE 'CANCELADA' END) END as estado"),
                    DB::raw("CASE WHEN ma.tipoActividadesId  = '1' THEN 'TAREA' ELSE 'EXAMEN' END as tipo"), 'ma.tipoActividadesId', 'ma.materialAdjunto',
                    DB::raw("CASE WHEN ea.estado = 1 THEN 'ENTREGADO' ELSE (CASE WHEN ea.estado is null THEN 'SIN ENTREGAR' ELSE 'RESUBIDO' END) END  as estadoEntrega"),
                    'ea.estado as estadoEntregaId', 'ma.estado as estadoId', 'ea.calificacion')
                    ->get();


    }
}
