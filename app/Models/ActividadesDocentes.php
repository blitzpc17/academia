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
       /* $data = DB::table('materias_actividades as ma')
                    ->join('docentes_materias as dm', 'ma.docentesMateriasId', 'dm.id')                    
                    ->join('docentes as d', 'dm.docentesId', 'd.id')
                    ->join('materias as m', 'dm.materiasId','m.id')
                    ->join('personas as per', 'd.id', 'per.id')
                    ->join('estudiantes_materias as em', 'dm.id', 'em.docentesMateriasId')
                    ->leftjoin('estudiantes_actividades as ea', function($join){
                            $join->on('em.estudiantesId','ea.estudiantesId')->where('ea.materiasActividadesId', 'ma.id');
                    })
                    ->where('em.estudiantesId', $id)
                    ->select('ma.id', 'ma.titulo', 'ma.descripcion', 'ma.fechaEntrega', 'ma.fechaInicio', 'm.nombre as materia',
                    DB::raw("CASE WHEN ma.estado = '1' THEN 'NUEVA' ELSE (CASE WHEN ma.estado='2' THEN 'CERRADA' ELSE 'CANCELADA' END) END as estado"),
                    DB::raw("CASE WHEN ma.tipoActividadesId  = '1' THEN 'TAREA' ELSE 'EXAMEN' END as tipo"), 'ma.tipoActividadesId', 'ma.materialAdjunto',
                    DB::raw("CASE WHEN ea.estado = 1 THEN 'ENTREGADO' ELSE (CASE WHEN ea.estado is null THEN 'SIN ENTREGAR' ELSE 'RESUBIDO' END) END  as estadoEntrega"),
                    'ea.estado as estadoEntregaId', 'ma.estado as estadoId', 'ea.calificacion')
                    ->get();*/
        $query = "SELECT `ma`.`id`, `ma`.`titulo`, `ma`.`descripcion`, `ma`.`fechaEntrega`, `ma`.`fechaInicio`, `m`.`nombre` as `materia`, 
                    CASE WHEN ma.estado = '1' THEN 'NUEVA' ELSE (CASE WHEN ma.estado='2' THEN 'CERRADA' ELSE 'CANCELADA' END) END as estado, 
                    CASE WHEN ma.tipoActividadesId  = '1' THEN 'TAREA' ELSE 'EXAMEN' END as tipo, `ma`.`tipoActividadesId`, `ma`.`materialAdjunto`, 
                    CASE WHEN ea.estado = 1 THEN 'ENTREGADO' ELSE (CASE WHEN ea.estado is null THEN 'SIN ENTREGAR' ELSE 'RESUBIDO' END) END  as estadoEntrega, 
                    `ea`.`estado` as `estadoEntregaId`, `ma`.`estado` as `estadoId`, `ea`.`calificacion` 
                    from `materias_actividades` as `ma` 
                    inner join `docentes_materias` as `dm` on `ma`.`docentesMateriasId` = `dm`.`id` 
                    inner join `docentes` as `d` on `dm`.`docentesId` = `d`.`id` 
                    inner join `materias` as `m` on `dm`.`materiasId` = `m`.`id` 
                    inner join `personas` as `per` on `d`.`id` = `per`.`id` 
                    inner join `estudiantes_materias` as `em` on `dm`.`id` = `em`.`docentesMateriasId` 
                    left join `estudiantes_actividades` as `ea` on em.estudiantesId = ea.estudiantesId  and ea.materiasActividadesId = ma.id 
                    where `em`.`estudiantesId` = ".$id;
        $data = DB::select($query);
        return $data;


    }
}
