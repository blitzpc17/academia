<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Docente extends Model
{
    use HasFactory;

    public static function Guardar($obj, $op){
        if($op == 'U'){
            DB::table('docentes')->where('id', $obj["id"])->update($obj); 
        }
        else{
            DB::table('docentes')->insert($obj);
        }
    }
    

    public static function Listar($todos){
        $condicionActivos = $todos=='A'?" WHERE per.baja = 1 ":($todos=='I'?" WHERE per.baja = 0 ": "");

        $query="SELECT doc.id, doc.rfc,  per.baja,
        CONCAT(per.nombres,' ',per.apellidos ) AS nombre
        FROM docentes as doc
        JOIN personas as per on doc.id = per.id {$condicionActivos}";
        
        return DB::select($query);
    }

    public static function Obtener($id){
        $query="SELECT 
                per.id, per.nombres, per.apellidos, per.fecha_nacimiento as fechaNacimiento, per.sexo,
                est.rfc, est.fecha_contratacion as fechaContratacion
                FROM docentes as est 
                JOIN personas as per on est.id = per.id WHERE est.id = {$id}";

        return DB::select($query);
    }
}
