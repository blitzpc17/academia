<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AsignacionDocentes extends Model
{
    use HasFactory;

    protected $table = 'docentes_materias';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'docentesId',
        'materiasId'
    ];

    public $timestamps = false;


    public static function ListarMateriasDocentes(){
        return DB::table('personas as per')
                ->JOIN('docentes as doc','per.id','doc.id')
                ->JOIN('docentes_materias as dm', 'doc.id', 'dm.docentesId')
                ->JOIN('materias as mat', 'dm.materiasId', 'mat.id')
                ->select(DB::raw("CONCAT(mat.nombre, ' - ', per.nombres, ' ', per.apellidos) as nombre"), 'dm.id')
                ->get();
    }

    public static function ListarMateriasXDocente($id){
        return DB::table('personas as per')
            ->JOIN('docentes as doc','per.id','doc.id')
            ->JOIN('docentes_materias as dm', 'doc.id', 'dm.docentesId')
            ->JOIN('materias as mat', 'dm.materiasId', 'mat.id')
            ->SELECT(DB::raw("CONCAT(mat.nombre, ' - ', per.nombres, ' ', per.apellidos) as nombre"), 'dm.id')
            ->WHERE('per.id', $id)
            ->get();
    }

}
