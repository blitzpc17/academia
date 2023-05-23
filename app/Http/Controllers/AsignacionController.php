<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materias;
use App\Models\AsignacionDocentes;
use App\Models\AsignacionEstudiantes;
use Auth;
use DB;

class AsignacionController extends Controller
{
    public function Index(Request $r){
        $user = Auth::user();
        $cuenta = json_decode(User::ObtenerCuentaData($user->id));
        return view('Admin.asignacion_materia', compact('cuenta'));
    }

    public function Save(Request $r){ 
        $materia = Materias::where('id', $r->materia)->first();        
        $data=[];

        if($r->tipo == 'E'){
            $data = array(
                "estudiantesId" => $r->persona,           
                "docentesMateriasId" => $r->materia
            );       
        }else{
            $data = array(
                "docentesId" => $r->persona,           
                "materiasId" => $r->materia 
            );       
        }
      
        if($r->op=="I") {
            if($r->tipo=="E"){
                AsignacionEstudiantes::create($data);
            }else{
                AsignacionDocentes::create($data);
            }
            
        }else{
            if($r->tipo=="E"){
                AsignacionEstudiantes::where('id', $r->id)->update($data);
            }else{
                AsignacionDocentes::where('id', $r->id)->update($data);
            }
        }     

        return response()->json(["code"=>200, "msj" => "Registro guardado correctamente."]);
    }

    public function Listar(Request $r){
        if($r->tipo=="E"){
            return DB::table('estudiantes_materias as es')
                        ->JOIN('docentes_materias as dm', 'es.docentesMateriasId', 'dm.id')
                        ->JOIN('personas as per', 'dm.docentesId', 'per.Id')
                        ->JOIN('docentes as doc','per.id','doc.id')
                        ->JOIN('materias as mat', 'dm.materiasId', 'mat.id')
                        ->WHERE('es.estudiantesId', $r->id)
                        ->select(DB::raw("CONCAT(mat.nombre, ' - ', per.nombres, ' ', per.apellidos) as nombre"), 'dm.id')
                        ->get();
        }else{
            return DB::table('personas as per')
                    ->JOIN('docentes as doc','per.id','doc.id')
                    ->JOIN('docentes_materias as dm', 'doc.id', 'dm.docentesId')
                    ->JOIN('materias as mat', 'dm.materiasId', 'mat.id')
                    ->SELECT(DB::raw("CONCAT(mat.nombre, ' - ', per.nombres, ' ', per.apellidos) as nombre"), 'dm.id')
                    ->WHERE('per.id', $r->id)
                    ->get();
        }
    }

    public function ListarMateriasDocentes(Request $r){
        return DB::table('personas as per')
        ->JOIN('docentes as doc','per.id','doc.id')
        ->JOIN('docentes_materias as dm', 'doc.id', 'dm.docentesId')
        ->JOIN('materias as mat', 'dm.materiasId', 'mat.id')
        ->select(DB::raw("CONCAT(mat.nombre, ' - ', per.nombres, ' ', per.apellidos) as nombre"), 'dm.id')
        ->get();
    }
  

    public function Eliminar(Request $r){
        if($r->tipo == 'E'){
            AsignacionEstudiantes::where('id', $r->id)->delete();
        }else{
            AsignacionDocentes::where('id', $r->id)->delete();
        }

        return response()->json(["code"=>200, "msj"=>"Registro eliminado correctamente"]);
    }
}
