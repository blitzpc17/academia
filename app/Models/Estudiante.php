<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Estudiante extends Model
{
    use HasFactory;

    public static function Guardar($obj, $op){
        if($op == 'U'){
            DB::table('estudiantes')->where('id', $obj["id"])->update($obj); 
        }
        else{
            DB::table('estudiantes')->insert($obj);
        }
    }
    

    public static function Listar($todos){
        $condicionActivos = $todos=='A'?" WHERE per.baja = 1 ":($todos=='I'?" WHERE per.baja = 0 ": "");

        $query="SELECT est.id, est.matricula,  per.baja,
        CONCAT(per.nombres,' ',per.apellidos ) AS nombre
        FROM estudiantes as est
        JOIN personas as per on est.id = per.id {$condicionActivos}";
        
        return DB::select($query);
    }

    public static function Obtener($id){
        $query="SELECT 
                per.id, per.nombres, per.apellidos, per.fecha_nacimiento as fechaNacimiento, per.sexo,
                est.matricula, est.semestre, est.fecha_inscripcion as fechaInscripcion
                FROM estudiantes as est 
                JOIN personas as per on est.id = per.id WHERE est.id = {$id}";

        return DB::select($query);
    }


}
